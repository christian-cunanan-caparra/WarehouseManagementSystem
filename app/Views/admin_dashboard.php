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
            background-color: #495057;
            border-radius: 5px;
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
    height: 250px;   /* Fixed height */
    width: 250px;    /* Fixed width */
    margin: 0 auto;
    border-radius: 10px;
}


        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }

            .content {
                margin-left: 0;
            }

            .toggle-btn {
                left: 15px;
            }
        }

        .sidebar.hidden {
            transform: translateX(-250px);
        }

        .content.full-width {
            margin-left: 0;
        }

        .toggle-btn.move {
            left: 15px;
        }

        /* Container for the Charts */
        .chart-container {
            width: 80%;
            max-width: 900px;
            margin: 50px auto;
            background-color: #212529;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            padding: 20px;
            color: white;
            text-align: center;
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
</head>
<body style="background-color: #121212; color: white; font-family: Arial, sans-serif;"></body>

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

        <div class="chart-container">
        <h2>Warehouse Stock Overview</h2>
        <canvas id="advancedBarChart"></canvas>
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

    const ctx = document.getElementById('advancedBarChart').getContext('2d');

// Create Gradient Colors for Bars
const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
gradient1.addColorStop(0, 'rgba(23, 162, 184, 1)');
gradient1.addColorStop(1, 'rgba(23, 162, 184, 0.2)');

const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
gradient2.addColorStop(0, 'rgba(220, 53, 69, 1)');
gradient2.addColorStop(1, 'rgba(220, 53, 69, 0.2)');

const gradient3 = ctx.createLinearGradient(0, 0, 0, 400);
gradient3.addColorStop(0, 'rgba(40, 167, 69, 1)');
gradient3.addColorStop(1, 'rgba(40, 167, 69, 0.2)');

const gradient4 = ctx.createLinearGradient(0, 0, 0, 400);
gradient4.addColorStop(0, 'rgba(102, 16, 242, 1)');
gradient4.addColorStop(1, 'rgba(102, 16, 242, 0.2)');

// Warehouse Stock Data
const advancedBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Stock In', 'Stock Out', 'Products', 'Cache'],
        datasets: [{
            label: 'Stock Usage',
            data: [<?= $totalStockIn ?>, <?= $totalStockOut ?>, 30000, 20000],
            backgroundColor: [gradient1, gradient2, gradient3, gradient4],
            borderColor: ['#17a2b8', '#dc3545', '#28a745', '#6610f2'],
            borderWidth: 1.5,
            borderRadius: 12,
            hoverBackgroundColor: ['rgba(23, 162, 184, 0.9)', 'rgba(220, 53, 69, 0.9)', 'rgba(40, 167, 69, 0.9)', 'rgba(102, 16, 242, 0.9)'],
            barPercentage: 0.6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
            duration: 1200,
            easing: 'easeOutQuart'
        },
        plugins: {
            legend: {
                labels: {
                    color: '#fff'
                }
            }
        },
        scales: {
            x: {
                ticks: { color: '#fff', font: { size: 12 } },
                grid: { display: false }
            },
            y: {
                beginAtZero: true,
                ticks: { color: '#fff', font: { size: 12 } },
                grid: { color: 'rgba(255, 255, 255, 0.1)' }
            }
        }
    }
});
</script>

</body>
</html>