<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom Scheduling - PRMSU</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- 🌟 Navbar -->
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-lg font-bold">PRMSU Scheduling</a>
            <div>
                <a href="./auth/login.php" class="ml-4 hover:underline">Login</a>
                <a href="./auth/register.php" class="ml-4 hover:underline">Register</a>
            </div>
        </div>
    </nav>

    <!-- 🌟 Hero Section -->
    <div class="container mx-auto mt-12 text-center">
        <h1 class="text-4xl font-bold mb-6">Welcome to PRMSU Classroom Scheduling System</h1>
        <p class="text-lg text-gray-600 mb-8">Manage classroom schedules efficiently and professionally.</p>
        <a href="./auth/login.php" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition">Login</a>
        <a href="./auth/register.php" class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600 transition">Register</a>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-12">
        &copy; <?= date('Y') ?> PRMSU Zambales | All Rights Reserved
    </footer>

</body>

</html>