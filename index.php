<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRMSU Classroom Scheduling System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body class="bg-[#0033a0] text-white min-h-screen flex flex-col">

    <!-- 🌟 Navbar -->
    <nav class="bg-[#0033a0] text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center space-x-3">
                <!-- Logo -->
                <img src="./assets/logo/prmsu.png" alt="PRMSU Logo" class="w-12 h-12">
                <a href="index.php" class="text-2xl font-bold hover:text-[#e3b23c] transition">PRMSU Scheduling</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="./module/auth/login.php" class="text-lg hover:text-[#e3b23c] transition">Login</a>
                <a href="./module/auth/register.php" class="text-lg hover:text-[#e3b23c] transition">Register</a>
            </div>
        </div>
    </nav>

    <!-- 🌟 Hero Section -->
    <header class="flex-1 bg-[#0033a0] py-20">
        <div class="container mx-auto text-center">
            <h1 class="text-5xl font-bold text-[#e3b23c] mb-6">Welcome to PRMSU Classroom Scheduling System</h1>
            <p class="text-lg text-[#ffffff] mb-10">
                Manage classroom schedules efficiently and professionally with real-time updates.
            </p>

            <div class="flex justify-center space-x-6">
                <a href="./module/auth/login.php"
                    class="bg-[#e3b23c] text-[#2d2d2d] px-10 py-4 rounded-lg shadow-lg hover:bg-[#b68d40] transition">
                    Login
                </a>
                <a href="./module/auth/register.php"
                    class="bg-[#b68d40] text-[#2d2d2d] px-10 py-4 rounded-lg shadow-lg hover:bg-[#e3b23c] transition">
                    Register
                </a>
            </div>
        </div>
    </header>

    <!-- 🌟 Features Section -->
    <section class="container mx-auto py-20">
        <div class="grid md:grid-cols-3 gap-12 text-center">
            <!-- Feature 1 -->
            <div class="bg-[#ffffff] text-[#2d2d2d] p-10 rounded-lg shadow-lg hover:shadow-xl transition">
                <img src="./assets/images/calendar-icon.png" alt="Calendar Icon" class="w-20 h-20 mx-auto mb-6">
                <h3 class="text-3xl font-bold text-[#0033a0]">Efficient Scheduling</h3>
                <p class="text-lg mt-4">
                    Create, edit, and manage schedules seamlessly with real-time updates.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-[#ffffff] text-[#2d2d2d] p-10 rounded-lg shadow-lg hover:shadow-xl transition">
                <img src="./assets/images/security-icon.png" alt="Security Icon" class="w-20 h-20 mx-auto mb-6">
                <h3 class="text-3xl font-bold text-[#0033a0]">Secure System</h3>
                <p class="text-lg mt-4">
                    Data encryption and secure authentication for all users.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-[#ffffff] text-[#2d2d2d] p-10 rounded-lg shadow-lg hover:shadow-xl transition">
                <img src="./assets/images/analytics-icon.png" alt="Analytics Icon" class="w-20 h-20 mx-auto mb-6">
                <h3 class="text-3xl font-bold text-[#0033a0]">Analytics & Reports</h3>
                <p class="text-lg mt-4">
                    Generate reports on classroom usage and faculty loads.
                </p>
            </div>
        </div>
    </section>

    <!-- 🌟 Footer -->
    <footer class="bg-[#2d2d2d] text-white text-center py-6 mt-auto">
        <p>&copy; <?= date('Y') ?> PRMSU Zambales | All Rights Reserved</p>
    </footer>

</body>

</html>