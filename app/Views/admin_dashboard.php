<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Welcome, Admin <?= session()->get('user_name') ?>!</h1>
    <p>You are logged in as an Admin.</p>
    
    <h3>Admin Options</h3>
    <ul>
        <li>Manage Users</li>
        <li>View Reports</li>
        <li>System Settings</li>
    </ul>
    
    <a href="/logout" class="btn btn-danger">Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
