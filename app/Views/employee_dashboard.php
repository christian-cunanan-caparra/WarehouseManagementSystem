<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Welcome, <?= session()->get('user_name') ?>!</h1>
    <p>You are logged in as an Employee. Here's the inventory you need to manage:</p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Stock Level</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($inventory)): ?>
                <?php foreach ($inventory as $item): ?>
                    <tr>
                        <td><?= $item->product_name ?></td>
                        <td><?= $item->stock_level ?></td>
                        <td>$<?= number_format($item->price, 2) ?></td>
                        <td>
                            <a href="/manage_inventory/<?= $item->id ?>" class="btn btn-primary">Manage</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No inventory items available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>