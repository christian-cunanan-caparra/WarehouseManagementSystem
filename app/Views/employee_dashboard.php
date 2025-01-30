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

    <!-- Chart.js -->
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
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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

        /* Hide sidebar */
        .sidebar.closed {
            transform: translateX(-250px);
        }

        .content.open-sidebar {
            margin-left: 0;
        }

        .trend-select {
            margin-bottom: 20px;
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

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h1 class="text-center">Dashboard</h1>

        <!-- Analytics Cards -->
        <div class="row mb-4">
            <!-- Total Stock In -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-info text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Stock In</h5>
                            <h3 class="card-text" id="totalStockIn">0</h3>
                        </div>
                        <span class="material-icons" id="totalStockInTrend">arrow_downward</span>
                    </div>
                </div>
            </div>

            <!-- Total Stock Out -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-danger text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Stock Out</h5>
                            <h3 class="card-text" id="totalStockOut">0</h3>
                        </div>
                        <span class="material-icons" id="totalStockOutTrend">arrow_upward</span>
                    </div>
                </div>
            </div>

            <!-- Low Stock Alerts -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-warning text-white" data-bs-toggle="modal" data-bs-target="#lowStockModal">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Low Stock Alerts</h5>
                            <h3 class="card-text" id="lowStockCount">0</h3>
                        </div>
                        <span class="material-icons">warning</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Time Interval Selector -->
        <div class="trend-select">
            <label for="timeInterval">Select Time Interval: </label>
            <select id="timeInterval" class="form-select" style="width: auto; display: inline;">
                <option value="day">Today</option>
                <option value="week">This Week</option>
                <option value="month">This Month</option>
            </select>
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

        // Fetching data and updating dynamic elements via AJAX
        function fetchStockData(timeInterval) {
            $.ajax({
                url: '/path/to/your/data/endpoint',  // Endpoint that returns JSON data
                method: 'GET',
                data: { interval: timeInterval }, // Send selected time interval to backend
                success: function(data) {
                    // Update Total Stock In, Stock Out, and Low Stock Alerts
                    $('#totalStockIn').text(data.stockIn.total);
                    $('#totalStockOut').text(data.stockOut.total);
                    $('#lowStockCount').text(data.lowStockCount);

                    // Update the trends for each section
                    updateTrends(data.stockIn.trend, 'totalStockInTrend');
                    updateTrends(data.stockOut.trend, 'totalStockOutTrend');
                }
            });
        }

        function updateTrends(trendData, trendElementId) {
            const trendElement = document.getElementById(trendElementId);
            if (trendData > 0) {
                trendElement.textContent = 'arrow_upward'; // Uptrend
                trendElement.style.color = 'green';
            } else if (trendData < 0) {
                trendElement.textContent = 'arrow_downward'; // Downtrend
                trendElement.style.color = 'red';
            } else {
                trendElement.textContent = ''; // No change
            }
        }

        // Callmhj the function to fetch data when time interval is changed
        $('#timeInterval').change(function () {
            const selectedInterval = $(this).val();
            fetchStockData(selectedInterval);  // Fetch data for selected time interval
        });

        // Call the function to fetch data initially (today)
        fetchStockData('day');

        // Optional: Refresh ssdata every 10 seconds
        setInterval(function () {
            const selectedInterval = $('#timeInterval').val();
            fetchStockData(selectedInterval);
        }, 10000);
    </script>

</body>
</html>
