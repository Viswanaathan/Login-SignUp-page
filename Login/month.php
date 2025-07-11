<?php
$month = $_GET['month'] ?? date('m');
$year = $_GET['year'] ?? date('Y');
?>
<!DOCTYPE html>
<html>
<head><title>Month Viewer</title></head>
<body>
  <h2><?= date('F Y', strtotime("$year-$month-01")) ?></h2>
  <form>
    <select name="month">
      <?php for ($i = 1; $i <= 12; $i++) echo "<option value='$i' " . ($month == $i ? 'selected' : '') . ">$i</option>"; ?>
    </select>
    <input type="number" name="year" value="<?= $year ?>">
    <button>View</button>
  </form>
  <div class="calendar">
    <?php
    $firstDay = date('w', strtotime("$year-$month-01"));
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $d) echo "<div class='day-name'>$d</div>";
    for ($i = 0; $i < $firstDay; $i++) echo "<div class='day'></div>";
    for ($i = 1; $i <= $daysInMonth; $i++) {
      $dayOfWeek = date('w', strtotime("$year-$month-$i"));
      $class = in_array($dayOfWeek, [0, 6]) ? 'day weekend' : 'day';
      echo "<div class='$class'>$i</div>";
    }
    ?>
  </div>

  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 600px;
      margin: 30px auto;
      padding: 0 20px;
      background-color: #f4f4f4;
    }
    h2 {
      text-align: center;
    }
    form {
      text-align: center;
      margin-bottom: 20px;
    }
    .calendar {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 5px;
      background-color: #fff;
      padding: 10px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    .day-name {
      font-weight: bold;
      text-align: center;
      background-color: #ddd;
      padding: 8px;
    }
    .day {
      text-align: center;
      padding: 10px 0;
      background-color: #eee;
      border-radius: 4px;
    }
    .weekend {
      color: red;
      background-color: #ffeaea;
    }
    select, input, button {
      margin: 5px;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
  </style>
</body>
</html>