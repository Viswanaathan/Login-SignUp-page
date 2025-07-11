<?php
session_start();
if (isset($_SESSION['user_email'])) {
    $email = $_SESSION['user_email'];
    $mysqli = new mysqli("localhost", "root", "", "amazon1");
    if (!$mysqli->connect_error) {
        $stmt = $mysqli->prepare("UPDATE user_data SET state = ? WHERE email = ?");
        $zero = "0";
        $stmt->bind_param("ss", $zero, $email);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
    }
}
session_unset();
session_destroy(); 
header("Location: /phpproject/Amazon/1st/1st.php");
exit();
?>
