<?php
session_start();
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

$msg = "";

if(!isset($_SESSION['reset_email']) || !isset($_SESSION['code_verified']) || $_SESSION['code_verified'] !== true) {
    header("Location: forgot_password.php");
    exit();
}

$email = $_SESSION['reset_email'];

if(isset($_POST['submit'])) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password !== $confirm_password) {
        $msg = "Error: Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "UPDATE students SET password='$hashed_password' WHERE email='$email'";
        if(mysqli_query($conn, $sql)) {
            
            // Send email
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
                $mail->Subject = 'Password Reset Successful';
                $mail->Body    = "
                    <h2>Password Updated</h2>
                    <p>Your password has been successfully updated.</p>
                    <p>If you did not make this change, please contact us immediately.</p>
                ";

                $mail->send();
                $msg = "Success: Password has been updated. An email notification was sent.";
                
                // Clear session
                unset($_SESSION['reset_email']);
                unset($_SESSION['reset_code']);
                unset($_SESSION['code_verified']);
            } catch (Exception $e) {
                $msg = "Success: Password updated, but email could not be sent.";
                unset($_SESSION['reset_email']);
                unset($_SESSION['reset_code']);
                unset($_SESSION['code_verified']);
            }
        } else {
            $msg = "Error: Database update failed.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>New Password</title>
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
            <h3 class="mb-0">Create New Password</h3>
        </div>
        <div class="card-body p-4 p-md-5">
            <?php if(!empty($msg)): ?>
                <?php if(strpos($msg, 'Error') !== false): ?>
                    <div class="alert error-msg p-3 mb-4 rounded"><?php echo $msg; ?></div>
                <?php else: ?>
                    <div class="alert success-msg p-3 mb-4 rounded"><?php echo $msg; ?></div>
                    <div class="text-center mb-3">
                        <a href="register.php" class="btn btn-outline-primary">Go to Login / Register</a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(strpos($msg, 'Success') === false): ?>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label fw-medium text-secondary">New Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter new password" required>
                </div>
                
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary">Confirm New Password</label>
                    <input type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Confirm your new password" required>
                </div>
                
                <button type="submit" name="submit" class="btn btn-auth w-100 text-white btn-lg mt-2 shadow-sm rounded-pill">
                    Update Password
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
