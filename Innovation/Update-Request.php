<?php
session_start();
require_once 'config/connect.php';

// Check if the session has a user ID; otherwise, redirect to login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in to access this page.";
    header("Location: LogIn.php");
    exit();
}

$userEmail = $_SESSION['user_id']; // Get user ID from session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $request_id = $_POST['request_id'] ?? null;
    $project_name = $_POST['project_name'] ?? '';
    $idea = $_POST['idea'] ?? '';

    if ($request_id) {
        // Update only the `team_idea_request` table
        $stmt = $con->prepare("
            UPDATE team_idea_request
            SET project_name = :project_name, 
                description = :description
            WHERE id = :id AND team_email = :team_email
        ");
        $stmt->bindParam(':id', $request_id);
        $stmt->bindParam(':project_name', $project_name);
        $stmt->bindParam(':description', $idea);
        $stmt->bindParam(':team_email', $userEmail);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Request updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update the request.";
        }
    } else {
        $_SESSION['error'] = "Missing request ID.";
    }

    header("Location: StudentRequest.php");
    exit();
}
?>
