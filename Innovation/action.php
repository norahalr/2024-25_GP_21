<?php 
require_once 'config/connect.php';

if ($_GET['type'] == 'team') {
    $table = 'team_idea_request';
} else if ($_GET['type'] == 'supervisor') {
    $table = 'supervisor_idea_request';

} else {
    header("Location: SupervisorHomePage.php");
    exit();
}

// Check for valid status
if ($_GET['status'] != 'Rejected' && $_GET['status'] != 'Approved') {
    header("Location: SupervisorHomePage.php");
    exit();
}

// Update the status of the selected request
$sql = "UPDATE 
            $table 
        SET status = :status
        WHERE id = :id";
$stmt = $con->prepare($sql);
$stmt->bindParam(':status', $_GET['status']);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

// If status is "Approved", reject all other requests in both tables for the same supervisor
if ($_GET['status'] == 'Approved' ) {
   // Mark supervisor as unavailable
   $sql = "UPDATE 
   supervisors
SET availability = 'Unavailable'
WHERE email = :email";
$stmt = $con->prepare($sql);
$stmt->bindParam(':email', $_GET['email']);
$stmt->execute();

    // Reject all requests in the supervisor_idea_request table except the approved one
    $sql = "UPDATE 
                supervisor_idea_request 
            SET status = 'Rejected'
            WHERE supervisor_email = :email ";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':email', $_GET['email']);
    $stmt->execute();

    // Reject all requests in the team_idea_request table for the same supervisor
    $sql = "UPDATE 
                team_idea_request 
            SET status = 'Rejected'
            WHERE supervisor_email = :email";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':email', $_GET['email']);
    $stmt->execute();

    $sql = "UPDATE 
            $table 
        SET status = :status
        WHERE id = :id";
$stmt = $con->prepare($sql);
$stmt->bindParam(':status', $_GET['status']);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
}

header("Location: SupervisorHomePage.php");
exit();
?>
