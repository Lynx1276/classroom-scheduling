<?php
session_start();
require '../../config/database.php';

$db = new Database();
$conn = $db->connect();

// Authentication check
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != '2') {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch faculty under the Dean's college
$collegeId = $_SESSION['college_id'];
$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM faculty WHERE department_id = ?");
$stmt->execute([$collegeId]);
$facultyCount = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Get dean information
$stmt = $conn->prepare("SELECT first_name FROM users WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$deanName = $stmt->fetch(PDO::FETCH_ASSOC)['first_name'];

// Get college information
$stmt = $conn->prepare("SELECT college_name FROM colleges WHERE college_id = ?");
$stmt->execute([$collegeId]);
$collegeName = $stmt->fetch(PDO::FETCH_ASSOC)['college_name'];

// Get page title from URL
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
$pageTitle = ucfirst(str_replace('-', ' ', $currentPage));
if ($currentPage == 'index') {
    $pageTitle = 'Dashboard';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dean Dashboard - <?= $pageTitle ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Top Navigation -->
    <nav class="bg-blue-800 text-white p-4 shadow-md fixed top-0 w-full z-10">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <button id="sidebar-toggle" class="mr-4 lg:hidden">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="index.php" class="text-xl font-bold flex items-center">
                    <span class="hidden sm:inline">PRMSU</span>
                    <span class="px-2">|</span>
                    <span>Dean Portal</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="hidden md:flex items-center mr-4">
                    <img src="../../assets/images/avatar.png" alt="Profile" class="w-8 h-8 rounded-full mr-2">
                    <span><?= htmlspecialchars($deanName) ?></span>
                </div>
                <a href="../../modules/auth/logout.php" class="hover:bg-blue-700 py-2 px-3 rounded">
                    <i class="fas fa-sign-out-alt mr-1"></i>
                    <span class="hidden sm:inline">Logout</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="flex flex-1 pt-16">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-blue-900 text-white w-64 min-h-screen pt-4 fixed h-full z-10 transition-transform duration-300 lg:translate-x-0 -translate-x-full">
            <div class="p-4 border-b border-blue-800">
                <div class="text-center mb-4">
                    <img src="../../assets/images/avatar.png" alt="Profile" class="w-20 h-20 rounded-full mx-auto mb-2">
                    <h3 class="font-bold"><?= htmlspecialchars($deanName) ?></h3>
                    <p class="text-sm text-blue-300">Dean</p>
                    <p class="text-sm text-blue-300"><?= htmlspecialchars($collegeName) ?></p>
                </div>
            </div>

            <nav class="mt-4">
                <ul>
                    <li class="<?= $currentPage == 'index' ? 'bg-blue-800' : '' ?>">
                        <a href="index.php" class="flex items-center py-3 px-4 hover:bg-blue-800">
                            <i class="fas fa-tachometer-alt w-6"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="<?= $currentPage == 'faculty' ? 'bg-blue-800' : '' ?>">
                        <a href="faculty.php" class="flex items-center py-3 px-4 hover:bg-blue-800">
                            <i class="fas fa-users w-6"></i>
                            <span>Faculty</span>
                        </a>
                    </li>
                    <li class="<?= $currentPage == 'programs' ? 'bg-blue-800' : '' ?>">
                        <a href="programs.php" class="flex items-center py-3 px-4 hover:bg-blue-800">
                            <i class="fas fa-graduation-cap w-6"></i>
                            <span>Programs</span>
                        </a>
                    </li>
                    <li class="<?= $currentPage == 'reports' ? 'bg-blue-800' : '' ?>">
                        <a href="reports.php" class="flex items-center py-3 px-4 hover:bg-blue-800">
                            <i class="fas fa-chart-bar w-6"></i>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li class="<?= $currentPage == 'settings' ? 'bg-blue-800' : '' ?>">
                        <a href="settings.php" class="flex items-center py-3 px-4 hover:bg-blue-800">
                            <i class="fas fa-cog w-6"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="absolute bottom-0 w-full p-4 border-t border-blue-800">
                <a href="../../modules/auth/logout.php" class="flex items-center text-blue-300 hover:text-white">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64 p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800"><?= $pageTitle ?></h1>
                <nav class="text-sm text-gray-500 mt-1" aria-label="Breadcrumb">
                    <ol class="list-none p-0 flex">
                        <li class="flex items-center">
                            <a href="index.php" class="hover:text-blue-600">Home</a>
                            <span class="mx-2">/</span>
                        </li>
                        <li class="text-gray-700"><?= $pageTitle ?></li>
                    </ol>
                </nav>
            </div>

            <!-- Dashboard Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Faculty Members</p>
                            <p class="text-2xl font-bold"><?= $facultyCount ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-500">
                            <i class="fas fa-graduation-cap fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Programs</p>
                            <p class="text-2xl font-bold">5</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Courses</p>
                            <p class="text-2xl font-bold">42</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                            <i class="fas fa-user-graduate fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Students</p>
                            <p class="text-2xl font-bold">1,245</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Recent Activities</h2>
                    <a href="#" class="text-blue-600 hover:underline text-sm">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 text-left">
                                <th class="py-3 px-4 font-semibold">Activity</th>
                                <th class="py-3 px-4 font-semibold">User</th>
                                <th class="py-3 px-4 font-semibold">Date</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4">Faculty evaluation completed</td>
                                <td class="py-3 px-4">Dr. Santos</td>
                                <td class="py-3 px-4">March 22, 2025</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4">New program proposal submitted</td>
                                <td class="py-3 px-4">Dr. Cruz</td>
                                <td class="py-3 px-4">March 20, 2025</td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4">Curriculum update approved</td>
                                <td class="py-3 px-4">Dr. Reyes</td>
                                <td class="py-3 px-4">March 18, 2025</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">Department meeting scheduled</td>
                                <td class="py-3 px-4">Dr. Garcia</td>
                                <td class="py-3 px-4">March 15, 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Announcements -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Announcements</h2>
                    <a href="#" class="text-blue-600 hover:underline text-sm">Create New</a>
                </div>
                <div class="space-y-4">
                    <div class="p-4 border-l-4 border-blue-500 bg-blue-50 rounded">
                        <h3 class="font-bold">Faculty Meeting</h3>
                        <p class="text-sm text-gray-600 mb-1">All faculty members are required to attend the end of semester meeting on March 30, 2025.</p>
                        <p class="text-xs text-gray-500">Posted on March 22, 2025</p>
                    </div>
                    <div class="p-4 border-l-4 border-yellow-500 bg-yellow-50 rounded">
                        <h3 class="font-bold">Grades Submission Reminder</h3>
                        <p class="text-sm text-gray-600 mb-1">Final grades are due on April 5, 2025. Please submit on time to avoid delays in student evaluations.</p>
                        <p class="text-xs text-gray-500">Posted on March 20, 2025</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-auto">
        <div class="container mx-auto">
            <p>&copy; <?= date('Y') ?> PRMSU Zambales | All Rights Reserved</p>
        </div>
    </footer>

    <script>
        // Toggle sidebar on mobile
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 1024 &&
                !sidebar.contains(e.target) &&
                !sidebarToggle.contains(e.target) &&
                !sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Keep sidebar visible on window resize to desktop size
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
            }
        });
    </script>
</body>

</html>