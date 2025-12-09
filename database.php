<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'gaje_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

function e($v) {
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}
