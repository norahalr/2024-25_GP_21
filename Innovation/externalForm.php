<?php
  require_once 'config/connect.php';
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Please if you are KSU faculty memberfeel free to share your interest​ with us">
    <meta name="description" content="">
    <title>externalForm</title>
    <link rel="stylesheet" href="nicepage2.css" media="screen">
    <link rel="stylesheet" href="externalForm.css" media="screen">
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
        "name": "Site1"
    }
    </script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="externalForm">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>

<body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en">
    <header class="u-clearfix u-header" id="sec-4e01">
        <div class="u-clearfix u-sheet u-sheet-1">
<?php include 'public_menu.php'; ?>
            <a href="#" class="u-image u-logo u-image-1" data-image-width="276" data-image-height="194">
                <img src="images/logo_GP-noname.png" class="u-logo-image u-logo-image-1">
            </a>
        </div>
    </header>
    <section class="u-clearfix u-palette-1-light-1 u-section-1" id="sec-4616">
        <div class="u-clearfix u-sheet u-sheet-1">
            <div
                class="u-expanded-height u-expanded-height-lg u-expanded-height-md u-expanded-height-xl u-opacity u-opacity-60 u-palette-1-base u-shape u-shape-rectangle u-shape-1">
            </div>
            <div
                class="u-align-left u-container-align-left u-container-style u-expanded-width u-group u-radius u-shape-round u-white u-group-1">
                <div class="u-container-layout u-valign-top u-container-layout-1">
                    <div class="custom-expanded data-layout-selected u-clearfix u-layout-wrap u-layout-wrap-1">
                        <div class="u-layout">
                            <div class="u-layout-row">
                                <div class="u-container-style u-layout-cell u-size-60 u-layout-cell-1"
                                    data-animation-name="customAnimationIn" data-animation-duration="1500"
                                    data-animation-delay="500">
                                    <div class="u-container-layout u-container-layout-2">
                                        <h1 class="u-align-left u-text u-text-custom-color-1 u-text-1">Please if you are
                                            KSU faculty member<br>feel free to share your interest​ with us
                                        </h1>

                                        <form action="externalForm.php" method="POST">

                                            <div
                                                class="u-container-style u-group u-opacity u-opacity-30 u-palette-1-light-2 u-radius u-shape-round u-group-2">
                                                <div class="u-container-layout u-container-layout-3">
                                                    <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['sname-1'];
    $email = $_POST['semail'];
    $college = $_POST['select'];
    $idea = $_POST['textarea'];
    $errors = [];
    $requestDate = date('Y-m-d');


    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!preg_match("/@ksu\.edu\.sa$/i", $email)) { // Add 'i' flag for case-insensitivity
        $errors[] = "Email must be from the domain @ksu.edu.sa";
    }
    if (empty($college)) {
        $errors[] = "College is required.";
    }
    if (empty($idea)) {
        $errors[] = "Idea description is required.";
    }

    if (empty($errors)) {
        $stmt = $con->prepare("INSERT INTO external_departments_requests (faculty_name, email, collage, idea_description, status, admin_email,request_date) VALUES (:name, :email, :college, :idea, 'Pending', '443200961@student.ksu.edu.sa',:request_date)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':college', $college);
        $stmt->bindParam(':idea', $idea);
        $stmt->bindParam(':request_date', $requestDate);

        if ($stmt->execute()) {
            echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>';
        } else {
            echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-error u-form-send-message"> Unable to send your message. Please try again later. </div>';
        }
    } else {
        foreach ($errors as $error) {
            echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-error u-form-send-message">' . htmlspecialchars($error) . '</div>';
        }
    }
}
?>
                                                    <div class="u-form u-form-1">
                                                        <form action="https://forms.nicepagesrv.com/v2/form/process"
                                                            class="u-clearfix u-form-spacing-28 u-form-vertical u-inner-form"
                                                            source="email" name="form" style="padding: 0px;">
                                                            <div class="u-form-group u-form-name u-form-group-1">
                                                                <label for="name-8e54"
                                                                    class="u-custom-font u-font-georgia u-label">Faculty
                                                                    member name <span
                                                                        style="color:red;">*</span></label>
                                                                <input type="text" placeholder="Enter your Full Name"
                                                                    id="name-8e54" name="sname-1"
                                                                    class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none"
                                                                    required="">
                                                            </div><br />
                                                            <div class="u-form-group u-form-group-2">
                                                                <label for="email-c6a3"
                                                                    class="u-custom-font u-font-georgia u-label">Email
                                                                    <span style="color:red;">*</span></label>
                                                                <input type="text"
                                                                    placeholder="Enter a valid email address"
                                                                    id="email-c6a3" name="semail"
                                                                    class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none"
                                                                    required="required" wfd-id="id114">
                                                            </div><br />
                                                            <div class="u-form-group u-form-select u-form-group-3">
                                                                <label for="select-6da1"
                                                                    class="u-custom-font u-font-georgia u-label">Which
                                                                    College Are you In? <span
                                                                        style="color:red;">*</span></label>
                                                                <div class="u-form-select-wrapper">
                                                                    <select required id="select-6da1" name="select"
                                                                        class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none">
                                                                        <option
                                                                            value="Faculty Of Education (كلية التربية)"
                                                                            data-calc="">Faculty Of Education (كلية
                                                                            التربية)</option>
                                                                        <option value="College Of Arts(كلية الفنون)"
                                                                            data-calc="">College Of Arts(كلية الفنون)
                                                                        </option>
                                                                        <option
                                                                            value="College Of Tourism &amp; Archeology (كلية السياحة و الآثار)"
                                                                            data-calc="">College Of Tourism &amp;
                                                                            Archeology (كلية السياحة و الآثار)</option>
                                                                        <option
                                                                            value="College Of Language &amp; Translation (كلية اللغات وعلومها)"
                                                                            data-calc="">College Of Language &amp;
                                                                            Translation (كلية اللغات وعلومها)</option>
                                                                        <option
                                                                            value="Faculty Of Law &amp; Political Science (كلية الحقوق و العلوم السياسية)"
                                                                            data-calc="">Faculty Of Law &amp; Political
                                                                            Science (كلية الحقوق و العلوم السياسية)
                                                                        </option>
                                                                        <option
                                                                            value="College Of Business Administration (كلية إدارة الأعمال)"
                                                                            data-calc="">College Of Business
                                                                            Administration (كلية إدارة الأعمال)</option>
                                                                        <option
                                                                            value="Collage Of Nursing (كلية التمريض)"
                                                                            data-calc="">Collage Of Nursing (كلية
                                                                            التمريض)</option>
                                                                        <option
                                                                            value="College Of Pharmacy (كلية الصيدلة)"
                                                                            data-calc="">College Of Pharmacy (كلية
                                                                            الصيدلة)</option>
                                                                        <option
                                                                            value="College Of Medicine (كلية الطب البشري)"
                                                                            data-calc="">College Of Medicine (كلية الطب
                                                                            البشري)</option>
                                                                        <option
                                                                            value="College Of Applied Medical Science (كلية العلوم الطبية التطبيقية)"
                                                                            data-calc="">College Of Applied Medical
                                                                            Science (كلية العلوم الطبية التطبيقية)
                                                                        </option>
                                                                        <option
                                                                            value="Faculty Of Dentistry (كلية طب الأسنان)"
                                                                            data-calc="">Faculty Of Dentistry (كلية طب
                                                                            الأسنان)</option>
                                                                        <option
                                                                            value="College Of Sciences (كلية العلوم)"
                                                                            data-calc="">College Of Sciences (كلية
                                                                            العلوم)</option>
                                                                        <option
                                                                            value="College Of Food &amp; Agriculture Sciences (كلية علوم الأغذية والزراعة)"
                                                                            data-calc="">College Of Food &amp;
                                                                            Agriculture Sciences (كلية علوم الأغذية
                                                                            والزراعة)</option>
                                                                        <option
                                                                            value="College of Sport Sciences and Physical Activity (كلية علوم الرياضة والنشاط البدني)"
                                                                            data-calc="">College of Sport Sciences and
                                                                            Physical Activity (كلية علوم الرياضة والنشاط
                                                                            البدني)</option>
                                                                    </select>
                                                                    <svg class="u-caret u-caret-svg" version="1.1"
                                                                        id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        x="0px" y="0px" width="16px" height="16px"
                                                                        viewBox="0 0 16 16" style="fill:currentColor;"
                                                                        xml:space="preserve">
                                                                        <polygon class="st0" points="8,12 2,4 14,4 ">
                                                                        </polygon>
                                                                    </svg>
                                                                </div>
                                                            </div><br />
                                                            <div class="u-form-group u-form-textarea u-form-group-4">
                                                                <label for="textarea-e86c"
                                                                    class="u-custom-font u-font-georgia u-label">Please
                                                                    Enter your idea here <span
                                                                        style="color:red;">*</span></label>
                                                                <textarea rows="4" cols="50" id="textarea-e86c"
                                                                    name="textarea"
                                                                    class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-light-1 u-input u-input-rectangle u-none"
                                                                    required="required" placeholder="Write down your idea"></textarea>
                                                            </div><br />
                                                            <div
                                                                class="u-align-center u-form-group u-form-submit u-form-group-5">
                                                                <a href="#"
                                                                    class="u-active-palette-1-light-3 u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-1-light-2 u-palette-1-base u-radius u-btn-1">Send</a>
                                                                <input type="submit" value="submit"
                                                                    class="u-form-control-hidden" wfd-id="id118">
                                                            </div><br />
                                                        </form>
                                                    </div>
                                                </div>
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