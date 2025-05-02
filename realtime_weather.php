<?php
// weather.php
$page_title = "Weather Monitoring | AI-Powered Farming Solutions";
$active_page = "weather"; // For navbar highlighting
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $page_title; ?></title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

    .navbar {
      background-color: var(--accent);
    }

    .navbar-brand,
    .nav-link {
      color: white !important;
    }

    .dashboard-header {
      background: linear-gradient(to right, var(--secondary), #ffffff);
      padding: 40px 20px;
      margin-bottom: 30px;
    }

    .dashboard-header h1 {
      color: var(--accent);
      font-size: 2.5rem;
      font-weight: bold;
    }

    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
      margin-bottom: 20px;
      height: 100%;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card-header {
      background-color: var(--primary);
      color: white;
      border-radius: 12px 12px 0 0 !important;
      font-weight: bold;
    }

    .btn-custom {
      background-color: var(--primary);
      color: white;
      border-radius: 30px;
      padding: 8px 20px;
    }

    .btn-custom:hover {
      background-color: var(--accent);
    }

    .weather-icon {
      font-size: 3rem;
      margin-bottom: 15px;
    }

    .temperature-display {
      font-size: 3.5rem;
      font-weight: bold;
    }

    .weather-details {
      border-top: 1px solid #eee;
      padding-top: 15px;
      margin-top: 15px;
    }

    .chart-container {
      position: relative;
      height: 300px;
      width: 100%;
    }

    @media (max-width: 767px) {
      .dashboard-header h1 {
        font-size: 2rem;
      }
      .temperature-display {
        font-size: 2.5rem;
      }
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <i class="fas fa-leaf me-2"></i>AGRIAID
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?php echo $active_page === 'crops' ? 'active' : ''; ?>" href="management.php">
              <i class="fas fa-seedling me-1"></i> Crop Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $active_page === 'weather' ? 'active' : ''; ?>" href="weather.php">
              <i class="fas fa-cloud-sun me-1"></i> Weather
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Dashboard Header -->
  <section class="dashboard-header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h1>Real-Time Weather Monitoring</h1>
          <p class="lead">Track temperature and weather conditions for your farm location</p>
        </div>
        <div class="col-md-4 text-md-end">
          <button class="btn btn-custom" id="refreshWeather">
            <i class="fas fa-sync-alt me-2"></i>Refresh Data
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Dashboard Content -->
  <section class="dashboard-content mb-5">
    <div class="container">
      <div class="row">
        <!-- Current Weather -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <i class="fas fa-cloud-sun me-2"></i> Current Conditions
            </div>
            <div class="card-body text-center">
              <div id="weatherIcon" class="weather-icon">
                <i class="fas fa-spinner fa-spin"></i>
              </div>
              <div id="temperature" class="temperature-display">--°C</div>
              <div id="weatherDescription" class="mb-3">Loading...</div>
              
              <div class="weather-details">
                <div class="row">
                  <div class="col-6">
                    <p><i class="fas fa-tint me-2"></i> Humidity</p>
                    <h5 id="humidity">--%</h5>
                  </div>
                  <div class="col-6">
                    <p><i class="fas fa-wind me-2"></i> Wind</p>
                    <h5 id="windSpeed">-- km/h</h5>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-6">
                    <p><i class="fas fa-sun me-2"></i> Sunrise</p>
                    <h5 id="sunrise">--:--</h5>
                  </div>
                  <div class="col-6">
                    <p><i class="fas fa-moon me-2"></i> Sunset</p>
                    <h5 id="sunset">--:--</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="card mt-4">
            <div class="card-header">
              <i class="fas fa-map-marker-alt me-2"></i> Location
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label for="locationInput" class="form-label">Enter Location</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="locationInput" placeholder="City, Country">
                  <button class="btn btn-custom" type="button" id="searchLocation">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
              <div id="locationDetails">
                <p class="mb-1"><strong>Current Location:</strong></p>
                <p id="currentLocation">Loading...</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Temperature Chart -->
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header">
              <i class="fas fa-chart-line me-2"></i> 24-Hour Temperature Forecast
            </div>
            <div class="card-body">
              <div class="chart-container">
                <canvas id="temperatureChart"></canvas>
              </div>
            </div>
          </div>
          
          <div class="card mt-4">
            <div class="card-header">
              <i class="fas fa-info-circle me-2"></i> Weather Alerts
            </div>
            <div class="card-body">
              <div id="weatherAlerts">
                <div class="alert alert-warning">
                  <i class="fas fa-exclamation-triangle me-2"></i>
                  <strong>No active alerts</strong> - Weather conditions are normal for farming activities
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-white">
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
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Weather Dashboard Scripts -->
  <script>
    // Configuration
    const API_KEY = '4bdbd5c7f2ecbfc4c340ad562fac9a12'; // Replace with your actual key
    const DEFAULT_LOCATION = 'Mumbai,IN'; // Default location
    
    // DOM Elements
    const locationInput = document.getElementById('locationInput');
    const searchLocationBtn = document.getElementById('searchLocation');
    const refreshWeatherBtn = document.getElementById('refreshWeather');
    
    // Initialize temperature chart
    const tempCtx = document.getElementById('temperatureChart').getContext('2d');
    const temperatureChart = new Chart(tempCtx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [{
          label: 'Temperature (°C)',
          data: [],
          backgroundColor: 'rgba(74, 124, 124, 0.2)',
          borderColor: 'rgba(74, 124, 124, 1)',
          borderWidth: 2,
          tension: 0.4,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: false
          }
        }
      }
    });
    
    // Weather icon mapping
    const weatherIcons = {
      '01d': 'fas fa-sun',       // clear sky (day)
      '01n': 'fas fa-moon',      // clear sky (night)
      '02d': 'fas fa-cloud-sun', // few clouds (day)
      '02n': 'fas fa-cloud-moon',// few clouds (night)
      '03d': 'fas fa-cloud',     // scattered clouds
      '03n': 'fas fa-cloud',
      '04d': 'fas fa-cloud',     // broken clouds
      '04n': 'fas fa-cloud',
      '09d': 'fas fa-cloud-rain',// shower rain
      '09n': 'fas fa-cloud-rain',
      '10d': 'fas fa-cloud-sun-rain', // rain (day)
      '10n': 'fas fa-cloud-moon-rain',// rain (night)
      '11d': 'fas fa-bolt',      // thunderstorm
      '11n': 'fas fa-bolt',
      '13d': 'fas fa-snowflake', // snow
      '13n': 'fas fa-snowflake',
      '50d': 'fas fa-smog',      // mist
      '50n': 'fas fa-smog'
    };
    
    // Fetch weather data from OpenWeatherMap API
    async function fetchWeatherData(location = DEFAULT_LOCATION) {
      try {
        // Show loading states
        document.getElementById('weatherIcon').innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        document.getElementById('temperature').textContent = '--°C';
        document.getElementById('weatherDescription').textContent = 'Loading...';
        
        // First get coordinates from location name
        const geoResponse = await fetch(
          `https://api.openweathermap.org/geo/1.0/direct?q=${location}&limit=1&appid=${API_KEY}`
        );
        
        if (!geoResponse.ok) throw new Error('Location service failed');
        const geoData = await geoResponse.json();
        
        if (geoData.length === 0) throw new Error('Location not found');
        
        const { lat, lon, name, country } = geoData[0];
        
        // Then get current weather
        const currentResponse = await fetch(
          `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&appid=${API_KEY}`
        );
        
        if (!currentResponse.ok) throw new Error('Weather service failed');
        const currentData = await currentResponse.json();
        
        // Update current weather display
        updateCurrentWeather(currentData, name, country);
        
        // Get forecast for chart
        const forecastResponse = await fetch(
          `https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lon}&units=metric&appid=${API_KEY}`
        );
        
        if (!forecastResponse.ok) throw new Error('Forecast service failed');
        const forecastData = await forecastResponse.json();
        updateForecastChart(forecastData);
        
      } catch (error) {
        console.error('Error:', error);
        alert('Error: ' + error.message);
        document.getElementById('weatherDescription').textContent = error.message;
      }
    }
    
    // Update current weather display
    function updateCurrentWeather(data, city, country) {
      // Location
      document.getElementById('currentLocation').textContent = `${city}, ${country}`;
      
      // Temperature
      document.getElementById('temperature').textContent = `${Math.round(data.main.temp)}°C`;
      
      // Weather description
      const description = data.weather[0].description;
      document.getElementById('weatherDescription').textContent = 
        description.charAt(0).toUpperCase() + description.slice(1);
      
      // Weather icon
      const iconCode = data.weather[0].icon;
      document.getElementById('weatherIcon').innerHTML = 
        `<i class="${weatherIcons[iconCode] || 'fas fa-cloud'}"></i>`;
      
      // Additional details
      document.getElementById('humidity').textContent = `${data.main.humidity}%`;
      document.getElementById('windSpeed').textContent = `${(data.wind.speed * 3.6).toFixed(1)} km/h`;
      
      // Sunrise/sunset
      const sunriseTime = new Date(data.sys.sunrise * 1000);
      const sunsetTime = new Date(data.sys.sunset * 1000);
      document.getElementById('sunrise').textContent = 
        sunriseTime.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
      document.getElementById('sunset').textContent = 
        sunsetTime.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
      
      // Update alerts
      updateWeatherAlerts(data);
    }
    
    // Update forecast chart
    function updateForecastChart(data) {
      const hourlyData = data.list.slice(0, 8); // Next 24 hours (3-hour intervals)
      
      const labels = hourlyData.map(item => {
        const date = new Date(item.dt * 1000);
        return date.toLocaleTimeString([], {hour: '2-digit'});
      });
      
      const temps = hourlyData.map(item => item.main.temp);
      
      temperatureChart.data.labels = labels;
      temperatureChart.data.datasets[0].data = temps;
      temperatureChart.update();
    }
    
    // Update weather alerts
    function updateWeatherAlerts(data) {
      const alertsContainer = document.getElementById('weatherAlerts');
      const weatherMain = data.weather[0].main;
      const temp = data.main.temp;
      
      let alertHtml = '';
      
      if (weatherMain === 'Thunderstorm') {
        alertHtml = `
          <div class="alert alert-danger">
            <i class="fas fa-bolt me-2"></i>
            <strong>Thunderstorm Warning!</strong> - Avoid field work until storm passes
          </div>
        `;
      } else if (data.wind.speed > 10) {
        alertHtml = `
          <div class="alert alert-warning">
            <i class="fas fa-wind me-2"></i>
            <strong>High Winds</strong> - Secure equipment and protect sensitive crops
          </div>
        `;
      } else if (temp > 35) {
        alertHtml = `
          <div class="alert alert-warning">
            <i class="fas fa-temperature-high me-2"></i>
            <strong>High Temperature</strong> - Increase irrigation to prevent heat stress
          </div>
        `;
      } else if (temp < 5) {
        alertHtml = `
          <div class="alert alert-info">
            <i class="fas fa-temperature-low me-2"></i>
            <strong>Low Temperature</strong> - Protect sensitive plants from frost
          </div>
        `;
      } else {
        alertHtml = `
          <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Optimal Conditions</strong> - Weather is favorable for farming activities
          </div>
        `;
      }
      
      alertsContainer.innerHTML = alertHtml;
    }
    
    // Event Listeners
    searchLocationBtn.addEventListener('click', () => {
      if (locationInput.value.trim()) {
        fetchWeatherData(locationInput.value.trim());
      }
    });
    
    refreshWeatherBtn.addEventListener('click', () => {
      const currentLocation = document.getElementById('currentLocation').textContent;
      fetchWeatherData(currentLocation);
    });
    
    // Initialize with default location
    fetchWeatherData();
  </script>
</body>
</html>