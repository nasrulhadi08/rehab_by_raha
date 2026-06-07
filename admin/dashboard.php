<?php
require_once 'auth.php';
admin_require_auth();

$flash = admin_get_flash();

function fetch_rows($sql) {
    global $conn;
    $result = $conn->query($sql);
    $rows = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    return $rows;
}

function fetch_count($sql) {
    global $conn;
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        return (int)$row['count'];
    }
    return 0;
}

$appointment_counts = [
    'total' => fetch_count("SELECT COUNT(*) AS count FROM appointments"),
    'pending' => fetch_count("SELECT COUNT(*) AS count FROM appointments WHERE status = 'pending'"),
    'confirmed' => fetch_count("SELECT COUNT(*) AS count FROM appointments WHERE status = 'confirmed'"),
    'completed' => fetch_count("SELECT COUNT(*) AS count FROM appointments WHERE status = 'completed'"),
    'cancelled' => fetch_count("SELECT COUNT(*) AS count FROM appointments WHERE status = 'cancelled'")
];

$inquiry_counts = [
    'total' => fetch_count("SELECT COUNT(*) AS count FROM contact_inquiries"),
    'new' => fetch_count("SELECT COUNT(*) AS count FROM contact_inquiries WHERE status = 'new'"),
    'read' => fetch_count("SELECT COUNT(*) AS count FROM contact_inquiries WHERE status = 'read'"),
    'replied' => fetch_count("SELECT COUNT(*) AS count FROM contact_inquiries WHERE status = 'replied'")
];

$testimonial_counts = [
    'total' => fetch_count("SELECT COUNT(*) AS count FROM testimonials"),
    'approved' => fetch_count("SELECT COUNT(*) AS count FROM testimonials WHERE status = 'approved'"),
    'pending' => fetch_count("SELECT COUNT(*) AS count FROM testimonials WHERE status = 'pending'"),
    'rejected' => fetch_count("SELECT COUNT(*) AS count FROM testimonials WHERE status = 'rejected'")
];

$service_count = fetch_count("SELECT COUNT(*) AS count FROM services");
$expert_count = fetch_count("SELECT COUNT(*) AS count FROM experts");

