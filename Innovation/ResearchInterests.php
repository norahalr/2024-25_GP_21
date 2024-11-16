<?php
  ob_start();
  session_start();
  require_once 'config/connect.php';

  $sql = "SELECT id, name FROM technologies";
$stmt = $con->prepare($sql);
$stmt->execute();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Ensure the user is logged in
  if (!isset($_SESSION['user_id'])) {
      echo "Error: User is not logged in.";
      exit();
  }

  $leader_email = $_SESSION['user_id']; // Retrieve leader email from session
  $interests = isset($_POST['interests']) ? $_POST['interests'] : []; // Get selected interests
  $errors = [];

  // Validate interests
  if (empty($interests)) {
      $errors[] = "Please select at least one interest.";
  }

  if (empty($errors)) {
      try {
          // Prepare interest data for insertion
          $interestsString = implode(',', $interests); // Convert array to comma-separated string

          // Update the teams table with the selected interests
          $stmt = $con->prepare("UPDATE teams SET interest = :interests WHERE leader_email = :email");
          $stmt->bindParam(':interests', $interestsString);
          $stmt->bindParam(':email', $leader_email);

          if ($stmt->execute()) {
              echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-message u-form-send-success"> Interests updated successfully! </div>';

              // Redirect to the next page or a success page
              header("Location: StudentHomePage.php");
              exit();
          } else {
              echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-error u-form-send-message"> Unable to update interests. Please try again later. </div>';
          }
      } catch (PDOException $e) {
          echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-error u-form-send-message"> Database error: ' . htmlspecialchars($e->getMessage()) . '</div>';
      }
  } else {
      foreach ($errors as $error) {
          echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-error u-form-send-message">' . htmlspecialchars($error) . '</div>';
      }
  }
}


?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="What fields are you ​interested in?">
    <meta name="description" content="">
    <title>Research Interests</title>
    <link rel="stylesheet" href="nicepage2.css" media="screen">
