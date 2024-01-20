<?php
include '../cors.php';
include '../dbconnection.php';

if (isset($_POST['product_id'])) {
    $query = "DELETE FROM wasteproducts WHERE id = " . $_POST['product_id'];
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product deleted successfully!')</script>";
        echo "<script>window.location.href='adminpanel.php'</script>";
        exit();
    } else {
        echo "<script>alert('Error deleting product!')</script>";
        echo "<script>window.location.href='adminpanel.php'</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid action')</script>";
    echo "<script>window.location.href='adminpanel.php'</script>";
}
