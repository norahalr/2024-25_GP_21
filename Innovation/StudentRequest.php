<?php
  ob_start();
  session_start();
  $userEmail = $_SESSION['user_id'] ?? "alanoud.ahmed@example.com"; // Get user ID from session

  require_once 'config/connect.php';
  
  try {
    // Prepare the SQL statement to fetch requests for the logged-in student
    $stmt = $con->prepare("SELECT id, project_name, description, status FROM team_idea_request WHERE team_email = :team_email");
    $stmt->execute(['team_email' => $userEmail]);

    // Fetch all results
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Uncomment this section once you have data in the database for testing
    // $stmt->execute(); 
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
  ?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Post 1 Headline, Post 2 Headline, Post 3 Headline">
    <meta name="description" content="">
    <title>StudentRequest</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="StudentRequest.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.19.6, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "images/logo_GP-noname.png"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="StudentRequest">
    <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
  <body data-path-to-root="./" data-include-products="true" class="u-body u-xl-mode" data-lang="en">
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


      <section class="u-align-center u-clearfix u-container-align-center u-section-1" id="carousel_2094">
    <div class="u-clearfix u-sheet u-sheet-1">
        <a href="StudentHomePage.php" class="u-active-palette-1-light-3 u-border-none u-btn u-button-style u-hover-palette-1-light-1 u-palette-1-base u-text-white u-btn-1">Add​&nbsp;<span class="u-file-icon u-icon u-text-palette-1-light-1"><img src="images/1665629-c9014b65.png" alt=""></span></a>
        <h1 class="u-align-center u-text u-text-default u-text-palette-1-dark-1 u-text-1">Your Group Requests</h1>
        <div class="u-blog u-expanded-width u-blog-1">
            <div class="u-list-control"></div>
            <div class="u-repeater u-repeater-1">
                <?php if (!empty($requests)): ?>
                    <?php foreach ($requests as $request): ?>
                        <div class="u-blog-post u-repeater-item">
                            <div class="u-container-layout u-similar-container u-valign-bottom-xs u-container-layout-<?= $request['id'] ?>">
                                <a class="u-post-header-link" href="blog/request-<?= $request['id'] ?>.php">
                                    <img src="images/bulb_idea_knowledge_light_read_icon.png" alt="" class="u-blog-control u-image u-image-default u-image-1" data-image-width="1280" data-image-height="852">
                                </a>
                                <h2 class="u-blog-control u-text u-text-2">
                                    <a class="u-post-header-link" href="blog/request-<?= $request['id'] ?>.php"><?= htmlspecialchars($request['project_name']) ?></a>
                                </h2>
                                <div class="u-blog-control u-post-content u-text u-text-3 fr-view">
                                    Project Idea: <?= htmlspecialchars($request['description']) ?>
                                </div>
                                <div class="u-blog-control u-metadata u-metadata-1">
                                    <!-- Status with color coding -->
                                    <span class="u-meta-date u-meta-icon" style="color: 
                                        <?php 
                                        if ($request['status'] == 'Approved') {
                                            echo 'lightgreen';
                                        } elseif ($request['status'] == 'Rejected') {
                                            echo 'red';
                                        } else {
                                            echo 'black';
                                        } 
                                        ?>">
                                        <?= htmlspecialchars($request['status']) ?>
                                    </span>
                                </div>
                                
                                <div class="u-blog-control u-post-tags u-post-tags-1">
                                    <!-- Replace with actual date -->
                                    <span><?= htmlspecialchars($request['request_date']) ?></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No requests found.</p>
                <?php endif; ?>
            </div>
            <div class="u-list-control"></div>
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
  
</body></html>