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
            background: linear-gradient(to right, #0056b3, #004085);
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            transition: all 0.3s ease-in-out;  /* Smooth transition */
        }

        /* Hover effect for the container */
        .container:hover {
            transform: scale(1.05);   /* Slightly enlarge the container */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);  /* Stronger shadow on hover */
        }

        h1 {
            text-align: center;
            color: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
        }

        .btn-primary {
            background-color: #0056b3;
            border-color: #0056b3;
            padding: 10px 20px;
            width: 100%;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #004085;
            border-color: #004085;
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: #0056b3;
            color: white;
        }

        .modal-body {
            font-size: 16px;
        }

        .icon {
            font-size: 50px;
            color: #0056b3;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1><i class="fas fa-warehouse"></i> Warehouse Management System</h1>

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
                <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= old('address') ?>" required>
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
                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?= old('mobile_number') ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
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

            // After 4 seconds, automatically close the modal and redirect to index
            setTimeout(function() {
                // myModal.hide();
                window.location.href = '/'; // Redirect to index page
            }, 4000); // 4000ms = 4 seconds
        });
    </script>
    <?php endif; ?>

    <!-- Include Bootstrap JS (For Modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
