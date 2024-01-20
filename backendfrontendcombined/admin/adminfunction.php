<?php
include "../cors.php";
include '../dbconnection.php';
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function cleardatabase()
{
  global $conn;
  $query = "DELETE FROM wasteproducts WHERE approved = 2";
  $result = mysqli_query($conn, $query);
  if ($result) {
    echo "<script>alert('Database cleared successfully')</script>";
    echo "<script>window.location.href='adminpanel.php'</script>";
    exit();
  } else {
    echo "<script>alert('Database not cleared')</script>";
    echo "<script>window.location.href='adminpanel.php'</script>";
    exit();
  }
}

function allnonapprovedproduct()
{
  global $conn;
  $query = "SELECT wasteproducts.*, sellers.full_name AS seller_name FROM wasteproducts INNER JOIN sellers ON wasteproducts.seller_id = sellers.id WHERE wasteproducts.approved = 0 ORDER BY wasteproducts.seller_id DESC";

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Non-Approved wasteProducts</title>';
    echo '<style>';
    echo 'body {';
    echo '  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;';
    echo '  background-color: #f8f9fa;';
    echo '  margin: 0;';
    echo '  padding: 0;';
    echo '}';
    echo '';
    echo '.product-container {';
    echo '  width: 80%;';
    echo '  margin: 50px auto;';
    echo '  padding: 20px;';
    echo '  background-color: #fff;';
    echo '  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);';
    echo '  border-radius: 10px;';
    echo '}';
    echo '';
    echo '.product-details {';
    echo '  text-align: left;';
    echo '  margin-bottom: 10px;';
    echo '}';
    echo '';
    echo '.product-image {';
    echo '  max-width: 100%;';
    echo '  height: auto;';
    echo '  border-radius: 5px;';
    echo '  margin-bottom: 10px;';
    echo '}';
    echo '';
    echo '.button-container {';
    echo '  display: flex;';
    echo '  justify-content: space-between;';
    echo '}';
    echo '';
    echo 'button {';
    echo '  padding: 10px;';
    echo '  border: none;';
    echo '  border-radius: 5px;';
    echo '  cursor: pointer;';
    echo '}';
    echo '';
    echo '.approve-button {';
    echo '  background-color: #28a745;';
    echo '  color: #fff;';
    echo '}';
    echo '';
    echo '.reject-button {';
    echo '  background-color: #dc3545;';
    echo '  color: #fff;';
    echo '}';
    echo '</style>';
    echo '</head>';
    echo '<body>';

    echo '<div class="product-container">';

    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="product-details">';
      echo '<h2>Product Name: ' . $row['wasteproduct_name'] . '</h2>';
      echo '<p>Product Description: ' . $row['wasteproduct_description'] . '</p>';
      echo '<p>Product Price: $' . $row['wasteproduct_price'] . '</p>';
      echo '<p>Category: ' . $row['wasteproduct_category'] . '</p>';
      echo '<img class="product-image" src="../uploads/' . $row['wasteproduct_image'] . '" alt="Product Image" />';
      echo '</div>';

      echo '<div class="button-container">';
      echo '<form method="post" action="approveproduct.php">';
      echo '<input type="hidden" name="product_id" value="' . $row['id'] . '" />';
      echo '<button class="approve-button" type="submit" name="approve">Approve</button>';
      echo '</form>';

      echo '<form method="post" action="rejectproduct.php">';
      echo '<input type="hidden" name="product_id" value="' . $row['id'] . '" />';
      echo '<button class="reject-button" type="submit" name="reject">Reject</button>';
      echo '</form>';
      echo '</div>';
    }

    echo '</div>';

    echo '</body>';
    echo '</html>';
  } else {
    echo "<script>alert('No pending Product')</script>";
    echo "<script>window.location.href='adminpanel.php'</script>";
    exit();
  }
}

