<h2>Inventory Management</h2>

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
                    <td>
                        <form action="/inventory/add-stock/<?= $product['id'] ?>" method="post" class="d-inline">
                            <input type="number" name="quantity" min="1" required>
                            <button type="submit" class="btn btn-success btn-sm">Add Stock</button>
                        </form>
                        
                        <form action="/inventory/remove-stock/<?= $product['id'] ?>" method="post" class="d-inline">
                            <input type="number" name="quantity" min="1" required>
                            <button type="submit" class="btn btn-danger btn-sm">Remove Stock</button>
                        </form>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>
