<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            /* Enhanced with a soft, modern gradient */
            background: linear-gradient(135deg, #f5f7fa 0%, #e4eaf2 100%);
        }

        .login-box{
            width:350px;
            background:#fff;
            /* Optimized padding and smoother shadow for a modern card feel */
            padding:35px 30px;
            border-radius:12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }

        .login-box h2{
            text-align:center;
            margin-bottom:25px;
            color: #2c3e50;
            font-size: 24px;
        }

        .form-group{
            /* Slightly increased spacing for improved readability */
            margin-bottom:18px;
        }

        .form-group input{
            width:100%;
            padding:12px;
            border:1px solid #dcdcdc;
            border-radius:6px;
            font-size: 14px;
            background-color: #fafafa;
            /* Smooth transition for interaction states */
            transition: all 0.25s ease;
        }

        /* Added interactive focus states for inputs */
        .form-group input:focus{
            outline: none;
            border-color: #007bff;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
        }

        button{
            width:100%;
            padding:12px;
            background:#007bff;
            color:#fff;
            border:none;
            border-radius:6px;
            cursor:pointer;
            font-size:16px;
            font-weight: 600;
            /* Added transition properties for hover states */
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        button:hover{
            background:#0056b3;
        }

        /* Added tactile click feedback */
        button:active{
            transform: scale(0.99);
        }

        .msg{
            text-align:center;
            margin-top:12px;
            color:#dc3545;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-box">

    <h2>Login</h2>

    <form action="login_process.php" method="post">

        <div class="form-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="form-group">
            <div class="g-recaptcha"
                 data-sitekey="6LeoGhMtAAAAAPF8fSywiaDDrs-evEZZ7P6lg1hW">
            </div>
        </div>

        <button type="submit">Login</button>

    </form>

</div>

</body>
</html>