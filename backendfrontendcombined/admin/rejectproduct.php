<?php
include '../cors.php';
include '../dbconnection.php';

if (isset($_POST['product_id'])) {
    $query = "UPDATE wasteproducts SET approved = 0 WHERE id = " . $_POST['product_id'];
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product rejected successfully!')</script>";
        echo "<script>window.location.href='adminpanel.php'</script>";
        exit();
    } else {
        echo "<script>alert('Error rejecting product!')</script>";
        echo "<script>window.location.href='adminpanel.php'</script>";
        exit();
    }
}
