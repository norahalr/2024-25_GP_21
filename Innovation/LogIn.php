<?php
  ob_start();
  session_start();

  require_once 'config/connect.php';
?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="LogIn​">
    <meta name="description" content="">
    <title>LogIn​</title>
    <link rel="stylesheet" href="nicepage2.css" media="screen">
 <link rel="stylesheet" href="supervisorRegister.css" media="screen"> 
<link rel="stylesheet" href="studentRegister.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.19.6, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "Site1"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="supervisorRegister">
    <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">
  <style>
     a {
    cursor: pointer;
    color: blue;
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
        cursor: pointer;
        font-size: 18px;
        color: #081f56;
        transition: color 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .slider-tab {
        position: absolute;
        height: 100%;
        width: 50%;
        left: 0;
        background: linear-gradient(to right, #296aa4 , #11518a);
        transition: left 0.3s ease;
        z-index: 0;
    }

    #student:checked ~ .slider-tab {
        left: 50%; /* Move the tab to the right when student is checked */
    }
    </style>
</head>

  <body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en">
    <!-- Header Section -->
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
              <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="index.php">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Register.php" >Sign Up</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="LogIn.php">Login</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="externalForm.php">Request Project from CCIS</a>
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
    <section class="u-clearfix u-palette-1-light-1 u-section-1" id="sec-eb0d">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-expanded-height u-expanded-height-lg u-expanded-height-md u-expanded-height-xl u-opacity u-opacity-60 u-palette-1-base u-shape u-shape-rectangle u-shape-1"></div>
        <div class="u-align-left u-container-align-left u-container-style u-expanded-width u-group u-radius u-shape-round u-white u-group-1">
          <div class="u-container-layout u-valign-top u-container-layout-1">
            <div class="custom-expanded data-layout-selected u-clearfix u-layout-wrap u-layout-wrap-1">
              
<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){
  $type= $_POST['type'];
  $email=$_POST['email'];
  $password=$_POST['password'];

  if ($type == 1) { // Supervisor
    $stmt = $con->prepare("SELECT email, password FROM supervisors WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($password, $result['password'])) {
      $_SESSION['user_id'] = $result['email'];
      $_SESSION['email'] = $email;
      $_SESSION['user_type'] = 'supervisor';
        header("Location: SupervisorHomePage.php");
        exit();
    } else {
        echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-error u-form-send-message">Invalid email or password retry or reset password.</div>';
    }
} else { // Student
  $stmt = $con->prepare("SELECT password, team_email FROM students WHERE email = :email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if ($result && password_verify($password, $result['password'])) {
    // Start session and set session variables
    session_start();
    $_SESSION['user_id'] = $email;
    $_SESSION['email'] = $email;
    $_SESSION['user_type'] = 'student';

    // Determine the role based on the team_email
    if ($result['team_email'] == $email) {
       // $_SESSION['role'] = 'leader'; // User is a leader
        setcookie('role', 'leader', time() + 3600, "/", "", true, true); // Set secure cookie for role
    } else {
       // $_SESSION['role'] = 'member'; // User is a member
        setcookie('role', 'member', time() + 3600, "/", "", true, true); // Set secure cookie for role
    }


    header("Location: StudentHomePage.php");
    exit();
 } else {
      // Display an error for invalid credentials
      echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-error u-form-send-message">Invalid email or password.</div>';
  }
  
}

}
?>
            <div class="u-layout">
                <div class="u-layout-row">
                  <div class="u-container-style u-layout-cell u-size-60 u-layout-cell-1" data-animation-name="customAnimationIn" data-animation-duration="1500" data-animation-delay="500">
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
                     
                      <div class="u-container-style u-group u-opacity u-opacity-30 u-palette-1-light-2 u-radius u-shape-round u-group-2">
                        <div class="u-container-layout u-container-layout-3">
                          <div class="u-form u-form-1">
                            
