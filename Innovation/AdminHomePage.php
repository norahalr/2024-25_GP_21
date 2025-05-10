<?php
// AdminHomePage.php
require_once 'config/connect.php';
session_start();




  if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
      header("Location: LogIn.php");
      exit();
  }
  // Dummy admin authentication for now

?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="SupervisorHomePage.css" media="screen"> <!-- Reusing Supervisor styles -->
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
</head>
<body class="u-body u-xl-mode" data-lang="en">
<header class="u-clearfix u-header" id="sec-4e01">
  <div class="u-clearfix u-sheet u-sheet-1">
    <nav class="u-menu u-menu-one-level u-menu-open-right u-offcanvas u-menu-1" data-responsive-from="MD">
      <div class="menu-collapse">
        <a class="u-button-style u-nav-link" href="#">
          <svg class="u-svg-link" viewBox="0 0 302 302"><use xlink:href="#svg-5247"></use></svg>
        </a>
      </div>
      <div class="u-custom-menu u-nav-container">
        <ul class="u-nav u-spacing-30 u-unstyled u-nav-1">
          <li class="u-nav-item"><a class="u-nav-link" href="AdminHomePage.php" style="padding: 10px 0px;">Admin Home</a></li>
          <li class="u-nav-item"><a class="u-nav-link" href="adminAddProject.php" style="padding: 10px 0px;">Add Projects</a></li>
          <li class="u-nav-item"><a class="u-nav-link" href="index.php" style="padding: 10px 0px;">Log out</a></li>
        </ul>
      </div>
    </nav>
    <a href="#" class="u-image u-logo u-image-1" data-image-width="276" data-image-height="194">
      <img src="images/logo_GP-noname.png" class="u-logo-image u-logo-image-1">
    </a>
  </div>
</header>

<section class="u-section-1 u-clearfix u-gradient" id="carousel_adc9">
  <div class="u-clearfix u-sheet u-sheet-1">
    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-bottom: 20px;">
  <h2 class="u-text u-text-default">Hello Admin 👋</h2>
  <a href="adminAddProject.php" class="u-btn u-btn-round u-button-style u-palette-1-base u-hover-palette-1-light-2 u-radius u-btn-2">
    Add New Project
  </a>
</div>



    <div class="u-expanded-width u-layout-grid u-list u-list-1">
<div class="u-container-layout u-container-layout-1" style="height: 250px; display: flex; flex-direction: column; justify-content: center; ">
        <?php
        $stmt = $con->prepare("SELECT * FROM external_departments_requests ORDER BY request_date DESC");
        $stmt->execute();
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($requests as $req) {
          echo '<div class="u-list-item u-radius u-repeater-item u-shape-round u-white u-list-item-1" style="border:2px solid #478ac9;">
  <div class="u-container-layout" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 20px;">
    <h5 class="u-text u-text-2">Faculty: ' . htmlspecialchars($req['faculty_name']) . '</h5>
    <p class="u-text u-text-4">Email: ' . htmlspecialchars($req['email']) . '</p>
    <p class="u-text u-text-4">College: ' . htmlspecialchars($req['collage']) . '</p>
    <p class="u-text u-text-4">Idea: ' . htmlspecialchars($req['idea_description']) . '</p>
    <p class="u-text u-text-4">Status: ' . htmlspecialchars($req['status']) . '</p>
    <div style=" text-align: center;">
      <a href="adminDecision.php?id=' . $req['id'] . '" class="u-btn u-btn-round u-button-style u-hover-white u-palette-1-light-1 u-radius" style="margin-top: 15px;">Review</a>
    </div>
  </div>
</div>';


        }
        ?>
      </div>
    </div>
  </div>
</section>

<footer class="u-clearfix u-custom-color-3 u-footer" id="sec-9e3e">
  <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
    <h5 class="u-align-center u-text">Thank you for visiting our website!<br>If you have any suggestions, please contact us.</h5>
  </div>
</footer>
</body>
</html>