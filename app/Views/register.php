<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Include Bootstrap for Modal Styling (Optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <h1>Register</h1>

    <!-- Display Validation Errors -->
    <?php if (session()->get('errors')): ?>
        <div class="errors">
            <?php foreach (session()->get('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach ?>
        </div>
    <?php endif; ?>

    <!-- Registration Form -->
    <form action="/register/save" method="POST">
        <?= csrf_field() ?>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= old('name') ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= old('email') ?>"><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br>

        <button type="submit">Register</button>
    </form>

    <!-- Modal -->
    <?php if (session()->get('success')): ?>
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Registration Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= session()->get('success') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="/login" class="btn btn-primary">Go to Login</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show the modal when the page loads
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();

            // After 4 seconds, automatically close the modal and redirect to index
            setTimeout(function() {
                myModal.hide();
                window.location.href = '/'; // Redirect to index page
            }, 4000); // 4000ms = 4 seconds
        });
    </script>
    <?php endif; ?>

    <!-- Include Bootstrap JS (For Modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
