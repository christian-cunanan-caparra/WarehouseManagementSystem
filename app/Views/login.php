<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warehouse Management System</title>
    <!-- Include Bootstrap for Modal Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 400px;
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
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
        .icon {
            font-size: 50px;
            color: #0056b3;
            text-align: center;
            margin-bottom: 20px;
        }
        .alert {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2><i class="fas fa-warehouse"></i> Warehouse Management System</h2>

        <!-- Display Error Flash Message -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="/login/authenticate" method="post">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- Include Bootstrap JS (For Modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
