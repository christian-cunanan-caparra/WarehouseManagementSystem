<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
            justify-content: space-between; /* This will push the logout button to the bottom */
            height: 100vh; /* Ensure the sidebar takes full height */
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

        .sidebar-links-container {
            flex-grow: 1; /* This allows the links to take up available space */
        }

        .logout-container {
            padding: 15px; /* Add some padding for the logout button */
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
            background-color: #495057; /* Change background on hover */
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
            height: 200px;
            max-width: 250px;
            margin: 0 auto; /* Center the chart */
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
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">Warehouse Management</div>
        <div class="sidebar-links-container">
            <ul class="sidebar-links">
                <li><a href="/employee_dashboard"><span class="material-icons">dashboard</span> Dashboard</a></li>
                <li><a href="/product"><span class="material-icons">inventory</span> Products</a></li>
                <li><a href="/inventory"><span class="material-icons">storage</span> Inventory</a></li>
                <li><a href="/inventory_logs"><span class="material-icons">history</span> Inventory Logs</a></li>
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
        <h2 class="text-center">Dashboard</h2>

        <!-- Analytics Cards -->
        <div class="row mb-4">
            <!-- Total Stock In -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-info text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Stock In</h5>
                            <h3 class="card-text" id="totalStockIn">
                                <?= $totalStockIn ?> <!-- Dynamically inserted PHP data -->
                            </h3>
                        </div>
                        <span class="material-icons">arrow_downward</span>
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
                                <?= $totalStockOut ?> <!-- Dynamically inserted PHP data -->
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

        <script>
            // Mini Pie Chart for Stock Distribution
           
            const miniBarCtx = document.getElementById('miniBarChart').getContext('2d');
    const miniBarChart = new Chart(miniBarCtx, {
        type: 'bar',
        data: {
            labels: ['Stock In', 'Stock Out', 'Low Stock Alerts', 'Products', 'Catche'], // Sample labels
            datasets: [{
                label: 'Stock Usage',
                data: [ <?= $totalStockIn ?>, <?= $totalStockOut ?>, 5000, 3000 ],

                backgroundColor: [
                    'rgba(23, 162, 184, 0.8)',
                    'rgba(220, 53, 69, 0.8)',
                  
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(102, 16, 242, 0.8)'
                ],
                borderRadius: 8, // Rounded bars
                borderWidth: 1,
                barPercentage: 0.5, // Make bars thinner
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Allow chart to fit in a small space
            animation: {
                duration: 1200,
                easing: 'easeOutElastic' // Smooth animation
            },
            plugins: {
                legend: {
                    display: false // Hide legend to save space
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
                        animateScale: true, // Add scaling animation for the chart
                        animateRotate: true // Add rotation animation
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
    </div>

    <script>
        // Sidebar Toggle Functionality
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("toggle-btn");
        const content = document.getElementById("main-content");

        let isSidebarOpen = true; // Track sidebar state

        toggleBtn.addEventListener("click", () => {
            isSidebarOpen = !isSidebarOpen; // Toggle state

            if (isSidebarOpen) {
                sidebar.classList.remove("hidden");
                content.classList.remove("full-width");
                toggleBtn.classList.remove("move");
                toggleBtn.style.left = "260px"; // Adjust button position
            } else {
                sidebar.classList.add("hidden");
                content.classList.add("full-width");
                toggleBtn.classList.add("move");
                toggleBtn.style.left = "15px"; // Move button closer when sidebar is closed
            }
        });
    </script>

</body>
</html>
