<?php
require '../config/database.php';

$db = new Database();
$conn = $db->connect();

$type = $_GET['type'] ?? '';

if ($type === 'departments') {
    $stmt = $conn->query("SELECT department_id, department_name FROM departments");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}

if ($type === 'collegse') {
    $stmt = $conn->query("SELECT college_id, college_name FROM colleges");
    $data = $stmt->fetchAll((PDO::FETCH_ASSOC));
    echo json_encode($data);
}

if ($type === 'courses') {
    $stmt = $conn->query("SELECT course_id, course_name FROM courses");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}
