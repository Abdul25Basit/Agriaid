<!DOCTYPE html>
<html lang="en">
<?php include('header.php'); ?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Farmer's Marketplace | AI-Powered Farming Solutions</title>

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

    .navbar {
      background-color: var(--accent);
    }

    .navbar-brand,
    .nav-link {
      color: white !important;
    }

    .hero {
      background: linear-gradient(to right, var(--secondary), #ffffff);
      padding: 80px 20px;
      text-align: center;
    }

    .hero h1 {
      color: var(--accent);
      font-size: 3rem;
      font-weight: bold;
    }

    .hero p {
      font-size: 1.3rem;
      color: #555;
    }

    .section-title {
      font-weight: bold;
      text-align: center;
      margin-bottom: 40px;
      color: var(--accent);
      font-size: 2.5rem;
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

    .card-body i {
      font-size: 2.5rem;
      color: var(--primary);
      margin-bottom: 10px;
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

    .tab-content {
      padding: 20px 0;
    }

    .nav-tabs .nav-link {
      color: var(--accent);
      font-weight: 600;
    }

    .nav-tabs .nav-link.active {
      color: white;
      background-color: var(--accent);
      border-color: var(--accent);
    }

    .product-card {
      height: 100%;
    }

    .product-img {
      width: 100%; /* Ensure the image fills the card's width */
      height: 200px; /* Set a fixed height for consistency */
      object-fit: cover; /* Ensures the image scales and crops to fit without distortion */
      border-radius: 8px 8px 0 0; /* Optional: Rounded corners for the top of the card */
    }

    footer {
      background-color: var(--accent);
      color: white;
      padding: 40px 0;
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
      <h1>Farmer's Marketplace</h1>
      <p class="lead mt-3">Connect directly with buyers and sellers - No middlemen, better prices</p>
    </div>
  </section>

  <!-- Marketplace Tabs -->
  <section class="py-5">
    <div class="container">
      <ul class="nav nav-tabs justify-content-center" id="marketplaceTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="sell-tab" data-bs-toggle="tab" data-bs-target="#sell" type="button" role="tab">Sell Produce</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="buy-tab" data-bs-toggle="tab" data-bs-target="#buy" type="button" role="tab">Buy Inputs</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="rent-tab" data-bs-toggle="tab" data-bs-target="#rent" type="button" role="tab">Rent Equipment</button>
        </li>
      </ul>

      <div class="tab-content" id="marketplaceTabContent">
        <!-- Sell Produce Tab -->
        <div class="tab-pane fade show active" id="sell" role="tabpanel">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">List Your Produce</h3>
                  <form>
                    <div class="mb-3">
                      <label for="cropType" class="form-label">Crop Type</label>
                      <select class="form-select" id="cropType">
                        <option selected>Select crop</option>
                        <option>Wheat</option>
                        <option>Rice</option>
                        <option>Corn</option>
                        <option>Soybean</option>
                        <option>Cotton</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="quantity" class="form-label">Quantity (kg)</label>
                      <input type="number" class="form-control" id="quantity">
                    </div>
                    <div class="mb-3">
                      <label for="price" class="form-label">Price per kg (₹)</label>
                      <input type="number" class="form-control" id="price">
                    </div>
                    <div class="mb-3">
                      <label for="location" class="form-label">Location</label>
                      <input type="text" class="form-control" id="location">
                    </div>
                    <div class="mb-3">
                      <label for="description" class="form-label">Description</label>
                      <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="productImage" class="form-label">Upload Images</label>
                      <input class="form-control" type="file" id="productImage">
                    </div>
                    <button type="submit" class="btn btn-custom">List Product</button>
                  </form>
                </div>
              </div>
            </div>
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

        <!-- Buy Inputs Tab -->
        <div class="tab-pane fade" id="buy" role="tabpanel">
          <div class="row">
            <div class="col-md-4 mb-4">
              <div class="card product-card">
                <img src="https://5.imimg.com/data5/SELLER/Default/2023/8/337442859/DU/DR/RL/106616364/sahyog-lok-1-wheat-seeds-1000x1000.png" class="card-img-top product-img" alt="Seeds">
                <div class="card-body">
                  <h5 class="card-title">High Yield Wheat Seeds</h5>
                  <p class="card-text">Certified seeds with 95% germination rate</p>
                  <p><strong>₹1200/kg</strong> | Verified Seller</p>
                  <a href="#" class="btn btn-custom">Buy Now</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card product-card">
                <img src="https://casadeamor.in/cdn/shop/files/2.png?v=1685438879&width=990" class="card-img-top product-img" alt="Fertilizer">
                <div class="card-body">
                  <h5 class="card-title">NPK Fertilizer</h5>
                  <p class="card-text">Balanced 19-19-19 composition for all crops</p>
                  <p><strong>₹650/bag</strong> | Verified Seller</p>
                  <a href="#" class="btn btn-custom">Buy Now</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card product-card">
                <img src="https://5.imimg.com/data5/SELLER/Default/2023/8/335947978/GR/KG/VR/183091867/organic-pesticides-1000x1000.jpg" class="card-img-top product-img" alt="Pesticide">
                <div class="card-body">
                  <h5 class="card-title">Organic Pesticide</h5>
                  <p class="card-text">Neem-based, safe for organic farming</p>
                  <p><strong>₹350/liter</strong> | Verified Seller</p>
                  <a href="#" class="btn btn-custom">Buy Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Rent Equipment Tab -->
        <div class="tab-pane fade" id="rent" role="tabpanel">
          <div class="row">
            <div class="col-md-4 mb-4">
              <div class="card product-card">
                <img src="https://tractordekho.in/img/storage/uploads/1681731028_mahindra-jivo-225-di-4wd0.jpg?w=375&h=320" class="card-img-top product-img" alt="Tractor">
                <div class="card-body">
                  <h5 class="card-title">Tractor with Plough</h5>
                  <p class="card-text">45HP tractor with attachments. Well maintained.</p>
                  <p><strong>₹1500/day</strong> | Available in: Nashik, MH</p>
                  <a href="#" class="btn btn-custom">Rent Now</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card product-card">
                <img src="https://ik.imagekit.io/tractorkarvan/tr:w-548,f-webp,di-placeholder.png/images/Harvester/Preet-987.jpg" class="card-img-top product-img" alt="Harvester">
                <div class="card-body">
                  <h5 class="card-title">Combine Harvester</h5>
                  <p class="card-text">For wheat and rice harvesting. Operator included.</p>
                  <p><strong>₹5000/day</strong> | Available in: Sangli, MH</p>
                  <a href="#" class="btn btn-custom">Rent Now</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card product-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/Button_dripper.JPG/960px-Button_dripper.JPG" class="card-img-top product-img" alt="Irrigation">
                <div class="card-body">
                  <h5 class="card-title">Drip Irrigation System</h5>
                  <p class="card-text">Complete setup for 1 acre. Installation support.</p>
                  <p><strong>₹3000/week</strong> | Available in: Ahmednagar, MH</p>
                  <a href="#" class="btn btn-custom">Rent Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
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