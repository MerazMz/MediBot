<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#4c63ce">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="677644182465-0niou2pejop4s91po10ma04h5ujlhaq4.apps.googleusercontent.com">
    <meta name="google-signin-scope" content="https://www.googleapis.com/auth/fitness.activity.read https://www.googleapis.com/auth/fitness.heart_rate.read https://www.googleapis.com/auth/fitness.body.read">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Replace existing Google API scripts with these -->
    <script src="https://apis.google.com/js/api.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="assets/js/google-fit.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="https://demo.awaikenthemes.com/dispnsary/wp-content/uploads/2024/11/favicon.png">
    <title>Dispnsary - Medical Center</title>
    
    <link
      rel="stylesheet"
      data-purpose="Layout StyleSheet"
      title="Web Awesome"
      href="/css/app-wa-025281ccfe06a9d63cd35694641e07d3.css?vsn=d"
    >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-thin.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-solid.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-regular.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-light.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-thin.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-solid.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-regular.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-light.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-thin.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-regular.css"
      >

      <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-light.css"
      >
</head>
<body class="bg-gray-100" style="background-image:radial-gradient(#b6b6c475 1px, transparent 1px); background-size: 30px 30px; background-color: #ffffff; ">
    <!-- Top Bar -->
    <div class="bg-[#4c63ce] text-white">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex flex-col sm:flex-row justify-between items-center py-2 text-sm">
                <div class="flex flex-row items-center justify-between w-full">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center">
                            <i class="fa-solid fa-clock mr-2"></i>
                            <span class="font-medium">08:00am to 09:00pm</span>
                        </span>
                        <span class="hidden sm:inline">|</span>
                        <span class="hidden sm:flex items-center">
                            <i class="fa-solid fa-envelope mr-2"></i>
                            <span class="font-medium">merazmz2004@gmail.com</span>
                        </span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="hidden sm:flex space-x-4">
                            <i class="fa-brands fa-instagram hover:text-gray-200 cursor-pointer"></i>
                            <i class="fa-brands fa-twitter hover:text-gray-200 cursor-pointer"></i>
                            <i class="fa-brands fa-facebook hover:text-gray-200 cursor-pointer"></i>
                        </div>
                        <span class="hidden sm:inline">|</span>
                        <span class="flex items-center">
                            <span class="font-medium">
                                <i class="fa fa-phone mr-2"></i>+917739864558</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex justify-between items-center py-4">
                <img src="https://demo.awaikenthemes.com/dispnsary/wp-content/uploads/2024/11/logo-1.svg" alt="Logo" class="h-8 sm:h-10">
                
                <!-- Mobile Menu Button -->
                <button class="lg:hidden relative w-8 h-8 cursor-pointer" onclick="toggleMenu()" id="menuButton">
        <span class="absolute w-6 h-0.5 bg-gray-600 transform transition-all duration-300 -translate-x-1/2 left-1/2" style="top: 25%"></span>
        <span class="absolute w-6 h-0.5 bg-gray-600 transform transition-all duration-300 -translate-x-1/2 left-1/2" style="top: 50%"></span>
        <span class="absolute w-6 h-0.5 bg-gray-600 transform transition-all duration-300 -translate-x-1/2 left-1/2" style="top: 75%"></span>

        
    </button>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <ul class="flex space-x-8 font-medium">
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
                            <a href="#health-data" onclick="scrollToSection('health-data'); return false;">Health Stats</a>
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
                    <ul class="space-y-4">
                        <li class="hover:text-[#4c63ce] cursor-pointer"><a href="#home" onclick="scrollToSection('home'); return false;">Home</a></li>
                        <li class="hover:text-[#4c63ce] cursor-pointer"><a href="#about" onclick="scrollToSection('about'); return false;">About Us</a></li>
                        <li class="hover:text-[#4c63ce] cursor-pointer"><a href="#health-data" onclick="scrollToSection('health-data'); return false;">Health Stats</a></li>
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

    <!-- Emergency Ambulance Button -->
    <div class="fixed bottom-24 right-6 z-40">
        <?php if(isset($_SESSION['user_id'])): ?>
            <button onclick="bookAmbulance()" 
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-4 rounded-full shadow-lg flex items-center gap-3 animate-pulse">
                <i class="fas fa-ambulance text-2xl"></i>
            </button>
        <?php else: ?>
            <a href="login.php" 
               class="bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-4 rounded-full shadow-lg flex items-center gap-3">
                <i class="fas fa-ambulance text-2xl"></i>
            </a>
        <?php endif; ?>
    </div>

    <!-- Main Content -->
    <main id="home" class="container mx-auto px-8 my-8 sm:my-0 relative shadow-lg rounded-[40px] bg-gradient-to-br from-white via-blue-50 to-indigo-50 before:content-[''] before:absolute before:inset-0 before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPSc0MCcgaGVpZ2h0PSc0MCcgdmlld0JveD0nMCAwIDQwIDQwJz48ZyBmaWxsPSdub25lJyBmaWxsLXJ1bGU9J2V2ZW5vZGQnPjxjaXJjbGUgY3g9JzIwJyBjeT0nMjAnIHI9JzInIGZpbGw9JyM0YzYzY2UnIG9wYWNpdHk9JzAuMScvPjwvZz48L3N2Zz4=')] before:opacity-30 before:rounded-[40px] max-w-[85rem]">
        <div class="mt-8 sm:mt-16 flex flex-col lg:flex-row">
            <div class="flex flex-col lg:flex-row items-center justify-between w-full">
                <div class="max-w-xl">
                    <h1 class="text-[#4c63ce] font-medium text-base sm:text-lg mb-4 mt-8">
                        <i class="fa-solid fa-stethoscope mr-2 sm:mt-8"></i>
                        Your Health Our Priority
                    </h1>
                    <h2 class="text-2xl sm:text-4xl font-semibold text-[#0B1030] mb-4">
                        Expert Medical care<br>you can rely on
                    </h2>
                    <p class="text-gray-500 text-sm sm:text-base mb-6">
                        Experience healthcare you can trust. Our dedicated team provides<br class="hidden md:block"> compassionate, high-quality care.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 relative z-10 mb-8">
                        <a href="booknow.php" class="rounded-full px-3.5 py-2 m-1 overflow-hidden relative group cursor-pointer border-2 font-medium border-indigo-600 text-indigo-600 text-white">
                            <span class="absolute w-64 h-0 transition-all duration-300 origin-center rotate-45 -translate-x-20 bg-indigo-600 top-1/2 group-hover:h-64 group-hover:-translate-y-32 ease"></span>
                            <span class="relative text-indigo-600 transition duration-300 group-hover:text-white ease">Book Appointment</span>
                        </a>
                        <a href="#contact" class="rounded-full px-3.5 py-2 m-1 overflow-hidden relative group cursor-pointer border-2 font-medium border-indigo-600 text-indigo-600 text-white">
                            <span class="absolute w-64 h-0 transition-all duration-300 origin-center rotate-45 -translate-x-20 bg-indigo-600 top-1/2 group-hover:h-64 group-hover:-translate-y-32 ease"></span>
                            <span class="relative text-indigo-600 transition duration-300 group-hover:text-white ease">Contact Ambulance</span>
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-indigo-50/50 rounded-[40px] before:content-[''] before:absolute before:inset-0 before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPSc0MCcgaGVpZ2h0PSc0MCcgdmlld0JveD0nMCAwIDQwIDQwJz48ZyBmaWxsPSdub25lJyBmaWxsLXJ1bGU9J2V2ZW5vZGQnPjxjaXJjbGUgY3g9JzIwJyBjeT0nMjAnIHI9JzInIGZpbGw9JyM0YzYzY2UnIG9wYWNpdHk9JzAuMScvPjwvZz48L3N2Zz4=')] before:opacity-30 before:rounded-[40px]"></div>
                    <img src="https://i.ibb.co/fz8YCdzD/Pngtree-indian-doctor-woman-smiling-at-15456626.png" alt="doctor" class="w-full h-[450px] object-contain relative z-10 ">

                    <div class="absolute z-30 bottom-8 right-8 bg-white p-3 rounded-[50px] border-4 border-white shadow-lg animate-[moveLeftRight_4s_ease-in-out_infinite]">
                        <div class="flex items-center gap-2">
                            <div class="bg-[#4c63ce] p-3 rounded-full"> <i class="fas fa-users text-white text-lg"></i></div>
                            <p class="text-gray-500 font-medium"><span class="text-black font-semibold text-xl" id="counter">0</span><span class="text-black font-semibold text-xl">+</span> <br> Satisfied Patients</p>
                        </div>
                    </div>

                    <style>
                        @keyframes moveLeftRight {
                            0%, 100% { transform: translateX(0); }
                            50% { transform: translateX(-50px); }
                        }
                    </style>
                </div>
            </div>
        </div>
    </main>


    <!-- About Us -->
    
    <div id="about" class="container mx-auto px-8 my-16 sm:my-24 relative max-w-[85rem]">
        <div class="mt-12 sm:mt-20 flex flex-col lg:flex-row"> <!-- Adjusted margin-top for the entire section -->
            <div class="flex flex-col lg:flex-row items-center justify-between w-full gap-12">
                    <div class="max-w-xl">
                    <h1 class="text-[#4c63ce] font-medium text-base sm:text-lg mb-4 ">
                        <i class="fa-solid fa-stethoscope mr-2 sm:mt-8"></i>
                        About Us
                    </h1>
                    <h2 class="text-2xl sm:text-4xl font-semibold text-[#0B1030] mb-6 leading-tight">
                        Professionals dedicated<br>to your health
                    </h2>
                    <p class="text-gray-600 text-sm sm:text-base mb-8 leading-relaxed">
                        Our team of skilled professionals is committed to providing<br class="hidden md:block"> personalized, compassionate care. With a focus.
                    </p>
                    
                    <div class="space-y-8 relative z-10">
                        <div class="flex items-center gap-6 group hover:transform hover:translate-x-2 transition-all duration-300">
                            <div class="bg-[#4c63ce]/10 w-16 h-16 rounded-2xl text-[#4c63ce] flex items-center justify-center relative overflow-hidden group-hover:bg-[#4c63ce] group-hover:text-white transition-all duration-300 ease-in-out shadow-lg">
                                <i class="fas fa-user-nurse text-xl relative z-10 group-hover:animate-[flip_1s_ease-in-out_infinite]"></i>
                                <style>
                                    @keyframes flip {
                                        0% { transform: rotateY(0deg) scale(1); }
                                        50% { transform: rotateY(180deg) scale(1.2); }
                                        100% { transform: rotateY(360deg) scale(1); }
                                    }
                                </style>
                            </div>
                            <div>
                                <h1 class="text-xl font-semibold group-hover:text-[#4c63ce] transition-colors duration-300">Patient-Centered Care</h1>
                                <p class="text-gray-500 text-sm mt-1">Putting you at the heart of everything we do.</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-6 group hover:transform hover:translate-x-2 transition-all duration-300">
                            <div class="bg-[#4c63ce]/10 w-16 h-16 rounded-2xl text-[#4c63ce] flex items-center justify-center relative overflow-hidden group-hover:bg-[#4c63ce] group-hover:text-white transition-all duration-300 ease-in-out shadow-lg">
                                <i class="fas fa-heartbeat text-xl relative z-10 group-hover:animate-[heartbeat_1s_infinite]"></i>
                            </div>
                            <div>
                                <h1 class="text-xl font-semibold group-hover:text-[#4c63ce] transition-colors duration-300">Comprehensive Health Checkups</h1>
                                <p class="text-gray-500 text-sm mt-1">We offer thorough health assessments to ensure your well-being.</p>
                            </div>
                        </div>
                        <style>
                            @keyframes heartbeat {
                                0%, 100% { transform: scale(1); }
                                50% { transform: scale(1.3); }
                            }
                        </style>

                        <div class="flex items-center gap-6 group hover:transform hover:translate-x-2 transition-all duration-300">
                            <div class="bg-[#4c63ce]/10 w-16 h-16 rounded-2xl text-[#4c63ce] flex items-center justify-center relative overflow-hidden group-hover:bg-[#4c63ce] group-hover:text-white transition-all duration-300 ease-in-out shadow-lg">
                                <i class="fas fa-ambulance text-xl relative z-10 group-hover:animate-[driveAway_1s_ease-in-out_forwards]"></i>
                                <style>
                                    @keyframes driveAway {
                                        0% { transform: translateX(0); opacity: 1; }
                                        100% { transform: translateX(100px); opacity: 0; }
                                    }
                                </style>
                            </div>
                            <div>
                                <h1 class="text-xl font-semibold group-hover:text-[#4c63ce] transition-colors duration-300">24 Hours Ambulance Service</h1>
                                <p class="text-gray-500 text-sm mt-1">We are here for you 24/7 to provide the care you need.</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-6 group hover:transform hover:translate-x-2 transition-all duration-300">
                            <div class="bg-[#4c63ce]/10 w-16 h-16 rounded-2xl text-[#4c63ce] flex items-center justify-center relative overflow-hidden group-hover:bg-[#4c63ce] group-hover:text-white transition-all duration-300 ease-in-out shadow-lg">
                                <i class="fas fa-user-md text-xl relative z-10 group-hover:animate-bounce"></i>
                            </div>
                            <div>
                                <h1 class="text-xl font-semibold group-hover:text-[#4c63ce] transition-colors duration-300">Expert Medical Consultation</h1>
                                <p class="text-gray-500 text-sm mt-1">Get professional advice from our experienced doctors.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:block relative">
                    <div class="relative">
                        <img src="https://images.pexels.com/photos/3259624/pexels-photo-3259624.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="doctor" class="w-full h-[450px] object-cover rounded-[40px] mt-8 shadow-xl">
                        <img src="https://images.pexels.com/photos/4386464/pexels-photo-4386464.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="open hours" class="w-[200px] h-[200px] object-cover absolute -bottom-8 -left-[90px] rounded-[40px] border-8 border-white shadow-xl">
                        <div class="absolute -bottom-8 right-[16px] bg-gradient-to-br from-white via-blue-50 to-indigo-50 p-4 rounded-[20px] border-4 border-white shadow-xl">
                            <p class="text-[#4c63ce] font-semibold text-sm flex items-center gap-2">
                                <i class="fas fa-video"></i>
                                Video call support
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services -->
    <div id="services" class="py-10 relative -mt-24">
    <div class="max-w-5xl mx-auto px-8 py-8">
        <div class="text-center">
            <h1 class="text-[#4c63ce] font-medium text-base sm:text-lg mb-4">
                <i class="fa-solid fa-stethoscope sm:mt-8 mr-2"></i>
                Our Services
            </h1>
            <h1 class="text-3xl font-medium text-gray-900 mt-5 mb-6">
                Comprehensive Services for Your Health Journey
            </h1>
        </div>
        <!-- Navigation Buttons -->
        <button id="prevBtn" class="absolute -left-4 top-1/2 -translate-y-1/2 z-10 bg-gray-100 p-3 rounded-full shadow-xl hover:bg-[#4c63ce] hover:text-white transition-all mx-4 sm:mx-40 hover:shadow]">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="nextBtn" class="absolute -right-4 top-1/2 -translate-y-1/2 z-10 bg-gray-200 p-3 rounded-full shadow-xl hover:bg-[#4c63ce] hover:text-white transition-all mx-4 sm:mx-40 hover:shadow]">
                <i class="fas fa-chevron-right"></i>
            </button>
        <!-- Carousel Container -->
        <div class="relative overflow-hidden">
            <!-- Cards Container -->
            <div id="servicesCarousel" class="flex gap-6 transition-transform duration-500 ease-in-out">
                <!-- Original Cards -->
                <div class="min-w-[300px] bg-gradient-to-br from-white via-blue-50 to-indigo-50 p-6 rounded-2xl shadow-lg hover:shadow-lg transition-shadow">
                    <div class="bg-gray-100 rounded-full w-14 h-14 flex justify-center items-center text-[#4c63ce] shadow-xl mb-5">
                        <i class="fa-solid fa-x-ray text-2xl"></i>
                    </div>
                    <h2 class="uppercase text-[#4c63ce] font-medium mb-3">Radiology</h2>
                    <p class="text-gray-600 mb-3 text-sm">Advanced imaging services using state-of-the-art technology.</p><br>
                    <a class="text-[#4c63ce] flex items-center hover:text-[#3b4fa3] font-medium group" href="/">
                        Read More
                        <i class="fa-solid fa-chevron-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Add more cards with the same structure -->
                <div class="min-w-[300px] bg-gradient-to-br from-white via-blue-50 to-indigo-50 p-6 rounded-2xl shadow-lg hover:shadow-lg transition-shadow">
                    <div class="bg-gray-100 rounded-full w-14 h-14 flex justify-center items-center text-[#4c63ce] shadow-xl mb-5">
                        <i class="fas fa-brain text-2xl"></i>
                    </div>
                    <h2 class="uppercase text-[#4c63ce] font-medium mb-3">Neurology</h2>
                    <p class="text-gray-600 mb-3 text-sm">Comprehensive care for neurological conditions.</p><br>
                    <a class="text-[#4c63ce] flex items-center hover:text-[#3b4fa3] font-medium group" href="/">
                        Read More
                        <i class="fa-solid fa-chevron-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Add more service cards here -->
                <div class="min-w-[300px] bg-gradient-to-br from-white via-blue-50 to-indigo-50 p-6 rounded-2xl shadow-lg hover:shadow-lg transition-shadow">
                    <div class="bg-gray-100 rounded-full w-14 h-14 flex justify-center items-center text-[#4c63ce] shadow-xl mb-5">
                        <i class="fas fa-heartbeat text-2xl"></i>
                    </div>
                    <h2 class="uppercase text-[#4c63ce] font-medium mb-3">Cardiology</h2>
                    <p class="text-gray-600 mb-3 text-sm">Expert heart care from prevention to treatment.</p><br>
                    <a class="text-[#4c63ce] flex items-center hover:text-[#3b4fa3] font-medium group" href="/">
                        Read More
                        <i class="fa-solid fa-chevron-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Additional Cards -->
                <div class="min-w-[300px] bg-gradient-to-br from-white via-blue-50 to-indigo-50 p-6 rounded-2xl shadow-lg hover:shadow-lg transition-shadow">
                    <div class="bg-gray-100 rounded-full w-14 h-14 flex justify-center items-center text-[#4c63ce] shadow-xl mb-5">
                        <i class="fas fa-bone text-2xl"></i>
                    </div>
                    <h2 class="uppercase text-[#4c63ce] font-medium mb-3">Orthopedics</h2>
                    <p class="text-gray-600 mb-3 text-sm">Specialized care for bones, joints, and muscles.</p><br>
                    <a class="text-[#4c63ce] flex items-center hover:text-[#3b4fa3] font-medium group" href="/">
                        Read More
                        <i class="fa-solid fa-chevron-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="min-w-[300px] bg-gradient-to-br from-white via-blue-50 to-indigo-50 p-6 rounded-2xl shadow-lg hover:shadow-lg transition-shadow">
                    <div class="bg-gray-100 rounded-full w-14 h-14 flex justify-center items-center text-[#4c63ce] shadow-xl mb-5">
                        <i class="fas fa-eye text-2xl"></i>
                    </div>
                    <h2 class="uppercase text-[#4c63ce] font-medium mb-3">Ophthalmology</h2>
                    <p class="text-gray-600 mb-3 text-sm">Complete eye care and vision services.</p><br><br>
                    <a class="text-[#4c63ce] flex items-center hover:text-[#3b4fa3] font-medium group" href="/">
                        Read More
                        <i class="fa-solid fa-chevron-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('servicesCarousel');
        const cards = carousel.children;
        const cardWidth = cards[0].offsetWidth + 24; // Including gap
        let currentIndex = 0;
        const originalLength = cards.length;
        let autoScrollInterval;

        // Clone cards for infinite scroll
        [...cards].forEach(card => {
            const clone = card.cloneNode(true);
            carousel.appendChild(clone);
        });

        function scrollToIndex(index) {
            carousel.style.transform = `translateX(-${index * cardWidth}px)`;
        }

        function nextSlide() {
            currentIndex++;
            carousel.style.transition = 'transform 0.5s ease-in-out';
            scrollToIndex(currentIndex);

            // Reset to start when reaching the end
            if (currentIndex >= originalLength) {
                setTimeout(() => {
                    carousel.style.transition = 'none';
                    currentIndex = 0;
                    scrollToIndex(currentIndex);
                }, 500);
            }
        }

        function prevSlide() {
            if (currentIndex <= 0) {
                carousel.style.transition = 'none';
                currentIndex = originalLength - 1;
                scrollToIndex(currentIndex + 1);
                setTimeout(() => {
                    carousel.style.transition = 'transform 0.5s ease-in-out';
                    scrollToIndex(currentIndex);
                }, 50);
            } else {
                currentIndex--;
                carousel.style.transition = 'transform 0.5s ease-in-out';
                scrollToIndex(currentIndex);
            }
        }

        function startAutoScroll() {
            autoScrollInterval = setInterval(nextSlide, 5000);
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');

        nextBtn.addEventListener('click', nextSlide);
        prevBtn.addEventListener('click', prevSlide);

        // Add hover events to stop/start auto scroll
        nextBtn.addEventListener('mouseenter', stopAutoScroll);
        nextBtn.addEventListener('mouseleave', startAutoScroll);
        prevBtn.addEventListener('mouseenter', stopAutoScroll);
        prevBtn.addEventListener('mouseleave', startAutoScroll);

        // Start auto scroll initially
        startAutoScroll();
    });
