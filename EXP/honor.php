<?php
//$uname = $_POST['uname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Automated Class Scheduling System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #121212;
      color: white;
      display: flex;
      height: 100vh;
      margin: 0;
    }
    a {
      list-style-type: none;
      text-decoration: none;
      color: white;
    }
    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #1e1e1e;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .sidebar .profile {
      text-align: center;
      margin-bottom: 20px;
    }
    .sidebar .profile i {
      font-size: 4rem;
      color: #ff4081;
    }
    .sidebar ul {
      list-style: none;
      padding: 0;
      width: 100%;
    }
    .sidebar li {
      display: flex;
      align-items: left;
      padding: 10px;
      cursor: pointer;
      transition: background 0.3s;
      position: relative;
      flex-direction: column;
    }
    .sidebar li:hover {
      background-color: #333;
    }
    .sidebar li i {
      width: 25px;
      margin-right: 10px;
      text-align: center;
    }
    /* Dropdown Animation for Schedule */
    .schedule-dropdown {
      margin-top: 5px;
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.5s ease-in-out;
      width: 100%;
      background: #2a2a2a;
      padding-left: 1px;
    }
    .sidebar li:hover .schedule-dropdown {
      max-height: 200px;
    }
    .schedule-dropdown a {
      display: flex;
      align-items: left;
      padding: 5px 0;
      color: white;
      text-decoration: none;
    }
    .schedule-dropdown i {
      margin-top: 5px;
      margin-right: 10px;
    }
    .schedule-dropdown a:hover {
      background-color: #444;
    }
    .main-content {
      flex-grow: 1;
      padding: 20px;
      overflow-y: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #222;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #444;
      padding: 10px;
      text-align: center;
    }
    th {
      background: #333;
    }
    .print-button {
      margin-top: 20px;
      padding: 10px;
      background: #ff4081;
      color: white;
      border: none;
      cursor: pointer;
    }
    /* PRINT STYLES */
    @media print {
      body {
        background: white;
        color: black;
      }
      .sidebar, .print-button {
        display: none;
      }
      .main-content {
        width: 100%;
        padding: 0;
      }
      .print-header {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-bottom: 20px;
      }
      .print-header img {
        width: 80px;
        height: auto;
        margin-right: 15px;
      }
      .print-header h2 {
        margin: 0;
        font-size: 18px;
      }
      @page {
        size: landscape;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="profile">
      <i class="fas fa-user-circle"></i>
      <!--<h3>// echo htmlspecialchars("$uname"); //</h3>-->
    </div>
    <ul>
      <li><a href="onor.php"><i class="fas fa-user"></i> Profile</a></li>
      <li><a href="EXE.php"><i class="fas fa-home"></i> Home</a></li>
      <li>
        <a href="honor.php"><i class="fas fa-calendar-alt"></i> Schedule</a>
        <div class="schedule-dropdown">
          <a href="#"><i class="fas fa-door-open"></i> Room</a>
          <a href="#"><i class="fas fa-user-tie"></i> Professor</a>
          <a href="#"><i class="fas fa-book-open"></i> Subject</a>
        </div>
      </li>
    </ul>
  </div>
  <div class="main-content">
    <div class="print-header" style="display: none;">
      <img src="prmsu.png" alt="PRMSU Logo">
      <div>
        <h2>Republic of the Philippines<br>
        President Ramon Magsaysay State University<br>
        (Formerly Ramon Magsaysay Technological University)<br>
        Main Campus, Iba Zambales<br>
        2nd Semestral 2025-2026</h2>
      </div>
    </div>
    <table>
      <tr>
        <th>Time</th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
        <th>Saturday</th>
        <th>Sunday</th>
      </tr>
      <?php
      $start_hour = 7;
      $start_minute = 30;
      $end_hour = 19;
      for ($slot = 0; $slot < 20; $slot++) {
          $hour = $start_hour + floor(($start_minute + $slot * 30) / 60);
          $minute = ($start_minute + $slot * 30) % 60;
          $time_display = sprintf("%d:%02d %s", ($hour > 12 ? $hour - 12 : $hour), $minute, $hour >= 12 ? "PM" : "AM");
          echo "<tr><td>$time_display</td>";
          for ($day = 1; $day <= 7; $day++) {
              echo "<td><input type='text' name='schedule[$hour][$minute][$day]'></td>";
          }
          echo "</tr>";
      }
      ?>
    </table>
    <button class="print-button" onclick="preparePrint()">Print Schedule</button>
  </div>
  <script>
    function preparePrint() {
      document.querySelector('.print-header').style.display = 'flex';
      window.print();
      document.querySelector('.print-header').style.display = 'none';
    }
  </script>
</body>
</html>
