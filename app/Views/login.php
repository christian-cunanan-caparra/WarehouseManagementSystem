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
    <!-- Google Fonts for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background 0.5s ease;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            transition: all 0.3s ease-in-out;
            box-sizing: border-box;
        }

        .container:hover {
            transform: scale(1.03);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #0984e3;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 30px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #0984e3;
            box-shadow: 0 0 5px rgba(9, 132, 227, 0.4);
        }

        .form-control::placeholder {
            color: #aaa;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }

        .form-control:focus::placeholder {
            opacity: 0.5;
        }

        .btn-primary {
            background-color: #0984e3;
            border-color: #0984e3;
            padding: 12px;
            width: 100%;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #74b9ff;
            border-color: #74b9ff;
        }

        .icon {
            font-size: 50px;
            color: #0984e3;
            text-align: center;
            margin-bottom: 20px;
        }

        .alert {
            font-size: 14px;
            padding: 15px;
            background-color: #f8d7da;
            color: #721c24;
            margin-bottom: 20px;
        }

        .forgot-password {
            text-decoration: none;
            display: block;
            text-align: center;
            padding-top: 10px;
            font-size: 14px;
            color: #0984e3;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

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

        /* Mobile Responsiveness */
        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
                margin-bottom: 15px;
            }

            .form-control {
                padding: 10px;
                font-size: 14px;
            }

            .btn-primary {
                padding: 10px;
                font-size: 14px;
            }
        }

        /* Theme Switch Button */
        .theme-switch {
            position: absolute;
            top: 15px;
            right: 15px;
            cursor: pointer;
            font-size: 20px;
        }

    </style>
</head>
<body>

    <!-- Theme Switcher (Light/Dark Mode) -->
    <div class="theme-switch" onclick="toggleTheme()">
        <i class="fas fa-moon"></i>
    </div>

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
        <form action="/login/authenticate" method="post" id="loginForm">
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

    <!-- Loading Spinner -->
    <div id="loading" style="display:none; text-align:center;">
        <i class="fas fa-spinner fa-spin" style="font-size: 30px; color: #0984e3;"></i>
    </div>

    <!-- Include Bootstrap JS (For Modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        // Password validation on form submission
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var email = document.getElementById('email').value;

            // Email validation
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                event.preventDefault();
                alert('Please enter a valid email address.');
                return;
            }

            // Password validation
            if (password.length < 8) {
                event.preventDefault();  // Prevent form submission
                alert('Password must be at least 8 characters long.');
                return;
            }

            // Show loading spinner
            document.getElementById('loading').style.display = 'block';
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

        // Toggle Dark/Light Theme
        function toggleTheme() {
            var body = document.body;
            body.classList.toggle('dark-theme');
            if (body.classList.contains('dark-theme')) {
                document.querySelector('.theme-switch i').classList.replace('fa-moon', 'fa-sun');
                body.style.background = '#2d3436';  // Dark theme background
            } else {
                document.querySelector('.theme-switch i').classList.replace('fa-sun', 'fa-moon');
                body.style.background = 'linear-gradient(135deg, #74b9ff, #0984e3)';  // Original light theme
            }
        }
    </script>
</body>
</html>
