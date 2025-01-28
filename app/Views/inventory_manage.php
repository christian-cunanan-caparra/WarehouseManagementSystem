<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Manage Inventory: <?= $item['item_name'] ?></h1>
    <form action="/update_inventory/<?= $item['id'] ?>" method="POST">
        <div class="mb-3">
            <label for="stock_level" class="form-label">Stock Level</label>
            <input type="number" class="form-control" id="stock_level" name="stock_level" value="<?= $item['stock_level'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Inventory</button>
    </form>
</div>

</body>
</html>