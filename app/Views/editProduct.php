
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Product</h1>
        <form action="/update-product/<?= $product['id'] ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= esc($product['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required><?= esc($product['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= esc($product['price']) ?>" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?= esc($product['quantity']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="stock_in" class="form-label">Stock In</label>
                <input type="number" class="form-control" id="stock_in" name="stock_in" value="<?= esc($product['stock_in']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="stock_out" class="form-label">Stock Out</label>
                <input type="number" class="form-control" id="stock_out" name="stock_out" value="<?= esc($product['stock_out']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="remaining_stock" class="form-label">Remaining Stock</label>
                <input type="number" class="form-control" id="remaining_stock" name="remaining_stock" value="<?= esc($product['remaining_stock']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="active" <?= $product['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= $product['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>