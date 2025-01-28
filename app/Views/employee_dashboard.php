<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Dashboard</title>
</head>
<body>

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
</body>
</html>