<?php
session_start();
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

$msg = "";

if(isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $sql = "SELECT id FROM students WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        $code = rand(100000, 999999);
        
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'unicodetechnolab@gmail.com';
            $mail->Password   = 'dian xxpt sqgt tuzi';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('unicodetechnolab@gmail.com', 'Unicode Technolab');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Your Password Reset Verification Code';
            $mail->Body    = "
                <h2>Verification Code</h2>
                <p>Hello,</p>
                <p>You requested to reset your password. Here is your 6-digit verification code:</p>
                <h3 style='background:#f1f5f9;padding:10px;display:inline-block;'>$code</h3>
                <p>If you did not request this, please ignore this email.</p>
            ";

            $mail->send();
            
            // Set session variables
            $_SESSION['reset_email'] = $email;
            $_SESSION['reset_code'] = $code;
            
            header("Location: verify_code.php");
            exit();
        } catch (Exception $e) {
            $msg = "Error: Code could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $msg = "Error: Email not found in our records.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{ background: #f1f5f9; min-height:100vh; }
.auth-card{ border:none; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.1); }
.card-header{ background:linear-gradient(135deg,#2563eb,#1e40af); color:#fff; border-radius:20px 20px 0 0 !important; text-align:center; padding:20px; }
.btn-auth{ background:#2563eb; border:none; padding:12px; font-weight:600; }
.btn-auth:hover{ background:#1e40af; }
.error-msg{ background:#fee2e2; color:#991b1b; border:1px solid #fecaca; }
.success-msg{ background:#d1fae5; color:#065f46; border:1px solid #a7f3d0; }
</style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card auth-card w-100" style="max-width: 450px;">
        <div class="card-header">
            <h3 class="mb-0">Forgot Password</h3>
        </div>
        <div class="card-body p-4 p-md-5">
            <?php if(!empty($msg)): ?>
                <div class="alert error-msg p-3 mb-4 rounded"><?php echo $msg; ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary">Enter your registered email address</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="name@example.com" required>
                </div>
                
                <button type="submit" name="submit" class="btn btn-auth w-100 text-white btn-lg mt-2 shadow-sm rounded-pill">
                    Send Verification Code
                </button>

                <div class="text-center mt-3">
                    <a href="login.php" class="text-decoration-none">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
