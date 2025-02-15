<?php 
require_once 'config/connect.php';
session_start();

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$interest = $_POST['interest'];
$track = $_POST['track'];
$idea = trim($_POST['idea']); // Trim any unnecessary spaces

// Call Python API for semantic search
$api_url = "http://127.0.0.1:5000/check_duplicate";  
$data = json_encode(["idea" => $idea]);

$options = [
    "http" => [
        "header"  => "Content-Type: application/json",
        "method"  => "POST",
        "content" => $data,
    ],
];

$context = stream_context_create($options);
$result = file_get_contents($api_url, false, $context);
$response = json_decode($result, true);

// Extract similarity results
$similarity_score = $response['semantic_similarity']['similarity'] ?? 0;
$similar_project = $response['semantic_similarity']['project_name'] ?? '';

// If a similar idea exists with a high similarity score
if ($similarity_score >= 0.7) {
    $_SESSION['message'] = "⚠️ Your idea is highly similar to an existing project ('{$similar_project}') with a similarity score of {$similarity_score}. Please modify your idea.";
    header("Location: supervisorProfile.php");
    exit();
}

// If no similar idea is found, proceed with updating the supervisor's details
$sql = "UPDATE supervisors
        SET 
            name = :name,
            phone_number = :phone,
            interest = :interest,
            track = :track,
            idea = :idea
        WHERE email = :email";

$stmt = $con->prepare($sql);

try {
    $stmt->execute([
        ':name' => $name,
        ':phone' => $phone,
        ':interest' => $interest,
        ':track' => $track,
        ':idea' => $idea,
        ':email' => $email,
    ]);
    $_SESSION['message'] = "✅ Profile updated successfully.";
    header("Location: supervisorProfile.php?do=success");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
