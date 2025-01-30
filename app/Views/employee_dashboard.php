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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .dashboard-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 900px;
            margin: auto;
        }

        h1 {
            color: #007bff;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            text-align: center;
            width: 100%;
            padding: 10px;
            display: block;
            margin-top: 20px;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }

        .card-title {
            color: #007bff;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 2rem;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #343a40;
            padding-top: 20px;
            color: white;
        }

        .sidebar .sidebar-header {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .sidebar-links {
            list-style: none;
            padding-left: 0;
        }

        .sidebar-links li {
            padding: 12px 20px;
        }

        .sidebar-links li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar-links li a:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        .sidebar .logout-container {
            margin-top: auto;
            padding: 15px;
        }

        .sidebar .logout-container a {
            text-decoration: none;
            color: white;
        }

        .toggle-btn {
            font-size: 30px;
            color: #343a40;
            border: none;
            background-color: transparent;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transition: width 0.3s;
            }

            .sidebar.active {
                width: 250px;
            }

            .content {
                margin-left: 0;
            }

            .content.active {
                margin-left: 250px;
            }

            .toggle-btn {
                display: block;
            }
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
        <div class="logout-container">
            <a href="/logout" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <div class="dashboard-container">
            <h1>Employee Dashboard</h1>

            <!-- Dashboard Cards -->
            <div class="row">
                <!-- Total Stock In -->
                <div class="col-md-4">
                    <div class="card shadow-sm bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Stock In</h5>
                            <p class="card-text">200</p>
                        </div>
                    </div>
                </div>

                <!-- Total Stock Out -->
                <div class="col-md-4">
                    <div class="card shadow-sm bg-danger text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Stock Out</h5>
                            <p class="card-text">50</p>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Alerts -->
                <div class="col-md-4">
                    <div class="card shadow-sm bg-warning text-white" data-bs-toggle="modal" data-bs-target="#lowStockModal">
                        <div class="card-body">
                            <h5 class="card-title">Low Stock Alerts</h5>
                            <p class="card-text">5</p>
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
                            <ul>
                                <li>Product A - 10 stocks left</li>
                                <li>Product B - 15 stocks left</li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock Trends Chart -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Stock Trends</h5>
                    <canvas id="stockTrendChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        // Toggle the sidebar
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
        });

        // Initialize the chart
        var ctx = document.getElementById('stockTrendChart').getContext('2d');
        var stockTrendChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                    label: 'Stock In',
                    data: [50, 60, 70, 80, 90],
                    borderColor: '#007bff',
                    fill: false
                }, {
                    label: 'Stock Out',
                    data: [30, 40, 50, 60, 70],
                    borderColor: '#dc3545',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { beginAtZero: true },
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

</body>
</html>
