<?php
session_start();

// Initialize session arrays if they don't exist
if (!isset($_SESSION['crops'])) {
    $_SESSION['crops'] = [];
    $_SESSION['pest_alerts'] = [];
    $_SESSION['activities'] = [];

    // Sample initial data
    $_SESSION['crops'] = [
        [
            'id' => 'crop1',
            'crop_name' => 'Wheat',
            'crop_type' => 'Cereal',
            'planting_date' => date('Y-m-d', strtotime('-2 months')),
            'harvest_date' => date('Y-m-d', strtotime('+3 months')),
            'area' => 5.5,
            'status' => 'Growing',
            'notes' => 'Planted in north field',
            'last_irrigation' => date('Y-m-d', strtotime('-8 days')) // Needs irrigation
        ],
        [
            'id' => 'crop2',
            'crop_name' => 'Tomatoes',
            'crop_type' => 'Vegetable',
            'planting_date' => date('Y-m-d', strtotime('-1 month')),
            'harvest_date' => date('Y-m-d', strtotime('+2 months')),
            'area' => 2.0,
            'status' => 'Growing',
            'notes' => 'Greenhouse variety',
            'last_irrigation' => date('Y-m-d') // Irrigated today
        ]
    ];

    $_SESSION['activities'] = [
        [
            'id' => 'act1',
            'crop_id' => 'crop1',
            'activity_type' => 'Irrigation',
            'description' => 'Irrigated Wheat field (5.5 acres)',
            'activity_date' => date('Y-m-d H:i:s', strtotime('-8 days'))
        ],
        [
            'id' => 'act2',
            'crop_id' => 'crop2',
            'activity_type' => 'Planting',
            'description' => 'Planted Tomatoes (Vegetable) in 2 acres',
            'activity_date' => date('Y-m-d H:i:s', strtotime('-1 month'))
        ]
    ];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add new crop
    if (isset($_POST['add_crop'])) {
        $new_crop = [
            'id' => uniqid(),
            'crop_name' => htmlspecialchars($_POST['crop_name']),
            'crop_type' => htmlspecialchars($_POST['crop_type']),
            'planting_date' => $_POST['planting_date'],
            'harvest_date' => $_POST['harvest_date'] ?? null,
            'area' => $_POST['area'] ?? null,
            'status' => $_POST['status'],
            'notes' => htmlspecialchars($_POST['notes'] ?? ''),
            'last_irrigation' => null
        ];
        
        $_SESSION['crops'][] = $new_crop;
        
        // Add planting activity
        $activity_desc = "Planted {$new_crop['crop_name']} ({$new_crop['crop_type']}) in " . 
                        ($new_crop['area'] ? "{$new_crop['area']} acres" : "unspecified area");
        
        $_SESSION['activities'][] = [
            'id' => uniqid(),
            'crop_id' => $new_crop['id'],
            'activity_type' => 'Planting',
            'description' => $activity_desc,
            'activity_date' => date('Y-m-d H:i:s')
        ];
        
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
    
    // Update crop
    if (isset($_POST['update_crop'])) {
        $id = $_POST['crop_id'];
        foreach ($_SESSION['crops'] as &$crop) {
            if ($crop['id'] === $id) {
                $crop['crop_name'] = htmlspecialchars($_POST['crop_name']);
                $crop['crop_type'] = htmlspecialchars($_POST['crop_type']);
                $crop['planting_date'] = $_POST['planting_date'];
                $crop['harvest_date'] = $_POST['harvest_date'] ?? null;
                $crop['area'] = $_POST['area'] ?? null;
                $crop['status'] = $_POST['status'];
                $crop['notes'] = htmlspecialchars($_POST['notes'] ?? '');
                break;
            }
        }
        unset($crop);
        
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
    
    // Add pest alert
    if (isset($_POST['add_pest_alert'])) {
        $crop_id = $_POST['crop_id'];
        $new_pest = [
            'id' => uniqid(),
            'crop_id' => $crop_id,
            'pest_name' => htmlspecialchars($_POST['pest_name']),
            'severity' => $_POST['severity'],
            'detected_date' => $_POST['detected_date'],
            'status' => 'Unresolved',
            'notes' => htmlspecialchars($_POST['notes'] ?? '')
        ];
        
        $_SESSION['pest_alerts'][] = $new_pest;
        
        // Find crop name
        $crop_name = '';
        foreach ($_SESSION['crops'] as $crop) {
            if ($crop['id'] === $crop_id) {
                $crop_name = $crop['crop_name'];
                break;
            }
        }
        
        // Add activity log
        $activity_desc = "Pest detected: {$new_pest['pest_name']} (Severity: {$new_pest['severity']}) in $crop_name";
        
        $_SESSION['activities'][] = [
            'id' => uniqid(),
            'crop_id' => $crop_id,
            'activity_type' => 'Pest Control',
            'description' => $activity_desc,
            'activity_date' => date('Y-m-d H:i:s')
        ];
        
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
    
    // Resolve pest alert
    if (isset($_POST['resolve_pest'])) {
        $pest_id = $_POST['pest_id'];
        foreach ($_SESSION['pest_alerts'] as &$pest) {
            if ($pest['id'] === $pest_id) {
                $pest['status'] = 'Resolved';
                break;
            }
        }
        unset($pest);
        
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
    
    // Mark irrigation as done
    if (isset($_POST['mark_irrigated'])) {
        $crop_id = $_POST['crop_id'];
        foreach ($_SESSION['crops'] as &$crop) {
            if ($crop['id'] === $crop_id) {
                $crop['last_irrigation'] = date('Y-m-d');
                
                // Add activity log
                $activity_desc = "Irrigated {$crop['crop_name']} field" . 
                                ($crop['area'] ? " ({$crop['area']} acres)" : "");
                
                $_SESSION['activities'][] = [
                    'id' => uniqid(),
                    'crop_id' => $crop_id,
                    'activity_type' => 'Irrigation',
                    'description' => $activity_desc,
                    'activity_date' => date('Y-m-d H:i:s')
                ];
                break;
            }
        }
        unset($crop);
        
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

// Handle delete actions
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $_SESSION['crops'] = array_filter($_SESSION['crops'], function($crop) use ($id) {
        return $crop['id'] !== $id;
    });
    
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

if (isset($_GET['delete_pest'])) {
    $id = $_GET['delete_pest'];
    $_SESSION['pest_alerts'] = array_filter($_SESSION['pest_alerts'], function($pest) use ($id) {
        return $pest['id'] !== $id;
    });
    
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Get counts for summary cards
$active_crops = count(array_filter($_SESSION['crops'], function($crop) {
    return $crop['status'] === 'Growing';
}));

$harvests_this_month = count(array_filter($_SESSION['crops'], function($crop) {
    return $crop['status'] === 'Harvested' && 
           date('m', strtotime($crop['harvest_date'])) === date('m');
}));

// Get crops needing irrigation (last irrigation > 7 days ago or never irrigated)
$irrigation_due = array_filter($_SESSION['crops'], function($crop) {
    if ($crop['status'] !== 'Growing') return false;
    if (!$crop['last_irrigation']) return true;
    $last_irrigation = new DateTime($crop['last_irrigation']);
    $today = new DateTime();
    $interval = $today->diff($last_irrigation);
    return $interval->days > 7;
});

$pest_alerts_count = count(array_filter($_SESSION['pest_alerts'], function($pest) {
    return $pest['status'] === 'Unresolved';
}));

// Get recent activities (sorted by date)
$recent_activities = $_SESSION['activities'];
usort($recent_activities, function($a, $b) {
    return strtotime($b['activity_date']) - strtotime($a['activity_date']);
});
$recent_activities = array_slice($recent_activities, 0, 4);

// Get unresolved pest alerts (sorted by date)
$unresolved_pests = array_filter($_SESSION['pest_alerts'], function($pest) {
    return $pest['status'] === 'Unresolved';
});
usort($unresolved_pests, function($a, $b) {
    return strtotime($b['detected_date']) - strtotime($a['detected_date']);
});
$unresolved_pests = array_slice($unresolved_pests, 0, 3);

// Add crop names to pest alerts and activities
foreach ($unresolved_pests as &$pest) {
    foreach ($_SESSION['crops'] as $crop) {
        if ($crop['id'] === $pest['crop_id']) {
            $pest['crop_name'] = $crop['crop_name'];
            break;
        }
    }
}
unset($pest);

foreach ($recent_activities as &$activity) {
    if ($activity['crop_id']) {
        foreach ($_SESSION['crops'] as $crop) {
            if ($crop['id'] === $activity['crop_id']) {
                $activity['crop_name'] = $crop['crop_name'];
                break;
            }
        }
    }
}
unset($activity);

// Prepare data for growth chart
$crop_growth_data = [];
$crop_labels = [];
foreach ($_SESSION['crops'] as $crop) {
    if ($crop['status'] === 'Growing') {
        $crop_labels[] = $crop['crop_name'];
        
        // Simulate growth percentage based on planting date
        $planting_date = new DateTime($crop['planting_date']);
        $today = new DateTime();
        $days_since_planting = $today->diff($planting_date)->days;
        
        // Assume 120 days to full growth for simulation
        $growth_percentage = min(100, ($days_since_planting / 120) * 100);
        $crop_growth_data[] = round($growth_percentage);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Crop Management Dashboard | AI-Powered Farming Solutions</title>
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
    .navbar-brand, .nav-link {
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
    .btn-danger {
      border-radius: 30px;
    }
    .table-responsive {
      border-radius: 12px;
      overflow: hidden;
    }
    .table thead {
      background-color: var(--primary);
      color: white;
    }
    .status-badge {
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: bold;
    }
    .status-active {
      background-color: #d4edda;
      color: #155724;
    }
    .status-harvested {
      background-color: #fff3cd;
      color: #856404;
    }
    .status-planned {
      background-color: #d1ecf1;
      color: #0c5460;
    }
    .severity-low {
      background-color: #d4edda;
      color: #155724;
    }
    .severity-medium {
      background-color: #fff3cd;
      color: #856404;
    }
    .severity-high {
      background-color: #f8d7da;
      color: #721c24;
    }
    .chart-container {
      position: relative;
      height: 300px;
      width: 100%;
    }
    .action-btn {
      margin: 0 3px;
    }
    .chart-color-1 { background-color: #4a7c7c; }
    .chart-color-2 { background-color: #70a1a1; }
    .chart-color-3 { background-color: #9abfbf; }
    .chart-color-4 { background-color: #c4dddd; }
    .irrigation-alert {
      background-color: #fff3cd;
      border-left: 4px solid #ffc107;
    }
    .irrigation-list {
      max-height: 200px;
      overflow-y: auto;
    }
    @media (max-width: 767px) {
      .dashboard-header h1 {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <?php include('nav.php'); ?>

  <!-- Dashboard Header -->
  <section class="dashboard-header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h1>Crop Management Dashboard</h1>
          <p class="lead">Monitor and manage all your crops in one place</p>
        </div>
        <div class="col-md-4 text-md-end">
          <button class="btn btn-custom me-2" data-bs-toggle="modal" data-bs-target="#addCropModal">
            <i class="fas fa-plus me-2"></i>Add Crop
          </button>
          <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addPestModal">
            <i class="fas fa-bug me-2"></i>Report Pest
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Dashboard Content -->
  <section class="dashboard-content mb-5">
    <div class="container">
      <div class="row">
        <!-- Summary Cards -->
        <div class="col-md-6 col-lg-3">
          <div class="card">
            <div class="card-body text-center">
              <i class="fas fa-seedling fa-3x mb-3" style="color: var(--primary);"></i>
              <h3 class="mb-2"><?= $active_crops ?></h3>
              <p class="mb-0">Active Crops</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card">
            <div class="card-body text-center">
              <i class="fas fa-calendar-check fa-3x mb-3" style="color: var(--primary);"></i>
              <h3 class="mb-2"><?= $harvests_this_month ?></h3>
              <p class="mb-0">Harvests This Month</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card">
            <div class="card-body text-center">
              <i class="fas fa-tint fa-3x mb-3" style="color: var(--primary);"></i>
              <h3 class="mb-2"><?= count($irrigation_due) ?></h3>
              <p class="mb-0">Irrigation Due</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card">
            <div class="card-body text-center">
              <i class="fas fa-bug fa-3x mb-3" style="color: var(--primary);"></i>
              <h3 class="mb-2"><?= $pest_alerts_count ?></h3>
              <p class="mb-0">Pest Alerts</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <!-- Main Content -->
        <div class="col-lg-8">
          <!-- Irrigation Due Alert -->
          <?php if (count($irrigation_due) > 0): ?>
          <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
              <i class="fas fa-tint me-2"></i> Irrigation Due
            </div>
            <div class="card-body">
              <div class="irrigation-list">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Crop</th>
                      <th>Last Irrigation</th>
                      <th>Days Since</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($irrigation_due as $crop): ?>
                    <tr class="irrigation-alert">
                      <td><?= htmlspecialchars($crop['crop_name']) ?></td>
                      <td>
                        <?= $crop['last_irrigation'] ? date('M d, Y', strtotime($crop['last_irrigation'])) : 'Never' ?>
                      </td>
                      <td>
                        <?php 
                          if ($crop['last_irrigation']) {
                            $last = new DateTime($crop['last_irrigation']);
                            $today = new DateTime();
                            echo $today->diff($last)->days;
                          } else {
                            echo 'N/A';
                          }
                        ?>
                      </td>
                      <td>
                        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" style="display: inline;">
                          <input type="hidden" name="crop_id" value="<?= $crop['id'] ?>">
                          <button type="submit" name="mark_irrigated" class="btn btn-sm btn-success">
                            <i class="fas fa-check me-1"></i> Mark Done
                          </button>
                        </form>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <!-- Your Crops Table -->
          <div class="card">
            <div class="card-header">
              <i class="fas fa-table me-2"></i> Your Crops
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Crop Name</th>
                      <th>Type</th>
                      <th>Planting Date</th>
                      <th>Harvest Date</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($_SESSION['crops'] as $crop): ?>
                    <tr>
                      <td><?= htmlspecialchars($crop['crop_name']) ?></td>
                      <td><?= htmlspecialchars($crop['crop_type']) ?></td>
                      <td><?= date('d M Y', strtotime($crop['planting_date'])) ?></td>
                      <td><?= $crop['harvest_date'] ? date('d M Y', strtotime($crop['harvest_date'])) : 'N/A' ?></td>
                      <td>
                        <?php 
                          $status_class = '';
                          if ($crop['status'] === 'Growing') $status_class = 'status-active';
                          elseif ($crop['status'] === 'Harvested') $status_class = 'status-harvested';
                          else $status_class = 'status-planned';
                        ?>
                        <span class="status-badge <?= $status_class ?>"><?= $crop['status'] ?></span>
                      </td>
                      <td>
                        <button class="btn btn-sm btn-custom action-btn view-crop" 
                                data-id="<?= $crop['id'] ?>"
                                data-name="<?= htmlspecialchars($crop['crop_name']) ?>"
                                data-type="<?= htmlspecialchars($crop['crop_type']) ?>"
                                data-planting="<?= $crop['planting_date'] ?>"
                                data-harvest="<?= $crop['harvest_date'] ?>"
                                data-area="<?= $crop['area'] ?>"
                                data-status="<?= $crop['status'] ?>"
                                data-notes="<?= htmlspecialchars($crop['notes']) ?>">
                          <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-primary action-btn edit-crop" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editCropModal"
                                data-id="<?= $crop['id'] ?>"
                                data-name="<?= htmlspecialchars($crop['crop_name']) ?>"
                                data-type="<?= htmlspecialchars($crop['crop_type']) ?>"
                                data-planting="<?= $crop['planting_date'] ?>"
                                data-harvest="<?= $crop['harvest_date'] ?>"
                                data-area="<?= $crop['area'] ?>"
                                data-status="<?= $crop['status'] ?>"
                                data-notes="<?= htmlspecialchars($crop['notes']) ?>">
                          <i class="fas fa-edit"></i>
                        </button>
                        <a href="<?= $_SERVER['PHP_SELF'] ?>?delete=<?= $crop['id'] ?>" class="btn btn-sm btn-outline-danger action-btn" onclick="return confirm('Are you sure you want to delete this crop?')">
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Pest Alerts Section -->
          <?php if (count($unresolved_pests) > 0): ?>
          <div class="card mt-4">
            <div class="card-header bg-danger text-white">
              <i class="fas fa-exclamation-triangle me-2"></i> Active Pest Alerts
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead class="bg-danger text-white">
                    <tr>
                      <th>Pest Name</th>
                      <th>Crop Affected</th>
                      <th>Severity</th>
                      <th>Detected On</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($unresolved_pests as $pest): ?>
                    <tr>
                      <td><?= htmlspecialchars($pest['pest_name']) ?></td>
                      <td><?= htmlspecialchars($pest['crop_name']) ?></td>
                      <td>
                        <span class="status-badge severity-<?= strtolower($pest['severity']) ?>">
                          <?= $pest['severity'] ?>
                        </span>
                      </td>
                      <td><?= date('d M Y', strtotime($pest['detected_date'])) ?></td>
                      <td>
                        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" style="display: inline;">
                          <input type="hidden" name="pest_id" value="<?= $pest['id'] ?>">
                          <button type="submit" name="resolve_pest" class="btn btn-sm btn-success action-btn">
                            <i class="fas fa-check"></i> Resolve
                          </button>
                        </form>
                        <a href="<?= $_SERVER['PHP_SELF'] ?>?delete_pest=<?= $pest['id'] ?>" class="btn btn-sm btn-outline-danger action-btn" onclick="return confirm('Are you sure you want to delete this pest alert?')">
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
          <!-- Growth Progress -->
          <div class="card">
            <div class="card-header">
              <i class="fas fa-chart-line me-2"></i> Crop Growth Progress
            </div>
            <div class="card-body">
              <div class="chart-container">
                <canvas id="growthChart"></canvas>
              </div>
            </div>
          </div>

          <!-- Recent Activities -->
          <div class="card mt-4">
            <div class="card-header">
              <i class="fas fa-bell me-2"></i> Recent Activities
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <?php foreach ($recent_activities as $activity): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span><?= htmlspecialchars($activity['description']) ?></span>
                  <small class="text-muted"><?= date('d M H:i', strtotime($activity['activity_date'])) ?></small>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>

          <!-- Recent Listings -->
          <div class="col-md-6">
            <h4>Recent Listings</h4>
            <div class="card product-card">
              <img src="https://organicmandya.com/cdn/shop/files/WheatWhole_2_de1e8667-567f-47bb-98e8-9b8523c6ba86.jpg?v=1739511433&width=1500" class="card-img-top product-img" alt="Wheat">
              <div class="card-body">
                <h5 class="card-title">Organic Wheat</h5>
                <p class="card-text">High quality wheat from Punjab. 1000kg available.</p>
                <p><strong>₹22/kg</strong> | Location: Ludhiana, Punjab</p>
                <a href="#" class="btn btn-custom">Contact Seller</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Add Crop Modal -->
  <div class="modal fade" id="addCropModal" tabindex="-1" aria-labelledby="addCropModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCropModalLabel">Add New Crop</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
          <div class="modal-body">
            <div class="mb-3">
              <label for="crop_name" class="form-label">Crop Name *</label>
              <input type="text" class="form-control" id="crop_name" name="crop_name" required>
            </div>
            <div class="mb-3">
              <label for="crop_type" class="form-label">Crop Type *</label>
              <select class="form-select" id="crop_type" name="crop_type" required>
                <option value="">Select crop type</option>
                <option value="Cereal">Cereal</option>
                <option value="Pulse">Pulse</option>
                <option value="Vegetable">Vegetable</option>
                <option value="Fruit">Fruit</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="planting_date" class="form-label">Planting Date *</label>
                <input type="date" class="form-control" id="planting_date" name="planting_date" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="harvest_date" class="form-label">Expected Harvest Date</label>
                <input type="date" class="form-control" id="harvest_date" name="harvest_date">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="area" class="form-label">Area (acres)</label>
                <input type="number" class="form-control" id="area" name="area" step="0.1">
              </div>
              <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status *</label>
                <select class="form-select" id="status" name="status" required>
                  <option value="Planned">Planned</option>
                  <option value="Growing" selected>Growing</option>
                  <option value="Harvested">Harvested</option>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label for="notes" class="form-label">Notes</label>
              <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-custom" name="add_crop">Save Crop</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Crop Modal -->
  <div class="modal fade" id="editCropModal" tabindex="-1" aria-labelledby="editCropModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCropModalLabel">Edit Crop</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
          <input type="hidden" id="edit_crop_id" name="crop_id">
          <div class="modal-body">
            <div class="mb-3">
              <label for="edit_crop_name" class="form-label">Crop Name *</label>
              <input type="text" class="form-control" id="edit_crop_name" name="crop_name" required>
            </div>
            <div class="mb-3">
              <label for="edit_crop_type" class="form-label">Crop Type *</label>
              <select class="form-select" id="edit_crop_type" name="crop_type" required>
                <option value="Cereal">Cereal</option>
                <option value="Pulse">Pulse</option>
                <option value="Vegetable">Vegetable</option>
                <option value="Fruit">Fruit</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="edit_planting_date" class="form-label">Planting Date *</label>
                <input type="date" class="form-control" id="edit_planting_date" name="planting_date" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="edit_harvest_date" class="form-label">Expected Harvest Date</label>
                <input type="date" class="form-control" id="edit_harvest_date" name="harvest_date">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="edit_area" class="form-label">Area (acres)</label>
                <input type="number" class="form-control" id="edit_area" name="area" step="0.1">
              </div>
              <div class="col-md-6 mb-3">
                <label for="edit_status" class="form-label">Status *</label>
                <select class="form-select" id="edit_status" name="status" required>
                  <option value="Planned">Planned</option>
                  <option value="Growing">Growing</option>
                  <option value="Harvested">Harvested</option>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label for="edit_notes" class="form-label">Notes</label>
              <textarea class="form-control" id="edit_notes" name="notes" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-custom" name="update_crop">Update Crop</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Add Pest Alert Modal -->
  <div class="modal fade" id="addPestModal" tabindex="-1" aria-labelledby="addPestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="addPestModalLabel">Report New Pest</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
          <div class="modal-body">
            <div class="mb-3">
              <label for="pest_crop" class="form-label">Affected Crop *</label>
              <select class="form-select" id="pest_crop" name="crop_id" required>
                <option value="">Select crop</option>
                <?php foreach ($_SESSION['crops'] as $crop): ?>
                  <option value="<?= $crop['id'] ?>"><?= htmlspecialchars($crop['crop_name']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="pest_name" class="form-label">Pest Name *</label>
              <input type="text" class="form-control" id="pest_name" name="pest_name" required>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="severity" class="form-label">Severity *</label>
                <select class="form-select" id="severity" name="severity" required>
                  <option value="Low">Low</option>
                  <option value="Medium" selected>Medium</option>
                  <option value="High">High</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="detected_date" class="form-label">Detected Date *</label>
                <input type="date" class="form-control" id="detected_date" name="detected_date" required value="<?= date('Y-m-d') ?>">
              </div>
            </div>
            <div class="mb-3">
              <label for="pest_notes" class="form-label">Notes</label>
              <textarea class="form-control" id="pest_notes" name="notes" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" name="add_pest_alert">Report Pest</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- View Crop Modal -->
  <div class="modal fade" id="viewCropModal" tabindex="-1" aria-labelledby="viewCropModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewCropModalLabel">Crop Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <p><strong>Crop Name:</strong></p>
              <p id="view_crop_name"></p>
            </div>
            <div class="col-md-6">
              <p><strong>Crop Type:</strong></p>
              <p id="view_crop_type"></p>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <p><strong>Planting Date:</strong></p>
              <p id="view_planting_date"></p>
            </div>
            <div class="col-md-6">
              <p><strong>Harvest Date:</strong></p>
              <p id="view_harvest_date"></p>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <p><strong>Area:</strong></p>
              <p id="view_area"></p>
            </div>
            <div class="col-md-6">
              <p><strong>Status:</strong></p>
              <p id="view_status"></p>
            </div>
          </div>
          <div class="mb-3">
            <p><strong>Notes:</strong></p>
            <p id="view_notes" class="text-muted"></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Custom Scripts -->
  <script>
    // Initialize growth chart with actual crop data
    const growthCtx = document.getElementById('growthChart').getContext('2d');
    const growthChart = new Chart(growthCtx, {
      type: 'bar',
      data: {
        labels: <?= json_encode($crop_labels) ?>,
        datasets: [{
          label: 'Growth Progress (%)',
          data: <?= json_encode($crop_growth_data) ?>,
          backgroundColor: [
            '#4a7c7c',
            '#70a1a1',
            '#9abfbf',
            '#c4dddd',
            '#e8f4f4'
          ],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            max: 100,
            ticks: {
              callback: function(value) {
                return value + '%';
              }
            }
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });

    // Edit crop modal handler
    document.querySelectorAll('.edit-crop').forEach(button => {
      button.addEventListener('click', function() {
        document.getElementById('edit_crop_id').value = this.getAttribute('data-id');
        document.getElementById('edit_crop_name').value = this.getAttribute('data-name');
        document.getElementById('edit_crop_type').value = this.getAttribute('data-type');
        document.getElementById('edit_planting_date').value = this.getAttribute('data-planting');
        document.getElementById('edit_harvest_date').value = this.getAttribute('data-harvest');
        document.getElementById('edit_area').value = this.getAttribute('data-area');
        document.getElementById('edit_status').value = this.getAttribute('data-status');
        document.getElementById('edit_notes').value = this.getAttribute('data-notes');
      });
    });

    // View crop modal handler
    document.querySelectorAll('.view-crop').forEach(button => {
      button.addEventListener('click', function() {
        document.getElementById('view_crop_name').textContent = this.getAttribute('data-name');
        document.getElementById('view_crop_type').textContent = this.getAttribute('data-type');
        document.getElementById('view_planting_date').textContent = formatDate(this.getAttribute('data-planting'));
        
        const harvestDate = this.getAttribute('data-harvest');
        document.getElementById('view_harvest_date').textContent = harvestDate ? formatDate(harvestDate) : 'Not specified';
        
        const area = this.getAttribute('data-area');
        document.getElementById('view_area').textContent = area ? area + ' acres' : 'Not specified';
        
        document.getElementById('view_status').textContent = this.getAttribute('data-status');
        document.getElementById('view_notes').textContent = this.getAttribute('data-notes') || 'No notes available';
        
        // Show the modal
        const viewModal = new bootstrap.Modal(document.getElementById('viewCropModal'));
        viewModal.show();
      });
    });

    // Format date for display
    function formatDate(dateString) {
      if (!dateString) return '';
      const date = new Date(dateString);
      return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
    }

    // Set today's date as default for planting date in add crop form
    document.addEventListener('DOMContentLoaded', function() {
      const today = new Date().toISOString().split('T')[0];
      document.getElementById('planting_date').value = today;
    });
  </script>
</body>
</html>