<?php
  require_once 'config/connect.php';
  session_start();
  ob_start();

?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content=" Registration ​">
    <meta name="description" content="">
    <title>Registration</title>
    <link rel="stylesheet" href="nicepage2.css" media="screen">
    <link rel="stylesheet" href="supervisorRegister.css" media="screen">
    <link rel="stylesheet" href="studentRegister.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.19.6, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">



    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "Site1"
    }
    </script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="supervisorRegister">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
    <style>
        a {
    cursor: pointer;
    /* color: blue; */
    text-decoration: underline;
    font-size: 12px; /* Change this value to adjust the size */

}

    input[type="radio"] {
        display: none;
    }

    .radio-btn-container {
        position: relative;
        display: flex;
        width: 100%;
        margin: 20px 0;
        border: 1px solid lightgrey;
        border-radius: 15px;
        overflow: hidden;
    }

    .radio-btn {
        flex: 1;
        text-align: center;
        font-family: 'Georgia', serif;
        cursor: pointer;
        font-size: 18px;
        color: #333;
        transition: color 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .slider-tab {
        position: absolute;
        height: 100%;
        width: 50%;
        left: 0;
        background-color: #2196F3;
        background: linear-gradient(to right, #296aa4, #11518a);
        transition: left 0.3s ease;
        z-index: 0;
    }

    #student:checked~.slider-tab {
        left: 50%;
        /* Move the tab to the right when student is checked */
    }
    #member:checked~.slider-tab {
        left: 50%;
        /* Move the tab to the right when student is checked */
    }
    input:checked + .radio-btn + .radio-btn + .slider-tab {
        background-color: #4CAF50;}

    .u-form-group {
        font-family: 'Georgia', serif;
    }

    .role-radio {
        display: none;
    }

    .radio-btn-container2 {
        display: flex;
        align-items: center;
        position: relative;
        justify-content: space-between;
        width: 200px; /* Set width of the container */
    }

    .role-label {
        font-size: 16px;
        color: #333;
        cursor: pointer;
        text-align: center;
        flex-grow: 1;
        padding: 10%;
        transition: color 0.3s;
    }

    .role-label:hover {
        color: #007BFF;
    }

    .slider-tab {
        position: absolute;
        top: 0;
        left: 0;
        width: 50%;
        height: 100%;
        background-color: #2196F3;
        transition: 0.3s;
        border-radius: 20px;
        opacity: 0.3;
    }

    
    </style>
</head>

<body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en">
    <!-- Header Section -->
    <header class="u-clearfix u-header" id="sec-4e01">
        <div class="u-clearfix u-sheet u-sheet-1">
            <nav class="u-menu u-menu-one-level u-menu-open-right u-offcanvas u-menu-1" data-responsive-from="MD">
                <div class="menu-collapse"
                    style="font-size: 1rem; letter-spacing: 0px; font-weight: 700; text-transform: uppercase;">
                    <a class="u-button-style u-custom-active-border-color u-custom-active-color u-custom-border u-custom-border-color u-custom-borders u-custom-hover-border-color u-custom-hover-color u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-active-color u-custom-text-color u-custom-text-hover-color u-custom-top-bottom-menu-spacing u-nav-link"
                        href="#" style="padding: 0px; font-size: calc(1em + 0.5px);">
                        <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 302 302" style="">
                            <use xlink:href="#svg-5247"></use>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            id="svg-5247" x="0px" y="0px" viewBox="0 0 302 302"
                            style="enable-background:new 0 0 302 302;" xml:space="preserve" class="u-svg-content">
                            <g>
                                <rect y="36" width="302" height="30"></rect>
                                <rect y="236" width="302" height="30"></rect>
                                <rect y="136" width="302" height="30"></rect>
                            </g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                        </svg>
                    </a>
                </div>
                <div class="u-custom-menu u-nav-container">
                    <ul class="u-nav u-spacing-30 u-unstyled u-nav-1">
                        <li class="u-nav-item"><a
                                class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90"
                                href="index.php" style="padding: 10px 0px;">Home</a>
                        </li>
                        <li class="u-nav-item"><a
                                class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90"
                                style="padding: 10px 0px;" href="Register.php">Sign Up</a>
                        </li>
                        <li class="u-nav-item"><a
                                class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90"
                                style="padding: 10px 0px;" href="LogIn.php">Login</a>
                        </li>
                        <li class="u-nav-item"><a
                                class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90"
                                style="padding: 10px 0px;" href="externalForm.php">Request Project from CCIS</a>
                        </li>
                    </ul>
                </div>
                <div class="u-custom-menu u-nav-container-collapse">
                    <div
                        class="u-container-style u-inner-container-layout u-opacity u-opacity-95 u-palette-1-dark-2 u-sidenav">
                        <div class="u-inner-container-layout u-sidenav-overflow">
                            <div class="u-menu-close"></div>
                            <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
                                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="index.php">Home</a>
                                </li>
                                <li class="u-nav-item"><a class="u-button-style u-nav-link">Sign Up</a>
                                </li>
                                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="LogIn.php">Login</a>
                                </li>
                                <li class="u-nav-item"><a class="u-button-style u-nav-link"
                                        href="externalForm.php">Request Project from CCIS</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="u-menu-overlay u-opacity u-opacity-70 u-palette-1-dark-2"></div>
                </div>
                <style class="menu-style">
                @media (max-width: 939px) {
                    [data-responsive-from="MD"] .u-nav-container {
                        display: none;
                    }

                    [data-responsive-from="MD"] .menu-collapse {
                        display: block;
                    }
                }
                </style>
            </nav>
            <a href="#" class="u-image u-logo u-image-1" data-image-width="276" data-image-height="194">
                <img src="images/logo_GP-noname.png" class="u-logo-image u-logo-image-1">
            </a>
        </div>
    </header>
    <section class="u-clearfix u-palette-1-light-1 u-section-1" id="sec-eb0d">
        <div class="u-clearfix u-sheet u-sheet-1">
            <div
                class="u-expanded-height u-expanded-height-lg u-expanded-height-md u-expanded-height-xl u-opacity u-opacity-60 u-palette-1-base u-shape u-shape-rectangle u-shape-1">
            </div>
            <div
                class="u-align-left u-container-align-left u-container-style u-expanded-width u-group u-radius u-shape-round u-white u-group-1">
                <div class="u-container-layout u-valign-top u-container-layout-1">
                    <div class="custom-expanded data-layout-selected u-clearfix u-layout-wrap u-layout-wrap-1">
                        <div class="u-layout">
                            <div class="u-layout-row">
                                <div class="u-container-style u-layout-cell u-size-60 u-layout-cell-1"
                                    data-animation-name="customAnimationIn" data-animation-duration="1500"
                                    data-animation-delay="500">
                                    <div class="u-container-layout u-container-layout-2">
                                        <!-- Add Radio Buttons to choose between Supervisor or Student -->
                                        <!-- Supervisor Login Form 
                                <form id="supervisor-login-form" class="supervisorLogin">
                                    <h2 class="u-text u-text-custom-color-3 u-text-default u-text-1">Supervisor Login</h2>
                                    <div class="field">
                                        <input type="text" placeholder="Email Address" required>
                                    </div>
                                    <div class="field">
                                        <input type="password" placeholder="Password" required>
                                    </div>
                                    <div class="pass-link"><a href="#">Forgot password?</a></div>
                                    <div class="field btn">
                                        <input type="submit" value="Login">
                                    </div>
                                </form>
-->

                                        <!-- Student Login Form 
                                <form id="student-login-form" class="studentsLogin" style="display: none;">
                                    <h2 class="u-text u-text-custom-color-3 u-text-default u-text-1">Student Login</h2>
                                    <div class="field">
                                        <input type="text" placeholder="Email Address" required>
                                    </div>
                                    <div class="field">
                                        <input type="password" placeholder="Password" required>
                                    </div>
                                    <div class="pass-link"><a href="#">Forgot password?</a></div>
                                    <div class="field btn">
                                        <input type="submit" value="Login">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <a href="#" class="u-btn u-button-style">Don't have an account?Register now</a>
                    </div> 
                  -->

                  <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['type']; // Determine user type
    $errors = [];

    // Supervisor Registration
    if ($role == 1) { 
        $sname = $_POST['sname-1'];
        $semail = $_POST['semail'];
        $select = $_POST['select'];
        $textarea = $_POST['textarea'];
        $pass = $_POST['pass'];
        $passcheck = $_POST['passcheck'];

        if (empty($sname)) {
            $errors[] = "Name is required.";
        }
        if (empty($semail) || !preg_match("/@ksu\.edu\.sa$/i", $semail)) {
            $errors[] = "Email must be from the domain @ksu.edu.sa.";
        }
        if (empty($select)) {
            $errors[] = "Track is required.";
        }
        if (empty($textarea)) {
            $errors[] = "Idea description is required.";
        }
        if (empty($pass) || !preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $pass)) {
            $errors[] = "Password must meet the security requirements.";
        }
        if ($pass !== $passcheck) {
            $errors[] = "Password and confirmation do not match.";
        }

        if (empty($errors)) {
            try {
                $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
                $stmt = $con->prepare("INSERT INTO supervisors (email, name, password, track, idea, interest, availability) VALUES (:email, :name, :password, :track, '', :interest, 'Available')");
                $stmt->bindParam(':email', $semail);
                $stmt->bindParam(':name', $sname);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':track', $select);
                $stmt->bindParam(':interest', $textarea);

                if ($stmt->execute()) {
                    session_start();
                    $_SESSION['user_id'] = $semail;
                    setcookie('Supervisor_email', $semail, time() + 3600, "/");
                    header("Location: SupervisorHomePage.php");
                    exit();
                }
            } catch (PDOException $e) {
                $errors[] = "Database error: " . $e->getMessage();
            }
        }
    }

    // Team Leader Registration
    elseif ($role == "leader") {
            // Leader-specific fields
            $num_students = $_POST['num-students'];
            $leader_name = $_POST['leader-name'];
            $leader_email = $_POST['leader-email'];
            $password = $_POST['password'];
            $reenter_password = $_POST['re-enter-password'];
            $student_names = [];
            $student_emails = [];
    
            // Collecting additional students' information
            for ($i = 1; $i <= $num_students - 1; $i++) {
                $student_names[] = $_POST['student-name-' . $i];
                $student_emails[] = $_POST['student-email-' . $i];
            }
    
            // Validation
            if (empty($num_students) || $num_students < 2 || $num_students > 5) {
                $errors[] = "Group size must be between 2 and 5.";
            }
            if (empty($leader_name) || !preg_match("/^[A-Za-z]+\s[A-Za-z]+$/", $leader_name)) {
                $errors[] = "Leader name must be in 'First Last' format.";
            }
            if (empty($leader_email) || !preg_match("/@student\.ksu\.edu\.sa$/i", $leader_email)) {
                $errors[] = "Leader email must be from the domain @student.ksu.edu.sa.";
            }
            if (empty($password) || !preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
                $errors[] = "Password must be at least 8 characters long, contain uppercase, lowercase, a number, and a special character.";
            }
            if ($password !== $reenter_password) {
                $errors[] = "Password confirmation does not match.";
            }
            foreach ($student_names as $index => $student_name) {
                if (empty($student_name) || !preg_match("/^[A-Za-z]+\s[A-Za-z]+$/", $student_name)) {
                    $errors[] = "Student name " . ($index + 1) . " must be in 'First Last' format.";
                }
            }
            foreach ($student_emails as $index => $student_email) {
                if (empty($student_email) || !preg_match("/@student\.ksu\.edu\.sa$/", $student_email)) {
                    $errors[] = "Student email " . ($index + 1) . " must be from the domain @student.ksu.edu.sa.";
                }
            }
    
            if (empty($errors)) {
                try {
                    $con->beginTransaction();
                    
                    // Insert leader into teams table
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $stmt = $con->prepare("INSERT INTO teams (leader_email, name, password) VALUES (:email, :name, :password)");
                    $stmt->bindParam(':email', $leader_email);
                    $stmt->bindParam(':name', $leader_name);
                    $stmt->bindParam(':password', $hashedPassword);
                    $stmt->execute();
    
                    // Example default password (hashed using bcrypt)
                    
                    // Insert leader into the 'students' table
                    $team_email = $leader_email;
                    $stmt = $con->prepare("INSERT INTO students (name, email, team_email, password, Registration_status) 
                                           VALUES (:name, :email, :team_email, :password, 1)");
                    $stmt->bindParam(':name', $leader_name);
                    $stmt->bindParam(':email', $leader_email);
                    $stmt->bindParam(':team_email', $team_email);
                    $stmt->bindParam(':password', $hashedPassword);
                    $stmt->execute();
                    
                    // Insert students into the 'students' table
                    for ($i = 0; $i < count($student_names); $i++) {
                        $default_password = password_hash('default_password', PASSWORD_BCRYPT);
    
                        $stmt = $con->prepare("INSERT INTO students (name, email, team_email, password, Registration_status) 
                                               VALUES (:name, :email, :team_email, :password, 0)");
                        $stmt->bindParam(':name', $student_names[$i]);
                        $stmt->bindParam(':email', $student_emails[$i]);
                        $stmt->bindParam(':team_email', $team_email);
                        $stmt->bindParam(':password', $default_password);
                        $stmt->execute();
                    }
                    
    
                    $con->commit();
    
                    // Set session and redirect
                    session_start();
                    $_SESSION['user_id'] = $leader_email;
                    $_SESSION['role'] = 'leader'; // Add the role to the session
                    setcookie('email', $leader_email, time() + 3600, "/", "", true, true);
                    setcookie('role', 'leader', time() + 3600, "/","",true, true); // Add the role to the cookie
                    header("Location: ResearchInterests.php");
                    exit();
                } catch (PDOException $e) {
                    $con->rollBack();
                    $errors[] = "Database error: " . $e->getMessage();
                }
            }
        
    }

    // Team Member Registration
    elseif ($role == "member") {
        $member_name = $_POST['member-name'];
        $member_email = $_POST['member-email'];
        $leader_email = $_POST['leader-email'];
        $password = $_POST['password'];
        $reenter_password = $_POST['re-enter-password'];
    
        // Validate inputs
        if (empty($member_name) || !preg_match("/^[A-Za-z\s]+$/", $member_name)) {
            $errors[] = "Please enter a valid name.";
        }
        if (empty($member_email) || !preg_match("/@student\.ksu\.edu\.sa$/i", $member_email)) {
            $errors[] = "Please enter a valid member email from the domain @student.edu.edu.sa.";
        }
        if (empty($leader_email) || !preg_match("/@student\.ksu\.edu\.sa$/i", $leader_email)) {
            $errors[] = "Please enter a valid leader email from the domain @student.ksu.edu.sa.";
        }
        if (empty($password) || !preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
            $errors[] = "Password must be at least 8 characters long, contain uppercase, lowercase, a number, and a special character.";
        }
        if ($password !== $reenter_password) {
            $errors[] = "Passwords do not match.";
        }
    
        // Check for errors
        if (empty($errors)) {
            try {
                // Check if the leader exists
                $stmt = $con->prepare("SELECT leader_email FROM teams WHERE leader_email = :leader_email");
                $stmt->bindParam(':leader_email', $leader_email);
                $stmt->execute();
                $leader = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if (!$leader) {
                    $errors[] = "The leader should create an account first.";
                } else {
                    // Check if the member is part of the leader's team
                    $stmt = $con->prepare("SELECT Registration_status FROM students WHERE email = :member_email AND team_email = :team_email");
                    $stmt->bindParam(':member_email', $member_email);
                    $stmt->bindParam(':team_email', $leader_email);
                    $stmt->execute();
                    $member = $stmt->fetch(PDO::FETCH_ASSOC);
    
                    if (!$member) {
                        $errors[] = "You are not in this group. Contact the leader.";
                    } elseif ($member['Registration_status'] == 0) {
                        // Update member's name and password
                        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
                        $updateStmt = $con->prepare("UPDATE students SET name = :name, password = :password,Registration_status = 1 WHERE email = :member_email AND team_email = :team_email");
                        $updateStmt->bindParam(':name', $member_name);
                        $updateStmt->bindParam(':password', $hashedPassword);
                        $updateStmt->bindParam(':member_email', $member_email);
                        $updateStmt->bindParam(':team_email', $leader_email);
                        $updateStmt->execute();
    
                        // Set session and redirect
                        $_SESSION['user_id'] = $member_email;
                        $_SESSION['role'] = 'member'; // Add the role to the session
                        setcookie('email', $member_email, time() + 3600, "/", "", true, true);
                        setcookie('role', 'member', time() + 3600, "/" ,"", true, true); // Add the role to the cookie
                        
                        header("Location: ResearchInterests.php");
                        exit();
                    } else {
                        $errors[] = "Your registration has been completed and cannot be updated.";
                    }
                }
            } catch (PDOException $e) {
                $errors[] = "Database error: " . $e->getMessage();
            }
        }

    }

    // Display Errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-error u-form-send-message">' . htmlspecialchars($error) . '</div>';
        }
    }
}
?>

 


