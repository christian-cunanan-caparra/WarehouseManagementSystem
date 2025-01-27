<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Warehouse Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f8fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;  /* Reduced padding for a more compact form */
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 15px;
            font-size: 1.3rem;  /* Reduced font size for the heading */
        }

        .form-group {
            margin-bottom: 12px;  /* Reduced bottom margin */
        }

        label {
            font-weight: bold;
            color: #333;
            font-size: 0.9rem;  /* Slightly smaller label font size */
        }

        input, select {
            width: 100%;
            padding: 8px;  /* Reduced padding */
            margin-top: 5px;  /* Slightly smaller top margin */
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.9rem;  /* Smaller font size */
            transition: border-color 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 8px 16px;  /* Reduced button padding */
            width: 100%;
            font-size: 0.95rem;  /* Smaller font size for button */
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .alert {
            margin-bottom: 12px;
            font-size: 0.9rem;  /* Smaller font size for alerts */
            padding: 10px;
            border-radius: 8px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .header-title {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.4rem;  /* Slightly smaller header */
            color: #007bff;
            margin-bottom: 15px;
        }

        .header-title i {
            margin-right: 8px;
            font-size: 1.8rem;  /* Slightly smaller icon */
        }

        /* Media Query for Mobile */
        @media (max-width: 576px) {
            .register-container {
                padding: 15px;  /* Reduce padding for mobile devices */
            }

            .header-title {
                font-size: 1.2rem;
            }

            h2 {
                font-size: 1.2rem;  /* Smaller heading for mobile */
                margin-bottom: 12px;
            }

            .form-group {
                margin-bottom: 10px;  /* Smaller margin for mobile */
            }

            .btn-primary {
                padding: 8px 14px;  /* Reduce button padding for mobile */
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="register-container">
            <!-- Header with Icon and Title -->
            <div class="header-title">
                <i class="fas fa-warehouse"></i>
                <span>Warehouse Management System</span>
            </div>

            <!-- Display Flash Messages -->
            <?php if (session()->get('errors') && is_array(session()->get('errors'))): ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->get('errors') as $error): ?>
                        <p><?= esc($error) ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>
            <?php if (session()->get('success')): ?>
                <div class="alert alert-success">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>

            <!-- Registration Form -->
            <form action="/register/save" method="POST">
                <?= csrf_field() ?>

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?= old('address') ?>" required>
                </div>

                <!-- Gender -->
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="male" <?= old('gender') == 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= old('gender') == 'female' ? 'selected' : '' ?>>Female</option>
                        <option value="other" <?= old('gender') == 'other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>

                <!-- Mobile Number -->
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="tel" class="form-control" id="mobile" name="mobile" value="<?= old('mobile') ?>" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="registerSuccessModal" tabindex="-1" aria-labelledby="registerSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerSuccessModalLabel">Registration Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Your account has been successfully created. You can now log in.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        // Show the modal if the registration is successful
        <?php if (session()->get('success')): ?>
            var myModal = new bootstrap.Modal(document.getElementById('registerSuccessModal'));
            myModal.show();
        <?php endif; ?>
    </script>

</body>
</html>
