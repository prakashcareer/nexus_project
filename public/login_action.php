<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/User.php';

$response = array('status' => '', 'msg' => '');

if (isset($_POST['email']) && isset($_POST['password'])) {
    if ($_SESSION['captcha'] == $_POST['captcha']) {
        $database = new Database();
        $db = $database->getConnection();
        
        $user = new User($db);
        $user->email = $_POST['email'];
        $user->password = $_POST['password']; // Ensure password is hashed

        if ($user->login()) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['user_email'] = $user->email;

            $response['status'] = 'success';
            $response['msg'] = 'Login successful!';
        } else {
            $response['status'] = 'failed';
            $response['msg'] = 'Login failed! Incorrect email or password.';
        }
    } else {
        $response['status'] = 'captcha';
        $response['msg'] = 'Captcha validation failed!';
    }
} else {
    $response['status'] = 'failed';
    $response['msg'] = 'Invalid request!';
}

echo json_encode($response);
exit();
?>