<div
class="u-container-style u-group u-opacity u-opacity-30 u-palette-1-light-2 u-radius u-shape-round u-group-2">
<div class="u-container-layout u-container-layout-3">
<div class="u-form u-form-1">

<!-- Add Radio Buttons to choose between Supervisor or Student -->
<div class="radio-btn-container">
    
<label for="supervisor" class="radio-btn">Supervisor</label>
<label for="student" class="radio-btn">Student</label>
<input type="radio" name="user-role" id="supervisor" value="supervisor" checked>
<input type="radio" name="user-role" id="student"
  value="student">
<span class="slider-tab"></span>

</div>

<form action="Register.php" method="POST" id="supervisor-signup-form">
<h1
  class="u-align-center u-text u-text-custom-color-1 u-text-default u-text-1">
  Supervisor Registration </h1>




<div class="u-form-group u-form-name u-form-group-1">

  <input type="hidden" name="type" value="1" />
  <label for="name-8e54"
      class="u-custom-font u-font-georgia u-label">Name<span
          style="color:red;">*</span></label>
  <input type="text" placeholder="Enter Full Name"
      id="name-8e54" name="sname-1"
      class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none"
      required="">
</div>

<div class="u-form-group u-form-group-2">
  <label for="email-c6a3"
      class="u-custom-font u-font-georgia u-label">Email<span
          style="color:red;">*</span></label>
  <input type="text" placeholder="Enter a valid email address"
      id="email-c6a3" name="semail"
      class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none"
      required="required" wfd-id="id114">
