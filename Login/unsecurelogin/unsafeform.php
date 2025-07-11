<!DOCTYPE html>
<html>
<head>
    <title>🧨 SQL Injection Test — Insecure Form</title>
</head>
<body>
    <h2>Insecure Login Demo</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username"><br><br>
        <input type="text" name="password" placeholder="Password"><br><br>
        <input type="submit" value="Login">
    </form>

<?php
$conn = new mysqli("localhost", "root", "", "app_db");

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

// 🕵️ Get metadata
$event_type = ($result && $result->num_rows > 0) ? "login_success" : "login_failed";
$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];

// 🔒 Insert into audit_log
$audit_sql = $conn->prepare("INSERT INTO audit_log (username, event_type, ip_address, user_agent, query_snapshot) VALUES (?, ?, ?, ?, ?)");
$audit_sql->bind_param("sssss", $username, $event_type, $ip, $agent, $sql);
$audit_sql->execute();

echo "<pre>Executed Query:\n$sql</pre>";

if ($event_type === "login_success") {
    echo "<p style='color:green;'>Login success ✅</p>";
} else {
    echo "<p style='color:red;'>Login failed ❌</p>";
}

$conn->close();
?>

</body>
</html>
