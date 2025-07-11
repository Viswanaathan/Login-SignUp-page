<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../html/login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
    <link rel="stylesheet" href="../DbRL/page.css">
</head>

<body>
    <section>
        <div>
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]) ?></h1>
            <form action="..Css/DbRL/logout.php" method="post">
                <button id="logout" type="submit" method=""POST>Logout</button>
            </form>
        </div>
    </section>
</body>

</html>