</div>
<div
  class="u-form-group u-form-select u-label-left u-form-group-4">
  <label for="select-b69f"
      class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-4">Which
      track are you more interested in?<span
          style="color:red;">*</span></label>
  <div class="u-form-select-wrapper">
      <select id="select-b69f" name="select"
          class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-4">
          <option value="Artificial Intelligence"
              data-calc="">Artificial Intelligence</option>
          <option value="Cybersecurity" data-calc="">Cyber
              Security</option>
          <option value="Internet of Things" data-calc="">
              Internet Of Things</option>
      </select>
      <svg class="u-caret u-caret-svg" version="1.1"
          id="Layer_1" xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
          y="0px" width="16px" height="16px"
          viewBox="0 0 16 16" style="fill:currentColor;"
          xml:space="preserve">
          <polygon class="st0" points="8,12 2,4 14,4 ">
          </polygon>
      </svg>
  </div>
</div>
<div
  class="u-form-group u-form-textarea u-label-left u-form-group-5">
  <label for="textarea-a10a"
      class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-5">Interest<span
          style="color:red;">*</span></label>
  <textarea rows="4" cols="50" id="textarea-a10a"
      name="textarea"
      class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-5"
      required=""
      placeholder="Enter your interests in GP projects, separated by commas"></textarea>
