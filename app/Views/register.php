<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Register to Warehouse Management System</h2>

    <?php if (session()->get('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach (session()->get('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach ?>
        </div>
    <?php endif; ?>

    <!-- Registration Form -->
    <form action="/register/save" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= old('address') ?>" required>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="Male" <?= old('gender') == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= old('gender') == 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Other" <?= old('gender') == 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="mobile_number" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?= old('mobile_number') ?>" required>
        </div>

        <!-- Hidden role field (set to Employee in controller) -->
        <input type="hidden" name="role" value="Employee">

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<!-- Modal for Registration Success -->
<?php if (session()->getFlashdata('success')): ?>
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Registration Successful</h5>
            </div>
            <div class="modal-body">
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Show the modal when the page loads
    document.addEventListener('DOMContentLoaded', function () {
        var myModal = new bootstrap.Modal(document.getElementById('successModal'));
        myModal.show();

        // After 3 seconds, automatically close the modal and redirect to the index page
        setTimeout(function() {
            myModal.hide();
            window.location.href = '/'; // Redirect to the index page
        }, 3000); // 3000ms = 3 seconds
    });
</script>
<?php endif; ?>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
