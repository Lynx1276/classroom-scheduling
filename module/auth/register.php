<?php
session_start();
require '../../config/database.php';

$db = new Database();
$conn = $db->connect();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $colleges_id =($_POST['role'] === '2')? $_POST['college_id'] : null; // Dean
    $department_id = ($_POST['role'] ==='3') ? $_POST['department_id'] : null;  // Chair
    

    $stmt = $conn->prepare("
        INSERT INTO users (username, password_hash, email, role_id, department_id, , colleges_id)
        VALUES (:username, :password, :email, :role_id, :department_id,  :colleges_id)
    ");

    $stmt->execute([
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'role_id' => $role,
        'department_id' => $department_id,
        'course_id' => $course_id
    ]);

    $_SESSION['message'] = "Account successfully registered!";
    header("Location: login.php");
}

// Fetch departments and courses
$stmtDept = $conn->query("SELECT * FROM departments");
$departments = $stmtDept->fetchAll(PDO::FETCH_ASSOC);

$stmtCourse = $conn->query("SELECT * FROM courses");
$courses = $stmtCourse->fetchAll(PDO::FETCH_ASSOC);

$stmtColleges = $conn->query("SELECT * FROM colleges");
$colleges = $stmtColleges->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen">

    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-700">Register</h2>

                <form action="" method="POST" class="mt-4">
                    <label class="block">Username:</label>
                    <input type="text" name="username" class="border w-full p-2 rounded" required>

                    <label class="block mt-4">Email:</label>
                    <input type="email" name="email" class="border w-full p-2 rounded" required>

                    <label class="block mt-4">Password:</label>
                    <input type="password" name="password" class="border w-full p-2 rounded" required>

                    <label class="block mt-4">Role:</label>
                    <select name="role" id="roleSelect" class="border w-full p-2 rounded" required>
                        <option value="">Select Role</option>
                        <option value="2">Dean</option>
                        <option value="3">Chair</option>
                        <option value="4">Faculty</option>
                    </select>

                    <!-- Dean Dropdown -->
                    <div id="deptSelect" class="hidden mt-4">
                        <label>Department:</label>
                        <select name="department_id" class="border w-full p-2 rounded">
                            <option value="">Select Department</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['department_id'] ?>"><?= $dept['department_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Chair Dropdown -->
                    <div id="courseSelect" class="hidden mt-4">
                        <label>Course:</label>
                        <select name="course_id" class="border w-full p-2 rounded">
                            <option value="">Select Course</option>
                            <?php foreach ($courses as $course): ?>
                                <option value="<?= $course['course_id'] ?>"><?= $course['course_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 w-full">Register</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('roleSelect').addEventListener('change', function() {
            const role = this.value;
            document.getElementById('deptSelect').classList.toggle('hidden', role !== '2');
            document.getElementById('courseSelect').classList.toggle('hidden', role !== '3');
        });
    </script>

</body>

</html>