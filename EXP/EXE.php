<?php
date_default_timezone_set("Asia/Manila");
$timeNow = date("h:i A");

function getStatus($startTime, $endTime) {
    $current = strtotime(date("H:i"));
    $start = strtotime($startTime);
    $end = strtotime($endTime);

    if ($current >= $start && $current <= $end) {
        return ["Occupied", "blue"];  // occupied -> blue
    } elseif ($current < $start || $current > $end) {
        return ["Closed", "red"];  // closed -> red
    } else {
        return ["Vacant", "yellow"];  // vacant -> yellow
    }
}

$schedules = [
    ["room" => "Room 1", "professor" => "Montana", "subject" => "Topology", "start" => "07:30", "end" => "08:30", "category" => "Classroom"],
    ["room" => "Room 2", "professor" => "Smith", "subject" => "Calculus", "start" => "08:30", "end" => "09:30", "category" => "Classroom"],
    ["room" => "Room 3", "professor" => "Johnson", "subject" => "Physics", "start" => "09:30", "end" => "10:30", "category" => "Classroom"],
    ["room" => "Lab 1", "professor" => "Brown", "subject" => "Chemistry Lab", "start" => "10:30", "end" => "11:30", "category" => "Laboratory"],
    ["room" => "Lab 2", "professor" => "Davis", "subject" => "Electronics Lab", "start" => "01:00", "end" => "02:00", "category" => "Laboratory"],
    ["room" => "Lab 3", "professor" => "Wilson", "subject" => "Programming Lab", "start" => "02:00", "end" => "03:00", "category" => "Laboratory"],
    ["room" => "AVR 1", "professor" => "Anderson", "subject" => "Seminar", "start" => "03:00", "end" => "04:00", "category" => "AVR"],
];
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
    /* Global Styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #121212; /* Dark background */
      color: white;
      display: flex;
      height: 100vh;
      margin: 0;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #181818; /* Dark sidebar background */
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      border-right: 1px solid #333;
    }
    .sidebar .profile {
      text-align: center;
      margin-bottom: 20px;
    }
    .sidebar .profile i {
      font-size: 4rem;
      color: #ff4081;
    }
    .sidebar .profile h3 {
      margin: 10px 0 0 0;
    }
    .sidebar ul {
      list-style: none;
      padding: 0;
      width: 100%;
    }
    .sidebar li {
      display: flex;
      align-items: center;
      padding: 10px;
      cursor: pointer;
      transition: background 0.3s;
      color: white; /* Lighter text color */
    }
    .sidebar li:hover {
      background-color: #333;
    }
    .sidebar li i {
      width: 25px;
      margin-right: 10px;
      text-align: center;
    }
    .sidebar li a {
      color: white;
      font-size: 1.1rem;
      text-decoration: none; /* Removed underline */
    }

    /* Main Content */
    .main-content {
      flex-grow: 1;
      padding: 20px;
      overflow-y: auto;
      position: relative;
    }
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    #clock {
      font-size: 1.2em;
      background: #333;
      padding: 5px 15px;
      border-radius: 5px;
      color: white;
    }

    /* Rooms Grid */
    .rooms-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr); /* 3 columns */
      grid-gap: 20px;
      margin-top: 20px;
    }

    .class-room {
      text-align: center;
      padding: 12px;
      border-radius: 8px;
      border: 2px solid #444;
      font-weight: bold;
      background-color: #222; /* Dark blocks */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .status {
      font-size: 1.2em;
      padding: 5px;
      margin-bottom: 5px;
    }
    .status.red {
      background-color: red;
      color: white;
    }
    .status.blue {
      background-color: blue;
      color: white;
    }
    .status.yellow {
      background-color: yellow;
      color: black;
    }

    .room-title {
      font-size: 1.4em;
      margin-bottom: 5px;
    }

    .clock {
      font-size: 1.2em;
      margin-bottom: 5px;
    }

    .info {
      font-size: 1em;
      line-height: 1.5;
    }

    /* Category labels alignment */
    .room-section h3 {
      text-align: left; /* Left-aligned category labels */
      margin-bottom: 10px;
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
      <li><a href="professors.php"><i class="fas fa-chalkboard-teacher"></i> Professors</a></li>
      <li><a href="subjects.php"><i class="fas fa-book"></i> Subjects</a></li>
      <li><a href="honor.php"><i class="fas fa-calendar-alt"></i> Schedule</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <header>
      <h1>College Of Communication and Information Technology</h1>
      <div id="clock"></div>
    </header>

    <!-- Category Labels and Room Grids -->
    <div class="room-section">
      <h3>Classrooms</h3>
      <div class="rooms-container">
        <?php
          foreach ($schedules as $schedule) {
            if ($schedule['category'] == 'Classroom') {
              $status = getStatus($schedule['start'], $schedule['end']);
              echo "<div class='class-room {$schedule['room']}'>
                      <div class='room-title'>{$schedule['room']}</div>
                      <div class='status {$status[1]} status'>{$status[0]}</div>
                      <div class='clock' style='color: {$status[1]};'>" . date("h:i:s A") . "</div>
                      <div class='info'>
                        Professor: {$schedule['professor']}<br>
                        Subject: {$schedule['subject']}<br>
                        Session: {$schedule['start']} - {$schedule['end']}
                      </div>
                    </div>";
            }
          }
        ?>
      </div>
    </div>

    <div class="room-section">
      <h3>Laboratories</h3>
      <div class="rooms-container">
        <?php
          foreach ($schedules as $schedule) {
            if ($schedule['category'] == 'Laboratory') {
              $status = getStatus($schedule['start'], $schedule['end']);
              echo "<div class='class-room {$schedule['room']}'>
                      <div class='room-title'>{$schedule['room']}</div>
                      <div class='status {$status[1]} status'>{$status[0]}</div>
                      <div class='clock' style='color: {$status[1]};'>" . date("h:i:s A") . "</div>
                      <div class='info'>
                        Professor: {$schedule['professor']}<br>
                        Subject: {$schedule['subject']}<br>
                        Session: {$schedule['start']} - {$schedule['end']}
                      </div>
                    </div>";
            }
          }
        ?>
      </div>
    </div>

    <div class="room-section">
      <h3>AVR</h3>
      <div class="rooms-container">
        <?php
          foreach ($schedules as $schedule) {
            if ($schedule['category'] == 'AVR') {
              $status = getStatus($schedule['start'], $schedule['end']);
              echo "<div class='class-room {$schedule['room']}'>
                      <div class='room-title'>{$schedule['room']}</div>
                      <div class='status {$status[1]} status'>{$status[0]}</div>
                      <div class='clock' style='color: {$status[1]};'>" . date("h:i:s A") . "</div>
                      <div class='info'>
                        Professor: {$schedule['professor']}<br>
                        Subject: {$schedule['subject']}<br>
                        Session: {$schedule['start']} - {$schedule['end']}
                      </div>
                    </div>";
            }
          }
        ?>
      </div>
    </div>

  </div>

  <script>
    // Update Clock in real-time
    function updateClock() {
      const now = new Date();
      const hours = now.getHours().toString().padStart(2, '0');
      const minutes = now.getMinutes().toString().padStart(2, '0');
      const seconds = now.getSeconds().toString().padStart(2, '0');
      document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;

      // Update the real-time clock in each room
      const clocks = document.querySelectorAll('.clock');
      clocks.forEach(clock => {
        clock.textContent = `${hours}:${minutes}:${seconds}`;
      });
    }
    setInterval(updateClock, 1000);
    updateClock();
  </script>

</body>
</html>
