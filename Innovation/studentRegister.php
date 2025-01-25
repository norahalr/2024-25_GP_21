<?php
require_once 'config/connect.php';
session_start();
ob_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['type'];
    $errors = [];

    if ($role == "leader") {
        // Leader-specific fields
        $num_students = $_POST['num-students'];
        $leader_name = $_POST['leader-name'];
        $leader_email = $_POST['leader-email'];
        $password = $_POST['password'];
        $reenter_password = $_POST['re-enter-password'];
        $student_names = [];
        $student_emails = [];

        // Collecting additional students' information
        for ($i = 1; $i <= $num_students - 1; $i++) {
            $student_names[] = $_POST['student-name-' . $i];
            $student_emails[] = $_POST['student-email-' . $i];
        }

        // Validation
        if (empty($num_students) || $num_students < 2 || $num_students > 5) {
            $errors[] = "Group size must be between 2 and 5.";
        }
        if (empty($leader_name) || !preg_match("/^[A-Za-z]+\s[A-Za-z]+$/", $leader_name)) {
            $errors[] = "Leader name must be in 'First Last' format.";
        }
        if (empty($leader_email) || !filter_var($leader_email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "A valid leader email is required.";
        }
        if (empty($password) || !preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
            $errors[] = "Password must be at least 8 characters long, contain uppercase, lowercase, a number, and a special character.";
        }
        if ($password !== $reenter_password) {
            $errors[] = "Password confirmation does not match.";
        }
        foreach ($student_names as $index => $student_name) {
            if (empty($student_name) || !preg_match("/^[A-Za-z]+\s[A-Za-z]+$/", $student_name)) {
                $errors[] = "Student name " . ($index + 1) . " must be in 'First Last' format.";
            }
        }
        foreach ($student_emails as $index => $student_email) {
            if (empty($student_email) || !preg_match("/@student\.ksu\.edu\.sa$/", $student_email)) {
                $errors[] = "Student email " . ($index + 1) . " must be from the domain @student.ksu.edu.sa.";
            }
        }

        if (empty($errors)) {
            try {
                $con->beginTransaction();
                
                // Insert leader into teams table
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $con->prepare("INSERT INTO teams (leader_email, name, password) VALUES (:email, :name, :password)");
                $stmt->bindParam(':email', $leader_email);
                $stmt->bindParam(':name', $leader_name);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->execute();

                // Example default password (hashed using bcrypt)
                
                // Insert leader into the 'students' table
                $team_email = $leader_email;
                $stmt = $con->prepare("INSERT INTO students (name, email, team_email, password, Registration_status) 
                                       VALUES (:name, :email, :team_email, :password, 1)");
                $stmt->bindParam(':name', $leader_name);
                $stmt->bindParam(':email', $leader_email);
                $stmt->bindParam(':team_email', $team_email);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->execute();
                
                // Insert students into the 'students' table
                for ($i = 0; $i < count($student_names); $i++) {
                    $default_password = password_hash('default_password', PASSWORD_BCRYPT);

                    $stmt = $con->prepare("INSERT INTO students (name, email, team_email, password, Registration_status) 
                                           VALUES (:name, :email, :team_email, :password, 0)");
                    $stmt->bindParam(':name', $student_names[$i]);
                    $stmt->bindParam(':email', $student_emails[$i]);
                    $stmt->bindParam(':team_email', $team_email);
                    $stmt->bindParam(':password', $default_password);
                    $stmt->execute();
                }
                

                $con->commit();

                // Set session and redirect
                session_start();
                $_SESSION['user_id'] = $leader_email;
                setcookie('leader_email', $leader_email, time() + 3600, "/");
                header("Location: ResearchInterests.php");
                exit();
            } catch (PDOException $e) {
                $con->rollBack();
                $errors[] = "Database error: " . $e->getMessage();
            }
        }
    } } elseif ($role == "member") {
        $member_name = $_POST['member-name'];
        $member_email = $_POST['member-email'];
        $leader_email = $_POST['leader-email'];
        $password = $_POST['password'];
        $reenter_password = $_POST['re-enter-password'];
    
        // Validate inputs
        if (empty($member_name) || !preg_match("/^[A-Za-z\s]+$/", $member_name)) {
            $errors[] = "Please enter a valid name.";
        }
        if (empty($member_email) || !filter_var($member_email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email.";
        }
        if (empty($leader_email) || !filter_var($leader_email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid leader email.";
        }
        if ($password !== $reenter_password) {
            $errors[] = "Passwords do not match.";
        }
    
        // Check for errors
        if (empty($errors)) {
            try {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
                $stmt = $con->prepare("INSERT INTO students (name, email, team_email, Password) VALUES (:name, :email, :team_email, :password)");
                $stmt->bindParam(':name', $member_name);
                $stmt->bindParam(':email', $member_email);
                $stmt->bindParam(':team_email', $leader_email);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->execute();
    
                 // Set session and redirect
                 session_start();
                 $_SESSION['user_id'] = $member_email;
                 setcookie('leader_email', $member_email, time() + 3600, "/");
                 header("Location: ResearchInterests.php");
                 exit();
            } catch (PDOException $e) {
                $errors[] = "Database error: " . $e->getMessage();
            }
        }
    }
    // Display errors
    foreach ($errors as $error) {
        echo '<div style="margin-top:5px;padding:5px;border-radius:10px;" class="u-form-send-error u-form-send-message">' . htmlspecialchars($error) . '</div>';
    }

