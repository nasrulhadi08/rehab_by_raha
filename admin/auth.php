<?php
session_start();
require_once __DIR__ . '/../includes/db_config.php';

function admin_require_auth() {
    if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php');
        exit;
    }
}

function admin_login($username, $password) {
    global $conn;

    $stmt = $conn->prepare("SELECT id, password_hash FROM admin_users WHERE username = ? LIMIT 1");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user_id'] = $row['id'];
            $_SESSION['admin_username'] = $username;
            $stmt->close();
            return true;
        }
    }
    $stmt->close();
    return false;
}

function admin_logout() {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
    }
    session_destroy();
}

function admin_set_flash($message, $type = 'success') {
    $_SESSION['admin_flash'] = [
        'message' => $message,
        'type' => $type,
    ];
}

function admin_get_flash() {
    if (!empty($_SESSION['admin_flash'])) {
        $flash = $_SESSION['admin_flash'];
        unset($_SESSION['admin_flash']);
        return $flash;
    }
    return null;
}

function admin_escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
