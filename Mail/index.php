<?php
session_start();
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $result = $conn->query("SELECT * FROM users WHERE username='$username'");
  $user = $result->fetch_assoc();
  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header('Location: inbox.php');
  } else {
    echo "Login failed";
  }
}
?>
<!DOCTYPE html>
<html><head><link rel="stylesheet" href="style.css"></head>
<body>
<h2>Login</h2>
<form method="post">
  <input type="text" name="username" placeholder="Username" required />
  <input type="password" name="password" placeholder="Password" required />
  <button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="register.html">Register</a></p>
</body></html>