</script>
          <!-- Services Section end -->

    <!-- Health Data Section -->
    <section id="health-data" class="py-8 sm:py-16 bg-gradient-to-br from-white via-blue-50 to-indigo-50 rounded-2xl mx-4 sm:mx-20">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="text-center mb-8 sm:mb-12">
            <h1 class="text-[#4c63ce] font-medium text-base sm:text-lg mb-4">
                <i class="fa-solid fa-heart-pulse sm:mt-8 mr-2"></i>
                Your Health Stats
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto text-sm sm:text-base">Track your health metrics in real-time with Google Fit integration</p>
        </div>

        <!-- Setup Section -->
        <div id="setup-section" class="text-center mb-8">
            <button 
                id="authorize-button"
                onclick="tokenClient.requestAccessToken()"
                disabled
                class="relative inline-flex items-center justify-start px-4 sm:px-6 py-2 sm:py-3 overflow-hidden font-medium transition-all bg-[#4c63ce] rounded-full hover:bg-white group text-sm sm:text-base">
                <span class="w-48 h-48 rounded rotate-[-40deg] bg-[#3b4fa3] absolute bottom-0 left-0 -translate-x-full ease-out duration-500 transition-all translate-y-full mb-9 ml-9 group-hover:ml-0 group-hover:mb-32 group-hover:translate-x-0"></span>
                <span class="relative w-full text-left text-white transition-colors duration-300 ease-in-out group-hover:text-white flex items-center gap-2">
                    <i class="fas fa-link"></i>
                    Connect Google Fit
                </span>
            </button>
        </div>

        <!-- Data Section -->
        <div id="data-section" class="hidden">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-2">
                <!-- Steps Card -->
                <div class="bg-white p-3 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-8 h-8 bg-[#4c63ce]/10 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-shoe-prints text-[#4c63ce] text-base"></i>
                    </div>
                    <h3 class="text-xs sm:text-sm font-semibold mb-1">Daily Steps</h3>
                    <p id="steps-count" class="text-lg sm:text-xl font-bold text-[#4c63ce]">--</p>
                    <p class="text-gray-500 text-xs">steps today</p>
                </div>

                <!-- Heart Rate Card -->
                <div class="bg-white p-3 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-8 h-8 bg-[#4c63ce]/10 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-heartbeat text-[#4c63ce] text-base"></i>
                    </div>
                    <h3 class="text-xs sm:text-sm font-semibold mb-1">Heart Points</h3>
                    <p id="heart-rate" class="text-lg sm:text-xl font-bold text-[#4c63ce]">--</p>
                    <p class="text-gray-500 text-xs">Points</p>
                </div>

                <!-- Calories Card - Moved to center for mobile -->
                <div class="bg-white p-3 rounded-xl shadow-sm hover:shadow-md transition-shadow sm:col-start-auto col-start-1 col-span-2 sm:col-span-1">
                    <div class="w-8 h-8 bg-[#4c63ce]/10 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-fire text-[#4c63ce] text-base"></i>
                    </div>
                    <h3 class="text-xs sm:text-sm font-semibold mb-1">Calories</h3>
                    <p id="calories-burned" class="text-lg sm:text-xl font-bold text-[#4c63ce]">--</p>
                    <p class="text-gray-500 text-xs">kcal today</p>
                </div>

                <!-- Distance -->
                <div class="bg-white p-3 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-8 h-8 bg-[#4c63ce]/10 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-route text-[#4c63ce] text-base"></i>
                    </div>
                    <h3 class="text-xs sm:text-sm font-semibold mb-1">Distance</h3>
                    <p id="distance-traveled" class="text-lg sm:text-xl font-bold text-[#4c63ce]">--</p>
                    <p class="text-gray-500 text-xs">km</p>
                </div>

                <!-- Move Minutes -->
                <div class="bg-white p-3 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-8 h-8 bg-[#4c63ce]/10 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-walking text-[#4c63ce] text-base"></i>
                    </div>
                    <h3 class="text-xs sm:text-sm font-semibold mb-1">Move Time</h3>
                    <p id="move-minutes" class="text-lg sm:text-xl font-bold text-[#4c63ce]">--</p>
                    <p class="text-gray-500 text-xs">min</p>
                </div>
            </div>

            <!-- Refresh Button -->
            <div class="text-center mt-4">
                <button 
                    id="refresh-button"
                    onclick="fetchFitnessData()"
                    class="bg-[#4c63ce] text-white px-3 py-1.5 rounded-full hover:bg-[#3b4fa3] transition-colors inline-flex items-center gap-2 text-xs sm:text-sm">
                    <i class="fas fa-sync-alt"></i>
                    Refresh Data
                </button>
            </div>
        </div>
    </div>
    </section>
    <!-- Health Data Section end -->

    <!-- Contact Section -->
    <section id="contact" class="py-16">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-12">
            <h1 class="text-[#4c63ce] font-medium text-base sm:text-lg mb-4">
                <i class="fa-solid fa-stethoscope sm:mt-8 mr-2"></i>
                Get in Touch
            </h1>
                
                <p class="text-gray-600 max-w-2xl mx-auto">Have questions or need assistance? We're here to help. Reach out to us through any of the following channels or fill out the contact form below.</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Contact Info Cards -->
                <div class="flex-1">
                    <!-- Location Card -->
                    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-[0_10px_20px_rgba(76,99,206,0.7)] transition-shadow">
                        <div class="w-12 h-12 bg-[#4c63ce]/10 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-location-dot text-[#4c63ce] text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Our Location</h3>
                        <p class="text-gray-600">123 Medical Center Drive<br>Healthcare City, HC 12345</p>
                    </div>
                </div>

                <div class="flex-1">
                    <!-- Phone Card -->
                    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-[0_10px_20px_rgba(76,99,206,0.7)] transition-shadow">
                        <div class="w-12 h-12 bg-[#4c63ce]/10 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-phone text-[#4c63ce] text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Phone Number</h3>
                        <div class="flex items-center gap-2 mb-2">
                            <p class="text-gray-600">+917739864558</p>
                            <button onclick="copyToClipboard(this, '+917739864558')" class="text-[#4c63ce] hover:text-[#3b4fa3]">
                                <i class="fa-regular fa-clipboard"></i>
                            </button>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-gray-600">+919608606073</p>
                            <button onclick="copyToClipboard(this, '+919608606073')" class="text-[#4c63ce] hover:text-[#3b4fa3]">
                                <i class="fa-regular fa-clipboard"></i>
                            </button>
                        </div>
                        <script>
                            function copyToClipboard(button, text) {
                                navigator.clipboard.writeText(text).then(() => {
                                    const icon = button.querySelector('i');
                                    icon.classList.remove('fa-clipboard');
                                    icon.classList.add('fa-check');
                                    
                                    setTimeout(() => {
                                        icon.classList.remove('fa-check');
                                        icon.classList.add('fa-clipboard');
                                    }, 1000);
                                }).catch(err => {
                                    console.error('Failed to copy text: ', err);
                                });
                            }
                        </script>
                    </div>
                </div>

                <div class="flex-1">
                    <!-- Email Card -->
                    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-[0_10px_20px_rgba(76,99,206,0.7)] transition-shadow">
                        <div class="w-12 h-12 bg-[#4c63ce]/10 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-envelope text-[#4c63ce] text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Email Address</h3>
                        <p class="text-gray-600">info@medicenter.com<br>support@medicenter.com</p>
                    </div>
                </div>
            </div>

                <!-- Contact Form -->
                <!-- <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-8">
                    <form action="contact_process.php" method="POST" class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4c63ce] focus:border-transparent outline-none transition-all">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4c63ce] focus:border-transparent outline-none transition-all">
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4c63ce] focus:border-transparent outline-none transition-all">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea id="message" name="message" rows="4" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4c63ce] focus:border-transparent outline-none transition-all"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-[#4c63ce] text-white font-medium px-6 py-3 rounded-lg hover:bg-[#3b4fa3] transition-colors flex items-center justify-center gap-2">
                            <span>Send Message</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div> -->

            <!-- Map Section -->
            <div class="mt-12 rounded-xl overflow-hidden shadow-sm">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3406.9612243126247!2d75.70336037601191!3d31.37728905426814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a5a594d22b88d%3A0x4cc934c58d0992ec!2sLovely%20Professional%20University!5e0!3m2!1sen!2sin!4v1707634171317!5m2!1sen!2sin"
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include 'footer.php'; ?>
    
    <!-- Chatbot Icon and Chat Box -->
    <div class="fixed bottom-6 right-6 z-50 flex items-end gap-4 ">
        <!-- Ask Medibot Text -->
        <div id="medibot-text" class="bg-white rounded-lg px-4 py-2 shadow-lg animate-bounce mb-2">
            <p class="text-[#4c63ce] font-medium">Ask Medibot!</p>
        </div>

        <!-- Chat Box -->
        <div class="relative">
            <div id="chat-box" class="hidden opacity-0 bg-white rounded-lg shadow-xl w-[350px] h-[500px] absolute bottom-20 right-0 mb-2 overflow-hidden transition-opacity duration-300 ease-in-out">
                <!-- Chat Header -->
                <div class="bg-[#4c63ce] text-white p-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fa-regular fa-robot mr-2"></i>
                        <span class="font-medium">MEDI BOT</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <button onclick="shareChat()" class="hover:text-gray-200 flex items-center gap-1">
                            <i class="fas fa-share-alt"></i>
                        </button>
                        <button onclick="toggleChat()" class="hover:text-gray-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Chat Messages -->
                <div id="chat-messages" class="p-4 h-[380px] overflow-y-auto">
                    <div class="mb-4">
                        <div class="bg-gray-100 rounded-lg p-3 max-w-[80%] relative group">
                            <p>Hello I am Medi Bot! How can I assist you today?</p>
                            <button onclick="speakMessage(this.parentElement.querySelector('p').textContent)" 
                                class="absolute right-2 top-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-[#4c63ce] hover:text-[#3b4fa3] p-1 rounded-full hover:bg-gray-100">
                                <i class="fas fa-volume-up"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Chat Input -->
                <div class="border-t p-2">
                    <div class="flex gap-1">
                        <input type="text" id="chat-input" placeholder="Type your message..." 
                            class="flex border rounded-full px-2 py-2 focus:outline-none focus:border-[#4c63ce] " autocomplete="off" >

                        <label class="bg-[#4c63ce] text-white px-3 py-2 rounded-full hover:bg-[#3b4fa3] cursor-pointer">
                        <input type="file" class="hidden" id="photo-upload" accept="image/*" onchange="handlePhotoUpload(event)">
                        <i class="fa-solid fa-upload"></i>
                        </label>
                        <button onclick="startVoiceInput()" class="bg-[#4c63ce] text-white px-3 py-2 rounded-full hover:bg-[#3b4fa3]">
                            <i class="fas fa-microphone"></i>
                        </button>
                        <button onclick="sendMessage()" class="bg-[#4c63ce] text-white px-3 py-2 rounded-full hover:bg-[#3b4fa3]">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Chatbot Icon Button -->
            <button onclick="toggleChat(); document.getElementById('medibot-text').style.display='none';" class="bg-[#4c63ce] text-white p-4 rounded-full hover:bg-[#3b4fa3] transition-all duration-300 shadow-lg" id="chat-button">
                <i class="fa-solid fa-comments text-2xl transition-transform duration-300"></i>
            </button>
        </div>
    </div>

    

<script>
    
        // Number counting effect                 
        let count = 0;
        const target = 6500;
        const counter = document.getElementById('counter');
        const speed = 5; // Increased from 5 to 50 to slow down the counter
                            
        const updateCount = () => {
            const increment = Math.ceil(target / (1000 / speed));
            if(count < target) {
                count += increment;
                if(count > target) count = target;
                counter.innerText = count;
                setTimeout(updateCount, speed);
            }
        };
                            
        // Start animation when element comes into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    updateCount();
                    observer.unobserve(entry.target);
                }
            });
        });
        
        observer.observe(counter);


        // Mobile menu toggle
        function toggleMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuButton = document.querySelector('.lg\\:hidden');
            
            if (!mobileMenu.contains(event.target) && !menuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });

       // Chatbot functionality - Update the handlePhotoUpload function
        function handlePhotoUpload(event) {
            const file = event.target.files[0];
            if (file) {
                // Create a modal for image preview and text input
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                modal.innerHTML = `
                    <div class="bg-white p-4 rounded-lg w-[90%] max-w-lg">
                        <h3 class="text-lg font-medium mb-4">Add a question about this image</h3>
                        <img id="image-preview" class="max-h-48 mx-auto mb-4 rounded" src="">
                        <textarea id="image-question" 
                            class="w-full border rounded-lg p-2 mb-4 focus:outline-none focus:border-[#4c63ce]" 
                            placeholder="What would you like to ask about this image?"></textarea>
                        <div class="flex justify-end gap-2">
                            <button onclick="this.parentElement.parentElement.parentElement.remove()" 
                                class="px-4 py-2 text-gray-600 hover:text-gray-800">
                                Cancel
                            </button>
                            <button onclick="sendImageWithQuestion()" 
                                class="bg-[#4c63ce] text-white px-4 py-2 rounded-lg hover:bg-[#3b4fa3]">
                                Send
                            </button>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);

                // Preview the image
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                    // Store the base64 data globally for later use
                    window.currentImageData = e.target.result;
                }
                reader.readAsDataURL(file);
            }
            // Reset file input
            event.target.value = '';
        }

        // Add new function to send image with question
        async function sendImageWithQuestion() {
                const question = document.getElementById('image-question').value.trim();
                const imageData = window.currentImageData;
                const messagesContainer = document.getElementById('chat-messages');

                if (!question) {
                    alert('Please add a question about the image.');
                    return;
                }

                // Remove the modal
                document.querySelector('.fixed.inset-0').remove();

                // Add user message with image and question
                const userMessage = `
                    <div class="mb-4 flex justify-end">
                        <div class="bg-[#4c63ce] text-white rounded-lg p-3 max-w-[80%]">
                            <img src="${imageData}" alt="Uploaded Image" class="max-w-full rounded mb-2">
                            <p>${question}</p>
                        </div>
                    </div>
                `;
                messagesContainer.innerHTML += userMessage;
                scrollToBottom(messagesContainer);

                // Show loading indicator
                const loadingMessage = `
                    <div class="mb-4" id="loading-message">
                        <div class="rounded-lg p-3 max-w-[80%] flex items-center">
                            <div class="animate-pulse">Analyzing image and question...</div>
                        </div>
                    </div>
                `;
                messagesContainer.innerHTML += loadingMessage;
                scrollToBottom(messagesContainer);

                try {
                    // Extract base64 image data (remove data:image/xyz;base64, prefix)
                    const base64Image = imageData.split(',')[1];
                    
                    // Create the request payload
                    const payload = {
                        message: question,
                        image: base64Image,
                        type: 'image_query' // Add a type identifier for the backend
                    };


                    const response = await fetch('http://localhost:5000/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await response.json();

                    // Remove loading message
                    const loadingElement = document.getElementById('loading-message');
                    if (loadingElement) {
                        loadingElement.remove();
                    }

                    // Add AI response with typing effect
                    const messageId = 'ai-message-' + Date.now();
                    // In both sendMessage and sendImageWithQuestion functions, replace the aiResponse template with:
                    const aiResponse = 
                        `<div class="mb-4">
                            <div class="bg-gray-100 rounded-lg p-3 max-w-[80%] relative group">
                                <p id="${messageId}" class="typing-effect pr-8"></p>
                                <button onclick="speakMessage(this.parentElement.querySelector('p').textContent)" 
                                    class="absolute right-2 top-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-[#4c63ce] hover:text-[#3b4fa3] p-1 rounded-full hover:bg-gray-100">
                                    <i class="fas fa-volume-up"></i>
                                </button>
                            <button onclick="copyToClipboard(this, this.parentElement.querySelector('p').textContent)" class="text-gray-800 hover:text-[#3b4fa3]">
                                <i class="fa-light fa-copy"></i>
                            </button>
                            </div>
                        </div>
                    `;

                    messagesContainer.insertAdjacentHTML('beforeend', aiResponse);
                    scrollToBottom(messagesContainer);

                    // Animate typing effect
                    setTimeout(() => {
                        const text = data.response;
                        const element = document.getElementById(messageId);
                        let index = 0;
                        
                        function type() {
                            if (index < text.length) {
                                element.textContent += text.charAt(index);
                                index++;
                                setTimeout(type, 20);
                                scrollToBottom(messagesContainer);
                            }
                        }
                        type();
                    }, 100);

                } catch (error) {
                    console.error('Error:', error);
                    const errorMessage = `
                        <div class="mb-4">
                            <div class="bg-red-100 text-red-700 rounded-lg p-3 max-w-[80%]">
                                <p>Sorry, there was an error processing your image and question.</p>
                            </div>
                        </div>
                    `;
                    messagesContainer.innerHTML += errorMessage;
                    scrollToBottom(messagesContainer);
                }
        }

        function toggleChat() {
            const chatBox = document.getElementById('chat-box');
            const chatButton = document.getElementById('chat-button');
            const icon = chatButton.querySelector('i');
            
            if (chatBox.classList.contains('hidden')) {
                chatBox.classList.remove('hidden');
                // Trigger reflow to ensure transition works
                void chatBox.offsetWidth;
                chatBox.classList.remove('opacity-0');
                
                // Change icon to times/cross with rotation
                icon.classList.remove('fa-comment-dots');
                icon.classList.add('fa-times');
                chatButton.style.transform = 'rotate(180deg)';
            } else {
                chatBox.classList.add('opacity-0');
                
                // Change icon back to comment-dots with rotation
                icon.classList.remove('fa-times');
                icon.classList.add('fa-comment-dots');
                chatButton.style.transform = 'rotate(0deg)';
                
                // Wait for animation to finish before hiding
                setTimeout(() => {
                    chatBox.classList.add('hidden');
                }, 300);
            }
        }

        async function sendMessage() {
            const input = document.getElementById('chat-input');
            const message = input.value.trim();
            const messagesContainer = document.getElementById('chat-messages');
            
            if (message) {
                // Add user message
                const userMessage = `
                    <div class="mb-4 flex justify-end">
                        <div class="bg-[#4c63ce] text-white rounded-lg p-3 max-w-[80%]">
                            <p>${message}</p>
                        </div>
                    </div>
                `;
                
                messagesContainer.innerHTML += userMessage;
                
                // Clear input and scroll to bottom immediately after user message
                input.value = '';
                scrollToBottom(messagesContainer);

                try {
                    // Show loading indicator
                    const loadingMessage = `
                        <div class="mb-4" id="loading-message">
                            <div class="rounded-lg p-3 max-w-[80%] flex items-center">
                                <div class="animate-pulse">Thinking...</div>
                            </div>
                        </div>
                    `;
                    messagesContainer.innerHTML += loadingMessage;
                    scrollToBottom(messagesContainer);

                    // Make API call to your backend
                    const response = await fetch('http://localhost:5000/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ message: message })
                    });

                    const data = await response.json();

                    // Remove loading message
                    const loadingElement = document.getElementById('loading-message');
                    if (loadingElement) {
                        loadingElement.remove();
                    }

                    // Add AI response
                    const messageId = 'ai-message-' + Date.now();

                    // In both sendMessage and sendImageWithQuestion functions, replace the aiResponse template with:
                    const aiResponse = `
                        <div class="mb-4">
                            <div class="bg-gray-100 rounded-lg p-3 max-w-[80%] relative group">
                                <p id="${messageId}" class="typing-effect pr-8"></p>
                                <button onclick="speakMessage(this.parentElement.querySelector('p').textContent)" 
                                    class="absolute right-2 top-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-[#4c63ce] hover:text-[#3b4fa3] p-1 rounded-full hover:bg-gray-100">
                                    <i class="fas fa-volume-up"></i>
                                </button>
                            <button onclick="copyToClipboard(this, this.parentElement.querySelector('p').textContent)" class="text-gray-800 hover:text-[#3b4fa3]">
                                <i class="fas fa-copy"></i>
                            </button>
                            </div>
                        </div>
                    `;

                    messagesContainer.insertAdjacentHTML('beforeend', aiResponse);
                    scrollToBottom(messagesContainer);

                    // Rest of your typing animation code remains the same
                    setTimeout(() => {
                        const text = data.response;
                        const element = document.getElementById(messageId);
                        let index = 0;
                        
                        function type() {
                            if (index < text.length) {
                                element.textContent += text.charAt(index);
                                index++;
                                setTimeout(type, 20);
                                scrollToBottom(messagesContainer);
                            }
                        }
                        
                        type();
                    }, 100);
                    

                } catch (error) {
                    console.error('Error:', error);
                    // Show error message in chat
                    const errorMessage = `
                        <div class="mb-4">
                            <div class="bg-red-100 text-red-700 rounded-lg p-3 max-w-[80%]">
                                <p>Sorry, there was an error processing your message.</p>
                            </div>
                        </div>
                    `;
                    messagesContainer.innerHTML += errorMessage;
                    scrollToBottom(messagesContainer);
                }
            }
        }

        // Add this new function for smooth scrolling
        function scrollToBottom(element) {
            element.scrollTop = element.scrollHeight;
        }

        // Allow sending message with Enter key
        document.getElementById('chat-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Add this new function for smooth section scrolling
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            const navHeight = document.querySelector('nav').offsetHeight; // Get navigation height
            
            if (section) {
                const targetPosition = section.offsetTop - navHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Close mobile menu if it's open
                const mobileMenu = document.getElementById('mobile-menu');
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        }

        // Also update your mobile menu items to use the scrollToSection function
        document.querySelectorAll('#mobile-menu li').forEach(item => {
            item.addEventListener('click', function() {
                const sectionId = this.textContent.toLowerCase().replace(/\s+/g, '');
                scrollToSection(sectionId);
            });
        });

        function startVoiceInput() {
            // Check if browser supports speech recognition
            if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
                const SpeechRecognition = window.webkitSpeechRecognition || window.SpeechRecognition;
                const recognition = new SpeechRecognition();
                
                // Configure recognition settings
                recognition.lang = 'en-US';
                recognition.continuous = false;
                recognition.interimResults = false;

                // Get UI elements
                const chatInput = document.getElementById('chat-input');
                const micButton = document.querySelector('button[onclick="startVoiceInput()"]');
                
                // Change mic button to indicate recording
                micButton.innerHTML = '<i class="fas fa-microphone-slash text-red-500"></i>';
                micButton.classList.add('animate-pulse');

                // Start listening
                recognition.start();

                // Handle results
                recognition.onresult = (event) => {
                    const transcript = event.results[0][0].transcript;
                    chatInput.value = transcript;
                    
                    // Optional: Automatically send message after voice input
                    sendMessage();
                };

                // Handle end of speech recognition
                recognition.onend = () => {
                    // Reset mic button
                    micButton.innerHTML = '<i class="fas fa-microphone"></i>';
                    micButton.classList.remove('animate-pulse');
                };

                // Handle errors
                recognition.onerror = (event) => {
                    console.error('Speech recognition error:', event.error);
                    // Reset mic button
                    micButton.innerHTML = '<i class="fas fa-microphone"></i>';
                    micButton.classList.remove('animate-pulse');
                    
                    // Show error message in chat
                    const messagesContainer = document.getElementById('chat-messages');
                    const errorMessage = `
                        <div class="mb-4">
                            <div class="bg-red-100 text-red-700 rounded-lg p-3 max-w-[80%]">
                                <p>Sorry, there was an error with voice recognition. Please try again.</p>
                            </div>
                        </div>
                    `;
                    messagesContainer.innerHTML += errorMessage;
                    scrollToBottom(messagesContainer);
                };

            } else {
                // Browser doesn't support speech recognition
                alert('Sorry, your browser does not support voice input. Please try using a modern browser like Chrome.');
            }
        }

        // Add these CSS styles for the animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pulse {
                0% { opacity: 1; }
                50% { opacity: 0.5; }
                100% { opacity: 1; }
            }
            .animate-pulse {
                animation: pulse 1s infinite;
            }
        `;
        document.head.appendChild(style);

        // Get the menu button and its spans
        const menuBtn = document.getElementById('menuButton');
        let isOpen = false;

        // Function to toggle the menu for small devices
        function toggleMenu() {
                const spans = menuBtn.getElementsByTagName('span');
                isOpen = !isOpen;
                
                if (isOpen) {
                    spans[0].style.top = '50%';
                    spans[0].style.transform = 'translate(-50%, -50%) rotate(45deg)';
                    spans[1].style.opacity = '0';
                    spans[2].style.top = '50%';
                    spans[2].style.transform = 'translate(-50%, -50%) rotate(-45deg)';
                } else {
                    spans[0].style.top = '25%';
                    spans[0].style.transform = 'translate(-50%, 0)';
                    spans[1].style.opacity = '1';
                    spans[2].style.top = '75%';
                    spans[2].style.transform = 'translate(-50%, 0)';
                }

                document.getElementById('mobile-menu').classList.toggle('hidden');
        }

        // Add this function at the bottom of your script section
        function speakMessage(text) {
                // Stop any ongoing speech first
                speechSynthesis.cancel();

                // Get the button that was clicked
                const button = event.currentTarget;
                const icon = button.querySelector('i');

                // Create new utterance
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'en-US';
                
                // Get available voices and set a female voice
                const voices = window.speechSynthesis.getVoices();
                const femaleVoice = voices.find(voice => 
                    voice.name.includes('Female') || 
                    voice.name.includes('female') || 
                    voice.name.includes('Samantha') ||
                    voice.name.includes('Microsoft Zira')
                );
                
                if (femaleVoice) {
                    utterance.voice = femaleVoice;
                }
                
                utterance.pitch = 1.2;

                // Change icon to stop icon while speaking
                icon.classList.remove('fa-volume-up');
                icon.classList.add('fa-volume-mute');
                
                // Add click handler to stop speech
                button.onclick = () => {
                    speechSynthesis.cancel();
                    icon.classList.remove('fa-volume-mute');
                    icon.classList.add('fa-volume-up');
                    // Reset click handler
                    button.onclick = () => speakMessage(text);
                };

                // When speech ends naturally
                utterance.onend = () => {
                    icon.classList.remove('fa-volume-mute');
                    icon.classList.add('fa-volume-up');
                    // Reset click handler
                    button.onclick = () => speakMessage(text);
                };
                
                speechSynthesis.speak(utterance);
        }

        //book ambulance
        function bookAmbulance() {
                    if (confirm('Do you need an emergency ambulance at your current location? Click OK to confirm booking.')) {
                        // Get current location
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(
                                // Success callback
                                (position) => {
                                    const latitude = position.coords.latitude;
                                    const longitude = position.coords.longitude;
                                    
                                    // Get address from coordinates using reverse geocoding
                                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
                                    .then(response => response.json())
                                    .then(locationData => {
                                        const address = locationData.display_name;
                                        
                                        // Send location data to server
                                        fetch('book_ambulance.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify({
                                                latitude: latitude,
                                                longitude: longitude,
                                                address: address
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                alert(`Ambulance booked successfully!\nVehicle: ${data.vehicle_number} (${data.model})\nEstimated arrival time: 15-20 minutes\nYour location: ${address}`);
                                            } else {
                                                alert(data.message || 'Failed to book ambulance. Please try again.');
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('An error occurred while booking the ambulance');
                                        });
                                    })
                                    .catch(error => {
                                        console.error('Error getting address:', error);
                                        // Fallback to coordinates if address lookup fails
                                        alert(`Unable to get address. Using coordinates: ${latitude}, ${longitude}`);
                                    });
                                },
                                // Error callback
                                (error) => {
                                    console.error('Geolocation error:', error);
                                    alert('Unable to get your location. Please enable location services and try again.');
                                }
                            );
                        } else {
                            alert('Geolocation is not supported by your browser. Please use a modern browser or manually provide your location.');
                        }
                    }
        }
    
        // Initialize Google Connect API    
        document.addEventListener('DOMContentLoaded', function() {
        initializeGoogleApi();
        });

        // Update the shareChat function
        function shareChat() {
            // Add debugging information
            const baseUrl = window.location.pathname.split('/').slice(0, -1).join('/');
            console.log('Base URL:', baseUrl);
            console.log('Origin:', window.location.origin);
            console.log('Full path:', window.location.pathname);
            
            const messagesContainer = document.getElementById('chat-messages');
            const messages = [];
            
            // Check if there are any messages to share
            const messageElements = messagesContainer.querySelectorAll('.mb-4');
            if (messageElements.length <= 1) { // 1 because of the initial bot greeting
                const errorMessage = `
                    <div class="mb-4">
                        <div class="bg-red-100 text-red-700 rounded-lg p-3 max-w-[80%]">
                            <p>Please have a conversation first before sharing.</p>
                        </div>
                    </div>
                `;
                messagesContainer.innerHTML += errorMessage;
                scrollToBottom(messagesContainer);
                return;
            }
            
            // Show loading state
            const loadingMessage = `
                <div class="mb-4" id="sharing-loading">
                    <div class="bg-gray-100 rounded-lg p-3 max-w-[80%] flex items-center gap-2">
                        <i class="fas fa-spinner fa-spin text-[#4c63ce]"></i>
                        <p>Generating share link...</p>
                    </div>
                </div>
            `;
            messagesContainer.innerHTML += loadingMessage;
            scrollToBottom(messagesContainer);
            
            // Extract messages
            messageElements.forEach(messageDiv => {
                const messageContent = messageDiv.querySelector('p')?.textContent;
                const isUser = messageDiv.querySelector('.bg-\\[\\#4c63ce\\]') !== null;
                
                if (messageContent && !messageContent.includes('Generating share link...')) {
                    messages.push({
                        content: messageContent,
                        type: isUser ? 'user' : 'bot'
                    });
                }
            });
            
            // Generate conversation ID
            const conversationId = Date.now() + '-' + Math.random().toString(36).substr(2, 9);
            
            // Save conversation
            fetch('save_conversation.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: conversationId,
                    messages: messages
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                // Remove loading message
                const loadingElement = document.getElementById('sharing-loading');
                if (loadingElement) {
                    loadingElement.remove();
                }

                if (data.success) {
                    // Create shareable link with correct path
                    const shareLink = `${window.location.origin}${baseUrl}/shared_chat.php?id=${conversationId}`;
                    
                    // Copy to clipboard
                    navigator.clipboard.writeText(shareLink).then(() => {
                        const successMessage = `
                            <div class="mb-4">
                                <div class="bg-green-100 text-green-700 rounded-lg p-3 max-w-[80%]">
                                    <p class="mb-2">Chat link copied to clipboard! You can now share it with others.</p>
                                    <div class="text-sm break-all">
                                        <span class="font-medium">Link:</span> 
                                        <a href="${shareLink}" target="_blank" class="underline hover:text-[#4c63ce] break-all">${shareLink}</a>
                                    </div>
                                </div>
                            </div>
                        `;
                        messagesContainer.innerHTML += successMessage;
                        scrollToBottom(messagesContainer);
                    }).catch(err => {
                        console.error('Clipboard error:', err);
                        // Fallback for clipboard API failure
                        const successMessage = `
                            <div class="mb-4">
                                <div class="bg-green-100 text-green-700 rounded-lg p-3 max-w-[80%]">
                                    <p class="mb-2">Chat shared successfully! Here's your link:</p>
                                    <div class="text-sm break-all">
                                        <span class="font-medium">Link:</span>
                                        <a href="${shareLink}" target="_blank" class="underline hover:text-[#4c63ce] break-all">${shareLink}</a>
                                    </div>
                                </div>
                            </div>
                        `;
                        messagesContainer.innerHTML += successMessage;
                        scrollToBottom(messagesContainer);
                    });
                } else {
                    throw new Error(data.message || 'Failed to save conversation');
                }
            })
            .catch(error => {
                // Remove loading message
                const loadingElement = document.getElementById('sharing-loading');
                if (loadingElement) {
                    loadingElement.remove();
                }

                console.error('Error:', error);
                const errorMessage = `
                    <div class="mb-4">
                        <div class="bg-red-100 text-red-700 rounded-lg p-3 max-w-[80%]">
                            <p>Error sharing chat: ${error.message || 'Please try again later.'}</p>
                        </div>
                    </div>
                `;
                messagesContainer.innerHTML += errorMessage;
                scrollToBottom(messagesContainer);
            });
        }

</script>

</body>
</html>