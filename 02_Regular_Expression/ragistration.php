<?php
$mess = "";

$first_nameErr = $middle_nameErr = $last_nameErr = $cityErr = $emailErr = $phoneErr = $genderErr = $aadhaar_noErr = $pan_noErr = $usernameErr = $passwordErr = $confirm_passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $valid = true;  

    // First Name Validation
    if (empty($_POST["first_name"])) 
    {
        $first_nameErr = "First name is required";
        $valid = false;
    } 
    else 
    {
        $first_name = trim($_POST["first_name"]);
        if (!preg_match("/^[a-zA-Z ]+$/",$first_name)) 
        {
            $first_nameErr = "Only letters and spaces are allowed";
            $valid = false;
        }
    }

    
    if (empty($_POST["middle_name"])) 
    {
        $middle_nameErr = "middle name is required";
        $valid = false;
    } 
    else 
    {
        $middle_name = trim($_POST["middle_name"]);
        if (!preg_match("/^[a-zA-Z ]+$/",$middle_name)) 
        {
            $middle_nameErr = "Only letters and spaces are allowed";
            $valid = false;
        }
    }


    // Last Name Validation
    if (empty($_POST["last_name"])) 
    {
        $last_nameErr = "Last name is required";
        $valid = false;
    } 
    else 
    {
        $last_name = trim($_POST["last_name"]);
        if (!preg_match("/^[a-zA-Z\s]+$/", $last_name)) 
        {
            $last_nameErr = "Only letters and spaces are allowed";
            $valid = false;
        }
    }

    // City Validation
    if (empty($_POST["city"])) 
    {
        $cityErr = "City is required";
        $valid = false;
    } 
    else 
    {
        $city = trim($_POST["city"]);
        if (!preg_match("/^[a-zA-Z\s]*$/", $city)) 
        {
            $cityErr = "Only letters and spaces are allowed";
            $valid = false;
        }
    }

    // Email Validation
    if (empty($_POST["email"])) 
    {
        $emailErr = "Email is required";
        $valid = false;
    } 
    else 
    {
        $email = trim($_POST["email"]);
        if (!preg_match("/^[\w\.-]+@[\w\.-]+\.\w+$/",$email)) 
        {
            $emailErr = "Please enter a valid email format";
            $valid = false;
        }
    }

    // Phone Validation
    if (empty($_POST["phone"])) 
    {
        $phoneErr = "Phone number is required";
        $valid = false;
    } 
    else 
    {
        $phone = trim($_POST["phone"]);
        if (!preg_match("/^[6-9]\d{9}$/", $phone)) 
        {
            $phoneErr = "Enter a valid 10-digit Indian phone number";
            $valid = false;
        }
    }

    // Gender Validation
    if (empty($_POST["gender"])) 
    {
        $genderErr = "Gender selection is required";
        $valid = false;
    } 
    else 
    {
        $gender = trim($_POST["gender"]);
    }

    // Aadhaar Validation
    if (empty($_POST["aadhaar_no"])) 
    {
        $aadhaar_noErr = "Aadhaar number is required";
        $valid = false;
    } 
    else 
    {
        $aadhaar_no = htmlspecialchars(trim($_POST["aadhaar_no"]));
        // Note: fixed a minor syntax typo in your original regex array bracket here
        if (!preg_match("/^[2-9]{1}[0-9]{11}$/", $aadhaar_no)) 
        {
            $aadhaar_noErr = "Must be exactly 12 digits";
            $valid = false;
        }
    }

    // PAN Card Validation
    if (empty($_POST["pan_no"])) 
    {
        $pan_noErr = "PAN card number is required";
        $valid = false;
    } 
    else 
    {
        $pan_no = trim($_POST["pan_no"]);
        if (!preg_match("/^[A-Z]{5}[0-9]{4}[A-Z]$/", $pan_no)) 
        {
            $pan_noErr = "Enter a valid PAN format (e.g., ABCDE1234F)";
            $valid = false;
        }
    }

    // Username Validation
    if (empty($_POST["username"])) 
    {
        $usernameErr = "Username is required";
        $valid = false;
    } 
    else 
    {
        $username = trim($_POST["username"]);
        if (!preg_match("/^[A-Za-z0-9_]{4,20}$/", $username)) 
        {
            $usernameErr = "4-20 characters, only letters, numbers, and '_' allowed";
            $valid = false;
        }
    }

    // Password Validation
    if (empty($_POST["password"])) 
    {
        $passwordErr = "Password is required";
        $valid = false;
    } 
    else 
    {
        $password = $_POST["password"];
        if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) 
        {
            $passwordErr = "Must include uppercase, lowercase, number, special char, and be 8+ chars";
            $valid = false;
        }
    }

    // Confirm Password Validation
    if (empty($_POST["confirm_password"])) 
    {
        $confirm_passwordErr = "enter confirm password";
        $valid = false;
    } 
    else 
    {
        $confirm_password = $_POST["confirm_password"];
        if (!empty($_POST["password"]) && $confirm_password !== $_POST["password"]) 
        {
            $confirm_passwordErr = "confirm your password";
            $valid = false;
        }
    }

    if ($valid)
    {
        $mess = "<p style='color: #2e7d32; font-weight: bold;'>Registration successful for $first_name!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px;
            background-color: #e8ebf0;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: #333333;
        }

        h2 {
            font-size: 2em;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 50px;
            color: #1E3A8A; 
            text-align: center;
        }

        form {
            width: 100%;
            max-width: 900px;
            background-color: #ffffff; 
            border: 1px solid #d1d9e6;
            border-radius: 12px;
            padding: 45px;
            box-sizing: border-box;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
            
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px 40px;
        }

        .form-group 
        {
            display: flex;
            flex-direction: column;
        }

        .full-width 
        {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 0.95em;
            color: #1a202c; 
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            box-sizing: border-box;
            background: #f8fafc; 
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            color: #1a202c;  
            font-size: 1em;
            transition: all 0.3s ease;
        }

        input::placeholder {
            color: #94a3b8;
        }

        input:focus {
            outline: none;
            border-color: #1034A6; 
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(16, 52, 166, 0.15);
        }

        .radio-group {
            display: flex;
            gap: 20px;
            padding: 10px 0;
            align-items: center;
            color: #1a202c;
        }

        .radio-group input {
            margin-right: 5px;
        }

        .error-text {
            color: #d32f2f; 
            font-size: 0.85em;
            margin-top: 6px;
            min-height: 18px;
        }

        button {
            width: 100%;
            padding: 15px;
            background: #1034A6;  
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.1em;
            margin-top: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(16, 52, 166, 0.2);
        }

        button:hover {
            background: #0d2985; 
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(16, 52, 166, 0.3);
        }
        
        .message-container {
            grid-column: 1 / -1;
            text-align: center;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
                gap: 24px 0px;
            }
        }
    </style>
