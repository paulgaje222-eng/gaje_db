<?php
require_once __DIR__ . '/database.php';
// Fetch products with category name using JOIN
$sql = "SELECT p.id, p.name AS product_name, p.price, c.name AS category_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.categories_id
    ORDER BY p.id DESC";
$res = $conn->query($sql);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Products - gaje_db</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="animate-letters">Products</h1>
<p>
    <a href="categories/list.php">Categories</a> | 
    <a href="products/create.php">Add Product</a> | 
    <a href="customers/create.php">Add Customer</a> | 
    <a href="orders/list.php">Orders</a>
</p>
<table>
    <thead>
        <tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php if ($res && $res->num_rows): while ($row = $res->fetch_assoc()): ?>
        <tr>
            <td><?php echo e($row['id']); ?></td>
            <td><?php echo e($row['product_name']); ?></td>
            <td><?php echo e($row['category_name'] ?: '-'); ?></td>
            <td><?php echo number_format($row['price'], 2); ?></td>
            <td>
                <a href="products/edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="products/delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete product?');">Delete</a>
            </td>
        </tr>
    <?php endwhile; else: ?>
        <tr><td colspan="5">No products found.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
<script src="/letters.js"></script>
</html>
</html>
