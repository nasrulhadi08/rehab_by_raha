<?php
header('Content-Type: application/json');
require_once '../includes/db_config.php';

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? sanitize($_POST['action']) : '';
    
    if ($action === 'book_appointment') {
        $name = isset($_POST['name']) ? sanitize($_POST['name']) : '';
        $phone = isset($_POST['phone']) ? sanitize($_POST['phone']) : '';
        $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
        $preferred_date = isset($_POST['preferred_date']) ? sanitize($_POST['preferred_date']) : '';
        $preferred_time = isset($_POST['preferred_time']) ? sanitize($_POST['preferred_time']) : '';
        $service_type = isset($_POST['service_type']) ? sanitize($_POST['service_type']) : '';
        $message = isset($_POST['message']) ? sanitize($_POST['message']) : '';
        
        // Validation
        if (empty($name) || empty($phone)) {
            $response['message'] = 'Name and phone number are required.';
        } elseif (!preg_match('/^[0-9]{10,15}$/', $phone)) {
            $response['message'] = 'Invalid phone number format.';
        } else {
            $stmt = $conn->prepare("INSERT INTO appointments (name, phone, email, preferred_date, preferred_time, service_type, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sssssss", $name, $phone, $email, $preferred_date, $preferred_time, $service_type, $message);
                if ($stmt->execute()) {
                    $response['status'] = 'success';
                    $response['message'] = '✓ Appointment booked successfully! We will contact you soon.';
                    $response['appointment_id'] = $conn->insert_id;
                } else {
                    $response['message'] = 'Error booking appointment. Please try again.';
                }
                $stmt->close();
            }
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? sanitize($_GET['action']) : '';
    
    if ($action === 'get_appointments') {
        $result = $conn->query("SELECT * FROM appointments WHERE status = 'approved' ORDER BY created_at DESC LIMIT 10");
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        $response['status'] = 'success';
        $response['data'] = $appointments;
    }
}

echo json_encode($response);

function sanitize($input) {
    global $conn;
    return htmlspecialchars(stripslashes(trim($input)));
}
?>
