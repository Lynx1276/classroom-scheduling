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
    <title>Login</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Login</h2>

        <?php if (!empty($error)) : ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label class="block">Username:</label>
            <input type="text" name="username" class="border w-full p-2 rounded mb-4" required>

            <label class="block">Password:</label>
            <input type="password" name="password" class="border w-full p-2 rounded mb-4" required>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full hover:bg-blue-600">
                Login
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="register.php" class="text-blue-500 hover:underline">Don't have an account? Register</a>
        </div>
    </div>

</body>

</html>