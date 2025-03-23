<?php
session_start();
require '../../config/database.php';

$db = new Database();
$conn = $db->connect();

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Check for user existence
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id'];

            // Redirect based on role
            switch ($user['role_id']) {
                case 2:
                    header('Location: ../dashboard/dean.php');
                    break;
                case 3:
                    header('Location: ../dashboard/chair.php');
                    break;
                case 4:
                    header('Location: ../dashboard/faculty.php');
                    break;
                default:
                    header('Location: ../dashboard/index.php');
                    break;
            }
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Academic Portal</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/auth.css">
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    <div class="login-container bg-white rounded-xl shadow-xl overflow-hidden max-w-md w-full">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Academic Portal</h1>
                <i class="fas fa-graduation-cap text-2xl"></i>
            </div>
            <p class="mt-1 text-blue-100">Sign in to access your dashboard</p>
        </div>

        <div class="p-8">
            <?php if (!empty($error)) : ?>
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded flex items-center" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="space-y-6">
                <div class="input-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="username">
                        Username
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                            <i class="fas fa-user"></i>
                        </div>
                        <input type="text" id="username" name="username"
                            class="pl-10 w-full py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="Enter your username" required>
                    </div>
                </div>

                <div class="input-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="password">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" id="password" name="password"
                            class="pl-10 w-full py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="Enter your password" required>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Remember me
                    </label>
                </div>

                <button type="submit"
                    class="w-full flex justify-center items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-3 px-4 rounded-lg font-medium shadow-md hover:shadow-lg transform transition-all duration-200 hover:-translate-y-1">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center text-sm">
                <a href="forgot-password.php" class="text-blue-600 hover:text-blue-800 transition-colors">
                    Forgot your password?
                </a>
            </div>

            <div class="mt-4 border-t border-gray-200 pt-4 text-center text-sm">
                <p class="text-gray-600">Don't have an account?</p>
                <a href="register.php" class="mt-1 inline-block text-blue-600 hover:text-blue-800 font-medium transition-colors">
                    Create Account
                </a>
            </div>
        </div>
    </div>

    <script>
        // Simple password visibility toggle
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password');

            // Example of enhancing the form with JavaScript functionality
            // This could be expanded with more validation, animation, etc.
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                // Any additional client-side validation could go here
            });
        });
    </script>
</body>

</html>