</div>
<div class="u-form-group u-form-group-3">
  <label for="text-b089" class="u-custom-font u-font-georgia u-label">
    Password <span style="color:red;">*</span>
  </label>
  <input type="password"
      placeholder="Please enter valid password (minimum 8 characters, including uppercase, lowercase, number, and special character)"
      id="text-b089" name="pass"
      class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none"
      required="required">
  <a href="javascript:void(0);" onclick="togglePasswordVisibility('text-b089')" id="toggle-text-b089" style="color: blue; text-decoration: underline; font-size: 12px;">
    Show Password
  </a>
</div>

<div class="u-form-group u-form-group-4">
  <label for="text-8c1a" class="u-custom-font u-font-georgia u-label">
    Re-enter password <span style="color:red;">*</span>
  </label>
  <input type="password"
      id="text-8c1a" name="passcheck"
      class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none"
      required="required">
  <a href="javascript:void(0);" onclick="togglePasswordVisibility('text-8c1a')" id="toggle-text-8c1a" style="color: blue; text-decoration: underline; font-size: 12px;">
    Show Password
  </a>
</div>

<div class="u-form-group u-form-submit u-form-group-5">

  <button type="submit"
      class="u-active-palette-1-light-3 u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-base u-radius u-btn-1">Submit</button>