</head>
<body>
    
    <h2>REGISTRATION FORM</h2>

    <form method="POST">
        
        <?php if($mess) echo "<div class='message-container'>$mess</div>"; ?>

        <div class="form-group">
            <label>👤 First Name</label>
            <input type="text" name="first_name" placeholder="Enter your first name">
            <span class="error-text"><?php echo $first_nameErr; ?></span>
        </div>

        <div class="form-group">
            <label>👤 Middle Name</label>
            <input type="text" name="middle_name" placeholder="Enter your middle name">
            <span class="error-text"><?php echo $middle_nameErr; ?></span>
        </div>

        <div class="form-group">
            <label>👤 Last Name</label>
            <input type="text" name="last_name" placeholder="Enter your last name">
            <span class="error-text"><?php echo $last_nameErr; ?></span>
        </div>

        <div class="form-group">
            <label>🆔 Username</label>
            <input type="text" name="username" placeholder="Choose a username">
            <span class="error-text"><?php echo $usernameErr; ?></span>
        </div>

        <div class="form-group">
            <label>✉️ Email</label>
            <input type="email" name="email" placeholder="Enter your email address">
            <span class="error-text"><?php echo $emailErr; ?></span>
        </div>

        <div class="form-group">
            <label>📞 Phone Number</label>
            <input type="tel" name="phone" placeholder="Enter your 10-digit phone number">
            <span class="error-text"><?php echo $phoneErr; ?></span>
        </div>

        <div class="form-group">
            <label>🌐 City</label>
            <input type="text" name="city" placeholder="Enter your city">
            <span class="error-text"><?php echo $cityErr; ?></span>
        </div>

        <div class="form-group">
            <label>👥 Gender</label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="male"> Male</label>
                <label><input type="radio" name="gender" value="female"> Female</label>
            </div>
            <span class="error-text"><?php echo $genderErr; ?></span>
        </div>

        <div class="form-group">
            <label>🪪 Aadhaar Number</label>
            <input type="tel" name="aadhaar_no" placeholder="[Aadhaar Redacted]">
            <span class="error-text"><?php echo $aadhaar_noErr; ?></span>
        </div>

        <div class="form-group">
            <label>💳 PAN Card Number</label>
            <input type="text" name="pan_no" placeholder="Enter your PAN card number">
            <span class="error-text"><?php echo $pan_noErr; ?></span>
        </div>

        <div class="form-group">
            <label>🔒 Password</label>
            <input type="password" name="password" placeholder="Create a secure password">
            <span class="error-text"><?php echo $passwordErr; ?></span>
        </div>
        
        <div class="form-group">
            <label>🔒 Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Confirm your password">
            <span class="error-text"><?php echo $confirm_passwordErr; ?></span>
        </div>

        <div class="full-width">
            <button type="submit">Submit Registration</button>
        </div>

    </form>

</body>
</html>