<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Welcome, <?= esc($user_name); ?>!</h1>  <!-- Display the logged-in admin's name -->
    <a href="/logout" class="btn btn-danger">Logout</a>
    <h1>Welcome, <?= session()->get('userName') ?></h1>
<p>Role: <?= session()->get('role') ?: 'Not assigned' ?></p>  <!-- Fallback if no role -->


</div>
</body>
</html>
