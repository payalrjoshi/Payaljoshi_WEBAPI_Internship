<?php
require('vendor/autoload.php');
require('db.php');

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$key_id = "";
$key_secret = "";

$success = false;
$error = "Razorpay Error";

$razorpay_payment_id = $_POST['razorpay_payment_id'] ?? '';
$razorpay_order_id = $_POST['razorpay_order_id'] ?? '';
$razorpay_signature = $_POST['razorpay_signature'] ?? '';

if (!empty($razorpay_payment_id) && !empty($razorpay_signature) && !empty($razorpay_order_id)) {
    $api = new Api($key_id, $key_secret);

    try {
        $attributes = array(
            'razorpay_order_id' => $razorpay_order_id,
            'razorpay_payment_id' => $razorpay_payment_id,
            'razorpay_signature' => $razorpay_signature
        );

        $api->utility->verifyPaymentSignature($attributes);
        $success = true;
    } catch(SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
} else {
    $error = 'Invalid Payload data provided.';
}

// Update Database
$status = $success ? 'paid' : 'failed';
$stmt = mysqli_prepare($conn, "UPDATE orders SET status = ?, razorpay_payment_id = ?, razorpay_signature = ? WHERE razorpay_order_id = ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssss", $status, $razorpay_payment_id, $razorpay_signature, $razorpay_order_id);
    if (!mysqli_stmt_execute($stmt)) {
        error_log("DB Update Error: " . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);
} else {
    error_log("DB Update Prepare Error: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment <?= $success ? 'Successful' : 'Failed' ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #1e1b4b, #312e81);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-family: 'Inter', sans-serif;
      margin: 0;
      text-align: center;
    }
    .glass-card {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 24px;
      padding: 50px 40px;
      width: 100%;
      max-width: 450px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }
    .icon {
      font-size: 80px;
      margin-bottom: 20px;
      animation: pop 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
      transform: scale(0);
    }
    @keyframes pop {
      to { transform: scale(1); }
    }
    .success-icon { color: #34d399; }
    .error-icon { color: #f87171; }
    
    h1 {
      font-size: 2rem;
      margin-bottom: 10px;
      font-weight: 600;
    }
    p {
      color: #cbd5e1;
      margin-bottom: 30px;
      line-height: 1.6;
    }
    .payment-id {
      background: rgba(0,0,0,0.3);
      padding: 10px;
      border-radius: 8px;
      font-family: monospace;
      color: #a5b4fc;
      word-break: break-all;
      margin-bottom: 30px;
    }
    .btn {
      display: inline-block;
      padding: 14px 30px;
      background: #4f46e5;
      color: white;
      text-decoration: none;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    .btn:hover {
      background: #4338ca;
      transform: translateY(-2px);
      box-shadow: 0 10px 20px -10px #4f46e5;
    }
  </style>
</head>
<body>

  <div class="glass-card">
    <?php if ($success): ?>
        <div class="icon success-icon">✓</div>
        <h1>Payment Successful!</h1>
        <p>Thank you for your purchase. Your transaction has been verified and completed successfully.</p>
        <div class="payment-id">ID: <?= htmlspecialchars($razorpay_payment_id) ?></div>
    <?php else: ?>
        <div class="icon error-icon">✕</div>
        <h1>Payment Failed</h1>
        <p>We could not verify your payment. Please try again or contact support.</p>
        <div class="payment-id">Error: <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <a href="index.html" class="btn">Return to Home</a>
  </div>

</body>
</html>