<link rel="stylesheet" href="fieldInterest.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.19.6, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "Site1"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="fieldInterest">
    <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
  <body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en">
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
          <ul class="u-nav u-spacing-30 u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="index.php" style="padding: 10px 0px;">Home</a>
          </li><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;" href="Register.php">Sign Up</a>
          </li><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;" href="LogIn.php">Login</a>
          </li><li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;" href="externalForm.php">Request Project from CCIS</a>
          </li></ul>
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
    <!-- <section class="u-clearfix u-palette-1-light-1 u-section-1" id="sec-7108">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-expanded-width u-flip-horizontal u-shape u-shape-svg u-text-white u-shape-1">
          <svg class="u-svg-link" preserveAspectRatio="none" viewBox="0 0 160 150" style=""><use xlink:href="#svg-a8e1"></use></svg>
          <svg class="u-svg-content" viewBox="0 0 160 150" x="0px" y="0px" id="svg-a8e1"><path d="M43.2,126.9c14.2,1.3,27.6,7,39.1,15.6c8.3,6.1,19.4,10.3,32.7,5.3c11.7-4.4,18.6-17.4,21-30.2c2.6-13.3,8.1-25.9,15.7-37.1
	c8.3-12.1,10.8-27.9,5.3-42.7C150.5,20.3,134.6,9,117,7.6C107.9,6.9,98.8,5,90.1,1.9C83-0.6,75-0.7,67.4,2.1
	c-9.9,3.7-17,11.6-20.1,21c-3.3,10.1-10.9,18-20.6,22.2c-0.1,0-0.1,0.1-0.2,0.1c-20.3,8.9-31,32-24.6,53.2
	C6.9,115.6,25.2,125.2,43.2,126.9z"></path></svg>
        </div>
        <h2 class="u-text u-text-custom-color-3 u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-1">What fields are you ​interested in?</h2>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-1">Artificial Intelligence&nbsp;<span class="u-file-icon u-icon u-icon-1"><img src="images/900961.png" alt=""></span>
        </a>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-2">Internet Of Things&nbsp;<span class="u-file-icon u-icon u-icon-2"><img src="images/1698293.png" alt=""></span>
        </a>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-3">Cyber Security&nbsp;<span class="u-file-icon u-icon u-icon-3"><img src="images/5964320.png" alt=""></span>
        </a>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-4">Sports&nbsp;<span class="u-file-icon u-icon u-icon-4"><img src="images/3043888.png" alt=""></span>
        </a>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-5">Medical&nbsp;<span class="u-file-icon u-icon u-icon-5"><img src="images/2382443.png" alt=""></span>
        </a>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-active-custom-color-3 u-border-hover-palette-1-light-2 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-6">Military&nbsp;<span class="u-file-icon u-icon u-icon-6"><img src="images/1805998.png" alt=""></span>
        </a>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-7">Tourism&nbsp;<span class="u-file-icon u-icon u-icon-7"><img src="images/4271027.png" alt=""></span>
        </a>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-8">Pets Care&nbsp;<span class="u-file-icon u-icon u-icon-8"><img src="images/8971659.png" alt=""></span>
        </a>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-9">Genetics&nbsp;<span class="u-file-icon u-icon u-icon-9"><img src="images/1548234.png" alt=""></span>
        </a>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-10">Education&nbsp;<span class="u-file-icon u-icon u-icon-10"><img src="images/4185218.png" alt=""></span>
        </a>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-11">Games&nbsp;<span class="u-file-icon u-icon u-icon-11"><img src="images/2972351.png" alt=""></span>
        </a>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-12">Virtual Reality<span class="u-file-icon u-icon u-icon-12"><img src="images/5379827.png" alt=""></span>
        </a>
        <a href="#" class="u-active-custom-color-3 u-border-1 u-border-palette-1-light-1 u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-light-3 u-radius u-text-palette-1-dark-2 u-btn-13">Disabilities&nbsp;<span class="u-file-icon u-icon u-icon-13"><img src="images/3996083.png" alt=""></span>
        </a>
        <a href="#" class="u-btn u-button-style u-none u-text-hover-palette-1-light-2 u-text-palette-1-base u-btn-14">Next&nbsp;<span class="u-icon u-text-palette-1-base u-icon-14"><svg class="u-svg-content" viewBox="0 -32 426.66667 426" style="width: 1em; height: 1em;"><path d="m213.332031 181.667969c0 4.265625-1.277343 8.53125-3.625 11.730469l-106.667969 160c-3.839843 5.761718-10.238281 9.601562-17.707031 9.601562h-64c-11.730469 0-21.332031-9.601562-21.332031-21.332031 0-4.269531 1.28125-8.535157 3.625-11.734375l98.773438-148.265625-98.773438-148.269531c-2.34375-3.199219-3.625-7.464844-3.625-11.730469 0-11.734375 9.601562-21.335938 21.332031-21.335938h64c7.46875 0 13.867188 3.839844 17.707031 9.601563l106.667969 160c2.347657 3.199218 3.625 7.464844 3.625 11.734375zm0 0"></path><path d="m426.667969 181.667969c0 4.265625-1.28125 8.53125-3.628907 11.730469l-106.664062 160c-3.839844 5.761718-10.242188 9.601562-17.707031 9.601562h-64c-11.734375 0-21.335938-9.601562-21.335938-21.332031 0-4.269531 1.28125-8.535157 3.628907-11.734375l98.773437-148.265625-98.773437-148.269531c-2.347657-3.199219-3.628907-7.464844-3.628907-11.730469 0-11.734375 9.601563-21.335938 21.335938-21.335938h64c7.464843 0 13.867187 3.839844 17.707031 9.601563l106.664062 160c2.347657 3.199218 3.628907 7.464844 3.628907 11.734375zm0 0"></path></svg></span>
        </a>
      </div>
    </section>  -->
    
    
    <section class="u-clearfix u-palette-1-light-1 u-section-1" id="sec-7108">
    <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-expanded-width u-flip-horizontal u-shape u-shape-svg u-text-white u-shape-1">
            <svg class="u-svg-link" preserveAspectRatio="none" viewBox="0 0 160 150" style=""><use xlink:href="#svg-a8e1"></use></svg>
            <svg class="u-svg-content" viewBox="0 0 160 150" x="0px" y="0px" id="svg-a8e1">
                <path d="M43.2,126.9c14.2,1.3,27.6,7,39.1,15.6c8.3,6.1,19.4,10.3,32.7,5.3c11.7-4.4,18.6-17.4,21-30.2c2.6-13.3,8.1-25.9,15.7-37.1
                c8.3-12.1,10.8-27.9,5.3-42.7C150.5,20.3,134.6,9,117,7.6C107.9,6.9,98.8,5,90.1,1.9C83-0.6,75-0.7,67.4,2.1
                c-9.9,3.7-17,11.6-20.1,21c-3.3,10.1-10.9,18-20.6,22.2c-0.1,0-0.1,0.1-0.2,0.1c-20.3,8.9-31,32-24.6,53.2
                C6.9,115.6,25.2,125.2,43.2,126.9z"></path>
            </svg>
        </div>
        <h2 class="u-text u-text-custom-color-3 u-text-1">What fields are you interested in?</h2>

        <form action="ResearchInterests.php" method="POST">
    <div class="form-container">
        <div class="interest-container">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="interest-item">
                    <label class="u-btn u-btn-round u-button-style u-palette-1-light-3 u-radius u-text-palette-1-dark-2 interest-button">
                        <input type="checkbox" name="interests[]" value="<?= htmlspecialchars($row['id']) ?>" style="display: none;">
                        <span><?= htmlspecialchars($row['name']) ?></span>
                    </label>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <button type="submit" class="u-btn u-button-style u-none u-text-hover-palette-1-light-2 u-text-palette-1-base u-btn-14">
        Next
    </button>
