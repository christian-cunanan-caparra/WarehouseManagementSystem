<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Warehouse Management System</title>
    <!-- Include Bootstrap for Modal Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff; /* Light background */
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px; /* Add padding for smaller screens */
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            transition: all 0.3s ease-in-out;
        }

        /* Hover effect for the container */
        .container:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        h1 {
            text-align: center;
            color: #007bff; /* Normal blue */
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
            font-size: 16px;
            box-shadow: none;
            border: 1px solid #007bff; /* Normal blue */
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff; /* Normal blue */
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

        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: #007bff; /* Normal blue */
            color: white;
        }

        .modal-body {
            font-size: 16px;
        }

        .icon {
            font-size: 50px;
            color: #007bff; /* Normal blue */
            text-align: center;
            margin-bottom: 20px;
        }

        /* Placeholder styling */
        ::placeholder {
            color: #6c757d;
            opacity: 1;
        }

        /* Style for the login link */
        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Flash error styling */
        .alert {
            font-size: 14px;
            padding: 15px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1><i class="fas fa-warehouse"></i> AHAHAHA Management System</h1>

        <!-- Display Flash Error Message for Invalid Email -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Display Validation Errors -->
        <?php if (session()->get('errors')): ?>
            <div class="alert alert-danger">
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
                <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" placeholder="Enter your name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= old('address') ?>" placeholder="Enter your address" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mobile_number">Mobile Number:</label>
                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?= old('mobile_number') ?>" placeholder="Enter your mobile number" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <!-- Link to login page if the user already has an account -->
        <div class="login-link">
            <p>Already have an account? <a href="/login">Login here</a></p>
        </div>
    </div>

    <!-- Modal -->
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
                    <!-- <a href="/login" class="btn btn-primary">Go to Login</a> -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show the modal when the page loads
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();

            // After 4 seconds, automatically close the modal and redirect to login
            setTimeout(function() {
                window.location.href = '/login'; // Redirect to login page
            }, 4000); // 4000ms = 4 seconds
        });
    </script>
    <?php endif; ?>

    <!-- Include Bootstrap JS (For Modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
