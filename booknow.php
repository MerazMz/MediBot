<?php
session_start();
require_once 'db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php?error=login_required");
    exit();
}

// Fetch doctors from database
try {
    $stmt = $pdo->query("SELECT * FROM doctors WHERE is_available = 1 ORDER BY rating DESC");
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log("Error fetching doctors: " . $e->getMessage());
    $doctors = [];
}

// Fetch user's appointments
try {
    $stmt = $pdo->prepare("
        SELECT 
            a.*,
            d.name as doctor_name,
            d.specialization,
            d.image_url as doctor_image
        FROM appointments a
        JOIN doctors d ON a.doctor_id = d.id
        WHERE a.user_id = ?
        ORDER BY a.appointment_date DESC, a.appointment_time DESC
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log("Error fetching appointments: " . $e->getMessage());
    $appointments = [];
}

// Get user email from session if available
$user_email = '';
if (isset($_SESSION['user_email'])) {
    $user_email = htmlspecialchars($_SESSION['user_email']);
}

// Define available time slots
$timeSlots = [
    '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
    '14:00', '14:30', '15:00', '15:30', '16:00', '16:30'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="https://demo.awaikenthemes.com/dispnsary/wp-content/uploads/2024/11/favicon.png">
</head>
<body>
    <!-- Keep your existing nav code here -->
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
                    <ul class="flex space-x-8 font-medium hidden">
                        <li class="relative after:content-[''] after:absolute after:w-0 after:h-[2px] after:bg-[#4c63ce] after:left-0 after:bottom-0 after:transition-all after:duration-300 hover:after:w-full cursor-pointer">
                            <a href="#home" onclick="scrollToSection('home'); return false;">Home</a>
                        </li>
                        <li class="relative after:content-[''] after:absolute after:w-0 after:h-[2px] after:bg-[#4c63ce] after:left-0 after:bottom-0 after:transition-all after:duration-300 hover:after:w-full cursor-pointer">
                            <a href="#about" onclick="scrollToSection('about'); return false;">About Us</a>
                        </li>
                        <li class="relative after:content-[''] after:absolute after:w-0 after:h-[2px] after:bg-[#4c63ce] after:left-0 after:bottom-0 after:transition-all after:duration-300 hover:after:w-full cursor-pointer">
                            <a href="#services" onclick="scrollToSection('services'); return false;">Services</a>
                        </li>
                        <li class="relative after:content-[''] after:absolute after:w-0 after:h-[2px] after:bg-[#4c63ce] after:left-0 after:bottom-0 after:transition-all after:duration-300 hover:after:w-full cursor-pointer">
                            <a href="#contact" onclick="scrollToSection('contact'); return false;">Contact</a>
                        </li>
                    </ul>
                    <div class="flex space-x-4">
                        <?php if(isset($_SESSION['user_name'])): ?>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-[#4c63ce] rounded-full flex items-center justify-center text-white">
                                        <?php 
                                            $fullname = htmlspecialchars($_SESSION['user_name']);
                                            $firstname = explode(' ', $fullname)[0];
                                            echo strtoupper(substr($firstname, 0, 1));
                                        ?>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-600">Welcome,</span>
                                        <span class="text-[#4c63ce] font-medium -mt-1"><?php echo $firstname; ?></span>
                                    </div>
                                </div>
                                <a href="logout.php" class="bg-[#4c63ce] text-white font-[500] px-4 py-2 rounded-full hover:bg-[#3b4fa3] transition-colors flex items-center gap-2">
                                    <span>Logout</span>
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="flex space-x-4">
                                <a href="login.php" class="bg-[#4c63ce] text-white font-[500] px-4 py-2 rounded-full hover:bg-[#3b4fa3] transition-colors flex items-center gap-2">
                                    <span>Login</span>
                                    <i class="fas fa-sign-in-alt"></i>
                                </a>
                                <a href="signup.php" class="bg-[#4c63ce] text-white font-[500] px-4 py-2 rounded-full hover:bg-[#3b4fa3] transition-colors flex items-center gap-2">
                                    <span>Signup</span>
                                    <i class="fas fa-user-plus"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden absolute top-full left-0 right-0 bg-white shadow-md z-50">
                <div class="px-4 py-4">
                    <ul class="space-y-4 hidden">
                        <li class="hover:text-[#4c63ce] cursor-pointer"><a href="#home" onclick="scrollToSection('home'); return false;">Home</a></li>
                        <li class="hover:text-[#4c63ce] cursor-pointer"><a href="#about" onclick="scrollToSection('about'); return false;">About Us</a></li>
                        <li class="hover:text-[#4c63ce] cursor-pointer"><a href="#services" onclick="scrollToSection('services'); return false;">Services</a></li>
                        <li class="hover:text-[#4c63ce] cursor-pointer"><a href="#contact" onclick="scrollToSection('contact'); return false;">Contact</a></li>
                    </ul>
                    <div class="flex flex-col space-y-2 mt-4">
                    <?php if(isset($_SESSION['user_name'])): ?>
                            <span class="text-[#4c63ce] font-medium">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                            <a href="logout.php" class="bg-[#4c63ce] text-white px-4 py-2 rounded-full hover:bg-[#3b4fa3] transition-colors text-center">Logout</a>
                        <?php else: ?>
                            <a href="login.php" class="bg-[#4c63ce] text-white px-4 py-2 rounded-full hover:bg-[#3b4fa3] transition-colors text-center">Login</a>
                            <a href="signup.php" class="bg-[#4c63ce] text-white px-4 py-2 rounded-full hover:bg-[#3b4fa3] transition-colors text-center">Signup</a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </nav>
    

    <div class="container mx-auto px-4 max-w-7xl mt-10 mb-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <!-- Booking Form Section -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-4">Book Your Appointment</h2>
                
                <?php if(isset($_GET['success'])): ?>
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        Appointment booked successfully!
                    </div>
                <?php endif; ?>

                <?php if(isset($_GET['error'])): ?>
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        <?php
                        $error = $_GET['error'];
                        switch($error) {
                            case 'invalid_time':
                                echo 'Please select a valid appointment time.';
                                break;
                            case 'past_date':
                                echo 'Please select a future date.';
                                break;
                            case 'unavailable':
                                echo 'This time slot is no longer available. Please select another.';
                                break;
                            case 'server':
                                echo 'Server error occurred. Please try again later.';
                                break;
                            default:
                                echo 'Error booking appointment. Please try again.';
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <form action="process_booking.php" method="POST" class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name" required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50" 
                               placeholder="Enter your full name"
                               value="<?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : ''; ?>">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50" 
                               placeholder="Enter your email address"
                               value="<?php echo $user_email; ?>">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="tel" id="phone" name="phone" required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50" 
                               placeholder="Enter your phone number">
                    </div>

                    <div>
                        <label for="doctor" class="block text-sm font-medium text-gray-700">Select Doctor</label>
                        <select id="doctor" name="doctor_id" required 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50">
                            <option value="">Choose a doctor</option>
                            <?php foreach($doctors as $doctor): ?>
                                <option value="<?php echo $doctor['id']; ?>">
                                    Dr. <?php echo htmlspecialchars($doctor['name']); ?> - <?php echo htmlspecialchars($doctor['specialization']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Preferred Date</label>
                        <input type="date" id="date" name="date" required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50"
                               min="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div>
                        <label for="time" class="block text-sm font-medium text-gray-700">Preferred Time</label>
                        <select id="time" name="time" required 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50">
                            <option value="">Select a time</option>
                            <?php foreach($timeSlots as $slot): ?>
                                <option value="<?php echo $slot; ?>"><?php echo date("g:i A", strtotime($slot)); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea id="message" name="message" rows="4" 
                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-opacity-50" 
                                  placeholder="Describe your health concern"></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full bg-[#4c63ce] text-white font-medium py-2 px-4 rounded-md hover:bg-[#3b4fa3] transition-colors">
                        Book Appointment
                    </button>
                </form>
            </div>

            <!-- Doctors List Section -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-6">Our Doctors</h2>
                <div class="space-y-4">
                    <?php foreach($doctors as $doctor): ?>
                        <div class="flex items-center justify-between p-4 border rounded-lg hover:shadow-md transition-shadow">
                            <div class="flex items-center">
                                <img src="<?php echo htmlspecialchars($doctor['image_url']); ?>" 
                                     alt="Dr. <?php echo htmlspecialchars($doctor['name']); ?>" 
                                     class="w-16 h-16 rounded-full object-cover">
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold">Dr. <?php echo htmlspecialchars($doctor['name']); ?></h3>
                                    <p class="text-sm text-gray-500"><?php echo htmlspecialchars($doctor['specialization']); ?></p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <div class="text-yellow-400">
                                    <?php
                                    $rating = $doctor['rating'];
                                    for($i = 1; $i <= 5; $i++) {
                                        if($i <= $rating) {
                                            echo '<i class="fas fa-star"></i>';
                                        } elseif($i - 0.5 <= $rating) {
                                            echo '<i class="fas fa-star-half-alt"></i>';
                                        } else {
                                            echo '<i class="far fa-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="text-gray-600 text-[10px] mt-1 font-[600]"><?php echo htmlspecialchars($doctor['experience']); ?> of Experience</div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Existing Appointments Section -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Your Appointments</h3>
            <div class="bg-white shadow overflow-hidden rounded-md">
                <?php if(empty($appointments)): ?>
                    <p class="p-4 text-gray-500">No appointments found.</p>
                <?php else: ?>
                    <ul class="divide-y divide-gray-200">
                        <?php foreach($appointments as $appointment): ?>
                            <li class="p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img class="h-10 w-10 rounded-full object-cover" 
                                             src="<?php echo htmlspecialchars($appointment['doctor_image']); ?>" 
                                             alt="Doctor">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">
                                                Dr. <?php echo htmlspecialchars($appointment['doctor_name']); ?>
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                <?php echo htmlspecialchars($appointment['specialization']); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-900">
                                            <?php 
                                                echo date('F j, Y', strtotime($appointment['appointment_date'])); 
                                            ?>
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            <?php 
                                                echo date('g:i A', strtotime($appointment['appointment_time'])); 
                                            ?>
                                        </p>
                                        <span class="inline-flex px-2 text-xs leading-5 font-semibold rounded-full
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
                                    </div>
                                </div>
                                <?php if($appointment['status'] === 'pending'): ?>
                                    <div class="mt-2 flex justify-end">
                                        <button onclick="cancelAppointment(<?php echo $appointment['id']; ?>)" 
                                                class="text-sm text-red-600 hover:text-red-900">
                                            Cancel Appointment
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include 'footer.php'; ?>


    <script>
        function toggleMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Set minimum date for appointment
            const dateInput = document.getElementById('date');
            const today = new Date().toISOString().split('T')[0];
            dateInput.min = today;

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                const mobileMenu = document.getElementById('mobile-menu');
                const menuButton = document.querySelector('.lg\\:hidden');
                
                if (!mobileMenu.contains(event.target) && !menuButton.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });

            // Auto-fill email if available
            <?php if($user_email): ?>
            document.getElementById('email').value = '<?php echo $user_email; ?>';
            <?php endif; ?>
        });

        function cancelAppointment(appointmentId) {
            if (confirm('Are you sure you want to cancel this appointment?')) {
                fetch('cancel_appointment.php', {
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
                        alert('Failed to cancel appointment: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while cancelling the appointment');
                });
            }
        }
    </script>
</body>
</html>