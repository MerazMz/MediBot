<?php
session_start();
require_once 'db_connect.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php?error=not_admin");
    exit();
}

// Fetch all appointments
try {
    $stmt = $pdo->query("
        SELECT 
            a.*,
            u.email as user_email,
            d.name as doctor_name,
            d.specialization
        FROM appointments a
        JOIN users u ON a.user_id = u.id
        JOIN doctors d ON a.doctor_id = d.id
        ORDER BY a.appointment_date DESC, a.appointment_time DESC
    ");
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log("Error fetching appointments: " . $e->getMessage());
    $appointments = [];
}
// Update the ambulance bookings query
try {
    $stmt = $pdo->query("
        SELECT 
            ab.*,
            u.email as user_email,
            u.fullname,
            a.vehicle_number,
            a.model,
            ab.location as user_location
        FROM ambulance_bookings ab
        JOIN users u ON ab.user_id = u.id
        JOIN ambulances a ON ab.ambulance_id = a.id
        ORDER BY ab.booking_time DESC
    ");
    $ambulance_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log("Error fetching ambulance bookings: " . $e->getMessage());
    $ambulance_bookings = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="https://demo.awaikenthemes.com/dispnsary/wp-content/uploads/2024/11/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">

    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex justify-between items-center py-4">
                <img src="https://demo.awaikenthemes.com/dispnsary/wp-content/uploads/2024/11/logo-1.svg" alt="Logo" class="h-8 sm:h-10">
                
                <!-- Mobile Menu Button -->
                <button class="lg:hidden text-gray-600 hover:text-gray-900" onclick="toggleMenu()">
                    <i class="fas fa-bars text-2xl"></i>
                </button>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-[#4c63ce] rounded-full flex items-center justify-center text-white">
                                <?php 
                                    $username = htmlspecialchars($_SESSION['admin_username']);
                                    echo strtoupper(substr($username, 0, 1));
                                ?>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-600">Welcome,</span>
                                <span class="text-[#4c63ce] font-medium -mt-1"><?php echo $username; ?></span>
                            </div>
                        </div>
                        <a href="logout.php" onclick="handleLogout(event)" class="bg-[#4c63ce] text-white font-[500] px-4 py-2 rounded-full hover:bg-[#3b4fa3] transition-colors flex items-center gap-2">
                            <span>Logout</span>
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 max-w-7xl mt-8 mb-10">
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-4">Appointment Management</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Doctor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date & Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach($appointments as $appointment): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?php echo htmlspecialchars($appointment['fullname']); ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <?php echo htmlspecialchars($appointment['user_email']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            Dr. <?php echo htmlspecialchars($appointment['doctor_name']); ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <?php echo htmlspecialchars($appointment['specialization']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?php echo date('F j, Y', strtotime($appointment['appointment_date'])); ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <?php echo date('g:i A', strtotime($appointment['appointment_time'])); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            <?php
                                            switch($appointment['status']) {
                                                case 'pending':
                                                    echo 'bg-yellow-100 text-yellow-800';
                                                    break;
                                                case 'confirmed':
                                                    echo 'bg-green-100 text-green-800';
                                                    break;
                                                case 'cancelled':
                                                    echo 'bg-red-100 text-red-800';
                                                    break;
                                                case 'completed':
                                                    echo 'bg-blue-100 text-blue-800';
                                                    break;
                                            }
                                            ?>">
                                            <?php 
                                                if ($appointment['status'] === 'completed') {
                                                    echo 'Completed <i class="fas fa-check-circle ml-1 mt-1"></i>';
                                                } else {
                                                    echo ucfirst(htmlspecialchars($appointment['status']));
                                                }
                                            ?>
                                        </span>
                                        <?php if($appointment['status'] === 'completed'): ?>
                                            <div class="text-xs text-gray-500 mt-1">
                                                Completed on: <?php echo date('M j, Y g:i A', strtotime($appointment['completed_at'])); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <?php if($appointment['status'] === 'pending'): ?>
                                            <button onclick="updateStatus(<?php echo $appointment['id']; ?>, 'confirmed')" 
                                                    class="text-green-600 hover:text-green-900 mr-3">
                                                Confirm
                                            </button>
                                            <button onclick="updateStatus(<?php echo $appointment['id']; ?>, 'cancelled')" 
                                                    class="text-red-600 hover:text-red-900 mr-3">
                                                Cancel
                                            </button>
                                        <?php elseif($appointment['status'] === 'confirmed'): ?>
                                            <button onclick="updateStatus(<?php echo $appointment['id']; ?>, 'completed')" 
                                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                                <i class="fas fa-check-circle "></i> Complete
                                            </button>
                                        <?php endif; ?>
                                        <button onclick="deleteAppointment(<?php echo $appointment['id']; ?>)" 
                                                class="text-red-600 ml-5 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- After the appointments table, add this new section -->
    <div class="container mx-auto px-4 max-w-7xl mt-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Manage Doctors</h2>
                <button onclick="openAddDoctorModal()" 
                        class="bg-[#4c63ce] text-white px-4 py-2 rounded-full hover:bg-[#3b4fa3] transition-colors flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Add Doctor</span>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialization</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Experience</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        try {
                            $stmt = $pdo->query("SELECT * FROM doctors ORDER BY name");
                            $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            foreach($doctors as $doctor): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover" 
                                                     src="<?php echo htmlspecialchars($doctor['image_url']); ?>" 
                                                     alt="<?php echo htmlspecialchars($doctor['name']); ?>">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Dr. <?php echo htmlspecialchars($doctor['name']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo htmlspecialchars($doctor['specialization']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo htmlspecialchars($doctor['experience']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo htmlspecialchars($doctor['rating']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="toggleAvailability(<?php echo $doctor['id']; ?>, <?php echo $doctor['is_available'] ? 'false' : 'true'; ?>)" 
                                                class="px-3 py-1 rounded-full text-sm font-medium mr-2 <?php echo $doctor['is_available'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                            <?php echo $doctor['is_available'] ? 'Available' : 'Not Available'; ?>
                                        </button>
                                        <button onclick="deleteDoctor(<?php echo $doctor['id']; ?>)" 
                                                class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach;
                        } catch(PDOException $e) {
                            error_log("Error fetching doctors: " . $e->getMessage());
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- After the Manage Doctors section, add this new section -->
    <div class="container mx-auto px-4 max-w-7xl mt-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Administrators List</h2>
                <!-- <button onclick="openAddAdminModal()" 
                        class="bg-[#4c63ce] text-white px-4 py-2 rounded-full hover:bg-[#3b4fa3] transition-colors flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Add Administrator</span>
                </button> -->
            </div>

            <!-- Add this table section -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Created Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        try {
                            $stmt = $pdo->query("SELECT id, username, created_at FROM admins ORDER BY created_at DESC");
                            $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            foreach($admins as $admin): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-[#4c63ce] rounded-full flex items-center justify-center text-white mr-3">
                                                <?php echo strtoupper(substr($admin['username'], 0, 1)); ?>
                                            </div>
                                            <div class="text-sm font-medium text-gray-900 flex items-center">
                                                <?php echo htmlspecialchars($admin['username']); ?>
                                                <?php if($admin['id'] == $_SESSION['admin_id']): ?>
                                                    <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full">Current Admin</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                        <?php echo date('F j, Y g:i A', strtotime($admin['created_at'])); ?>
                                    </td>
                                </tr>
                            <?php endforeach;
                        } catch(PDOException $e) {
                            error_log("Error fetching admins: " . $e->getMessage());
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 max-w-7xl mt-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6">
                <h2 class="text-2xl font-bold">Ambulance Bookings</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Patient Details</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ambulance</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Booking Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach($ambulance_bookings as $booking): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        <?php echo htmlspecialchars($booking['fullname']); ?>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <?php echo htmlspecialchars($booking['user_email']); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($booking['user_location']); ?>" 
                                        target="_blank" 
                                        class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-map-marker-alt mr-1"></i>View on Map
                                        </a>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        <?php echo htmlspecialchars($booking['vehicle_number']); ?>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <?php echo htmlspecialchars($booking['model']); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo date('F j, Y g:i A', strtotime($booking['booking_time'])); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php
                                        switch($booking['status']) {
                                            case 'confirmed':
                                                echo 'bg-green-100 text-green-800';
                                                break;
                                            case 'completed':
                                                echo 'bg-blue-100 text-blue-800';
                                                break;
                                            case 'cancelled':
                                                echo 'bg-red-100 text-red-800';
                                                break;
                                        }
                                        ?>">
                                        <?php echo ucfirst(htmlspecialchars($booking['status'])); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <?php if($booking['status'] === 'confirmed'): ?>
                                        <button onclick="updateBookingStatus(<?php echo $booking['id']; ?>, 'completed')" 
                                                class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-check-circle"></i> Complete
                                        </button>
                                        <button onclick="updateBookingStatus(<?php echo $booking['id']; ?>, 'cancelled')" 
                                                class="text-red-600 hover:text-red-900 mr-3">
                                            Cancel
                                        </button>
                                    <?php endif; ?>
                                    <button onclick="deleteBooking(<?php echo $booking['id']; ?>)" 
                                            class="text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    
        <!-- Add this to your existing JavaScript section -->
        <script>
    function updateBookingStatus(bookingId, status) {
        if (confirm('Are you sure you want to mark this booking as ' + status + '?')) {
            fetch('update_ambulance_booking.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `booking_id=${bookingId}&status=${status}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to update booking status: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the booking status');
            });
        }
    }
        </script>

    <!-- After the administrators section -->
    <div class="container mx-auto px-4 max-w-7xl mt-8 mb-10">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Manage Ambulances</h2>
                <button onclick="openAddAmbulanceModal()" 
                        class="bg-[#4c63ce] text-white px-4 py-2 rounded-full hover:bg-[#3b4fa3] transition-colors flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Add Ambulance</span>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Maintenance</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        try {
                            $stmt = $pdo->query("SELECT * FROM ambulances ORDER BY id");
                            $ambulances = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            foreach($ambulances as $ambulance): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?php echo htmlspecialchars($ambulance['vehicle_number']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?php echo htmlspecialchars($ambulance['model']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?php echo htmlspecialchars($ambulance['capacity']); ?> persons
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?php echo date('F j, Y', strtotime($ambulance['last_maintenance_date'])); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="toggleAmbulanceAvailability(<?php echo $ambulance['id']; ?>, <?php echo $ambulance['is_available'] ? 'false' : 'true'; ?>)" 
                                                class="px-3 py-1 rounded-full text-sm font-medium <?php echo $ambulance['is_available'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                            <?php echo $ambulance['is_available'] ? 'Available' : 'In Use'; ?>
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="deleteAmbulance(<?php echo $ambulance['id']; ?>)" 
                                                class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach;
                        } catch(PDOException $e) {
                            error_log("Error fetching ambulances: " . $e->getMessage());
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Ambulance Modal -->
    <div id="addAmbulanceModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium">Add New Ambulance</h3>
                <button onclick="closeAddAmbulanceModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="addAmbulanceForm" onsubmit="handleAddAmbulance(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Vehicle Number</label>
                        <input type="text" name="vehicle_number" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Model</label>
                        <input type="text" name="model" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Capacity</label>
                        <select name="capacity" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            <option value="">Select Capacity</option>
                            <option value="2">2 persons</option>
                            <option value="4">4 persons</option>
                            <option value="6">6 persons</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Maintenance Date</label>
                        <input type="date" name="last_maintenance_date" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeAddAmbulanceModal()"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-[#4c63ce] rounded-md hover:bg-[#3b4fa3]">
                        Add Ambulance
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
    function updateStatus(appointmentId, status) {
        if (confirm('Are you sure you want to ' + status + ' this appointment?')) {
            fetch('update_appointment_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'appointment_id=' + appointmentId + '&status=' + status
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to update appointment: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the appointment');
            });
        }
    }

    function deleteAppointment(appointmentId) {
        if (confirm('Are you sure you want to delete this appointment? This action cannot be undone.')) {
            fetch('delete_appointment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'appointment_id=' + appointmentId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to delete appointment: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the appointment');
            });
        }
    }

    function openAddDoctorModal() {
        document.getElementById('addDoctorModal').classList.remove('hidden');
    }

    function closeAddDoctorModal() {
        document.getElementById('addDoctorModal').classList.add('hidden');
    }

    function deleteDoctor(doctorId) {
        if (confirm('Are you sure you want to delete this doctor? This will also delete all related appointments.')) {
            fetch('delete_doctor.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'doctor_id=' + doctorId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to delete doctor: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the doctor');
            });
        }
    }

    function toggleAvailability(doctorId, newStatus) {
        fetch('update_doctor_availability.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `doctor_id=${doctorId}&is_available=${newStatus}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to update availability: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating availability');
        });
    }

    // Star rating functionality
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.rating-label i');
        
        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                const rating = this.dataset.rating;
                updateStars(rating, 'hover');
            });

            star.addEventListener('mouseout', function() {
                const selectedRating = document.querySelector('input[name="rating"]:checked').value;
                updateStars(selectedRating, 'selected');
            });

            star.addEventListener('click', function() {
                const rating = this.dataset.rating;
                const input = this.parentElement.querySelector('input');
                input.checked = true;
                updateStars(rating, 'selected');
            });
        });

        function updateStars(rating, state) {
            stars.forEach(star => {
                const starRating = star.dataset.rating;
                if (starRating <= rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        }

        // Initialize stars with default rating
        const defaultRating = document.querySelector('input[name="rating"]:checked').value;
        updateStars(defaultRating, 'selected');
    });

    function handleLogout(e) {
        e.preventDefault();
        
        // Clear any client-side storage
        sessionStorage.clear();
        localStorage.removeItem('admin_session');
        
        // Redirect to logout script
        window.location.href = 'logout.php?force=true';
    }

    function openAddAdminModal() {
        document.getElementById('addAdminModal').classList.remove('hidden');
    }

    function closeAddAdminModal() {
        document.getElementById('addAdminModal').classList.add('hidden');
        document.getElementById('addAdminForm').reset();
    }

    function handleAddAdmin(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        
        if (formData.get('password') !== formData.get('confirm_password')) {
            alert('Passwords do not match!');
            return;
        }

        fetch('add_admin.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Administrator added successfully!');
                closeAddAdminModal();
                location.reload();
            } else {
                alert('Failed to add administrator: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while adding the administrator');
        });
    }

    function deleteAdmin(adminId) {
        if (confirm('Are you sure you want to delete this administrator? This action cannot be undone.')) {
            fetch('delete_admin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'admin_id=' + adminId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to delete administrator: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the administrator');
            });
        }
    }
    </script>
    <script>
