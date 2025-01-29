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
        /* Styles for responsive sidebar */
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
            transition: 0.4s;
            z-index: 1000;
        }

        .sidebar.active { left: 0; }
        .toggle-btn { position: fixed; top: 20px; left: 20px; background: #161a2d; color: white; padding: 10px; cursor: pointer; border-radius: 5px; }
        .toggle-btn:hover { background: #4f52ba; }

        .content {
            margin-left: 50px;
            padding: 30px;
            transition: margin-left 0.4s;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .content.active { margin-left: 270px; }

        .table-responsive { overflow-x: auto; }
        .table th, .table td { white-space: nowrap; }

        @media (max-width: 768px) {
            .content { margin-left: 0; }
            .sidebar.active { left: 0; }
            .toggle-btn { display: block; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <button class="close-btn" id="close-btn">&times;</button>
        <div class="sidebar-header">Warehouse Management</div>
        <ul class="sidebar-links">
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
        <p>Manage your inventory here.</p>

        <!-- Product Count -->
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
        <div class="table-responsive">
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
                <tbody id="productTable">
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= esc($product['id']) ?></td>
                            <td><?= esc($product['name']) ?></td>
                            <td><?= esc($product['description']) ?></td>
                            <td><?= esc($product['quantity']) ?></td>
                            <td><?= esc($product['price']) ?></td>
                            <td><?= $product['status'] == 1 ? 'Active' : 'Inactive' ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-btn" data-id="<?= $product['id'] ?>" data-name="<?= esc($product['name']) ?>" data-description="<?= esc($product['description']) ?>" data-quantity="<?= esc($product['quantity']) ?>" data-price="<?= esc($product['price']) ?>" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit</button>
                                <a href="/employee_dashboard/delete/<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Deactivate</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Add Product Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add New Product</button>

        <!-- Add Product Modal -->
        <div class="modal fade" id="addProductModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addProductForm">
                            <input type="text" class="form-control mb-2" id="productName" name="name" placeholder="Product Name" required>
                            <textarea class="form-control mb-2" id="productDescription" name="description" placeholder="Description" required></textarea>
                            <input type="number" class="form-control mb-2" id="productQuantity" name="quantity" placeholder="Quantity" required>
                            <input type="number" class="form-control mb-2" id="productPrice" name="price" placeholder="Price" required>
                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Product Modal -->
        <div class="modal fade" id="editProductModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editProductForm">
                            <input type="hidden" id="editProductId" name="id">
                            <input type="text" class="form-control mb-2" id="editProductName" name="name" required>
                            <textarea class="form-control mb-2" id="editProductDescription" name="description" required></textarea>
                            <input type="number" class="form-control mb-2" id="editProductQuantity" name="quantity" required>
                            <input type="number" class="form-control mb-2" id="editProductPrice" name="price" required>
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script for editing products
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('editProductId').value = this.dataset.id;
                document.getElementById('editProductName').value = this.dataset.name;
                document.getElementById('editProductDescription').value = this.dataset.description;
                document.getElementById('editProductQuantity').value = this.dataset.quantity;
                document.getElementById('editProductPrice').value = this.dataset.price;
            });
        });

        // AJAX for adding product
        document.getElementById('addProductForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let data = new FormData(this);
            fetch('/employee_dashboard/addProduct', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(result => {
                if(result.success) {
                    alert(result.message);
                    window.location.reload(); // Reload the page to update the list
                }
            });
        });

        // AJAX for updating product
        document.getElementById('editProductForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let data = new FormData(this);
            fetch('/employee_dashboard/updateProduct', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(result => {
                if(result.success) {
                    alert(result.message);
                    window.location.reload(); // Reload the page to update the list
                }
            });
        });


        const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    // Add event listener to toggle sidebar on/off
    toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        mainContent.classList.toggle('active'); // Adjust main content position when sidebar is active
    });

    // Optional: Close sidebar if the user clicks outside
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
            sidebar.classList.remove('active');
            mainContent.classList.remove('active');
        }
    });

    </script>

</body>
</html>
