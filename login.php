<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the functions file
require_once 'login_function.php';

// Get POST data from user
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
// $institute = isset($_POST['cmbInstitute']) ? trim($_POST['cmbInstitute']) : '';

// echo $username;
// echo $password;


if (empty($username) || empty($password)) {
    // Redirect back with error message in same page
    $_SESSION['error'] = "All fields are required";
    header("Location: login_page.php");
    exit;
}

// call to functions
// $conn = connectToDatabase();
// print_r($conn);
$response = validateUser($username, $password);

if ($response['status'] === 'success') {
    $_SESSION['username'] = $response['user_name'];
    $_SESSION['sic'] = $response['user_id'];
    $_SESSION['role'] = $response['user_type'];
    $_SESSION['photo'] = $response['user_photo'];
    
    // Redirect based on user type of dashboard
    if ($response['user_type'] === 'DEAN') {
        header("Location: ./dean/dashboard.php");
    } else if ($response['user_type'] === 'Accounts') {
        header("Location: ./accounts_dept/dashboard.php");
    } else if ($response['user_type'] === 'Examination Cell') {
        header("Location: ./exam_cell/dashboard.php");
    } else if ($response['user_type'] === 'Faculty Advisor') {
        header("Location: ./faculty/dashboard.php");
    } else {
        header("Location: ./students/dashboard.php");
    }
    exit;
} else {
    // Redirect back with error message if not found
    $_SESSION['error'] = $response['message'];
    header("Location: login_page.php");
    exit;
}
?>

