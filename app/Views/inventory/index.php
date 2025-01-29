<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for better styling */
        .table {
            margin-top: 20px;
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .table tbody tr {
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .table tbody td {
            vertical-align: middle;
            border: none;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
        .btn-sm {
            padding: 5px 10px;
            font-size: 14px;
        }
        .form-control-sm {
            width: 80px;
            display: inline-block;
            margin-right: 5px;
        }
        .actions {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="my-4">Inventory Management</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Stock In</th>
                    <th>Stock Out</th>
                    <th>Remaining Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <?php if ($product['status'] == 1): // Only show active products ?>
                        <tr>
                            <td><?= esc($product['name']) ?></td>
                            <td><?= esc($product['stock_in']) ?></td>
                            <td><?= esc($product['stock_out']) ?></td>
                            <td><?= esc($product['remaining_stock']) ?></td>
                            <td class="actions">
                                <form action="/inventory/add-stock/<?= $product['id'] ?>" method="post" class="d-inline">
                                    <input type="number" name="quantity" min="1" required class="form-control form-control-sm">
                                    <button type="submit" class="btn btn-success btn-sm">Add Stock</button>
                                </form>
                                
                                <form action="/inventory/remove-stock/<?= $product['id'] ?>" method="post" class="d-inline">
                                    <input type="number" name="quantity" min="1" required class="form-control form-control-sm">
                                    <button type="submit" class="btn btn-danger btn-sm">Remove Stock</button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>