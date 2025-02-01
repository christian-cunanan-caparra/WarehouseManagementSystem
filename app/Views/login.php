<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warehouse Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Base styling */
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: gradientMove 6s ease infinite;
            overflow: hidden;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 400px 400px;
            }
        }

        /* Container with Advanced Neumorphism effect */
        .container {
            background: #e0e5ec;
            box-shadow: 4px 4px 20px rgba(0, 0, 0, 0.1), -4px -4px 20px rgba(255, 255, 255, 0.7);
            border-radius: 30px;
            padding: 60px 40px;
            max-width: 380px;
            width: 100%;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, background-color 0.3s ease;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container:hover {
            transform: scale(1.05);
            box-shadow: 8px 8px 30px rgba(0, 0, 0, 0.2), -8px -8px 30px rgba(255, 255, 255, 0.8);
        }

        /* Title */
        h1 {
            text-align: center;
            color: #007bff;
            font-size: 32px;
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Floating Label Input Style */
        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-control {
            width: 100%;
            padding: 18px 12px;
            font-size: 16px;
            border-radius: 20px;
            border: 1px solid #007bff;
            background: #e0e5ec;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 8px rgba(38, 143, 255, 0.5);
            background-color: #fff;
        }

        .form-control::placeholder {
            opacity: 0;
        }

        .form-group label {
            position: absolute;
            top: 18px;
            left: 15px;
            font-size: 16px;
            color: #888;
            transition: all 0.2s ease;
        }

        .form-control:focus + label,
        .form-control:not(:placeholder-shown) + label {
            top: -12px;
            left: 12px;
            font-size: 14px;
            color: #007bff;
        }

        /* Button */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 14px;
            width: 100%;
            border-radius: 15px;
            font-size: 18px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Icon */
        .icon {
            font-size: 60px;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
            animation: bounce 1s infinite alternate;
        }

        @keyframes bounce {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(-8px);
            }
        }

        /* Links */
        .forgot-password {
            display: block;
            text-align: center;
            font-size: 14px;
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
            margin-top: 20px;
            transition: color 0.2s ease;
        }

        .forgot-password:hover {
            color: #0056b3;
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s ease;
        }

        .signup-link a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Show Password Checkbox */
        .show-password {
            display: flex;
            align-items: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .show-password input {
            margin-right: 10px;
        }

        /* Responsive */
        @media (max-width: 575px) {
            .container {
                padding: 40px 30px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1><i class="fas fa-warehouse"></i> Warehouse Management System</h1>

        <!-- Flash error display -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Validation error display -->
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
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= old('email') ?>" required>
                <label for="email">Email</label>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                <label for="password">Password</label>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
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
