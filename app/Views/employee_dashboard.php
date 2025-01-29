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

        .table-responsive { overflow-x: auto; }
        .table th, .table td { white-space: nowrap; }

        @media (max-width: 768px) {
            .content { margin-left: 0; }
            .sidebar.active { left: 0; }
            .toggle-btn { display: block; }
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


@media (max-width: 768px) {
    /* Adjust sidebar to slide in on smaller screens */
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
                        <tr data-id="<?= esc($product['id']) ?>">
    <td><?= esc($product['id']) ?></td>
    <td class="product-name"><?= esc($product['name']) ?></td>
    <td class="product-description"><?= esc($product['description']) ?></td>
    <td class="product-quantity"><?= esc($product['quantity']) ?></td>
    <td class="product-price"><?= esc($product['price']) ?></td>
    <td><?= $product['status'] == 1 ? 'Active' : 'Inactive' ?></td>
    <td>
        <button class="btn btn-warning btn-sm edit-btn" 
            data-id="<?= esc($product['id']) ?>" 
            data-name="<?= esc($product['name']) ?>" 
            data-description="<?= esc($product['description']) ?>" 
            data-quantity="<?= esc($product['quantity']) ?>" 
            data-price="<?= esc($product['price']) ?>" 
            data-bs-toggle="modal" 
            data-bs-target="#editProductModal">Edit</button>


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
        <!-- Edit Product Modal -->
            <!-- Edit Product Modal -->
            <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
        

     // Edit product button click event
// Script for handling the edit button and populating the modal fields
$(document).on('click', '.edit-btn', function() {
    // Get data from the button
    var productId = $(this).data('id');
    var productName = $(this).data('name');
    var productDescription = $(this).data('description');
    var productQuantity = $(this).data('quantity');
    var productPrice = $(this).data('price');

    // Set the values in the modal form fields
    $('#editProductId').val(productId);
    $('#editProductName').val(productName);
    $('#editProductDescription').val(productDescription);
    $('#editProductQuantity').val(productQuantity);
    $('#editProductPrice').val(productPrice);
});

// AJAX to update the product when the form is submitted
$('#editProductForm').submit(function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    var formData = $(this).serialize(); // Serialize the form data

    $.ajax({
        url: '/dashboard/update/' + $('#editProductId').val(),
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.status === 'success') {
                // Close the modal
                $('#editProductModal').modal('hide');

                // Update the table row with new values
                var productRow = $('tr[data-id="' + $('#editProductId').val() + '"]');
                productRow.find('.product-name').text($('#editProductName').val());
                productRow.find('.product-description').text($('#editProductDescription').val());
                productRow.find('.product-quantity').text($('#editProductQuantity').val());
                productRow.find('.product-price').text($('#editProductPrice').val());

                alert(response.message); // Show success message
            } else {
                alert('Error updating product. Please try again.');
            }
        }
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
