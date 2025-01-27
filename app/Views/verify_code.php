<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Reset Code</title>
    <!-- Include Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff; /* Light blue background */
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
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            transition: all 0.3s ease-in-out;
        }

        /* Hover effect for the container */
        .container:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        h1 {
            text-align: center;
            color: #007bff; /* Blue color */
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
            font-size: 16px;
            box-shadow: none;
            border: 1px solid #007bff; /* Blue border */
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff; /* Blue button */
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
            color: #007bff; /* Blue icon */
            text-align: center;
            margin-bottom: 20px;
        }

        /* Placeholder styling */
        ::placeholder {
            color: #6c757d;
            opacity: 1;
        }

        /* Style for the signup link */
        .signup-link {
            text-align: center;
            margin-top: 15px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
        }

        .signup-link a:hover {
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
        <h1><i class="fas fa-lock"></i> Verify Reset Code</h1>
        <p>Please enter the reset code sent to your email.</p>

        <!-- Display Error Flash Message -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Reset Code Form -->
        <form action="/forgot-password/verify-code" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="reset_code">Reset Code:</label>
                <input type="text" name="reset_code" class="form-control" id="reset_code" placeholder="Enter reset code" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Verify Code</button>
        </form>

        <div class="signup-link mt-3">
            <p>Didn't receive the code? <a href="/forgot-password">Resend code</a></p>
        </div>
    </div>

    <!-- Include Bootstrap JS (For Modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
