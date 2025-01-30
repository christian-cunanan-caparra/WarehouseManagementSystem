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
        /* Existing styles go here... */
    </style>
</head>
<body>

    <!-- Sidebar (same as before) -->

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
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Stock Trends</h5>
                <canvas id="stockTrendsChart"></canvas>
            </div>
        </div>

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
                    <?php foreach ($mostUsedProducts as $product): ?>
                        <li><?= $product['name'] ?> - <?= $product['usage_count'] ?> times used</li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- User Activity -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Recent User Activity</h5>
                <ul>
                    <?php foreach ($userActivities as $activity): ?>
                        <li><?= $activity['user_name'] ?> - <?= $activity['action'] ?> on <?= $activity['timestamp'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

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