</form>

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
  
</body>
<style>
/* Centering the form and limiting its width */
.form-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

/* Grid layout with wrapping for interest items */
.interest-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 7%;
    margin-top: 20px;
    box-sizing: border-box;
}

/* Style for individual interest items */
.interest-item {
    display: flex;
    justify-content: center;
    box-sizing: border-box;
   
}

/* Style for the label to look like a button */
.interest-button {
    display: block;
    padding: 20px 30px;
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    border: 1px solid transparent;
    background-color:#c2dbf0 !important ;
    transition: background-color 0.3s ease, transform 0.2s ease;
    margin: 0;
    box-sizing: border-box;
}

/* Hover effect for interest items */
.interest-button:hover {
    background-color: #94bce0;
    transform: translateY(-2px);
}

/* Selected effect when checkbox is checked */
.interest-button input[type="checkbox"]:checked + span {
    background-color: #7dafdb; /* Darker color for selected state */
    color: white;
    padding: 5%; /* Ensure padding is applied for selected state */
    
}
.u-input.u-palette-1-light-3, .u-field-input.u-palette-1-light-3,
 .u-button-style.u-palette-1-light-3,
.u-button-style.u-palette-1-light-3[class*="u-border-"]:checked + span{
  background-color: transparent !important; /* Darker color for selected state */
}

.u-input.u-palette-1-light-3,
.u-field-input.u-palette-1-light-3,
.u-button-style.u-palette-1-light-3,
.u-button-style.u-palette-1-light-3[class*="u-border-"] {
  color: #111111 !important;
  background-color: transparent !important;
}

/* Style for the submit button */
button.u-btn.u-button-style.u-btn-14 {
    background-color: #478ac9 !important;
    color: white !important;
    border: none !important;
    padding: 10px 20px !important;
    font-size: 16px !important;
    cursor: pointer !important;
    transition: background-color 0.3s ease !important;
}

button.u-btn.u-button-style.u-btn-14:hover {
    background-color: #357f9b !important;
}
</style>

</html>