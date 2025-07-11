<?php
$mysqli = new mysqli("localhost", "root", "", "app_db");
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}
$ticked = [];
$result = $mysqli->query("SELECT date FROM ticked_dates WHERE ticked = 1");
while ($row = $result->fetch_assoc()) {
  $ticked[] = $row['date'];
}
$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Monthly Tracker Calendar</title>
  <link rel="stylesheet" href="app.css">
</head>
<body>
  <h2>Tracker Calendar — <?= date('F Y', strtotime("$year-$month-01")) ?></h2>
  <form method="get" style="margin-bottom: 20px;">
    <select name="month">
      <?php for ($m = 1; $m <= 12; $m++):
        $mStr = str_pad($m, 2, '0', STR_PAD_LEFT); ?>
        <option value="<?= $mStr ?>" <?= $mStr == $month ? 'selected' : '' ?>>
          <?= date('F', mktime(0, 0, 0, $m, 10)) ?>
        </option>
      <?php endfor; ?>
    </select>
    <input type="number" name="year" value="<?= $year ?>" min="2000" max="2100">
    <button type="submit">Go</button>
  </form>
  <div class="calendar">
    <?php
    $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    foreach ($days as $d) echo "<div class='header'>$d</div>";
    $firstDay = date('w', strtotime("$year-$month-01"));
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    for ($i = 0; $i < $firstDay; $i++) echo "<div class='day'></div>";
    for ($day = 1; $day <= $daysInMonth; $day++) {
      $date = "$year-$month-" . str_pad($day, 2, '0', STR_PAD_LEFT);
      $checked = in_array($date, $ticked) ? 'checked' : '';
      echo "<div class='day'>
              <div class='day-number'>$day</div>
              <input type='checkbox' class='tick' data-date='$date' $checked>
            </div>";
    }
    ?>
  </div>
  <script>
    document.querySelectorAll('.tick').forEach(box => {
      box.addEventListener('change', () => {
        fetch('tick_date.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          body: `date=${box.dataset.date}&ticked=${box.checked ? 1 : 0}`
        });
      });
    });
  </script>
</body>
</html>