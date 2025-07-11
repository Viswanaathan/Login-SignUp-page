<?php
session_start();
include 'db.php';

if (isset($_POST['message_id'])) {
  $message_id = intval($_POST['message_id']);

  $conn->query("UPDATE messages SET starred = NOT starred WHERE id = $message_id");
}

$referrer = $_SERVER['HTTP_REFERER'] ?? 'inbox.php';
header("Location: $referrer");
exit();
?>
