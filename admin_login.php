<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="https://demo.awaikenthemes.com/dispnsary/wp-content/uploads/2024/11/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class=" overflow-hidden">
    
    <div class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <div class="text-center mb-8">
            <img src="https://demo.awaikenthemes.com/dispnsary/wp-content/uploads/2024/11/logo-1.svg" 
                     alt="Logo" 
                     class="h-10 mx-auto mb-4">
                <h1 class="text-2xl font-bold text-gray-900 font-sans">Admin Login</h1>
                <p class="text-gray-600 mt-2 font-serif">Please sign in to manage appointments</p>
            </div>

            <?php if(isset($_GET['error'])): ?>
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    <?php
                    switch($_GET['error']) {
                        case 'invalid':
                            echo "Invalid username or password";
                            break;
                        case 'not_admin':
                            echo "Access denied. Admin privileges required.";
                            break;
                        default:
                            echo "An error occurred. Please try again.";
                    }
                    ?>
                </div>
            <?php endif; ?>

            <form action="admin_login_process.php" method="POST">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email or Username</label>
                        <input type="text" name="username" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign In
                    </button>
                </div>
            </form>

            <div class="mt-4 text-center text-sm">
                <a href="index.php" class="text-indigo-600 hover:text-indigo-500 hover:underline">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</body>
</html> 