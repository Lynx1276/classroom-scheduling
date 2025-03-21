<?php

//$uname = $_POST['uname'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Automated Class Scheduling System</title>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- Dragula for drag-and-drop -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js"></script>
  <style>
    /* Global Styles */
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
  <!-- Main Content -->
  <div class="main-content">
    <header>
      <h1>Automated Class Scheduling System</h1>
      <div id="clock"></div>
    </header>
    <!-- Main content is now cleared, only showing clock and system name -->
  </div>
  <script>
    // Global Data Arrays and Counters
    let professors = [];
    let subjects = [];
    let rooms = [];

    // Update Clock
    function updateClock() {
      const now = new Date();
      const hours = now.getHours().toString().padStart(2, '0');
      const minutes = now.getMinutes().toString().padStart(2, '0');
      const seconds = now.getSeconds().toString().padStart(2, '0');
      document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
    }
    setInterval(updateClock, 1000);
    updateClock();
  </script>
</body>
</html>
