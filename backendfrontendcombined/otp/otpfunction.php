<?php
include "../cors.php";
session_name('otpsession');
session_start();
include '../dbconnection.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function sendotp()
{
    global $conn;

    $otp = rand(100000, 999999);
    $_SESSION['otpcode'] = $otp;

    $recipientEmail = $_SESSION['signupemail'];
    $recipientName = $_SESSION['signupname'];

    $url = 'https://api.elasticemail.com/v2/email/send';

    try {
        $post = array(
            'from' => 'haminepali2093@gmail.com',
            'fromName' => 'Ecommerce application',
            'apikey' => '422B8B8FAD61023D1A5C5A01831C0652498E1B14628FEC4090308559D74A25D76A1EDD732FBB1EFDC8AD8D7D788FA18F',
            'subject' => 'OTP VERIFICATION',
            'to' => "$recipientEmail",
            'bodyHtml' => "<h2> Hello, $recipientName Your OTP code is : $otp </h2>",
            'bodyText' => 'from the team wastemanagement',
            'isTransactional' => false
        );
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        $_SESSION['sentotp'] = 'true';
        echo "<script>alert('An otp code was sent check spam folder $recipientEmail')</script>";
        echo '<script>window.location.href="verifyotp.php"</script>';

        exit();
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

function verifyotp()
{
    $otpemail = $_SESSION['signupemail'];


    global $conn;
    $enteredOTP = mysqli_real_escape_string($conn, $_POST['otp']);
    $otpcode = $_SESSION['otpcode'];
    if ($enteredOTP == $otpcode) {
        echo '<script>alert("OTP verified successfully")</script>';
        echo '<script>window.location.href="../sellers/sellersignup.php"</script>';

        exit();
    } else {
        echo "<script>alert('Wrong otp code $otpcode check spam folder for $otpemail')</script>";
        echo '<script>window.location.href="verifyotp.php"</script>';
    }
}
