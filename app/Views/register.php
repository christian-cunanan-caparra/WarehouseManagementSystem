<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Include Bootstrap for Modal Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eaf3fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px 20px;
            width: 100%;
            font-size: 1.1rem;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .modal-content {
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: #007bff;
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .modal-body {
            padding: 30px;
            font-size: 1.1rem;
            color: #333;
            text-align: center;
        }

        .modal-footer {
            padding: 15px;
            text-align: center;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .errors p {
            color: #ff5d5d;
            font-size: 1rem;
            margin: 10px 0;
        }

    </style>
</head>
<body>

    <div class="container">
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

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= old('name') ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= old('email') ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <!-- Success Modal -->
    <?php if (session()->get('success')): ?>
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Registration Successful</h5>
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
