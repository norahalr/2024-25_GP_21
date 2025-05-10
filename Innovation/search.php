<?php
header('Content-Type: application/json');
require_once 'config/connect.php';  // الاتصال جاهز هنا باسم $con

// Retrieve search parameters
$searchCategory = $_POST['search_category'] ?? '';
$query = $_POST['query'] ?? '';
$track = $_POST['track'] ?? '';
$field = $_POST['field'] ?? '';
$technology = $_POST['technology'] ?? '';
$initialProjects = isset($_POST['initial_projects']) && $_POST['initial_projects'] == 'true';

$params = [];
$sql = "";

try {
    if ($initialProjects) {
        $sql = "SELECT p.id, p.name, p.description, p.document, p.field, 
                       GROUP_CONCAT(DISTINCT t.name SEPARATOR ', ') AS technologies 
                FROM past_projects p
                LEFT JOIN projects_technology pt ON p.id = pt.project_id
                LEFT JOIN technologies t ON pt.technology_id = t.id
                GROUP BY p.id, p.name, p.description, p.document, p.field";
    } elseif ($searchCategory === "ProjectName" && !empty($query)) {
        $sql = "SELECT p.id, p.name, p.description, p.document, p.field, 
                       GROUP_CONCAT(DISTINCT t.name SEPARATOR ', ') AS technologies 
                FROM past_projects p
                LEFT JOIN projects_technology pt ON p.id = pt.project_id
                LEFT JOIN technologies t ON pt.technology_id = t.id
                WHERE p.name LIKE ?
                GROUP BY p.id, p.name, p.description, p.document, p.field
                ORDER BY 
                    CASE 
                        WHEN p.name LIKE ? THEN 1 
                        ELSE 2 
                    END, 
                    p.name ASC";
        $params[] = "%$query%";
        $params[] = "$query%";
    } elseif ($searchCategory === "SupervisorName" && !empty($query)) {
        $sql = "SELECT name, email, interest, availability 
                FROM supervisors 
                WHERE name LIKE ?
                ORDER BY 
                    CASE 
                        WHEN name LIKE ? THEN 1 
                        ELSE 2 
                    END, 
                    name ASC";
        $params[] = "%$query%";
        $params[] = "$query%";
    } elseif ($searchCategory === "Track" && !empty($track)) {
        $sql = "SELECT name, email, interest, availability 
                FROM supervisors 
                WHERE track = ?";
        $params[] = $track;
    } elseif (!empty($field) || !empty($technology)) {
        $sql = "SELECT p.id, p.name, p.description, p.document, p.field, 
                       GROUP_CONCAT(DISTINCT t.name SEPARATOR ', ') AS technologies 
                FROM past_projects p
                LEFT JOIN projects_technology pt ON p.id = pt.project_id
                LEFT JOIN technologies t ON pt.technology_id = t.id
                WHERE 1=1";

        if (!empty($field)) {
            $sql .= " AND p.field = ?";
            $params[] = $field;
        }
        if (!empty($technology)) {
            $sql .= " AND t.name = ?";
            $params[] = $technology;
        }
        $sql .= " GROUP BY p.id, p.name, p.description, p.document, p.field";
    } else {
        $sql = "SELECT name, email, interest, availability FROM supervisors";
    }

    // Execute query
    $stmt = $con->prepare($sql);  // هنا استخدمي $con
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($results);
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
    exit;
}
?>