function openAddAmbulanceModal() {
    document.getElementById('addAmbulanceModal').classList.remove('hidden');
}

function closeAddAmbulanceModal() {
    document.getElementById('addAmbulanceModal').classList.add('hidden');
    document.getElementById('addAmbulanceForm').reset();
}

function handleAddAmbulance(event) {
    event.preventDefault();
    const formData = new FormData(event.target);

    fetch('add_ambulance.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Ambulance added successfully!');
            closeAddAmbulanceModal();
            location.reload();
        } else {
            alert('Failed to add ambulance: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding the ambulance');
    });
}

function toggleAmbulanceAvailability(ambulanceId, newStatus) {
    fetch('update_ambulance_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `ambulance_id=${ambulanceId}&is_available=${newStatus}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Failed to update ambulance status: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the ambulance status');
    });
}

function deleteAmbulance(ambulanceId) {
    if (confirm('Are you sure you want to delete this ambulance? This will also delete all related bookings.')) {
        fetch('delete_ambulance.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'ambulance_id=' + ambulanceId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to delete ambulance: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the ambulance');
        });
    }
}

function deleteBooking(bookingId) {
    if (confirm('Are you sure you want to delete this booking? This action cannot be undone.')) {
        fetch('delete_ambulance_booking.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'booking_id=' + bookingId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to delete booking: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the booking');
        });
    }
}
</script>

