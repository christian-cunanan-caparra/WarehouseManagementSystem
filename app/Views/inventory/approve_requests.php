<h2>Pending Stock Requests</h2>
<table class="table">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Action</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requests as $request): ?>
            <tr>
                <td><?= esc($request['product_name']) ?></td>
                <td><?= esc($request['quantity']) ?></td>
                <td><?= esc($request['action']) ?></td>
                <td><?= esc($request['status']) ?></td>
                <td>
                    <?php if ($request['status'] == 'pending'): ?>
                        <a href="/inventory/approveRejectRequest/<?= $request['id'] ?>/approved" class="btn btn-success">Approve</a>
                        <a href="/inventory/approveRejectRequest/<?= $request['id'] ?>/rejected" class="btn btn-danger">Reject</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
