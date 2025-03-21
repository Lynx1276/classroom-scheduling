
<?php



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
    }
    .sidebar li:hover {
      background-color: #333;
    }
    .sidebar li i {
      width: 25px;
      margin-right: 10px;
      text-align: center;
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
    /* Registration Forms */
    .registration {
      margin-bottom: 20px;
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }
    .registration > div {
      background: #1e1e1e;
      padding: 15px;
      border-radius: 8px;
      flex: 1 1 300px;
    }
    form {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }
    input, button, select {
      padding: 10px;
      border-radius: 5px;
      border: none;
      font-size: 1em;
    }
    input, select {
      background: #222;
      color: white;
      flex: 1 1 150px;
    }
    button {
      background: #ff4081;
      color: white;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #ff79b0;
    }
    /* Available Items Containers */
    .available-containers {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }
    .available-items {
      background-color: #222;
      border: 1px solid #444;
      border-radius: 8px;
      padding: 20px;
      min-height: 200px;
      flex: 1 1 300px;
    }
    .available-items h3 {
      margin-top: 0;
      text-align: center;
    }
    .item {
      background: #333;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
    }
    .item button.edit-btn {
      background: #555;
      border: none;
      color: #fff;
      padding: 5px 10px;
      margin-top: 5px;
      cursor: pointer;
      border-radius: 3px;
      transition: background 0.3s;
    }
    .item button.edit-btn:hover {
      background: #777;
    }
    /* Room Management Section */
    .room-management {
      background: #1e1e1e;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      align-items: center;
    }
    /* Schedule Section */
    .schedule {
      margin-bottom: 20px;
    }
    .time-range {
      text-align: center;
      font-size: 1.2em;
      margin-bottom: 10px;
    }
    .rooms-container {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    .room-section {
      background: #1e1e1e;
      padding: 10px;
      border-radius: 8px;
    }
    .room-section h3 {
      margin: 0 0 10px 0;
    }
    .room-list {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }
    .room-block {
      background: #222;
      border: 1px solid #444;
      border-radius: 8px;
      width: calc(33.33% - 10px);
      min-width: 200px;
      padding: 10px;
      display: flex;
      flex-direction: column;
    }
    .room-header {
      font-weight: bold;
      margin-bottom: 5px;
      text-align: center;
    }
    .room-status {
      text-align: center;
      padding: 5px;
      border-radius: 4px;
      margin-bottom: 5px;
      font-size: 0.9em;
    }
    .room-slot {
      flex-grow: 1;
      min-height: 100px;
      border: 1px dashed #555;
      border-radius: 4px;
      padding: 5px;
    }
    /* Right Tab Panel */
    #rightTab {
      position: fixed;
      top: 0;
      right: 0;
      width: 300px;
      height: 100%;
      background-color: #1e1e1e;
      color: white;
      padding: 20px;
      overflow-y: auto;
      transition: transform 0.3s ease;
      transform: translateX(100%);
      z-index: 1000;
    }
    #rightTab.show {
      transform: translateX(0);
    }
    #rightTab h2 {
      margin-top: 0;
    }
    #rightTab .list-item {
      padding: 10px;
      border-bottom: 1px solid #333;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="profile">
      <i class="fas fa-user-circle"></i>
      <h3><?php echo"$uname" ?></h3>
    </div>
    <ul>
      <li data-target="profile"><i class="fas fa-user"></i> Profile</li>
      <li data-target="professors"><i class="fas fa-chalkboard-teacher"></i> Professors</li>
      <li data-target="subjects"><i class="fas fa-book-open"></i> Subjects</li>
      <li data-target="schedule"><i class="fas fa-calendar-alt"></i> Schedule</li>
    </ul>
  </div>
  <!-- Main Content -->
  <div class="main-content">
    <header>
      <h1>Automated Class Scheduling System</h1>
      <div id="clock"></div>
    </header>
    <!-- Registration Forms -->
    <section class="registration">
      <!-- Professor Registration -->
      <div class="register-professor">
        <h2>Register Professor</h2>
        <form id="registerProfessorForm">
          <input type="text" placeholder="Professor Name" id="professorName" />
          <button type="submit">Register Professor</button>
        </form>
      </div>
      <!-- Subject Registration (only subject name) -->
      <div class="register-subject">
        <h2>Register Subject</h2>
        <form id="registerSubjectForm">
          <input type="text" placeholder="Subject Name" id="subjectName" />
          <button type="submit">Register Subject</button>
        </form>
      </div>
    </section>
    <!-- Available Items -->
    <section class="available-containers">
      <div class="available-items" id="availableProfessors">
        <h3>Available Professors</h3>
      </div>
      <div class="available-items" id="availableSubjects">
        <h3>Available Subjects</h3>
      </div>
    </section>
    <!-- Room Management Section -->
    <section class="room-management">
      <h2>Add Room</h2>
      <form id="addRoomForm">
        <select id="roomSectionSelect">
          <option value="classroom">Classroom</option>
          <option value="laboratory">Laboratory</option>
          <option value="avr">AVR</option>
        </select>
        <input type="text" placeholder="Room Name" id="roomName" />
        <button type="submit">Add Room</button>
      </form>
    </section>
    <!-- Schedule Section -->
    <section class="schedule">
      <h2>Class Schedule Planner</h2>
      <div class="time-range">7:30 AM – 5:30 PM</div>
      <div class="rooms-container">
        <!-- Room sections: initially empty; rooms will be added dynamically -->
        <div class="room-section" id="classroomSection">
          <h3>Classrooms</h3>
          <div class="room-list"></div>
        </div>
        <div class="room-section" id="laboratorySection">
          <h3>Laboratories</h3>
          <div class="room-list"></div>
        </div>
        <div class="room-section" id="avrSection">
          <h3>AVR</h3>
          <div class="room-list"></div>
        </div>
      </div>
    </section>
  </div>
  <!-- Right Tab Panel -->
  <div id="rightTab">
    <h2 id="rightTabTitle"></h2>
    <div id="rightTabContent"></div>
  </div>
  <script>
    // Global Data Arrays and Counters
    let professorsData = [];
    let subjectsData = [];
    let professorIdCounter = 0;
    let subjectIdCounter = 0;
    
    // Clock functionality
    function updateClock() {
      const now = new Date();
      const hours = now.getHours().toString().padStart(2, '0');
      const minutes = now.getMinutes().toString().padStart(2, '0');
      const seconds = now.getSeconds().toString().padStart(2, '0');
      document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
    }
    setInterval(updateClock, 1000);
    updateClock();
    
    // Professor Registration
    document.getElementById('registerProfessorForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const professorName = document.getElementById('professorName').value.trim();
      if (!professorName) {
        alert("Please enter professor name.");
        return;
      }
      professorIdCounter++;
      const professorObj = { id: professorIdCounter, name: professorName };
      professorsData.push(professorObj);
      
      const item = document.createElement('div');
      item.className = 'item';
      item.setAttribute('data-type', 'professor');
      item.setAttribute('data-id', professorIdCounter);
      item.setAttribute('data-professor', professorName);
      item.innerHTML = `<strong>Professor:</strong> ${professorName} <button class='edit-btn'>Edit</button>`;
      document.getElementById('availableProfessors').appendChild(item);
      document.getElementById('professorName').value = '';
    });
    
    // Subject Registration
    document.getElementById('registerSubjectForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const subjectName = document.getElementById('subjectName').value.trim();
      if (!subjectName) {
        alert("Please enter subject name.");
        return;
      }
      subjectIdCounter++;
      const subjectObj = { id: subjectIdCounter, subject: subjectName };
      subjectsData.push(subjectObj);
      
      const item = document.createElement('div');
      item.className = 'item';
      item.setAttribute('data-type', 'subject');
      item.setAttribute('data-id', subjectIdCounter);
      item.setAttribute('data-subject', subjectName);
      item.innerHTML = `<strong>Subject:</strong> ${subjectName} <button class='edit-btn'>Edit</button>`;
      document.getElementById('availableSubjects').appendChild(item);
      document.getElementById('subjectName').value = '';
    });
    
    // Edit functionality for both professors and subjects
    function editItem(itemDiv) {
      const type = itemDiv.getAttribute('data-type');
      if (type === 'professor') {
        const professor = itemDiv.getAttribute('data-professor');
        const newProfessor = prompt("Edit Professor Name:", professor);
        if (newProfessor && newProfessor.trim() !== "") {
          itemDiv.setAttribute('data-professor', newProfessor);
          itemDiv.innerHTML = `<strong>Professor:</strong> ${newProfessor} <button class='edit-btn'>Edit</button>`;
          // Update global data
          const id = parseInt(itemDiv.getAttribute('data-id'));
          const prof = professorsData.find(p => p.id === id);
          if(prof) { prof.name = newProfessor; }
        }
      } else if (type === 'subject') {
        const subject = itemDiv.getAttribute('data-subject');
        let newSubject = prompt("Edit Subject Name:", subject);
        if(newSubject === null) return; // Cancelled
        newSubject = newSubject.trim();
        if(newSubject === "") {
          alert("Subject name cannot be empty.");
          return;
        }
        // If item is in a room slot, allow setting scheduled time
        let newTime = "";
        if(itemDiv.parentElement.classList.contains('room-slot')) {
          newTime = prompt("Set/Change Scheduled Time (e.g., 08:00):", itemDiv.getAttribute('data-time') || "");
          if(newTime === null) newTime = "";
          newTime = newTime.trim();
        }
        itemDiv.setAttribute('data-subject', newSubject);
        if(newTime !== "") {
          itemDiv.setAttribute('data-time', newTime);
          itemDiv.innerHTML = `<strong>Subject:</strong> ${newSubject}<br><strong>Time:</strong> ${newTime} <button class='edit-btn'>Edit</button>`;
        } else {
          itemDiv.innerHTML = `<strong>Subject:</strong> ${newSubject} <button class='edit-btn'>Edit</button>`;
        }
        // Update global data
        const id = parseInt(itemDiv.getAttribute('data-id'));
        const subj = subjectsData.find(s => s.id === id);
        if(subj) { subj.subject = newSubject; }
      }
    }
    
    // Delegated event listeners for editing
    document.getElementById('availableProfessors').addEventListener('click', function(e) {
      if(e.target.classList.contains('edit-btn')) {
        editItem(e.target.parentElement);
      }
    });
    document.getElementById('availableSubjects').addEventListener('click', function(e) {
      if(e.target.classList.contains('edit-btn')) {
        editItem(e.target.parentElement);
      }
    });
    
    // Add Room functionality
    document.getElementById('addRoomForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const section = document.getElementById('roomSectionSelect').value;
      const roomName = document.getElementById('roomName').value.trim();
      if(!roomName) {
        alert("Please enter room name.");
        return;
      }
      addRoom(section, roomName);
      document.getElementById('roomName').value = '';
    });
    
    // Function to add a room block dynamically
    function addRoom(section, roomName) {
      const roomBlock = document.createElement('div');
      roomBlock.className = 'room-block';
      roomBlock.setAttribute('data-room-type', section);
      roomBlock.setAttribute('data-room-name', roomName);
      roomBlock.innerHTML = `
        <div class="room-header">${roomName}</div>
        <div class="room-status">Status: Updating...</div>
        <div class="room-slot"></div>
      `;
      let containerId = '';
      if(section === 'classroom') containerId = 'classroomSection';
      else if(section === 'laboratory') containerId = 'laboratorySection';
      else if(section === 'avr') containerId = 'avrSection';
      const container = document.querySelector('#' + containerId + ' .room-list');
      if(container) {
        container.appendChild(roomBlock);
        // Add new room-slot to dragula containers
        drake.containers.push(roomBlock.querySelector('.room-slot'));
      }
    }
    
    // Update room status bars based on current time and occupancy
    function updateRoomStatuses() {
      const now = new Date();
      const currentTime = now.getHours() * 60 + now.getMinutes(); // minutes since midnight
      const openTime = 7 * 60 + 30; // 7:30 AM
      const closeTime = 17 * 60; // 5:00 PM
      document.querySelectorAll('.room-block').forEach(roomBlock => {
        const statusBar = roomBlock.querySelector('.room-status');
        const roomSlot = roomBlock.querySelector('.room-slot');
        let statusText = '';
        let statusColor = '';
        if(currentTime < openTime || currentTime >= closeTime) {
          statusText = 'Closed: ' + now.toLocaleTimeString();
          statusColor = 'red';
        } else {
          if(roomSlot.children.length > 0) {
            statusText = 'Ongoing: ' + now.toLocaleTimeString();
            statusColor = 'green';
          } else {
            statusText = 'Vacant: ' + now.toLocaleTimeString();
            statusColor = 'yellow';
          }
        }
        statusBar.textContent = statusText;
        statusBar.style.backgroundColor = statusColor;
      });
    }
    setInterval(updateRoomStatuses, 1000);
    updateRoomStatuses();
    
    // Dragula initialization: include available items, right tab content, and existing room slots
    const drake = dragula([
      document.getElementById('availableProfessors'),
      document.getElementById('availableSubjects'),
      document.getElementById('rightTabContent')
    ].concat(Array.from(document.getElementsByClassName('room-slot'))));
    
    // Sidebar Right Tab functionality
    const rightTab = document.getElementById('rightTab');
    const rightTabTitle = document.getElementById('rightTabTitle');
    const rightTabContent = document.getElementById('rightTabContent');
    let currentTab = '';
    document.querySelectorAll('.sidebar ul li').forEach(li => {
      li.addEventListener('click', function() {
        const target = this.getAttribute('data-target');
        if(target === 'professors' || target === 'subjects') {
          if(currentTab === target) {
            rightTab.classList.remove('show');
            currentTab = '';
          } else {
            currentTab = target;
            rightTabTitle.textContent = target.charAt(0).toUpperCase() + target.slice(1);
            let html = '';
            if(target === 'professors') {
              professorsData.forEach(p => {
                html += `<div class="list-item" data-id="${p.id}" data-type="professor"><strong>Professor:</strong> ${p.name}</div>`;
              });
            } else if(target === 'subjects') {
              subjectsData.forEach(s => {
                html += `<div class="list-item" data-id="${s.id}" data-type="subject"><strong>Subject:</strong> ${s.subject}</div>`;
              });
            }
            rightTabContent.innerHTML = html;
            rightTab.classList.add('show');
          }
        }
      });
    });
    
  </script>
</body>
</html>
