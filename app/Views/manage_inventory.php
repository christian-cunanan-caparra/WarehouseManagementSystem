<!-- manage_inventory.php -->
<form action="/update_inventory/<?= $item['id'] ?>" method="POST">
    <div class="form-group">
        <label for="product_name">Product Name</label>
        <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $item['product_name'] ?>" readonly>
    </div>
    <div class="form-group">
        <label for="stock_level">Stock Level</label>
        <input type="number" class="form-control" id="stock_level" name="stock_level" value="<?= $item['stock_level'] ?>">
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" class="form-control" id="price" name="price" value="<?= $item['price'] ?>" readonly>
    </div>
    <button type="submit" class="btn btn-primary">Update Stock</button>
</form>