<!-- Add Doctor Modal -->
<div id="addDoctorModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium">Add New Doctor</h3>
            <button onclick="closeAddDoctorModal()" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="addDoctorForm" onsubmit="handleAddDoctor(event)">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Specialization</label>
                    <select name="specialization" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        <option value="">Select Specialization</option>
                        <option value="Cardiologist">Cardiologist</option>
                        <option value="Dermatologist">Dermatologist</option>
                        <option value="Pediatrician">Pediatrician</option>
                        <option value="Neurologist">Neurologist</option>
                        <option value="Orthopedic">Orthopedic</option>
                        <option value="Psychiatrist">Psychiatrist</option>
                        <option value="Gynecologist">Gynecologist</option>
                        <option value="Dentist">Dentist</option>
                        <option value="General Physician">General Physician</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Experience</label>
                    <select name="experience" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        <option value="">Select Experience</option>
                        <option value="1-3 years">1-3 years</option>
                        <option value="3-5 years">3-5 years</option>
                        <option value="5-10 years">5-10 years</option>
                        <option value="10-15 years">10-15 years</option>
                        <option value="15+ years">15+ years</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Rating</label>
                    <div class="flex gap-4 mt-1">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <label class="rating-label cursor-pointer">
                                <input type="radio" name="rating" value="<?php echo $i; ?>" 
                                       class="hidden" <?php echo $i === 3 ? 'checked' : ''; ?>>
                                <i class="fas fa-star text-gray-300" data-rating="<?php echo $i; ?>"></i>
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Image URL</label>
                    <input type="url" name="image_url" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                           placeholder="https://example.com/doctor-image.jpg">
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeAddDoctorModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-[#4c63ce] rounded-md hover:bg-[#3b4fa3]">
                    Add Doctor
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Add this to your existing JavaScript section -->
<script>
function openAddDoctorModal() {
    document.getElementById('addDoctorModal').classList.remove('hidden');
}

function closeAddDoctorModal() {
    document.getElementById('addDoctorModal').classList.add('hidden');
    document.getElementById('addDoctorForm').reset();
}

function handleAddDoctor(event) {
    event.preventDefault();
    const formData = new FormData(event.target);

    // Basic validation
    if (!formData.get('name') || !formData.get('specialization') || 
        !formData.get('experience') || !formData.get('rating') || 
        !formData.get('image_url')) {
        alert('Please fill in all fields');
        return;
    }

    fetch('add_doctor.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message || 'Doctor added successfully!');
            closeAddDoctorModal();
            location.reload();
        } else {
            alert(data.message || 'Failed to add doctor');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding the doctor');
    });
}
</script>
</body>
</html>