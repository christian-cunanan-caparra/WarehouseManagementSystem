<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .table-responsive { overflow-x: auto; }
        .table th, .table td { white-space: nowrap; }

        /* Custom styling for the page */
        .card {
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-title, .card-text {
            color: #333;
        }
        .btn {
            border-radius: 5px;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -270px;
            width: 270px;
            height: 100%;
            background: rgba(22, 26, 45, 0.9);
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

        .content {
            margin-left: 50px;
            padding: 30px;
            transition: margin-left 0.4s ease;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .content.active {
            margin-left: 270px;
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
        <li><a href="/inventory_logs"><span class="material-icons">storage</span> Inventory Logs</a></li>
    </ul>
</aside>

<!-- Toggle Button -->
<button class="toggle-btn" id="toggle-btn">&#9776;</button>

<!-- Main Content -->
<div class="content" id="main-content">
    <h1 class="text-center">Inventory Management</h1>

    <!-- Inventory Table -->
    <div class="table-responsive">
        <table class="table table-striped">
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
                <tr>
                    <td><?= esc($product['name']) ?></td>
                    <td><?= esc($product['stock_in']) ?></td>
                    <td><?= esc($product['stock_out']) ?></td>
                    <td><?= esc($product['remaining_stock']) ?></td>
                    <td>
                        <form action="/inventory/add-stock/<?= $product['id'] ?>" method="post" class="d-inline">
                            <input type="number" name="quantity" min="1" required>
                            <button type="submit" class="btn btn-success btn-sm">Add Stock</button>
                        </form>

                        <form action="/inventory/remove-stock/<?= $product['id'] ?>" method="post" class="d-inline">
                            <input type="number" name="quantity" min="1" required>
                            <button type="submit" class="btn btn-danger btn-sm">Remove Stock</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    const toggleBtn = document.getElementById('toggle-btn');
    const closeBtn = document.getElementById('close-btn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    window.onload = function() {
        if (window.innerWidth > 768) {
            sidebar.classList.add('active');
            mainContent.classList.add('active');
            toggleBtn.style.display = 'block';
        } else {
            sidebar.classList.remove('active');
            mainContent.classList.remove('active');
            toggleBtn.style.display = 'block';
        }
    };

    toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        mainContent.classList.toggle('active');
    });

    closeBtn.addEventListener('click', function() {
        sidebar.classList.remove('active');
        mainContent.classList.remove('active');
    });

    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target) && !closeBtn.contains(event.target)) {
            sidebar.classList.remove('active');
            mainContent.classList.remove('active');
        }
    });

    window.onresize = function() {
        if (window.innerWidth > 768) {
            sidebar.classList.add('active');
            mainContent.classList.add('active');
            toggleBtn.style.display = 'block';
        } else {
            sidebar.classList.remove('active');
            mainContent.classList.remove('active');
            toggleBtn.style.display = 'block';
        }
    };
</script>

</body>
</html>
