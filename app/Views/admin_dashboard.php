<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
            width: 250px;
            background-color: #304050;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 15px;
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
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
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #425464;
        }

        .sidebar-header {
            font-size: 20px;
            text-align: center;
            padding: 15px;
            font-weight: bold;
            border-bottom: 1px solid #425464;
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
            transition: background-color 0.3s ease;
        }

        .sidebar-links li a:hover {
            background-color: #425464;
            border-radius: 5px;
        }

        .toggle-btn {
            position: fixed;
            left: 260px;
            top: 15px;
            background-color: #304050;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 5px;
            transition: 0.3s;
            z-index: 10; /* Ensure it's above the sidebar */
        }

        .toggle-btn:hover {
            background-color: #425464;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        h2 {
            font-weight: bold;
            color: #343a40;
            margin-top: 30px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-weight: 500;
            color: #555;
        }

        .card-body h3 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
        }

        .chart-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        #miniBarChart,
        #pieChart {
            width: 100%;
            height: 300px;
        }

        .table-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-x: auto;
        }

        .table-responsive {
            max-height: 500px;
            overflow-y: auto;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #f9f9f9;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .card-body h3 {
                font-size: 2rem;
            }

            #miniBarChart,
            #pieChart {
                height: 250px;
            }

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

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">Warehouse Management</div>
        <div class="sidebar-links-container">
            <ul class="sidebar-links">
                <li><a href="/admin_dashboard"><span class="material-icons">dashboard</span> Dashboard</a></li>
                <li><a href="/account-management"><span class="material-icons">inventory</span> Account Management </a></li>
                <li><a href="/archive-accounts"><span class="material-icons">storage</span> Account Archive</a></li>
                <li><a href="/request-product"><span class="material-icons">add_box</span> Request Product</a></li>
            </ul>
        </div>
        <div class="logout-container">
            <a href="/logout" class="logout-button"><span class="material-icons">logout</span> Log out</a>
        </div>
    </aside>

    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <div class="content" id="main-content">
        <h1>Welcome, Admin <?= session()->get('user_name') ?>
          <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-info text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Stock In</h5>
                            <h3 class="card-text" id="totalStockIn"><?= $totalStockIn ?></h3>
                        </div>
                        <span class="material-icons">arrow_upward</span>
                    </div>
                </div>
            </div>
            </div>


        <div class="chart-container">
            <div class="row mt-4">
                <div class="col-md-6">
                    <canvas id="miniBarChart"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>

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
        // Sidebar Toggle
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("toggle-btn");
        const content = document.getElementById("main-content");

        let isSidebarOpen = true;

        toggleBtn.addEventListener("click", () => {
            isSidebarOpen = !isSidebarOpen;
            sidebar.classList.toggle("hidden");
            content.classList.toggle("full-width");
            toggleBtn.classList.toggle("move");
            toggleBtn.style.left = isSidebarOpen ? "260px" : "15px";
        });


        // Mini Bar Chart
        const miniBarCtx = document.getElementById('miniBarChart').getContext('2d');
        const miniBarChart = new Chart(miniBarCtx, {
            type: 'bar',
            data: {
                labels: ['Stock In', 'Stock Out', 'Products', 'Catche'],
                datasets: [{
                    label: 'Stock Usage',
                    data: [<?= $totalStockIn ?>, <?= $totalStockOut ?>, 30000, 20000],
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
                    },
                    tooltip: { // Advanced Tooltip Example
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.formattedValue;
                            }
                        },
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        cornerRadius: 4,
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#343a40',
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#343a40',
                            font: {
                                size: 12
                            },
                            callback: function(value) { // Number formatting
                                return value.toLocaleString();
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    }
                }
            }
        });

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
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
                responsive: false,
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

</body>

</html>