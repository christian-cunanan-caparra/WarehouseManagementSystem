<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- ssss 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Googssle Icons -->
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

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-activate {
            background: linear-gradient(45deg, #28a745, #218838);
            color: white;
            border: none;
        }

        .btn-activate:hover {
            background: linear-gradient(45deg, #218838, #28a745);
            transform: scale(1.05);
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

        /* Styles for responsive sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: -270px; /* Initially hidden */
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
            left: 0; /* Show the sidebar when active */
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
            display: none; /* Hide on desktop */
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
            margin-left: 270px; /* When the sidebar is active, shift content */
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table th, .table td {
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
            }

            .sidebar.active {
                left: 0;
            }

            .toggle-btn {
                display: block;
            }
        }

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
            /* Adjust sidebar to slide in on smaller screens */
            .sidebar {
                left: -270px; /* Initially hidden */
            }

            .sidebar.active {
                left: 0; /* Show the sidebar when active */
            }

            .content {
                margin-left: 0;
            }

            .content.active {
                margin-left: 270px; /* Push content to the right when sidebar is active */
            }

            .toggle-btn {
                display: block; /* Show toggle button on mobile */
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <button class="close-btn" id="close-btn">&times;</button>
        <div class="sidebar-header">Warehouse Management</div>
        <ul class="sidebar-links">
            <li><a href="/admin_dashboard"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="/account-management"><span class="material-icons">inventory</span> Account Management </a></li>
            <li><a href="/archive-accounts"><span class="material-icons">storage</span> Account Archive</a></li>
            <li><a href="/inventory-log"><span class="material-icons">list</span> Inventory Logs</a></li>
        </ul>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <div class="dashboard-container">
            <h1>Welcome, Admin <?= session()->get('user_name') ?>!</h1>
            <h2 class="text-center">Dashboard</h2>
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






            <h3>Requesting New Products</h3>

            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= esc($product['name']) ?></td>
                            <td><?= esc($product['description']) ?></td>
                            <td><?= esc($product['price']) ?></td>
                            <td>
                                <form action="/admin/activate/<?= $product['id'] ?>" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-activate btn-sm">
                                        <i class="fas fa-check"></i> Accept
                                    </button>
                                </form>
                                <form action="/admin/reject/<?= $product['id'] ?>" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-reject btn-sm">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <a href="/logout" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>


    <script>
        // Mini Bar Chart
        const miniBarCtx = document.getElementById('miniBarChart').getContext('2d');
        const miniBarChart = new Chart(miniBarCtx, {
            type: 'bar',
            data: {
                labels: ['Stock In', 'Stock Out', 'Products', 'Catche'],
                datasets: [{
                    label: 'Stock Usage',
                    data: [ <?= $totalStockIn ?>, <?= $totalStockOut ?>, 30000, 20000 ],
                    backgroundColor: ['rgba(23, 162, 184, 0.8)', 'rgba(220, 53, 69, 0.8)', 'rgba(40, 167, 69, 0.8)', 'rgba(102, 16, 242, 0.8)'],
                    borderRadius: 8,
                    borderWidth: 1,
                    barPercentage: 0.5,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1200,
                    easing: 'easeOutElastic'
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        ticks: { color: '#343a40', font: { size: 12 } },
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#343a40', font: { size: 12 } },
                        grid: { color: 'rgba(0, 0, 0, 0.1)' }
                    }
                }
            }
        });

        // Pie Chart
        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Total Stock In', 'Total Stock Out', 'Low Stock'],
                datasets: [{
                    label: 'Stock Distribution',
                    data: [<?= $totalStockIn ?>, <?= $totalStockOut ?>, <?= count($lowStockProducts) ?>],
                    backgroundColor: ['#17a2b8', '#dc3545', '#ffc107'],
                    borderColor: ['#ffffff', '#ffffff', '#ffffff'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontSize: 12,
                            fontColor: '#343a40',
                            boxWidth: 10
                        }
                    }
                }
            }
        });
    </script>


    <script>
        const toggleBtn = document.getElementById('toggle-btn');
        const closeBtn = document.getElementById('close-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        // Automatically open sidebar on larger screens
        window.onload = function() {
            if (window.innerWidth > 768) {
                sidebar.classList.add('active');
                mainContent.classList.add('active');
                toggleBtn.style.display = 'block'; // Ensure toggle button is visible on desktop
            } else {
                sidebar.classList.remove('active');
                mainContent.classList.remove('active');
                toggleBtn.style.display = 'block'; // Show toggle button on mobile
            }
        };

        // Toggle the sidebar on smaller screens
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
        });

        // Close the sidebar when clicking the close button
        closeBtn.addEventListener('click', function() {
            sidebar.classList.remove('active');
            mainContent.classList.remove('active');
        });

        // Optional: Close sidebar if user clicks outside
        document.addEventListener('click', function(event) {
            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target) && !closeBtn.contains(event.target)) {
                sidebar.classList.remove('active');
                mainContent.classList.remove('active');
            }
        });

        // Window resize to handle screen size change dynamically
        window.onresize = function() {
            if (window.innerWidth > 768) {
                sidebar.classList.add('active');
                mainContent.classList.add('active');
                toggleBtn.style.display = 'block'; // Ensure toggle button is always visible on desktop
            } else {
                sidebar.classList.remove('active');
                mainContent.classList.remove('active');
                toggleBtn.style.display = 'block'; // Show toggle button on mobile
            }
        };
    </script>

</body>
</html>