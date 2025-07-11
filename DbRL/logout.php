<?php
session_start();
session_destroy();
header("Location: ../DbRL/login.php");
exit;
?>