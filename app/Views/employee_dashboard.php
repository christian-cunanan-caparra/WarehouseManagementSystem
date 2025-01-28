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
        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: -270px;
            width: 270px;
            height: 100%;
            background: rgba(22, 26, 45, 0.9);
            color: white;
            padding: 20px;
            transition: left 0.3s ease;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
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

        /* Toggle Button Styling */
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
        }

        .toggle-btn:hover {
            background: #4f52ba;
        }

        /* Main Content Styling */
        .content {
            margin-left: 270px;
            padding: 30px;
            transition: margin-left 0.3s ease;
        }

        .content.active {
            margin-left: 0;
        }

        /* Modal Styling */
        .modal-dialog {
            max-width: 600px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
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
        <p>Welcome to the Warehouse Management System. Manage inventory, view products, and more.</p>

        <!-- Add New Product Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add New Product</button>

        <!-- Product Count Card -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Products</h5>
                            <h3 class="card-text" id="total-products">0</h3>
                        </div>
                        <span class="material-icons">inventory</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product List Table -->
        <h2>Product List</h2>
        <table class="table table-striped" id="product-table">
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
                <!-- Products will be injected here -->
            </tbody>
        </table>
    </div>

    <!-- Modal for Adding New Product -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-product-form">
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

    <script>
        // Toggle sidebar visibility
        document.getElementById('toggle-btn').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('main-content').classList.toggle('active');
        });

        // Sample data for the product list (replace with dynamic data from backend)
        const products = [
            { id: 1, name: 'Product 1', description: 'Description 1', quantity: 10, price: 100, status: 'Active' },
            { id: 2, name: 'Product 2', description: 'Description 2', quantity: 20, price: 200, status: 'Active' }
        ];

        // Function to display products in the table
        function displayProducts() {
            const tableBody = document.querySelector('#product-table tbody');
            tableBody.innerHTML = '';
            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.description}</td>
                    <td>${product.quantity}</td>
                    <td>${product.price}</td>
                    <td>${product.status}</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Deactivate</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            // Update the total product count
            document.getElementById('total-products').textContent = products.length;
        }

        // Handle form submission to add a new product
        document.getElementById('add-product-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const newProduct = {
                id: products.length + 1,
                name: document.getElementById('name').value,
                description: document.getElementById('description').value,
                quantity: document.getElementById('quantity').value,
                price: document.getElementById('price').value,
                status: 'Active'
            };

            products.push(newProduct);  // Add new product to the list
            displayProducts();  // Update the table and product count

            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addProductModal'));
            modal.hide();
        });

        // Display products initially
        displayProducts();
    </script>

</body>
</html>
