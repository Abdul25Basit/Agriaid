<!DOCTYPE html>
<html lang="en">
<?php include('header.php'); ?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | AI-Powered Farming Solutions</title>
  
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
      max-width: 600px;
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

    .password-strength {
      height: 5px;
      margin-top: 5px;
      background: #eee;
      border-radius: 3px;
    }

    .password-strength-bar {
      height: 100%;
      border-radius: 3px;
      transition: width 0.3s;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <?php include('nav.php'); ?>

  <!-- Registration Form -->
  <div class="container">
    <div class="auth-container">
      <h2 class="auth-title">Create Your Account</h2>
      
      <?php
      // Display error message if registration fails
      if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
      }
      
      // Display success message if redirected from registration
      if (isset($_GET['success'])) {
        echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success']) . '</div>';
      }
      ?>
      
      <form action="register_process.php" method="POST" onsubmit="return validateForm()">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
          </div>
          
          <div class="col-md-6 mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
          </div>
        </div>
        
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        
        <div class="mb-3">
          <label for="address" class="form-label">Farm Address</label>
          <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
        </div>
        
        <div class="mb-3">
          <label for="farm_size" class="form-label">Farm Size (acres)</label>
          <input type="number" step="0.01" class="form-control" id="farm_size" name="farm_size" required>
        </div>
        
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required onkeyup="checkPasswordStrength()">
          <div class="password-strength mt-1">
            <div id="password-strength-bar" class="password-strength-bar"></div>
          </div>
          <small id="password-help" class="form-text text-muted">Password must be at least 8 characters long</small>
        </div>
        
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
          <small id="confirm-help" class="form-text text-danger" style="display:none;">Passwords do not match</small>
        </div>
        
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
          <label class="form-check-label" for="terms">I agree to the <a href="terms.php">Terms of Service</a> and <a href="privacy.php">Privacy Policy</a></label>
        </div>
        
        <button type="submit" class="btn btn-custom">Register</button>
        
        <div class="auth-footer">
          <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <?php include('footer.php'); ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    function checkPasswordStrength() {
      const password = document.getElementById('password').value;
      const strengthBar = document.getElementById('password-strength-bar');
      let strength = 0;
      
      if (password.length >= 8) strength += 1;
      if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;
      if (password.match(/([0-9])/)) strength += 1;
      if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;
      
      // Update the strength bar
      switch(strength) {
        case 0:
          strengthBar.style.width = '0%';
          strengthBar.style.backgroundColor = '#dc3545';
          break;
        case 1:
          strengthBar.style.width = '25%';
          strengthBar.style.backgroundColor = '#dc3545';
          break;
        case 2:
          strengthBar.style.width = '50%';
          strengthBar.style.backgroundColor = '#fd7e14';
          break;
        case 3:
          strengthBar.style.width = '75%';
          strengthBar.style.backgroundColor = '#ffc107';
          break;
        case 4:
          strengthBar.style.width = '100%';
          strengthBar.style.backgroundColor = '#28a745';
          break;
      }
    }
    
    function validateForm() {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm_password').value;
      const confirmHelp = document.getElementById('confirm-help');
      
      if (password !== confirmPassword) {
        confirmHelp.style.display = 'block';
        return false;
      } else {
        confirmHelp.style.display = 'none';
        return true;
      }
    }
  </script>
</body>
</html>