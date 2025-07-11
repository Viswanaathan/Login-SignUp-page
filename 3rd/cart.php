<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['product_name'] ?? '';
    $price = $_POST['product_price'] ?? 0;
    $qty = $_POST['quantity'] ?? 1;
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $_SESSION['cart'][] = [
        'name' => $name,
        'price' => $price,
        'quantity' => $qty
    ];
    header("Location: page.php");
    exit();
}
?>
 