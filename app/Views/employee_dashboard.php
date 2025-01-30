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

        /* Loading Animation */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: 0.3rem;
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

        <!-- New Fake Analytics Section -->
        <div class="row mb-4">
            <!-- Sales Analytics -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Sales Analytics</h5>
                        <div class="loading" id="salesLoading">
                            <div class="spinner-border text-light" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <h3 class="card-text" id="salesData" style="display:none;">$150,000</h3>
                    </div>
                </div>
            </div>

            <!-- Customer Feedback -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Customer Feedback</h5>
                        <div class="loading" id="feedbackLoading">
                            <div class="spinner-border text-light" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <h3 class="card-text" id="feedbackData" style="display:none;">4.8/5</h3>
                    </div>
                </div>
            </div>

            <!-- Website Traffic -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Website Traffic</h5>
                        <div class="loading" id="trafficLoading">
                            <div class="spinner-border text-light" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <h3 class="card-text" id="trafficData" style="display:none;">350,000 visitors</h3>
                    </div>
                </div>
            </div>
        </div>

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

        // Fake Loading Data Simulation
        window.onload = function() {
            setTimeout(function() {
                document.getElementById('salesLoading').style.display = 'none';
                document.getElementById('salesData').style.display = 'block';

                document.getElementById('feedbackLoading').style.display = 'none';
                document.getElementById('feedbackData').style.display = 'block';

                document.getElementById('trafficLoading').style.display = 'none';
                document.getElementById('trafficData').style.display = 'block';
            }, 2000); // Simulate a 2-second load time for data
        }
    </script>

</body>
</html>
