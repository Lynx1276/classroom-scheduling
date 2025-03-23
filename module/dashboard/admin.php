<?php
session_start();
include '../../includes/auth_check.php';
require '../../config/database.php';

$db = new Database();
$conn = $db->connect();

// Fetch statistics
$facultyCount = $conn->query("SELECT COUNT(*) AS total FROM faculty")->fetch(PDO::FETCH_ASSOC)['total'];
$classroomCount = $conn->query("SELECT COUNT(*) AS total FROM classrooms")->fetch(PDO::FETCH_ASSOC)['total'];
$scheduleCount = $conn->query("SELECT COUNT(*) AS total FROM schedules")->fetch(PDO::FETCH_ASSOC)['total'];
$userCount = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch(PDO::FETCH_ASSOC)['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <?php include '../../includes/header.php'; ?>

    <div class="container mx-auto mt-12">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-800">Total Users</h2>
                <p class="text-3xl font-bold text-blue-600"><?= $userCount ?></p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-800">Faculty</h2>
                <p class="text-3xl font-bold text-green-600"><?= $facultyCount ?></p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-800">Classrooms</h2>
                <p class="text-3xl font-bold text-yellow-600"><?= $classroomCount ?></p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-800">Schedules</h2>
                <p class="text-3xl font-bold text-red-600"><?= $scheduleCount ?></p>
            </div>

        </div>

        <!-- Recent Activity -->
        <div class="mt-12 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Recent Activities</h2>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-3">User</th>
                        <th class="border p-3">Action</th>
                        <th class="border p-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $logs = $conn->query("SELECT * FROM activity_logs ORDER BY created_at DESC LIMIT 5");
                    while ($log = $logs->fetch(PDO::FETCH_ASSOC)) :
                    ?>
                        <tr class="border-b">
                            <td class="p-3"><?= $log['faculty_id'] ?></td>
                            <td class="p-3"><?= $log['action_type'] ?></td>
                            <td class="p-3"><?= $log['created_at'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>

    <?php include '../../includes/footer.php'; ?>

</body>

</html>