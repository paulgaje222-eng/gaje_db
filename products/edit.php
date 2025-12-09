<?php
require_once __DIR__ . '/../database.php';
$id = intval($_GET['id'] ?? 0);
if (!$id) { header('Location: ../index.php'); exit; }
$stmt = $conn->prepare("SELECT id, name, price, category_id FROM products WHERE id = ?");
$stmt->bind_param('i', $id); $stmt->execute(); $res = $stmt->get_result();
$product = $res->fetch_assoc();
$cats = $conn->query("SELECT categories_id AS id, name FROM categories ORDER BY name");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $category_id = $_POST['category_id'] ?: null;
    $u = $conn->prepare("UPDATE products SET name=?, price=?, category_id=? WHERE id=?");
    $u->bind_param('sdii', $name, $price, $category_id, $id);
    $u->execute();
    header('Location: ../index.php'); exit;
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Edit Product</title><link rel="stylesheet" href="../style.css"></head>
<body>
<h1 class="animate-letters">Edit Product</h1>
<form method="post">
    <label>Name</label>
    <input type="text" name="name" value="<?php echo e($product['name']); ?>" required>
    <label>Price</label>
    <input type="number" step="0.01" name="price" value="<?php echo e($product['price']); ?>" required>
    <label>Category</label>
    <select name="category_id">
        <option value="">-- None --</option>
        <?php while ($c = $cats->fetch_assoc()): ?>
            <option value="<?php echo $c['id']; ?>" <?php echo ($product['category_id']==$c['id'])? 'selected':''; ?>><?php echo e($c['name']); ?></option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Save</button>
    <a href="../index.php">Back</a>
</form>
<script src="/letters.js"></script>
</body></html>
