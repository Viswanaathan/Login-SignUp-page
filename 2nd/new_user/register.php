<?php
session_start();
define('ENCRYPTION_METHOD', 'AES-256-CBC');
define('SECRET_KEY', 'your_strong_secret_key');
define('SECRET_IV', 'your_iv_value');
function encryptData($data) {
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    return base64_encode(openssl_encrypt($data, ENCRYPTION_METHOD, $key, 0, $iv));
}
$mysqli = new mysqli("localhost", "root", "", "amazon1");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['name'] ?? '');
    $phno_raw = trim($_POST['phno'] ?? '');
    $password_raw = trim($_POST['password'] ?? '');
    $email_raw = $_SESSION['user_email'] ?? '';

    $enc_phno = encryptData($phno_raw);
    $hashed_password = password_hash($password_raw, PASSWORD_DEFAULT);

    $stmt1 = $mysqli->prepare("INSERT INTO user_data (email, phno) VALUES (?, ?)");
    $stmt1->bind_param("ss", $email_raw, $enc_phno);
    $success1 = $stmt1->execute();
    $user_id = $stmt1->insert_id;
    $stmt1->close();

    $stmt2 = $mysqli->prepare("INSERT INTO user_data2 (id, email, phno, username, password) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("issss", $user_id, $email_raw, $enc_phno, $username, $hashed_password);
    $success2 = $stmt2->execute();
    $stmt2->close();

    $mysqli->close();

    if ($success1 && $success2) {
        header("Location: /phpproject/Amazon/2nd/old_user/2.existing_user.php");
        exit();
    } else {
        echo "<script>alert('Registration failed. Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign In | Amazon Clone</title>
  <link rel="icon" href="http://localhost/phpproject/Amazon/Images/Favicon.png" sizes="96x96" type="image/x-icon" />
  <link rel="stylesheet" href="../new_user/register.css">
</head>
<body>
  <section class="box0">
    <h1>
      <img src="http://localhost/phpproject/Amazon/Images/Amazon1.png"
        style="width:15vw; height:5vh;"
        alt="Amazon-logo">
    </h1>

    <div class="box1">
      <h2>Create account</h2>
      <form action="" method="POST">
        <div class="input-label">
          <label for="name">
            <h3>Your name</h3>
          </label>
        </div>
        <div class="input-field">
          <input type="text" id="name" name="name" required />
        </div>
        <div class="input-label">
          <label for="phno">
            <h3>Enter Mobile number</h3>
          </label>
        </div>
        <div class="input-field">
          <input type="number" id="phno" name="phno" required />
        </div>
        <div class="input-label">
          <label for="password">
            <h3>Create a password</h3>
          </label>
        </div>
        <div class="input-field">
          <input type="password" id="password" name="password" minlength="6" required />
        </div>
        <div class="submit-button">
          <button type="submit">Register</button>
        </div>
      </form>
      <p>
        <b>
          <h3>Already a customer?</h3>
        </b>
        <br>
        <a href="http://localhost/phpproject/Amazon/1st/1st.php">Sign in instead</a>
      </p>
      <div class="work-account">
        <h3><strong>Buying for work?</strong></h3>
        <br>
        <a href="">Create a free business account</a>
      </div>
            <div class="terms-info">
        <p>
          By continuing, you agree to Amazon's
          <a href="">Conditions of Use</a> and
          <a href="">Privacy Notice</a>.
        </p>
      </div>
    </div>
  </section>

  <footer>
    <br>
    <br>
    <br>
    <div class="box2">
      <div class="box3">
        <a href="">Conditions of use</a>
        <a href="">Privacy Notice</a>
        <a href="">Help</a>
      </div>
      <div class="box4">
        <p>© 1996–2025, Amazon.com, Inc. or its affiliates</p>
        <br>
        <br>
        <br>
        <br>
      </div>
    </div>
  </footer>
</body>
</html>
