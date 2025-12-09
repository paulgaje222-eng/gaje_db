<?php
require_once __DIR__ . '/../database.php';
$id = intval($_GET['id'] ?? 0);
if (!$id) { header('Location: list.php'); exit; }
// order info
$order = $conn->query("SELECT o.id, o.created_at, c.name AS customer_name FROM orders o LEFT JOIN customers c ON o.customer_id = c.id WHERE o.id = " . $id)->fetch_assoc();

// items
$items = $conn->query("SELECT oi.quantity, oi.price, p.name as product_name FROM order_items oi LEFT JOIN products p ON oi.product_id = p.id WHERE oi.order_id = " . $id);

?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Order #<?php echo e($order['id']); ?></title><link rel="stylesheet" href="../style.css"></head>
<body>
<h1 class="animate-letters">Order #<?php echo e($order['id']); ?></h1>
<p>Customer: <?php echo e($order['customer_name']); ?> | Created: <?php echo e($order['created_at']); ?></p>
<a href="list.php">Back to orders</a>
<h3>Items</h3>
<table>
    <thead><tr><th>Product</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr></thead>
    <tbody>
    <?php $total = 0; if ($items && $items->num_rows): while ($it = $items->fetch_assoc()): $sub = $it['quantity'] * $it['price']; $total += $sub; ?>
        <tr>
            <td><?php echo e($it['product_name']); ?></td>
            <td><?php echo e($it['quantity']); ?></td>
            <td><?php echo number_format($it['price'],2); ?></td>
            <td><?php echo number_format($sub,2); ?></td>
        </tr>
    <?php endwhile; else: ?>
        <tr><td colspan="4">No items.</td></tr>
    <?php endif; ?>
    </tbody>
    <tfoot>
        <tr><th colspan="3">Total</th><th><?php echo number_format($total,2); ?></th></tr>
    </tfoot>
</table>
<script src="/letters.js"></script>
</body></html>
