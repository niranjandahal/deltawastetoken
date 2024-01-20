<?php
include "../cors.php";
include '../dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $productId = $_POST['product_id'];
  $action = isset($_POST['approve']) ? 'approve' : 'reject';

  $query = "UPDATE wasteproducts SET approved = " . ($action === 'approve' ? 1 : 2) . " WHERE id = $productId";

  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Product " . ($action === 'approve' ? "approved" : "rejected") . " successfully!')</script>";
    echo "<script>window.location.href='adminpanel.php'</script>";
    
    exit();
  } else {
    
    exit();
  }
  mysqli_close($conn);
}

?>
