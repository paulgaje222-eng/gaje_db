<?php
require_once __DIR__ . '/../database.php';
// fetch categories (categories table uses categories_id as PK)
$cats = $conn->query("SELECT categories_id AS id, name FROM categories ORDER BY name");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $category_id = $_POST['category_id'] ?: null;
    $stmt = $conn->prepare("INSERT INTO products (name, price, category_id) VALUES (?, ?, ?)");
    $stmt->bind_param('sdi', $name, $price, $category_id);
    $stmt->execute();
    header('Location: ../index.php'); exit;
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Add Product</title><link rel="stylesheet" href="../style.css"></head>
<body>
<h1 class="animate-letters">Add Product</h1>
<form method="post">
    <label>Name</label>
    <input type="text" name="name" required>
    <label>Price</label>
    <input type="number" step="0.01" name="price" required>
    <label>Category</label>
    <select name="category_id">
        <option value="">-- None --</option>
        <?php while ($c = $cats->fetch_assoc()): ?>
            <option value="<?php echo $c['id']; ?>"><?php echo e($c['name']); ?></option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Create</button>
    <a href="../index.php">Back</a>
</form>
<script src="/letters.js"></script>
</body></html>
