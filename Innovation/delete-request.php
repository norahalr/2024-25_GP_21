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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'], $_POST['request_type'], $_POST['delete_reason'])) {
    $requestId = $_POST['request_id'];
    $requestType = $_POST['request_type'];
    $deleteReason = trim($_POST['delete_reason']); // FIXED

    if (empty($deleteReason)) {
        $_SESSION['error'] = "You must provide a reason for canceling the request.";
        header("Location: StudentRequest.php");
        exit();
    }

    try {
        $table = ($requestType === 'team_idea_request') ? 'team_idea_request' : 'supervisor_idea_request';

        $stmt = $con->prepare("
            UPDATE $table 
            SET status = 'Canceled', delete_reason = :delete_reason 
            WHERE id = :id AND status NOT IN ('Approved', 'Rejected')
        ");
        $stmt->execute([
            'id' => $requestId,
            'delete_reason' => $deleteReason
        ]);

        $_SESSION['message'] = "The request has been marked as Canceled with reason: $deleteReason";
    } catch (PDOException $e) {
        $_SESSION['error'] = "An error occurred while canceling the request: " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "Invalid request.";
}


// Redirect back to the main page
header("Location: StudentRequest.php");
exit();
?>
