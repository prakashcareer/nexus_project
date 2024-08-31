<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title>Student Dashboard</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/admin/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/admin/css/style.css">
  <link rel="stylesheet" href="../assets/admin/css/components.css">
   <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="../assets/admin/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='../assets/admin/img/raj-favi.png' />
  <link rel="stylesheet" type="text/css" href="../assets/toast/jquery.toast.css">
  <link rel="stylesheet" href="../assets/admin/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="../assets/admin/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <script src="../assets/toast/jquery.toast.js"></script>
  <script src="../assets/sweetalert.min.js"></script>
  <script src="../assets/admin/js/app.min.js"></script>
  <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
  <style type="text/css">
    textarea{
      resize: none;
    }
    .btn_upload {
      cursor: pointer;
      display: inline-block;
      overflow: hidden;
      position: relative;
      color: #fff;
      background-color: #2a72d4;
      border: 1px solid #166b8a;
      padding: 5px 10px;
    }
    .btn_upload:hover,
    .btn_upload:focus {
      background-color: #7ca9e6;
    }
    .yes {
      display: flex;
      align-items: flex-start;
      margin-top: 10px !important;
    }
    .btn_upload input {
      cursor: pointer;
      height: 100%;
      position: absolute;
      filter: alpha(opacity=1);
      -moz-opacity: 0;
      opacity: 0;
    }
    .it {
      height: 100px;
      margin-left: 10px;
    }
    .btn-rmv1,
    .btn-rmv2,
    .btn-rmv3,
    .btn-rmv4,
    .btn-rmv5 {
      display: none;
    }

    .rmv {
      cursor: pointer;
      color: #fff;
      border-radius: 30px;
      border: 1px solid #fff;
      display: inline-block;
      background: rgba(255, 0, 0, 1);
      margin: -5px -10px;
    }

    .rmv:hover {
      background: rgba(255, 0, 0, 0.5);
    }
  </style>
</head>

<body>
  <!-- <div class="loader"></div> -->
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline me-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-bs-toggle="sidebar" class="nav-link nav-link-lg
                  collapse-btn"> <i data-feather="menu"></i></a></li>
            <li>
              <!-- <form class="form-inline me-auto">
                <div class="search-element d-flex">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form> -->
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
              <i data-feather="maximize"></i>
            </a></li>
         
         
          <li class="dropdown"><a href="#" data-bs-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="../assets/admin/img/user.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php if (isset($_SESSION['user_id'])) {
    echo htmlspecialchars($_SESSION['user_name']); // Output the user's name safely
} else {
    echo "Guest"; // Or redirect to login or display a default message
} ?></div>
              <!-- <a href="profile.html" class="dropdown-item has-icon"> <i class="far
                    fa-user"></i> Profile
              </a> 
              <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Activities
              </a> 
              <a href="" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a> -->
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <?php 
      include 'includes/sidebar.php'; 
      ?>