</div>
</form>
<div id="student-signup-form" style="display: none;">
<div class="u-form-group">
    <label class="u-custom-font u-font-georgia u-label" style="display: inline-block; margin-right: 10px;">
        Are you the group leader or a member? <span style="color:red;">*</span>
    </label>
    <div class="radio-btn-container2" style="display: inline-block;">
    <label for="leader" class="role-label">Leader</label>
        <input type="radio" id="leader" name="role" value="leader" onclick="toggleForm('leader-form')" required class="role-radio" checked />
        <label for="member" class="role-label">Member</label>
        <input type="radio" id="member" name="role" value="member" onclick="toggleForm('member-form')" required class="role-radio" />
        <span class="slider-tab"></span> 
    </div>
</div>


<!-- Leader Form -->
<form action="Register.php" method="POST" id="leader-form" style="display: block;">
    <h1 class="u-align-center u-text u-text-custom-color-1 u-text-default u-text-1">
        Leader Registration
    </h1>
    
    <input type="hidden" name="type" value="leader" />
    <div class="u-form-group">
        <label for="num-students" class="u-custom-font u-font-georgia u-label">
            How many students are in your group? <span style="color:red;">*</span>
        </label>
        <input type="number" id="num-students" placeholder="Number of students" name="num-students" min="2" max="5" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" required onchange="showStudentFields()" />
    </div>

  <div id="student-fields">
        <div class="student-info">
            <div class="u-form-group">
                <label for="leader-name" class="u-custom-font u-font-georgia u-label">
                    Leader Name <span style="color:red;">*</span>
                </label>
                <input type="text" placeholder="Enter Full Name" id="leader-name" name="leader-name" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" required />
            </div>
            <div class="u-form-group">
                <label for="L-leader-email" class="u-custom-font u-font-georgia u-label">
                    Leader Email <span style="color:red;">*</span>
                </label>
                <input type="email" placeholder="Enter a valid email address" id="L-leader-email" name="leader-email" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" required />
            </div>
        </div>
    </div> 

    <div class="input-wrapper">
        <label for="password" class="u-custom-font u-font-georgia u-label">
            Password <span style="color:red;">*</span>
        </label>
        <input type="password" placeholder="Enter a strong password" id="password" name="password" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" 
        required="required">
  <a href="javascript:void(0);" onclick="togglePasswordVisibility('password')" id="toggle-text-8" style="color: blue; text-decoration: underline; font-size: 12px;">
    Show Password
  </a>
    </div>

    <div class="u-form-group">
        <label for="re-enter-password" class="u-custom-font u-font-georgia u-label">
            Re-enter Password <span style="color:red;">*</span>
        </label>
        <input type="password" placeholder="Re-enter password" id="re-enter-password" name="re-enter-password" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" 
        required="required">
  <a href="javascript:void(0);" onclick="togglePasswordVisibility('re-enter-password')" id="toggle-text-9" style="color: blue; text-decoration: underline; font-size: 12px;">
    Show Password
  </a>
    </div>

    <div class="u-form-group u-form-submit">
        <button type="submit" value="Submit" class="u-active-palette-1-light-3 u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-base u-radius u-btn-1">
            Submit
        </button>
    </div>
