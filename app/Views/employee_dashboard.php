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
            <li><a href="#" id="add-new-product-btn"><span class="material-icons">inventory</span> Add New Product</a></li>
            <li><a href="#" class="edit-product-btn" data-id="1"><span class="material-icons">settings</span> Edit Product</a></li>
        </ul>
    </aside>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggle-btn">&#9776;</button>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h1>Dashboard</h1>
        <p>Welcome to the Warehouse Management System. Here you can manage inventory, view products, and more.</p>

        <!-- Product Count Card -->
        <div class="row mb-4" id="product-count-container">
            <!-- Dynamic product count will appear here -->
        </div>

        <!-- Product Table -->
        <h2>Product List</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="product-table-body">
                <!-- Product rows will be populated here dynamically -->
            </tbody>
        </table>

        <a href="#" class="btn btn-primary" id="add-new-product-btn">Add New Product</a>
    </div>

    <!-- Modal for Add New Product -->
    <div class="modal fade" id="addNewProductModal" tabindex="-1" aria-labelledby="addNewProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/employee_dashboard/store" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewProductModalLabel">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Sample dynamic data
        const products = [
            { id: 1, name: 'Product 1', description: 'Description 1', quantity: 150, price: 10.50 },
            { id: 2, name: 'Product 2', description: 'Description 2', quantity: 200, price: 20.75 },
            { id: 3, name: 'Product 3', description: 'Description 3', quantity: 300, price: 5.99 }
        ];

        // Function to render the product count
        function renderProductCount() {
            const countContainer = document.getElementById('product-count-container');
            const countCard = document.createElement('div');
            countCard.classList.add('col-md-4');
            countCard.innerHTML = `
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text">${products.length}</p>
                    </div>
                </div>
            `;
            countContainer.appendChild(countCard);
        }

        // Function to render the product table
        function renderProductTable() {
            const tableBody = document.getElementById('product-table-body');
            tableBody.innerHTML = ''; // Clear any existing content
            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.name}</td>
                    <td>${product.description}</td>
                    <td>${product.quantity}</td>
                    <td>$${product.price}</td>
                    <td><button class="btn btn-warning edit-product-btn" data-id="${product.id}">Edit</button></td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Function to edit product
        function editProduct(productId) {
            const product = products.find(p => p.id === productId);
            if (product) {
                document.getElementById('edit-name').value = product.name;
                document.getElementById('edit-description').value = product.description;
                document.getElementById('edit-quantity').value = product.quantity;
                document.getElementById('edit-price').value = product.price;
                const editModal = new bootstrap.Modal(document.getElementById('editProductModal'));
                editModal.show();
            }
        }

        // Handle clicking the "Edit" button
        document.body.addEventListener('click', (e) => {
            if (e.target.classList.contains('edit-product-btn')) {
                const productId = parseInt(e.target.getAttribute('data-id'));
                editProduct(productId);
            }
        });

        // Initial render
        renderProductCount();
        renderProductTable();
    </script>
</body>
</html>
