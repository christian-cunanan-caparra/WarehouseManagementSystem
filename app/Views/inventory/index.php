<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for better styling */
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
            <!-- <a href="/inventory/logs" class="btn btn-primary">View Inventory Logs</a> -->


        </ul>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>
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

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

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
            toggleBtn.style.display = 'block'; // Ensure toggle button is visible on desktop
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
            toggleBtn.style.display = 'block'; // Ensure toggle button is always visible on desktop
        } else {
            sidebar.classList.remove('active');
            mainContent.classList.remove('active');
            toggleBtn.style.display = 'block'; // Show toggle button on mobile
        }
    };




        
        
    </script>

</html>