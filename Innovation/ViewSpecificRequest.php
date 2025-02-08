<?php
  require_once 'config/connect.php';
if (isset($_GET['id']) && isset($_GET['type'])) {
    $request_id = $_GET['id'];  
    $type = $_GET['type'];      
    $sql = '';
    $params = [];

    if ($type == 'team') {
        $sql = "SELECT 
                    tir.id AS request_number,
                    tir.project_name,
                    tir.description AS idea_description,
                    tir.team_email,
                    tir.supervisor_email,
                    tir.request_date,
                    tir.status,
                    t.name AS leader_name,  -- Fetch leader name from teams table
                    s.email AS student_email,
                    s.name AS student_name
                FROM 
                    team_idea_request tir
                JOIN 
                    teams t ON tir.team_email = t.leader_email
                LEFT JOIN 
                    students s ON tir.team_email = s.team_email  -- Get all team members
                WHERE 
                    tir.id = :request_id";
        $params = ['request_id' => $request_id];
    }
    else if ($type == 'supervisor') {
        $sql = "SELECT 
                    sir.id AS request_number,
                    'supervisor idea' AS project_name, 
                    s.idea AS idea_description,  
                    sir.team_email,
                    sir.supervisor_email,
                    sir.request_date,
                    sir.status,
                    t.name AS leader_name,  -- Fetch leader name from teams table
                    stu.email AS student_email, 
                    stu.name AS student_name
                FROM 
                    supervisor_idea_request sir
                JOIN 
                    supervisors s ON sir.supervisor_email = s.email
                LEFT JOIN 
                    teams t ON sir.team_email = t.leader_email  -- Get leader name
                LEFT JOIN 
                    students stu ON sir.team_email = stu.team_email  -- Get all team members
                WHERE 
                    sir.id = :request_id";
        $params = ['request_id' => $request_id];
    }
     else {
        header("Location: SupervisorHomePage.php");
        exit;
    }

    try {
        $stmt = $con->prepare($sql);
        $stmt->execute($params);
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
        
        if (!empty($requests)) {
            // Get common details from the first row
            $request_number = $requests[0]['request_number'];
            $project_name = $requests[0]['project_name'];
            if($project_name == null){
                $project_name = 'Students Idea';
            }
            $idea_description = $requests[0]['idea_description'];
            $team_email = $requests[0]['team_email'];
            $supervisor_email = $requests[0]['supervisor_email'];
            $request_date = $requests[0]['request_date'];
            $status = $requests[0]['status'];
            $leader_name = $requests[0]['leader_name'];
    
            // Store team members in an array
            $team_members = [];
            foreach ($requests as $row) {
                if (!empty($row['student_email'])) {
                    $team_members[] = [
                        'email' => $row['student_email'],
                        'name' => $row['student_name']
                    ];
                }
            }
        } else {
            header("Location: SupervisorHomePage.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
    
} else {
    header("Location: SupervisorHomePage.php");
    exit;
}
?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Welcome ..., project name/number">
    <meta name="description" content="">
    <title>View Specific Request</title>
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
                                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="SupervisorHomePage.php">Supervisor home page</a>
                                </li>
                                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="supervisorProfile.php" >Profile</a>
                                </li>
                                <li class="u-nav-item"><a class="u-button-style u-nav-link"href="index.php">Log out</a>
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

    <section class="u-align-center u-clearfix u-container-align-center u-section-2" id="carousel_506f">
        <div class="u-clearfix u-sheet u-sheet-1">
            <!--product-->
            <!--product_options_json-->
            <!--{"source":"5"}-->
            <!--/product_options_json-->
            <div class="u-container-style u-expanded-width u-product u-product-1" data-products-datasource="site"
                data-product-id="5">
                <div class="u-container-layout u-valign-bottom-lg u-valign-bottom-xl u-container-layout-1">
                    <!--product_image-->
                    <img alt=""
                        class="u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-image u-image-default u-product-control u-image-1"
                        src="images/bec4780631e6204803c2c76ed0388bdff62ee08c75e5765d228e81fbbb5a1c573c70d6009559dcd56eb3d2714a753747269119e4218281bf90f6ee_1280.jpg">
                    <!--/product_image-->
                    <div class="custom-expanded u-container-style u-group u-shape-rectangle u-group-1">
                        <div class="u-container-layout u-container-layout-2">
                            <!--product_title-->
                            <h2
                                class="u-align-center u-custom-font u-font-playfair-display u-product-control u-text u-text-1">
                              <?php echo $project_name; ?>  
                              
                              </h2>
                            <!--/product_title-->
                            <!--product_description-->
                            <div class="u-product-control u-product-full-desc u-text u-text-2">Idea:  <?php echo $idea_description; ?> </div>
                            <!--/product_description-->
                            <div class="custom-expanded u-layout-grid u-list u-list-1">
                            <div class="u-repeater u-repeater-1">
    <!-- Supervisor Email -->
    <div class="u-container-style u-list-item u-repeater-item">
        <div class="u-container-layout u-similar-container u-container-layout-3">
            <h4 class="u-text u-text-3">Supervisor Email:&nbsp;</h4>
            <p class="u-text u-text-4"><?php echo $supervisor_email; ?></p>
        </div>
    </div>

    <!-- Request Date -->
    <div class="u-container-style u-list-item u-repeater-item">
        <div class="u-container-layout u-similar-container u-container-layout-3">
            <h4 class="u-text u-text-3">Request Date:&nbsp;</h4>
            <p class="u-text u-text-4"><?php echo $request_date; ?></p>
        </div>
    </div>

    <!-- Team Leader Name -->
    <div class="u-container-style u-list-item u-repeater-item">
        <div class="u-container-layout u-similar-container u-container-layout-3">
            <h4 class="u-text u-text-3">Team Leader Name:&nbsp;</h4>
            <p class="u-text u-text-4"><?php echo $leader_name; ?></p>
        </div>
    </div>

    <!-- Team Leader Email -->
    <div class="u-container-style u-list-item u-repeater-item">
        <div class="u-container-layout u-similar-container u-container-layout-4">
            <h4 class="u-text u-text-5">Team Leader Email:&nbsp;</h4>
            <p class="u-text u-text-6"><?php echo $team_email; ?></p>
        </div>
    </div>

    <!-- Loop Through Team Members -->
    <?php 
    if (!empty($team_members)) {
        foreach ($team_members as $member) { 
    if ($member['email'] == $team_email) {
        continue; // Skip the leader
    }
?>
    <!-- Team Member Name -->
    <div class="u-container-style u-list-item u-repeater-item">
        <div class="u-container-layout u-similar-container u-container-layout-3">
            <h4 class="u-text u-text-3">Student Name:&nbsp;</h4>
            <p class="u-text u-text-4"><?php echo $member['name']; ?></p>
        </div>
    </div>

    <!-- Team Member Email -->
    <div class="u-container-style u-list-item u-repeater-item">
        <div class="u-container-layout u-similar-container u-container-layout-4">
            <h4 class="u-text u-text-5">Student Email:&nbsp;</h4>
            <p class="u-text u-text-6"><?php echo $member['email']; ?></p>
        </div>
    </div>
<?php 
}

    } else { ?>
        <div class="u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-container-layout-3">
                <h4 class="u-text u-text-3">Team Members:&nbsp;</h4>
                <p class="u-text u-text-4">No additional team members.</p>
            </div>
        </div>
    <?php } ?>

    

    <!-- Status -->
    <div class="u-container-style u-list-item u-repeater-item">
        <div class="u-container-layout u-similar-container u-container-layout-4">
            <h4 class="u-text u-text-5">Status:&nbsp;</h4>
            <p class="u-text u-text-6"><?php echo $status; ?></p>
        </div>
    </div>
</div>


                            </div>

                            <?php 
                              if($status=='Pending'){
                                echo '
                                  <a href="action.php?id='.$_GET['id'].'&type='.$_GET['type'].'&status=Rejected"
                                class="u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-light-2 u-radius u-btn-1">REJECT
                            </a>
                            <a href="action.php?id='.$_GET['id'].'&type='.$_GET['type'].'&email='.$supervisor_email.'&status=Approved"
                                class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius u-btn-2">
                                APPROVE </a>
                                ';
                              }
                            ?>
                          
                        </div>
                    </div>
                </div>
            </div>
            <!--/product-->
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
    <section
        class="u-black u-clearfix u-container-style u-dialog-block u-opacity u-opacity-70 u-payment-dialog u-valign-middle u-dialog-section-5"
        id="sec-fe6a">
        <div
            class="u-align-center u-container-align-center u-container-style u-dialog u-radius-25 u-shape-round u-white u-dialog-1">
            <div class="u-container-layout u-valign-top u-container-layout-1">
                <h5 class="u-align-left u-text u-text-1">Buy Now</h5>
                <div class="u-expanded-width u-products u-products-1" data-site-sorting-prop="created"
                    data-site-sorting-order="desc" data-items-per-page="1">
                    <div class="u-list-control"></div>
                    <div class="u-repeater u-repeater-1">
                        <!--product_item-->
                        <div class="u-container-style u-products-item u-repeater-item">
                            <div class="u-container-layout u-similar-container u-container-layout-2">
                                <h5 class="u-align-left u-product-control u-text u-text-2">
                                    <a class="u-product-title-link" href="#">Product 1 Title</a>
                                </h5>
                                <div class="u-align-left u-product-control u-product-desc u-text u-text-3">
                                    <p>Sample text. Lorem ipsum dolor sit amet, consectetur adipiscing elit nullam nunc
                                        justo sagittis suscipit ultrices.</p>
                                </div>
                                <div class="u-align-left u-product-control u-product-quantity u-product-quantity-1">
                                    <div class="u-hidden u-quantity-label">Quantity</div>
                                    <div class="u-border-1 u-border-grey-30 u-quantity-input u-radius-50">
                                        <a class="disabled minus u-button-style u-quantity-button u-text-body-color">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                                <path d="m 4 8 h 8" fill="none" stroke="currentColor" stroke-width="1"
                                                    fill-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                        <input class="u-input" type="text" value="1" pattern="[0-9]+">
                                        <a class="plus u-button-style u-quantity-button u-text-body-color">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                                <path d="m 4 8 h 8 M 8 4 v 8" fill="none" stroke="currentColor"
                                                    stroke-width="1" fill-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div data-add-zero-cents="true"
                                    class="u-align-left u-product-control u-product-price u-product-price-1">
                                    <div class="u-price-wrapper u-spacing-10">
                                        <div class="u-old-price" style="text-decoration: line-through !important;">
                                            $20.00</div>
                                        <div class="u-price" style="font-size: 1.25rem; font-weight: 700;">$17.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/product_item-->
                    </div>
                    <div class="u-list-control"></div>
                </div>
                <div class="u-expanded-width u-payment-services u-tab-links-align-justify u-tab-payment u-tab-vertical u-tabs u-payment-services-1"
                    data-payment-order-approved-message="Your order has been approved. Thank you!"
                    data-payment-order-cancelled-message="Unable to process your order. Please try again later.">
                    <ul class="u-tab-list u-unstyled" role="tablist">
                        <li class="u-tab-item" role="presentation"><a
                                class="active u-active-grey-10 u-button-style u-payment-paypal u-tab-link u-text-body-color"
                                id="link-tab-9cb3" href="#tab-9cb3" role="tab" aria-controls="tab-9cb3"
                                aria-selected="true"><input type="radio" class="u-field-input u-grey-15 u-radius-15"
                                    name="payment-group" checked="checked"><span>Paypal</span><svg class="u-svg-content"
                                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px">
                                    <path fill="#009EE3" d="M11,5.9H18c3.8,0,5.2,1.9,4.9,4.7c-0.3,4.7-3.2,7.2-6.9,7.2h-1.9c-0.5,0-0.8,0.3-0.9,1.3l-0.8,4.3
  c-0.1,0.3-0.2,0.5-0.5,0.6H7.6c-0.4,0-0.5-0.3-0.4-1l2.6-16C9.9,6.3,10.2,5.9,11,5.9z"></path>
                                    <path fill="#113984" d="M6.7,0h7.1c2,0,4.3,0.1,5.9,1.5c1.1,0.9,1.6,2.4,1.5,4c-0.4,5.4-3.7,8.5-8,8.5H9.6c-0.6,0-0.9,0.4-1.2,1.5
  l-0.9,5.1C7.4,21,7.3,21.3,7,21.3H2.6C2,21.3,1.9,21,2,20.1L5.2,1.3C5.3,0.4,5.7,0,6.7,0z"></path>
                                    <path fill="#172C70" d="M8.6,14.8l1.3-7.9c0.1-0.7,0.5-1,1.3-1h7.1c1.2,0,2.1,0.2,2.8,0.5c-0.7,4.8-3.8,7.5-7.9,7.5H9.6
  C9.1,13.9,8.8,14.1,8.6,14.8z"></path>
                                </svg>
                            </a>
                        </li>
                        <li class="u-tab-item" role="presentation"><a
                                class="u-active-grey-10 u-button-style u-payment-stripe u-tab-link u-text-body-color"
                                id="link-tab-ab80" href="#tab-ab80" role="tab" aria-controls="tab-ab80"
                                aria-selected="false"><input type="radio" class="u-field-input u-grey-15 u-radius-15"
                                    name="payment-group"><span>Stripe</span><svg class="u-svg-content"
                                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24">
                                    <path fill="#635BFF" d="M14,9.2c-2.3-0.8-3.4-1.5-3.4-2.4c0-0.8,0.8-1.3,2-1.3c2.3,0,4.7,0.8,6.4,1.6l0.9-5.5
  c-1.3-0.5-4-1.6-7.7-1.6C9.6,0,7.5,0.7,5.8,1.9C4.1,3.2,3.4,4.9,3.4,7.2c0,4,2.6,5.7,6.8,7.2c2.7,0.9,3.6,1.6,3.6,2.5
  c0,0.9-0.9,1.6-2.4,1.6c-1.9,0-5.2-0.9-7.3-2.1L3,22c1.8,0.9,5.1,2,8.7,2c2.8,0,5.1-0.7,6.6-1.9c1.8-1.3,2.7-3.2,2.7-5.7
  C20.9,12.3,18.2,10.7,14,9.2L14,9.2z"></path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <div class="u-tab-content">
                        <div class="u-container-style u-payment-paypal u-tab-active u-tab-pane" id="tab-9cb3"
                            role="tabpanel" aria-labelledby="link-tab-9cb3">
                            <div class="u-container-layout u-payment-services-inner u-container-layout-3">Loading...
                            </div>
                        </div>
                        <div class="u-container-style u-payment-stripe u-tab-pane" id="tab-ab80" role="tabpanel"
                            aria-labelledby="link-tab-ab80">
                            <div class="u-container-layout u-container-layout-4">
                                <a href="#" class="u-btn u-button-style u-stripe-button u-btn-1">Pay with Stripe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><button class="u-dialog-close-button u-icon u-text-grey-40 u-icon-1"><svg class="u-svg-link"
                    preserveAspectRatio="xMidYMin slice" viewBox="0 0 16 16" style="">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-efe9"></use>
                </svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                    xml:space="preserve" class="u-svg-content" viewBox="0 0 16 16" x="0px" y="0px" id="svg-efe9">
                    <rect x="7" y="0" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -3.3138 8.0002)" width="2"
                        height="16"></rect>
                    <rect x="0" y="7" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -3.3138 8.0002)" width="16"
                        height="2"></rect>
                </svg></button>
        </div>
    </section>
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