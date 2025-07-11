<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "testdb");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$username_style = $password_style = "";
$remembered_username = $_COOKIE["remember_username"] ?? "";
$checked = $remembered_username ? 'checked' : '';
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($_POST['remember'])) {
        setcookie("remember_username", $username, time() + 3600, "/");
    } else {
        setcookie("remember_username", "", time() - 3600, "/");
    }

    $stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
            exit();
        }
    }

    $error = "Incorrect username or password.";
    $username_style = "style='border: 2px solid red;'";
    $password_style = "style='border: 2px solid red;'";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form action="" method="post" autocomplete="off">
        <label>Username:</label>
        <input type="text" name="username" readonly onfocus="this.removeAttribute('readonly');"
            value="<?= htmlspecialchars($remembered_username) ?>" <?= $username_style ?>>
        <br><br>

        <label>Password:</label>
        <input type="password" name="password" autocomplete="new-password" <?= $password_style ?>>
        <br><br>

        <label><input type="checkbox" name="remember" <?= $checked ?>> Remember Me</label>
        <br><br>

        <input type="submit" value="Login">
    </form>
</body>

</html>