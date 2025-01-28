<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* General body styling */
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dashboard-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 900px;
            width: 90%;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            color: #007bff;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .task-list {
            padding: 0;
            list-style: none;
        }

        .task-list li {
            background-color: #f1f4f9;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            font-size: 16px;
            color: #495057;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .task-list li i {
            color: #007bff;
            margin-right: 10px;
        }

        .btn-logout {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #dc3545;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            text-align: center;
            font-weight: 600;
            text-transform: uppercase;
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #c82333;
            box-shadow: 0 6px 15px rgba(220, 53, 69, 0.4);
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h1>Welcome, <?= session()->get('user_name') ?>!</h1>
    <p>You are logged in as an Employee. Here's what you need to do:</p>

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

    <a href="/logout" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
