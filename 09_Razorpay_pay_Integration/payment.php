<?php
require('vendor/autoload.php');
require('db.php');

use Razorpay\Api\Api;

$key_id = "";
$key_secret = "";

// Get POST data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$contact = $_POST['contact'] ?? '';
$amount = $_POST['amount'] ?? 1000; // in paise

if (empty($name) || empty($email) || empty($contact)) {
    die("Invalid request. Please fill out the form.");
}

$api = new Api($key_id, $key_secret);

// Create order
$order = $api->order->create([
    'receipt' => uniqid(),
    'amount' => $amount,
    'currency' => 'INR',
]);

$order_id = $order['id'];

// Log the order to the database with status 'created'
$status = 'created';
$stmt = mysqli_prepare($conn, "INSERT INTO orders (name, email, contact, amount, razorpay_order_id, status) VALUES (?, ?, ?, ?, ?, ?)");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssiss", $name, $email, $contact, $amount, $order_id, $status);
    if (!mysqli_stmt_execute($stmt)) {
        die("Database error while logging order: " . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);
} else {
    die("Database prepare error: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Processing Payment...</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <style>
    body {
      background: linear-gradient(135deg, #1e1b4b, #312e81);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: white;
      font-family: 'Inter', sans-serif;
      margin: 0;
    }
    .spinner {
      width: 50px;
      height: 50px;
      border: 5px solid rgba(255,255,255,0.1);
      border-top-color: #818cf8;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin-bottom: 20px;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    h2 { font-weight: 300; }
  </style>
</head>
<body>

<div class="spinner"></div>
<h2>Please complete the payment on the secure popup...</h2>

<!-- Hidden form for submitting verification data to verify.php -->
<form id="verifyForm" action="verify.php" method="POST" style="display: none;">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
</form>

<script>
var options = {
    "key": "<?= htmlspecialchars($key_id) ?>", 
    "amount": "<?= htmlspecialchars($amount) ?>",
    "currency": "INR",
    "name": "Premium Services Inc.",
    "description": "Secure Payment Checkout",
    "order_id": "<?= htmlspecialchars($order_id) ?>",
    "handler": function (response) {
        // Populate the hidden form fields with the response data
        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
        document.getElementById('razorpay_signature').value = response.razorpay_signature;
        
        // Submit the form to verify.php
        document.getElementById('verifyForm').submit();
    },
    "prefill": {
        "name": "<?= htmlspecialchars($name) ?>",
        "email": "<?= htmlspecialchars($email) ?>",
        "contact": "<?= htmlspecialchars($contact) ?>"
    },
    "theme": {
        "color": "#4f46e5"
    },
    "method": {
      "upi": true,
      "card": true,
      "wallet": true,
      "netbanking": true
    },
    "config": {
        "display": {
            "blocks": {
                "upi_block": {
                    "name": "Pay via UPI",
                    "instruments": [
                        {
                            "method": "upi"
                        }
                    ]
                }
            },
            "sequence": ["upi_block"],
            "preferences": {
                "show_default_blocks": true
            }
        }
    },
    "modal": {
        "ondismiss": function(){
            window.location.href = 'index.html';
        }
    }
};
var rzp = new Razorpay(options);
rzp.open();
</script>
</body>
</html>
