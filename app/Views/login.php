<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warehouse Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #667eea, #764ba2);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            /* ... (other container styles) ... */
            height: auto; /* Key change: Set height to auto */
            /* OR, if you want to keep a maximum height but allow it to shrink: */
             max-height: 90vh; /* Example: 90% of viewport height */
            overflow-y: auto; /* Add scroll if content overflows */
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) { /* Adjust breakpoint as needed */
            .container {
                padding: 30px; /* Reduce padding on smaller screens */
            }

            h1 {
                font-size: 1.8rem; /* Reduce heading size */
            }
        }
        @media (max-width: 576px) { /* Further adjustments for smaller screens */
            .container {
                padding: 20px;
            }
            .form-group {
                margin-bottom: 15px;
            }
            .btn-primary{
                font-size: 1rem;
            }
            .signup-link, .forgot-password{
                font-size: .9rem;
            }
        }


        h1 {
            text-align: center;
            color: #4a4a4a;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
            box-shadow: none;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.2rem rgba(118, 75, 162, 0.25);
        }

        .btn-primary {
            background: linear-gradient(to right, #667eea, #764ba2);
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #5a6acf, #623f81);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .icon {
            font-size: 60px;
            color: #764ba2;
            text-align: center;
            margin-bottom: 25px;
        }

        ::placeholder {
            color: #adb5bd;
            opacity: 1;
        }

        .signup-link, .forgot-password {
            text-align: center;
            margin-top: 15px;
            color: #6c757d;
        }

        .signup-link a, .forgot-password a {
            color: #764ba2;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-link a:hover, .forgot-password a:hover {
            text-decoration: underline;
        }

        .alert {
            font-size: 14px;
            padding: 15px;
            border-radius: 10px;
        }

        .show-password {
            display: flex;
            align-items: center;
            margin-top: 10px;
            font-size: 14px;
            color: #6c757d;
        }

        .show-password input {
            margin-right: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="icon">
            <i class="fas fa-warehouse"></i>
        </div>
        <h1>Warehouse Management System</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/login/authenticate" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= old('email') ?>" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
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
            <p>Don't have an account yet? <a href="/register">Sign up here</a></p>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            if (password.length < 8) {
                event.preventDefault();
                alert('Password must be at least 8 characters long.');
            }
        });

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