<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* General Styling */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #4facfe, #00f2fe); /* Gradient Background */
            padding: 20px;
        }

        /* Form Container */
        form {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 15px;
            font-size: 24px;
            color: #333;
        }

        /* Label & Input Styling */
        label {
            display: block;
            text-align: left;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .password-container {
            position: relative;
            width: 100%;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 20px;
            outline: none;
            transition: 0.3s ease-in-out;
        }

        input[type="password"]:focus {
            border-color: #4facfe;
            box-shadow: 0 0 5px rgba(79, 172, 254, 0.5);
        }

        /* Password Toggle Button */
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 14px;
            color: #4facfe;
            background: none;
            border: none;
            outline: none;
        }

        /* Button Styling */
        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            background-color: #28a745;
            color: white;
            transition: 0.3s ease-in-out;
        }

        button:hover {
            opacity: 0.85;
        }

        /* Responsive Adjustments */
        @media (max-width: 480px) {
            form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<form action="/process-reset-password" method="post">
    <h2>Reset Password</h2>
    
    <label for="password">New Password:</label>
    <div class="password-container">
        <input type="password" name="password" id="password" required>
        <button type="button" class="toggle-password" onclick="togglePassword()">👁</button>
    </div>

    <button type="submit">Reset Password</button>
</form>

<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>

</body>
</html>
