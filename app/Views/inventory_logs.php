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

        /* Table Styling */
        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .table th, .table td {
            padding: 12px;
            text-align: center;
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
        <h2 class="text-center">Inventory Logs</h2>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($inventory_logs)): ?>
                        <?php foreach ($inventory_logs as $log): ?>
                            <tr>
                                <td><?= esc($log['product_id']) ?></td> <!-- Replace with product name if available -->
                                <td><?= esc($log['quantity']) ?></td>
                                <td><?= esc($log['created_at']) ?></td>
                                <td><?= esc($log['action']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No inventory logs found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
    </script>

</body>
</html>
