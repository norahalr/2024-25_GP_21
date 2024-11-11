<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);  // Show errors on screen

$servername = "localhost";
$username = "root";
$password = "root";  // Default MAMP password
$db = "InnovationEngine";

try {
    $con = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; // If connection is successful
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage(); // Display the error message
}
?>