</form>

<!-- Member Form -->
<form action="Register.php" method="POST" id="member-form" style="display: none;">
    <h1 class="u-align-center u-text u-text-custom-color-1 u-text-default u-text-1">
        Member Registration
    </h1>
    <input type="hidden" name="type" value="member" />
    <div class="u-form-group">
        <label for="member-name" class="u-custom-font u-font-georgia u-label">
            Your Name <span style="color:red;">*</span>
        </label>
        <input type="text" placeholder="Enter Full Name" id="member-name" name="member-name" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" required />
    </div>
    <div class="u-form-group">
        <label for="member-email" class="u-custom-font u-font-georgia u-label">
            Your Email <span style="color:red;">*</span>
        </label>
        <input type="email" placeholder="Enter a valid email address" id="member-email" name="member-email" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" required />
    </div>
    <div class="u-form-group">
        <label for="M-leader-email" class="u-custom-font u-font-georgia u-label">
            Leader Email <span style="color:red;">*</span>
        </label>
        <input type="email" placeholder="Enter the leader's email" id="M-leader-email" name="leader-email" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" required />
    </div>

    <div class="input-wrapper">
        <label for="M-password" class="u-custom-font u-font-georgia u-label">
            Password <span style="color:red;">*</span>
        </label>
        <input type="password" placeholder="Enter a strong password" id="M-password" name="password" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" 
        required="required">
  <a href="javascript:void(0);" onclick="togglePasswordVisibility('M-password')" id="toggle-text-1" style="color: blue; text-decoration: underline; font-size: 12px;">
    Show Password
  </a>
    </div>

    <div class="u-form-group">
        <label for="M-re-enter-password" class="u-custom-font u-font-georgia u-label">
            Re-enter Password <span style="color:red;">*</span>
        </label>
        <input type="password" placeholder="Re-enter password" id="M-re-enter-password" name="re-enter-password" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" 
        required="required">
  <a href="javascript:void(0);" onclick="togglePasswordVisibility('M-re-enter-password')" id="text-2" style="color: blue; text-decoration: underline; font-size: 12px;">
    Show Password
  </a>
    </div>

    <div class="u-form-group u-form-submit">
        <button type="submit" value="Submit" class="u-active-palette-1-light-3 u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-base u-radius u-btn-1">
            Submit
        </button>
    </div>
