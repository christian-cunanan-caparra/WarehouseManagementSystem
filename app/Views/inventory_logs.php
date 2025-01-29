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
                    <td><?= $log['product_name'] ?></td>
                    <td><?= $log['action'] ?></td>
                    <td><?= $log['quantity'] ?></td>
                    <td><?= $log['user_name'] ?></td>
                    <td><?= $log['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">No logs available</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
