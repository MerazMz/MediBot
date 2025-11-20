<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="https://demo.awaikenthemes.com/dispnsary/wp-content/uploads/2024/11/favicon.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login Page</title>
    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-auth-compat.js"></script>
    <script>
        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyAhQJW7tf8yPosLy8WdBGqpU32nnJjcoSs",
            authDomain: "myloginapp-54184.firebaseapp.com",
            projectId: "myloginapp-54184",
            storageBucket: "myloginapp-54184.firebasestorage.app",
            messagingSenderId: "49614754222",
            appId: "1:49614754222:web:2c9753336289a1d0fcb83f",
            measurementId: "G-LDPZSP1K8Y"
        };

        // Initialize Firebase
        if (!firebase.apps.length) {
            firebase.initializeApp(firebaseConfig);
        }
    </script>
</head>
<body class="overflow-hidden">
    <div class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-md transition-all hover:shadow-3xl">
        <!-- Logo/Header -->
        <div class="text-center mb-6 sm:mb-8">
            <img src="https://demo.awaikenthemes.com/dispnsary/wp-content/uploads/2024/11/logo-1.svg" 
                     alt="Logo" 
                     class="h-10 mx-auto mb-4">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Welcome Back</h1>
            <p class="text-sm sm:text-base text-gray-500">Please sign in to continue</p>
            
            <?php if(isset($_GET['error'])): ?>
                <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    <?php 
                        switch($_GET['error']) {
                            case 'invalid':
                                echo "Invalid email or password";
                                break;
                            case 'server':
                                echo "Server error occurred. Please try again";
                                break;
                            case 'empty':
                                echo "Please fill in all fields";
                                break;
                            default:
                                echo "An error occurred. Please try again";
                        }
                    ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_GET['success'])): ?>
                <div class="mt-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    <?php echo "Successfully registered! Please login."; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Login Form -->
        <form class="space-y-4 sm:space-y-6" action="login_process.php" method="POST">
            <!-- Email Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2" for="email">
                    Email Address
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm sm:text-base"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <!-- Password Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2" for="password">
                    Password
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm sm:text-base pr-10"
                        placeholder="Enter your password"
                        required
                    >
                    <button 
                        type="button"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 cursor-pointer"
                        onclick="togglePasswordVisibility()"
                    >
                        <i class="fas fa-eye" id="togglePassword"></i>
                    </button>
                </div>
            </div>

            <script>
                function togglePasswordVisibility() {
                    const passwordInput = document.getElementById('password');
                    const toggleIcon = document.getElementById('togglePassword');
                    
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
            </script>

            <!-- Login Button -->
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-2 sm:py-3 rounded-lg hover:bg-blue-700 transition-colors duration-300 font-medium text-sm sm:text-base"
            >
                Sign In
            </button>
        </form>

        <!-- Sign Up Link -->
        <div class="text-center mt-4 sm:mt-6">
            <p class="text-gray-600 text-sm sm:text-base">
                Don't have an account? 
                <a href="signup.php" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">Sign up</a>
            </p>
        </div>

        <!-- Social Login -->
        <div class="mt-2 sm:mt-8">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                </div>
            </div>

            <div class="mt-4 sm:mt-6 w-full">
                <button 
                    type="button"
                    onclick="signInWithGoogle()"
                    class="w-full flex justify-center items-center py-2 px-3 sm:px-4 border border-gray-300 rounded-lg hover:bg-blue-50 transition-colors">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="h-4 sm:h-5 w-4 sm:w-5">
                    <span class="ml-2 text-gray-600 font-semibold">Sign in with Google</span>
                </button>
            </div>

            <script>
                async function signInWithGoogle() {
                    try {
                        const provider = new firebase.auth.GoogleAuthProvider();
                        const result = await firebase.auth().signInWithPopup(provider);
                        
                        // Get user details from Google
                        const user = result.user;
                        const userData = {
                            email: user.email,
                            name: user.displayName,
                            uid: user.uid,
                            profile_image: user.photoURL || null
                        };

                        console.log("Google sign-in successful:", userData);

                        // Send user data to backend
                        const response = await fetch('firebase_auth.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(userData)
                        });

                        const data = await response.json();
                        if (data.success) {
                            window.location.href = 'index.php';
                        } else {
                            throw new Error(data.error || 'Backend authentication failed');
                        }
                    } catch (error) {
                        console.error("Error during Google sign-in:", error);
                        alert("Failed to sign in with Google: " + error.message);
                    }
                }
            </script>
        </div>

        <div class="mt-3 text-center text-xs space-y-1">
            <div class="border-t border-gray-200 my-2"></div>
            <div class="flex justify-center gap-2">
                <a href="admin_login.php" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded shadow-sm text-xs font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-user-tie mr-1"></i>
                    Admin 
                </a>
                <a href="admin_login.php" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded shadow-sm text-xs font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-user-md mr-1"></i>
                    Doctor
                </a>
            </div>
        </div>
    </div>
    </div>
</body>
</html>