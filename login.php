<!DOCTYPE html>
<html lang="en">
<?php include('header.php'); ?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | AI-Powered Farming Solutions</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  
  <style>
    :root {
      --primary: #70a1a1;
      --secondary: #f0f8f7;
      --accent: #4a7c7c;
    }

    body {
      background-color: #fdfefe;
      color: #333;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .auth-container {
      max-width: 500px;
      margin: 80px auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
      background: white;
    }

    .auth-title {
      color: var(--accent);
      font-weight: bold;
      text-align: center;
      margin-bottom: 30px;
    }

    .btn-custom {
      background-color: var(--primary);
      color: white;
      border-radius: 30px;
      padding: 8px 20px;
      width: 100%;
    }

    .btn-custom:hover {
      background-color: var(--accent);
    }

    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 0.25rem rgba(74, 124, 124, 0.25);
    }

    .auth-footer {
      text-align: center;
      margin-top: 20px;
    }

    .auth-footer a {
      color: var(--primary);
      text-decoration: none;
    }

    .auth-footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <?php include('nav.php'); ?>

  <!-- Login Form -->
  <div class="container">
    <div class="auth-container">
      <h2 class="auth-title">Login to Your Account</h2>
      
      <?php
      // Display error message if login fails
      if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
      }
      ?>
      
      <form action="login_process.php" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="remember" name="remember">
          <label class="form-check-label" for="remember">Remember me</label>
        </div>
        
        <button type="submit" class="btn btn-custom">Login</button>
        
        <div class="auth-footer">
          <p>Don't have an account? <a href="register.php">Register here</a></p>
          <p><a href="forgot_password.php">Forgot your password?</a></p>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <?php include('footer.php'); ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>