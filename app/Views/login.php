<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warehouse Management System</title>
    <!-- Include Bootstrap for Modal Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2f3b52, #1e2a3b);
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ecf0f1;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .container {
            background-color: rgba(255, 255, 255, 0.15);
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 450px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease-in-out;
            animation: scaleUp 0.5s ease-in-out;
        }

        @keyframes scaleUp {
            from {
                transform: scale(0.95);
            }
            to {
                transform: scale(1);
            }
        }

        h1 {
            text-align: center;
            color: #00bcd4;
            font-size: 2.7rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 12px;
            padding: 14px;
            font-size: 16px;
            background-color: #ecf0f1;
            border: none;
            color: #34495e;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border: 2px solid #00bcd4;
            box-shadow: 0 0 10px rgba(0, 188, 212, 0.3);
        }

        .btn-primary {
            background-color: #00bcd4;
            border-color: #0097a7;
            padding: 14px;
            width: 100%;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0097a7;
            border-color: #00bcd4;
            transform: translateY(-2px);
        }

        .icon {
            font-size: 70px;
            color: #00bcd4;
            text-align: center;
            margin-bottom: 20px;
        }

        ::placeholder {
            color: #7f8c8d;
            opacity: 1;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        .signup-link a {
            color: #00bcd4;
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .alert {
            font-size: 14px;
            padding: 15px;
            background-color: #e74c3c;
            color: #ecf0f1;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        .forgot-password {
            text-decoration: none;
            display: flex;
            justify-content: center;
            padding-top: 10px;
            color: #ecf0f1;
            font-size: 14px;
        }

        .show-password {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #ecf0f1;
            margin-top: 5px;
        }

        .show-password input {
            margin-right: 10px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
        }

        ::-webkit-scrollbar-thumb {
            background-color: #00bcd4;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1><i class="fas fa-warehouse"></i> Warehouse Management System</h1>

        <!-- Display Flash Error -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Display Validation Errors -->
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
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= old('email') ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                <!-- Show Password Toggle -->
                <div class="show-password">
                    <input type="checkbox" id="togglePassword"> Show Password
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
            <a href="/request-reset" class="forgot-password">Forgot Password?</a>
        </form>

        <!-- Link to register page -->
        <div class="signup-link">
            <p>Don't have an account yet? <a href="/register">Sign up here</a></p>
        </div>
    </div>

    <!-- Include Bootstrap JS (For Modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        // Password validation on form submission
        document.querySelector('form').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            if (password.length < 8) {
                event.preventDefault();  // Prevent form submission
                alert('Password must be at least 8 characters long.');
            }
        });

        // Show/Hide Password Toggle
        document.getElementById('togglePassword').addEventListener('change', function() {
            var passwordField = document.getElementById('password');
            if (this.checked) {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        });
    </script>

</body>
</html>
