<?php
require_once '../classes/Database.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "unauthorized";
    exit;
}

// Check if the request contains an ID
if (isset($_POST['id'])) {
    $feedback_id = $_POST['id'];

    // Initialize the database
    $database = new Database();
    $db = $database->getConnection();

    // Prepare the delete query
    $query = "DELETE FROM feedback WHERE id = :id AND user_id = :user_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $feedback_id);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);

    // Execute the query
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
