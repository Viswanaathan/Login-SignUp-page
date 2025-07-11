<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "amazon1");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_input = trim($_POST['user_input'] ?? '');
    $password_input = trim($_POST['password'] ?? '');

    $stmt = $mysqli->prepare("SELECT password, username FROM user_data2 WHERE email = ?");
    $stmt->bind_param("s", $user_input);
    $stmt->execute();
    $stmt->bind_result($hashed_password, $username);

    if ($stmt->fetch()) {
        $stmt->close();

        if (password_verify($password_input, $hashed_password)) {
            $stmt_check = $mysqli->prepare("SELECT state FROM user_data WHERE email = ?");
            $stmt_check->bind_param("s", $user_input);
            $stmt_check->execute();
            $stmt_check->bind_result($state);

            if ($stmt_check->fetch()) {
                if ($state === "1") {
                    $stmt_check->close();
                    $mysqli->close();
                    echo "<script>alert('Account already in use. Please log out from your other session.');
                    window.location.href='http://localhost/phpproject/Amazon/1st/1st.php';
                    </script>";
                    exit();
                }
            }

            $stmt_check->close();

            $_SESSION['user_email'] = $user_input;
            $_SESSION['username'] = $username;

            $stmt2 = $mysqli->prepare("UPDATE user_data SET state = ? WHERE email = ?");
            $active = "1";
            $stmt2->bind_param("ss", $active, $user_input);
            $stmt2->execute();
            $stmt2->close();

            $mysqli->close();
            header("Location: /phpproject/Amazon/3rd/page.php");
            exit();
        } else {
            $mysqli->close();
            echo "<script>alert('Invalid password.');</script>";
            exit();
        }
    } else {
        $stmt->close();
        $mysqli->close();
        echo "<script>alert('No account found with that email.');</script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In | Amazon Clone</title>
    <link rel="icon" href="http://localhost/phpproject/Amazon/Images/Favicon.png" sizes="96x96" type="image/x-icon" />
    <link rel="stylesheet" href="../old_user/2.existing_user.css">
</head>
<body>
    <section class="box0">
        <h1>
            <img src="../../Images/Amazon1.png" style="width:15vw; height:5vh;" alt="Amazon-logo">
        </h1>
        <div class="box1">
            <h2>Log in</h2>
            <form action="" method="POST">
                <div class="input-label">
                    <label for="t1.1">
                        <h3>Enter email</h3>
                    </label>
                </div>
                <div class="input-field">
                    <input type="text" id="t1.1" name="user_input" required
                        value="<?php echo isset($_POST['user_input']) ? htmlspecialchars($_POST['user_input']) : ''; ?>" />
                </div>
                <div class="input-label">
                    <label for="t1.2">
                        <h3>Enter password</h3>
                    </label>
                </div>
                <div class="input-field">
                    <input type="password" id="t1.2" name="password" required />
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