</form>
</div>
<script>
    function toggleForm(formId) {
        document.getElementById('leader-form').style.display = formId === 'leader-form' ? 'block' : 'none';
        document.getElementById('member-form').style.display = formId === 'member-form' ? 'block' : 'none';
    }

        
        function togglePasswordVisibility(inputId) {
    const passwordField = document.getElementById(inputId);
    const toggleLink = document.getElementById('toggle-' + inputId);

    // Toggle input type between 'password' and 'text'
    if (passwordField.type === "password") {
        passwordField.type = "text"; // Show password
        toggleLink.textContent = "Hide Password"; // Update link text
    } else {
        passwordField.type = "password"; // Hide password
        toggleLink.textContent = "Show Password"; // Update link text
    }
}

        function togglePasswordVisibility(inputId) {
    var passwordField = document.getElementById(inputId);
    var link = document.getElementById('toggle-' + inputId);

    // Toggle the input type between 'password' and 'text'
    if (passwordField.type === "password") {
        passwordField.type = "text"; // Show the password
        link.textContent = "Hide Password"; // Change link text
    } else {
        passwordField.type = "password"; // Hide the password
        link.textContent = "Show Password"; // Change link text
    }
}

              // Helper function to show error messages
    function showError(input, message) {
        let errorElement = input.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains('error-message')) {
            errorElement = document.createElement('div');
            errorElement.classList.add('error-message');
            errorElement.style.color = 'red';
            errorElement.style.fontSize = '12px';
            input.parentNode.appendChild(errorElement);
        }
        errorElement.textContent = message;
    }

    // Helper function to clear error messages
    function clearError(input) {
        const errorElement = input.nextElementSibling;
        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.remove();
        }
    }

    // Validation for individual fields
    function validateField(input) {
    const fieldName = input.name;
    const value = input.value.trim();

    // Check if the field is empty
    if (!value) {
        showError(input, 'This field is required.');
        return; // Stop further validation if the field is empty
    }

    // Validation for individual fields
    if (fieldName === 'leader-name'|| fieldName === 'member-name'|| fieldName.startsWith('student-name')) {
        if (!/^[A-Za-z]+\s[A-Za-z]+$/.test(value)) {
            showError(input, 'Please enter a valid full name (First Last).');
        } else {
            clearError(input);
        }
    }

    if (fieldName === 'leader-email' || fieldName === 'member-email'|| fieldName.startsWith('student-email')) {
        if (!/^[^\s@]+@student\.ksu\.edu\.sa$/i.test(value)) { // Add 'i' flag for case-insensitivity
            showError(input, 'Please enter a valid KSU student email.');
        } else {
            clearError(input);
        }
    }

    if (fieldName === 'password') {
        if (!/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value)) {
            showError(input, 'Password must be 8+ characters with upper, lower, number, and special character.');
        } else {
            clearError(input);
        }
    }

    if (fieldName === 're-enter-password') {
    const passwordField = input.closest('form').querySelector('input[name="password"]');
    const password = passwordField ? passwordField.value : '';
    if (value !== password) {
        showError(input, 'Passwords do not match.');
    } else {
        clearError(input);
    }
}
   
    
}
    
// Attach blur event listeners to all inputs
    document.querySelectorAll('#member-form input').forEach(input => {
        input.addEventListener('blur', function () {
            validateField(input);
        });
    });
    document.querySelectorAll('#leader-form input').forEach(input => {
        input.addEventListener('blur', function () {
            validateField(input);
        });
    });
    function validateForm(form) {
    let isValid = true;
    form.querySelectorAll('input').forEach(input => {
        validateField(input);
        if (input.nextElementSibling && input.nextElementSibling.classList.contains('error-message')) {
            isValid = false; // Prevent form submission if there are errors
        }
    });
    return isValid;
}

document.getElementById('leader-form').addEventListener('submit', function (e) {
    if (!validateForm(this)) {
        e.preventDefault(); // Stop form submission if validation fails
    }
});

document.getElementById('member-form').addEventListener('submit', function (e) {
    if (!validateForm(this)) {
        e.preventDefault(); // Stop form submission if validation fails
    }
});

