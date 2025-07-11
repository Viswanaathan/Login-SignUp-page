<?php
session_start();
include 'db.php';

if (isset($_POST['message_id'])) {
  $message_id = intval($_POST['message_id']);
  $user_id = $_SESSION['user_id'];
  $conn->query("UPDATE messages SET deleted = FALSE WHERE id = $message_id AND receiver_id = $user_id");
}

$referrer = $_SERVER['HTTP_REFERER'] ?? 'trash.php';
header("Location: $referrer");
exit();
?>
