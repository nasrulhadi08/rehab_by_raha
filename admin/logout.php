<?php
require_once 'auth.php';
admin_logout();
header('Location: index.php');
exit;
