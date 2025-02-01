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
            background: linear-gradient(45deg, #1c1c1c, #4e4e4e);
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Container with Glassmorphism effect */
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            max-width: 380px;
            width: 100%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
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
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        /* Title */
        h1 {
            text-align: center;
            color: #ffffff;
            font-size: 32px;
            margin-bottom: 30px;
            font-weight: bold;
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
            border: 1px solid #ffffff;
            box-shadow: none;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }

        .form-control:focus {
            border-color: #00c7ff;
            box-shadow: 0 0 8px rgba(0, 199, 255, 0.5);
            background-color: rgba(255, 255, 255, 0.7);
        }

        .form-control::placeholder {
            opacity: 0;
        }

        .form-group label {
            position: absolute;
            top: 18px;
            left: 15px;
            font-size: 16px;
            color: #ffffff;
            transition: all 0.2s ease;
        }

        .form-control:focus + label,
        .form-control:not(:placeholder-shown) + label {
            top: -12px;
            left: 12px;
            font-size: 14px;
            color: #00c7ff;
        }

        /* Button */
        .btn-primary {
            background-color: #00c7ff;
            border-color: #00c7ff;
            padding: 14px;
            width: 100%;
            border-radius: 15px;
            font-size: 18px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #008bb8;
            border-color: #008bb8;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        /* Icon */
        .icon {
            font-size: 60px;
            color: #ffffff;
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
            color: #00c7ff;
            font-weight: bold;
            text-decoration: none;
            margin-top: 20px;
            transition: color 0.2s ease;
        }

        .forgot-password:hover {
            color: #008bb8;
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
        }

        .signup-link a {
            color: #00c7ff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s ease;
        }

        .signup-link a:hover {
            color: #008bb8;
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
                padding: 30px;
            }

            h1 {
                font-size: 26px;
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
