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

        /* Button styles */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Modal styles */
        .modal-header {
            background-color: #f8f9fa;
        }

        .modal-title {
            color: #161a2d;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                left: -270px; /* Initially hidden */
            }

            .sidebar.active {
                left: 0; /* Show the sidebar when active */
            }

            .content {
                margin-left: 0;
            }

            .content.active {
                margin-left: 270px; /* Push content to the right when sidebar is active */
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
            <li><a href="/inventory_logs"><span class="material-icons">storage</span> Inventory Logs</a></li>
        </ul>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h2 class="text-center">Product List</h2>
        
        <!-- Add Product Button -->
        <div class="d-flex justify-content-end" style="padding-bottom: 10px;">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add New Product</button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                       
                        <th>Price</th>
                       
                        <th>Stock In</th>
                        <th>Stock Out</th>
                        <th>Inventory Stock</th>
                        <!-- <th>Actions</th> -->
                    </tr>
                </thead>
                <tbody id="productTable">
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= esc($product['id']) ?></td>
                            <td><?= esc($product['name']) ?></td>
                            <td><?= esc($product['description']) ?></td>
                        
                            <td><?= esc($product['price']) ?></td>
                          
                            <td><?= esc($product['stock_in']) ?></td>
                            <td><?= esc($product['stock_out']) ?></td>
                            <td><?= esc($product['remaining_stock']) ?></td>
                            <td>
                                <!-- <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addStockModal" data-id="<?= $product['id'] ?>">Add Stock</button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeStockModal" data-id="<?= $product['id'] ?>">Reduce Stock</button>
                            </td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

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
            fetch('/employee_dashboard/store', {
                method: 'POST',
                body: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Ensure the server recognizes this as an AJAX request
                }
            })
            .then(response => response.json())
            .then(result => {
                if(result.status === 'success') {
                    alert(result.message);
                    window.location.reload(); // Reload the page to update the list
                } else {
                    alert(result.message || 'Failed to add product.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding the product.');
            });
        });

        // AJAX for updating product
        document.getElementById('editProductForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let data = new FormData(this);
            fetch('/employee_dashboard/update/' + document.getElementById('editProductId').value, {
                method: 'POST',
                body: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Ensure the server recognizes this as an AJAX request
                }
            })
            .then(response => response.json())
            .then(result => {
                if(result.message) {
                    alert(result.message);
                    window.location.reload(); // Reload the page to update the list
                } else {
                    alert('Failed to update product.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the product.');
            });
        });

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

</body>
</html>