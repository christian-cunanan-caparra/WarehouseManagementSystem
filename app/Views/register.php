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
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px; /* Slightly larger max width for PC/Laptop */
            transition: all 0.3s ease-in-out;
            animation: fadeIn 1s ease-in-out;
        }

        .container:hover {
            transform: scale(1.02); /* Slightly scale up on hover */
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2); /* Increase shadow on hover */
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
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 15px;
            padding: 15px 20px;
            font-size: 16px;
            box-shadow: none;
            border: 1px;
            transition: border 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border: #0056b3;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px;
            width: 100%;
            border-radius: 15px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #0056b3;
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
                max-width: 90%; /* Smaller width on mobile devices */
                
            }

            h1 {
                font-size: 24px;
                margin-bottom: 20px;
            }

            .form-control {
                border-radius: 15px;
            padding: 12px 18px;
            font-size: 16px;
            height: 40px;
            box-shadow: none;
            border: 1px;
            transition: border 0.3s, box-shadow 0.3s;
            }

            .btn-primary {
                font-size: 15px;
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
                max-width: 85%; /* Full width on very small screens */
                margin-top: -53px;
                margin-left: auto;
                margin-right: auto;
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
        </BR>
        <h1><i class="fas fa-warehouse"></i> Warehouse<br>Management</h1>

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
                       
                        <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" placeholder="Enter your name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      
                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="Enter your email" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                       
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required minlength="8">
                        <!-- <small class="text-muted">Password must be at least 8 characters.</small> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      
                        <input type="text" class="form-control" id="address" name="address" value="<?= old('address') ?>" placeholder="Enter your address" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                       
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Male" <?= old('gender') == 'Male' ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= old('gender') == 'Female' ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        
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


   
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
