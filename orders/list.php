<?php
require_once __DIR__ . '/../database.php';
// list orders with customer name and total items
$sql = "SELECT o.id, o.created_at, c.name AS customer_name, SUM(oi.quantity) AS total_items
        FROM orders o
        LEFT JOIN customers c ON o.customer_id = c.id
        LEFT JOIN order_items oi ON oi.order_id = o.id
        GROUP BY o.id
        ORDER BY o.id DESC";
$res = $conn->query($sql);
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Orders</title><link rel="stylesheet" href="../style.css"></head>
<body>
<h1 class="animate-letters">Orders</h1>
<p><a href="create.php">Create Order</a> | <a href="../index.php">Products</a></p>
<table>
    <thead><tr><th>ID</th><th>Customer</th><th>Created</th><th>Total Items</th><th>View</th></tr></thead>
    <tbody>
    <?php if ($res && $res->num_rows): while ($row = $res->fetch_assoc()): ?>
        <tr>
            <td><?php echo e($row['id']); ?></td>
            <td><?php echo e($row['customer_name']); ?></td>
            <td><?php echo e($row['created_at']); ?></td>
            <td><?php echo e($row['total_items'] ?? 0); ?></td>
            <td><a href="view.php?id=<?php echo $row['id']; ?>">View</a></td>
        </tr>
    <?php endwhile; else: ?>
        <tr><td colspan="5">No orders found.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
<script src="/letters.js"></script>
</body></html>
