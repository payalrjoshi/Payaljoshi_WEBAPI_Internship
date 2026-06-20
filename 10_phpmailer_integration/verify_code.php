<?php
session_start();

$msg = "";

if(!isset($_SESSION['reset_email']) || !isset($_SESSION['reset_code'])) {
    header("Location: forgot_password.php");
    exit();
}

$email = $_SESSION['reset_email'];

if(isset($_POST['submit'])) {
    $code = $_POST['code'];

    if($code == $_SESSION['reset_code']) {
        // Verification success!
        $_SESSION['code_verified'] = true;
        header("Location: new_password.php");
        exit();
    } else {
        $msg = "Error: Invalid verification code.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Verify Code</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{ background: #f1f5f9; min-height:100vh; }
.auth-card{ border:none; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.1); }
.card-header{ background:linear-gradient(135deg,#2563eb,#1e40af); color:#fff; border-radius:20px 20px 0 0 !important; text-align:center; padding:20px; }
.btn-auth{ background:#2563eb; border:none; padding:12px; font-weight:600; }
.btn-auth:hover{ background:#1e40af; }
.error-msg{ background:#fee2e2; color:#991b1b; border:1px solid #fecaca; }
.success-msg{ background:#d1fae5; color:#065f46; border:1px solid #a7f3d0; }
.letter-spacing-2 { letter-spacing: 5px; }
</style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card auth-card w-100" style="max-width: 450px;">
        <div class="card-header">
            <h3 class="mb-0">Verify Identity</h3>
        </div>
        <div class="card-body p-4 p-md-5">
            <?php if(!empty($msg)): ?>
                <div class="alert error-msg p-3 mb-4 rounded"><?php echo $msg; ?></div>
            <?php else: ?>
                <div class="alert success-msg p-3 mb-4 rounded">Code sent to <br><b><?php echo htmlspecialchars($email); ?></b></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary">Enter 6-digit Verification Code</label>
                    <input type="text" name="code" class="form-control form-control-lg text-center fw-bold letter-spacing-2" placeholder="------" maxlength="6" required>
                </div>
                
                <button type="submit" name="submit" class="btn btn-auth w-100 text-white btn-lg mt-2 shadow-sm rounded-pill">
                    Verify Code
                </button>

                <div class="text-center mt-3">
                    <a href="forgot_password.php" class="text-decoration-none">Resend Code</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
