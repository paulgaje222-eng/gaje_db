<?php
require_once __DIR__ . '/../database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    if ($name !== '') {
        $stmt = $conn->prepare("INSERT INTO customers (name, email, phone) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $name, $email, $phone);
        $stmt->execute();
        header('Location: ../orders/create.php'); exit;
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Add Customer</title><link rel="stylesheet" href="../style.css"></head>
<body>
<h1 class="animate-letters">Add Customer</h1>
<form method="post">
    <label>Name</label>
    <input type="text" name="name" required>
    <label>Email</label>
    <input type="text" name="email">
    <label>Phone</label>
    <input type="text" name="phone">
    <button type="submit">Create</button>
    <a href="../index.php">Back</a>
</form>
<script src="/letters.js"></script>
</body></html>
