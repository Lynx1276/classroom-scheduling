<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Professor Management - Automated Class Scheduling System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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

    /* Sidebar Styles */
    .sidebar {
      width: 250px;
      background-color: #1e1e1e; /* Dark sidebar background */
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: fixed;
      height: 100%;
    }

    .sidebar .profile {
      text-align: center;
      margin-bottom: 20px;
    }

    .sidebar .profile i {
      font-size: 4rem;
      color: #ff4081; /* Profile icon color */
    }

    .sidebar .profile h3 {
      margin: 10px 0 0 0;
      color: #fff; /* White text for the profile */
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
    }

    .sidebar li:hover {
      background-color: #333; /* Hover effect */
    }

    .sidebar li i {
      width: 25px;
      margin-right: 10px;
      text-align: center;
    }

    .sidebar li a {
      color: white;
      text-decoration: none;
      width: 100%;
    }

    .sidebar li a:hover {
      color: #ff4081; /* Pink hover color */
    }

    /* Main Content */
    .main-content {
      margin-left: 270px; /* Space for the sidebar */
      flex-grow: 1;
      padding: 20px;
      overflow-y: auto;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    /* Professor Registration Form */
    .profile-content {
      background-color: #1e1e1e;
      padding: 20px;
      border-radius: 8px;
      width: 100%;
      max-width: 700px;
      margin: auto;
    }

    .profile-content h2 {
      text-align: center;
    }

    .profile-content form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .profile-content input, .profile-content textarea, .profile-content button {
      padding: 10px;
      border-radius: 5px;
      border: none;
      background-color: #222;
      color: white;
      font-size: 1em;
    }

    .profile-content button {
      background-color: #ff4081;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .profile-content button:hover {
      background-color: #ff79b0;
    }

    .professor-list {
      margin-top: 20px;
      padding: 20px;
      background-color: #1e1e1e;
      border-radius: 8px;
    }

    .professor-item {
      padding: 10px;
      border-bottom: 1px solid #333;
    }

    .professor-item:last-child {
      border-bottom: none;
    }

    .professor-item h3 {
      margin: 5px 0;
      font-size: 1.2em;
      color: #ff4081;
    }

    .professor-item p {
      margin: 5px 0;
      color: #ccc;
    }

    .action-btns {
      display: flex;
      gap: 10px;
    }

    .action-btns button {
      background-color: #333;
      padding: 5px 10px;
      border-radius: 5px;
      color: white;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .action-btns button:hover {
      background-color: #ff79b0;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="profile">
      <i class="fas fa-user-circle"></i>
      <!--<h3>Professor Admin</h3>-->
    </div>
    <ul>
      <li><a href="onor.php"><i class="fas fa-user"></i> Profile</a></li>
      <li><a href="hono.php"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="professors.php"><i class="fas fa-chalkboard-teacher"></i> Professors</a></li>
      <li><a href="subjects.php"><i class="fas fa-book"></i> Subjects</a></li>
      <li><a href="honor.php"><i class="fas fa-calendar-alt"></i> Schedule</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <header>
      <h1>Manage Professors</h1>
    </header>

    <!-- Professor Registration Form -->
    <div class="profile-content">
      <h2>Add New Professor</h2>
      <form>
        <input type="text" placeholder="Full Name" required />
        <input type="email" placeholder="Email" required />
        <input type="text" placeholder="Department" required />
        <input type="text" placeholder="Phone Number" />
        <textarea placeholder="Address" rows="3"></textarea>
        <button type="submit">Add Professor</button>
      </form>
    </div>

    <!-- List of Professors (Static Example) -->
    <div class="professor-list">
      <h2>Registered Professors</h2>
      <!-- Sample List of Professors -->
      <div class="professor-item">
        <h3>Dr. John Doe</h3>
        <p><strong>Email:</strong> john.doe@example.com</p>
        <p><strong>Department:</strong> Computer Science</p>
        <p><strong>Phone:</strong> 123-456-7890</p>
        <p><strong>Address:</strong> 123 University St, City, Country</p>
        <div class="action-btns">
          <button>Edit</button>
          <button>Delete</button>
        </div>
      </div>

      <div class="professor-item">
        <h3>Dr. Jane Smith</h3>
        <p><strong>Email:</strong> jane.smith@example.com</p>
        <p><strong>Department:</strong> Mechanical Engineering</p>
        <p><strong>Phone:</strong> 987-654-3210</p>
        <p><strong>Address:</strong> 456 Campus Ave, City, Country</p>
        <div class="action-btns">
          <button>Edit</button>
          <button>Delete</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
