<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "test");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$error = "";
$email = $username = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $username = $_POST["username"];
    $confirm = $_POST["confirm_password"];

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $username, $hashed);

        if ($stmt->execute()) {
            header("Location: ../DbRL/login.php");
            exit;
        } else {
            $error = "Signup error: " . $stmt->error;
        }

        $stmt->close();
    }

    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="module" src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <title>Signup Page</title>
  <link rel="stylesheet" href="../DbRL/Css/signup.css"> 
</head>
<body>
  <section>
    <div class="login-box">
      <form action="" method="post">
        <h1>Signup</h1>

        <?php if (!empty($error)): ?>
          <p class="error" style="color: #f66; font-weight: bold;"><?php echo $error; ?></p>
        <?php endif; ?>

        <div class="input-box">
          <span class="icon"><box-icon name='envelope' color="white"></box-icon></span>
          <input type="email" id="Signup-Email" name="email" autocomplete="off"
            value="<?php echo htmlspecialchars($email); ?>" required />
          <label>Email</label>
        </div>

        <div class="input-box">
          <span class="icon"><box-icon name='user' color="white"></box-icon></span>
          <input type="text" id="Signup-Username" name="username" autocomplete="off"
            value="<?php echo htmlspecialchars($username); ?>" required />
          <label>Username</label>
        </div>

        <div class="input-box">
          <span class="icon"><box-icon name='lock-alt' color="white"></box-icon></span>
          <input type="password" id="Signup-Password" name="password" required />
          <label>Password</label>
        </div>

        <div class="input-box">
          <span class="icon"><box-icon name='lock' color="white"></box-icon></span>
          <input type="password" id="Confirm-Signup-Password" name="confirm_password" required />
          <label>Confirm Password</label>
        </div>

        <button type="submit" id="Signup-Button">Signup</button>

        <div class="register-link">
          <p>Already have an account? <a href="../DbRL/login.php">Login</a></p>
        </div>
      </form>
    </div>
  </section>
</body>
</html>