$appointments = fetch_rows("SELECT * FROM appointments ORDER BY created_at DESC LIMIT 20");
$inquiries = fetch_rows("SELECT * FROM contact_inquiries ORDER BY created_at DESC LIMIT 20");
$testimonials = fetch_rows("SELECT * FROM testimonials ORDER BY created_at DESC LIMIT 20");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Rehab By Raha</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-page">
    <nav class="navbar">
        <div class="navbar-container">
            <a href="../index.php" class="navbar-brand">
                <img src="../assets/images/RBR Logoooo.png" alt="RBR Logo">
                <span>Rehab By Raha Admin</span>
            </a>
            <div class="admin-top-actions">
                <span class="admin-user">Hello, <?php echo admin_escape($_SESSION['admin_username']); ?></span>
                <a href="logout.php" class="cta-button secondary">Logout</a>
            </div>
        </div>
    </nav>

    <main class="admin-panel">
        <?php if ($flash): ?>
            <div class="flash-message <?php echo $flash['type'] === 'success' ? 'flash-success' : 'flash-error'; ?>">
                <?php echo admin_escape($flash['message']); ?>
            </div>
        <?php endif; ?>

        <section class="admin-summary">
            <h1>Admin Dashboard</h1>
            <p>Manage appointments, contact messages, testimonials, and other database content from one place.</p>

            <div class="admin-stat-grid">
                <div class="admin-card">
                    <h3>Appointments</h3>
                    <p>Total: <?php echo $appointment_counts['total']; ?></p>
                    <p>Pending: <?php echo $appointment_counts['pending']; ?></p>
                    <p>Confirmed: <?php echo $appointment_counts['confirmed']; ?></p>
                    <p>Completed: <?php echo $appointment_counts['completed']; ?></p>
                </div>
                <div class="admin-card">
                    <h3>Contact Messages</h3>
                    <p>Total: <?php echo $inquiry_counts['total']; ?></p>
                    <p>New: <?php echo $inquiry_counts['new']; ?></p>
                    <p>Read: <?php echo $inquiry_counts['read']; ?></p>
                    <p>Replied: <?php echo $inquiry_counts['replied']; ?></p>
                </div>
                <div class="admin-card">
                    <h3>Testimonials</h3>
                    <p>Total: <?php echo $testimonial_counts['total']; ?></p>
                    <p>Approved: <?php echo $testimonial_counts['approved']; ?></p>
                    <p>Pending: <?php echo $testimonial_counts['pending']; ?></p>
                    <p>Rejected: <?php echo $testimonial_counts['rejected']; ?></p>
                </div>
                <div class="admin-card">
                    <h3>Site Content</h3>
                    <p>Services: <?php echo $service_count; ?></p>
                    <p>Experts: <?php echo $expert_count; ?></p>
                </div>
            </div>
        </section>

        <section class="admin-table-section">
            <h2>Appointments</h2>
            <div class="table-card">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Service</th>
                            <th>Date / Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($appointments) === 0): ?>
                            <tr><td colspan="8">No appointments yet.</td></tr>
                        <?php endif; ?>
                        <?php foreach ($appointments as $appointment): ?>
                            <tr>
                                <td><?php echo admin_escape($appointment['id']); ?></td>
                                <td><?php echo admin_escape($appointment['name']); ?></td>
                                <td><?php echo admin_escape($appointment['phone']); ?></td>
                                <td><?php echo admin_escape($appointment['email']); ?></td>
                                <td><?php echo admin_escape($appointment['service_type']); ?></td>
                                <td><?php echo admin_escape($appointment['preferred_date'] . ' ' . $appointment['preferred_time']); ?></td>
                                <td><?php echo admin_escape($appointment['status']); ?></td>
                                <td>
                                    <form method="post" action="actions.php" class="inline-form">
                                        <input type="hidden" name="action" value="update_appointment">
                                        <input type="hidden" name="id" value="<?php echo admin_escape($appointment['id']); ?>">
                                        <select name="status" class="select-small">
                                            <option value="pending" <?php echo $appointment['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                            <option value="confirmed" <?php echo $appointment['status'] === 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                            <option value="completed" <?php echo $appointment['status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
                                            <option value="cancelled" <?php echo $appointment['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn-small">Save</button>
                                    </form>
                                    <form method="post" action="actions.php" class="inline-form">
                                        <input type="hidden" name="action" value="delete_appointment">
                                        <input type="hidden" name="id" value="<?php echo admin_escape($appointment['id']); ?>">
                                        <button type="submit" class="btn-small danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="admin-table-section">
            <h2>Contact Messages</h2>
            <div class="table-card">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($inquiries) === 0): ?>
                            <tr><td colspan="7">No contact messages yet.</td></tr>
                        <?php endif; ?>
                        <?php foreach ($inquiries as $inquiry): ?>
                            <tr>
                                <td><?php echo admin_escape($inquiry['id']); ?></td>
                                <td><?php echo admin_escape($inquiry['name']); ?></td>
                                <td><?php echo admin_escape($inquiry['email']); ?></td>
                                <td><?php echo admin_escape($inquiry['phone']); ?></td>
                                <td><?php echo admin_escape($inquiry['subject']); ?></td>
                                <td><?php echo admin_escape($inquiry['status']); ?></td>
                                <td>
                                    <form method="post" action="actions.php" class="inline-form">
                                        <input type="hidden" name="action" value="update_inquiry">
                                        <input type="hidden" name="id" value="<?php echo admin_escape($inquiry['id']); ?>">
                                        <select name="status" class="select-small">
                                            <option value="new" <?php echo $inquiry['status'] === 'new' ? 'selected' : ''; ?>>New</option>
                                            <option value="read" <?php echo $inquiry['status'] === 'read' ? 'selected' : ''; ?>>Read</option>
                                            <option value="replied" <?php echo $inquiry['status'] === 'replied' ? 'selected' : ''; ?>>Replied</option>
                                        </select>
                                        <button type="submit" class="btn-small">Save</button>
                                    </form>
                                    <form method="post" action="actions.php" class="inline-form">
                                        <input type="hidden" name="action" value="delete_inquiry">
                                        <input type="hidden" name="id" value="<?php echo admin_escape($inquiry['id']); ?>">
                                        <button type="submit" class="btn-small danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="admin-table-section">
            <h2>Testimonials</h2>
            <div class="table-card">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Comment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($testimonials) === 0): ?>
                            <tr><td colspan="6">No testimonials yet.</td></tr>
                        <?php endif; ?>
                        <?php foreach ($testimonials as $testimonial): ?>
                            <tr>
                                <td><?php echo admin_escape($testimonial['id']); ?></td>
                                <td><?php echo admin_escape($testimonial['client_name']); ?></td>
                                <td><?php echo admin_escape($testimonial['rating']); ?>/5</td>
                                <td><?php echo admin_escape($testimonial['status']); ?></td>
                                <td><?php echo admin_escape($testimonial['comment']); ?></td>
                                <td>
                                    <form method="post" action="actions.php" class="inline-form">
                                        <input type="hidden" name="action" value="update_testimonial">
                                        <input type="hidden" name="id" value="<?php echo admin_escape($testimonial['id']); ?>">
                                        <select name="status" class="select-small">
                                            <option value="pending" <?php echo $testimonial['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                            <option value="approved" <?php echo $testimonial['status'] === 'approved' ? 'selected' : ''; ?>>Approved</option>
                                            <option value="rejected" <?php echo $testimonial['status'] === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                                        </select>
                                        <button type="submit" class="btn-small">Save</button>
                                    </form>
                                    <form method="post" action="actions.php" class="inline-form">
                                        <input type="hidden" name="action" value="delete_testimonial">
                                        <input type="hidden" name="id" value="<?php echo admin_escape($testimonial['id']); ?>">
                                        <button type="submit" class="btn-small danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
