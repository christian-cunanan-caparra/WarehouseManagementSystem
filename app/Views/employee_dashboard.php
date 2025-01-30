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

    <style>
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
            z-index: 10;
        }

        .toggle-btn:hover {
            background-color: #495057;
        }

        /* Sidebar Closed State */
        .sidebar.closed {
            transform: translateX(-250px);
        }

        .content.open-sidebar {
            margin-left: 0;
        }

        .toggle-btn.move {
            left: 15px;
        }

        /* Modal Styling */
        .modal-body ul {
            list-style-type: none;
        }

        .modal-body ul li {
            padding: 5px 0;
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

    <!-- Toggle Button -->
    <button class="toggle-btn" id="sidebarToggle">
        <span class="material-icons">menu</span>
    </button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h1 class="text-center">Dashboard</h1>

        <!-- Analytics Cards -->
        <div class="row mb-4">
            <!-- Total Products -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Products</h5>
                            <h3 class="card-text">
                                <!-- Example dynamic content -->
                                150
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
                                5
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
                        <ul>
                            <li>Product A - 10 units left</li>
                            <li>Product B - 15 units left</li>
                        </ul>
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
                    <li>Product A - 50 times used</li>
                    <li>Product B - 30 times used</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Sidebar Toggle Functionality
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("sidebarToggle");
        const content = document.getElementById("main-content");

        let isSidebarOpen = true; // Track sidebar state

        toggleBtn.addEventListener("click", () => {
            isSidebarOpen = !isSidebarOpen; // Toggle state

            if (isSidebarOpen) {
                sidebar.classList.remove("closed");
                content.classList.remove("open-sidebar");
                toggleBtn.classList.remove("move");
                toggleBtn.style.left = "260px"; // Adjust button position
            } else {
                sidebar.classList.add("closed");
                content.classList.add("open-sidebar");
                toggleBtn.classList.add("move");
                toggleBtn.style.left = "15px"; // Move button closer when sidebar is closed
            }
        });
    </script>

</body>
</html>
