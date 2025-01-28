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
        /* Sidebar and other custom styles */
        body {
            font-family: 'Arial', sans-serif;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            background-color: #333;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .content h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        .modal-header .btn-close {
            margin-top: 0;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2 class="text-white text-center">Dashboard</h2>
        <a href="#" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</a>
        <a href="/dashboard/logout">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1>Product List</h1>
        <div class="row">
            <?php foreach($products as $product): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name']; ?></h5>
                            <p class="card-text"><?= $product['description']; ?></p>
                            <p><strong>Price: </strong> $<?= $product['price']; ?></p>
                            <p><strong>Quantity: </strong> <?= $product['quantity']; ?></p>
                            <button class="btn btn-warning edit-btn" data-id="<?= $product['id']; ?>" data-name="<?= $product['name']; ?>" data-description="<?= $product['description']; ?>" data-quantity="<?= $product['quantity']; ?>" data-price="<?= $product['price']; ?>" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit</button>
                            <a href="/dashboard/delete/<?= $product['id']; ?>" class="btn btn-danger">Deactivate</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Add Product Modal -->
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
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="editProductName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editProductDescription" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editProductQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="editProductQuantity" name="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="editProductPrice" name="price" required>
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

    <!-- JavaScript -->
    <script>
        // Edit Product Functionality
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.id;
                const productName = this.dataset.name;
                const productDescription = this.dataset.description;
                const productQuantity = this.dataset.quantity;
                const productPrice = this.dataset.price;

                // Populate the modal form with the product's data
                document.getElementById('editProductId').value = productId;
                document.getElementById('editProductName').value = productName;
                document.getElementById('editProductDescription').value = productDescription;
                document.getElementById('editProductQuantity').value = productQuantity;
                document.getElementById('editProductPrice').value = productPrice;

                const modal = new bootstrap.Modal(document.getElementById('editProductModal'));
                modal.show();
            });
        });

        // Handle adding product
        document.getElementById('addProductForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('/dashboard/store', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Product added successfully!');
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });

        // Handle updating product
        document.getElementById('editProductForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('/dashboard/update', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Product updated successfully!');
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });
    </script>

</body>
</html>
