<?php
session_start();
require_once 'config/connect.php';

// Check if the session has a user ID; otherwise, redirect to login
if (!isset($_SESSION['user_id'])) {
    echo "Error: User is not logged in.";
    header("Location: LogIn.php");
    exit();
}

$userEmail = $_SESSION['user_id']; // Get user ID from session
if (isset($_GET['supervisor_email'])||isset($_POST['supervisor_email'])) {
  $supervisorEmail = $_GET['supervisor_email'];
} else {
  echo "Error: No supervisor email provided.";
  exit();
}

// Fetch supervisors with ideas
$query = "SELECT idea FROM supervisors WHERE idea IS NOT NULL AND idea != '' AND email = :email ";
$stmt = $con->prepare($query);
$stmt->execute(['email' => $supervisorEmail]);
$supervisors = $stmt->fetchAll(PDO::FETCH_ASSOC);


$hasSupervisorIdeas = count($supervisors) > 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectPreference = $_POST['select'];
    $idea = trim($_POST['Idea']);
    $requestDate = date('Y-m-d');
    $status = 'Pending';
    $supervisorEmail = $_POST['supervisor_email'];

    try {
        // Check if the student already requested this supervisor
        $query = "
            SELECT COUNT(*) AS existing_requests 
            FROM (
                SELECT id FROM supervisor_idea_request WHERE team_email = :team_email AND supervisor_email = :supervisor_email
                UNION ALL
                SELECT id FROM team_idea_request WHERE team_email = :team_email AND supervisor_email = :supervisor_email
            ) AS combined_requests";
        $stmt = $con->prepare($query);
        $stmt->execute([
            'team_email' => $userEmail,
            'supervisor_email' => $supervisorEmail
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['existing_requests'] > 0) {
            $_SESSION['message'] = "Error: You have already submitted a request to this supervisor.";
            header("Location: StudentHomePage.php");
            exit();
        }

        // Check the number of "on-progress" requests for the team
        $query = "
            SELECT COUNT(*) AS on_progress_count 
            FROM (
                SELECT id FROM supervisor_idea_request WHERE team_email = :team_email AND status = 'Pending'
                UNION ALL
                SELECT id FROM team_idea_request WHERE team_email = :team_email AND status = 'Pending'
            ) AS combined_requests";
        $stmt = $con->prepare($query);
        $stmt->execute(['team_email' => $userEmail]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['on_progress_count'] >= 3) {
            $_SESSION['message'] = "Error: You cannot have more than 3 'on-progress' requests.";
            header("Location: StudentHomePage.php");
            exit();
        }

        // Insert into the appropriate table based on project preference
        if ($projectPreference === 'Supervisor Idea') {
          $query = "INSERT INTO supervisor_idea_request (status, team_email, supervisor_email, request_date) VALUES (:status, :team_email, :supervisor_email, :request_date)";
          $stmt = $con->prepare($query);
          $stmt->execute([
              'status' => $status,
              'team_email' => $userEmail,
              'supervisor_email' => $supervisorEmail,
              'request_date' => $requestDate
          ]);
            $_SESSION['message'] = "Request for supervisor's idea submitted successfully.";
            header("Location: StudentHomePage.php");

        } elseif ($projectPreference === 'Your Own Idea') {
          $project_name=$_POST["project_name"];
          $query = "INSERT INTO team_idea_request (project_name, description, status, team_email, supervisor_email, request_date) VALUES (:project_name, :description, :status, :team_email, :supervisor_email, :request_date)";
          $stmt = $con->prepare($query);
          $stmt->execute([
              'project_name' => $project_name,
              'description' => $idea,
              'status' => $status,
              'team_email' => $userEmail,
              'supervisor_email' => $supervisorEmail,
              'request_date' => $requestDate
          ]);
            $_SESSION['message'] = "Request for your idea submitted successfully.";
            header("Location: StudentHomePage.php");

        } else {
            $_SESSION['message'] = "Error: Invalid project preference selected.";
            header("Location: StudentHomePage.php");
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        header("Location: StudentHomePage.php");
    }
}
?>


<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Request Supervisor">
    <meta name="description" content="">
    <title>Request Supervisor</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="externalForm.css" media="screen">
    <link rel="stylesheet" href="VeiwSupervisor.css" media="screen">
    <!-- <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script> -->
    <meta name="generator" content="Nicepage 6.19.6, nicepage.com">
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Request Supervisor">
   
    <style data-mode="XL">@media (min-width: 1200px) {
      .u-block-d7f8-25 {
        min-height: 873px;
      }
      .u-block-d7f8-3 {
        min-height: 848px;
        margin-top: 60px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 11px;
      }
      .u-block-d7f8-4 {
        min-height: 812px;
        background-image: url("np://user.desktop.nicepage.com/Site_9881637/images/bec4780631e6204803c2c76ed0388bdff62ee08c75e5765d228e81fbbb5a1c573c70d6009559dcd56eb3d2714a753747269119e4218281bf90f6ee_1280.jpg?rand=e665");
        background-position: 50% 50%;
      }
      .u-block-d7f8-5 {
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 60px;
        padding-right: 60px;
      }
      .u-block-d7f8-26 {
        min-height: 178px;
      }
      .u-block-d7f8-27 {
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 60px;
        padding-right: 60px;
      }
      .u-block-d7f8-28 {
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-29 {
        font-weight: 400;
        font-size: 1.25rem;
        margin-top: 14px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-30 {
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-12 {
        min-height: 829px;
      }
      .u-block-d7f8-13 {
        padding-top: 25px;
        padding-bottom: 25px;
        padding-left: 60px;
        padding-right: 60px;
      }
      .u-block-d7f8-14 {
        margin-top: 0;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-31 {
        margin-top: 11px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-32 {
        grid-template-columns: repeat(2, 50%);
        min-height: 208px;
        grid-auto-columns: 50%;
        grid-gap: 0px;
      }
      .u-block-d7f8-34 {
        padding-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 3px;
      }
      .u-block-d7f8-35 {
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-36 {
        margin-top: -3px;
        margin-left: 1px;
        margin-right: 1px;
        margin-bottom: 0;
      }
      .u-block-d7f8-38 {
        padding-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 3px;
      }
      .u-block-d7f8-39 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-40 {
        margin-top: -3px;
        margin-left: 1px;
        margin-right: 1px;
        margin-bottom: 0;
      }
      .u-block-d7f8-42 {
        padding-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 3px;
      }
      .u-block-d7f8-43 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-44 {
        margin-top: -3px;
        margin-left: 1px;
        margin-right: 1px;
        margin-bottom: 0;
      }
      .u-block-d7f8-46 {
        padding-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 3px;
      }
      .u-block-d7f8-47 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-48 {
        margin-top: -3px;
        margin-left: 1px;
        margin-right: 1px;
        margin-bottom: 0;
      }
      .u-block-d7f8-50 {
        padding-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 3px;
      }
      .u-block-d7f8-51 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-52 {
        margin-top: -3px;
        margin-left: 1px;
        margin-right: 1px;
        margin-bottom: 0;
      }
      .u-block-d7f8-54 {
        padding-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 3px;
      }
      .u-block-d7f8-55 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-56 {
        margin-top: -3px;
        margin-left: 1px;
        margin-right: 1px;
        margin-bottom: 0;
      }
      .u-block-d7f8-57 {
        height: 417px;
        margin-top: 20px;
        margin-right: 0;
        margin-bottom: 0;
        margin-left: 0;
      }
      .u-block-d7f8-58 {
        margin-left: 0;
      }
      .u-block-d7f8-73 {
        margin-left: 0;
      }
      .u-block-d7f8-72 {
        padding-top: 10px;
        padding-bottom: 10px;
      }
      .u-block-d7f8-22 {
        --radius: 6px;
        font-weight: 700;
        font-size: 0.9375rem;
        margin-top: 20px;
        margin-right: 144px;
        margin-bottom: 0;
        margin-left: auto;
        padding-top: 8px;
        padding-right: 24px;
        padding-bottom: 8px;
        padding-left: 23px;
      }
      .u-block-d7f8-23 {
        --radius: 6px;
        font-weight: 700;
        font-size: 0.9375rem;
        background-image: none;
        margin-top: -40px;
        margin-right: auto;
        margin-bottom: 0;
        margin-left: 146px;
        padding-top: 8px;
        padding-right: 79px;
        padding-bottom: 8px;
        padding-left: 78px;
      }
    }</style>
      <style data-mode="LG">@media (max-width: 1199px) and (min-width: 992px) {
      .u-block-d7f8-25 {
        min-height: 723px;
      }
      .u-block-d7f8-3 {
        margin-top: 60px;
        margin-bottom: 11px;
        min-height: 556px;
      }
      .u-block-d7f8-4 {
        background-image: url("np://user.desktop.nicepage.com/Site_9881637/images/bec4780631e6204803c2c76ed0388bdff62ee08c75e5765d228e81fbbb5a1c573c70d6009559dcd56eb3d2714a753747269119e4218281bf90f6ee_1280.jpg?rand=e665");
        background-position: 50% 50%;
        min-height: 670px;
      }
      .u-block-d7f8-5 {
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 60px;
        padding-right: 60px;
      }
      .u-block-d7f8-26 {
        min-height: 147px;
      }
      .u-block-d7f8-27 {
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 60px;
        padding-right: 60px;
      }
      .u-block-d7f8-28 {
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
        margin-top: 0;
      }
      .u-block-d7f8-29 {
        font-weight: 400;
        font-size: 1.25rem;
        margin-top: 14px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-30 {
        margin-top: 0;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-12 {
        min-height: 684px;
      }
      .u-block-d7f8-13 {
        padding-top: 25px;
        padding-bottom: 25px;
        padding-left: 60px;
        padding-right: 60px;
      }
      .u-block-d7f8-14 {
        margin-top: 0;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-31 {
        margin-top: 11px;
        margin-bottom: 0;
      }
      .u-block-d7f8-32 {
        grid-template-columns: repeat(2, 50%);
        grid-auto-columns: 50%;
        grid-gap: 0px;
        min-height: 166px;
      }
      .u-block-d7f8-34 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-35 {
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-36 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-38 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-39 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-40 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-42 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-43 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-44 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-46 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-47 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-48 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-50 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-51 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-52 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-54 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-55 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-56 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-57 {
        height: 417px;
        width: 646px;
        margin-top: 20px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-58 {
        margin-left: 0;
      }
      .u-block-d7f8-73 {
        margin-left: 0;
      }
      .u-block-d7f8-72 {
        padding-top: 10px;
        padding-bottom: 10px;
      }
      .u-block-d7f8-22 {
        --radius: 6px;
        font-weight: 700;
        font-size: 0.9375rem;
        margin-top: 109px;
        margin-right: 41px;
        margin-bottom: 0;
        margin-left: auto;
        padding-top: 8px;
        padding-right: 24px;
        padding-bottom: 8px;
        padding-left: 23px;
      }
      .u-block-d7f8-23 {
        --radius: 6px;
        font-weight: 700;
        font-size: 0.9375rem;
        margin-top: -40px;
        margin-right: auto;
        margin-bottom: 0;
        margin-left: 40px;
        padding-top: 8px;
        padding-right: 79px;
        padding-bottom: 8px;
        padding-left: 78px;
        background-image: none;
      }
    }</style>
      <style data-mode="MD">@media (max-width: 991px) and (min-width: 768px) {
      .u-block-d7f8-25 {
        min-height: 532px;
      }
      .u-block-d7f8-3 {
        margin-top: 60px;
        margin-bottom: 11px;
        min-height: 556px;
      }
      .u-block-d7f8-4 {
        background-image: url("np://user.desktop.nicepage.com/Site_9881637/images/bec4780631e6204803c2c76ed0388bdff62ee08c75e5765d228e81fbbb5a1c573c70d6009559dcd56eb3d2714a753747269119e4218281bf90f6ee_1280.jpg?rand=e665");
        background-position: 50% 50%;
        min-height: 513px;
      }
      .u-block-d7f8-5 {
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 30px;
        padding-right: 30px;
      }
      .u-block-d7f8-26 {
        min-height: 100px;
      }
      .u-block-d7f8-27 {
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 30px;
        padding-right: 30px;
      }
      .u-block-d7f8-28 {
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
        margin-top: 0;
      }
      .u-block-d7f8-29 {
        font-weight: 400;
        font-size: 1.25rem;
        margin-top: 14px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-30 {
        margin-top: 0;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-12 {
        min-height: 100px;
      }
      .u-block-d7f8-13 {
        padding-top: 25px;
        padding-bottom: 25px;
        padding-left: 30px;
        padding-right: 30px;
      }
      .u-block-d7f8-14 {
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
        margin-top: 0;
      }
      .u-block-d7f8-31 {
        margin-top: 11px;
        margin-bottom: 0;
      }
      .u-block-d7f8-32 {
        grid-template-columns: 100%;
        grid-auto-columns: 100%;
        grid-gap: 0px;
        min-height: 166px;
      }
      .u-block-d7f8-34 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-35 {
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-36 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-38 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-39 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-40 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-42 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-43 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-44 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-46 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-47 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-48 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-50 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-51 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-52 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-54 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-55 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-56 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-57 {
        height: 417px;
        width: 526px;
        margin-top: 20px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-58 {
        margin-left: 0;
      }
      .u-block-d7f8-73 {
        margin-left: 0;
      }
      .u-block-d7f8-72 {
        padding-top: 10px;
        padding-bottom: 10px;
      }
      .u-block-d7f8-22 {
        --radius: 6px;
        font-weight: 700;
        font-size: 0.9375rem;
        margin-top: 109px;
        margin-right: 0;
        margin-bottom: 0;
        margin-left: auto;
        padding-top: 8px;
        padding-right: 24px;
        padding-bottom: 8px;
        padding-left: 23px;
      }
      .u-block-d7f8-23 {
        --radius: 6px;
        font-weight: 700;
        font-size: 0.9375rem;
        margin-top: -40px;
        margin-right: auto;
        margin-bottom: 0;
        margin-left: 0;
        padding-top: 8px;
        padding-right: 79px;
        padding-bottom: 8px;
        padding-left: 78px;
        background-image: none;
      }
    }</style>
      <style data-mode="SM">@media (max-width: 767px) and (min-width: 576px) {
      .u-block-d7f8-25 {
        min-height: 2318px;
      }
      .u-block-d7f8-3 {
        margin-top: 60px;
        margin-bottom: 11px;
        min-height: 2142px;
      }
      .u-block-d7f8-4 {
        background-image: url("np://user.desktop.nicepage.com/Site_9881637/images/bec4780631e6204803c2c76ed0388bdff62ee08c75e5765d228e81fbbb5a1c573c70d6009559dcd56eb3d2714a753747269119e4218281bf90f6ee_1280.jpg?rand=e665");
        background-position: 50% 50%;
        min-height: 770px;
      }
      .u-block-d7f8-5 {
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-26 {
        min-height: 100px;
      }
      .u-block-d7f8-27 {
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-28 {
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
        margin-top: 0;
      }
      .u-block-d7f8-29 {
        font-weight: 400;
        font-size: 1.25rem;
        margin-top: 14px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-30 {
        margin-top: 0;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-12 {
        min-height: 100px;
      }
      .u-block-d7f8-13 {
        padding-top: 25px;
        padding-bottom: 25px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-14 {
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
        margin-top: 0;
      }
      .u-block-d7f8-31 {
        margin-top: 11px;
        margin-bottom: 0;
      }
      .u-block-d7f8-32 {
        grid-template-columns: 100%;
        grid-auto-columns: 100%;
        grid-gap: 0px;
        min-height: 166px;
      }
      .u-block-d7f8-34 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-35 {
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-36 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-38 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-39 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-40 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-42 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-43 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-44 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-46 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-47 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-48 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-50 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-51 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-52 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-54 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-55 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-56 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-57 {
        height: 417px;
        width: 520px;
        margin-top: 20px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-58 {
        margin-left: 0;
      }
      .u-block-d7f8-73 {
        margin-left: 0;
      }
      .u-block-d7f8-72 {
        padding-top: 10px;
        padding-bottom: 10px;
      }
      .u-block-d7f8-22 {
        --radius: 6px;
        font-weight: 700;
        font-size: 0.9375rem;
        margin-top: 109px;
        margin-right: 0;
        margin-bottom: 0;
        margin-left: auto;
        padding-top: 8px;
        padding-right: 24px;
        padding-bottom: 8px;
        padding-left: 23px;
      }
      .u-block-d7f8-23 {
        --radius: 6px;
        font-weight: 700;
        font-size: 0.9375rem;
        margin-top: -40px;
        margin-right: auto;
        margin-bottom: 0;
        margin-left: 0;
        padding-top: 8px;
        padding-right: 79px;
        padding-bottom: 8px;
        padding-left: 78px;
        background-image: none;
      }
    }</style>
      <style data-mode="XS" data-visited="true">@media (max-width: 575px) {
      .u-block-d7f8-25 {
        min-height: 1541px;
      }
      .u-block-d7f8-3 {
        margin-top: 60px;
        margin-bottom: 11px;
        min-height: 1365px;
      }
      .u-block-d7f8-4 {
        background-image: url("np://user.desktop.nicepage.com/Site_9881637/images/bec4780631e6204803c2c76ed0388bdff62ee08c75e5765d228e81fbbb5a1c573c70d6009559dcd56eb3d2714a753747269119e4218281bf90f6ee_1280.jpg?rand=e665");
        background-position: 50% 50%;
        min-height: 485px;
      }
      .u-block-d7f8-5 {
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-26 {
        min-height: 100px;
      }
      .u-block-d7f8-27 {
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-28 {
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
        margin-top: 0;
      }
      .u-block-d7f8-29 {
        font-weight: 400;
        font-size: 1.25rem;
        margin-top: 14px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-30 {
        margin-top: 0;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-12 {
        min-height: 100px;
      }
      .u-block-d7f8-13 {
        padding-top: 25px;
        padding-bottom: 25px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-14 {
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
        margin-top: 0;
      }
      .u-block-d7f8-31 {
        margin-top: 11px;
        margin-bottom: 0;
      }
      .u-block-d7f8-32 {
        grid-template-columns: 100%;
        grid-auto-columns: 100%;
        grid-gap: 0px;
        min-height: 166px;
      }
      .u-block-d7f8-34 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-35 {
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-36 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-38 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-39 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-40 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-42 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-43 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-44 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-46 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-47 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-48 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-50 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-51 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-52 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-54 {
        padding-top: 10px;
        padding-bottom: 3px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .u-block-d7f8-55 {
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
      }
      .u-block-d7f8-56 {
        margin-top: -3px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-57 {
        height: 417px;
        width: 320px;
        margin-top: 20px;
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
      }
      .u-block-d7f8-58 {
        margin-left: 0;
      }
      .u-block-d7f8-73 {
        margin-left: 0;
      }
      .u-block-d7f8-72 {
        padding-top: 10px;
        padding-bottom: 10px;
      }
      .u-block-d7f8-22 {
        --radius: 6px;
        font-weight: 700;
        font-size: 0.9375rem;
        margin-top: 109px;
        margin-right: 0;
        margin-bottom: 0;
        margin-left: auto;
        padding-top: 8px;
        padding-right: 24px;
        padding-bottom: 8px;
        padding-left: 23px;
      }
      .u-block-d7f8-23 {
        --radius: 6px;
        font-weight: 700;
        font-size: 0.9375rem;
        background-image: none;
        margin-top: -40px;
        margin-right: auto;
        margin-bottom: 0;
        margin-left: 0;
        padding-top: 8px;
        padding-right: 25px;
        padding-bottom: 8px;
        padding-left: 23px;
      }
    }</style>
  </head>
<body class="u-body u-xl-mode">
  <header class="u-clearfix u-header" id="sec-4e01"><div class="u-clearfix u-sheet u-sheet-1">
    <nav class="u-menu u-menu-one-level u-menu-open-right u-offcanvas u-menu-1" data-responsive-from="MD">
      <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px; font-weight: 700; text-transform: uppercase;">
        <a class="u-button-style u-custom-active-border-color u-custom-active-color u-custom-border u-custom-border-color u-custom-borders u-custom-hover-border-color u-custom-hover-color u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-active-color u-custom-text-color u-custom-text-hover-color u-custom-top-bottom-menu-spacing u-nav-link" href="#" style="padding: 0px; font-size: calc(1em + 0.5px);">
          <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 302 302" style=""><use xlink:href="#svg-5247"></use></svg>
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg-5247" x="0px" y="0px" viewBox="0 0 302 302" style="enable-background:new 0 0 302 302;" xml:space="preserve" class="u-svg-content"><g><rect y="36" width="302" height="30"></rect><rect y="236" width="302" height="30"></rect><rect y="136" width="302" height="30"></rect>
</g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
        </a>
      </div>
      <div class="u-custom-menu u-nav-container">
        <ul class="u-nav u-spacing-30 u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="StudentHomePage.php" style="padding: 10px 0px;">Student Home page</a>
</li><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;" href="StudentProfile.php">Profile</a>
</li><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;" href="StudentRequest.php">Request list</a>

</li><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;" href="index.php">Log out</a>
</li></ul>
      </div>
      <div class="u-custom-menu u-nav-container-collapse">
        <div class="u-container-style u-inner-container-layout u-opacity u-opacity-95 u-palette-1-dark-2 u-sidenav">
          <div class="u-inner-container-layout u-sidenav-overflow">
            <div class="u-menu-close"></div>
            <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="./">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link">Sign Up</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link">Login</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link">Request Project from CCIS</a>
</li></ul>
          </div>
        </div>
        <div class="u-menu-overlay u-opacity u-opacity-70 u-palette-1-dark-2"></div>
      </div>
      <style class="menu-style">@media (max-width: 939px) {
                [data-responsive-from="MD"] .u-nav-container {
                    display: none;
                }
                [data-responsive-from="MD"] .menu-collapse {
                    display: block;
                }
            }</style>
    </nav>
    <a href="#" class="u-image u-logo u-image-1" data-image-width="276" data-image-height="194">
      <img src="images/logo_GP-noname.png" class="u-logo-image u-logo-image-1">
    </a>
  </div></header>
    
    <!-- <section class="u-clearfix u-palette-1-light-1 u-section-1">
        <div class="u-clearfix u-sheet u-sheet-1">
            <div class="u-align-left u-container-style u-expanded-width u-group u-white u-radius u-shape-round u-group-1">
                <div class="u-container-layout u-valign-top u-container-layout-1">
                    <div class="u-container-style u-layout-cell u-size-30 u-white">
                      <div class="u-custom-font u-font-oswald u-text-palette-1-dark-2">
                          <h2 class="u-align-left u-custom-font u-font-oswald u-text u-text-palette-1-dark-2 u-text-1">Supervisor Name </h2>
                          <h2 class="u-align-left u-custom-font u-font-oswald u-subtitle u-text u-text-palette-1-dark-1 u-text-2">Email​@ksu.edu.sa</h2>
                          <h5 class="u-align-left u-custom-font u-font-oswald u-text u-text-palette-1-dark-1 u-text-3">TRACK:Cybersecurity </h5>
                          </p>
                        </div>
                    </div>

                    <div class="u-container-style u-layout-cell u-size-30 u-white">
                        <div class="u-container-layout">
                            <h2 class="u-custom-font u-font-oswald u-text-palette-1-dark-2">Student Information</h2>
                            <div class="u-list">
                                <div class="u-repeater">
                                    <div class="u-list-item">
                                        <h4>Leader Name:</h4>
                                        <p>Sample text.</p>
                                    </div>
                                    <div class="u-list-item">
                                        <h4>Leader Email:</h4>
                                        <p>Sample text.</p>
                                    </div>
                                    <div class="u-list-item">
                                        <h4>Student Name:</h4>
                                        <p>Sample text.</p>
                                    </div>
                                    <div class="u-list-item">
                                        <h4>Student Name:</h4>
                                        <p>Sample text.</p>
                                    </div>
                                    <div class="u-list-item">
                                        <h4>Student Name:</h4>
                                        <p>Sample text.</p>
                                    </div>
                                    <div class="u-list-item">
                                        <h4>Student Name:</h4>
                                        <p>Sample text.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                    <div class="u-form">
                      <form action="https://forms.nicepagesrv.com/v2/form/process" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" source="email" data-services="5b2c2fa98341ebfafacab05d9cb29269" name="form" style="padding: 10px;">
                        <input type="hidden" id="siteId" name="siteId" value="9881637">
                        <input type="hidden" id="pageId" name="pageId" value="2646728883">
                        <div class="u-form-group u-form-select u-label-top u-block-d7f8-58">
                    <label for="select-e666" class="u-label u-block-d7f8-59">Select your project preference:</label>
                    <div class="u-form-select-wrapper">
                      <select id="select-e666" name="select" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-4">
                        <option value="Supervisor Idea" data-calc="" selected="selected">Supervisor Idea</option>
                        <option value="Your Own Idea" data-calc="">Your Own Idea</option>
                       </select>
                      <svg class="u-caret u-caret-svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" style="fill:currentColor;" xml:space="preserve"><polygon class="st0" points="8,12 2,4 14,4 "></polygon></svg>
                    </div>

                </div>
                <div class="u-form-group u-form-message u-label-top u-block-d7f8-67" data-dependency="[{&quot;action&quot;:&quot;hide&quot;,&quot;field&quot;:&quot;select&quot;,&quot;condition&quot;:&quot;equal&quot;,&quot;value&quot;:&quot;Your Own Idea&quot;}]">
                            <label for="message-8910" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-5">Idea</label>
                            <textarea placeholder="​" rows="4" cols="50" id="message-8910" name="Idea" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-5" ></textarea>
                        </div>
                        <div class="u-form-group u-form-message u-label-top u-block-d7f8-67" data-dependency="[{&quot;action&quot;:&quot;show&quot;,&quot;field&quot;:&quot;select&quot;,&quot;condition&quot;:&quot;equal&quot;,&quot;value&quot;:&quot;Your Own Idea&quot;}]">
                    <label for="textarea-273f" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-5">Write your Idea</label>
                    <textarea rows="4" cols="50" id="textarea-273f" name="Idea" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-5" required=""></textarea>
                </div><div class="u-form-group u-label-top u-block-d7f8-64" data-dependency="[{&quot;action&quot;:&quot;show&quot;,&quot;field&quot;:&quot;select&quot;,&quot;condition&quot;:&quot;equal&quot;,&quot;value&quot;:&quot;Your Own Idea&quot;}]">
                            <label for="email-8910" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-5">Project Name</label>
                            <input type="text" placeholder="Enter your project name if you have any" id="email-8910" name="ProjectName" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none u-palette-1-light-3">
                        </div>
                        
                        <div class="u-align-left u-form-group u-form-submit u-label-top u-block-d7f8-70">
                            
                          <a href="#" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius u-btn-1">REQUEST SUPERVISORS </a>
                          <a href="ViewSupervisor.php" class="u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-light-3 u-radius u-btn-2">BACK </a>
                        
                        <div class="u-form-send-message u-form-send-success">
                            Thank you! Your message has been sent.
                        </div>
                        <div class="u-form-send-error u-form-send-message">
                            Unable to send your message. Please fix errors then try again.
                        </div>
                        <input type="hidden" value="" name="recaptchaResponse">
                    </form>
                    </div>

                </div>
            </div>
        </div>
    </section> -->

    <section class="u-clearfix u-palette-1-light-1 u-section-1">
    <div class="u-clearfix u-sheet u-sheet-1">
        <!-- Request Form -->
        <div class="u-align-left u-container-style u-expanded-width u-group u-white u-radius u-shape-round u-group-1">
            <div class="u-container-layout u-valign-top u-container-layout-1">
                <!-- Supervisor Information -->
  
                
                <div class="u-container-style u-layout-cell u-size-30 u-white">
                    <div class="u-custom-font u-font-oswald u-text-palette-1-dark-2">
                    <?php
                
                if ($userEmail) {
                  // Prepare and execute the query to fetch supervisor data
                $stmt = $con->prepare("SELECT name, email, track FROM supervisors WHERE email = :id");
                $stmt->bindParam(':id', $supervisorEmail);
                $stmt->execute();
                $supervisor = $stmt->fetch(PDO::FETCH_ASSOC);
              
                  if ($supervisor) {
                      // Display supervisor information
                      $track = htmlspecialchars($supervisor['track'] ?? 'Unspecified');
                      $email = htmlspecialchars($supervisor['email']);
              
                      echo "
                      <h2 class='u-align-left u-custom-font u-font-oswald u-text u-text-palette-1-dark-2 u-text-1'>Supervisor Name: " . htmlspecialchars($supervisor['name']) . "</h2>
                      <h2 class='u-align-left u-custom-font u-font-oswald u-subtitle u-text u-text-palette-1-dark-1 u-text-2'>Email: $email</h2>
                      <h5 class='u-align-left u-custom-font u-font-oswald u-text u-text-palette-1-dark-1 u-text-3'>TRACK: $track</h5>";
                  } else {
                      echo "No supervisor data found.";
                  }
              } else {
                  echo "User not logged in.";
              }

                // Fetch supervisor data from the database
                
                ?>
                    </div>
                </div>

                <!-- Student Information -->
                <?php

                // Fetch student data from the database
                $stmt = $con->prepare("SELECT name, email FROM students WHERE team_email = :team_email");
                $stmt->bindParam(':team_email', $userEmail); // assuming the supervisor's email links to the student team
                $stmt->execute();
                $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <div class="u-container-style u-layout-cell u-size-30 u-white">
                    <div class="u-container-layout">
                        <h2 class="u-custom-font u-font-oswald u-text-palette-1-dark-2">Student Information</h2>
                        <div class="u-list">
                            <div class="u-repeater">
                            <?php if (!empty($students)): ?>
    <!-- Display leader's information -->
    <div class="u-list-item">
        <h4>Leader Name:</h4>
        <p><?= htmlspecialchars($students[0]['name']) ?></p>
    </div>
    <div class="u-list-item">
        <h4>Leader Email:</h4>
        <p><?= htmlspecialchars($students[0]['email']) ?></p>
    </div>

    <!-- Display other students' information -->
    <?php foreach (array_slice($students, 1) as $student): ?>
        <div class="u-list-item">
            <h4>Student Name:</h4>
            <p><?= htmlspecialchars($student['name']) ?></p>
        </div>
        <div class="u-list-item">
            <h4>Student Email:</h4>
            <p><?= htmlspecialchars($student['email']) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No student data available.</p>
<?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
<div class="u-form">
<form action="RequestSupervisor.php" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px;">
    <div class="u-form-group u-form-select u-label-top u-block-d7f8-58">
        <label for="projectPreference" class="u-label u-block-d7f8-59">
            Select your project preference<span style="color: red;">*</span>:
        </label>
        <div class="u-form-select-wrapper">
            <select 
                id="projectPreference" 
                name="select" 
                class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-4"
            >
                <?php if ($hasSupervisorIdeas): ?>
                    <option value="Supervisor Idea" selected="selected">Supervisor Idea</option>
                <?php endif; ?>
                <option value="Your Own Idea">Your Own Idea</option>
            </select>
        </div>
    </div>
    
    <!-- Text Input for Project Name -->
    <div id="projectNameGroup" class="u-form-group u-form-message u-label-top u-block-d7f8-67" style="display: none;">
        <label for="projectName" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-5">
            Project Name (Optional)
        </label>
        <input 
            type="text" 
            id="projectName" 
            name="project_name" 
            class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-5"
            placeholder="Enter your project name"
        />
    </div>

    <!-- Textarea for Supervisor Idea -->
    <div class="u-form-group u-form-message u-label-top u-block-d7f8-67">
        <label for="ideaTextarea" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-5" id="textareaLabel">
            Idea <span style="color: red;">*</span>
        </label>
        <textarea 
            rows="4" 
            cols="50" 
            id="ideaTextarea" 
            name="Idea" 
            class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-5"
            <?= $hasSupervisorIdeas ? 'readonly' : '' ?>
            placeholder="<?= $hasSupervisorIdeas ? '' : 'Write your idea here' ?>"
        >
            <?= $hasSupervisorIdeas ? htmlspecialchars($supervisors[0]['idea']) : '' ?>
        </textarea>
    </div>

    <div class="u-align-left u-form-group u-form-submit u-label-top u-block-d7f8-70">
        <button type="submit" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius u-btn-1">
            REQUEST SUPERVISORS
        </button>
        <input type="hidden" name="supervisor_email" value="<?= htmlspecialchars($supervisorEmail) ?>">
        <a href="ViewSupervisor.php" class="u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-light-3 u-radius u-btn-2">BACK</a>
    </div>
</form>




                </div>
            </div>
        </div>
    </div>
</section>

    <footer class="u-clearfix u-custom-color-3 u-footer" id="sec-9e3e"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
      <div class="data-layout-selected u-clearfix u-expanded-width u-gutter-30 u-layout-wrap u-layout-wrap-1">
        <div class="u-gutter-0 u-layout">
          <div class="u-layout-row">
            <div class="u-align-left u-container-style u-layout-cell u-left-cell u-size-60 u-layout-cell-1">
              <div class="u-container-layout u-container-layout-1">
                <h5 class="u-align-center u-text u-text-default u-text-1">Thank you for visiting our website!<br>If you have any suggestions, please do not hesitate to contact us
                </h5><!--position-->
                <div data-position="" class="u-position u-position-1"><!--block-->
                  <div class="u-block">
                    <div class="u-block-container u-clearfix"><!--block_header-->
                      <h5 class="u-block-header u-text"><!--block_header_content--><!--/block_header_content--></h5><!--/block_header--><!--block_content-->
                      <div class="u-block-content u-text"><!--block_content_content--><!--/block_content_content--></div><!--/block_content-->
                    </div>
                  </div><!--/block-->
                </div><!--/position-->
                <div class="u-social-icons u-spacing-10 u-social-icons-1" data-animation-name="" data-animation-duration="0" data-animation-direction="">
                  <a class="u-social-url" title="Email" target="_blank" href=""><span class="u-file-icon u-icon u-social-facebook u-social-icon u-icon-1"><img src="images/542740.png" alt=""></span>
                  </a>
                  <a class="u-social-url" title="department website" target="_blank" href="https://ccis.ksu.edu.sa/ar"><span class="u-file-icon u-icon u-social-icon u-social-linkedin u-icon-2"><img src="images/3308395.png" alt=""></span>
                  </a>
                  <a class="u-social-url" title="twitter" target="_blank" href="https://x.com/fccis_ksu?s=11&amp;t=U-hrOO7JjdBm0Zm8XnUG6A"><span class="u-file-icon u-icon u-social-icon u-social-twitter u-icon-3"><img src="images/11823292.png" alt=""></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div></footer>
    <script>
    document.getElementById('projectPreference').addEventListener('change', function () {
        const preference = this.value;
        const projectNameGroup = document.getElementById('projectNameGroup');
        const textarea = document.getElementById('ideaTextarea');

        if (preference === 'Your Own Idea') {
            // Show project name input
            projectNameGroup.style.display = 'block';

            // Enable textarea editing
            textarea.readOnly = false;
            textarea.placeholder = 'Write your idea here';
        } else {
            // Hide project name input
            projectNameGroup.style.display = 'none';

            // Make textarea read-only with supervisor's idea
            textarea.readOnly = true;
            textarea.placeholder = '';
        }
    });

    // Initialize form behavior on page load
    window.addEventListener('load', function () {
        document.getElementById('projectPreference').dispatchEvent(new Event('change'));
    });
</script>
</body>
</html>
