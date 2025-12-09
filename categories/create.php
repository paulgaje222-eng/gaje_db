<?php
require_once __DIR__ . '/../database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    if ($name !== '') {
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        header('Location: list.php'); exit;
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Add Category</title><link rel="stylesheet" href="../style.css"></head>
<body>
<h1 class="animate-letters">Add Category</h1>
<form method="post">
    <label>Name</label>
    <input type="text" name="name" required>
    <button type="submit">Create</button>
    <a href="list.php">Back</a>
</form>
<script src="/letters.js"></script>
</body></html>
