<?php
header('Content-Type: application/json');
require_once '../includes/db_config.php';

$response = ['status' => 'error', 'data' => null];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? sanitize($_GET['action']) : '';
    
    if ($action === 'get_experts') {
        $result = $conn->query("SELECT id, name, title, qualification, bio, photo_url, linkedin_url, instagram_url FROM experts ORDER BY id");
        $experts = [];
        while ($row = $result->fetch_assoc()) {
            $experts[] = $row;
        }
        $response['status'] = 'success';
        $response['data'] = $experts;
    }
    
    elseif ($action === 'get_expert' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM experts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $response['status'] = 'success';
            $response['data'] = $result->fetch_assoc();
        } else {
            $response['message'] = 'Expert not found.';
        }
        $stmt->close();
    }
    
    elseif ($action === 'get_services') {
        $result = $conn->query("SELECT id, name, description, icon FROM services ORDER BY id");
        $services = [];
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
        $response['status'] = 'success';
        $response['data'] = $services;
    }
}

echo json_encode($response);

function sanitize($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}
?>
