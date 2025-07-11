<?php
session_start();
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $sender_id = $_SESSION['user_id'];
  $receiver = $_POST['receiver'];
  $subject = $_POST['subject'];
  $body = $_POST['body'];
  $receiver_id = $conn->query("SELECT id FROM users WHERE username='$receiver'")
                     ->fetch_assoc()['id'];
  if ($receiver_id) {
    $conn->query("INSERT INTO messages (sender_id, receiver_id, subject, body)
                  VALUES ($sender_id, $receiver_id, '$subject', '$body')");
    echo "Message sent!";
  } else {
    echo "User not found.";
  }
}
?>
<!DOCTYPE html>
<html><head><link rel="stylesheet" href="style.css"></head>
<body>
<h2>Compose Message</h2>
<form method="post">
  <input type="text" name="receiver" placeholder="Receiver Username" required />
  <input type="text" name="subject" placeholder="Subject" required />
  <textarea name="body" placeholder="Message" required></textarea>
  <button type="submit">Send</button>
</form>
<a href="inbox.php">Back to Inbox</a>
</body></html>
