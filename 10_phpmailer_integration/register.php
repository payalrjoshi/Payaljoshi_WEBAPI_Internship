<?php
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

$msg = "";

if(isset($_POST['submit']))
{
    $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password !== $confirm_password) {
        $msg = "Error: Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO students(fullname,email,mobile,password)
                VALUES('$fullname','$email','$mobile','$hashed_password')";

        if(mysqli_query($conn,$sql))
        {
        $mail = new PHPMailer(true);

        try
        {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'unicodetechnolab@gmail.com';
            $mail->Password   = 'dian xxpt sqgt tuzi';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom(
                'unicodetechnolab@gmail.com',
                'Unicode Technolab'
            );

            $mail->addAddress($email, $fullname);

            $mail->isHTML(true);
            $mail->Subject = 'Registration Successful';

            $mail->Body = "
                <h2>Welcome $fullname</h2>
                <p>Your registration has been completed successfully.</p>

                <p>Thank you for registering with Unicode Technolab.</p>

                <br>

                <b>Name:</b> $fullname<br>
                <b>Email:</b> $email<br>
                <b>Mobile:</b> $mobile
            ";

            $mail->send();

            $msg = "Registration Successful. Email Sent.";
        }
        catch (Exception $e)
        {
            $msg = "Registration Successful. Email Not Sent.";
        }
    }
    else
        {
            $msg = "Database Error";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: #f1f5f9;
    min-height:100vh;
}

.register-card{
    border:none;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

.card-header{
    background:linear-gradient(135deg,#2563eb,#1e40af);
    color:#fff;
    border-radius:20px 20px 0 0 !important;
    text-align:center;
    padding:20px;
}

.btn-register{
    background:#2563eb;
    border:none;
    padding:12px;
    font-weight:600;
}

.btn-register:hover{
    background:#1e40af;
}

.form-control{
    padding:12px;
}

.success-msg{
    background:#d1fae5;
    color:#065f46;
    border:1px solid #a7f3d0;
}

.error-msg{
    background:#fee2e2;
    color:#991b1b;
    border:1px solid #fecaca;
}
</style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card register-card w-100" style="max-width: 450px;">
        <div class="card-header">
            <h3 class="mb-0">Student Registration</h3>
        </div>
        <div class="card-body p-4 p-md-5">
            
            <?php if(!empty($msg)): ?>
                <?php if(strpos($msg, 'Error') !== false || strpos($msg, 'Not') !== false): ?>
                    <div class="alert error-msg p-3 mb-4 rounded"><?php echo $msg; ?></div>
                <?php else: ?>
                    <div class="alert success-msg p-3 mb-4 rounded"><?php echo $msg; ?></div>
                <?php endif; ?>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label fw-medium text-secondary">Full Name</label>
                    <input type="text" name="fullname" class="form-control form-control-lg" placeholder="Your name" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-medium text-secondary">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Your email" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-medium text-secondary">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control form-control-lg" placeholder="Your mobile number" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium text-secondary">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Create a password" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Confirm your password" required>
                </div>
                
                <button type="submit" name="submit" class="btn btn-register w-100 text-white btn-lg mt-2 shadow-sm rounded-pill">
                    Complete Registration
                </button>

                <div class="text-center mt-3">
                    <span class="text-secondary">Already have an account? <a href="login.php" class="text-decoration-none">Login here</a></span>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>