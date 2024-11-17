<?php
session_start();

// Check if there's a message to display
if (isset($_SESSION['message'])) {
    echo "<div class='message'>{$_SESSION['message']}</div>";
    unset($_SESSION['message']);  // Clear the message after displaying
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="​Our People">
    <meta name="description" content="">
    <title>StudentHomePage</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="StudentHomePage.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.19.6, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700">
    
    
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "images/logo_GP-noname.png"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="StudentHomePage">
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
    
    <section class="u-clearfix u-section-1" id="sec-9f4c">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="custom-expanded u-form u-form-1">
          <form action="https://forms.nicepagesrv.com/v2/form/process" class="u-clearfix u-form-horizontal u-form-spacing-0 u-inner-form" source="email" name="form" style="padding: 10px;">
            <div class="u-form-group u-form-select u-label-none u-form-group-1">
              <label for="select-7000" class="u-label">Search by</label>
              <div class="u-form-select-wrapper">
                <select id="select-7000" name="select-1" class="u-input u-input-rectangle">
                  <option value="SupervisorName" data-calc="SupervisorName">Supervisor Name</option>
                  <option value="Project-Name" data-calc="Project-Name">Project Name</option>
                  <option value="Track" data-calc="Track">Supervisor Track</option>
                </select>
                <svg class="u-caret u-caret-svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" style="fill:currentColor;" xml:space="preserve"><polygon class="st0" points="8,12 2,4 14,4 "></polygon></svg>
              </div>
            </div>
            <div class="u-form-group u-form-select u-label-none u-form-group-2" data-dependency="[{&quot;action&quot;:&quot;show&quot;,&quot;field&quot;:&quot;select-1&quot;,&quot;condition&quot;:&quot;equal&quot;,&quot;value&quot;:&quot;Track&quot;}]">
              <label for="select-90a6" class="u-label">Track</label>
              <div class="u-form-select-wrapper">
                <select id="select-90a6" name="select-2" class="u-input u-input-rectangle" required="required">
                  <option value="Security" selected="selected" data-calc="Security">Security</option>
                  <option value="AI" data-calc="AI">AI</option>
                  <option value="Network" data-calc="Network">Iot</option>
                </select>
                <svg class="u-caret u-caret-svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" style="fill:currentColor;" xml:space="preserve"><polygon class="st0" points="8,12 2,4 14,4 "></polygon></svg>
              </div>
            </div>
            <div class="u-form-group u-label-none u-form-group-3" data-dependency="[{&quot;action&quot;:&quot;hide&quot;,&quot;field&quot;:&quot;select-1&quot;,&quot;condition&quot;:&quot;equal&quot;,&quot;value&quot;:&quot;Track&quot;}]">
              <label for="text-5fe6" class="u-label">-</label>
              <input type="text" placeholder="Search" id="text-5fe6" name="text" class="u-input u-input-rectangle" required="required">
            </div>
            <div class="u-align-left u-form-group u-form-submit u-label-none">
              <input type="submit" value="submit" class="u-form-control-hidden">
              <a href="#" class="u-btn u-btn-submit u-button-style u-btn-1"><span class="u-icon"><svg class="u-svg-content" viewBox="0 0 52.966 52.966" x="0px" y="0px" style="width: 1em; height: 1em;"><path d="M51.704,51.273L36.845,35.82c3.79-3.801,6.138-9.041,6.138-14.82c0-11.58-9.42-21-21-21s-21,9.42-21,21s9.42,21,21,21
	c5.083,0,9.748-1.817,13.384-4.832l14.895,15.491c0.196,0.205,0.458,0.307,0.721,0.307c0.25,0,0.499-0.093,0.693-0.279
	C52.074,52.304,52.086,51.671,51.704,51.273z M21.983,40c-10.477,0-19-8.523-19-19s8.523-19,19-19s19,8.523,19,19
	S32.459,40,21.983,40z"></path></svg></span>&nbsp;Search
              </a>
            </div>
            <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
            <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
            <input type="hidden" value="" name="recaptchaResponse">
            <input type="hidden" name="formServices" value="1ddc229c-1613-baa1-ce6d-5067c64a9023">
          </form>
        </div>
      </div>
    </section>
    <section class="u-align-center u-clearfix u-container-align-center u-gradient u-section-2" id="carousel_57c9">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-align-center u-text u-text-default u-text-palette-1-dark-1 u-text-1">Welcome...<br>
        </h2>
        <div class="u-expanded-width u-layout-grid u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <div class="u-container-layout u-similar-container u-container-layout-1">
                <div class="u-clearfix u-group-elements u-group-elements-1">
                  <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-2">Nat Reynolds</h5>
                  <div alt="" class="u-border-5 u-border-palette-1-dark-1 u-image u-image-circle u-image-1" data-image-width="309" data-image-height="309"></div>
                  <a href="ViewSupervisor.php" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-1">View </a>
                  <h6 class="u-align-left u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-3">Email@ksu.edu.sa </h6>
                  <h6 class="u-align-left u-text u-text-default u-text-palette-1-dark-1 u-text-4">Interest: </h6>
                  <ul class="u-align-left u-text u-text-5">
                    <li> Glavi amet ritnisl l</li>
                    <li> Glavi amet ritnisl li</li>
                    <li> Glavi amet ritnisl lib</li>
                    <li> Glavi amet ritnisl l
                    </li>
                  </ul>
                  <a href="RequestSupervisor.php" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-2">REQUEST </a>
                  <h6 class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-custom-font u-font-oswald u-text u-text-custom-color-5 u-text-6">Available ​&nbsp;<span class="u-file-icon u-icon u-text-custom-color-5 u-icon-1"><img src="images/3699459-d2dcaf9f.png" alt=""></span>
                  </h6>
                </div>
              </div>
            </div>
            <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-2" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <div class="u-container-layout u-similar-container u-container-layout-2">
                <div class="u-clearfix u-group-elements u-group-elements-2">
                  <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-7">Nat Reynolds</h5>
                  <div alt="" class="u-border-5 u-border-palette-1-dark-1 u-image u-image-circle u-image-2" data-image-width="309" data-image-height="309"></div>
                  <a href="ViewSupervisor.php" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-3">View </a>
                  <h6 class="u-align-left u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-8">Email@ksu.edu.sa </h6>
                  <h6 class="u-align-left u-text u-text-default u-text-palette-1-dark-1 u-text-9">Interest: </h6>
                  <ul class="u-align-left u-text u-text-5">
                    <li> Glavi amet ritnisl l</li>
                    <li> Glavi amet ritnisl li</li>
                    <li> Glavi amet ritnisl lib</li>
                    <li> Glavi amet ritnisl l
                    </li>
                  </ul>
                  <a href="RequestSupervisor.php" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-4">REQUEST </a>
                  <h6 class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-custom-font u-font-oswald u-text u-text-custom-color-5 u-text-11">Available ​&nbsp;<span class="u-file-icon u-icon u-text-custom-color-5 u-icon-2"><img src="images/3699459-d2dcaf9f.png" alt=""></span>
                  </h6>
                </div>
              </div>
            </div>
            <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-3" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <div class="u-container-layout u-similar-container u-container-layout-3">
                <div class="u-clearfix u-group-elements u-group-elements-3">
                  <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-12">Nat Reynolds</h5>
                  <div alt="" class="u-border-5 u-border-palette-1-dark-1 u-image u-image-circle u-image-3" data-image-width="309" data-image-height="309"></div>
                  <a href="VeiwSupervisor.php" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-5">View </a>
                  <h6 class="u-align-left u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-13">Email@ksu.edu.sa </h6>
                  <h6 class="u-align-left u-text u-text-default u-text-palette-1-dark-1 u-text-14">Interest: </h6>
                  <ul class="u-align-left u-text u-text-5">
                    <li> Glavi amet ritnisl l</li>
                    <li> Glavi amet ritnisl li</li>
                    <li> Glavi amet ritnisl lib</li>
                    <li> Glavi amet ritnisl l
                    </li>
                  </ul>
                  <a href="RequestSupervisor.php" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-6">REQUEST </a>
                  <h6 class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-custom-font u-font-oswald u-text u-text-custom-color-5 u-text-16">Available ​&nbsp;<span class="u-file-icon u-icon u-text-custom-color-5 u-icon-3"><img src="images/3699459-d2dcaf9f.png" alt=""></span>
                  </h6>
                </div>
              </div>
            </div>
            <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-4" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <div class="u-container-layout u-similar-container u-container-layout-4">
                <div class="u-clearfix u-group-elements u-group-elements-4">
                  <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-17">Nat Reynolds</h5>
                  <div alt="" class="u-border-5 u-border-palette-1-dark-1 u-image u-image-circle u-image-4" data-image-width="309" data-image-height="309"></div>
                  <a href="ViewSupervisor.php" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-7">View </a>
                  <h6 class="u-align-left u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-18">Email@ksu.edu.sa </h6>
                  <h6 class="u-align-left u-text u-text-default u-text-palette-1-dark-1 u-text-19">Interest: </h6>
                  <ul class="u-align-left u-text u-text-5">
                    <li> Glavi amet ritnisl l</li>
                    <li> Glavi amet ritnisl li</li>
                    <li> Glavi amet ritnisl lib</li>
                    <li> Glavi amet ritnisl l
                    </li>
                  </ul>
                  <a href="RequestSupervisor.php" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-8">REQUEST </a>
                  <h6 class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-custom-font u-font-oswald u-text u-text-custom-color-5 u-text-21">Available ​&nbsp;<span class="u-file-icon u-icon u-text-custom-color-5 u-icon-4"><img src="images/3699459-d2dcaf9f.png" alt=""></span>
                  </h6>
                </div>
              </div>
            </div>
            <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-5" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <div class="u-container-layout u-similar-container u-container-layout-5">
                <div class="u-clearfix u-group-elements u-group-elements-5">
                  <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-22">Nat Reynolds</h5>
                  <div alt="" class="u-border-5 u-border-palette-1-dark-1 u-image u-image-circle u-image-5" data-image-width="309" data-image-height="309"></div>
                  <a href="ViewSupervisor.php" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-9">View </a>
                  <h6 class="u-align-left u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-23">Email@ksu.edu.sa </h6>
                  <h6 class="u-align-left u-text u-text-default u-text-palette-1-dark-1 u-text-24">Interest: </h6>
                  <ul class="u-align-left u-text u-text-5">
                    <li> Glavi amet ritnisl l</li>
                    <li> Glavi amet ritnisl li</li>
                    <li> Glavi amet ritnisl lib</li>
                    <li> Glavi amet ritnisl l
                    </li>
                  </ul>
                  <a href="RequestSupervisor.php" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-10">REQUEST </a>
                  <h6 class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-custom-font u-font-oswald u-text u-text-custom-color-5 u-text-26">Available ​&nbsp;<span class="u-file-icon u-icon u-text-custom-color-5 u-icon-5"><img src="images/3699459-d2dcaf9f.png" alt=""></span>
                  </h6>
                </div>
              </div>
            </div>
            <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-6" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <div class="u-container-layout u-similar-container u-container-layout-6">
                <div class="u-clearfix u-group-elements u-group-elements-6">
                  <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-27">Nat Reynolds</h5>
                  <div alt="" class="u-border-5 u-border-palette-1-dark-1 u-image u-image-circle u-image-6" data-image-width="309" data-image-height="309"></div>
                  <a href="ViewSupervisor.php" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-11">View </a>
                  <h6 class="u-align-left u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-28">Email@ksu.edu.sa </h6>
                  <h6 class="u-align-left u-text u-text-default u-text-palette-1-dark-1 u-text-29">Interest: </h6>
                  <ul class="u-align-left u-text u-text-5">
                    <li> Glavi amet ritnisl l</li>
                    <li> Glavi amet ritnisl li</li>
                    <li> Glavi amet ritnisl li</li>
                    <li> Glavi amet ritnisl l
                    </li>
                  </ul>
                  <a href="RequestSupervisor.php" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-12">REQUEST </a>
                  <h6 class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-custom-font u-font-oswald u-text u-text-custom-color-5 u-text-31">Available ​&nbsp;<span class="u-file-icon u-icon u-text-custom-color-5 u-icon-6"><img src="images/3699459-d2dcaf9f.png" alt=""></span>
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- Chatbot Icon HTML -->
<div class="chatbot-icon">
  <span class="u-file-icon u-gradient u-icon u-icon-circle u-icon-7" data-href="#">
    <img src="images/11054454_advisor_assistant_chatbot_robo_robot_icon.png" alt="Chatbot Icon">
  </span>
</div>

<!-- CSS to Position the Icon -->

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