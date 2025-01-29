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
        <?php foreach ($logs as $log): ?>
        <tr>
            <td><?= $log['product_name'] ?></td>
            <td><?= $log['action'] ?></td>
            <td><?= $log['quantity'] ?></td>
            <td><?= $log['user_name'] ?></td>
            <td><?= $log['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
