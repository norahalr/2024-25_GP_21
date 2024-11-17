<?php
  ob_start();
  session_start();

  require_once 'config/connect.php';

  // Check if the session has a user ID; otherwise, redirect to login
  if (!isset($_SESSION['user_id'])) {
    echo "Error: User is not logged in.";
    header("Location: LogIn.php");

    exit();
}
$userEmail = $_SESSION['user_id'] ; // Get user ID from session

 

  // Fetch existing idea
  $stmt = $con->prepare("SELECT logo, draft_ideas FROM teams WHERE leader_email = :email");
  $stmt->bindParam(':email', $userEmail);
  $stmt->execute();
  $teamData = $stmt->fetch(PDO::FETCH_ASSOC);
  
  $existingIdea = $teamData['draft_ideas'] ?? '';
  $logoPath = $teamData['logo'] ?? 'images/7973420.png'; // Default logo

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['textarea'])) {
    $idea = $_POST['textarea'];


        // Update existing idea
        $updateStmt = $con->prepare("UPDATE teams SET draft_ideas = :idea WHERE leader_email = :email");
        $updateStmt->bindParam(':idea', $idea);
        $updateStmt->bindParam(':email', $userEmail);
        $updateStmt->execute();
        echo "Idea updated successfully.";
    

}
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['group_logo'])) {
    $file = $_FILES['group_logo'];
    
    if ($file['error'] == 0) {
        $maxFileSize = 2 * 1024 * 1024; // 2MB
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        
        if ($file['size'] > $maxFileSize) {
            echo "File size exceeds the 2MB limit.";
        } elseif (in_array($file['type'], $allowedTypes)) {
            $uploadDir = 'uploads/logos/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileNewName = uniqid('', true) . "_" . basename($file['name']);
            $fileDestination = $uploadDir . $fileNewName;

            if (move_uploaded_file($file['tmp_name'], $fileDestination)) {
                $stmt = $con->prepare("UPDATE teams SET logo = :logo WHERE leader_email = :email");
                $stmt->bindParam(':logo', $fileDestination);
                $stmt->bindParam(':email', $userEmail);

                if ($stmt->execute()) {
                    echo "Logo uploaded and saved!";
                } else {
                    echo "Database update failed.";
                }
            } else {
                echo "Failed to upload the file.";
            }
        } else {
            echo "Unsupported file type. Please upload JPG, JPEG, or PNG.";
        }
    } else {
        echo "Error during file upload.";
    }
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   try {
//       $con->beginTransaction();

//       // Loop through each student name input
//       foreach ($_POST as $key => $value) {
//           if (preg_match('/^name-(\d+)$/', $key, $matches)) {
//               $studentIndex = $matches[1];
//               $updatedName = $value;
//               $studentEmail = $_POST["email-$studentIndex"]; // Corresponding email for this student

//               if (filter_var($studentEmail, FILTER_VALIDATE_EMAIL)) { // Validate email
//                   // Update the student's name in the database
//                   $updateStudentStmt = $con->prepare("UPDATE students SET name = :name WHERE email = :email");
//                   $updateStudentStmt->execute(['name' => $updatedName, 'email' => $studentEmail]);
//               } else {
//                   throw new Exception("Invalid email provided for student index $studentIndex.");
//               }
//           }
//       }

//       $con->commit();
//       echo json_encode(['status' => 'success']);
//   } catch (Exception $e) {
//       $con->rollBack();
//       echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
//   }
//   exit;
// }







$leaderEmail = $userEmail; // Set this from the session or wherever the leader's email is stored

// Fetch leader information from the teams table
$leaderStmt = $con->prepare("SELECT name, leader_email, supervisor_email FROM teams WHERE leader_email = :email");
$leaderStmt->bindParam(':email', $leaderEmail);
$leaderStmt->execute();
$leader = $leaderStmt->fetch(PDO::FETCH_ASSOC);

$leaderName = $leader['name'];
$leaderEmail = $leader['leader_email'];

// Fetch students information from the students table (team_email matches leader's email)
$studentsStmt = $con->prepare("SELECT name, email FROM students WHERE team_email = :team_email");
$studentsStmt->bindParam(':team_email', $leaderEmail);
$studentsStmt->execute();
$students = $studentsStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch project details from team_idea_request table
$projectStmt = $con->prepare("SELECT project_name, description FROM team_idea_request WHERE team_email = :team_email AND status = 'accepted'");
$projectStmt->bindParam(':team_email', $leaderEmail);
$projectStmt->execute();
$project = $projectStmt->fetch(PDO::FETCH_ASSOC);

// Fetch supervisor name from supervisors table using supervisor_email
$supervisorStmt = $con->prepare("SELECT name FROM supervisors WHERE email = :supervisor_email");
$supervisorStmt->bindParam(':supervisor_email', $leader['supervisor_email']);
$supervisorStmt->execute();
$supervisor = $supervisorStmt->fetch(PDO::FETCH_ASSOC);










?>


<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Group Profile">
    <meta name="description" content="">
    <title>groupProfile</title>
    <link rel="stylesheet" href="nicepage2.css" media="screen">
<link rel="stylesheet" href="groupProfile.css" media="screen">
    <!-- <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script> -->
    <meta name="generator" content="Nicepage 6.19.6, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "Site1"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="groupProfile">
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
    <section class="u-align-center u-clearfix u-container-align-center u-white u-section-1" id="sec-df40">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h1 class="u-text u-text-custom-color-3 u-text-default u-text-1">Group Profile</h1>
        <div class="data-layout-selected u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
          <div class="u-layout" style="">
            <div class="u-layout-row" style="">
              <div class="u-align-center u-container-align-center u-container-style u-layout-cell u-left-cell u-palette-1-light-3 u-radius u-shape-round u-size-30 u-size-xs-60 u-layout-cell-1" src="">
                <div class="u-container-layout u-valign-top u-container-layout-1">
                  <div class="u-expanded-width u-form u-form-1">

                  <form id="ideaForm" action="StudentProfile.php" method="POST" class="u-clearfix u-form-spacing-15 u-form-vertical u-inner-form" style="padding: 15px;"  name="form"> 
    <div class="u-form-group u-form-textarea u-label-none u-form-group-1">
        <label for="textarea-0d3e" class="u-label">Idea: </label>
        <textarea rows="4" cols="50" id="textarea-0d3e" name="textarea" class="u-input u-input-rectangle" required placeholder="Write down your ideas to save them for you! (Draft)">
    <?= htmlspecialchars($existingIdea) ?>
</textarea>
         </div>
    <div class="u-align-right u-form-group u-form-submit">
    <button type="submit" class="u-btn u-btn-submit">Save</button>
    </div>
</form>
                  </div>
                </div>
              </div>
              <div class="u-align-center u-container-align-center u-container-style u-layout-cell u-radius u-right-cell u-shape-round u-size-30 u-size-xs-60 u-layout-cell-2">
              <?php
                $stmt = $con->prepare("SELECT logo FROM teams WHERE leader_email = :email");
                $stmt->bindParam(':email', $userEmail);
                $stmt->execute();
                
                // Set default logo path in case no logo is found
                $logoPath = 'images/7973420.png'; // Default logo image
                
                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!empty($row['logo'])) {
                        $logoPath = $row['logo'];
                    }
                }
                 ?>
    <div class="u-border-1 u-border-custom-color-3 u-container-layout u-valign-middle u-container-layout-2">
        <form action="StudentProfile.php" method="POST" enctype="multipart/form-data" style="display:inline;">
        <label class="u-border-1 u-border-active-custom-color-1 u-border-custom-color-3 u-border-hover-palette-1-light-2 u-border-no-left u-border-no-right u-border-no-top u-btn u-button-style u-none u-text-palette-1-base u-btn-2">
        <span class="u-file-icon u-icon u-icon-1">
            <img src="<?php echo $logoPath; ?>" alt="Group Logo" style="max-width: auto; max-height: auto;">
        </span>&nbsp;<br>Add Group Logo
        <input type="file" name="group_logo" style="display: none;" onchange="this.form.submit()">
    </label>
        </form>
    </div>
