<?php 
session_start(); 
include '../config/db.php';



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto mt-12">
        <div class="bg-white shadow-md rounded-lg p-8 max-w-lg mx-auto">
            <h2 class="text-3xl font-bold mb-6">Login</h2>

            <form action="dashboard.php" method="POST">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" placeholder="Enter your email" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">

                <label class="block text-sm font-medium text-gray-700 mt-4">Password</label>
                <input type="password" name="password" placeholder="Enter your password" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">

                <button type="submit" class="bg-blue-500 text-white w-full p-3 mt-6 rounded-lg hover:bg-blue-600 transition">Login</button>
            </form>

            <p class="text-center text-sm mt-4">
                Don't have an account? <a href="register.php" class="text-blue-500 hover:underline">Register</a>
            </p>
        </div>
    </div>

</body>

</html>