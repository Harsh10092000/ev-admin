<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    :root {
      --primary-color: #60a5fa; /* Lighter blue */
      --secondary-color: #f3f4f6; /* Very light gray */
      --accent-color: #22c55e; /* Bright green */
      --text-color: #374151; /* Soft dark gray */
      --sidebar-width: 260px;
    }

    body {
      background: #f9fafb; /* Even lighter background */
      color: var(--text-color);
      font-family: 'Poppins', sans-serif;
    }

    .header {
      background: #ffffff;
      border-bottom: 1px solid #e5e7eb; /* Lighter border */
      padding: 1rem 1.5rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.03); /* Softer shadow */
    }

    .logo {
      gap: 10px;
    }

    .logo img {
      height: 40px;
      transition: transform 0.3s ease;
    }

    .logo img:hover {
      transform: scale(1.1);
    }

    .logo span {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--primary-color);
    }

    .toggle-sidebar-btn {
      color: var(--primary-color);
      font-size: 1.5rem;
      transition: transform 0.3s ease, color 0.3s ease;
    }

    .toggle-sidebar-btn:hover {
      transform: rotate(90deg);
      color: #3b82f6; /* Slightly darker blue on hover */
    }

    .sidebar {
      background: #ffffff;
      border-right: 1px solid #e5e7eb; /* Lighter border */
      width: var(--sidebar-width);
      padding: 1.5rem 0; /* More padding */
      transition: all 0.3s ease;
    }

    .nav-link {
      margin: 6px 10px;
      padding: 12px 15px;
      border-radius: 12px;
      color: var(--text-color);
      font-weight: 500;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 12px; /* Slightly larger gap */
    }

    .nav-link:hover {
      background: var(--secondary-color);
      color: var(--primary-color);
    }

    .nav-link.active {
      background: var(--primary-color);
      color: #ffffff;
      box-shadow: 0 2px 10px rgba(96,165,250,0.3); /* Lighter shadow */
    }

    .nav-content .nav-link {
      padding-left: 40px;
      font-size: 0.9rem;
      font-weight: 400;
    }

    .nav-content .nav-link.active {
      background: var(--secondary-color);
      color: var(--primary-color);
    }

    .header-nav .nav-profile {
      gap: 8px;
      padding: 8px 15px;
      border-radius: 25px;
      transition: all 0.3s ease;
    }

    .header-nav .nav-profile:hover {
      background: var(--secondary-color);
    }

    .nav-profile img {
      width: 32px;
      height: 32px;
      border: 2px solid var(--primary-color);
      transition: transform 0.3s ease;
    }

    .nav-profile:hover img {
      transform: scale(1.1);
    }

    .dropdown-menu {
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08); /* Softer shadow */
      border: none;
      margin-top: 10px;
      background: #ffffff;
    }

    .dropdown-item {
      padding: 8px 15px;
      border-radius: 8px;
      margin: 2px 5px;
      color: var(--text-color);
      transition: all 0.3s ease;
    }

    .dropdown-item:hover {
      background: var(--secondary-color);
      color: var(--primary-color);
    }

    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        height: 100vh;
        transform: translateX(-100%);
        z-index: 1000;
      }
      .sidebar.show {
        transform: translateX(0);
      }
      .header {
        padding: 0.75rem 1rem;
      }
    }
  </style>
</head>

<?php 
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Admin Dashboard</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Admin</h6>
              <span>Administrator</span>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="includes/signout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link <?= ($activePage == 'index') ? 'active' : '' ?>" href="index.php">
          <i class="bi bi-house-door"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?= (in_array($activePage, ['addproduct', 'viewproducts', 'men', 'women', 'kids', 'other'])) ? 'active' : '' ?>" 
           data-bs-target="#product-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-shop"></i>
          <span>Manage Products</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="product-nav" class="nav-content collapse <?= (in_array($activePage, ['addproduct', 'viewproducts', 'men', 'women', 'kids', 'other'])) ? 'show' : '' ?>" 
            data-bs-parent="#sidebar-nav">
          <li>
            <a href="addproduct.php" class="<?= ($activePage == 'addproduct') ? 'active' : '' ?>">
              <i class="bi bi-plus-lg"></i>
              <span>Add Product</span>
            </a>
          </li>
          <li>
            <a href="viewproducts.php" class="<?= ($activePage == 'viewproducts') ? 'active' : '' ?>">
              <i class="bi bi-eye"></i>
              <span>View All Products</span>
            </a>
          </li>
          <li>
            <a href="men.php" class="<?= ($activePage == 'men') ? 'active' : '' ?>">
              <i class="bi bi-person-standing"></i>
              <span>Men's Products</span>
            </a>
          </li>
          <li>
            <a href="women.php" class="<?= ($activePage == 'women') ? 'active' : '' ?>">
              <i class="bi bi-person-standing-dress"></i>
              <span>Women's Products</span>
            </a>
          </li>
          <li>
            <a href="kids.php" class="<?= ($activePage == 'kids') ? 'active' : '' ?>">
              <i class="bi bi-emoji-smile"></i>
              <span>Kids' Products</span>
            </a>
          </li>
          <li>
            <a href="other.php" class="<?= ($activePage == 'other') ? 'active' : '' ?>">
              <i class="bi bi-box"></i>
              <span>Other Products</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </aside><!-- End Sidebar-->

  <!-- Custom JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toggleBtn = document.querySelector('.toggle-sidebar-btn');
      const sidebar = document.querySelector('.sidebar');

      toggleBtn.addEventListener('click', function(e) {
        e.preventDefault();
        sidebar.classList.toggle('show');
      });

      document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768 && 
            !sidebar.contains(e.target) && 
            !toggleBtn.contains(e.target) && 
            sidebar.classList.contains('show')) {
          sidebar.classList.remove('show');
        }
      });

      // Smooth scroll for nav links
      document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
          if (this.getAttribute('href') === '#') return;
          if (window.innerWidth <= 768) {
            sidebar.classList.remove('show');
          }
        });
      });
    });
  </script>
</body>