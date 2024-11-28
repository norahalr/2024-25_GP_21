<?php 
    require_once 'config/connect.php';

    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $interest=$_POST['interest'];
    $track=$_POST['track'];
    $idea=$_POST['idea'];

    $sql = "UPDATE supervisors
        SET 
        phone_number = '".$phone."',
        interest = '".$interest."',
        track = '".$track."',
        idea = '".$idea."'
        WHERE email ='".$email."'";
  $stmt = $con->prepare($sql);
  $stmt->execute();

    header("Location: supervisorProfile.php?do=success");
?>