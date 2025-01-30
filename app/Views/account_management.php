<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <!-- Include Bootstrap and other styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* Include your sidebar and other styles here */
    </style>
</head>
<body>
    <!-- Sidebar -->
    <?= view('sidebar') ?>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <div class="container mt-4">
            <h1>Account Management</h1>
            <a href="/create-account" class="btn btn-primary mb-3">Create New Account</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <a href="/edit-account/<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/delete-account/<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this account?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include your JavaScript for sidebar functionality -->
</body>
</html>