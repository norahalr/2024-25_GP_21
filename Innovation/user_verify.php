<?php
ob_start();
session_start();
$config = include('config/config.php');
$servername = "localhost";
$username = "u253034616_root";
$password = "INNOVATION@engine2025";  // Default MAMP password
$db = "u253034616_innovation";

try {
    $con = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage(); // Display the error message
}
?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="LogIn​">
    <meta name="description" content="">
    <title>Verify Account</title>
    <link rel="stylesheet" href="nicepage2.css" media="screen">
    <link rel="stylesheet" href="supervisorRegister.css" media="screen">
    <link rel="stylesheet" href="studentRegister.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.19.6, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">


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
            background: linear-gradient(to right, #296aa4, #11518a);
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
<header class="u-clearfix u-header" id="sec-4e01">
    <div class="u-clearfix u-sheet u-sheet-1">
<?php include 'public_menu.php';?>
        <a href="#" class="u-image u-logo u-image-1" data-image-width="276" data-image-height="194">
            <img src="images/logo_GP-noname.png" class="u-logo-image u-logo-image-1">
        </a>
    </div>
</header>
<section class="u-clearfix u-palette-1-light-1 u-section-1" id="sec-eb0d">
    <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-expanded-height u-expanded-height-lg u-expanded-height-md u-expanded-height-xl u-opacity u-opacity-60 u-palette-1-base u-shape u-shape-rectangle u-shape-1"></div>
        <div class="u-align-left u-container-align-left u-container-style u-expanded-width u-group u-radius u-shape-round u-white u-group-1">
            <div class="u-container-layout u-valign-top u-container-layout-1">
                <div class="custom-expanded data-layout-selected u-clearfix u-layout-wrap u-layout-wrap-1">

                    <?php
                    $type = $_SESSION['user_type'];
                    $email = $_SESSION['user_id'];
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $code = $_POST['code'];
                        $stmt = $con->prepare("SELECT * FROM verify WHERE email = :email && code = :code");
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':code', $code);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($result) {
                            if ($type == 'supervisor') {
                                $stmt = $con->prepare("UPDATE supervisors set verified=1 WHERE email = :email");
                                $stmt->bindParam(':email', $email);
                                $stmt->execute();
                                header("Location: SupervisorHomePage.php");
                            } else {
                                $stmt = $con->prepare("UPDATE students set verified=1 WHERE email = :email");
                                $stmt->bindParam(':email', $email);
                                $stmt->execute();
                                $_SESSION['u_verified'] = '1';
                                header("Location: ResearchInterests.php");
                            }
                        } else {
                            echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-error u-form-send-message">Invalid code.</div>';

                        }
                    } else {
                        $code = random_int(100000, 999999);
                        $stmt = $con->prepare("SELECT email FROM verify WHERE email = :email");
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($result) {
                            $stmt = $con->prepare("UPDATE verify set code=:code WHERE email = :email");
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':code', $code);
                            $stmt->execute();
                        } else {
                            $stmt = $con->prepare("INSERT INTO verify (code,email) VALUES(:code,:email)");
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':code', $code);
                            $stmt->execute();
                        }
                        //send email
                        $mail->addAddress($email, 'Me');
                        $mail->Subject = 'Verify your account';
                        $mail->isHTML(TRUE);
                        $mail->Body = '<html>Hello, Thanks for joining us. <br>Confirm your account.</br> verify code: '.$code.'</html>';
                        if (!$mail->send()) {
                            echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-error u-form-send-message">Email not sent.</div>';
                        }                    }
                    ?>


                    <div class="u-layout">
                        <div class="u-layout-row">
                            <div class="u-container-style u-layout-cell u-size-60 u-layout-cell-1"
                                 data-animation-name="customAnimationIn" data-animation-duration="1500"
                                 data-animation-delay="500">
                                <div class="u-container-layout u-container-layout-2">


                                    <div class="u-container-style u-group u-opacity u-opacity-30 u-palette-1-light-2 u-radius u-shape-round u-group-2">
                                        <div class="u-container-layout u-container-layout-3">
                                            <div class="u-form u-form-1">

                                                <!-- Add Radio Buttons to choose between Supervisor or Student -->


                                                <form action="user_verify.php"
                                                      method="POST" id="supervisor-login-form">
                                                    <h1 class="u-align-center u-text u-text-custom-color-1 u-text-default u-text-1">
                                                        Verify your account</h1>
                                                    <div class="u-form-group u-form-name">
                                                        <label for="email-da99" class="u-label">Code</label>
                                                        <input type="text"
                                                               placeholder="Please enter the code sent to your email"
                                                               maxlength="6" minlength="6" name="code"
                                                               class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none"
                                                               required="required"
                                                               oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                    <br/>

                                                    <div class="u-align-right u-form-group u-form-submit">
                                                        <a href="Logout.php" class="frpass">Logout</a>
                                                        <button type="submit"
                                                                class="u-active-palette-1-light-1 u-border-none u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-base u-radius u-btn-1">
                                                            Verify
                                                        </button>
                                                    </div>
                                                </form>


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
                            </h5><!--position-->
                            <div data-position="" class="u-position u-position-1"><!--block-->
                                <div class="u-block">
                                    <div class="u-block-container u-clearfix"><!--block_header-->
                                        <h5 class="u-block-header u-text"><!--block_header_content-->
                                            <!--/block_header_content--></h5><!--/block_header--><!--block_content-->
                                        <div class="u-block-content u-text"><!--block_content_content-->
                                            <!--/block_content_content--></div><!--/block_content-->
                                    </div>
                                </div><!--/block-->
                            </div><!--/position-->
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