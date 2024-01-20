<?php
include '../cors.php';
include '../dbconnection.php';
session_name('validseller');
session_start();
session_destroy();
mysqli_close($conn);
echo "<script> alert('You have been logged out!'); </script>";
echo "<script>window.location.href='sellerslogin.php'</script>";
exit();
