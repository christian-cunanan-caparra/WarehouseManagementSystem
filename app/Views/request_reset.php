<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full height of the viewport */
            margin: 0; /* Remove default margin */
            font-family: Arial, sans-serif; /* Set a default font */
            background-color: #f4f4f4; /* Light background color */
        }

        form {
            background: white; /* White background for the form */
            padding: 20px; /* Padding inside the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            width: 90%; /* Responsive width */
            max-width: 400px; /* Maximum width */
        }

        h1 {
            margin-bottom: 20px; /* Space below the heading */
        }

        label {
            display: block; /* Make label block level */
            margin-bottom: 5px; /* Space below the label */
        }

        input[type="email"] {
            width: 100%; /* Full width input */
            padding: 10px; /* Padding inside the input */
            margin-bottom: 20px; /* Space below the input */
            border: 1px solid #ccc; /* Border for the input */
            border-radius: 4px; /* Rounded corners */
        }

        button {
            width: 48%; /* Button width */
            padding: 10px; /* Padding inside the button */
            border: none; /* Remove border */
            border-radius: 4px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            margin: 0 1%; /* Space between buttons */
        }

        button[type="submit"] {
            background-color: #28a745; /* Green background for reset */
            color: white; /* White text */
        }

        button[type="button"] {
            background-color: #dc3545; /* Red background for cancel */
            color: white; /* White text */
        }

        button:hover {
            opacity: 0.9; /* Slightly transparent on hover */
        }
    </style>
</head>
<body>

<form action="/send-reset-code" method="post">
    <h1>Reset Password</h1>
    <p>Please enter your email or mobile number to reset password.</p>
    <label for="email">Email:</label>
    <input type="email" name="email" required>  
    <button type="button" onclick="window.location.href='/'">Cancel</button>
    <button type="submit">Reset</button>
</form>

</body>
</html>