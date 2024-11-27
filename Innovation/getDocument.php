<?php
require_once 'config/connect.php';

if (isset($_GET['project_id'])) {
    $projectId = intval($_GET['project_id']);
    try {
        $stmt = $con->prepare("SELECT document FROM past_projects WHERE id = ?");
        $stmt->execute([$projectId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode(['success' => true, 'documentUrl' => $result['document']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Document not found.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}