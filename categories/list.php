<?php
require_once __DIR__ . '/../database.php';
 $res = $conn->query("SELECT categories_id AS id, name FROM categories ORDER BY categories_id DESC");
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Categories</title><link rel="stylesheet" href="../style.css"></head>
<body>
<h1 class="animate-letters">Categories</h1>
<p><a href="create.php">Add Category</a> | <a href="../index.php">Back to Products</a> | <a href="delete-all.php" style="color:red;font-weight:bold;">Delete All</a></p>
<table>
<thead><tr><th>ID</th><th>Name</th><th>Actions</th></tr></thead>
<tbody>
<?php if ($res && $res->num_rows): while ($row = $res->fetch_assoc()): ?>
    <tr><td><?php echo e($row['id']); ?></td><td><?php echo e($row['name']); ?></td><td><a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete category?');">Delete</a></td></tr>
<?php endwhile; else: ?>
    <tr><td colspan="3">No categories.</td></tr>
<?php endif; ?>
</tbody>
</table>
<script src="/letters.js"></script>
</body></html>
