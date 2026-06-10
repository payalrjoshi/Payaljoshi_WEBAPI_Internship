<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Safe variable assignment to prevent "Undefined array key" warnings
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $captcha  = $_POST['g-recaptcha-response'] ?? '';

    // 2. Graceful error handling instead of an abrupt die()
    if (empty($captcha)) {
        echo "<h2>Please complete the reCAPTCHA.</h2>";
        exit; 
    }

    $secretKey = "6LeoGhMtAAAAAOln-Y9lHE7KqRu4_wqyMbVnHzsW";

    // 3. Use http_build_query for safer, properly encoded URL parameters
    $verifyURL = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query([
        'secret'   => $secretKey,
        'response' => $captcha
    ]);

    $response = file_get_contents($verifyURL);
    $responseData = json_decode($response);

    // 4. Ensure $responseData successfully decoded before checking its properties
    if ($responseData && $responseData->success) {
        
        // Dummy Login Check 
        // 5. Use strict comparison (===) for better security and accuracy
        if ($username === "admin" && $password === "123456") {
            echo "<h2>Login Successful</h2>";
        } else {
            echo "<h2>Invalid Username or Password</h2>";
        }

    } else {
        echo "<h2>reCAPTCHA Verification Failed</h2>";
    }
}
?>