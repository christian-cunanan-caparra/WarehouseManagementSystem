<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Employee Dashboard - Warehouse Management System</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Chart.js for data visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Styles for responsive sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: -270px;
            width: 270px;
            height: 100%;
            background: rgba(22, 26, 45, 0.9);
            backdrop-filter: blur(10px);
            color: white;
            padding: 20px;
            transition: 0.4s ease-in-out;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            border-right: 2px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar.active {
            left: 0;
        }
        .toggle-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: #161a2d;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 1.5rem;
            transition: 0.3s;
            border-radius: 5px;
            display: none;
        }
        .toggle-btn:hover {
            background: #4f52ba;
        }
        .content {
            margin-left: 50px;
            padding: 30px;
            transition: margin-left 0.4s ease;
            background: #f8f9fa;
            min-height: 100vh;
        }
        .content.active {
            margin-left: 270px;
        }
        .table-responsive { overflow-x: auto; }
        .table th, .table td { white-space: nowrap; }
        .sidebar-header {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .sidebar-links {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }
        .sidebar-links li {
            margin-bottom: 15px;
        }
        .sidebar-links li a {
            color: white;
            font-size: 1.1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            transition: 0.3s ease;
            border-radius: 6px;
        }
        .sidebar-links li a:hover {
            background: rgba(255, 255, 255, 0.2);
            padding-left: 15px;
        }
        .menu-separator {
            margin: 15px 0;
            height: 1px;
            background-color: rgba(255, 255, 255, 0.3);
        }
        @media (max-width: 768px) {
            .content { margin-left: 0; }
            .sidebar.active { left: 0; }
            .toggle-btn { display: block; }
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
            <li><a href="/inventory_logs"><span class="material-icons">storage</span> Inventory Logs</a></li>
            <li><a href="/logout"><span class="material-icons">logout</span> Log out</a></li>
        </ul>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h1 class="text-center">Advanced Dashboard</h1>

        <!-- Product Stats -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Products</h5>
                            <h3 class="card-text" id="total-products">0</h3>
                        </div>
                        <span class="material-icons">inventory</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Stock In</h5>
                            <h3 class="card-text" id="stock-in">0</h3>
                        </div>
                        <span class="material-icons">inventory</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Stock Out</h5>
                            <h3 class="card-text" id="stock-out">0</h3>
                        </div>
                        <span class="material-icons">inventory</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Trends -->
        <div class="row mb-4">
            <div class="col-md-12">
                <canvas id="stock-trends"></canvas>
            </div>
        </div>

        <!-- Low Stock Alerts -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h4>Low Stock Alerts</h4>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Remaining Stock</th>
                        </tr>
                    </thead>
                    <tbody id="low-stock-alerts">
                        <!-- Populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Most Used Products -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h4>Most Used Products</h4>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Usage Count</th>
                        </tr>
                    </thead>
                    <tbody id="most-used-products">
                        <!-- Populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- User Activity -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h4>User Activity</h4>
                <ul id="user-activity">
                    <!-- Populated by JavaScript -->
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Dummy Data (In real scenario, use AJAX to fetch from the server)
        const products = [
            {name: 'Product 1', stock_in: 100, stock_out: 40, remaining_stock: 60, usage_count: 5},
            {name: 'Product 2', stock_in: 200, stock_out: 100, remaining_stock: 100, usage_count: 8},
            {name: 'Product 3', stock_in: 150, stock_out: 30, remaining_stock: 120, usage_count: 3}
        ];

        const userActivities = [
            'John added 50 units of Product 1',
            'Jane removed 20 units of Product 2',
            'Bob updated stock levels for Product 3'
        ];

        // Function to calculate total stock in, total stock out, and total products
        function updateProductStats() {
            let totalStockIn = 0;
            let totalStockOut = 0;
            let totalProducts = products.length;

            products.forEach(product => {
                totalStockIn += product.stock_in;
                totalStockOut += product.stock_out;
            });

            document.getElementById('total-products').innerText = totalProducts;
            document.getElementById('stock-in').innerText = totalStockIn;
            document.getElementById('stock-out').innerText = totalStockOut;
        }

        // Function to populate low stock alerts
        function populateLowStockAlerts() {
            const lowStockAlert = document.getElementById('low-stock-alerts');
            lowStockAlert.innerHTML = '';
            products.forEach(product => {
                if (product.remaining_stock < 50) {
                    const row = `<tr><td>${product.name}</td><td>${product.remaining_stock}</td></tr>`;
                    lowStockAlert.innerHTML += row;
                }
            });
        }

        // Function to populate most used products
        function populateMostUsedProducts() {
            const mostUsedProducts = document.getElementById('most-used-products');
            mostUsedProducts.innerHTML = '';
            products.sort((a, b) => b.usage_count - a.usage_count).forEach(product => {
                const row = `<tr><td>${product.name}</td><td>${product.usage_count}</td></tr>`;
                mostUsedProducts.innerHTML += row;
            });
        }

        // Function to populate user activities
        function populateUserActivities() {
            const activityList = document.getElementById('user-activity');
            activityList.innerHTML = '';
            userActivities.forEach(activity => {
                const listItem = `<li>${activity}</li>`;
                activityList.innerHTML += listItem;
            });
        }

        // Chart.js for Stock Trends
        function renderStockTrends() {
            const ctx = document.getElementById('stock-trends').getContext('2d');
            const stockTrendsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                    datasets: [{
                        label: 'Stock Trends',
                        data: [150, 200, 250, 220, 280, 300],
                        borderColor: 'rgba(0, 123, 255, 1)',
                        backgroundColor: 'rgba(0, 123, 255, 0.2)',
                        fill: true
                    }]
                }
            });
        }

        // Initialize the dashboard
        function initDashboard() {
            updateProductStats();
            populateLowStockAlerts();
            populateMostUsedProducts();
            populateUserActivities();
            renderStockTrends();
        }

        // Toggle Sidebar
        document.getElementById('toggle-btn').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('main-content').classList.toggle('active');
        });

        initDashboard();
    </script>
</body>
</html>
