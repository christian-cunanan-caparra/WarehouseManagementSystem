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
            left: -270px;
            width: 270px;
            height: 100%;
            background: rgba(22, 26, 45, 0.9);
            backdrop-filter: blur(10px);
            color: white;
            padding: 20px;
            transition: 0.4s ease-in-out;
            z-index: 1000;
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
            border-radius: 5px;
            z-index: 1001;
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
        }
    </style>
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">Inventory Management</div>
        <ul class="sidebar-links">
            <li><a href="#"><span class="material-icons">dashboard</span> Dashboard</a></li>
            <li><a href="#"><span class="material-icons">inventory</span> Products</a></li>
            <li><a href="#"><span class="material-icons">storage</span> Inventory</a></li>
        </ul>
    </aside>

    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <div class="content" id="main-content">
        <div class="container">
            <h2 class="my-4">Inventory Management</h2>
            <div class="table-responsive">
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
    </div>

    <script>
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        window.onload = function() {
            if (window.innerWidth > 768) {
                sidebar.classList.add('active');
                mainContent.classList.add('active');
            } else {
                sidebar.classList.remove('active');
                mainContent.classList.remove('active');
            }
        };

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
        });

        window.onresize = function() {
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

