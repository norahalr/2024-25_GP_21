<?php
$host = 'localhost';
$dbname = 'InnovationEngine';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database connection failed: " . $e->getMessage()]);
    exit;
}

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
        // Load initial project list
        $sql = "SELECT p.id, p.name, p.description, p.document, p.field, 
                       GROUP_CONCAT(DISTINCT t.name SEPARATOR ', ') AS technologies 
                FROM past_projects p
                LEFT JOIN projects_technology pt ON p.id = pt.project_id
                LEFT JOIN technologies t ON pt.technology_id = t.id
                GROUP BY p.id, p.name, p.description, p.document, p.field";
    } elseif ($searchCategory === "ProjectName" && !empty($query)) {
        // Search projects by name with priority for matches starting with the query
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
        $params[] = "$query%"; // Prioritize names starting with the query
    } elseif ($searchCategory === "SupervisorName" && !empty($query)) {
        // Search supervisors by name with priority for matches starting with the query
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
        $params[] = "$query%"; // Prioritize names starting with the query
    } elseif ($searchCategory === "Track" && !empty($track)) {
        // Search by track
        $sql = "SELECT name, email, interest, availability 
                FROM supervisors 
                WHERE track = ?";
        $params[] = $track;
    } elseif (!empty($field) || !empty($technology)) {
        // Filter projects by field and/or technology
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
        // Default: Fetch all supervisors
        $sql = "SELECT name, email, interest, availability FROM supervisors";
    }

    // Execute query
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return results as JSON
    echo json_encode($results);
} catch (PDOException $e) {
    // Return detailed error for debugging
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
    exit;
}
