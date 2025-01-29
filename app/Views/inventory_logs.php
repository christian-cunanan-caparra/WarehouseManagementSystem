<h2>Inventory Logs</h2>

<table class="table">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Action</th>
            <th>Quantity</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log): ?>
        <tr>
            <td><?= esc($log['name']) ?></td>
            <td><?= ($log['action'] == 'Added') ? '<span class="text-success">Stock In</span>' : '<span class="text-danger">Stock Out</span>' ?></td>
            <td><?= esc($log['quantity']) ?></td>
            <td><?= esc($log['created_at']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
