<?php
require_once __DIR__ . '/../database.php';
// fetch customers and products
$customers = $conn->query("SELECT id, name FROM customers ORDER BY name");
$products = $conn->query("SELECT id, name, price FROM products ORDER BY name");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = intval($_POST['customer_id']);
    $quantities = $_POST['qty'] ?? [];
    // create order
    $stmt = $conn->prepare("INSERT INTO orders (customer_id) VALUES (?)");
    $stmt->bind_param('i', $customer_id); $stmt->execute();
    $order_id = $conn->insert_id;
    foreach ($quantities as $product_id => $qty) {
        $q = intval($qty);
        if ($q <= 0) continue;
        // get product price
        $pstmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
        $pstmt->bind_param('i', $product_id); $pstmt->execute(); $r = $pstmt->get_result()->fetch_assoc();
        $price = $r ? $r['price'] : 0;
        $ip = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $ip->bind_param('iiid', $order_id, $product_id, $q, $price); $ip->execute();
    }
    header('Location: list.php'); exit;
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Create Order</title><link rel="stylesheet" href="../style.css"></head>
<body>
<h1 class="animate-letters">Create Order</h1>
<p><a href="list.php">Orders list</a> | <a href="../customers/create.php">Add Customer</a></p>
<form method="post">
    <label>Customer</label>
    <select name="customer_id" required>
        <?php while ($c = $customers->fetch_assoc()): ?>
            <option value="<?php echo $c['id']; ?>"><?php echo e($c['name']); ?></option>
        <?php endwhile; ?>
    </select>
    <h3>Products</h3>
    <table>
    <thead><tr><th>Product</th><th>Price</th><th>Quantity</th></tr></thead>
    <tbody>
    <?php while ($p = $products->fetch_assoc()): ?>
        <tr>
            <td><?php echo e($p['name']); ?></td>
            <td><?php echo number_format($p['price'], 2); ?></td>
            <td><input type="number" name="qty[<?php echo $p['id']; ?>]" min="0" value="0"></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
    </table>
    <button type="submit">Create Order</button>
</form>
<script src="/letters.js"></script>
</body></html>
