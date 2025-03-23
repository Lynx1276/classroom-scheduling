<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /module/auth/login.php");
    exit();
}
