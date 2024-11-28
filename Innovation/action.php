<?php 
  require_once 'config/connect.php';

  if($_GET['type']=='team'){
    $table='team_idea_request';

  }else if ($_GET['type']=='supervisor'){
    $table='supervisor_idea_request';

    $sql = "UPDATE 
            supervisors
        SET availability = 'Unavailable'
        WHERE email ='".$_GET['email']."'";
        $stmt = $con->prepare($sql);
        $stmt->execute();

  }else{
    header("Location: SupervisorHomePage.php");
  }
  if($_GET['status']!='Rejected' && $_GET['status']!='Approved'){
    header("Location: SupervisorHomePage.php");
  }
  $sql = "UPDATE 
           ".$table." 
        SET status = '".$_GET['status']."'
        WHERE id =".$_GET['id'];
  $stmt = $con->prepare($sql);
  $stmt->execute();

  header("Location: ViewSpecificRequest.php?id=".$_GET['id']."&type=".$_GET['type']);
?>