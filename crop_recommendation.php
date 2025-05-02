<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Crop Recommendation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Inter font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
    }

    .card-glass {
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(12px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      transition: 0.3s ease;
      border: 1px solid #4a7c7c;
    }

    .form-icon input {
      padding-left: 2.5rem;
      border-color: #4a7c7c;
    }

    .form-icon input:focus {
      box-shadow: 0 0 0 0.25rem rgba(74, 124, 124, 0.25);
      border-color: #4a7c7c;
    }

    .form-icon {
      position: relative;
    }

    .form-icon i {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      color: #4a7c7c;
    }

    .badge.bg-primary {
      background-color: #4a7c7c !important;
    }

    .btn.btn-primary {
      background-color: #4a7c7c;
      border-color: #4a7c7c;
    }

    .btn.btn-primary:hover {
      background-color: #3a6c6c;
      border-color: #3a6c6c;
    }
    
    .result-card {
      margin-top: 30px;
      border-radius: 20px;
      border: 1px solid #4a7c7c;

    }
    footer {
      background-color: var(--accent);
      color: white;
      padding: 40px 0;
    }

    footer a {
      color: white;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }

    .social-icons a {
      font-size: 1.3rem;
      margin-right: 15px;
      color: white;
    }

    @media (max-width: 767px) {
      .hero h1 {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>

  <?php include('nav.php'); ?>

  <section class="py-5">
    <div class="container">

      <div class="text-center mb-4">
        <span class="badge bg-primary text-uppercase">Recommendation</span>
        <h2 class="mt-2">🌱 Crop Recommendation System</h2>
        <p class="text-muted">Enter the values to get a smart crop suggestion</p>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
          <div class="card card-glass p-4">

            <form action="#" method="post">
              <div class="row g-3">

                <div class="col-md-4 form-icon">
                  <i class="bi bi-droplet-half"></i>
                  <input type="number" name="n" class="form-control" placeholder="Nitrogen Eg: 90" required>
                </div>

                <div class="col-md-4 form-icon">
                  <i class="bi bi-droplet"></i>
                  <input type="number" name="p" class="form-control" placeholder="Phosphorus Eg: 42" required>
                </div>

                <div class="col-md-4 form-icon">
                  <i class="bi bi-flower2"></i>
                  <input type="number" name="k" class="form-control" placeholder="Potassium Eg: 43" required>
                </div>

                <div class="col-md-4 form-icon">
                  <i class="bi bi-thermometer-sun"></i>
                  <input type="number" step="0.01" name="t" class="form-control" placeholder="Temperature Eg: 21°C" required>
                </div>

                <div class="col-md-4 form-icon">
                  <i class="bi bi-cloud-drizzle"></i>
                  <input type="number" step="0.01" name="h" class="form-control" placeholder="Humidity Eg: 82%" required>
                </div>

                <div class="col-md-4 form-icon">
                  <i class="bi bi-droplet-fill"></i>
                  <input type="number" step="0.01" name="ph" class="form-control" placeholder="pH Eg: 6.5" required>
                </div>

                <div class="col-md-4 form-icon">
                  <i class="bi bi-cloud-rain-heavy"></i>
                  <input type="number" step="0.01" name="r" class="form-control" placeholder="Rainfall Eg: 203mm" required>
                </div>

              </div>

              <div class="text-end mt-4">
                <button type="submit" name="Crop_Recommend" class="btn btn-primary px-4">
                  <i class="bi bi-search"></i> Recommend
                </button>
              </div>
            </form>

          </div>
          
          <?php
          if(isset($_POST['Crop_Recommend'])) {
              // Get and sanitize inputs
              $n = trim($_POST['n']);
              $p = trim($_POST['p']);
              $k = trim($_POST['k']);
              $t = trim($_POST['t']);
              $h = trim($_POST['h']);
              $ph = trim($_POST['ph']);
              $r = trim($_POST['r']);
              
              echo '<div class="card card-glass result-card p-4 mt-4">';
              echo '<div class="card-body">';
              echo '<h4 class="card-title">Recommendation Result</h4>';
              
              try {
                  // Prepare the command - use absolute path for reliability
                  $pythonScript = __DIR__ . '/ML/crop_recommendation/recommend.py';
                  
                  // Verify Python script exists
                  if (!file_exists($pythonScript)) {
                      throw new Exception("Python script not found at: $pythonScript");
                  }
                  
                  // Build command with proper argument formatting
                  $command = "python " . escapeshellarg($pythonScript) . " " . 
                             escapeshellarg($n) . " " . 
                             escapeshellarg($p) . " " . 
                             escapeshellarg($k) . " " . 
                             escapeshellarg($t) . " " . 
                             escapeshellarg($h) . " " . 
                             escapeshellarg($ph) . " " . 
                             escapeshellarg($r);
                  
                  // Execute and capture output
                  $output = shell_exec($command);
                  
                  if ($output === null) {
                      throw new Exception("Failed to execute Python script. Check server logs.");
                  }
                  
                  echo '<div class="alert alert-success mt-3">';
                  echo '<strong>Recommended Crop:</strong> ' . htmlspecialchars($output);
                  echo '</div>';
                  
                  // Display input values for reference
                  echo '<div class="mt-3"><h5>Input Values:</h5>';
                  echo '<ul class="list-group">';
                  echo '<li class="list-group-item">Nitrogen: ' . htmlspecialchars($n) . '</li>';
                  echo '<li class="list-group-item">Phosphorus: ' . htmlspecialchars($p) . '</li>';
                  echo '<li class="list-group-item">Potassium: ' . htmlspecialchars($k) . '</li>';
                  echo '<li class="list-group-item">Temperature: ' . htmlspecialchars($t) . '°C</li>';
                  echo '<li class="list-group-item">Humidity: ' . htmlspecialchars($h) . '%</li>';
                  echo '<li class="list-group-item">pH: ' . htmlspecialchars($ph) . '</li>';
                  echo '<li class="list-group-item">Rainfall: ' . htmlspecialchars($r) . 'mm</li>';
                  echo '</ul></div>';
                  
              } catch (Exception $e) {
                  echo '<div class="alert alert-danger mt-3">';
                  echo '<strong>Error:</strong> ' . htmlspecialchars($e->getMessage());
                  echo '</div>';
              }
              
              echo '</div></div>';
          }
          ?>
          
        </div>
      </div>

    </div>
  </section>


  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>