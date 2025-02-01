<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
   <!-- Bootstrap 5 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1"></script>

   
   
   
   <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styling */
        .sidebar {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
            width: 250px;
            background-color: #343a40;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 15px;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar-links-container {
            flex-grow: 1;
        }

        .logout-container {
            padding: 15px;
        }

        .logout-button {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            padding: 12px 15px;
            border-radius: 5px;
        }

        .logout-button:hover {
            background-color: #495057;
        }

        .sidebar-header {
            font-size: 20px;
            text-align: center;
            padding: 15px;
            font-weight: bold;
            border-bottom: 1px solid #495057;
        }

        .sidebar-links {
            list-style: none;
            padding: 0;
        }

        .sidebar-links li {
            padding: 12px 15px;
        }

        .sidebar-links li a {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
        }

        .sidebar-links li a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transition: 0.3s ease-in-out;
        }

        /* Toggle Button */
        .toggle-btn {
            position: fixed;
            left: 260px;
            top: 15px;
            background-color: #343a40;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .toggle-btn:hover {
            background-color: #495057;
        }

        /* Content Styling */
        .content {
            margin-left: 270px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        h2 {
            font-weight: bold;
            color: #343a40;
            margin-top: 30px; /* Slight margin top for the dashboard */
        }

        /* Dashboard Cards */
        .card {
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 16px;
        }

        .card-body {
            padding: 20px;
        }

        .card h3 {
            font-size: 2rem;
        }

        /* Stock Trends Chart */
        #stockTrendChart {
            height: 400px;
        }

        /* Mini Pie Chart */
        #pieChart {
            height: 250px;
            max-width: 300px;
            margin: 0 auto;
            border-radius: 10px;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .sidebar {
                position: absolute;
        z-index: 1000;
        transform: translateX(-100%);
            }

            .content {
                margin-left: 0;
            }

            .toggle-btn {
                left: 15px;
            }
        }

        .sidebar.hidden {
            transform: translateX(0);
        }

        .content.full-width {
            margin-left: 0;
        }

        .toggle-btn.move {
            left: 15px;
        z-index: 1100;
        }

        /* Container for the Charts */
        .chart-container {
            margin-top: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
        }

        .table-container {
            margin-top: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
        }

        .table-responsive {
            max-height: 500px;
            overflow-y: auto;
        }

        h1{
            margin-left: 50px;
        }

    </style>
</head>

<body>

    <!-- Sidebar -->
   



    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">Warehouse Management</div>
        <div class="sidebar-links-container">
            <ul class="sidebar-links">
            <li><a href="/admin_dashboard"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="/account-management"><span class="material-icons">inventory</span> Account Management </a></li>
            <li><a href="/archive-accounts"><span class="material-icons">storage</span> Account Archive</a></li>
            <li><a href="/request-product"><span class="material-icons">add_box</span> Request Product</a></li>

                  <!-- <li><a href="/inventory-log"><span class="material-icons">list</span> Inventory Logs</a></li> -->
            </ul>
        </div>
        <div class="logout-container">
            <a href="/logout" class="logout-button"><span class="material-icons">logout</span> Log out</a>
        </div>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>
    
    <!-- Main Content -->

  
    <div class="content" id="main-content">
    <h1>Welcome, Admin <?= session()->get('user_name') ?>!</h1>



<BR>
        <!-- Analytics Cards -->
        <div class="row mb-4">
            <!-- Total Stock In -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-info text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Stock In</h5>
                            <h3 class="card-text" id="totalStockIn">
                                <?= $totalStockIn ?>
                            </h3>
                        </div>
                        <span class="material-icons">arrow_upward</span>
                    </div>
                </div>
            </div>

            <!-- Total Stock Out -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-danger text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Stock Out</h5>
                            <h3 class="card-text" id="totalStockOut">
                                <?= $totalStockOut ?>
                            </h3>
                        </div>
                        <span class="material-icons">arrow_upward</span>
                    </div>
                </div>
            </div>

            <!-- Low Stock Alerts -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-warning text-white" data-bs-toggle="modal" data-bs-target="#lowStockModal">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Low Stock Alerts</h5>
                            <h3 class="card-text" id="lowStockCount">
                                <?= count($lowStockProducts) ?>
                            </h3>
                        </div>
                        <span class="material-icons">warning</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="chart-container">
            <div class="row mt-4">
                <!-- Mini Bar Chart -->
                <div class="col-md-6">
                    <canvas id="miniBarChart"></canvas>
                </div>

                <!-- Pie Chart -->
                <div class="col-md-6">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Product Table -->
      
        <div class="table-container">
            <div class="table-responsive mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock In</th>
                            <th>Stock Out</th>
                            <th>Inventory Stock</th>
                        </tr>
                    </thead>
                    <tbody id="productTable">
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= esc($product['id']) ?></td>
                                <td><?= esc($product['name']) ?></td>
                                <td><?= esc($product['description']) ?></td>
                                <td><?= esc($product['price']) ?></td>
                                <td><?= esc($product['stock_in']) ?></td>
                                <td><?= esc($product['stock_out']) ?></td>
                                <td><?= esc($product['remaining_stock']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Mini Bar Chart
        const miniBarCtx = document.getElementById('miniBarChart').getContext('2d');
        const miniBarChart = new Chart(miniBarCtx, {
    type: 'bar',
    data: {
        labels: ['Stock In', 'Stock Out', 'Products', 'Cache'],
        datasets: [{
            label: 'Stock Usage',
            data: [<?= $totalStockIn ?>, <?= $totalStockOut ?>, 30000, 20000],
            backgroundColor: ['#17a2b8', '#dc3545', '#28a745', '#6610f2'],
            borderWidth: 1,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true }
        }
    }
});

    </script>

   <script>
   document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggle-btn");
    const mainContent = document.getElementById("main-content");

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("hidden");
        mainContent.classList.toggle("full-width");
        toggleBtn.classList.toggle("move");
    });
});

</script>

<!-- Low Stock Modal -->
<div class="modal fade" id="lowStockModal" tabindex="-1" aria-labelledby="lowStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lowStockModalLabel">Low Stock Alerts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    <?php foreach ($lowStockProducts as $product): ?>
                        <li><?= esc($product['name']) ?> - <?= esc($product['remaining_stock']) ?> left</li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>


</body>
</html>
