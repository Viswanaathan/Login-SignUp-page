<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../Images/favicon.png" sizes="96x96" type="image/x-icon" />
  <title>Sign In | Amazon Clone</title>
  <link rel="stylesheet" href="../new_user/inbetween.css">
</head>

<body>
  <section class="box0">
    <h1>
      <img src="http://localhost/phpproject/Amazon/Images/Amazon1.png"
        style="width:15vw; height:5vh;"
        alt="Amazon-logo">
    </h1>

    <div class="box1">
      <h2>Looks like you are new to Amazon</h2>
      <h3><?php echo $_SESSION['user_email'] ?><a href="http://localhost/phpproject/Amazon/1st/1st.php"> Change</a></h3>
      <h3>Let's create an account using your mobile number</h3>
      <br>
      <button onclick="window.location.href='http://localhost/phpproject/Amazon/2nd/new_user/register.php'">
        Proceed to create an account
      </button>
      <p>
        <b>
          <h3>Already a customer?</h3>
        </b>
        <br>
        <a href="http://localhost/phpproject/Amazon/1st/1st.php">Sign in with another email or mobile</a>
      </p>
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