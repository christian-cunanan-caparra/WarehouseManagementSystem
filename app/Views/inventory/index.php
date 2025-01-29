<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* Sidebar Styles */
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

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .close-btn:hover {
            color: #ff4d4d;
        }

        /* Toggle Button Styles */
        .toggle-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: #161a2d;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 1.5rem;
            transition: 0.3s;
            border-radius: 5px;
            z-index: 1001;
            display: none; /* Hidden by default on desktop */
        }

        .toggle-btn:hover {
            background: #4f52ba;
        }

        /* Main Content Styles */
        .content {
            margin-left: 50px;
            padding: 30px;
            transition: margin-left 0.4s ease;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .content.active {
            margin-left: 270px; /* Shift content when sidebar is active */
        }

        /* Table Styles */
        .table {
            margin-top: 20px;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table thead th {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .table tbody tr {
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table tbody td {
            vertical-align: middle;
            border: none;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 14px;
        }

        .form-control-sm {
            width: 80px;
            display: inline-block;
            margin-right: 5px;
        }

        .actions {
            white-space: nowrap;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .content {
                margin-left: 0;
            }

            .sidebar.active {
                left: 0;
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
            <li><a href="/employee_dashboard"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="/product"><span class="material-icons">inventory</span> Products</a></li>
            <li><a href="/inventory"><span class="material-icons">storage</span> Inventory</a></li>
        </ul>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <div class="container">
            <h2 class="my-4">Inventory Management</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Stock In</th>
                        <th>Stock Out</th>
                        <th>Remaining Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <?php if ($product['status'] == 1): // Only show active products ?>
                            <tr>
                                <td><?= esc($product['name']) ?></td>
                                <td><?= esc($product['stock_in']) ?></td>
                                <td><?= esc($product['stock_out']) ?></td>
                                <td><?= esc($product['remaining_stock']) ?></td>
                                <td class="actions">
                                    <form action="/inventory/add-stock/<?= $product['id'] ?>" method="post" class="d-inline">
                                        <input type="number" name="quantity" min="1" required class="form-control form-control-sm">
                                        <button type="submit" class="btn btn-success btn-sm">Add Stock</button>
                                    </form>
                                    <form action="/inventory/remove-stock/<?= $product['id'] ?>" method="post" class="d-inline">
                                        <input type="number" name="quantity" min="1" required class="form-control form-control-sm">
                                        <button type="submit" class="btn btn-danger btn-sm">Remove Stock</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for Sidebar Toggle
        const toggleBtn = document.getElementById('toggle-btn');
        const closeBtn = document.getElementById('close-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        // Toggle the sidebar on smaller screens
        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
        });

        // Close the sidebar when clicking the close button
        closeBtn.addEventListener('click', function () {
            sidebar.classList.remove('active');
            mainContent.classList.remove('active');
        });

        // Close sidebar if user clicks outside
        document.addEventListener('click', function (event) {
            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target) && !closeBtn.contains(event.target)) {
                sidebar.classList.remove('active');
                mainContent.classList.remove('active');
            }
        });

        // Automatically open sidebar on larger screens
        window.onload = function () {
            if (window.innerWidth > 768) {
                sidebar.classList.add('active');
                mainContent.classList.add('active');
            }
        };

        // Handle window resize
        window.onresize = function () {
            if (window.innerWidth > 768) {
                sidebar.classList.add('active');
                mainContent.classList.add('active');
            } else {
                sidebar.classList.remove('active');
                mainContent.classList.remove('active');
            }
        };
    </script>
</body>
</html>