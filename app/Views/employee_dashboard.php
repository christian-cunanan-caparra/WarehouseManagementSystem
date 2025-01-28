<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - Warehouse Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<<<<<<< HEAD
<!------ano bago?--------->
    <h1>Inventory Products</h1>
    <a href="/employee_dashboard/create">Add New Product</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['description'] ?></td>
            <td><?= $product['quantity'] ?></td>
            <td><?= $product['price'] ?></td>
            <td>
                <a href="/employee_dashboard/edit/<?= $product['id'] ?>">Edit</a>
                <a href="/employee_dashboard/delete/<?= $product['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
=======
    <div class="container mt-5">
        <h2>Product List</h2>

        <!-- Flash message for success or error -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Check if there are products -->
        <?php if (!empty($products)): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['description'] ?></td>
                    <td><?= $product['quantity'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td>
                        <a href="/employee_dashboard/edit/<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/employee_dashboard/delete/<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No products available. Please add some products.</p>
<?php endif; ?>


        <a href="/employee_dashboard/create" class="btn btn-primary">Add New Product</a>
    </div>

>>>>>>> 47976650d6af624ab331df8444247f172ef69dc5
</body>
</html>
