<?php
include "../cors.php";
session_name('otpsession');
session_start();
include '../dbconnection.php';

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  echo "falied connect";
} else {
  if (isset($_SESSION['signupemail']) && !empty($_SESSION['signupemail'])) {
    if (isset($_SESSION['signupname']) && !empty($_SESSION['signupname'])) {
      if (isset($_SESSION['signupaddress']) && !empty($_SESSION['signupaddress'])) {
        if (isset($_SESSION['signupphone']) && !empty($_SESSION['signupphone'])) {
          if (isset($_SESSION['signuppassword']) && !empty($_SESSION['signuppassword'])) {
            $fullName = $_SESSION['signupname'];
            $address = $_SESSION['signupaddress'];
            $phoneNumber = $_SESSION['signupphone'];
            $email = $_SESSION['signupemail'];
            $password =  $_SESSION['signuppassword'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              echo "<script> alert('Invalid email format!'); </script>";
              echo "<script>window.location.href='sellerslogin.php'</script>";
            }
            $checkquery = "SELECT * FROM sellers WHERE email = ?";
            $stmt = mysqli_prepare($conn, $checkquery);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
              session_destroy();
              echo "<script> alert('User already exists with this email!'); </script>";
              echo "<script>window.location.href='sellerslogin.php'</script>";
            
            } else {
              $query = "INSERT INTO sellers (full_name, address, phone_number, email, password) VALUES (?, ?, ?, ?, ?)";
              $stmt = mysqli_prepare($conn, $query);
              mysqli_stmt_bind_param($stmt, "sssss", $fullName, $address, $phoneNumber, $email, $hashedPassword);
              if (mysqli_stmt_execute($stmt)) {
                session_destroy();
                session_name('validseller');
                session_start();
                $_SESSION['validseller'] = 'true';
                echo "<script> alert('You are registered successfully!'); </script>";
                echo "<script>window.location.href='sellerslogin.php'</script>";
               
                exit();
              } else {
                session_destroy();
                echo "<script> alert('Error in signing up!'); </script>";
                echo "<script>window.location.href='sellerslogin.php'</script>";
                exit();
              }
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
          }
        }
      }
    }
  } else {
    echo "<script> alert('Please fill all the fields!'); </script>";
    echo "<script>window.location.href='sellerslogin.php'</script>";
  }
}
