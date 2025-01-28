<?= $this->extend('layouts/main') ?> <!-- Assuming you have a layout file -->

<?= $this->section('content') ?>

<div class="container mt-4">
    <h1>Welcome, <?= session('name') ?>!</h1> <!-- Employee's name -->

    <!-- Dashboard Overview -->
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5 class="card-title">Items in Stock</h5>
                    <p class="card-text"><?= $stock_count ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5 class="card-title">Pending Orders</h5>
                    <p class="card-text"><?= $pending_orders ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5 class="card-title">Notifications</h5>
                    <p class="card-text"><?= $notifications_count ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Tracking Section -->
    <div class="mt-5">
        <h2>Order Tracking</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= $order['item_name'] ?></td>
                        <td><?= $order['quantity'] ?></td>
                        <td><?= $order['status'] ?></td>
                        <td><?= $order['updated_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Inventory Section -->
    <div class="mt-5">
        <h2>Inventory</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inventory as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['stock'] ?></td>
                        <td>
                            <form action="<?= base_url('employee/request_item') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-primary">Request Item</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
