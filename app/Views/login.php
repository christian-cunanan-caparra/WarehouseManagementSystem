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
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        body {
            background-color: #f0f8ff;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .section {
            height: 100%;
            width: 100%;
            background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url(login/banner.jpg);
            background-position: center;
            background-size: cover;
            position: absolute;
        }

        .form-box {
            width: 380px;
            height: 480px;
            position: relative;
            margin: 6% auto;
            background: #fff;
            padding: 5px;
            overflow: hidden;
            border-radius: 10px;
        }

        .button-box {
            width: 220px;
            margin: 35px auto;
            position: relative;
            box-shadow: 0 0 20px 9px #ff61241f;
            border-radius: 30px;
        }

        .toggle-btn {
            padding: 10px 30px;
            cursor: pointer;
            background: transparent;
            border: 0;
            outline: none;
            position: relative;
        }

        #btn {
            top: 0;
            left: 0;
            position: absolute;
            width: 110px;
            height: 100%;
            background: linear-gradient(to right, #ff105f, #ffad06);
            border-radius: 30px;
            transition: .5s;
        }

        .social-icons {
            margin: 30px auto;
            text-align: center;
        }

        .social-icons img {
            width: 30px;
            margin: 0 12px;
            box-shadow: 0 0 20px 0 #7f7f7f3d;
            cursor: pointer;
            border-radius: 50%;
        }

        .input-group {
            top: 180px;
            position: absolute;
            width: 280px;
            transition: .5s;
        }

        .input-field {
            width: 100%;
            padding: 10px 0;
            margin: 5px 0;
            border-left: 0;
            border-top: 0;
            border-right: 0;
            border-bottom: 1px solid #999;
            outline: none;
            background: transparent;
        }

        .submit-btn {
            width: 85%;
            padding: 10px 30px;
            cursor: pointer;
            display: block;
            margin: auto;
            background: linear-gradient(to right, #ff105f, #ffad06);
            border: 0;
            outline: none;
            border-radius: 30px;
        }

        .check-box {
            margin: 30px 10px 30px 0;
        }

        span {
            color: #777;
            font-size: 12px;
            bottom: 68px;
            position: absolute;
        }

        #login {
            left: 50px;
        }

        #register {
            left: 450px;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            transition: all 0.3s ease-in-out;
        }

        .container:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
            font-size: 16px;
            box-shadow: none;
            border: 1px solid #007bff;
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px;
            width: 100%;
            border-radius: 10px;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .icon {
            font-size: 50px;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }

        ::placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .signup-link {
            text-align: center;
            margin-top: 15px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: none;
        }

        .alert {
            font-size: 14px;
            padding: 15px;
        }

        .forgot-password {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            padding-top: 10px;
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
    </style>
</head>
<body>

    <div class="section"></div>
    <div class="form-box">
        <div class="container">
            <h1><i class="fas fa-warehouse"></i> Warehouse Management System</h1>

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
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= old('email') ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    <div class="show-password">
                        <input type="checkbox" id="togglePassword"> Show Password
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
                <a href="/request-reset" class="text-primary forgot-password">Forgot Password?</a>
            </form>

            <div class="signup-link">
                <p>Don't have an account yet? <a href="/register" class="sign-up">Sign up here</a></p>
            </div>
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
