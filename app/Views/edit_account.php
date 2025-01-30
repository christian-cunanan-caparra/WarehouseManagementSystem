<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Account</h2>
        <form action="/update-account/<?= esc($user['id']) ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= esc($user['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" required>
            </div>


            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" name="role">
                    <option value="Employee" <?= $user['role'] == 'Employee' ? 'selected' : '' ?>>Employee</option>
                    <option value="Inactive" <?= $user['role'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/account-management" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
