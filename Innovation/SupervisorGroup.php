<?php 
require_once 'config/connect.php';
ob_start();
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: LogIn.php");
    exit();
}

$supervisorEmail = $_SESSION['user_id']; // Ensure this contains email or adjust query to use ID

$sql = "SELECT * FROM supervisors WHERE email = :email";
$stmt = $con->prepare($sql);
$stmt->bindParam(':email', $supervisorEmail);
$stmt->execute();
$request = $stmt->fetch(PDO::FETCH_ASSOC);

if ($request) {
    $name = $request['name'];
    $email = $request['email'];
    $phone = $request['phone_number'];
    $track = $request['track'];
    $interest = $request['interest'];
    $idea = $request['idea'];
} else {
    echo "No data found for this supervisor.";
    exit();
}
?>



<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Supervisor Group">
    <meta name="description" content="">
    <title>supervisor Group</title>
    <link rel="stylesheet" href="nicepage2.css" media="screen">
    <link rel="stylesheet" href="supervisorProfile.css" media="screen">
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
        "name": "Site1",
        "sameAs": [
            "https://ccis.ksu.edu.sa/ar",
            "https://x.com/fccis_ksu?s=11&t=U-hrOO7JjdBm0Zm8XnUG6A"
        ]
    }
    </script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="SupervisorGroup">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>

<body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en">
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
                                href="SupervisorHomePage.php" style="padding: 10px 0px;">Supervisor home page</a>
                        </li>
                        <li class="u-nav-item"><a
                                class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90"
                                style="padding: 10px 0px;" href="supervisorProfile.php">Profile</a>
                        </li>
                        <li class="u-nav-item"><a
                            class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90"
                            style="padding: 10px 0px;" href="SupervisorGroup.php">Supervisor Group</a>
                    </li>
                    <li class="u-nav-item"><a
                        class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90"
                        style="padding: 10px 0px;" href="index.php">Log out</a>
                </li>
                    </ul>
                </div>
                <div class="u-custom-menu u-nav-container-collapse">
                    <div
                        class="u-container-style u-inner-container-layout u-opacity u-opacity-95 u-palette-1-dark-2 u-sidenav">
                        <div class="u-inner-container-layout u-sidenav-overflow">
                            <div class="u-menu-close"></div>
                            <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
                                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./">Home</a>
                                </li>
                                <li class="u-nav-item"><a class="u-button-style u-nav-link">Sign Up</a>
                                </li>
                                <li class="u-nav-item"><a class="u-button-style u-nav-link">Login</a>
                                </li>
                                <li class="u-nav-item"><a class="u-button-style u-nav-link">Request Project from
                                        CCIS</a>
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
    <section class="u-align-center u-clearfix u-container-align-center u-white u-section-1" id="sec-55fc">
        <div class="u-clearfix u-sheet u-sheet-1">
            <h1 class="u-text u-text-custom-color-3 u-text-default u-text-1">Supervisor Group</h1>
            <div class="data-layout-selected u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
                <div class="u-layout" style="">
                    <div class="u-layout-row" style="">
                        <div class="u-align-center u-container-align-center u-container-style u-layout-cell u-left-cell u-palette-1-light-3 u-radius u-shape-round u-size-60 u-size-xs-60 u-layout-cell-1"
                            src="">
                            <div class="u-container-layout u-container-layout-1">
                                

                                

                            <?php
// Supervisor Requests
$sql = "SELECT * FROM `supervisor_idea_request` 
        INNER JOIN supervisors ON supervisors.email = supervisor_idea_request.supervisor_email 
        WHERE supervisor_email=:supervisorEmail AND status='Approved'";
$stmt = $con->prepare($sql);
$stmt->execute(['supervisorEmail' => $supervisorEmail]);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);



