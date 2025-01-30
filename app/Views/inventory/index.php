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
            left: -270px; /* Initially hidden */
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

        .menu-separator {
            margin: 15px 0;
            height: 1px;
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* Toggle Button for mobile */
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
        }

        .toggle-btn:hover {
            background: #4f52ba;
        }

        /* Content styles */
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
    <div class="sidebar-header">Warehouse Management</div>
    <ul class="sidebar-links">
        <li><a href="/employee_dashboard"><span class="material-icons">dashboard</span> Dashboard</a></li>
        <li><a href="/product"><span class="material-icons">inventory</span> Products</a></li>
        <li><a href="/inventory"><span class="material-icons">storage</span> Inventory</a></li>
        <li><a href="/inventory_logs"><span class="material-icons">inventory_2</span> Inventory Logs</a></li>
        <li><a href="/reports"><span class="material-icons">bar_chart</span> Reports</a></li>
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
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addStockModal" 
                        data-id="<?= $product['id'] ?>" data-name="<?= esc($product['name']) ?>">
                        Add Stock
                    </button>

                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeStockModal" 
                        data-id="<?= $product['id'] ?>" data-name="<?= esc($product['name']) ?>">
                        Remove Stock
                    </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<!-- Add Stock Modal -->


<!-- Add Stock Modal -->
<div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStockLabel">Add Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStockForm" method="post">
                    <input type="hidden" name="product_id" id="addStockProductId">
                    <input type="hidden" name="type" id="addStockType" value="Restock"> <!-- Hidden stock type -->

                    <div class="mb-3">
                        <label class="form-label">Product</label>
                        <input type="text" id="addStockProductName" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" min="1" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Confirm Add Stock</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Remove Stock Modal -->
<div class="modal fade" id="removeStockModal" tabindex="-1" aria-labelledby="removeStockLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeStockLabel">Remove Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="removeStockForm" method="post">
                    <input type="hidden" name="product_id" id="removeStockProductId">
                    <input type="hidden" name="type" id="removeStockType" value="Sold"> <!-- Hidden stock type -->

                    <div class="mb-3">
                        <label class="form-label">Product</label>
                        <input type="text" id="removeStockProductName" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" min="1" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-danger">Confirm Remove Stock</button>
                </form>
            </div>
        </div>
    </div>
</div>




</div>

<script>


 // Fill Add Stock Modal
 document.querySelectorAll('[data-bs-target="#addStockModal"]').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-name');
            document.getElementById('addStockProductId').value = productId;
            document.getElementById('addStockProductName').value = productName;
            document.getElementById('addStockForm').action = `/inventory/add-stock/${productId}`;
        });
    });


    // Fill Remove Stock Modal
    document.querySelectorAll('[data-bs-target="#removeStockModal"]').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-name');
            document.getElementById('removeStockProductId').value = productId;
            document.getElementById('removeStockProductName').value = productName;
            document.getElementById('removeStockForm').action = `/inventory/remove-stock/${productId}`;
        });
    });

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
