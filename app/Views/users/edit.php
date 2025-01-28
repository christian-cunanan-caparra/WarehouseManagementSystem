<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit User</h2>
    
    <!-- Display validation errors if any -->
    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="/users/update/<?= $user['id'] ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $user['name']) ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $user['email']) ?>">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= old('address', $user['address']) ?>">
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender">
                <option value="male" <?= old('gender', $user['gender']) == 'male' ? 'selected' : '' ?>>Male</option>
                <option value="female" <?= old('gender', $user['gender']) == 'female' ? 'selected' : '' ?>>Female</option>
                <option value="other" <?= old('gender', $user['gender']) == 'other' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="mobile_number" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?= old('mobile_number', $user['mobile_number']) ?>">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <input type="text" class="form-control" id="role" name="role" value="<?= old('role', $user['role']) ?>">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (Leave empty to keep current password)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <button type="submit" class="btn btn-warning">Update User</button>
        <a href="/users" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
