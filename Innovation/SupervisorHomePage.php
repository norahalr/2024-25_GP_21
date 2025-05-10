<?php 

 ob_start();
 session_start();
  require_once 'config/connect.php';

  if (!isset($_SESSION['user_id'])) {
    echo "Error: User is not logged in.";
    header("Location: LogIn.php");

    exit();
}
$supervisorEmail=$_SESSION['user_id'];

if (isset($_SESSION['message'])) {
    $message = htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8');
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
            });
        });
    </script>
    ";
    unset($_SESSION['message']);
}
// Check if any updates exist
$sql = "SELECT COUNT(*) FROM team_idea_request WHERE supervisor_email = :email AND is_updated = 1";
$stmt = $con->prepare($sql);
$stmt->bindParam(':email', $supervisorEmail);
$stmt->execute();
$hasUpdates = $stmt->fetchColumn() > 0;
?>




<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Welcome ..., project name/number">
    <meta name="description" content="">
    <title>SupervisorHomePage</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="SupervisorHomePage.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.19.6, nicepage.com">
  
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">




    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "",
        "logo": "images/logo_GP-noname.png"
    }
    </script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="SupervisorHomePage">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>

<body data-path-to-root="./" data-include-products="true" class="u-body u-xl-mode" data-lang="en">
    <header class="u-clearfix u-header" id="sec-4e01">
        <div class="u-clearfix u-sheet u-sheet-1">

 <?php $hasUpdates = true; // or false based on badge logic
