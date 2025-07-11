<?php
session_start();
include 'db.php';
$sender_id = $_SESSION['user_id'];
$receiver = $_POST['receiver'];
$subject = $_POST['subject'];
$body = $_POST['body'];
$original_id = $_POST['original_id'];
$receiver_id = $conn->query("SELECT id FROM users WHERE username='$receiver'")
                   ->fetch_assoc()['id'];
if ($receiver_id) {
  $conn->query("INSERT INTO messages (sender_id, receiver_id, subject, body)
                VALUES ($sender_id, $receiver_id, '$subject', '$body')");
  $conn->query("UPDATE messages SET status='read' WHERE id=$original_id");
  header("Location: inbox.php");
} else {
  echo "Reply failed: user not found.";
}
?>
