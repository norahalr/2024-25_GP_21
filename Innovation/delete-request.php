<?php
ob_start();
session_start();
require_once 'config/connect.php';

// Check if the session has a user ID; otherwise, redirect to login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in to perform this action.";
    header("Location: LogIn.php");
    exit();
}
// Check if request ID and type are provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'], $_POST['request_type'])) {
    $requestId = $_POST['request_id'];
    $requestType = $_POST['request_type'];
echo $requestType;
    try {
        // Determine the table based on request type
        $table = ($requestType === 'team_idea_request') ? 'team_idea_request' : 'supervisor_idea_request';

        // Update the status to 'Deleted'
        $stmt = $con->prepare("UPDATE $table SET status = 'Deleted' WHERE id = :id AND status != 'Approved' AND status != 'Rejected'");
        $stmt->execute(['id' => $requestId]);

        // Set a success message
        $_SESSION['message'] = "The request has been marked as deleted.";
    } catch (PDOException $e) {
        $_SESSION['error'] = "An error occurred while trying to delete the request: " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "Invalid request.";
}

// Redirect back to the main page
header("Location: StudentRequest.php");
exit();
?>
