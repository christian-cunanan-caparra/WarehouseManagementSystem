<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
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

        .options-list {
            list-style: none;
            padding: 0;
        }

        .options-list li {
            background-color: #e9ecef;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            font-size: 16px;
            color: #495057;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
        }

        .options-list li:hover {
            background-color: #007bff;
            color: #ffffff;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
        }

        .options-list li i {
            margin-right: 10px;
            color: #007bff;
        }

        .options-list li:hover i {
            color: #ffffff;
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
    <h1>Welcome, Admin <?= session()->get('user_name') ?>!</h1>
    <p>You are logged in as an Admin.</p>

    <h3>Admin Options</h3>
    <ul class="options-list">
        <li><i class="fas fa-users"></i> Manage Users</li>
        <li><i class="fas fa-chart-line"></i> View Reports</li>
        <li><i class="fas fa-cogs"></i> System Settings</li>
    </ul>

    <a href="/logout" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
