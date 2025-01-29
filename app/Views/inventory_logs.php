<table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Action</th>
            <th>Quantity</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log): ?>
        <tr>
            <td><?= esc($log['product_id']) ?></td>
            <td><?= esc($log['action']) ?></td>
            <td><?= esc($log['quantity']) ?></td>
            <td><?= esc($log['created_at']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
