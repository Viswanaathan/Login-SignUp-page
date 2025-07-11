<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$result = $conn->query("SELECT m.*, u.username AS sender_name 
                        FROM messages m 
                        JOIN users u ON m.sender_id = u.id 
                        WHERE m.receiver_id = $user_id 
                          AND m.status = 'read' 
                          AND m.deleted = FALSE 
                        ORDER BY timestamp DESC");
?>
<!DOCTYPE html>
<html><head><link rel="stylesheet" href="style.css"><title>Read Messages</title></head>
<body>
<div class="card">
  <h2>📖 Read Messages for <?php echo htmlspecialchars($username); ?></h2>
  <a href="inbox.php">📥 Inbox</a> | 
  <a href="starred.php">⭐ Starred</a> | 
  <a href="trash.php">🗑️ Trash</a> | 
  <a href="send.php">📤 Compose</a> | 
  <a href="logout.php">🚪 Logout</a>
</div>
<div class="card">
  <ul>
    <?php while ($msg = $result->fetch_assoc()) { ?>
      <li>
        <strong>From:</strong> <?php echo htmlspecialchars($msg['sender_name']); ?><br>
        <strong>Subject:</strong> <?php echo htmlspecialchars($msg['subject']); ?><br>
        <p><?php echo nl2br(htmlspecialchars($msg['body'])); ?></p>
        <em><?php echo $msg['timestamp']; ?></em>
        <form action="delete.php" method="post" style="display:inline;">
          <input type="hidden" name="message_id" value="<?php echo $msg['id']; ?>">
          <button type="submit" onclick="return confirm('Move to Trash?')">🗑️ Delete</button>
        </form>
      </li>
    <?php } ?>
  </ul>
</div>
</body></html>