foreach ($requests as $request) {
    // Get the students list for the supervisor request
    $students = "";
    $sql = "SELECT * FROM `students` WHERE team_email=:team_email";
    $stmt = $con->prepare($sql);
    $stmt->execute(['team_email' => $request['team_email']]);
    $studentsList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($studentsList as $student) {
        $students .= $student['name'] . ", ";
    }
?>
    <div class="u-container-style u-group u-radius u-shape-round u-white u-group-2">
        <div class="u-container-layout u-container-layout-3">
            <div class="custom-expanded u-form u-form-2">
                <form style="padding: 15px;">
                    <div style="margin-top:30px;" class="u-form-group u-form-textarea u-label-left u-form-group-8">
                        <label for="textarea-a10a" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-8">GP group</label>
                        <textarea disabled rows="4" cols="50" id="textarea-a10a" name="group" 
                                  class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-7" 
                                  required="" placeholder="Students names"><?php echo rtrim($students, ", "); ?></textarea>
                    </div>

                    <div style="margin-top:30px;" class="u-form-group u-form-partition-factor-2 u-label-left u-form-group-9">
                        <label for="text-505a" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-9">Leader Email</label>
                        <input disabled type="text" placeholder="Email" id="text-505a" name="leader" value="<?php echo $request['team_email']; ?>"
                               class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-8">
                    </div>

                    <div style="margin-top:30px;" class="u-form-group u-form-partition-factor-2 u-label-left u-form-group-10">
                        <label for="text-1c02" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-10">Phone number</label>
                        <input disabled type="number" placeholder="Leader phone number" id="text-1c02" name="phone" value="<?php echo $request['phone_number']; ?>"
                               class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-9">
                    </div>

                    <div style="margin-top:30px;" class="u-form-group u-label-left u-form-group-11">
                        <label for="text-6ab4" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-11">Project Idea</label>
                        <input disabled type="text" placeholder="Fill in" id="text-6ab4" name="project" value="<?php echo $request['idea']; ?>"
                               class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-10">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}

// Team Requests (Same process as supervisor requests but using team_idea_request)
$sql = "SELECT * FROM `team_idea_request` 
        INNER JOIN supervisors ON supervisors.email = team_idea_request.supervisor_email 
        WHERE supervisor_email=:supervisorEmail AND status='Approved'";
$stmt = $con->prepare($sql);
$stmt->execute(['supervisorEmail' => $supervisorEmail]);
$requests2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($requests2)&&!empty($requests2)) {
    $message = "you are not supervising any group yet.";
    echo "
    <div id='popup' style='
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        z-index: 1000;
        text-align: center;
    '>
        <p>$message</p>
        <button id='confirmButton' style='
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        '>OK</button>
    </div>
    <div id='overlay' style='
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    '></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('confirmButton').addEventListener('click', function() {
                document.getElementById('popup').style.display = 'none';
                document.getElementById('overlay').style.display = 'none';
                window.location.href = 'SupervisorHomePage.php'; // Replace with your supervisor home page URL
            });
        });
    </script>
    ";
    //header("Location: SupervisorHomePage.php");

    exit; // Stop further execution
} else {

foreach ($requests2 as $request) {
    // Get the students list for the team request
    $students = "";
    $sql = "SELECT * FROM `students` WHERE team_email=:team_email";
    $stmt = $con->prepare($sql);
    $stmt->execute(['team_email' => $request['team_email']]);
    $studentsList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($studentsList as $student) {
        $students .= $student['name'] . ", ";
    }
?>
    <div class="u-container-style u-group u-radius u-shape-round u-white u-group-2">
        <div class="u-container-layout u-container-layout-3">
            <div class="custom-expanded u-form u-form-2">
                <form style="padding: 15px;">
                    <div style="margin-top:30px;" class="u-form-group u-form-textarea u-label-left u-form-group-8">
                        <label for="textarea-a10a" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-8">GP group</label>
                        <textarea disabled rows="4" cols="50" id="textarea-a10a" name="group" 
                                  class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-7" 
                                  required="" placeholder="Students names"><?php echo rtrim($students, ", "); ?></textarea>
                    </div>

                    <div style="margin-top:30px;" class="u-form-group u-form-partition-factor-2 u-label-left u-form-group-9">
                        <label for="text-505a" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-9">Leader Email</label>
                        <input disabled type="text" placeholder="Email" id="text-505a" name="leader" value="<?php echo $request['team_email']; ?>"
                               class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-8">
                    </div>

                    <div style="margin-top:30px;" class="u-form-group u-form-partition-factor-2 u-label-left u-form-group-10">
                        <label for="text-1c02" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-10">Phone number</label>
                        <input disabled type="number" placeholder="Leader phone number" id="text-1c02" name="phone" value="<?php echo $request['phone_number']; ?>"
                               class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-9">
                    </div>

                    <div style="margin-top:30px;" class="u-form-group u-label-left u-form-group-11">
                        <label for="text-6ab4" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-11">Project title</label>
                        <input disabled type="text" placeholder="Fill in" id="text-6ab4" name="project" value="<?php echo $request['project_name']; ?>"
                               class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-10">
                    </div>
                    <div style="margin-top:30px;" class="u-form-group u-label-left u-form-group-11">
                        <label for="text-6ab4" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-11">Project Idea</label>
                        <input disabled type="text" placeholder="Fill in" id="text-6ab4" name="project" value="<?php echo $request['description']; ?>"
                               class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-10">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}}
?>

                                    </div>
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


</body>

</html>
