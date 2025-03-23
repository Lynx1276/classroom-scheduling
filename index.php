<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRMSU Classroom Scheduling System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.5/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #0033a0 0%, #001e5c 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
        }

        .btn-primary {
            background: linear-gradient(to right, #e3b23c, #b68d40);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar with glass effect -->
    <nav class="bg-[#0033a0] text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto flex justify-between items-center py-3 px-6 md:px-10">
            <div class="flex items-center space-x-3">
                <img src="./assets/logo/prmsu.png" alt="PRMSU Logo" class="w-12 h-12">
                <a href="index.php" class="text-xl md:text-2xl font-bold hover:text-[#e3b23c] transition">
                    PRMSU <span class="hidden md:inline">Classroom Scheduling</span>
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden" x-data="{ open: false }">
                <button @click="open = !open" class="text-white focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>

                <!-- Mobile menu -->
                <div x-show="open" @click.away="open = false" class="absolute top-full right-0 w-full bg-[#0033a0] shadow-xl rounded-b-lg py-4 px-6">
                    <a href="./module/auth/login.php" class="block py-2 text-lg hover:text-[#e3b23c] transition">Login</a>
                    <a href="./module/auth/register.php" class="block py-2 text-lg hover:text-[#e3b23c] transition">Register</a>
                </div>
            </div>

            <!-- Desktop menu -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="./module/auth/login.php" class="text-lg hover:text-[#e3b23c] transition flex items-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
                <a href="./module/auth/register.php" class="bg-[#e3b23c] text-[#0033a0] font-medium px-5 py-2 rounded-full hover:bg-[#b68d40] transition shadow-md">
                    Register
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Animation -->
    <header class="gradient-bg py-16 md:py-28">
        <div class="container mx-auto grid md:grid-cols-2 gap-10 items-center px-6 md:px-10">
            <div class="text-left">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                    <span class="text-[#e3b23c]">Simplify</span> Classroom Scheduling
                </h1>
                <p class="text-lg md:text-xl text-gray-100 opacity-90 mb-8 max-w-lg">
                    Manage classroom schedules efficiently with our intuitive platform designed for PRMSU administrators, faculty, and students.
                </p>

                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="./module/auth/login.php" class="btn-primary text-center font-semibold px-8 py-3 rounded-lg shadow-lg hover:shadow-xl transition inline-flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i> Get Started
                    </a>
                    <a href="#features" class="btn-secondary text-center text-white font-medium px-8 py-3 rounded-lg shadow hover:shadow-lg transition inline-flex items-center justify-center">
                        <i class="fas fa-info-circle mr-2"></i> Learn More
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <img src="/api/placeholder/600/400" alt="Scheduling Interface" class="rounded-xl shadow-2xl animate-float">
            </div>
        </div>
    </header>

    <!-- Stats Section -->
    <section class="bg-white py-10">
        <div class="container mx-auto px-6 md:px-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="p-5">
                    <h3 class="text-3xl md:text-4xl font-bold text-[#0033a0]">100+</h3>
                    <p class="text-gray-600">Classrooms Managed</p>
                </div>
                <div class="p-5">
                    <h3 class="text-3xl md:text-4xl font-bold text-[#0033a0]">500+</h3>
                    <p class="text-gray-600">Faculty Users</p>
                </div>
                <div class="p-5">
                    <h3 class="text-3xl md:text-4xl font-bold text-[#0033a0]">1000+</h3>
                    <p class="text-gray-600">Classes Scheduled</p>
                </div>
                <div class="p-5">
                    <h3 class="text-3xl md:text-4xl font-bold text-[#0033a0]">24/7</h3>
                    <p class="text-gray-600">System Availability</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section with Cards -->
    <section id="features" class="container mx-auto py-16 px-6 md:px-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-[#0033a0] mb-4">Powerful Features</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Our scheduling system provides everything you need to manage classroom resources effectively.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white rounded-xl shadow-lg p-8 card-hover border-t-4 border-[#0033a0]">
                <div class="w-16 h-16 bg-[#0033a0] rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="fas fa-calendar-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#0033a0] mb-4 text-center">Smart Scheduling</h3>
                <p class="text-gray-600 mb-4">
                    Create conflict-free schedules with our intelligent algorithm that optimizes classroom usage.
                </p>
                <ul class="text-gray-600 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Drag-and-drop interface</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Automated conflict detection</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Real-time updates</span>
                    </li>
                </ul>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white rounded-xl shadow-lg p-8 card-hover border-t-4 border-[#e3b23c]">
                <div class="w-16 h-16 bg-[#e3b23c] rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="fas fa-lock text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#0033a0] mb-4 text-center">Secure Access</h3>
                <p class="text-gray-600 mb-4">
                    Role-based access control ensures only authorized personnel can make schedule changes.
                </p>
                <ul class="text-gray-600 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Administrator oversight</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Faculty scheduling rights</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Data encryption</span>
                    </li>
                </ul>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white rounded-xl shadow-lg p-8 card-hover border-t-4 border-[#0033a0]">
                <div class="w-16 h-16 bg-[#0033a0] rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="fas fa-chart-bar text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#0033a0] mb-4 text-center">Advanced Analytics</h3>
                <p class="text-gray-600 mb-4">
                    Gain insights into room utilization and optimize resource allocation with detailed reports.
                </p>
                <ul class="text-gray-600 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Utilization metrics</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Faculty workload reports</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Exportable data (PDF, Excel)</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="gradient-bg py-16">
        <div class="container mx-auto px-6 md:px-10 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-12">What Our Users Say</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-center mb-4">
                        <div class="text-[#e3b23c]">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"This system has completely transformed how we manage classroom schedules. It's intuitive and saves us hours of work each week."</p>
                    <div>
                        <p class="font-semibold text-[#0033a0]">Dr. Maria Santos</p>
                        <p class="text-sm text-gray-500">Department Chair, Engineering</p>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-center mb-4">
                        <div class="text-[#e3b23c]">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"The analytics feature helps us identify underutilized spaces and make better decisions about our classroom resources."</p>
                    <div>
                        <p class="font-semibold text-[#0033a0]">Prof. James Rodriguez</p>
                        <p class="text-sm text-gray-500">Resource Management Officer</p>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-center mb-4">
                        <div class="text-[#e3b23c]">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"As a faculty member, I appreciate being able to check room availability instantly and request changes when needed."</p>
                    <div>
                        <p class="font-semibold text-[#0033a0]">Dr. Anna Cruz</p>
                        <p class="text-sm text-gray-500">Professor, Science Department</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-6 md:px-10 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#0033a0] mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Join the PRMSU community in streamlining classroom scheduling today.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="./module/auth/login.php" class="bg-[#0033a0] text-white px-8 py-3 rounded-lg shadow-lg hover:bg-[#00297f] transition inline-flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
                <a href="./module/auth/register.php" class="bg-[#e3b23c] text-[#0033a0] px-8 py-3 rounded-lg shadow-lg hover:bg-[#b68d40] transition inline-flex items-center justify-center">
                    <i class="fas fa-user-plus mr-2"></i> Create Account
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#0033a0] text-white py-12 mt-auto">
        <div class="container mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="./assets/logo/prmsu.png" alt="PRMSU Logo" class="w-10 h-10">
                        <span class="text-xl font-bold">PRMSU</span>
                    </div>
                    <p class="text-gray-300">
                        President Ramon Magsaysay State University
                        <br>Iba, Zambales
                    </p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-[#e3b23c]">Home</a></li>
                        <li><a href="#features" class="text-gray-300 hover:text-[#e3b23c]">Features</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-[#e3b23c]">About</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-[#e3b23c]">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-[#e3b23c]">User Guide</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-[#e3b23c]">FAQ</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-[#e3b23c]">Support</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-[#e3b23c]">Privacy Policy</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Connect With Us</h4>
                    <div class="flex space-x-4 mb-4">
                        <a href="#" class="bg-white bg-opacity-20 w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#e3b23c] transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-white bg-opacity-20 w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#e3b23c] transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-white bg-opacity-20 w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#e3b23c] transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                    <p class="text-gray-300">Email: info@prmsu.edu.ph</p>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-10 pt-6 text-center text-gray-300">
                <p>&copy; <?= date('Y') ?> PRMSU Zambales | All Rights Reserved</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="toTop" class="fixed bottom-6 right-6 bg-[#e3b23c] text-[#0033a0] w-12 h-12 rounded-full shadow-lg flex items-center justify-center opacity-0 transition-opacity duration-300">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Simple JavaScript for scroll-to-top functionality -->
    <script>
        // Scroll to top button
        const toTopButton = document.getElementById('toTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                toTopButton.classList.remove('opacity-0');
                toTopButton.classList.add('opacity-100');
            } else {
                toTopButton.classList.remove('opacity-100');
                toTopButton.classList.add('opacity-0');
            }
        });

        toTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>