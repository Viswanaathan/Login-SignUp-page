<?php
include 'db.php';
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
header('Location: index.php');
?>
