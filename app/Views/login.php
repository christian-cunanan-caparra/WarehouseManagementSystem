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
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #1f1f1f;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 400px;
            transition: all 0.3s ease-in-out;
        }

        .container:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
        }

        h1 {
            text-align: center;
            color: #00bcd4;
            font-size: 30px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            background-color: #333;
            color: #e0e0e0;
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
            box-shadow: none;
            border: 1px solid #00bcd4;
        }

        .form-control:focus {
            border-color: #0097a7;
            box-shadow: 0 0 0 0.2rem rgba(0, 179, 212, 0.5);
        }

        .btn-primary {
            background-color: #00bcd4;
            border-color: #00bcd4;
            padding: 14px;
            width: 100%;
            border-radius: 10px;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #0097a7;
            border-color: #007f8f;
        }

        .icon {
            font-size: 50px;
            color: #00bcd4;
            text-align: center;
            margin-bottom: 20px;
        }

        ::placeholder {
            color: #9e9e9e;
            opacity: 1;
        }

        .signup-link {
            text-align: center;
            margin-top: 15px;
        }

        .signup-link a {
            color: #00bcd4;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .alert {
            font-size: 14px;
            padding: 15px;
            background-color: #ff4d4d;
            color: #fff;
            margin-bottom: 20px;
        }

        .forgot-password {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            padding-top: 10px;
            color: #00bcd4;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        /* Show Password Checkbox */
        .show-password {
            display: flex;
            align-items: center;
            margin-top: -10px;
            font-size: 14px;
            padding-top: 20px;
        }

        .show-password input {
            margin-right: 8px;
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
            <p>Don't have an account yet? <a href="/register" class="sign-up">Sign up here</a></p>
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
