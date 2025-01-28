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
        /* Sidebar and other styles (same as original) */
        .sidebar { position: fixed; top: 0; left: -270px; width: 270px; height: 100%; background: rgba(22, 26, 45, 0.9); backdrop-filter: blur(10px); color: white; padding: 20px; transition: 0.4s ease-in-out; box-shadow: 3px 0 10px rgba(0, 0, 0, 0.3); z-index: 1000; border-right: 2px solid rgba(255, 255, 255, 0.1); }
        .sidebar.active { left: 0; }
        .sidebar-header { font-size: 1.5rem; font-weight: bold; text-align: center; padding-bottom: 15px; border-bottom: 1px solid rgba(255, 255, 255, 0.2); }
        .sidebar-links { list-style: none; padding: 0; margin-top: 20px; }
        .sidebar-links li { margin-bottom: 15px; }
        .sidebar-links li a { color: white; font-size: 1.1rem; text-decoration: none; display: flex; align-items: center; gap: 12px; padding: 10px; transition: 0.3s ease; border-radius: 6px; }
        .sidebar-links li a:hover { background: rgba(255, 255, 255, 0.2); padding-left: 15px; }
        .menu-separator { margin: 15px 0; height: 1px; background-color: rgba(255, 255, 255, 0.3); }
        .toggle-btn { position: fixed; top: 20px; left: 20px; background: #161a2d; color: white; border: none; padding: 10px; cursor: pointer; font-size: 1.5rem; transition: 0.3s; border-radius: 5px; display: none; }
        .toggle-btn:hover { background: #4f52ba; }
        .content { margin-left: 50px; padding: 30px; transition: margin-left 0.4s ease; background: #f8f9fa; min-height: 100vh; }
        .content.active { margin-left: 270px; }
        .card { border-radius: 12px; transition: 0.3s ease-in-out; text-align: center; }
        .card:hover { transform: scale(1.05); }
        .card .material-icons { font-size: 4rem; opacity: 0.8; }
        @media (max-width: 768px) { .sidebar { left: -270px; } .sidebar.active { left: 0; } .content { margin-left: 0; } .content.active { margin-left: 270px; } .toggle-btn { display: block; } }
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
        </ul>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h1>Dashboard</h1>
        <p>Welcome to the Warehouse Management System. Here you can manage inventory, view products, and more.</p>

        <!-- Product Count Card -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Products</h5>
                            <h3 class="card-text"><?= count($products) ?></h3>
                        </div>
                        <span class="material-icons">inventory</span>
                    </div>
                </div>
            </div>
        </div>

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
                        <?php if ($product['status'] == 1): ?>
                            <tr>
                                <td><?= esc($product['id']) ?></td>
                                <td><?= esc($product['name']) ?></td>
                                <td><?= esc($product['description']) ?></td>
                                <td><?= esc($product['quantity']) ?></td>
                                <td><?= esc($product['price']) ?></td>
                                <td><?= $product['status'] == 1 ? 'Active' : 'Inactive' ?></td>
                                <td>
                                    <a href="/employee_dashboard/edit/<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/employee_dashboard/delete/<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Deactivate</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No active products available.</p>
        <?php endif; ?>

        <!-- Button to trigger modal -->
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add New Product</a>
    </div>

    <!-- Modal for Adding Product -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Product Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Handle form submission via AJAX
        $('#addProductForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: '/employee_dashboard/store', // Send the data to the backend
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        $('#addProductModal').modal('hide'); // Hide the modal
                        location.reload(); // Reload the page to reflect the new product
                    } else {
                        alert('Error adding product!');
                    }
                },
                error: function() {
                    alert('Error occurred!');
                }
            });
        });
    </script>
</body>
</html>
