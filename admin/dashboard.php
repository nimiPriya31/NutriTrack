<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      display: flex;
      height: 100vh;
      background-color: #f8f9fa;
    }

    /* Sidebar styles */
    .sidebar {
      width: 250px;
      background-color: #343a40;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .sidebar h2 {
      text-align: center;
      margin: 20px 0;
      font-size: 24px;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
    }

    .sidebar ul li {
      margin: 0;
    }

    .sidebar ul li a {
      text-decoration: none;
      color: white;
      display: block;
      padding: 15px 20px;
      font-size: 16px;
      transition: background-color 0.3s ease;
      border-left: 3px solid transparent;
    }

    .sidebar ul li a.active,
    .sidebar ul li a:hover {
      background-color: #007bff;
      border-left: 3px solid #ffffff;
    }

    .sidebar .admin-footer {
      padding: 20px;
      background-color: #2c3034;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .admin-footer .admin-name {
      font-size: 16px;
      color: #ffffff;
    }

    .admin-footer .menu-icon {
      font-size: 20px;
      color: #ffffff;
      cursor: pointer;
      position: relative;
    }

    .logout-menu {
      position: absolute;
      bottom: 70px;
      left: 20px;
      background-color: #444950;
      padding: 10px;
      border-radius: 5px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      display: none;
    }

    .logout-menu a {
      color: white;
      text-decoration: none;
      font-size: 14px;
      display: block;
    }

    .logout-menu a:hover {
      color: #007bff;
    }

    /* Main content styles */
    .main-content {
      flex-grow: 1;
      padding: 20px;
      overflow-y: auto;
      position: relative;
    }

    .welcome-message {
      text-align: center;
      font-size: 24px;
      color: #333;
      margin-top: 50px;
    }

    iframe {
      width: 100%;
      height: 80vh;
      border: none;
      display: none;
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <div>
      <h2>Admin Panel</h2>
      <ul>
        <li><a href="pages/add_food.php" target="content-frame" id="addFoodLink">Add Food</a></li>
        <li><a href="pages/add_admin.php" target="content-frame" id="addAdminLink">Add Admin</a></li>
        <li><a href="pages/view_foods.php" target="content-frame" id="viewFoodsLink">View Foods</a></li>
        <li><a href="pages/see_messages.php" target="content-frame" id="seeMessagesLink">See Messages</a></li>
        <li><a href="pages/all_users.php" target="content-frame" id="allUsersLink">All Users</a></li>
        <li><a href="pages/all_admins.php" target="content-frame" id="allAdminsLink">All Admins</a></li>
      </ul>
    </div>
    <div class="admin-footer">
      <span class="admin-name">Admin</span>
      <i class="fas fa-ellipsis-v menu-icon" id="menuIcon"></i>
      <div class="logout-menu" id="logoutMenu">
        <a href="pages/logout.php">Logout</a>
      </div>
    </div>
  </div>

  <div class="main-content">
    <div class="welcome-message" id="welcomeMessage">Welcome, Admin!</div>
    <iframe name="content-frame" id="contentFrame"></iframe>
  </div>

  <script>
    const links = document.querySelectorAll(".sidebar ul li a");
    const welcomeMessage = document.getElementById("welcomeMessage");
    const contentFrame = document.getElementById("contentFrame");
    const menuIcon = document.getElementById("menuIcon");
    const logoutMenu = document.getElementById("logoutMenu");

    // Add event listeners to all links
    links.forEach((link) => {
      link.addEventListener("click", (e) => {
        e.preventDefault(); // Prevent default link behavior
        loadPage(link.href);
        setActive(link);
      });
    });

    // Load a page into the iframe
    function loadPage(url) {
      welcomeMessage.style.display = "none";
      contentFrame.style.display = "block";
      contentFrame.src = url;
    }

    // Set active class on sidebar links
    function setActive(activeLink) {
      links.forEach((link) => link.classList.remove("active"));
      activeLink.classList.add("active");
    }

    // Toggle logout menu
    menuIcon.addEventListener("click", () => {
      logoutMenu.style.display =
        logoutMenu.style.display === "block" ? "none" : "block";
    });

    // Close the logout menu when clicking outside
    document.addEventListener("click", (e) => {
      if (!menuIcon.contains(e.target) && !logoutMenu.contains(e.target)) {
        logoutMenu.style.display = "none";
      }
    });
  </script>
</body>

</html>