function allnonapprovedproductsellername()
{
  global $conn;
  $query = "SELECT wasteproducts.*, sellers.full_name AS seller_name FROM wasteproducts INNER JOIN sellers ON wasteproducts.seller_id = sellers.id WHERE wasteproducts.approved = 0 ORDER BY wasteproducts.seller_id DESC";
  $result = mysqli_query($conn, $query);

  echo '<html lang="en">';
  echo '<head>';
  echo '<meta charset="UTF-8">';
  echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
  echo '<title>Non-Approved wasteProducts by Seller</title>';
  echo '<style>';
  echo 'body {';
  echo '  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;';
  echo '  background-color: #f8f9fa;';
  echo '  margin: 0;';
  echo '  padding: 0;';
  echo '}';
  echo '';
  echo '.product-container {';
  echo '  width: 80%;';
  echo '  margin: 50px auto;';
  echo '  padding: 20px;';
  echo '  background-color: #fff;';
  echo '  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);';
  echo '  border-radius: 10px;';
  echo '}';
  echo '';
  echo '.product-details {';
  echo '  text-align: left;';
  echo '  margin-bottom: 10px;';
  echo '}';
  echo '';
  echo '.product-image {';
  echo '  max-width: 100%;';
  echo '  height: auto;';
  echo '  border-radius: 5px;';
  echo '  margin-bottom: 10px;';
  echo '}';
  echo '';
  echo '.button-container {';
  echo '  display: flex;';
  echo '  justify-content: space-between;';
  echo '}';
  echo '';
  echo 'button {';
  echo '  padding: 10px;';
  echo '  border: none;';
  echo '  border-radius: 5px;';
  echo '  cursor: pointer;';
  echo '}';
  echo '';
  echo '.approve-button {';
  echo '  background-color: #28a745;';
  echo '  color: #fff;';
  echo '}';
  echo '';
  echo '.reject-button {';
  echo '  background-color: #dc3545;';
  echo '  color: #fff;';
  echo '}';
  echo '</style>';
  echo '</head>';
  echo '<body>';

  echo '<div class="product-container">';

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="product-details">';
      echo '<h2>Seller Name: ' . $row['seller_name'] . '</h2>';
      echo '<h3>Product Name: ' . $row['wasteproduct_name'] . '</h3>';
      echo '<p>Product Description: ' . $row['wasteproduct_description'] . '</p>';
      echo '<p>Product Price: $' . $row['wasteproduct_price'] . '</p>';
      echo '<p>Category: ' . $row['wasteproduct_category'] . '</p>';
      echo '<img class="product-image" src="../uploads/' . $row['wasteproduct_image'] . '" alt="Product Image" />';
      echo '</div>';
      echo '<div class="button-container">';
      echo '<form method="post" action="approveproduct.php">';
      echo '<input type="hidden" name="product_id" value="' . $row['id'] . '" />';
      echo '<button class="approve-button" type="submit" name="approve">Approve</button>';
      echo '</form>';

      echo '<form method="post" action="rejectproduct.php">';
      echo '<input type="hidden" name="product_id" value="' . $row['id'] . '" />';
      echo '<button class="reject-button" type="submit" name="reject">Reject</button>';
      echo '</form>';
      echo '</div>';
    }
  } else {
    echo '<p>No pending wasteproducts</p>';
  }

  echo '</div>';

  echo '</body>';
  echo '</html>';
  exit();
}
function allnonapprovedproductcategory()
{
  global $conn;
  $query = "SELECT wasteproducts.*, sellers.full_name as seller_name FROM wasteproducts INNER JOIN sellers ON wasteproducts.seller_id = sellers.id WHERE wasteproducts.approved = 0 ORDER BY wasteproducts.wasteproduct_category ;";
  $result = mysqli_query($conn, $query);

  echo '<html lang="en">';
  echo '<head>';
  echo '<meta charset="UTF-8">';
  echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
  echo '<title>Non-Approved wasteProducts by Category</title>';
  echo '<style>';
  echo 'body {';
  echo '  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;';
  echo '  background-color: #f8f9fa;';
  echo '  margin: 0;';
  echo '  padding: 0;';
  echo '}';
  echo '';
  echo '.product-container {';
  echo '  width: 80%;';
  echo '  margin: 50px auto;';
  echo '  padding: 20px;';
  echo '  background-color: #fff;';
  echo '  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);';
  echo '  border-radius: 10px;';
  echo '}';
  echo '';
  echo '.product-details {';
  echo '  text-align: left;';
  echo '  margin-bottom: 10px;';
  echo '}';
  echo '';
  echo '.product-image {';
  echo '  max-width: 100%;';
  echo '  height: auto;';
  echo '  border-radius: 5px;';
  echo '  margin-bottom: 10px;';
  echo '}';
  echo '';
  echo '.button-container {';
  echo '  display: flex;';
  echo '  justify-content: space-between;';
  echo '}';
  echo '';
  echo 'button {';
  echo '  padding: 10px;';
  echo '  border: none;';
  echo '  border-radius: 5px;';
  echo '  cursor: pointer;';
  echo '}';
  echo '';
  echo '.approve-button {';
  echo '  background-color: #28a745;';
  echo '  color: #fff;';
  echo '}';
  echo '';
  echo '.reject-button {';
  echo '  background-color: #dc3545;';
  echo '  color: #fff;';
  echo '}';
  echo '</style>';
  echo '</head>';
  echo '<body>';

  echo '<div class="product-container">';

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="product-details">';
      echo '<h2>Category: ' . $row['wasteproduct_category'] . '</h2>';
      echo '<h3>Product Name: ' . $row['wasteproduct_name'] . '</h3>';
      echo '<p>Product Description: ' . $row['wasteproduct_description'] . '</p>';
      echo '<p>Product Price: $' . $row['wasteproduct_price'] . '</p>';
      echo '<p>Category: ' . $row['wasteproduct_category'] . '</p>';
      echo '<img class="product-image" src="../uploads/' . $row['wasteproduct_image'] . '" alt="Product Image" />';
      echo '</div>';

      echo '<div class="button-container">';
      echo '<form method="post" action="approveproduct.php">';
      echo '<input type="hidden" name="product_id" value="' . $row['id'] . '" />';
      echo '<button class="approve-button" type="submit" name="approve">Approve</button>';
      echo '</form>';

      echo '<form method="post" action="rejectproduct.php">';
      echo '<input type="hidden" name="product_id" value="' . $row['id'] . '" />';
      echo '<button class="reject-button" type="submit" name="reject">Reject</button>';
      echo '</form>';
      echo '</div>';
    }
  } else {
    echo '<p>No pending wasteproducts</p>';
  }

  echo '</div>';

  echo '</body>';
  echo '</html>';
  exit();
}
function allsellersdetails()
{
  global $conn;
  $query = "SELECT * FROM sellers";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Sellers Details</title>';
    echo '<style>';
    echo 'body {';
    echo '  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;';
    echo '  background-color: #f8f9fa;';
    echo '  margin: 0;';
    echo '  padding: 0;';
    echo '}';
    echo '';
    echo 'table {';
    echo '  width: 80%;';
    echo '  margin: 50px auto;';
    echo '  border-collapse: collapse;';
    echo '  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);';
    echo '  overflow: hidden;';
    echo '  border-radius: 10px;';
    echo '  background-color: #fff;';
    echo '}';
    echo '';
    echo 'th, td {';
    echo '  padding: 12px;';
    echo '  text-align: left;';
    echo '  border-bottom: 1px solid #ddd;';
    echo '}';
    echo '';
    echo 'th {';
    echo '  background-color: #007bff;';
    echo '  color: #fff;';
    echo '}';
    echo '';
    echo 'tr:hover {';
    echo '  background-color: #f5f5f5;';
    echo '}';
    echo '</style>';
    echo '</head>';
    echo '<body>';

    echo '<table>';
    echo '<tr>';
    echo '<th>Full Name</th>';
    echo '<th>Address</th>';
    echo '<th>Phone Number</th>';
    echo '<th>Email</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['full_name'] . '</td>';
      echo '<td>' . $row['address'] . '</td>';
      echo '<td>' . $row['phone_number'] . '</td>';
      echo '<td>' . $row['email'] . '</td>';
      echo '</tr>';
    }

    echo '</table>';
    echo '</body>';
    echo '</html>';
  }
}


