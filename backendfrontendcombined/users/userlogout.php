<?php
include '../cors.php';
session_name('validuser');
session_start();
session_destroy();
echo "<script> alert('You have been logged out!'); </script>";
echo "<script>window.location.href='../index.html'</script>";
exit();
