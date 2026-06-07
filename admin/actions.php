<?php
require_once 'auth.php';
admin_require_auth();

$allowedAppointmentStatus = ['pending', 'confirmed', 'completed', 'cancelled'];
$allowedInquiryStatus = ['new', 'read', 'replied'];
$allowedTestimonialStatus = ['pending', 'approved', 'rejected'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($action === 'update_appointment') {
        $status = isset($_POST['status']) ? trim($_POST['status']) : '';
        if ($id > 0 && in_array($status, $allowedAppointmentStatus, true)) {
            $stmt = $conn->prepare("UPDATE appointments SET status = ? WHERE id = ?");
            $stmt->bind_param('si', $status, $id);
            $stmt->execute();
            $stmt->close();
            admin_set_flash('Appointment status updated successfully.');
        }
    } elseif ($action === 'delete_appointment') {
        if ($id > 0) {
            $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
            admin_set_flash('Appointment deleted successfully.');
        }
    } elseif ($action === 'update_inquiry') {
        $status = isset($_POST['status']) ? trim($_POST['status']) : '';
        if ($id > 0 && in_array($status, $allowedInquiryStatus, true)) {
            $stmt = $conn->prepare("UPDATE contact_inquiries SET status = ? WHERE id = ?");
            $stmt->bind_param('si', $status, $id);
            $stmt->execute();
            $stmt->close();
            admin_set_flash('Contact message status updated successfully.');
        }
    } elseif ($action === 'delete_inquiry') {
        if ($id > 0) {
            $stmt = $conn->prepare("DELETE FROM contact_inquiries WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
            admin_set_flash('Contact message deleted successfully.');
        }
    } elseif ($action === 'update_testimonial') {
        $status = isset($_POST['status']) ? trim($_POST['status']) : '';
        if ($id > 0 && in_array($status, $allowedTestimonialStatus, true)) {
            $stmt = $conn->prepare("UPDATE testimonials SET status = ? WHERE id = ?");
            $stmt->bind_param('si', $status, $id);
            $stmt->execute();
            $stmt->close();
            admin_set_flash('Testimonial status updated successfully.');
        }
    } elseif ($action === 'delete_testimonial') {
        if ($id > 0) {
            $stmt = $conn->prepare("DELETE FROM testimonials WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
            admin_set_flash('Testimonial deleted successfully.');
        }
    }
}

header('Location: dashboard.php');
exit;
