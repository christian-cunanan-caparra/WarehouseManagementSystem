<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Warehouse Management System</title>
    <!-- Include Bootstrap for Modal Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc); /* Static smooth gradient */
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            background: rgba(255, 255, 255, 0.9); /* Light white background for contrast */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            transition: all 0.3s ease-in-out;
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px;
            width: 100%;
            border-radius: 15px;
            font-size: 16px;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        h1 {
            text-align: center;
            color: #007bff;
            font-size: 28px;
            margin-bottom: 25px;
        }

        /* Modal styling */
        .modal-content {
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            background: #f8f9fa;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }

        .modal-title {
            font-size: 24px;
            font-weight: bold;
        }

        .modal-body {
            text-align: center;
            font-size: 18px;
            padding: 30px;
        }

        .modal-footer {
            justify-content: center;
            border: none;
            padding: 10px 0;
        }

        /* Spinner Styling */
        .spinner-border {
            width: 4rem;
            height: 4rem;
            border-width: 0.4em;
            margin-bottom: 20px;
            animation: spin 1s infinite linear;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            color: #007bff;
            font-size: 18px;
            font-weight: 600;
        }

        .modal-dialog-centered {
            transform: translateY(0);
        }

        /* Remove outline from modal */
        .modal-content:focus,
        .modal-header:focus,
        .modal-body:focus,
        .modal-footer:focus {
            outline: none;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 26px;
                margin-bottom: 20px;
            }

            .form-control {
                font-size: 13px;
                padding: 8px 12px;
            }

            .btn-primary {
                font-size: 15px;
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
                max-width: 100%;
            }

            h1 {
                font-size: 22px;
                margin-bottom: 15px;
            }

            .form-control {
                font-size: 12px;
                padding: 8px 10px;
            }

            .btn-primary {
                font-size: 14px;
                padding: 8px;
            }

            .signup-link {
                font-size: 13px;
            }
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

        <!-- Display Flash Success -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Registration Form -->
        <form action="/register/save" method="POST">
            <?= csrf_field() ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" placeholder="Enter your name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="Enter your email" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= old('address') ?>" placeholder="Enter your address" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Male" <?= old('gender') == 'Male' ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= old('gender') == 'Female' ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile_number">Mobile Number</label>
                        <input type="number" class="form-control" id="mobile_number" name="mobile_number" value="<?= old('mobile_number') ?>" placeholder="Enter your mobile number" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <!-- Link to Login -->
        <div class="signup-link">
            <p>Already have an account? <a href="/login">Login here</a></p>
        </div>
    </div>

    <!-- Modal for success -->
    <?php if (session()->get('success')): ?>
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Registration Processing</h5>
                </div>
                <div class="modal-body">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="loading-text">Please wait while we redirect you to the login page.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();

            setTimeout(function() {
                window.location.href = '/login'; // Redirect after 4 seconds
            }, 4000);
        });
    </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