</div>

            </div>
          </div>
        </div>
        <div class="u-border-1 u-border-custom-color-3 u-container-style u-expanded-width u-group u-opacity u-opacity-80 u-radius u-shape-round u-white u-group-1">
          <div class="u-container-layout u-container-layout-3">
            <h3 class="u-text u-text-custom-color-3 u-text-default u-text-2">Group Information </h3>
            <div class="custom-expanded u-form u-form-2">


            <form id="studentForm" action="Edit_Student_Info.php" method="POST"class="u-clearfix u-form-spacing-30 u-form-vertical u-inner-form" source="email" name="form" style="padding: 15px;">
    <!-- Leader Name -->
    <div class="u-form-group u-form-name u-form-partition-factor-2 u-label-none u-form-group-3">
        <label for="name-8e541" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-2">Leader Name</label>
        <input type="text" placeholder="Leader name" id="name-8e541" name="name-1" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-2" required value="<?php echo htmlspecialchars($leaderName); ?>" readonly>
    </div>

    <!-- Leader Email -->
    <div class="u-form-group u-form-partition-factor-2 u-label-none u-form-group-4">
        <label for="email-c6a3" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-3">Email</label>
        <input type="text" placeholder="Leader email" id="email-c6a3" name="email-1" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-3" required="required" value="<?php echo htmlspecialchars($leaderEmail); ?>" readonly>
    </div>

    <?php foreach ($students as $index => $student): ?>
    <!-- Skip leader if already added -->
    <?php if ($student['email'] !== $leader['leader_email']): ?>
        <!-- Student Name -->
        <div class="u-form-group u-form-name u-form-partition-factor-2 u-label-none u-form-group-<?php echo $index + 5; ?>">
            <label for="name-<?php echo $index + 8; ?>" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-<?php echo $index + 4; ?>">Student Name</label>
            <input type="text" 
                   placeholder="Student name" 
                   id="name-<?php echo $index + 8; ?>" 
                   name="name-<?php echo $index + 1; ?>" 
                   class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-<?php echo $index + 4; ?>" 
                   required 
                   value="<?php echo htmlspecialchars($student['name']); ?>">
        </div>

        <!-- Student Email (Read-Only) -->
        <div class="u-form-group u-form-partition-factor-2 u-label-none u-form-group-<?php echo $index + 6; ?>">
            <label for="email-<?php echo $index + 8; ?>" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-<?php echo $index + 5; ?>">Student Email</label>
            <input type="text" 
                   placeholder="Student email" 
                   id="email-<?php echo $index + 8; ?>" 
                   name="email-<?php echo $index + 1; ?>" 
                   class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-<?php echo $index + 5; ?>" 
                   required 
                   value="<?php echo htmlspecialchars($student['email']); ?>" 
                   readonly>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

    <!-- Supervisor (Read-Only) -->
    <div class="u-form-group u-form-name u-form-partition-factor-2 u-label-none u-form-group-11">
        <label for="text-df08" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-10">Supervisor</label>
        <input type="text" placeholder="Current supervisor" id="text-df08" name="text" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-10" value="<?php echo htmlspecialchars($supervisor['name'] ?? ''); ?>" readonly>
    </div>

    <!-- Project Title (Read-Only) -->
    <div class="u-form-group u-label-none u-form-group-12">
        <label for="text-59cc" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-11">Project Title</label>
        <input type="text" placeholder="Project title" id="text-59cc" name="text-1" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-11" value="<?php echo htmlspecialchars($project['project_name'] ?? ''); ?>" readonly>
    </div>

    <!-- Project Idea (Read-Only) -->
    <div class="u-form-group u-form-textarea u-label-none u-form-group-13">
        <label for="textarea-a10a" class="u-custom-font u-font-georgia u-label u-spacing-0 u-label-12">Project Idea</label>
        <textarea rows="4" cols="50" id="textarea-a10a" name="textarea" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-base u-input u-input-rectangle u-palette-1-light-3 u-radius u-input-12" placeholder="A brief about your project" readonly><?php echo htmlspecialchars($project['description'] ?? ''); ?></textarea>
    </div>

    <!-- Edit Button -->
    <div class="u-align-right u-form-group u-form-submit u-label-none u-form-group-14">
    <!-- Edit Button -->
    <a href="#" class="u-active-palette-1-light-3 u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-1-light-2 u-palette-1-base u-radius u-btn-3" id="editBtn">Edit</a>

    <!-- Save Button (Hidden Initially) -->
    <button type="button" id="saveBtn" class="u-btn u-btn-submit u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-base u-radius u-btn-3" style="display:none;">Save</button>
