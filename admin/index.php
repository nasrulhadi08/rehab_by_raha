<?php
require_once 'auth.php';

$error = '';
if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } elseif (admin_login($username, $password)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid credentials. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Rehab By Raha</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-page">
    <nav class="navbar">
        <div class="navbar-container">
            <a href="../index.php" class="navbar-brand">
                <img src="../assets/images/RBR Logoooo.png" alt="RBR Logo">
                <span>Rehab By Raha</span>
            </a>
        </div>
    </nav>

    <main class="admin-panel">
        <section class="admin-card login-card">
            <h2>Admin Panel Login</h2>
            <p>Use the default credentials to enter the admin dashboard.</p>
            <?php if (!empty($error)): ?>
                <div class="flash-message flash-error"><?php echo admin_escape($error); ?></div>
            <?php endif; ?>
            <form method="post" class="admin-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="admin" value="<?php echo isset($username) ? admin_escape($username) : 'admin'; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="password" required>
                </div>
                <button type="submit" class="form-submit">Sign In</button>
            </form>
            <div class="admin-note">
                <strong>Default admin:</strong> admin / password
            </div>
        </section>
    </main>
</body>
</html>
