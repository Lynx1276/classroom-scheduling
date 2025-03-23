<?php

// Validate if department_id or college_id exists before inserting
function isValidDepartment($conn, $department_id)
{
    $stmt = $conn->prepare("SELECT COUNT(*) FROM departments WHERE department_id = ?");
    $stmt->execute([$department_id]);
    return $stmt->fetchColumn() > 0;
}

function isValidCollege($conn, $college_id)
{
    $stmt = $conn->prepare("SELECT COUNT(*) FROM colleges WHERE college_id = ?");
    $stmt->execute([$college_id]);
    return $stmt->fetchColumn() > 0;
}


?>