function showStudentFields() {

                    const numStudents = document.getElementById('num-students')
                        .value;
                    const studentFieldsContainer = document.getElementById(
                        'student-fields');

                    // Clear existing student fields if any
                    studentFieldsContainer.innerHTML = '';

                    // Always include leader fields
                    studentFieldsContainer.innerHTML += `
                              <div class="student-info">
                                  <div class="u-form-group">
                                      <label for="leader-name" class="u-custom-font u-font-georgia u-label">Leader Name <span style="color:red;">*</span></label>
                                      <input type="text" placeholder="Enter Full Name" id="leader-name" name="leader-name" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" required="">
                                  </div>
                                  <div class="u-form-group">
                                      <label for="leader-email" class="u-custom-font u-font-georgia u-label">Email <span style="color:red;">*</span></label>
                                      <input type="email" placeholder="Enter a valid email address" id="leader-email" name="leader-email" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" required="">
                                  </div>
                              </div>
                          `;

                                                        // Always include one student field
                                                        studentFieldsContainer.innerHTML += `
                              <div class="student-info">
                                  <div class="u-form-group">
                                      <label for="student-name-1" class="u-custom-font u-font-georgia u-label">Student Full name <span style="color:red;">*</span></label>
                                      <input type="text" placeholder="Enter Full Name" id="student-name-1" name="student-name-1" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" required="">
                                  </div>
                                  <div class="u-form-group">
                                      <label for="student-email-1" class="u-custom-font u-font-georgia u-label">Email <span style="color:red;">*</span></label>
                                      <input type="email" placeholder="Enter a valid email address" id="student-email-1" name="student-email-1" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" required="">
                                  </div>
                              </div>
                          `;

                                                        // Add additional student fields if numStudents > 2
                                                        for (let i = 2; i < numStudents&& i<5; i++) {
                                                            studentFieldsContainer.innerHTML += `
                                  <div class="student-info">
                                      <div class="u-form-group">
                                          <label for="student-name-${i}" class="u-custom-font u-font-georgia u-label">Student Full name <span style="color:red;">*</span></label>
                                          <input type="text" placeholder="Enter full Name" id="student-name-${i}" name="student-name-${i}" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" required="">
                                      </div>
                                      <div class="u-form-group">
                                          <label for="student-email-${i}" class="u-custom-font u-font-georgia u-label">Email <span style="color:red;">*</span></label>
                                          <input type="email" placeholder="Enter a valid email address" id="student-email-${i}" name="student-email-${i}" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none" required="">
                                      </div>
                                  </div>
                              `;
                                                        }
                                                        // Attach validation listeners to dynamically added inputs
studentFieldsContainer.querySelectorAll('input').forEach(input => {
    input.addEventListener('blur', function () {
        validateField(input);
    });
});
                                                    }
   
   </script>

                                                </div>
                                                <a href="LogIn.php"
                                                    class="u-active-none u-border-5 u-border-active-palette-2-dark-1 u-border-hover-custom-color-1 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-btn u-button-style u-hover-none u-none u-text-active-palette-1-light-1 u-text-hover-palette-1-dark-2 u-text-palette-1-dark-1 u-btn-2">Already
                                                    have an account? </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </section>

    <footer class="u-clearfix u-custom-color-3 u-footer" id="sec-9e3e">
        <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
            <div class="data-layout-selected u-clearfix u-expanded-width u-gutter-30 u-layout-wrap u-layout-wrap-1">
                <div class="u-gutter-0 u-layout">
                    <div class="u-layout-row">
                        <div class="u-align-left u-container-style u-layout-cell u-left-cell u-size-60 u-layout-cell-1">
                            <div class="u-container-layout u-container-layout-1">
                                <h5 class="u-align-center u-text u-text-default u-text-1">Thank you for visiting our
                                    website!<br>If you have any suggestions, please do not hesitate to contact us
                                </h5>
                                <!--position-->
                                <div data-position="" class="u-position u-position-1">
                                    <!--block-->
                                    <div class="u-block">
                                        <div class="u-block-container u-clearfix">
                                            <!--block_header-->
                                            <h5 class="u-block-header u-text">
                                                <!--block_header_content-->
                                                <!--/block_header_content-->
                                            </h5>
                                            <!--/block_header-->
                                            <!--block_content-->
                                            <div class="u-block-content u-text">
                                                <!--block_content_content-->
                                                <!--/block_content_content-->
                                            </div>
                                            <!--/block_content-->
                                        </div>
                                    </div>
                                    <!--/block-->
                                </div>
                                <!--/position-->
                                <div class="u-social-icons u-spacing-10 u-social-icons-1" data-animation-name=""
                                    data-animation-duration="0" data-animation-direction="">
                                    <a class="u-social-url" title="Email" target="_blank" href=""><span
                                            class="u-file-icon u-icon u-social-facebook u-social-icon u-icon-1"><img
                                                src="images/542740.png" alt=""></span>
                                    </a>
                                    <a class="u-social-url" title="department website" target="_blank"
                                        href="https://ccis.ksu.edu.sa/ar"><span
                                            class="u-file-icon u-icon u-social-icon u-social-linkedin u-icon-2"><img
                                                src="images/3308395.png" alt=""></span>
                                    </a>
                                    <a class="u-social-url" title="twitter" target="_blank"
                                        href="https://x.com/fccis_ksu?s=11&amp;t=U-hrOO7JjdBm0Zm8XnUG6A"><span
                                            class="u-file-icon u-icon u-social-icon u-social-twitter u-icon-3"><img
                                                src="images/11823292.png" alt=""></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const supervisorForm = document.getElementById("supervisor-signup-form");
        const studentForm = document.getElementById("student-signup-form");
        const roleRadios = document.querySelectorAll("input[name='user-role']");

        // Function to show the appropriate form based on selected radio button
        function showFormBasedOnRole() {
            const selectedRole = document.querySelector("input[name='user-role']:checked").value;

            if (selectedRole === "supervisor") {
                supervisorForm.style.display = "block";
                studentForm.style.display = "none";
            } else {
                supervisorForm.style.display = "none";
                studentForm.style.display = "block";
            }
        }

        // Add event listeners to radio buttons to switch between forms
        roleRadios.forEach(radio => {
            radio.addEventListener("change", showFormBasedOnRole);
        });

        // Initial form display based on the pre-selected radio button
        showFormBasedOnRole();
    });
    </script>
</body>

</html>