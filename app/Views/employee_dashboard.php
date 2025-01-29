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
                            <td><?= esc($product['id']) ?></td>
                            <td><?= esc($product['name']) ?></td>
                            <td><?= esc($product['description']) ?></td>
                            <td><?= esc($product['quantity']) ?></td>
                            <td><?= esc($product['price']) ?></td>
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
                  <!-- Hidden ID field to pass the product ID -->
<input type="hidden" id="id" name="id">

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
                    <button type="submit" class="btn btn-primary w-100">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</div>


    </div>

    <script>
        // Script for editing products
        document.addEventListener('DOMContentLoaded', function() {
    // Select all edit buttons and add event listeners
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Get the data-* attributes from the clicked button
            const id = this.dataset.id;
            const name = this.dataset.name;
            const description = this.dataset.description;
            const quantity = this.dataset.quantity;
            const price = this.dataset.price;

            // Populate the modal form fields
            document.getElementById('id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('description').value = description;
            document.getElementById('quantity').value = quantity;
            document.getElementById('price').value = price;
        });
    });
});




        // AJAX for adding product
       
        // AJAX for adding product
document.getElementById('addProductForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let data = new FormData(this);
    fetch('/employee_dashboard/store', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(result => {
        if(result.success) {
            alert(result.message);

            // Optionally, update the table dynamically (no page reload)
            let table = document.getElementById('productTable');
            let row = table.insertRow();
            row.innerHTML = `
                <td>${result.product.id}</td>
                <td>${result.product.name}</td>
                <td>${result.product.description}</td>
                <td>${result.product.quantity}</td>
                <td>${result.product.price}</td>
                <td>${result.product.status == 1 ? 'Active' : 'Inactive'}</td>
                <td>
                    <button class="btn btn-warning btn-sm edit-btn" data-id="${result.product.id}" data-name="${result.product.name}" data-description="${result.product.description}" data-quantity="${result.product.quantity}" data-price="${result.product.price}" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit</button>
                    <a href="/employee_dashboard/delete/${result.product.id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Deactivate</a>
                </td>
            `;
            // Close the modal
            $('#addProductModal').modal('hide');
        } else {
            alert(result.message);
        }
    })
    .catch(error => {
        alert('Error: ' + error);
    });
});





        // AJAX for updating product
       // AJAX for updating product
document.getElementById('editProductForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let data = new FormData(this);
    fetch('/employee_dashboard/update', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(result => {
        if(result.success) {
            alert(result.message);

            // Optionally, update the table dynamically (no page reload)
            let rows = document.querySelectorAll('#productTable tr');
            rows.forEach(row => {
                let idCell = row.cells[0];
                if (idCell && idCell.textContent == result.product.id) {
                    row.cells[1].textContent = result.product.name;
                    row.cells[2].textContent = result.product.description;
                    row.cells[3].textContent = result.product.quantity;
                    row.cells[4].textContent = result.product.price;
                    row.cells[5].textContent = result.product.status == 1 ? 'Active' : 'Inactive';
                }
            });

            // Close the modal
            $('#editProductModal').modal('hide');
        } else {
            alert(result.message);
        }
    })
    .catch(error => {
        alert('Error: ' + error);
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
