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


  
$request_id = $_GET['id'] ?? null; // Get request ID from URL
$request_type = $_GET['type'] ?? null; // Get request type from URL

if ($request_id && $request_type) {
  // Dynamically select the table based on the request type
  $table = '';
  switch ($request_type) {
      case 'team_idea_request':
          $table = 'team_idea_request';
          break;
      case 'supervisor_idea_request':
          $table = 'supervisor_idea_request';
          break;
      default:
          $_SESSION['error'] = "Invalid request type.";
          header("Location: StudentRequest.php");
          exit();
  }

  // Fetch the request details
  $stmt = $con->prepare("SELECT * FROM $table WHERE id = :id");
  $stmt->bindParam(':id', $request_id);
  $stmt->execute();
  $request = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$request) {
      $_SESSION['error'] = "Request not found.";
      header("Location: StudentRequest.php");
      exit();
  }

  // Check if the request has supervisor ideas
   $hasSupervisorIdeas = ($request_type === 'supervisor_idea_request');// && !empty($request['project_name']);
} else {
  $_SESSION['error'] = "Missing request ID or type.";
    header("Location: StudentRequest.php");
    exit();
}
// Fetch supervisors with ideas
if( $hasSupervisorIdeas ){
$query = "SELECT idea  FROM supervisors WHERE idea IS NOT NULL AND idea != '' AND email = :email ";
$stmt = $con->prepare($query);
$stmt->execute(['email' => $request["supervisor_email"]]);
$supervisors = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
//$supervisor_email = count($supervisors) > 0;


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
<?php include "Student_menu.php";?>
    <a href="#" class="u-image u-logo u-image-1" data-image-width="276" data-image-height="194">
      <img src="images/logo_GP-noname.png" class="u-logo-image u-logo-image-1">
    </a>
  </div></header>
    
    
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
                $stmt->bindParam(':id', $request["supervisor_email"]);
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
                <form action="Update-Request.php" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px;">
    <!-- Project Preference Dropdown -->
    <div class="u-form-group u-form-select u-label-top u-block-d7f8-58">
        <label for="projectPreference" class="u-label u-block-d7f8-59">
            Select your project preference<span style="color: red;">*</span>:
        </label>
        <div class="u-form-select-wrapper">
            <select 
                id="projectPreference" 
                name="project_preference" 
                class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-4"
            >
                <!-- <option value="Supervisor Idea"<?//= $hasSupervisorIdeas ? 'selected' : '' ?>>Supervisor Idea</option> -->
                <option value="Your Own Idea" <?= !$hasSupervisorIdeas ? 'selected' : '' ?>>Your Own Idea</option>
            </select>
        </div>
    </div>

  <!-- Text Input for Project Name -->
<div id="projectNameGroup" class="u-form-group u-form-message u-label-top u-block-d7f8-67" style="display: <?= !$hasSupervisorIdeas ? 'block' : 'none' ?>;">
    <label for="projectName" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-5">
        Project Name (Optional)
    </label>
    <input 
        type="text" 
        id="projectName" 
        name="project_name" 
        class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-5"
        placeholder="Enter your project name"
        value="<?= htmlspecialchars($request['project_name'] ?? '') ?>" 
    />
</div>

    <!-- Textarea for Project Idea -->
    <div class="u-form-group u-form-message u-label-top u-block-d7f8-67">
    <label for="ideaTextarea" class="u-label">
        Idea <span style="color: red;">*</span>
    </label>
    <textarea 
        required
        rows="4" 
        cols="50" 
        id="ideaTextarea" 
        name="idea" 
        class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-5"
        <?= $hasSupervisorIdeas ? 'readonly' : '' ?>
        placeholder="Write your idea here" 
    >
        <?= htmlspecialchars(trim($request['description']))  ?>  
    </textarea>
</div>
    <!-- Submit and Cancel Buttons -->
    <div class="u-align-left u-form-group u-form-submit">
        <button type="submit" class="u-btn u-radius u-btn-1">Update Request</button>
        <input type="hidden" name="request_id" value="<?= htmlspecialchars($request_id) ?>">
        <input type="hidden" name="request_type" value="<?= htmlspecialchars($request_type) ?>">
        <a href="StudentRequest.php" class="u-btn u-radius u-btn-2">Cancel</a>
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
