<table class="table">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Action</th>
            <th>Quantity</th>
            <th>Performed By</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($logs)): ?>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?= esc($log['product_name']) ?></td>
                    <td><?= esc($log['action']) ?></td>
                    <td><?= esc($log['quantity']) ?></td>
                    <td><?= esc($log['user_name']) ?></td>
                    <td><?= esc($log['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">No logs available</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
