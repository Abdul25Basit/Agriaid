<!DOCTYPE html>
<html lang="en">
<?php include('header.php'); ?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Soil Testing Laboratories in Maharashtra | AI-Powered Farming Solutions</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

  <!-- Custom Styling -->
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

    .hero {
      background: linear-gradient(to right, var(--secondary), #ffffff);
      padding: 60px 20px;
      text-align: center;
    }

    .hero h1 {
      color: var(--accent);
      font-size: 2.5rem;
      font-weight: bold;
    }

    .section-title {
      font-weight: bold;
      text-align: center;
      margin-bottom: 30px;
      color: var(--accent);
      font-size: 2rem;
    }

    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
      margin-bottom: 20px;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card-header {
      background-color: var(--primary);
      color: white;
      font-weight: bold;
      border-radius: 12px 12px 0 0 !important;
    }

    .btn-custom {
      background-color: var(--primary);
      color: white;
      border-radius: 30px;
      padding: 8px 20px;
    }

    .btn-custom:hover {
      background-color: var(--accent);
      color: white;
    }

    .location-selector {
      max-width: 400px;
      margin: 0 auto 30px;
    }

    .lab-icon {
      font-size: 1.5rem;
      color: var(--primary);
      margin-right: 10px;
    }

    .no-labs-found {
      text-align: center;
      padding: 30px;
      background-color: var(--secondary);
      border-radius: 12px;
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
  <!-- Navbar -->
  <?php include('nav.php'); ?>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1>Soil Testing Laboratories in Maharashtra</h1>
      <p class="lead mt-3">Find certified soil testing facilities near you</p>
    </div>
  </section>

  <!-- Main Content -->
  <section class="py-5">
    <div class="container">
      <h2 class="section-title">Find Laboratories by District</h2>
      
      <!-- Location Selector Form -->
      <div class="location-selector">
        <form method="get" action="" class="mb-4">
          <div class="input-group">
            <select class="form-select" name="district" id="district" required>
              <option value="">Select District</option>
              <option value="Mumbai" <?= (isset($_GET['district']) && $_GET['district'] == 'Mumbai') ? 'selected' : '' ?>>Mumbai</option>
              <option value="Pune" <?= (isset($_GET['district']) && $_GET['district'] == 'Pune') ? 'selected' : '' ?>>Pune</option>
              <option value="Nashik" <?= (isset($_GET['district']) && $_GET['district'] == 'Nashik') ? 'selected' : '' ?>>Nashik</option>
              <option value="Nagpur" <?= (isset($_GET['district']) && $_GET['district'] == 'Nagpur') ? 'selected' : '' ?>>Nagpur</option>
              <option value="Aurangabad" <?= (isset($_GET['district']) && $_GET['district'] == 'Aurangabad') ? 'selected' : '' ?>>Aurangabad</option>
              <option value="Thane" <?= (isset($_GET['district']) && $_GET['district'] == 'Thane') ? 'selected' : '' ?>>Thane</option>
              <option value="Solapur" <?= (isset($_GET['district']) && $_GET['district'] == 'Solapur') ? 'selected' : '' ?>>Solapur</option>
              <option value="Kolhapur" <?= (isset($_GET['district']) && $_GET['district'] == 'Kolhapur') ? 'selected' : '' ?>>Kolhapur</option>
              <option value="Amravati" <?= (isset($_GET['district']) && $_GET['district'] == 'Amravati') ? 'selected' : '' ?>>Amravati</option>
              <option value="Ahmednagar" <?= (isset($_GET['district']) && $_GET['district'] == 'Ahmednagar') ? 'selected' : '' ?>>Ahmednagar</option>
              <option value="All" <?= (isset($_GET['district']) && $_GET['district'] == 'All') ? 'selected' : '' ?>>All Districts</option>
            </select>
            <button class="btn btn-custom" type="submit">Search</button>
          </div>
        </form>
      </div>

      <!-- Laboratories Display -->
      <div class="row" id="labs-container">
        <?php
        $soilLabs = [
            [
                'name' => 'Mumbai Soil Testing Center',
                'district' => 'Mumbai',
                'address' => '123 Agriculture Street, Andheri East, Mumbai - 400069',
                'contact' => '022 12345678',
                'email' => 'mumbai@soiltest.com',
                'working_hours' => '9:00 AM - 5:00 PM (Mon-Sat)',
                'testing_cost' => '500',
                'website' => 'https://www.mahaagri.gov.in' // Maharashtra Agriculture Department
            ],
            [
                'name' => 'Agro Labs Maharashtra',
                'district' => 'Mumbai',
                'address' => '45 Science Center, Powai, Mumbai - 400076',
                'contact' => '022 87654321',
                'email' => 'info@agrolabsmh.com',
                'working_hours' => '8:30 AM - 6:00 PM (Mon-Fri)',
                'testing_cost' => '450',
                'website' => 'https://www.agriculture.gov.in' // Indian Agriculture Department
            ],
            [
                'name' => 'Pune Agricultural Labs',
                'district' => 'Pune',
                'address' => '34 Farm Road, Kothrud, Pune - 411038',
                'contact' => '020 1234567',
                'email' => 'pune@agrolabs.in',
                'working_hours' => '9:00 AM - 5:00 PM (Mon-Sat)',
                'testing_cost' => '400',
                'website' => 'https://www.krishijagran.com' // Krishi Jagran (Agriculture News)
            ],
            [
                'name' => 'Maharashtra Soil Research',
                'district' => 'Pune',
                'address' => '12 Science Park, Hinjewadi, Pune - 411057',
                'contact' => '020 7654321',
                'email' => 'research@mhsoil.org',
                'working_hours' => '8:00 AM - 4:00 PM (Mon-Fri)',
                'testing_cost' => '550',
                'website' => 'https://icar.org.in' // ICAR (Indian Council of Agricultural Research)
            ],
            [
                'name' => 'Nashik Krishi Labs',
                'district' => 'Nashik',
                'address' => '78 Grape City, Nashik Road, Nashik - 422101',
                'contact' => '0253 2345678',
                'email' => 'info@nashikkrishi.com',
                'working_hours' => '10:00 AM - 6:00 PM (Mon-Sat)',
                'testing_cost' => '350',
                'website' => 'https://www.nashik.gov.in' // Nashik District Official Website
            ],
            [
                'name' => 'Godavari Soil Testing Center',
                'district' => 'Nashik',
                'address' => '23 Gangapur Road, Nashik - 422013',
                'contact' => '0253 2456789',
                'email' => 'contact@godavarisoil.com',
                'working_hours' => '9:30 AM - 5:30 PM (Mon-Fri)',
                'testing_cost' => '400',
                'website' => 'https://www.mahaagri.gov.in' // Maharashtra Agriculture Department
            ],
            [
                'name' => 'Orange City Soil Labs',
                'district' => 'Nagpur',
                'address' => '56 Orange Street, Sitabuldi, Nagpur - 440012',
                'contact' => '0712 1234567',
                'email' => 'info@orangecitylabs.com',
                'working_hours' => '9:00 AM - 4:00 PM (Mon-Sat)',
                'testing_cost' => '450',
                'website' => 'https://www.nagpur.gov.in' // Nagpur District Official Website
            ],
            [
                'name' => 'Vidarbha Soil Research Institute',
                'district' => 'Nagpur',
                'address' => '34 Agriculture College Road, Nagpur - 440001',
                'contact' => '0712 2345678',
                'email' => 'vsri@vidarbhasoil.org',
                'working_hours' => '8:30 AM - 5:30 PM (Mon-Fri)',
                'testing_cost' => '300',
                'website' => 'https://www.icar.org.in' // ICAR (Indian Council of Agricultural Research)
            ],
            [
                'name' => 'Aurangabad Soil Testing Center',
                'district' => 'Aurangabad',
                'address' => '12 Jalna Road, Aurangabad - 431001',
                'contact' => '0240 1234567',
                'email' => 'astc@aurangabadsoil.com',
                'working_hours' => '10:00 AM - 6:00 PM (Mon-Sat)',
                'testing_cost' => '500',
                'website' => 'https://aurangabad.gov.in' // Aurangabad District Official Website
            ],
            [
                'name' => 'Thane Agro Labs',
                'district' => 'Thane',
                'address' => '89 Pokhran Road, Thane West - 400606',
                'contact' => '022 25432109',
                'email' => 'info@thaneagrolabs.com',
                'working_hours' => '9:00 AM - 5:00 PM (Mon-Sat)',
                'testing_cost' => '450',
                'website' => 'https://thane.nic.in' // Thane District Official Website
            ]
        ];

        // Get selected district from URL parameter
        $selectedDistrict = isset($_GET['district']) ? trim($_GET['district']) : '';

        // Filter labs based on selection
        $filteredLabs = [];
        if (!empty($selectedDistrict)) {
          if ($selectedDistrict != 'All') {
            foreach ($soilLabs as $lab) {
              if (strcasecmp($lab['district'], $selectedDistrict) === 0) {
                $filteredLabs[] = $lab;
              }
            }
          } else {
            $filteredLabs = $soilLabs;
          }
        } else {
          // Show all labs by default if no district is selected
          $filteredLabs = $soilLabs;
        }

        // Display labs
        if (count($filteredLabs) > 0) {
          foreach ($filteredLabs as $lab) {
            echo '
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="card h-100">
                <div class="card-header">
                  <i class="fas fa-flask lab-icon"></i>' . htmlspecialchars($lab["name"]) . '
                </div>
                <div class="card-body">
                  <p><strong><i class="fas fa-map-marker-alt me-2"></i>Address:</strong> ' . htmlspecialchars($lab["address"]) . '</p>
                  <p><strong><i class="fas fa-phone me-2"></i>Contact:</strong> ' . htmlspecialchars($lab["contact"]) . '</p>
                  <p><strong><i class="fas fa-envelope me-2"></i>Email:</strong> ' . htmlspecialchars($lab["email"]) . '</p>
                  <p><strong><i class="fas fa-clock me-2"></i>Working Hours:</strong> ' . htmlspecialchars($lab["working_hours"]) . '</p>
                  <p><strong><i class="fas fa-rupee-sign me-2"></i>Testing Cost:</strong> ₹' . htmlspecialchars($lab["testing_cost"]) . '</p>
                  <a href="' . htmlspecialchars($lab["website"]) . '" target="_blank" class="btn btn-custom btn-sm mt-2">
                    <i class="fas fa-globe me-1"></i> Visit Website
                  </a>
                </div>
              </div>
            </div>';
          }
        } else {
          echo '<div class="col-12">
                  <div class="no-labs-found">
                    <i class="fas fa-info-circle fa-2x mb-3" style="color: var(--accent);"></i>
                    <h4>No laboratories found</h4>
                    <p>We couldn\'t find any soil testing labs for the selected district.</p>
                    <a href="?district=All" class="btn btn-custom">View All Labs</a>
                  </div>
                </div>';
        }
        ?>
      </div>
    </div>
  </section>

 <!-- Footer -->
 <!-- <footer class="text-white">
    <div class="container">
      <div class="row text-center text-md-start">
        <div class="col-md-4 mb-4">
          <h5>About Us</h5>
          <p>We provide AI-based solutions for farmers to make agriculture more efficient, smart, and data-driven.</p>
        </div>
        <div class="col-md-4 mb-4">
          <h5>Contact Us</h5>
          <p>Email: support@aifarming.com</p>
          <p>Phone: +91 98765 43210</p>
          <p>Address: Mumbai, India</p>
        </div>
        <div class="col-md-4 mb-4">
          <h5>Follow Us</h5>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <hr class="bg-white" />
      <p class="text-center mb-0">© 2025 AI-Powered Farming Solutions. All rights reserved.</p>
    </div>
  </footer> -->

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>