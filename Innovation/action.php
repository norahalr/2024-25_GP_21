<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
require_once 'config/connect.php';


$type = $_REQUEST['type'] ?? '';
$status = $_REQUEST['status'] ?? '';
$request_id = $_REQUEST['id'] ?? '';
$student_emails = $_REQUEST['student_email'] ?? [];
$student_names = $_REQUEST['student_name'] ?? [];
$supervisor_email = $_REQUEST['email'] ?? '';
$delete_reason = $_REQUEST['delete_reason'] ?? '';


// === Mail Server Setup ===
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'innengine25@gmail.com';       // Replace with your email
    $mail->Password = 'dixk ebkn gunv jnfc';          // Replace with your app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom('innengine25@gmail.com', 'Innovation Engine'); // Sender info
} catch (Exception $e) {
    echo "❌ Mail configuration failed: {$mail->ErrorInfo}";
    exit();
}

// === Validate and determine table ===
if ($_POST['type'] == 'team') {
    $table = 'team_idea_request';
} else if ($_POST['type'] == 'supervisor') {
    $table = 'supervisor_idea_request';
} else {
    header("Location: SupervisorHomePage.php");
    exit();
}

if ($_POST['status'] != 'Rejected' && $_POST['status'] != 'Approved') {
    header("Location: SupervisorHomePage.php");
    exit();
}


try {
    $status = $_POST['status'];
    $student_emails = $_POST['student_email'] ?? [];
    $student_names = $_POST['student_name'] ?? [];

    // === Send email to all students ===
    for ($i = 0; $i < count($student_emails); $i++) {
        $email = $student_emails[$i];
        $name = $student_names[$i];

        $subject = "Your Supervisor Request has been $status";
$supervisor_name = $_POST['supervisor_name'] ?? 'the supervisor';
echo "Supervisor name received: " . htmlspecialchars($_POST['supervisor_name']);

$body = "
    <html>
    Hello " . htmlspecialchars($name) . ",<br><br>
    Your request has been <strong style='color:" . ($status == 'Approved' ? 'green' : 'red') . ";'>$status</strong> by <strong>" . htmlspecialchars($supervisor_name) . "</strong>.<br>
    Please log in to your account to view more details.
    <br><br>Best regards,<br>Innovation Engine Team
    </html>";


        $mail->addAddress($email, $name);
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $body;

        if (!$mail->send()) {
            echo "❌ Email not sent to $email.<br>";
        }
        $mail->clearAddresses(); // Reset for next student
    }

    // === Update request status ===
    if ($status == 'Rejected') {
        $sql = "UPDATE $table SET status = :status, reject_reason = :reason WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':reason', $_POST['delete_reason']);
        $stmt->bindParam(':id', $_POST['id']);
    } else {
        $sql = "UPDATE $table SET status = :status WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $_POST['id']);
        
    }
    $stmt->execute();

   if ($status == 'Approved') {
    $supervisor_email = $_POST['email'];
    $approved_request_id = $_POST['id'];

    // ✅ First, fetch the approved team email
    $stmt = $con->prepare("SELECT team_email FROM $table WHERE id = :id");
    $stmt->bindParam(':id', $approved_request_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $team_email = $result['team_email'] ?? null;

    if ($team_email) {
        $tables = ['supervisor_idea_request', 'team_idea_request'];

        // ✅ Now cancel other pending requests sent by the approved team
        $cancel_reason_team_sent_others = "Canceled because your team was accepted by another supervisor.";
        foreach ($tables as $reject_table) {
            $sql = "UPDATE $reject_table 
                    SET status = 'Canceled', delete_reason = :cancel_reason 
                    WHERE team_email = :team_email 
                    AND id != :approved_id 
                    AND status = 'Pending'";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':cancel_reason', $cancel_reason_team_sent_others);
            $stmt->bindParam(':team_email', $team_email);
            $stmt->bindParam(':approved_id', $approved_request_id);
            $stmt->execute();
        }

    

            $rejection_reason_due_to_other_approval = "Rejected due to another team being approved by this supervisor.";

foreach ($tables as $reject_table) {
    // Step 1: Update all other team requests as REJECTED with reason
    $sql = "UPDATE $reject_table 
            SET status = 'Rejected', reject_reason = :reject_reason 
            WHERE team_email != :approved_team_email 
            AND supervisor_email = :supervisor_email 
            AND id != :approved_id 
            AND status = 'Pending'";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':reject_reason', $rejection_reason_due_to_other_approval);
    $stmt->bindParam(':approved_team_email', $team_email);
    $stmt->bindParam(':supervisor_email', $supervisor_email);
    $stmt->bindParam(':approved_id', $approved_request_id);
    $stmt->execute();

    // Step 2: Fetch rejected students and send them email
    $stmt = $con->prepare("
        SELECT s.name AS student_name, s.email AS student_email
        FROM $reject_table r
        JOIN teams t ON r.team_email = t.leader_email
        JOIN students s ON s.team_email = r.team_email
        WHERE r.supervisor_email = :supervisor_email
        AND r.team_email != :approved_team_email
        AND r.id != :approved_id
        AND r.status = 'Rejected'
        AND r.reject_reason = :reject_reason
    ");
    $stmt->bindParam(':supervisor_email', $supervisor_email);
    $stmt->bindParam(':approved_team_email', $team_email);
    $stmt->bindParam(':approved_id', $approved_request_id);
    $stmt->bindParam(':reject_reason', $rejection_reason_due_to_other_approval);
    $stmt->execute();
    $rejectedStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $supervisor_name = $_POST['supervisor_name'] ?? 'another supervisor';

    foreach ($rejectedStudents as $student) {
        $email = $student['student_email'];
        $name = $student['student_name'];

        $subject = "Your Supervisor Request Has Been Rejected";
        $body = "
        <html>
        Hello " . htmlspecialchars($name) . ",<br><br>
        Your supervisor request has been <strong style='color:red;'>Rejected</strong> because <strong>" . htmlspecialchars($supervisor_name) . "</strong> has approved another team.<br>
        This ensures fair and exclusive supervision assignments.<br><br>
        Best regards,<br>
        Innovation Engine Team
        </html>";

        $mail->addAddress($email, $name);
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $body;

        if (!$mail->send()) {
            echo "❌ Failed to email $email<br>";
        }
        $mail->clearAddresses();
    }
}


            // Mark supervisor unavailable
            $stmt = $con->prepare("UPDATE supervisors SET availability = 'Unavailable' WHERE email = :email");
            $stmt->bindParam(':email', $supervisor_email);
            $stmt->execute();

            // Assign supervisor to team
            $stmt = $con->prepare("UPDATE teams SET supervisor_email = :supervisor_email WHERE leader_email = :team_email");
            $stmt->bindParam(':supervisor_email', $supervisor_email);
            $stmt->bindParam(':team_email', $team_email);
            $stmt->execute();
        }
    }

    header("Location: SupervisorHomePage.php");
    exit();

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
    exit();
} catch (Exception $e) {
    echo "❌ Mail error: " . $e->getMessage();
    exit();
}
