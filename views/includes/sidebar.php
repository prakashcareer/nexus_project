<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="dashboard.php"> <!-- <img alt="image" src="" class="header-logo" /> --> <span
                class="logo-name">Practical Task</span>
            </a>
          </div>
          <div class="sidebar-user">
            <!-- <div class="sidebar-user-picture">
              <img alt="image" src="assets/img/user.png">
            </div> -->
            <div class="sidebar-user-details">
              <div class="user-name"><?php if (isset($_SESSION['user_id'])) {
    echo htmlspecialchars($_SESSION['user_name']); // Output the user's name safely
} else {
    echo "Guest"; // Or redirect to login or display a default message
} ?></div>
              <div class="user-role">Student</div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
              <a href="dashboard.php" class="nav-link"><i data-feather="calendar"></i><span>Dashboard</span></a>
            </li>

          
            <li class="dropdown">
              <a href="feedback.php" class="nav-link"><i data-feather="calendar"></i><span>Manage Feedback</span></a>
            </li>
            <li class="dropdown">
              <a href="logout.php" class="nav-link"><i data-feather="calendar"></i><span>Logout</span></a>
            </li>          
          </ul>
        </aside>
      </div>