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
    <!-- Circle Progress Bar -->
    <script src="https://cdn.jsdelivr.net/npm/circle-progress@1.2.3/dist/circle-progress.min.js"></script>

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
            transition: margin-left 0.3s ease-in-out;
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

        /* Circle Analytics Styles */
        .circle-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .circle {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #f1f1f1;
        }

        .circle .circle-inner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 18px;
            font-weight: bold;
        }

        .circle span {
            display: block;
            font-size: 14px;
        }

        /* Hide sidebar */
        .sidebar.closed {
            transform: translateX(-250px);
        }

        .content.open-sidebar {
            margin-left: 0;
        }
    </style>
</head>
<body>

    <!-- Toggle Sidebar Button -->
    <button id="sidebarToggle" class="btn btn-dark position-fixed top-0 start-0 ms-3 mt-3" style="z-index: 10;">
        <span class="material-icons">menu</span>
    </button>

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

        <!-- Circle Analytics for Low Stock, Out of Stock, Stock In / Stock Out -->
        <div class="circle-container mb-4">
            <!-- Low Stock (Yellow) -->
            <div class="circle" id="lowStockCircle">
                <div class="circle-inner" id="lowStockText">
                    <span>Low Stock</span>
                    <div id="lowStockProgress"></div>
                </div>
            </div>

            <!-- Out of Stock (Red) -->
            <div class="circle" id="outOfStockCircle">
                <div class="circle-inner" id="outOfStockText">
                    <span>Out of Stock</span>
                    <div id="outOfStockProgress"></div>
                </div>
            </div>

            <!-- Stock In / Stock Out (Green) -->
            <div class="circle" id="stockInOutCircle">
                <div class="circle-inner" id="stockInOutText">
                    <span>Stock In/Out</span>
                    <div id="stockInOutProgress"></div>
                </div>
            </div>
        </div>

        <!-- Analytics Cards -->
        <div class="row mb-4">
            <!-- Total Products -->
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

            <!-- Low Stock Alerts -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-warning text-white" data-bs-toggle="modal" data-bs-target="#lowStockModal">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Low Stock Alerts</h5>
                            <h3 class="card-text">
                                <?php if (!empty($lowStockProducts)): ?>
                                    <?= count($lowStockProducts) ?>
                                <?php else: ?>
                                    0
                                <?php endif; ?>
                            </h3>
                        </div>
                        <span class="material-icons">warning</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Low Stock Products -->
        <div class="modal fade" id="lowStockModal" tabindex="-1" aria-labelledby="lowStockModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lowStockModalLabel">Low Stock Products</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php if (!empty($lowStockProducts)): ?>
                            <ul>
                                <?php foreach ($lowStockProducts as $product): ?>
                                    <li>
                                        <strong><?= $product['name'] ?></strong> - 
                                        <span><?= $product['remaining_stock'] ?> Stocks left</span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No products are low on stock.</p>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
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
    </div>

    <!-- Script for sidebar toggle -->
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('main-content');
            sidebar.classList.toggle('closed');
            content.classList.toggle('open-sidebar');
        });

        // Circle Progress Bars
        $(document).ready(function () {
            // Low Stock Progress
            $('#lowStockProgress').circleProgress({
                value: <?= count($lowStockProducts) ?> / 50, // Adjust value
                size: 100,
                fill: { color: '#FFC107' }, // Yellow for low stock
            });

            // Out of Stock Progress
            $('#outOfStockProgress').circleProgress({
                value: <?= count($outOfStockProducts) ?> / 50, // Adjust value
                size: 100,
                fill: { color: '#DC3545' }, // Red for out of stock
            });

            // Stock In/Out Progress
            $('#stockInOutProgress').circleProgress({
                value: <?= $totalStockInOut ?> / 50, // Adjust value
                size: 100,
                fill: { color: '#28A745' }, // Green for stock in/out
            });
        });
    </script>

</body>
</html>