</div>
</form>

<!-- JavaScript to Enable/Disable Fields -->
 <script>
console.log("JavaScript loaded");

document.addEventListener("DOMContentLoaded", function () {
    const studentForm = document.getElementById("studentForm");
    const editBtn = document.getElementById("editBtn");
    const saveBtn = document.getElementById("saveBtn");
    const nameInputs = studentForm.querySelectorAll('input[name^="name-"]');
    const emailInputs = studentForm.querySelectorAll('input[name^="email-"]');

    // When Edit button is clicked
    editBtn.addEventListener("click", function (event) {
        event.preventDefault();
        // Enable name inputs for editing
        nameInputs.forEach(input => input.removeAttribute("readonly"));
        // Make email inputs readonly
        emailInputs.forEach(input => input.setAttribute("readonly", "readonly"));
        
        // Show the Save button and change the Edit button to Save
        saveBtn.style.display = "block";  // Show Save button
        editBtn.style.display = "none";  // Hide Edit button
    });

    // When Save button is clicked, submit the form
    saveBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Create FormData object to collect form data
        const formData = new FormData(studentForm);
        console.log("Form data:", Array.from(formData.entries()));

        // Submit the form via AJAX (using fetch)
        fetch(studentForm.action, {
            method: "POST",
            body: formData
        })
        .then(response => response.ok ? alert("Student information updated successfully!") : alert("Error updating student information."))
        .catch(error => alert("Error: " + error.message));

        // Optionally hide the Save button and show the Edit button again after saving
        saveBtn.style.display = "none";  // Hide Save button
        editBtn.style.display = "block";  // Show Edit button again
    });

    // Handle the Idea Form (Draft Saving)
    const ideaForm = document.getElementById("ideaForm");
    ideaForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission
        alert("Idea saved successfully!");
    });
});

</script>

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
  
</body></html>