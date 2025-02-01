<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Icons & FontAwesome -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Dark Theme Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #1e1e1e;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            transition: all 0.3s ease-in-out;
        }

        .sidebar-header {
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            color: #ff9800;
            margin-bottom: 20px;
        }

        .sidebar-links {
            list-style: none;
            padding: 0;
        }

        .sidebar-links li {
            padding: 12px 20px;
        }

        .sidebar-links li a {
            text-decoration: none;
            color: #ffffff;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .sidebar-links li a:hover {
            background-color: #333;
            border-left: 4px solid #ff9800;
            padding-left: 16px;
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
        }

        .logout-button:hover {
            background-color: #ff5722;
        }

        /* Toggle Button */
        .toggle-btn {
            position: fixed;
            left: 260px;
            top: 15px;
            background-color: #1e1e1e;
            color: white;
            border: none;
            padding: 10px;
            font-size: 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .toggle-btn:hover {
            background-color: #ff9800;
        }

        /* Content */
        .content {
            margin-left: 270px;
            padding: 20px;
            transition: 0.3s;
        }

        h2 {
            font-weight: bold;
            color: #ff9800;
            margin-top: 30px;
        }

        /* Dashboard Cards */
        .card {
            background-color: #1e1e1e !important;
            border: none;
            box-shadow: 0px 4px 10px rgba(255, 152, 0, 0.2);
        }

        .card-title {
            color: #ff9800;
            font-weight: bold;
        }

        .card-body {
            color: white;
        }

        .material-icons {
            font-size: 28px;
            color: #ff9800;
        }

        /* Charts */
        .chart-container {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(255, 152, 0, 0.3);
        }

        /* Table */
        .table-container {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(255, 152, 0, 0.3);
        }

        /* Responsive */
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
        <ul class="sidebar-links">
            <li><a href="#"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="#"><span class="material-icons">inventory</span> Inventory</a></li>
            <li><a href="#"><span class="material-icons">list</span> Logs</a></li>
            <li><a href="#"><span class="material-icons">settings</span> Settings</a></li>
        </ul>
        <div class="logout-container">
            <a href="#" class="logout-button"><span class="material-icons">logout</span> Log out</a>
        </div>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h2>Welcome, Admin!</h2>

        <!-- Analytics Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Stock In</h5>
                        <h3>5,000</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Stock Out</h5>
                        <h3>2,500</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white">
                    <div class="card-body">
                        <h5 class="card-title">Low Stock Alerts</h5>
                        <h3>8</h3>
                    </div>
                </div>
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

            if (isSidebarOpen) {
                sidebar.classList.remove("hidden");
                content.classList.remove("full-width");
            } else {
                sidebar.classList.add("hidden");
                content.classList.add("full-width");
            }
        });
    </script>

</body>
</html>