<!-- Add Radio Buttons to choose between Supervisor or Student -->


                        <div class="radio-btn-container">
                            <input type="radio" name="user-role" id="supervisor" value="supervisor" checked>
                            <input type="radio" name="user-role" id="student" value="student">
                            <span class="slider-tab"></span>
                            
                            <label for="supervisor" class="radio-btn">Supervisor</label>
                            <label for="student" class="radio-btn">Student</label>
                        </div>

                        
                        <form action="LogIn.php" method="POST" id="supervisor-login-form" >                        
                        <input type="hidden" name="type" value="1" />
                            <h1 class="u-align-center u-text u-text-custom-color-1 u-text-default u-text-1">Supervisor Login </h1>
                            <div class="u-form-group u-form-name">
                              <label for="email-da99" class="u-label">Email <span style="color:red;">*</span></label>
                              <input type="text" placeholder="Enter a valid email address" id="email-da99" name="email"                     
                              class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none"
                              required="required">
                            </div>
                            <div class="u-form-group u-label-none u-form-group-2">
  <label for="text-5a78" class="u-label">
    Password <span style="color:red;">*</span>
  </label>
  <input type="password" placeholder="Password" id="text-5a78" name="password"
      class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none"
      required="required">
  <a href="javascript:void(0);" onclick="togglePasswordVisibility('text-5a78')" id="toggle-text-5a78" style="color: blue; text-decoration: underline; font-size: 12px;">
    Show Password
  </a>
</div>

                            <div class="u-align-right u-form-group u-form-submit">
                              <a href="Forget.php" class="frpass">Forget password?</a>
                              <button type="submit" class="u-active-palette-1-light-1 u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-base u-radius u-btn-1">Login</button>
                            </div>
                        </form>





                        <form action="LogIn.php" method="POST" id="student-login-form" >
                            <input type="hidden" name="type" value="2" />
                            <h1 class="u-align-center u-text u-text-custom-color-1 u-text-default u-text-1">Students Login </h1>
                            <div class="u-form-group u-label-none">
                              <label for="email-da97" class="u-label">Email <span style="color:red;">*</span></label>
                              <input type="text" placeholder="Enter leader email address" id="email-da97" name="email"
                              class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none"
                              required="required">
                            </div>
                            <div class="u-form-group u-label-none u-form-group-2">
  <label for="text-5a79" class="u-label">
    Password <span style="color:red;">*</span>
  </label>
  <input type="password" placeholder="Password" id="text-5a79" name="password"
      class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none"
      required="required">
  <a href="javascript:void(0);" onclick="togglePasswordVisibility('text-5a79')" id="toggle-text-5a79" 
      style="color: blue; text-decoration: underline; font-size: 12px; display: inline-block; margin-top: 5px;">
    Show Password
  </a>
</div>

                            <div class="u-align-right u-form-group u-form-submit">
                              <a href="Forget.php" class="frpass">Forget password?</a>
                              <button type="submit" class="u-active-palette-1-light-1 u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-base u-radius u-btn-1">Login</button>
                            </div>
                          </form>


                          </div>
                          <a href="Register.php" class="u-active-none u-border-5 u-border-active-palette-2-dark-1 u-border-hover-custom-color-1 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-btn u-button-style u-hover-none u-none u-text-active-palette-1-light-1 u-text-hover-palette-1-dark-2 u-text-palette-1-dark-1 u-btn-2">Do not have an account? Register</a>
                          

                        </div>
                      </div>
              </div>
            </div>
          </div>
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
    
  
    <script>
      function togglePasswordVisibility(inputId) {
    const passwordField = document.getElementById(inputId);
    const toggleLink = document.getElementById('toggle-' + inputId);

    if (passwordField.type === "password") {
        passwordField.type = "text"; // Reveal the password
        toggleLink.textContent = "Hide Password"; // Update link text
    } else {
        passwordField.type = "password"; // Hide the password
        toggleLink.textContent = "Show Password"; // Update link text
    }
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

      document.addEventListener("DOMContentLoaded", function() {
          const supervisorForm = document.getElementById("supervisor-login-form");
          const studentForm = document.getElementById("student-login-form");
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