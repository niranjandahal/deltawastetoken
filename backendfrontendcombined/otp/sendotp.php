<?php
include '../dbconnection.php';
include "../cors.php";
include 'otpfunction.php';

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $duplicatemeailquery = "SELECT * FROM sellers WHERE email = ?";
    $stmt = mysqli_prepare($conn, $duplicatemeailquery);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        session_destroy();
        echo "<script> alert('User already exists with this email!'); </script>";
        echo "<script>window.location.href='../sellers/index.php'</script>";
        exit();
    } else {
        session_name('otpsession');
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_SESSION['sentotp']) && !empty($_SESSION['sentotp'])) {
                echo "<script> alert('OTP is already sent to your email!'); </script>";
                echo "<script> window.location.href='verifyotp.php'; </script>";
                exit();
            }
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                if (isset($_POST['full_name']) && !empty($_POST['full_name'])) {
                    if (isset($_POST['address']) && !empty($_POST['address'])) {
                        if (isset($_POST['phone_number']) && !empty($_POST['phone_number'])) {
                            if (isset($_POST['password']) && !empty($_POST['password'])) {
                                $_SESSION['signupemail'] = mysqli_real_escape_string($conn, $_POST['email']);
                                $_SESSION['signupname'] = mysqli_real_escape_string($conn, $_POST['full_name']);
                                $_SESSION['signupaddress'] = mysqli_real_escape_string($conn, $_POST['address']);
                                $_SESSION['signupphone'] = mysqli_real_escape_string($conn, $_POST['phone_number']);
                                $_SESSION['signuppassword'] = mysqli_real_escape_string($conn, $_POST['password']);
                                sendotp();
                            }
                        }
                    }
                }
            }
        }
    }
}
