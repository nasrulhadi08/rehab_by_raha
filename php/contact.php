<?php
header('Content-Type: application/json');
require_once '../includes/db_config.php';

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? sanitize($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize($_POST['phone']) : '';
    $subject = isset($_POST['subject']) ? sanitize($_POST['subject']) : '';
    $message = isset($_POST['message']) ? sanitize($_POST['message']) : '';
    
    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        $response['message'] = 'Name, email, and message are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Invalid email address.';
    } else {
        $stmt = $conn->prepare("INSERT INTO contact_inquiries (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);
            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = '✓ Message sent successfully! We will get back to you soon.';
            } else {
                $response['message'] = 'Error sending message. Please try again.';
            }
            $stmt->close();
        }
    }
}

echo json_encode($response);

function sanitize($input) {
    global $conn;
    return htmlspecialchars(stripslashes(trim($input)));
}
?>
