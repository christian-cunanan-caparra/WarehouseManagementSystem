<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Warehouse Management System</title>
    <!-- Include Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e3f2fd;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .container h1 {
            color: #007bff;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .icon {
            font-size: 50px;
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-control {
            border-radius: 8px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert {
            font-size: 14px;
        }

        .login-link {
            margin-top: 15px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <i class="fas fa-warehouse icon"></i>
        <h1>Warehouse Management System</h1>

        <!-- Flash message for errors -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Validation errors -->
        <?php if (session()->get('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->get('errors') as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach ?>
            </div>
        <?php endif; ?>

        <!-- Registration form -->
        <form action="/register/save" method="POST">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" value="<?= old('name') ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="<?= old('email') ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address" value="<?= old('address') ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" id="mobile_number" name="mobile_number" class="form-control" placeholder="Enter your mobile number" value="<?= old('mobile_number') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <!-- Login link -->
        <div class="login-link">
            <p>Already have an account? <a href="/login">Login here</a></p>
        </div>
    </div>

    <!-- Success modal -->
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
                    <a href="/login" class="btn btn-primary">Go to Login</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('successModal'));
            modal.show();
            setTimeout(() => window.location.href = '/login', 4000);
        });
    </script>
    <?php endif; ?>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
