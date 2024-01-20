<?php
include '../cors.php';

if (isset($_POST['action'])) {
  $action = $_POST['action'];

  include "productfunction.php";

  if ($action === 'displayallproducts') {
    displayallproducts();
  } elseif ($action === 'displaysellernameproducts') {
    displaysellernameproducts();
  } elseif ($action === 'displaycategoryproducts') {
    displaycategoryproducts();
  } else {
    echo "script>alert('Invalid action')</script>";
  }
}
