<?php
session_start();
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];  // Admin, Chair, Dean

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password_hash, role_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $email, $hashed_password, $role_id]);

    header("Location: ./auth/login.php");
    exit();
};

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto mt-12">
        <div class="bg-white shadow-md rounded-lg p-8 max-w-lg mx-auto">
            <h2 class="text-3xl font-bold mb-6">Register</h2>

            <form action="register_handler.php" method="POST">
                <label class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">

                <label class="block text-sm font-medium text-gray-700 mt-4">Last Name</label>
                <input type="text" name="last_name" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">

                <label class="block text-sm font-medium text-gray-700 mt-4">Email</label>
                <input type="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">

                <label class="block text-sm font-medium text-gray-700 mt-4">Password</label>
                <input type="password" name="password" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">

                <label class="block text-sm font-medium text-gray-700 mt-4">Role</label>
                <select name="role_id" required class="w-full p-3 border border-gray-300 rounded-lg">
                    <option value="1">Admin</option>
                    <option value="2">Chair</option>
                    <option value="3">Dean</option>
                </select>

                <button type="submit" class="bg-green-500 text-white w-full p-3 mt-6 rounded-lg hover:bg-green-600 transition">Register</button>
            </form>

            <p class="text-center text-sm mt-4">
                Already have an account? <a href="./login.php" class="text-blue-500 hover:underline">Login</a>
            </p>
        </div>
    </div>

</body>

</html>