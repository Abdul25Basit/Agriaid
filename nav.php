<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AgriAid</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Optional Google Font for clean look -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f7fafd;
    }

    .navbar {
      background-color: #f7fafd !important;
    }

    .navbar-brand {
      color: #355070 !important;
      font-weight: 700;
      font-size: 1.5rem;
    }

    .nav-link {
      color: #555 !important;
      transition: color 0.3s ease;
    }

    .nav-link:hover {
      color: #457b9d !important;
    }

    .btn-login, .btn-register {
      border-radius: 20px;
      padding: 6px 16px;
      font-weight: 500;
      transition: background-color 0.3s ease;
    }

    .btn-login {
      background-color: #457b9d;
      color: white;
      margin-right: 10px;
    }

    .btn-login:hover {
      background-color: #356183;
    }

    .btn-register {
      background-color: transparent;
      color: #457b9d;
      border: 1px solid #457b9d;
    }

    .btn-register:hover {
      background-color: #457b9d;
      color: white;
    }

    .welcome-text {
      color: #457b9d !important;
      margin-right: 15px;
      font-weight: 500;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Navbar content here -->
  </nav>

  <nav class="navbar navbar-expand-lg shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand" href="../index.php">AgriAid</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link mx-2" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="#features">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="#blogs">Blogs</a>
          </li>

          <?php if(isset($_SESSION['user_id'])): ?>
            <!-- Show these when user is logged in -->
            <!-- <li class="nav-item">
              <span class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            </li> -->
            <li class="nav-item">
              <a class="nav-link mx-2" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-sm btn-login" href="logout.php">Logout</a>
            </li>
          <?php else: ?>
            <!-- Show these when user is not logged in -->
            <li class="nav-item">
              <a class="btn btn-sm btn-login" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-sm btn-register" href="register.php">Register</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Optional content can go here -->

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>