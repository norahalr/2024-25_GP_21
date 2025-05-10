<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);  // Show errors on screen

$servername = "localhost";
$username = "u253034616_root";
$password = "INNOVATION@engine2025";  // Default MAMP password
$db = "u253034616_innovation";

try {
    $con = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // If connection is successful

    if (isset($_SESSION['user_id'])) {
        $type = $_SESSION['user_type'];
        $email = $_SESSION['user_id'];
        if ($type == 'supervisor') {
            $stmt = $con->prepare("SELECT * FROM supervisors WHERE email = :email && verified = 0");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        } else {
            $stmt = $con->prepare("SELECT * FROM students WHERE email = :email && verified = 0");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            header('location: user_verify.php');
        }
    }


} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage(); // Display the error message
}


?>
