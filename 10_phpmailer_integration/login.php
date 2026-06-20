<?php
session_start();
include "db.php";

$msg = "";

if(isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])) {
            $_SESSION['logged_in_user'] = $row['id'];
            $msg = "Success: Logged in successfully!";
            // Redirect logically happens here e.g. header("Location: dashboard.php");
        } else {
            $msg = "Error: Invalid password.";
        }
    } else {
        $msg = "Error: Invalid email.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Student Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{ background: #f1f5f9; min-height:100vh; }
.login-card{ border:none; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.1); }
.card-header{ background:linear-gradient(135deg,#2563eb,#1e40af); color:#fff; border-radius:20px 20px 0 0 !important; text-align:center; padding:20px; }
.btn-login{ background:#2563eb; border:none; padding:12px; font-weight:600; }
.btn-login:hover{ background:#1e40af; }
.success-msg{ background:#d1fae5; color:#065f46; border:1px solid #a7f3d0; }
.error-msg{ background:#fee2e2; color:#991b1b; border:1px solid #fecaca; }
</style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card login-card w-100" style="max-width: 450px;">
        <div class="card-header shadow-sm">
            <h3 class="mb-0">Student Login</h3>
        </div>
        <div class="card-body p-4 p-md-5">
            <?php if(!empty($msg)): ?>
                <?php if(strpos($msg, 'Error') !== false): ?>
                    <div class="alert error-msg p-3 mb-4 rounded"><?php echo $msg; ?></div>
                <?php else: ?>
                    <div class="alert success-msg p-3 mb-4 rounded"><?php echo $msg; ?></div>
                <?php endif; ?>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label fw-medium text-secondary">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="name@example.com" required>
                </div>
                
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter your password" required>
                </div>
                
                <button type="submit" name="submit" class="btn btn-login w-100 text-white btn-lg mt-2 shadow-sm rounded-pill">
                    Login
                </button>

                <div class="text-center mt-3">
                    <a href="forgot_password.php" class="text-decoration-none">Forgot Password?</a><br><br>
                    <span class="text-secondary">Don't have an account? <a href="register.php" class="text-decoration-none">Register here</a></span>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
