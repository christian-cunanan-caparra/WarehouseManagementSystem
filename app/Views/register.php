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
            background-color: #e9f5ff;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .container {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .container:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        h1 {
            text-align: center;
            color: #0056b3;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #333333;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #007bff;
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 6px rgba(38, 143, 255, 0.5);
        }

        .btn-primary {
            background: linear-gradient(90deg, #007bff, #0056b3);
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #007bff);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 123, 255, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
        }

        .alert {
            font-size: 14px;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
        }

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

        .icon {
            font-size: 50px;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 24px;
            }

            .btn-primary {
                padding: 12px;
                font-size: 14px;
            }

            .form-control {
                padding: 10px;
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 20px;
            }

            .btn-primary {
                padding: 10px;
                font-size: 12px;
            }

            .form-control {
                padding: 8px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1><i class="fas fa-warehouse"></i> Warehouse Management System</h1>

        <!-- Display errors or success messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->get('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->get('errors') as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
<!-- Loading Modal -->

        <div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <div id="loadingSpinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Processing...</span>
                </div>
                <p class="mt-2">Processing your registration...</p>
            </div>
            <div id="successCheck" style="display: none;">
                <i class="fas fa-check-circle text-success" style="font-size: 50px;"></i>
                <p class="mt-2 text-success">Registration Successful!</p>
            </div>
        </div>
    </div>
</div>


        <!-- Registration form -->
        <form action="/register/save" method="POST">
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" placeholder="Enter your name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= old('address') ?>" placeholder="Enter your address" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div style="padding-bottom: 10px;" class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?= old('mobile_number') ?>" placeholder="Enter your mobile number" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <!-- Link to Login -->
        <div class="login-link">
            <p>Already have an account? <a href="/login">Login here</a></p>
        </div>
    </div>

    <?php if (session()->get('success')): ?>
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="successModalLabel">Registration Successful</h5>
                </div>
                <div class="modal-body">
                    <?= session()->get('success') ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();

            setTimeout(function() {
                window.location.href = '/login';
            }, 4000);
        });




        document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission

        var form = this;
        var formData = new FormData(form);
        var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));

        // Show the loading modal
        loadingModal.show();
        
        fetch(form.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Hide the spinner and show the success checkmark
                document.getElementById('loadingSpinner').style.display = "none";
                document.getElementById('successCheck').style.display = "block";

                // Redirect to login page after 2 seconds
                setTimeout(() => {
                    window.location.href = "/login";
                }, 2000);
            } else {
                // Handle errors (e.g., show alert)
                alert(data.message || "Registration failed, please try again.");
                loadingModal.hide();
            }
        })
        .catch(error => {
            alert("An error occurred: " + error);
            loadingModal.hide();
        });
    });

    </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>