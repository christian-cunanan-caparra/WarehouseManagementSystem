<?= session()->getFlashdata('success') ? '<p class="alert alert-success">'.session()->getFlashdata('success').'</p>' : '' ?>
<?= session()->getFlashdata('error') ? '<p class="alert alert-danger">'.session()->getFlashdata('error').'</p>' : '' ?>

<h2>Stock Removal Requests</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Requested At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requests as $request): ?>
            <tr>
                <td><?= esc($request['name']) ?></td>
                <td><?= esc($request['quantity']) ?></td>
                <td><?= esc($request['requested_at']) ?></td>
                <td>
                    <a href="/inventory/approveRemoval/<?= $request['id'] ?>" class="btn btn-success btn-sm">Approve</a>
                    <a href="/inventory/rejectRemoval/<?= $request['id'] ?>" class="btn btn-danger btn-sm">Reject</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
