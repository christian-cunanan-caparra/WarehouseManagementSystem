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
        /* ---- Sidebar Styling ---- */
        .sidebar {
            position: fixed;
            top: 0;
            left: -270px;
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
            left: 0;
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

        /* ---- Close Button ---- */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            color: white;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .close-btn:hover {
            color: #f00;
        }

        /* ---- Sidebar Toggle Button ---- */
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
            display: none;
        }

        .toggle-btn:hover {
            background: #4f52ba;
        }

        /* ---- Main Content ---- */
        .content {
            margin-left: 50px;  /* Start with no margin */
            padding: 30px;
            transition: margin-left 0.4s ease;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .content.active {
            margin-left: 270px;  /* Push content when sidebar is active */
        }

        /* ---- Responsive Design ---- */
        @media (max-width: 768px) {
            .sidebar {
                left: -270px;
            }

            .sidebar.active {
                left: 0;
            }

            .content {
                margin-left: 0;
            }

            .content.active {
                margin-left: 270px;
            }

            .toggle-btn {
                display: block;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <button class="close-btn" id="close-btn">&times;</button>
        <div class="sidebar-header">Warehouse Management System</div>
        <ul class="sidebar-links">
            <h4>Main Menu</h4>
            <li><a href="#"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="#"><span class="material-icons">inventory</span> Products</a></li>
            <li><a href="#"><span class="material-icons">settings</span> Settings</a></li>
            <div class="menu-separator"></div>
            <h4>Resume</h4>
            <li><a href="index.html"><span class="material-icons">account_circle</span> Christian Caparra</a></li>
            <li><a href="jhuniel.html"><span class="material-icons">account_circle</span> Jhuniel Galang</a></li>
        </ul>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h1> Dashboard</h1>
        <p>Welcome to the Warehouse Management System. Here you can manage inventory, view products, and more.</p>

        <!-- Product Table -->
        <h2>Product List</h2>
        <?php if (!empty($products)): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <?php if ($product['status'] == 1): ?> <!-- Only show active products -->
                    <tr>
                        <td><?= esc($product['id']) ?></td>
                        <td><?= esc($product['name']) ?></td>
                        <td><?= esc($product['description']) ?></td>
                        <td><?= esc($product['quantity']) ?></td>
                        <td><?= esc($product['price']) ?></td>
                        <td><?= $product['status'] == 1 ? 'Active' : 'Inactive' ?></td>
                        <td>
                            <a href="/employee_dashboard/edit/<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/employee_dashboard/delete/<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to deactivate this product?')">Deactivate</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No active products available. Please add some products.</p>
<?php endif; ?>

        <a href="/employee_dashboard/create" class="btn btn-primary">Add New Product</a>
    </div>

    <script>
        // Sidebar Toggle Script
        const sidebar = document.getElementById('sidebar');
        const closeBtn = document.getElementById('close-btn');
        const toggleBtn = document.getElementById('toggle-btn');
        const mainContent = document.getElementById('main-content');

        // Automatically show the sidebar when the page loads
        window.onload = () => {
            sidebar.classList.add('active');
            mainContent.classList.add('active');  // Ensure content takes full space when sidebar is active
        };

        // Close the sidebar when the close button is clicked
        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
            mainContent.classList.remove('active');  // Adjust content margin when sidebar is closed
            toggleBtn.style.display = 'block';
        });

        // Show the sidebar when the toggle button is clicked
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.add('active');
            mainContent.classList.add('active');  // Ensure content is pushed to the side when sidebar is opened
            toggleBtn.style.display = 'none';
        });
    </script>

</body>
</html>
