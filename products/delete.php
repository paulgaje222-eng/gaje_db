<?php
require_once __DIR__ . '/../database.php';
$id = intval($_GET['id'] ?? 0);
if ($id) {
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
}
header('Location: ../index.php'); exit;
