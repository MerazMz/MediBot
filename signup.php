<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="https://demo.awaikenthemes.com/dispnsary/wp-content/uploads/2024/11/favicon.png">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="overflow-hidden">
    <!-- Navigation -->

    <div class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-2xl w-full max-w-md transition-all hover:shadow-3xl">
        <!-- Logo/Header -->
        <div class="text-center mb-4 sm:mb-6">
            <img src="https://demo.awaikenthemes.com/dispnsary/wp-content/uploads/2024/11/logo-1.svg" 
                     alt="Logo" 
                     class="h-8 mx-auto mb-3">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mb-1">Create Account</h1>
            <p class="text-xs sm:text-sm text-gray-500">Sign up to get started</p>
            
            <?php if(isset($_GET['error'])): ?>
                <div class="mt-3 p-2 bg-red-100 border border-red-400 text-red-700 rounded text-sm">
                    <?php 
                        switch($_GET['error']) {
                            case 'password_mismatch':
                                echo "Passwords do not match";
                                break;
                            case 'email_exists':
                                echo "This email address is already registered. Please use a different email or login to your existing account.";
                                break;
                            case 'server':
                                echo "Server error occurred. Please try again";
                                break;
                            case 'empty':
                                echo "Please fill in all fields";
                                break;
                            case 'password_length':
                                echo "Password must be at least 6 characters long";
                                break;
                            default:
                                echo "An error occurred. Please try again";
                        }
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sign Up Form -->
        <form class="space-y-3 sm:space-y-4" action="signup_process.php" method="POST" onsubmit="return validateForm()">
            <!-- Full Name Input -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1" for="fullname">
                    Full Name
                </label>
                <input 
                    type="text" 
                    id="fullname" 
                    name="fullname"
                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm"
                    placeholder="Enter your full name"
                    required
                >
            </div>

            <!-- Email Input -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1" for="email">
                    Email Address
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email"
                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm"
                    placeholder="Enter your email"
                    required
                >
                <span id="emailError" class="text-red-500 text-xs hidden">This email is already registered</span>
            </div>

            <!-- Password Input -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1" for="password">
                    Password
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm pr-10"
                        placeholder="Create a password"
                        required
                        minlength="6"
                    >
                    <button 
                        type="button"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none"
                        onclick="togglePasswordVisibility('password')">
                        <i class="fas fa-eye" id="password-toggle-icon"></i>
                    </button>
                </div>
                <span id="passwordError" class="text-red-500 text-xs hidden">Password must be at least 6 characters long</span>
            </div>

            <!-- Confirm Password Input -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1" for="confirm_password">
                    Confirm Password
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="confirm_password" 
                        name="confirm_password"
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm pr-10"
                        placeholder="Confirm your password"
                        required
                    >
                    <button 
                        type="button"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none"
                        onclick="togglePasswordVisibility('confirm_password')">
                        <i class="fas fa-eye" id="confirm-password-toggle-icon"></i>
                    </button>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="flex items-start">
                <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-blue-600 rounded border-gray-300 mt-0.5" required>
                <label for="terms" class="ml-2 text-xs text-gray-600">
                    I agree to the <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Terms and Conditions</a>
                </label>
            </div>

            <!-- Sign Up Button -->
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300 font-medium text-sm"
            >
                Create Account
            </button>
        </form>

        <!-- Login Link -->
        <div class="text-center mt-3">
            <p class="text-gray-600 text-xs sm:text-sm">
                Already have an account? 
                <a href="login.php" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">Sign in</a>
            </p>
        </div>

    </div>
    </div>

    <!-- Add authentication script -->
    <script>
        //  password visibility toggle

         function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById('password-toggle-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function validateForm() {
            const password = document.getElementById('password').value;
            const passwordError = document.getElementById('passwordError');
            
            if(password.length < 6) {
                passwordError.classList.remove('hidden');
                return false;
            }
            
            passwordError.classList.add('hidden');
            return true;
        }

        function signInWithGoogle() {
            const provider = new firebase.auth.GoogleAuthProvider();
            firebase.auth().signInWithPopup(provider)
                .then((result) => {
                    // Handle successful sign-in
                    console.log('Google sign-in successful:', result.user);
                    // Redirect or update UI as needed
                    // window.location.href = 'dashboard.html';
                })
                .catch((error) => {
                    // Handle errors
                    console.error('Google sign-in error:', error);
                    alert('Failed to sign in with Google: ' + error.message);
                });
        }
    </script>
</body>
</html> 