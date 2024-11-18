<?php 
session_start();
require_once 'config/connect.php';

// Check if the session has a user ID; otherwise, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: LogIn.php");
    exit();
}

$userEmail = $_SESSION['user_id']; // Get user ID from session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Log all incoming data
    error_log("POST data: " . print_r($_POST, true));

    try {
        $con->beginTransaction();

        // Database update logic
        $leaderUpdated = false;

        foreach ($_POST as $key => $value) {
            if (preg_match('/^name-(\d+)$/', $key, $matches)) {
                $studentIndex = $matches[1];
                $updatedName = $value;
                $studentEmail = $_POST["email-$studentIndex"];
                
                error_log("Updating name for email: $studentEmail to $updatedName");

                // Update the student's name in the database
                $updateStmt = $con->prepare("UPDATE students SET name = :name WHERE email = :email");
                $updateStmt->execute(['name' => $updatedName, 'email' => $studentEmail]);

                // If the student being updated is the leader, update the teams table as well
                if ($studentEmail == $userEmail) {  // Check if this student is the leader
                    $leaderUpdated = true;

                    // Update the leader's name and email in the teams table
                    $updateTeamStmt = $con->prepare("UPDATE teams SET leader_email = :leader_email, name = :leader_name WHERE leader_email = :leader_email");
                    $updateTeamStmt->execute(['leader_email' => $studentEmail, 'leader_name' => $updatedName]);
                }
            }
        }

        // Commit the transaction
        $con->commit();

        if ($leaderUpdated) {
            // If the leader's information was updated, send a success response
            echo json_encode(['success' => true, 'message' => 'Leader and student information updated successfully!']);
        } else {
            // If only student information was updated
            echo json_encode(['success' => true, 'message' => 'Student information updated successfully!']);
        }

    } catch (Exception $e) {
        // Rollback in case of error
        $con->rollBack();
        error_log("Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit();
}
