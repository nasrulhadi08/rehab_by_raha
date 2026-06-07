<?php
header('Content-Type: application/json');
require_once '../includes/db_config.php';

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? sanitize($_POST['action']) : '';
    
    if ($action === 'add_review') {
        $client_name = isset($_POST['client_name']) ? sanitize($_POST['client_name']) : '';
        $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 5;
        $comment = isset($_POST['comment']) ? sanitize($_POST['comment']) : '';
        
        // Validation
        if (empty($client_name) || empty($comment)) {
            $response['message'] = 'Name and comment are required.';
        } elseif ($rating < 1 || $rating > 5) {
            $response['message'] = 'Rating must be between 1 and 5.';
        } else {
            $photo_url = '';
            
            // Handle file upload if present
            if (isset($_FILES['photo']) && $_FILES['photo']['size'] > 0) {
                $upload_dir = '../assets/images/reviews/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $file_ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                
                if (in_array($file_ext, $allowed) && $_FILES['photo']['size'] <= 5000000) {
                    $filename = 'review_' . time() . '_' . uniqid() . '.' . $file_ext;
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir . $filename)) {
                        $photo_url = 'assets/images/reviews/' . $filename;
                    }
                }
            }
            
            $stmt = $conn->prepare("INSERT INTO testimonials (client_name, rating, comment, photo_url, status) VALUES (?, ?, ?, ?, 'approved')");
            if ($stmt) {
                $stmt->bind_param("siss", $client_name, $rating, $comment, $photo_url);
                if ($stmt->execute()) {
                    $response['status'] = 'success';
                    $response['message'] = '✓ Thank you! Your review has been added successfully.';
                    $response['testimonial_id'] = $conn->insert_id;
                } else {
                    $response['message'] = 'Error adding review. Please try again.';
                }
                $stmt->close();
            }
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? sanitize($_GET['action']) : '';
    
    if ($action === 'get_testimonials') {
        $result = $conn->query("SELECT * FROM testimonials WHERE status = 'approved' ORDER BY created_at DESC");
        $testimonials = [];
        while ($row = $result->fetch_assoc()) {
            $testimonials[] = $row;
        }
        $response['status'] = 'success';
        $response['data'] = $testimonials;
    }
}

echo json_encode($response);

function sanitize($input) {
    global $conn;
    return htmlspecialchars(stripslashes(trim($input)));
}
?>