include 'supervisor_menu.php'; ?>            
            <a href="#" class="u-image u-logo u-image-1" data-image-width="276" data-image-height="194">
                <img src="images/logo_GP-noname.png" class="u-logo-image u-logo-image-1">
            </a>
        </div>
    </header>
    <section class="u-clearfix u-container-align-center-xs u-gradient u-section-1" id="carousel_adc9">
    <div class="u-clearfix u-sheet u-sheet-1">
        <div class="header-container">
            <?php
            $sql = "SELECT name FROM supervisors WHERE email = :email";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':email', $supervisorEmail);
            $stmt->execute();
            $request = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <h2 class="u-align-left u-text u-text-default u-text-1" data-animation-name="customAnimationIn"
                data-animation-duration="1200" data-animation-delay="0">
                Welcome Dr.<?php echo $request["name"]; ?>
            </h2>
            <a href="supervisorProfile.php"
                class="u-active-white u-align-center u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-palette-1-base u-btn u-btn-round u-button-style u-hover-white u-palette-1-base u-radius u-text-active-black u-text-body-alt-color u-text-hover-black u-block-5fc4-58"
                data-animation-name="" data-animation-duration="0" data-animation-delay="0"
                data-animation-direction="">Add an idea</a>
        </div>

        <div class="u-expanded-width u-layout-grid u-list u-list-1">
            <div class="u-repeater u-repeater-1">
                <?php
               $sql = "
               SELECT * FROM (
                   -- Supervisor Requests
                   SELECT 
                       CONCAT('SUP_', sir.id) AS request_number, 
                       status,
                       'Supervisor idea' AS leader_name,  -- Fixed text for supervisor-submitted requests
                       s.idea AS idea_description, 
                       'supervisor' AS source,
                       sir.request_date AS sort_date, 
                       sir.request_date,
                       NULL AS last_updated, 
                       sir.id AS request_id,
                       0 AS is_updated,
                       sir.delete_reason
                   FROM 
                       supervisor_idea_request sir 
                   JOIN 
                       supervisors s ON sir.supervisor_email = s.email
                   WHERE sir.supervisor_email = '".$supervisorEmail."'
               
                   UNION
               
                   -- Team Requests (Fetching leader name from the teams table)
                   SELECT 
                       CONCAT('TEAM_', tir.id) AS request_number, 
                       tir.status,
                       'Students idea' AS leader_name,  -- Fetch leader's actual name
                       tir.description AS idea_description, 
                       'team' AS source,
                       COALESCE(tir.last_updated, tir.request_date) AS sort_date, 
                       tir.request_date,
                       tir.last_updated, 
                       tir.id AS request_id,
                       tir.is_updated,
                       tir.delete_reason
                   FROM 
                       team_idea_request tir 
                   JOIN 
                       teams t ON tir.team_email = t.leader_email  -- Get leader name from the teams table
                   WHERE tir.supervisor_email = '".$supervisorEmail."'
               ) AS combined_requests 
               ORDER BY 
                   CASE 
                       WHEN status = 'Approved' THEN 1
                       WHEN status = 'Pending' THEN 2
                       WHEN status = 'Canceled' THEN 3
                       WHEN status = 'Rejected' THEN 4
                   END,
                   sort_date ASC;
               ";
               
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!empty($requests)) {
                foreach ($requests as $request) {
                    $request_number = $request['request_number'];
                    $leader_name = $request['leader_name'];
                    $idea_description = $request['idea_description'];
                    $request_id = $request['request_id'];
                    $source = $request['source'];
                    $is_updated = $request['is_updated'];
                    $delete_reason = $request['delete_reason'];

                    // Style border color based on status
                    if ($request['status'] == 'Approved') {
                        $style = "style='border:4px solid green'";
                    } elseif ($request['status'] == 'Rejected' || $request['status'] == 'Canceled') {
                        $style = "style='border:4px solid red'";
                    } else {
                        $style = "";
                    }

                    // Update indicator
                    $updateBadge = ($is_updated ) ? "<span class='update-badge'>New Update Available</span>" : "";

                    echo '<div ' . $style . ' class="u-list-item u-radius u-repeater-item u-shape-round u-white u-list-item-1"
                            data-animation-name="customAnimationIn" data-animation-duration="1500" data-animation-delay="200">
                            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
                                <img src="images/image13.png" alt=""
                                     class="u-expanded-width u-image u-image-contain u-image-round u-radius u-image-1"
                                     data-image-width="256" data-image-height="256">
                                <h5 class="u-align-center u-text u-text-2">REQUEST: ' . $request_number . '</h5>
                                <h4 class="u-align-center u-text u-text-palette-1-base u-text-3">' . $leader_name . '</h4>';
                    
                    // If the request was deleted, show the reason instead of description
                    
                echo '<p class="u-align-left u-text u-text-4" style="margin:1rem;"> ' . htmlspecialchars($idea_description) . '</p>';


                    echo $updateBadge;

echo '<div style="display: flex; justify-content: center; gap: 10px; margin-top: 10px;">';

// View REQUEST button
echo '<div style="display: flex; justify-content: center; gap: 10px; margin-top: 10px;">';

// View REQUEST button 
echo '<a href="ViewSpecificRequest.php?id=' . $request_id . '&type=' . $source . '" 
        class="u-btn u-btn-round u-button-style u-hover-white u-palette-1-base u-radius u-text-active-black u-text-body-alt-color u-text-hover-black "
        style="width: 180px; text-align: center; border-radius: 50px !important;">
        View REQUEST
      </a>';

// Cancellation Reason button 
if ($request['status'] == 'Canceled' && !empty($request['delete_reason'])) {
    echo '<button onclick="showPopup(\'' . htmlspecialchars(addslashes($request['delete_reason'])) . '\')" 
                 class="u-btn u-button-style u-grey-30 u-btn-round"
                 style="width: 180px; background-color: #dc3545; color: white; border: none;">
             View Reason
          </button>';
}

echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';



                }}else 
    echo "<p style='text-align:center; color:gray;'>There is no request yet.</p>";
?>            

            </div>
        </div>
    </div>
</section>

<style>
.update-badge {
    display: inline-block;
    background-color: #fff3cd; /* Soft yellow */
    color: #856404;            /* Dark yellow text */
    font-weight: 500;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.9rem;
    margin-top: 8px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border: 1px solid #ffeeba;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.update-badge:hover {
    background-color: #ffe8a1;
    color: #5c4500;
}
.u-repeater-1 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

