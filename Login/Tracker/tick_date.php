<?php
$mysqli = new mysqli("localhost", "root", "", "app_db");
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

$date = $_POST['date'];
$ticked = $_POST['ticked'];

$stmt = $mysqli->prepare("SELECT id FROM ticked_dates WHERE date = ?");
$stmt->bind_param("s", $date);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  $update = $mysqli->prepare("UPDATE ticked_dates SET ticked = ? WHERE date = ?");
  $update->bind_param("is", $ticked, $date);
  $update->execute();
  $update->close();
} else {
  $insert = $mysqli->prepare("INSERT INTO ticked_dates (date, ticked) VALUES (?, ?)");
  $insert->bind_param("si", $date, $ticked);
  $insert->execute();
  $insert->close();
}

$stmt->close();
echo "OK";
?>
