<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration Form</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        .section {
            height: 100%;
            width: 100%;
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(login/banner.jpg);
            background-position: center;
            background-size: cover;
            position: absolute;
        }

        .form-box {
            width: 380px;
            height: 480px;
            position: relative;
            margin: 6% auto;
            background: #fff;
            padding: 5px;
            overflow: hidden;
            border-radius: 10px;
        }

        .button-box {
            width: 220px;
            margin: 35px auto;
            position: relative;
            box-shadow: 0 0 20px 9px #ff61241f;
            border-radius: 30px;
        }

        .toggle-btn {
            padding: 10px 30px;
            cursor: pointer;
            background: transparent;
            border: 0;
            outline: none;
            position: relative;
        }

        #btn {
            top: 0;
            left: 0;
            position: absolute;
            width: 110px;
            height: 100%;
            background: linear-gradient(to right, #ff105f, #ffad06);
            border-radius: 30px;
            transition: .5s;
        }

        .social-icons {
            margin: 30px auto;
            text-align: center;
        }

        .social-icons img {
            width: 30px;
            margin: 0 12px;
            box-shadow: 0 0 20px 0 #7f7f7f3d;
            cursor: pointer;
            border-radius: 50%;
        }

        .input-group {
            top: 180px;
            position: absolute;
            width: 280px;
            transition: .5s;
        }

        .input-field {
            width: 100%;
            padding: 10px 0;
            margin: 5px 0;
            border-left: 0;
            border-top: 0;
            border-right: 0;
            border-bottom: 1px solid #999;
            outline: none;
            background: transparent;
        }

        .submit-btn {
            width: 85%;
            padding: 10px 30px;
            cursor: pointer;
            display: block;
            margin: auto;
            background: linear-gradient(to right, #ff105f, #ffad06);
            border: 0;
            outline: none;
            border-radius: 30px;
        }

        .check-box {
            margin: 30px 10px 30px 0;
        }

        span {
            color: #777;
            font-size: 12px;
            bottom: 68px;
            position: absolute;
        }

        #login {
            left: 50px;
        }

        #register {
            left: 450px;
        }
    </style>
</head>

<body>
    <div class="section">
        <!-- Form Part -->
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Login</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <div class="social-icons">
                <a href="https://www.fb.com/"><img src="login/fb.png"></a>
                <a href="https://www.twitter.com/"><img src="login/tw.png"></a>
                <a href="https://www.google.com/"><img src="login/gp.png"></a>
            </div>

            <form id="login" class="input-group">
                <input type="text" class="input-field" placeholder="User Id" required>
                <input type="text" class="input-field" placeholder="Enter Password" required>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn">Log in</button>
            </form>

            <form id="register" class="input-group">
                <input type="text" class="input-field" placeholder="User Id" required>
                <input type="email" class="input-field" placeholder="Email Id" required>
                <input type="text" class="input-field" placeholder="Enter Password" required>
                <input type="checkbox" class="check-box"><span>I agree to the terms & condition</span>
                <button type="submit" class="submit-btn">Log in</button>
            </form>
        </div>
    </div>

    <!-- JavaScript Part -->
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        // Register and login Function.
        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }
    </script>
</body>

</html>
