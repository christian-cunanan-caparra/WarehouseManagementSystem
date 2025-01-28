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
            max-width: 800px;
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

        .inventory-table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        .inventory-table th, .inventory-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .inventory-table th {
            background-color: #007bff;
            color: #fff;
        }

        .inventory-table td {
            background-color: #f1f4f9;
        }

        .btn-manage {
            display: inline-block;
            padding: 8px 15px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
        }

        .btn-manage:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h1>Welcome, <?= session()->get('user_name') ?>!</h1>
    <p>You are logged in as an Employee. Here's what you need to do:</p>

    <h3>Your Tasks</h3>
    <ul class="task-list">
        <li><i class="fas fa-check-circle"></i> Task 1: KISS MUNA</li>
        <li><i class="fas fa-check-circle"></i> Task 2: KISS MUNA</li>
        <li><i class="fas fa-check-circle"></i> Task 3: KISS MUNA</li>
    </ul>

    <h3>Warehouse Management</h3>
    <p>Manage and track warehouse inventory below:</p>
    
    <table class="inventory-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Stock Level</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventory as $item): ?>
                <tr>
                    <td><?= $item['product_name'] ?></td>
                    <td><?= $item['stock_level'] ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td>
                        <a href="/manage_inventory/<?= $item['id'] ?>" class="btn-manage">Manage</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="/logout" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
