<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Feedback.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $feedback = new Feedback($db);

    $feedback->user_id = $_SESSION['user_id'];
    $feedback->date = $_POST['date'];
    $feedback->tags = isset($_POST['tags']) ? implode(',', $_POST['tags']) : '';
    $feedback->feedback = $_POST['feedback'];

    // Validation logic
    $errors = [];

    if (empty($feedback->feedback)) {
        $errors['feedback'] = "Feedback is required.";
    }

    if (!empty($errors)) {
        $response['status'] = 'error';
        $response['errors'] = $errors;
    } else {
        if ($feedback->submitFeedback()) {
            $response['status'] = 'success';
            $response['msg'] = "Feedback submitted successfully!";
        } else {
            $response['status'] = 'error';
            $response['msg'] = "Feedback submission failed!";
        }
    }

    echo json_encode($response);
}
?>
