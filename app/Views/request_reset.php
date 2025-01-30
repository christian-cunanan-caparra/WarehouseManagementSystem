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
            background-color: whitesmoke;
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

        h1 {
            margin-bottom: 15px;
            font-size: 24px;
            color: #333;
        }

        p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
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

        input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 20px;
            outline: none;
            transition: 0.3s ease-in-out;
        }

        input[type="email"]:focus {
            border-color: #4facfe;
            box-shadow: 0 0 5px rgba(79, 172, 254, 0.5);
        }

        /* Button Styling */
        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        button[type="submit"] {
            background-color: #28a745;
            color: white;
        }

        button[type="button"] {
            background-color: #dc3545;
            color: white;
        }

        button:hover {
            opacity: 0.85;
        }

        /* Responsive Adjustments */
        @media (max-width: 480px) {
            form {
                padding: 20px;
            }

            .button-container {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<form action="/send-reset-code" method="post">
    <h1>Reset Password</h1>
    <p>Please enter your email to reset your password.</p>
    
    <label for="email">Email:</label>
    <input type="email" name="email" required>  

    <div class="button-container">
        <button type="button" onclick="window.location.href='/'">Cancel</button>
        <button type="submit">Reset</button>
    </div>
</form>

</body>
</html>
