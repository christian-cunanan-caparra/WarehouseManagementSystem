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
            margin-left: 50px;
            padding: 30px;
            transition: margin-left 0.4s ease;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .content.active {
            margin-left: 270px;
        }

        /* ---- Product Count Card ---- */
        .card {
            border-radius: 12px;
            transition: 0.3s ease-in-out;
            text-align: center;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card .material-icons {
            font-size: 4rem;
            opacity: 0.8;
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

      <!-- Add New Product Button -->
<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add New Product</a>

<!-- Modal for Adding Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Product Creation Form -->
                <form id="addProductForm" method="POST" action="/employee_dashboard/store">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="productQuantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="productPrice" name="price" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Product -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Product Edit Form -->
                <form id="editProductForm" method="POST" action="/employee_dashboard/update/<?= $product['id'] ?>">
                    <input type="hidden" id="editProductId" name="id" value="<?= $product['id'] ?>" />
                    <div class="mb-3">
                        <label for="editProductName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="editProductName" name="name" value="<?= esc($product['name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editProductDescription" name="description" required><?= esc($product['description']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editProductQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="editProductQuantity" name="quantity" value="<?= esc($product['quantity']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="editProductPrice" name="price" value="<?= esc($product['price']) ?>" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const closeBtn = document.getElementById('close-btn');
        const toggleBtn = document.getElementById('toggle-btn');
        const mainContent = document.getElementById('main-content');

        window.onload = () => { sidebar.classList.add('active'); mainContent.classList.add('active'); };
        closeBtn.onclick = () => { sidebar.classList.remove('active'); mainContent.classList.remove('active'); toggleBtn.style.display = 'block'; };
        toggleBtn.onclick = () => { sidebar.classList.add('active'); mainContent.classList.add('active'); toggleBtn.style.display = 'none'; };

        // Handle form submission via AJAX
      
      
      
      
        $(document).ready(function () {
    // Handle form submission for adding a new product
    $('#addProductForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            url: '/employee_dashboard/store', // URL to submit the form data to
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.status === 'success') {
                    // Close the modal and reset the form
                    $('#addProductModal').modal('hide');
                    $('#addProductForm')[0].reset();

                    // Optionally, update the product list dynamically without reloading the page
                    // Example: You can append the new product to your product table here
                    alert(response.message);
                    location.reload(); // Reload the page to see the new product (or update product list dynamically)
                } else {
                    alert(response.message); // Show error message
                }
            },
            error: function (xhr, status, error) {
                alert("An error occurred: " + error);
            }
        });
    });

    // Handle form submission for editing a product
    $('#editProductForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            url: $(this).attr('action'), // The form's action URL (contains product ID)
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.status === 'success') {
                    // Close the modal
                    $('#editProductModal').modal('hide');
                    
                    // Optionally, update the product list dynamically without reloading the page
                    alert(response.message);
                    location.reload(); // Reload the page to see the updated product (or update product list dynamically)
                } else {
                    alert(response.message); // Show error message
                }
            },
            error: function (xhr, status, error) {
                alert("An error occurred: " + error);
            }
        });
    });
    
    // When an "Edit" button is clicked, populate the modal with the product details
    $('.edit-product-btn').on('click', function () {
        var productId = $(this).data('id');
        
        $.ajax({
            url: '/employee_dashboard/edit/' + productId, // Get the product details by ID
            type: 'GET',
            success: function (response) {
                // Assuming response contains product data
                $('#editProductId').val(response.product.id);
                $('#editProductName').val(response.product.name);
                $('#editProductDescription').val(response.product.description);
                $('#editProductQuantity').val(response.product.quantity);
                $('#editProductPrice').val(response.product.price);

                // Show the Edit Modal
                $('#editProductModal').modal('show');
            },
            error: function (xhr, status, error) {
                alert("An error occurred: " + error);
            }
        });
    });
});







    </script>

</body>
</html>
