<?php 
require_once 'config/connect.php';
session_start();

// Validate required POST fields
if (!isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['interest'], $_POST['track'], $_POST['idea'])) {
    $_SESSION['message'] = "⚠️ Error: Missing required form fields.";
    header("Location: supervisorProfile.php");
    exit();
}

// Sanitize inputs
$name     = trim($_POST['name']);
$email    = trim($_POST['email']);
$phone    = trim($_POST['phone']);
$interest = trim($_POST['interest']);
$track    = trim($_POST['track']);

$idea     = trim($_POST['idea']);

error_log("IDEA raw content: " . $idea);
error_log("JSON payload: " . json_encode(["idea" => $idea]));

$idea = trim(strip_tags($_POST['idea']));  // remove HTML tags just in case
$idea = substr($idea, 0, 1000);   
$data = json_encode(["idea" => $idea]);


// === Fetch current idea from DB ===
$sqlCheck = "SELECT idea FROM supervisors WHERE email = :email";
$stmtCheck = $con->prepare($sqlCheck);
$stmtCheck->execute([':email' => $email]);
$current = $stmtCheck->fetch(PDO::FETCH_ASSOC);

$current_idea = trim($current['idea'] ?? '');

if ($current_idea !== $idea && !empty($idea)) {
    // === Semantic Search API ===
    $api_url = "https://app8800.pythonanywhere.com/check_duplicate";
    $data = json_encode(["idea" => $idea]);

    $options = [
        "http" => [
            "header"  => "Content-Type: application/json",
            "method"  => "POST",
            "content" => $data,
        ],
    ];

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_TIMEOUT, 35);
$result = curl_exec($ch);
$curlError = curl_error($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);



error_log("🔧 cURL result: " . $result);
error_log("🔧 cURL error: " . $curlError);
error_log("🔧 HTTP status code: " . $httpCode);

$response = json_decode($result, true);


    // Safety check for failed API or invalid response
    if (!$response || !isset($response['semantic_similarity']['similarity'])) {
        $_SESSION['message'] = "⚠️ Error: Could not connect to the semantic search server or invalid response received.";
        header("Location: supervisorProfile.php");
        exit();
    }

    // Extract similarity results
    $semantic_project = $response['semantic_similarity']['project_name'] ?? '';
    $semantic_score   = number_format($response['semantic_similarity']['similarity'] ?? 0, 2);

    // Block update if too similar
    if ($response['semantic_similarity']['similarity'] >= 0.7) {
        $_SESSION['message'] = "⚠️ Your idea is highly similar to an existing project ({$semantic_project}) with a similarity score of {$semantic_score}. Please modify your idea.";
        header("Location: supervisorProfile.php");
        exit();
    }
    $con = null;
require 'config/connect.php';
} else {
    error_log("✅ Skipped semantic check: idea not changed.");
}

// === Update Supervisor in DB ===
$sql = "UPDATE supervisors
        SET name = :name,
            phone_number = :phone,
            interest = :interest,
            track = :track,
            idea = :idea
        WHERE email = :email";

try {
    $stmt = $con->prepare($sql);
    $stmt->execute([
        ':name'     => $name,
        ':phone'    => $phone,
        ':interest' => $interest,
        ':track'    => $track,
        ':idea'     => $idea,
        ':email'    => $email,
    ]);

    $_SESSION['message'] = "✅ Profile updated successfully.";
    header("Location: supervisorProfile.php?do=success");
    exit();
} catch (PDOException $e) {
    $_SESSION['message'] = "⚠️ Database error: " . $e->getMessage();
    header("Location: supervisorProfile.php");
    exit();
}
?>
