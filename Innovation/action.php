<?php 
require_once 'config/connect.php';

// Validate request type and determine table
if ($_GET['type'] == 'team') {
    $table = 'team_idea_request';
} else if ($_GET['type'] == 'supervisor') {
    $table = 'supervisor_idea_request';
} else {
    header("Location: SupervisorHomePage.php");
    exit();
}

// Validate status
if ($_GET['status'] != 'Rejected' && $_GET['status'] != 'Approved') {
    header("Location: SupervisorHomePage.php");
    exit();
}

try {
    // Update the status of the selected request
    $sql = "UPDATE $table SET status = :status WHERE id = :id";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':status', $_GET['status']);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();

    // If the status is "Approved," perform necessary updates
    if ($_GET['status'] == 'Approved') {
        $supervisor_email = $_GET['email']; // Supervisor email
        $approved_request_id = $_GET['id']; // Approved request ID
        $team_email = null;

        // Retrieve team_email for the approved request
        $sql = "SELECT team_email FROM $table WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $approved_request_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $team_email = $result['team_email'];

        if ($team_email) {
            // Cancel all other pending requests for the same team in both tables
            $tables = ['supervisor_idea_request', 'team_idea_request'];
            foreach ($tables as $update_table) {
                $sql = "UPDATE $update_table 
                        SET status = 'Canceled' 
                        WHERE team_email = :team_email 
                        AND status = 'Pending'";
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':team_email', $team_email);
                $stmt->execute();
            }

            // Reject all other pending requests for the same supervisor in both tables
            foreach ($tables as $reject_table) {
                $sql = "UPDATE $reject_table 
                        SET status = 'Rejected' 
                        WHERE supervisor_email = :supervisor_email 
                        AND id != :approved_id 
                        AND status = 'Pending'";
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':supervisor_email', $supervisor_email);
                $stmt->bindParam(':approved_id', $approved_request_id);
                $stmt->execute();
            }

            // Mark the supervisor as unavailable
            $sql = "UPDATE supervisors SET availability = 'Unavailable' WHERE email = :email";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':email', $supervisor_email);
            $stmt->execute();

            // Assign the approved supervisor to the team in the teams table
            $sql = "UPDATE teams SET supervisor_email = :supervisor_email WHERE leader_email = :team_email";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':supervisor_email', $supervisor_email);
            $stmt->bindParam(':team_email', $team_email);
            $stmt->execute();
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

header("Location: SupervisorHomePage.php");
exit();
?>