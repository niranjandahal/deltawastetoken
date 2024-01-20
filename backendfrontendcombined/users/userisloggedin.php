<?php
include '../cors.php';
include '../dbconnection.php';

session_name('validuser');
session_start();
if (isset($_SESSION['userloggedin']) && $_SESSION['userloggedin'] === 'true') {
    
   
} else {
    echo "<script>alert('You are not logged in. Please log in to buy products.')</script>";
    echo "<script>window.location.href='../users/index.php'</script>";
    exit();
}
