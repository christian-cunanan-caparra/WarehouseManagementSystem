<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - Warehouse Management System</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Chart.js for Data Visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Custom styles for responsive sidebar and other components */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
            padding-top: 15px;
            transition: transform 0.3s ease-in-out;
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

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .card-title {
            font-size: 18px;
        }

        .card-body {
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card h3 {
            font-size: 2rem;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">Warehouse Management</div>
        <ul class="sidebar-links">
            <li><a href="/employee_dashboard"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="/product"><span class="material-icons">inventory</span> Products</a></li>
            <li><a href="/inventory"><span class="material-icons">storage</span> Inventory</a></li>
            <li><a href="/inventory_logs"><span class="material-icons">history</span> Inventory Logs</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h1 class="text-center">Dashboard</h1>

        <!-- Analytics Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Products</h5>
                            <h3 class="card-text">
                                <?= count(array_column($products, 'stock_in')) ?>
                            </h3>
                        </div>
                        <span class="material-icons">inventory</span>
                    </div>
                </div>
            </div>
            <!-- More cards for Total Stocks, Stocks In/Out -->
        </div>

        <!-- Stock Trends Chart -->
    

        <!-- Low Stock Alerts -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Low Stock Alerts</h5>
                <ul>
                    <?php if (!empty($lowStockProducts)): ?>
                        <?php foreach ($lowStockProducts as $product): ?>
                            <li><?= $product['name'] ?> - <?= $product['remaining_stock'] ?> units left</li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No products are low on stock.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Most Used Products -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Most Used Products</h5>
                <ul>
                    <?php if (!empty($mostUsedProducts)): ?>
                        <?php foreach ($mostUsedProducts as $product): ?>
                            <li><?= $product['name'] ?> - <?= $product['stock_in'] + $product['stock_out'] ?> times used</li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No products have been used yet.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- User Activity (can be added if needed) -->
        <!-- Similar layout can be used to display recent user activities -->
    </div>

    <!-- Script for charts -->
    <script>
        // Stock Trends Chart using Chart.js
        var ctx = document.getElementById('stockTrendsChart').getContext('2d');
        var stockTrendsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [/* Date labels */],
                datasets: [{
                    label: 'Stock In',
                    data: [/* Stock in data */],
                    borderColor: 'blue',
                    fill: false
                }, {
                    label: 'Stock Out',
                    data: [/* Stock out data */],
                    borderColor: 'red',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Stock Trends (In vs. Out)'
                    }
                }
            }
        });
    </script>
</body>
</html>
