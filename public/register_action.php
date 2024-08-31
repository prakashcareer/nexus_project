<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = array('status' => '', 'message' => '');

    if ($_SESSION['captcha'] == $_POST['captcha']) {
        $database = new Database();
        $db = $database->getConnection();

        $user = new User($db);
        $user->name = $_POST['name'];
        $user->course_name = $_POST['course_name'];
        $user->semester = $_POST['semester'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password']; // Encrypt the password

        if ($user->register()) {
            $response['status'] = 'success';
            $response['message'] = 'Registration successful!';
        } else {
            $response['status'] = 'Error';
            $response['message'] = 'Registration failed! Please try again.';
        }
    } else {
        $response['status'] = 'Captcha';
        $response['message'] = 'Captcha validation failed! Please try again.';
    }

    echo json_encode($response);
    exit();
}
?>
