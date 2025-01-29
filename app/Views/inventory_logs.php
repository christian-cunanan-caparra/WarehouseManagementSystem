<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Logs</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #4CAF50;
            color: white;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        .table td:last-child {
            text-align: center;
        }

        .action-button {
            padding: 6px 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .action-button:hover {
            background-color: #0056b3;
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
            z-index: 1001; /* Ensure it's above the sidebar */
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
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <!-- <button class="close-btn" id="close-btn">&times;</button> -->
        <div class="sidebar-header">Warehouse Management</div>
        <ul class="sidebar-links">
            <li><a href="/employee_dashboard"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="/product"><span class="material-icons">inventory</span> Products</a></li>
            <li><a href="/inventory"><span class="material-icons">storage</span> Inventory</a></li>
            <li><a href="/inventory_logs"><span class="material-icons">storage</span> Inventory Logs</a></li>
        </ul>
    </aside>

    <!-- Toggle Button -->
    <!-- <button class="toggle-btn" id="toggle-btn">&#9776;</button> -->

    <div class="content" id="main-content">
        <h2>Inventory Logs</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sample</td>
                    <td>Sample</td>
                    <td>Sample</td>
                    <td><a href="#" class="action-button">Edit</a></td>
                </tr>
            </tbody>
        </table>
    </div>

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
                toggleBtn.style.display = 'none'; // Hide toggle button on desktop
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
                toggleBtn.style.display = 'none'; // Hide toggle button on desktop
            } else {
                sidebar.classList.remove('active');
                mainContent.classList.remove('active');
                toggleBtn.style.display = 'block'; // Show toggle button on mobile
            }
        };
    </script>
</body>
</html>