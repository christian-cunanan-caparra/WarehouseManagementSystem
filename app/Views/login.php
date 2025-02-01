<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warehouse Management System</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico'); ?>">

    <!-- Bootstrap for Modal Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #4A00E0, #8E2DE2);
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 12px;
            padding: 35px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 15px;
        }

        .icon {
            font-size: 55px;
            color: #fff;
            margin-bottom: 15px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            border-color: #fff;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.5);
        }

        .show-password {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #fff;
        }

        .show-password input {
            margin-right: 6px;
        }

        .forgot-password, .signup-link {
            margin-top: 12px;
            font-size: 14px;
        }

        .forgot-password a, .signup-link a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .forgot-password a:hover, .signup-link a:hover {
            text-decoration: underline;
        }

        .alert {
            font-size: 14px;
            padding: 12px;
            border-radius: 8px;
            background: rgba(255, 0, 0, 0.15);
            border: 1px solid rgba(255, 0, 0, 0.3);
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1><i class="fas fa-warehouse icon"></i> Login</h1>

        <!-- Flash Error Message -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Validation Errors -->
        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="/login/authenticate" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="email" style="color: #fff;">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= old('email') ?>" required>
            </div>

            <div class="form-group">
                <label for="password" style="color: #fff;">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                <div class="show-password">
                    <input type="checkbox" id="togglePassword"> Show Password
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
            <div class="forgot-password">
                <a href="/request-reset">Forgot Password?</a>
            </div>
        </form>

        <div class="signup-link">
            <p>Don't have an account? <a href="/register">Sign up here</a></p>
        </div>
    </div>

    <!-- Bootstrap & Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const passwordField = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            const form = document.querySelector('form');

            // Show/Hide Password Toggle
            togglePassword.addEventListener('change', function () {
                passwordField.type = this.checked ? "text" : "password";
            });

            // Password Validation
            form.addEventListener('submit', function (event) {
                let password = passwordField.value;

                if (password.length < 8) {
                    event.preventDefault();
                    alert('Password must be at least 8 characters long.');
                }
            });
        });
    </script>

</body>
</html>