function allusersdetails()
{
  global $conn;
  $query = "SELECT * FROM organizations";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Users Details</title>';
    echo '<style>';
    echo 'body {';
    echo '  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;';
    echo '  background-color: #f8f9fa;';
    echo '  margin: 0;';
    echo '  padding: 0;';
    echo '}';
    echo '';
    echo 'table {';
    echo '  width: 80%;';
    echo '  margin: 50px auto;';
    echo '  border-collapse: collapse;';
    echo '  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);';
    echo '  overflow: hidden;';
    echo '  border-radius: 10px;';
    echo '  background-color: #fff;';
    echo '}';
    echo '';
    echo 'th, td {';
    echo '  padding: 12px;';
    echo '  text-align: left;';
    echo '  border-bottom: 1px solid #ddd;';
    echo '}';
    echo '';
    echo 'th {';
    echo '  background-color: #007bff;';
    echo '  color: #fff;';
    echo '}';
    echo '';
    echo 'tr:hover {';
    echo '  background-color: #f5f5f5;';
    echo '}';
    echo '</style>';
    echo '</head>';
    echo '<body>';

    echo '<table>';
    echo '<tr>';
    echo '<th>Full Name</th>';
    echo '<th>Address</th>';
    echo '<th>Phone Number</th>';
    echo '<th>Email</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['full_name'] . '</td>';
      echo '<td>' . $row['address'] . '</td>';
      echo '<td>' . $row['phone_number'] . '</td>';
      echo '<td>' . $row['email'] . '</td>';
      echo '</tr>';
    }

    echo '</table>';
    echo '</body>';
    echo '</html>';
  }
}


