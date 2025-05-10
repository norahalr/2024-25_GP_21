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
?>



<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Supervisor Profile">
    <meta name="description" content="">
    <title>supervisorProfile</title>
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
    <meta property="og:title" content="supervisorProfile">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>

<body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en">
    <header class="u-clearfix u-header" id="sec-4e01">
        <div class="u-clearfix u-sheet u-sheet-1">
            <?php 
$hasUpdates = true; // or false based on badge logic
include 'supervisor_menu.php'; ?>
            <a href="#" class="u-image u-logo u-image-1" data-image-width="276" data-image-height="194">
                <img src="images/logo_GP-noname.png" class="u-logo-image u-logo-image-1">
            </a>
        </div>
    </header>
    <section class="u-align-center u-clearfix u-container-align-center u-white u-section-1" id="sec-55fc">
        <div class="u-clearfix u-sheet u-sheet-1">
            <h1 class="u-text u-text-custom-color-3 u-text-default u-text-1">Supervisor Profile</h1>
            <div class="data-layout-selected u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
                <div class="u-layout" style="">
                    <div class="u-layout-row" style="">
                        <div class="u-align-center u-container-align-center u-container-style u-layout-cell u-left-cell u-palette-1-light-3 u-radius u-shape-round u-size-60 u-size-xs-60 u-layout-cell-1"
                            src="">
                            <div class="u-container-layout u-container-layout-1">
                                

                                <div
                                    class="custom-expanded u-border-1 u-border-custom-color-3 u-container-style u-group u-opacity u-opacity-80 u-radius u-shape-round u-white u-group-1">
                                    <div class="u-container-layout u-container-layout-2">
                                        <div class="u-expanded-width u-form u-form-1">
                                            <form action="edit.php" method="POST" style="padding: 15px;">



                                                <div class="u-form-group u-label-left u-form-group-1">

                                                    <input value="<?php echo $name; ?>"
                                                        type="hidden" id="text-6c71" name="name"
                                                        class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-1"
                                                        required="required">
                                                </div>
                                                <div class="u-form-group u-label-left u-form-group-2">
                                                    <input value="<?php echo $email; ?>" style="cursor: no-drop;"
                                                        type="hidden" id="text-2b5a" name="email"
                                                        class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-2"
                                                        required="required">
                                                </div>



                                                <div style="margin-top:30px;"
                                                    class="u-form-group u-label-left u-form-group-1">
                                                    <label for="text-6c71"
                                                        class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-1">Doctor
                                                        name</label>
                                                    <input value="<?php echo $name; ?>" 
                                                         type="text" id="text-6c71" name="name"
                                                        class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-1"
                                                        required="required">
                                                </div>
                                                <div style="margin-top:30px;"
                                                    class="u-form-group u-label-left u-form-group-2">
                                                    <label for="text-2b5a"
                                                        class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-2">Email</label>
                                                    <input value="<?php echo $email; ?>" disabled
                                                        style="cursor: no-drop;" type="text" id="text-2b5a" name="xxx"
                                                        class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-2"
                                                        required="required">
                                                </div>

                                                <div style="margin-top:30px;"
                                                    class="u-form-group u-label-left u-form-group-3">
                                                    <label for="text-e112"
                                                        class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-3">Phone
                                                        number</label>
                                                    <input value="<?php echo $phone; ?>" type="number" placeholder=""
                                                        id="text-e112" name="phone"
                                                        class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-3"
                                                        >
                                                </div>
                                                <div style="margin-top:30px;"
                                                    class="u-form-group u-form-select u-label-left u-form-group-4">
                                                    <label for="select-b69f"
                                                        class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-4">Which
                                                        track are you more interested in?</label>
                                                    <div class="u-form-select-wrapper">
                                                        <select id="select-b69f" name="track"
                                                            class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-4">

                                                            <option value="<?php echo $track; ?>" selected>
                                                                <?php echo $track; ?>
                                                            </option>

                                                            <?php
                                                                  $options = ['Artificial Intelligence', 'Cybersecurity', 'Internet of Things'];
                                                                  foreach ($options as $option) {
                                                                      if ($option !== $track) {
                                                                          echo "<option value=\"$option\">$option</option>";
                                                                      }
                                                                  }
                                                              ?>
                                                        </select>
                                                        <svg class="u-caret u-caret-svg" version="1.1" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                            width="16px" height="16px" viewBox="0 0 16 16"
                                                            style="fill:currentColor;" xml:space="preserve">
                                                            <polygon class="st0" points="8,12 2,4 14,4 "></polygon>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div style="margin-top:30px;"
                                                    class="u-form-group u-form-textarea u-label-left u-form-group-5">
                                                    <label for="textarea-a10a"
                                                        class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-5">Interest</label>
                                                    <textarea rows="4" cols="50" id="textarea-a10a" name="interest"
                                                        class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-5"
                                                        required=""
                                                        placeholder="Please enter your interest about GP projects"><?php echo $interest; ?></textarea>
                                                </div>
                                                <div style="margin-top:30px;"
                                                    class="u-form-group u-form-textarea u-label-left u-form-group-6">
                                                    <label for="textarea-6d9e"
                                                        class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-6">Idea</label>
                                                    <textarea rows="4" cols="50" id="textarea-6d9e" name="idea"
                                                        class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-6"
                                                        placeholder="Write down your idea if you have specific one"><?php echo $idea; ?></textarea>
                                                </div>
                                                <button style="margin-top:30px;" type="submit"
                                                    class="u-active-palette-1-light-3 u-button-style u-hover-palette-1-light-2 u-palette-1-base u-radius u-btn-1">Edit
                                                </button>
                                            </form>
                                        </div>



                                    </div>
                                </div>


                                
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
