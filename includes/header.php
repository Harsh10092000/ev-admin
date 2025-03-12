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
      --primary-color: #3182ce; /* Primary blue from table design */
      --secondary-color: #edf2f7; /* Light gray from table header/footer */
      --accent-color: #38a169; /* Green for success alerts */
      --text-color: #2d3748; /* Dark gray for primary text */
      --muted-text-color: #4a5568; /* Muted gray for secondary text */
      --border-color: #e2e8f0; /* Border color from table design */
      --sidebar-width: 260px;
    }

    body {
      background: #f9fafb; /* Match table background */
      color: var(--text-color);
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif; /* Match table typography */
    }

    /* Header Styles */
    .header {
      background: #fff; /* White background */
      border-bottom: 1px solid var(--border-color); /* Match table border */
      padding: 0.75rem 1.5rem; /* Reduced padding for a compact look */
      box-shadow: 0 1px 3px rgba(0,0,0,0.05); /* Match table shadow */
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.5rem; /* Smaller gap for a tighter look */
    }

    .logo img {
      height: 32px; /* Smaller logo to match minimal design */
      transition: transform 0.2s ease;
    }

    .logo img:hover {
      transform: scale(1.05); /* Subtle hover effect */
    }

    .logo span {
      font-size: 1.25rem; /* Slightly smaller for a cleaner look */
      font-weight: 600; /* Match table heading weight */
      color: var(--text-color); /* Match primary text color */
    }

    .toggle-sidebar-btn {
      color: var(--muted-text-color); /* Match muted text color */
      font-size: 1.25rem; /* Smaller icon */
      transition: color 0.2s ease;
      background: none;
      border: none;
      padding: 0.5rem;
    }

    .toggle-sidebar-btn:hover {
      color: var(--primary-color); /* Match primary color on hover */
    }

    .header-nav .nav-profile {
      display: flex;
      align-items: center;
      gap: 0.5rem; /* Smaller gap */
      padding: 0.5rem 0.75rem;
      border-radius: 6px; /* Match table button border-radius */
      transition: all 0.2s ease;
    }

    .header-nav .nav-profile:hover {
      background: var(--secondary-color); /* Match table hover background */
    }

    .nav-profile img {
      width: 28px; /* Smaller profile image */
      height: 28px;
      border-radius: 50%;
      border: 1px solid var(--border-color); /* Subtle border */
      transition: transform 0.2s ease;
    }

    .nav-profile:hover img {
      transform: scale(1.05); /* Subtle hover effect */
    }

    .nav-profile span {
      font-size: 0.875rem; /* Match table font size */
      color: var(--muted-text-color); /* Match muted text color */
      font-weight: 500; /* Match table font weight */
    }

    .dropdown-menu {
      border-radius: 8px; /* Match table border-radius */
      box-shadow: 0 1px 3px rgba(0,0,0,0.05); /* Match table shadow */
      border: 1px solid var(--border-color); /* Match table border */
      margin-top: 0.5rem;
      background: #fff;
      font-size: 0.875rem; /* Match table font size */
    }

    .dropdown-item {
      padding: 0.5rem 1rem; /* Match table padding */
      border-radius: 6px; /* Match table button border-radius */
      margin: 2px 5px;
      color: var(--muted-text-color); /* Match muted text color */
      transition: all 0.2s ease;
    }

    .dropdown-item:hover {
      background: var(--secondary-color); /* Match table hover background */
      color: var(--text-color); /* Match primary text color */
    }

    .dropdown-header {
      padding: 0.5rem 1rem;
      color: var(--text-color); /* Match primary text color */
    }

    .dropdown-header h6 {
      font-size: 0.875rem; /* Match table font size */
      font-weight: 500; /* Match table font weight */
      margin-bottom: 0.25rem;
    }

    .dropdown-header span {
      font-size: 0.75rem; /* Smaller for secondary text */
      color: var(--muted-text-color); /* Match muted text color */
    }

    /* Sidebar Styles */
    .sidebar {
      background: #fff; /* White background */
      border-right: 1px solid var(--border-color); /* Match table border */
      width: var(--sidebar-width);
      padding: 1rem 0; /* Reduced padding */
      transition: all 0.3s ease;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 900;
      margin-top: 56px; /* Adjust for header height */
    }

    .sidebar-nav {
      padding: 0;
    }

    .nav-item {
      margin-bottom: 0.25rem;
    }

    .nav-link {
      margin: 0 0.5rem;
      padding: 0.5rem 1rem; /* Match table padding */
      border-radius: 6px; /* Match table button border-radius */
      color: var(--muted-text-color); /* Match muted text color */
      font-weight: 500; /* Match table font weight */
      font-size: 0.875rem; /* Match table font size */
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 0.5rem; /* Smaller gap */
    }

    .nav-link:hover {
      background: var(--secondary-color); /* Match table hover background */
      color: var(--text-color); /* Match primary text color */
    }

    .nav-link.active {
      background: var(--primary-color); /* Match primary color */
      color: #fff;
      box-shadow: none; /* Remove shadow for a flatter design */
    }

    .nav-link i {
      font-size: 1rem; /* Smaller icons */
    }

    .nav-content .nav-link {
      padding-left: 2.5rem; /* Adjusted for hierarchy */
      font-size: 0.875rem; /* Match table font size */
      font-weight: 400; /* Lighter weight for sub-items */
    }

    .nav-content .nav-link.active {
      background: var(--secondary-color); /* Match table hover background */
      color: var(--primary-color); /* Match primary color */
    }

    .nav-content .nav-link i {
      font-size: 0.875rem; /* Smaller icons for sub-items */
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
        margin-top: 0; /* Adjust for mobile */
      }
      .sidebar.show {
        transform: translateX(0);
      }
      .header {
        padding: 0.5rem 1rem;
      }
      .logo span {
        font-size: 1rem;
      }
      .nav-profile span {
        display: none; /* Hide name on mobile */
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
    <div class="d-flex align-items-center">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Admin Dashboard</span>
      </a>
      <button class="toggle-sidebar-btn">
        <i class="bi bi-list"></i>
      </button>
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