function rejectproduct()
{
  global $conn;
  $query = "SELECT wasteproducts.*, sellers.full_name AS seller_name FROM wasteproducts INNER JOIN sellers ON wasteproducts.seller_id = sellers.id WHERE wasteproducts.approved = 1 ORDER BY wasteproducts.seller_id DESC";

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Rejected wasteProducts</title>';
    echo '<style>';
    echo 'body {';
    echo '  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;';
    echo '  background-color: #f8f9fa;';
    echo '  margin: 0;';
    echo '  padding: 0;';
    echo '}';
    echo '';
    echo '.product-container {';
    echo '  width: 80%;';
    echo '  margin: 50px auto;';
    echo '  padding: 20px;';
    echo '  background-color: #fff;';
    echo '  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);';
    echo '  border-radius: 10px;';
    echo '}';
    echo '';
    echo '.product-details {';
    echo '  text-align: left;';
    echo '  margin-bottom: 10px;';
    echo '}';
    echo '';
    echo '.product-image {';
    echo '  max-width: 100%;';
    echo '  height: auto;';
    echo '  border-radius: 5px;';
    echo '  margin-bottom: 10px;';
    echo '}';
    echo '';
    echo '.button-container {';
    echo '  display: flex;';
    echo '  justify-content: space-between;';
    echo '}';
    echo '';
    echo 'button {';
    echo '  padding: 10px;';
    echo '  border: none;';
    echo '  border-radius: 5px;';
    echo '  cursor: pointer;';
    echo '}';
    echo '';
    echo '.reject-button {';
    echo '  background-color: #dc3545;';
    echo '  color: #fff;';
    echo '}';
    echo '';
    echo '.delete-button {';
    echo '  background-color: #007bff;';
    echo '  color: #fff;';
    echo '}';
    echo '</style>';
    echo '</head>';
    echo '<body>';

    echo '<div class="product-container">';

    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="product-details">';
      echo '<h3>Product Name: ' . $row['wasteproduct_name'] . '</h3>';
      echo '<p>Product Description: ' . $row['wasteproduct_description'] . '</p>';
      echo '<p>Product Price: $' . $row['wasteproduct_price'] . '</p>';
      echo '<p>Category: ' . $row['wasteproduct_category'] . '</p>';
      echo '<img class="product-image" src="../uploads/' . $row['wasteproduct_image'] . '" alt="Product Image" />';
      echo '</div>';

      echo '<div class="button-container">';
      echo '<form method="post" action="rejectproduct.php">';
      echo '<input type="hidden" name="product_id" value="' . $row['id'] . '" />';
      echo '<button class="reject-button" type="submit" name="reject">Reject</button>';
      echo '</form>';

      echo '<form method="post" action="permanentlydeleteproduct.php">';
      echo '<input type="hidden" name="product_id" value="' . $row['id'] . '" />';
      echo '<button class="delete-button" type="submit" name="permanentlydelete">Permanently Delete</button>';
      echo '</form>';
      echo '</div>';
    }

    echo '</div>';

    echo '</body>';
    echo '</html>';
  }
}
