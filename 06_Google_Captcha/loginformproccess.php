<?php
// 1. Initialize variables to hold our messages
$message = '';
$msgClass = 'msg'; // Default CSS class for errors

// 2. Process the form if it was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $captcha  = $_POST['g-recaptcha-response'] ?? '';

    if (empty($captcha)) {
        $message = "Please complete the reCAPTCHA.";
    } else {
        $secretKey = "6LeoGhMtAAAAAOln-Y9lHE7KqRu4_wqyMbVnHzsW";
        $verifyURL = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query([
            'secret'   => $secretKey,
            'response' => $captcha
        ]);

        $response = file_get_contents($verifyURL);
        $responseData = json_decode($response);

        if ($responseData && $responseData->success) {
            if ($username === "admin" && $password === "123456") {
                $message = "Login Successful!";
                $msgClass = "msg success"; // Use green success class
            } else {
                $message = "Invalid Username or Password.";
            }
        } else {
            $message = "reCAPTCHA Verification Failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login form</title>
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
            background: linear-gradient(135deg, #f5f7fa 0%, #e4eaf2 100%);
        }

        .login-box{
            width:350px;
            background:#fff;
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
            margin-bottom:18px;
        }

        .form-group input{
            width:100%;
            padding:12px;
            border:1px solid #dcdcdc;
            border-radius:6px;
            font-size: 14px;
            background-color: #fafafa;
            transition: all 0.25s ease;
        }

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
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        button:hover{
            background:#0056b3;
        }

        button:active{
            transform: scale(0.99);
        }

        /* Error message styling */
        .msg{
            text-align:center;
            margin-top:15px;
            color:#dc3545;
            font-size: 14px;
            font-weight: bold;
        }
        
        /* Success message styling */
        .success{
            color: #28a745;
        }
    </style>
</head>
<body>

<div class="login-box">

    <h2>Login</h2>

    <form action="" method="post">

        <div class="form-group">
            <input type="text" name="username" placeholder="Enter Username" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Enter Password" required>
        </div>

        <div class="form-group">
            <div class="g-recaptcha"
                 data-sitekey="6LeoGhMtAAAAAPF8fSywiaDDrs-evEZZ7P6lg1hW">
            </div>
        </div>

        <button type="submit">Login</button>

        <?php if (!empty($message)): ?>
            <div class="<?php echo $msgClass; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

    </form>

</div>

</body>
</html>