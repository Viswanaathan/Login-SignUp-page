<?php
session_start();
$conn = new mysqli("localhost", "root", "", "amazon1");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$cart = $_SESSION['cart'] ?? [];
$user_email = $_SESSION['user_email'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
  if ($user_email && !empty($cart)) {
    foreach ($cart as $item) {
      $name = $conn->real_escape_string($item['name']);
      $price = floatval($item['price']);
      $qty = intval($item['quantity']);
      $subtotal = $price * $qty;
      $sql = "INSERT INTO orders (user_email, product_name, product_price, quantity, total) VALUES ('$user_email', '$name', $price, $qty, $subtotal)";
      $conn->query($sql);
    }
    unset($_SESSION['cart']);
    header("Location: http://localhost/phpproject/Amazon/3rd/page.php");
    exit();
  }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Your Cart</title>
  <link rel="stylesheet" href="view_cart.css">
</head>
<body>

<h2>Your Shopping Cart</h2>

<?php if (count($cart) === 0): ?>
  <p>Your cart is empty.</p>
<?php else: ?>
  <table>
    <tr>
      <th>Product</th>
      <th>Price (₹)</th>
      <th>Quantity</th>
      <th>Subtotal</th>
      <th>Action</th>
    </tr>
    <?php
    $total = 0;
    foreach ($cart as $index => $item):
      $subtotal = $item['price'] * $item['quantity'];
      $total += $subtotal;
    ?>
    <tr>
      <td><?= htmlspecialchars($item['name']) ?></td>
      <td><?= number_format($item['price']) ?></td>
      <td><?= $item['quantity'] ?></td>
      <td>₹<?= number_format($subtotal) ?></td>
      <td><a href="remove_item.php?index=<?= $index ?>" onclick="return confirm('Remove this item?')">Remove</a></td>
    </tr>
    <?php endforeach; ?>
    <tr class="total">
      <td colspan="4" align="right">Total:</td>
      <td>₹<?= number_format($total) ?></td>
    </tr>
  </table>

  <form action="clear_cart.php" method="POST" style="margin-top: 1rem;">
    <button type="submit">Clear Cart</button>
  </form>

  <form method="POST" style="margin-top: 1rem;">
    <button type="submit" name="buy">Buy</button>
  </form>
<?php endif; ?>

<p><a href="page.php">← Continue Shopping</a></p>

</body>
</html>