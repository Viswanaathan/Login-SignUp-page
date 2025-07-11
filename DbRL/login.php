<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "test");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$remembered_email = isset($_COOKIE["remember_email"]) ? $_COOKIE["remember_email"] : "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (isset($_POST["remember"])) {
        setcookie("remember_email", $email, time() + 36000, "/");
    } else {
        setcookie("remember_email", "", time() - 3600, "/");
    }

    $stmt = $mysqli->prepare("SELECT username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($username, $hashed);
        $stmt->fetch();

        if (password_verify($password, $hashed)) {
            $_SESSION["username"] = $username;
            header("Location: page.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <title>Login Page</title>
  <link rel="stylesheet" href="../DbRL/Css/login.css" />
</head>
<body>
  <section>
    <div class="login-box">
      <form action="" method="post">
        <h1>Login</h1>

        <?php if (!empty($error)): ?>
          <p class="error" style="color: #f77; font-weight: bold;"><?php echo $error; ?></p>
        <?php endif; ?>

        <div class="input-box">
          <span class="icon"><box-icon name="envelope" color="white"></box-icon></span>
          <input type="email" id="Login-Email" name="email" autocomplete="off"
            value="<?php echo htmlspecialchars($remembered_email ?: ($_POST['email'] ?? '')); ?>"
            required readonly onfocus="this.removeAttribute('readonly');" />
          <label>Email</label>
        </div>

        <div class="input-box">
          <span class="icon"><box-icon name="lock-alt" color="white"></box-icon></span>
          <input type="password" id="Login-Password" name="password" autocomplete="off" required />
          <label>Password</label>
        </div>

        <div class="remember-forget">
          <label>
            <input type="checkbox" id="rem" name="remember"
              <?php if (!empty($remembered_email)) echo "checked"; ?> />
            Remember me
          </label>
          <a href="#">Forgot Password</a>
        </div>

        <button type="submit" id="Login-Button">Login</button>

        <div class="register-link">
          <p>Don't have an account? <a href="signup.php">Signup</a></p>
        </div>
      </form>
    </div>
  </section>
</body>
</html>
