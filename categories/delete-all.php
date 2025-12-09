<?php
require_once __DIR__ . '/../database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete all order items first (FK constraint)
    $conn->query("DELETE FROM order_items");
    // Delete all orders
    $conn->query("DELETE FROM orders");
    // Delete all products
    $conn->query("DELETE FROM products");
    // Delete all categories
    $conn->query("DELETE FROM categories");
    header('Location: list.php'); exit;
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Delete All</title><link rel="stylesheet" href="../style.css"></head>
<body>
<h1 class="animate-letters">Delete All Data</h1>
<p style="color:red;font-weight:bold;">⚠️ This will permanently delete ALL categories, products, orders, and order items!</p>
<form method="post" style="max-width:600px;">
    <p>Are you sure? This action cannot be undone.</p>
    <button type="submit" style="background:linear-gradient(90deg,#ef4444,#dc2626);margin-right:8px;">Confirm Delete All</button>
    <a href="list.php" class="btn" style="display:inline-block;background:linear-gradient(90deg,#6b7280,#4b5563);">Cancel</a>
</form>
<script src="/letters.js"></script>
</body></html>
