<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Reset Code</title>
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

        /* Label & Input Styling */
        label {
            display: block;
            text-align: left;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 20px;
            outline: none;
            transition: 0.3s ease-in-out;
        }

        input[type="text"]:focus {
            border-color: #4facfe;
            box-shadow: 0 0 5px rgba(79, 172, 254, 0.5);
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

<form action="/process-verification" method="post">
    <h1>Verify Reset Code</h1>
    <label for="reset_code">Reset Code:</label>
    <input type="text" name="reset_code" required>
    <button type="submit">Verify</button>
</form>

</body>
</html>