</style>



    
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
<!-- Reason Popup -->
<div id="reasonPopup" style="
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    width: 400px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    z-index: 1000;
    text-align: center;
">
    <p id="reasonText" style="color:black;     text-align: center;
 font-size: 16px; margin-bottom: 20px;"></p>
    <button onclick="hidePopup()" style="
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;

    ">Close</button>
</div>


<!-- Overlay -->
<div id="overlay" style="
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
"></div>

<!-- JS to Show/Hide Popup -->
<script>
function showPopup(reason) {
    document.getElementById('reasonText').innerText = reason;
    document.getElementById('reasonPopup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}
function hidePopup() {
    document.getElementById('reasonPopup').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}
</script>


    <style>
    .u-dialog-section-5 .u-dialog-1 {
        width: 570px;
        min-height: 578px;
        height: auto;
        box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.2);
        margin: 60px auto;
    }

    .u-dialog-section-5 .u-container-layout-1 {
        padding: 34px 35px;
    }

    .u-dialog-section-5 .u-text-1 {
        font-weight: 700;
        margin: 0 165px 0 0;
    }

    .u-dialog-section-5 .u-products-1 {
        margin-top: 30px;
        margin-bottom: 0;
    }

    .u-dialog-section-5 .u-repeater-1 {
        grid-template-columns: 100%;
        min-height: 206px;
        grid-gap: 10px;
    }

    .u-dialog-section-5 .u-container-layout-2 {
        padding: 0 0 30px;
    }

    .u-dialog-section-5 .u-text-2 {
        background-image: none;
        margin: 0;
    }

    .u-dialog-section-5 .u-text-3 {
        font-size: 0.875rem;
        margin: 20px 0 0;
    }

    .u-dialog-section-5 .u-product-quantity-1 {
        width: 125px;
        margin: 30px auto 0 0;
    }

    .u-dialog-section-5 .u-product-price-1 {
        margin: -34px 0 0 auto;
    }

    .u-dialog-section-5 .u-payment-services-1 {
        min-height: 250px;
        min-width: 50px;
        margin: 0;
    }

    .u-dialog-section-5 .u-container-layout-3 {
        padding: 20px 0 0;
    }

    .u-dialog-section-5 .u-container-layout-4 {
        padding: 20px 0 0;
    }

    .u-dialog-section-5 .u-btn-1 {
        width: 100%;
        margin: 0 auto;
    }

    .u-dialog-section-5 .u-icon-1 {
        width: 20px;
        height: 20px;
        left: auto;
        top: 36px;
        position: absolute;
        right: 35px;
        padding: 0;
    }

    @media (max-width: 1199px) {
        .u-dialog-section-5 .u-text-1 {
            margin-right: 165px;
        }

        .u-dialog-section-5 .u-payment-services-1 {
            margin-right: initial;
            margin-left: initial;
        }
    }

    @media (max-width: 991px) {
        .u-dialog-section-5 .u-container-layout-1 {
            padding: 30px;
        }

        .u-dialog-section-5 .u-container-layout-3 {
            padding-bottom: 0;
            padding-left: 0;
            padding-right: 0;
        }

        .u-dialog-section-5 .u-container-layout-4 {
            padding-bottom: 0;
            padding-left: 0;
            padding-right: 0;
        }

        .u-dialog-section-5 .u-icon-1 {
            top: 32px;
            right: 30px;
        }
    }

    @media (max-width: 767px) {
        .u-dialog-section-5 .u-dialog-1 {
            width: 540px;
        }
    }

    @media (max-width: 575px) {
        .u-dialog-section-5 .u-dialog-1 {
            width: 340px;
        }

        .u-dialog-section-5 .u-container-layout-1 {
            padding-left: 20px;
            padding-right: 20px;
        }

        .u-dialog-section-5 .u-text-1 {
            margin-right: 5px;
        }

        .u-dialog-section-5 .u-icon-1 {
            right: 20px;
        }
    }
    </style>
</body>

</html>