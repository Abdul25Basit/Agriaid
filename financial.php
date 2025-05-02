<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Farm Financial Planner | AI-Powered Farming Solutions</title>

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

    .card-body {
      background-color: #d4edda; /* Light green background */
      border-radius: 12px; /* Optional: Rounded corners */
      padding: 20px;
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
      color: black !important; /* Ensure text color for inactive tabs is black */
      font-weight: 600;
      background-color: #d4edda; /* Light green background for inactive tabs */
      border: 1px solid #d4edda; /* Match the border with the background */
      border-radius: 5px; /* Optional: Rounded corners for tabs */
    }

    .nav-tabs .nav-link.active {
      color: white !important; /* Ensure text color for active tab is white */
      background-color: var(--accent); /* Background color for active tab */
      border-color: var(--accent); /* Border color for active tab */
    }

    .result-card {
      background-color: var(--secondary);
      border-left: 5px solid var(--primary);
    }

    .table th {
      background-color: var(--secondary);
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
      <h1>Farm Financial Planner</h1>
      <p class="lead mt-3">Plan your farm's finances for better profitability</p>
    </div>
  </section>

  <!-- Financial Tools Section -->
  <section class="py-5">
    <div class="container">
      <ul class="nav nav-tabs justify-content-center" id="financeTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="profit-tab" data-bs-toggle="tab" data-bs-target="#profit" type="button" role="tab">Profit Calculator</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="loan-tab" data-bs-toggle="tab" data-bs-target="#loan" type="button" role="tab">Loan Comparison</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="budget-tab" data-bs-toggle="tab" data-bs-target="#budget" type="button" role="tab">Budget Tracker</button>
        </li>
      </ul>

      <div class="tab-content" id="financeTabContent">
        <!-- Profit Calculator Tab -->
        <div class="tab-pane fade show active" id="profit" role="tabpanel">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Crop Profit Calculator</h3>
                  <form id="profitCalculator">
                    <div class="mb-3">
                      <label for="cropSelect" class="form-label">Select Crop</label>
                      <select class="form-select" id="cropSelect">
                        <option value="wheat">Wheat</option>
                        <option value="rice">Rice</option>
                        <option value="corn">Corn</option>
                        <option value="soybean">Soybean</option>
                        <option value="cotton">Cotton</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="landArea" class="form-label">Land Area (acres)</label>
                      <input type="number" class="form-control" id="landArea" value="1">
                    </div>
                    <div class="mb-3">
                      <label for="expectedYield" class="form-label">Expected Yield (kg/acre)</label>
                      <input type="number" class="form-control" id="expectedYield">
                    </div>
                    <div class="mb-3">
                      <label for="marketPrice" class="form-label">Expected Market Price (₹/kg)</label>
                      <input type="number" class="form-control" id="marketPrice">
                    </div>
                    <h5 class="mt-4">Costs</h5>
                    <div class="mb-3">
                      <label for="seedCost" class="form-label">Seeds (₹/acre)</label>
                      <input type="number" class="form-control" id="seedCost">
                    </div>
                    <div class="mb-3">
                      <label for="fertilizerCost" class="form-label">Fertilizers (₹/acre)</label>
                      <input type="number" class="form-control" id="fertilizerCost">
                    </div>
                    <div class="mb-3">
                      <label for="laborCost" class="form-label">Labor (₹/acre)</label>
                      <input type="number" class="form-control" id="laborCost">
                    </div>
                    <div class="mb-3">
                      <label for="otherCost" class="form-label">Other Costs (₹/acre)</label>
                      <input type="number" class="form-control" id="otherCost">
                    </div>
                    <button type="button" class="btn btn-custom" onclick="calculateProfit()">Calculate</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card result-card" id="profitResult" style="display: none;">
                <div class="card-body">
                  <h3 class="card-title">Profit Estimation</h3>
                  <div class="row">
                    <div class="col-6">
                      <p><strong>Total Yield:</strong></p>
                      <p><strong>Gross Revenue:</strong></p>
                      <p><strong>Total Costs:</strong></p>
                      <hr>
                      <h5><strong>Estimated Profit:</strong></h5>
                    </div>
                    <div class="col-6 text-end">
                      <p id="totalYield">0 kg</p>
                      <p id="grossRevenue">₹0</p>
                      <p id="totalCost">₹0</p>
                      <hr>
                      <h5 id="estimatedProfit">₹0</h5>
                    </div>
                  </div>
                  <div class="mt-3">
                    <canvas id="profitChart" height="200"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Loan Comparison Tab -->
        <div class="tab-pane fade" id="loan" role="tabpanel">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Loan Comparison Tool</h3>
                  <form>
                    <div class="mb-3">
                      <label for="loanAmount" class="form-label">Loan Amount (₹)</label>
                      <input type="number" class="form-control" id="loanAmount" value="100000">
                    </div>
                    <div class="mb-3">
                      <label for="loanTerm" class="form-label">Loan Term (years)</label>
                      <input type="number" class="form-control" id="loanTerm" value="5">
                    </div>
                    <button type="button" class="btn btn-custom" onclick="compareLoans()">Compare Loans</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Available Loan Options</h3>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Bank</th>
                          <th>Interest Rate</th>
                          <th>EMI (₹)</th>
                          <th>Total Interest (₹)</th>
                        </tr>
                      </thead>
                      <tbody id="loanResults">
                        <!-- Loan results will be populated here -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Budget Tracker Tab -->
        <div class="tab-pane fade" id="budget" role="tabpanel">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Add Expense</h3>
                  <form id="expenseForm">
                    <div class="mb-3">
                      <label for="expenseCategory" class="form-label">Category</label>
                      <select class="form-select" id="expenseCategory">
                        <option value="seeds">Seeds</option>
                        <option value="fertilizers">Fertilizers</option>
                        <option value="labor">Labor</option>
                        <option value="equipment">Equipment</option>
                        <option value="irrigation">Irrigation</option>
                        <option value="other">Other</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="expenseAmount" class="form-label">Amount (₹)</label>
                      <input type="number" class="form-control" id="expenseAmount">
                    </div>
                    <div class="mb-3">
                      <label for="expenseDate" class="form-label">Date</label>
                      <input type="date" class="form-control" id="expenseDate" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="mb-3">
                      <label for="expenseNotes" class="form-label">Notes</label>
                      <textarea class="form-control" id="expenseNotes" rows="2"></textarea>
                    </div>
                    <button type="button" class="btn btn-custom" onclick="addExpense()">Add Expense</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Expense Summary</h3>
                  <div class="mb-4">
                    <canvas id="expenseChart" height="200"></canvas>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Category</th>
                          <th>Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="expenseList">
                        <!-- Expenses will be populated here -->
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="2">Total</th>
                          <th id="expenseTotal">₹0</th>
                          <th></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
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
  
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <!-- Custom JS -->
  <script>
    // Store expenses in memory (in a real app, use localStorage or a database)
    let expenses = [];
    let expenseChartInstance = null;
    let profitChartInstance = null;

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
      // Load any saved expenses
      loadExpenses();
      
      // Initialize date field to today
      document.getElementById('expenseDate').valueAsDate = new Date();
      
      // Initialize charts
      updateExpenseChart();
    });

    // Profit Calculator Function
    function calculateProfit() {
      const landArea = parseFloat(document.getElementById('landArea').value) || 0;
      const expectedYield = parseFloat(document.getElementById('expectedYield').value) || 0;
      const marketPrice = parseFloat(document.getElementById('marketPrice').value) || 0;
      const seedCost = parseFloat(document.getElementById('seedCost').value) || 0;
      const fertilizerCost = parseFloat(document.getElementById('fertilizerCost').value) || 0;
      const laborCost = parseFloat(document.getElementById('laborCost').value) || 0;
      const otherCost = parseFloat(document.getElementById('otherCost').value) || 0;
      
      const totalYield = landArea * expectedYield;
      const grossRevenue = totalYield * marketPrice;
      const totalCost = landArea * (seedCost + fertilizerCost + laborCost + otherCost);
      const estimatedProfit = grossRevenue - totalCost;
      
      document.getElementById('totalYield').textContent = totalYield.toFixed(2) + ' kg';
      document.getElementById('grossRevenue').textContent = '₹' + grossRevenue.toFixed(2);
      document.getElementById('totalCost').textContent = '₹' + totalCost.toFixed(2);
      document.getElementById('estimatedProfit').textContent = '₹' + estimatedProfit.toFixed(2);
      
      // Show result card
      document.getElementById('profitResult').style.display = 'block';
      
      // Create or update chart
      const ctx = document.getElementById('profitChart').getContext('2d');
      
      // Destroy previous chart instance if it exists
      if (profitChartInstance) {
        profitChartInstance.destroy();
      }
      
      profitChartInstance = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['Revenue', 'Costs'],
          datasets: [{
            data: [grossRevenue, totalCost],
            backgroundColor: ['#4a7c7c', '#70a1a1'],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'bottom'
            }
          }
        }
      });
    }
    
    // Loan Comparison Function
    function compareLoans() {
      const amount = parseFloat(document.getElementById('loanAmount').value) || 100000;
      const termYears = parseFloat(document.getElementById('loanTerm').value) || 5;
      const termMonths = termYears * 12;
      
      // Loan options data
      const loanOptions = [
        { bank: 'NABARD', rate: 4 },
        { bank: 'State Bank of India', rate: 7 },
        { bank: 'HDFC Bank', rate: 8.5 },
        { bank: 'Cooperative Bank', rate: 6 }
      ];
      
      let resultsHTML = '';
      
      loanOptions.forEach(option => {
        const monthlyRate = option.rate / 100 / 12;
        const emi = amount * monthlyRate * Math.pow(1 + monthlyRate, termMonths) / 
                    (Math.pow(1 + monthlyRate, termMonths) - 1);
        const totalInterest = (emi * termMonths) - amount;
        
        resultsHTML += `
          <tr>
            <td>${option.bank}</td>
            <td>${option.rate}%</td>
            <td>₹${emi.toFixed(2)}</td>
            <td>₹${totalInterest.toFixed(2)}</td>
          </tr>
        `;
      });
      
      document.getElementById('loanResults').innerHTML = resultsHTML;
    }
    
    // Add Expense Function
    function addExpense() {
      const category = document.getElementById('expenseCategory').value;
      const amount = parseFloat(document.getElementById('expenseAmount').value);
      const date = document.getElementById('expenseDate').value;
      const notes = document.getElementById('expenseNotes').value;
      
      if (!amount || isNaN(amount)) {
        alert('Please enter a valid amount');
        return;
      }
      
      const expense = {
        id: Date.now(),
        category,
        amount,
        date,
        notes
      };
      
      expenses.push(expense);
      saveExpenses();
      updateExpenseDisplay();
      updateExpenseChart();
      
      // Reset form
      document.getElementById('expenseForm').reset();
      document.getElementById('expenseDate').valueAsDate = new Date();
    }
    
    // Delete Expense Function
    function deleteExpense(id) {
      expenses = expenses.filter(expense => expense.id !== id);
      saveExpenses();
      updateExpenseDisplay();
      updateExpenseChart();
    }
    
    // Save expenses to localStorage
    function saveExpenses() {
      localStorage.setItem('farmExpenses', JSON.stringify(expenses));
    }
    
    // Load expenses from localStorage
    function loadExpenses() {
      const savedExpenses = localStorage.getItem('farmExpenses');
      if (savedExpenses) {
        expenses = JSON.parse(savedExpenses);
        updateExpenseDisplay();
      }
    }
    
    // Update the expense list display
    function updateExpenseDisplay() {
      let expenseHTML = '';
      let total = 0;
      
      expenses.forEach(expense => {
        total += expense.amount;
        expenseHTML += `
          <tr>
            <td>${expense.date}</td>
            <td>${expense.category}</td>
            <td>₹${expense.amount.toFixed(2)}</td>
            <td><button class="btn btn-sm btn-danger" onclick="deleteExpense(${expense.id})">Delete</button></td>
          </tr>
        `;
      });
      
      document.getElementById('expenseList').innerHTML = expenseHTML;
      document.getElementById('expenseTotal').textContent = `₹${total.toFixed(2)}`;
    }
    
    // Update the expense chart
    function updateExpenseChart() {
      const categories = ['seeds', 'fertilizers', 'labor', 'equipment', 'irrigation', 'other'];
      const categoryTotals = {};
      
      // Initialize totals
      categories.forEach(cat => {
        categoryTotals[cat] = 0;
      });
      
      // Calculate totals per category
      expenses.forEach(expense => {
        if (categoryTotals.hasOwnProperty(expense.category)) {
          categoryTotals[expense.category] += expense.amount;
        } else {
          categoryTotals['other'] += expense.amount;
        }
      });
      
      // Prepare data for chart
      const labels = categories.map(cat => 
        cat.charAt(0).toUpperCase() + cat.slice(1)
      );
      const data = categories.map(cat => categoryTotals[cat]);
      
      const ctx = document.getElementById('expenseChart').getContext('2d');
      
      // Destroy previous chart instance if it exists
      if (expenseChartInstance) {
        expenseChartInstance.destroy();
      }
      
      expenseChartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'Expenses by Category',
            data: data,
            backgroundColor: '#70a1a1'
          }]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }
  </script>
</body>
</html>