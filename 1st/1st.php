<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "amazon1");

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $user_input = trim($_POST['user_input'] ?? '');

  $stmt = $mysqli->prepare("SELECT * FROM user_data WHERE email = ?");
  $stmt->bind_param("s", $user_input);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $_SESSION['user_email'] = $user_input;
    $stmt->close();
    $mysqli->close();
    header("Location:/phpproject/Amazon/2nd/old_user/2.existing_user.php");
    exit();
  } else {
    $_SESSION['user_email'] = $user_input;
    $stmt->close();
    $mysqli->close();
    header("Location: /phpproject/Amazon/2nd/new_user/inbetween.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign In | Amazon Clone</title>
  <link rel="icon" href="../Images/favicon.png" sizes="96x96" type="image/x-icon" />
  <link rel="stylesheet" href="../1st/1st.css">
</head>
<body>
  <section class="box0">
    <h1>
      <img src="../Images/Amazon1.png"
        style="width:15vw; height:5vh;"
        alt="Amazon-logo">
    </h1>

    <div class="box1">
      <h2>Sign in or create account</h2>
      <form action="" method="POST">
        <div class="input-label">
          <label for="t1.1">
            <h3>Enter email</h3>
          </label>
        </div>

        <div class="input-field">
          <input type="text" id="t1.1" name="user_input" required />
        </div>

        <div class="submit-button">
          <button type="submit">Continue</button>
        </div>
      </form>

      <div class="terms-info">
        <p>
          By continuing, you agree to Amazon's
          <a href="">Conditions of Use</a> and
          <a href="">Privacy Notice</a>.
        </p>
      </div>

      <div class="work-account">
        <h3><strong>Buying for work?</strong></h3>
        <a href="">Create a free business account</a>
      </div>
    </div>
  </section>

  <footer>
    <div class="box2">
      <div class="box3">
        <a href="">Conditions of use</a>
        <a href="">Privacy Notice</a>
        <a href="">Help</a>
      </div>
      <div class="box4">
        <p>© 1996–2025, Amazon.com, Inc. or its affiliates</p>
      </div>
    </div>
  </footer>
</body>
</html>
