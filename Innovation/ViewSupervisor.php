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

  $sql = "SELECT * FROM supervisors WHERE email='".$supervisorEmail."'";
  $stmt = $con->prepare($sql);
  $stmt->execute();
  $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($requests as $request) {
      $name = $request['name'];
      $email = $request['email'];
      $phone = $request['phone_number'];
      $track = $request['track'];
      $interest = $request['interest'];
      $idea = $request['idea'];

  }

?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Supervisor Name ​, Email​@ksu.edu.sa, Supervisor interest:​">
    <meta name="description" content="">
    <title>VeiwSupervisor</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="VeiwSupervisor.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.19.6, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700">



    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "",
        "logo": "images/logo_GP-noname.png"
    }
    </script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="VeiwSupervisor">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
    <style>
    .u-repeater {
        display: grid;
        grid-template-columns: repeat(4, 25%);
    }

    .u-repeater-item {
        flex: 1 1 100%;
        /* Full width by default */
        margin: 10px;
        /* Optional: Add some spacing */
    }

    @media (min-width: 1024px) {
        .u-repeater-item {
            flex: 1 1 24%;
            /* Adjust based on how many items per row you want on laptop */
        }
    }

    .u-container-layout {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .u-image {
        width: 50%;
        height: auto;
    }
    </style>
</head>

<body data-path-to-root="./" data-include-products="true" class="u-body u-xl-mode" data-lang="en">
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
                                href="StudentHomePage.php" style="padding: 10px 0px;">Student Home page</a>
                        </li>
                        <li class="u-nav-item"><a
                                class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90"
                                style="padding: 10px 0px;" href="StudentProfile.php">Profile</a>
                        </li>
                        <li class="u-nav-item"><a
                                class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90"
                                style="padding: 10px 0px;" href="StudentRequest.php">Request list</a>

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
    <section class="u-clearfix u-container-align-center u-section-1" id="sec-788b">
        <div class="u-clearfix u-sheet u-sheet-1">
            <div class="data-layout-selected u-clearfix u-expanded-width u-gutter-10 u-layout-wrap u-layout-wrap-1">
                <div class="u-gutter-0 u-layout">
                    <div class="u-layout-row">
                        <div class="u-size-11">
                            <div class="u-layout-row">
                                <div class="u-align-left u-container-align-left u-container-style u-image u-layout-cell u-left-cell u-size-60 u-image-1"
                                    src="" data-image-width="1280" data-image-height="852">
                                    <div class="u-container-layout u-valign-middle u-container-layout-1" src=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="u-size-49">
                            <div class="u-layout-col">
                                <div
                                    class="u-align-left u-container-align-left u-container-style u-layout-cell u-right-cell u-size-30 u-white u-layout-cell-2">
                                    <div class="u-container-layout u-valign-middle u-container-layout-2">
                                        <h2
                                            class="u-align-left u-custom-font u-font-oswald u-text u-text-palette-1-dark-2 u-text-1">
                                            <?php echo $name; ?> </h2>
                                        <h2
                                            class="u-align-left u-custom-font u-font-oswald u-subtitle u-text u-text-palette-1-dark-1 u-text-2">
                                            <?php echo $email; ?> </h2>
                                        <h5
                                            class="u-align-left u-custom-font u-font-oswald u-text u-text-palette-1-dark-1 u-text-3">
                                            TRACK: <?php echo $track; ?> </h5>

                                    </div>
                                </div>
                                <div
                                    class="u-align-left u-container-align-left-lg u-container-align-left-md u-container-align-left-sm u-container-align-left-xl u-container-style u-layout-cell u-right-cell u-size-30 u-white u-layout-cell-3">
                                    <div class="u-container-layout u-container-layout-3">
                                        <h2
                                            class="u-align-left u-custom-font u-font-oswald u-text u-text-palette-1-dark-2 u-text-5">
                                            Supervisor Idea: </h2>
                                            <p class="u-align-left u-text u-text-4">
                                            <?php 
                                            if (empty($idea)) {
                                                echo $name . " doesn't have an idea yet";
                                            } else {
                                                echo $idea;
                                            }
                                            ?> 
                                        </p>  
                                    </div>
                                </div>
                                <div
                                    class="u-align-left u-container-align-left-lg u-container-align-left-md u-container-align-left-sm u-container-align-left-xl u-container-style u-layout-cell u-right-cell u-size-30 u-white u-layout-cell-3">
                                    <div class="u-container-layout u-container-layout-3">
                                        <h2
                                            class="u-align-left u-custom-font u-font-oswald u-text u-text-palette-1-dark-2 u-text-5">
                                            Supervisor interest: </h2>
                                        <ul class="u-align-left u-custom-list u-file-icon u-text u-text-6">
                                            <li>
                                                <div class="u-list-icon u-text-palette-1-dark-1">
                                                    <img src="images/1702471.png" alt=""
                                                        style="font-size: 1.1em; margin: -1.1em;">
                                                </div><?php echo $interest; ?> &nbsp;
                                            </li>

                                        </ul>


                                    </div>
                                </div>

                                <div
                                    class="u-align-left u-container-align-left-lg u-container-align-left-md u-container-align-left-sm u-container-align-left-xl u-container-style u-layout-cell u-right-cell u-size-30 u-white u-layout-cell-3">
                                    <div class="u-container-layout u-container-layout-3">
                                        <h2
                                            class="u-align-left u-custom-font u-font-oswald u-text u-text-palette-1-dark-2 u-text-5">
                                            Supervisor Previous projects: </h2>
                                        <ul class="u-align-left u-custom-list u-file-icon u-text u-text-6">


                                            <?php
  $sql = "SELECT  supervisor_projects.*, past_projects.name FROM `supervisor_projects`
INNER JOIN past_projects ON past_projects.id=supervisor_projects.pastproject_id
 WHERE supervisor_email='".$supervisorEmail."'";
  $stmt = $con->prepare($sql);
  $stmt->execute();
  $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if($projects==null){

    echo '
    <li>
                                             <div class="u-list-icon u-text-palette-1-dark-1">
                                                 <img src="images/1702471.png" alt=""
                                                     style="font-size: 1.1em; margin: -1.1em;">
                                             </div>No Past Projects.&nbsp;
                                         </li>
                                         ';
  }
  foreach ($projects as $project) {
      echo '
       <li>
                                                <div class="u-list-icon u-text-palette-1-dark-1">
                                                    <img src="images/1702471.png" alt=""
                                                        style="font-size: 1.1em; margin: -1.1em;">
                                                </div>'.$project['name'].'.&nbsp;
                                            </li>
                                            ';

  }

?>




                                        </ul>
                                        <a href="RequestSupervisor.php?supervisor_email=<?php echo urlencode($email); ?>" 
                                        class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius u-btn-1">REQUEST
                                            SUPERVISORS </a>
                                        <a href="StudentHomePage.php"
                                            class="u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-light-3 u-radius u-btn-2">BACK
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="u-align-center u-clearfix u-container-align-center u-section-2" id="sec-de73">
    <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-expanded-width u-list u-list-1">
            <h3 class="u-align-left u-custom-font u-font-oswald u-text u-text-palette-1-dark-2 u-text-0">
                Recommended Supervisors:
            </h3>
            <div class="u-repeater u-repeater-1">
                <?php
                // Fetch similar supervisors from Flask API
                // $apiUrl = "http://localhost:5000/supervisor/" . urlencode($supervisorEmail);
                $apiUrl = "http://127.0.0.1:5001/supervisor/".urlencode($supervisorEmail);
                $response = file_get_contents($apiUrl);
                $data = json_decode($response, true);
                
                if (isset($data['similar_supervisors']) && !empty($data['similar_supervisors'])) {
                    $similarSupervisors = $data['similar_supervisors'];

                    foreach ($similarSupervisors as $supervisor) {
                        $similarName = $supervisor['name'];
                        $similarEmail = $supervisor['email'];
                        // $similarInterest = $supervisor['interest']; //this is the interest <p class="u-align-left u-text u-text-2">Interest: ' . $similarInterest . '</p>
                        $viewLink = "viewSupervisor.php?supervisor_email=" . urlencode($similarEmail);

                        echo '
                        <div class="u-align-left u-container-align-left u-container-style u-list-item u-repeater-item">
                            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
                                <img class="u-expanded-width u-image u-image-default u-image-1" alt="" src="images/Icon.webp">
                                <h4 class="u-align-left u-text u-text-1">' . $similarName . '</h4>
                                

                                <a href="' . $viewLink . '" 
                                   class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius u-btn-1">
                                   View
                                </a>
                            </div>
                        </div>
                        ';
                    }
                } else {
                    echo '<h4>No similar supervisors found.</h4>';
                }
                ?>
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
