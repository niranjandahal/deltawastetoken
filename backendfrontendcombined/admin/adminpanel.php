<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>


  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }

    nav {
      background-color: #007bff;
      color: #fff;
      padding: 10px;
      text-align: center;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      padding: 10px;
      margin: 0 10px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    nav a:hover {
      background-color: #0056b3;
    }

    .content {
      padding: 20px;
    }

    form {
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      padding: 20px;
      margin-top: 20px;
    }

    input[type="submit"] {
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      background-color: #007bff;
      color: #fff;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      history.replaceState(null, null, document.URL);

      window.addEventListener('popstate', function() {
        window.location.href = 'your_specific_page.php';
      });
    });
  </script>
</head>

<body>
  <div class="content">
    <form method="post" action="adminpanel.php">
      <input type="submit" name="nonapproved_all" value="Non-Approved All" />
      <input type="submit" name="nonapproved_sellername" value="Non-Approved by Seller Name" />
      <input type="submit" name="nonapproved_category" value="Non-Approved by Category" />
      <input type="submit" name="allsellersdetails" value="All Seller Details" />
      <input type="submit" name="allusersdetails" value="All User Details" />
      <input type="submit" name="rejectproduct" value="Edit/Reject Product" />
      <input type="submit" name="cleardatabase" value="Clear Unwanted Data" />
      <input type="submit" name="logout" value="Logout" />
    </form>
  </div>
</body>

</html>


<?php
include "../cors.php";
include 'adminfunction.php';

session_name('validadmin');
session_start();

if (isset($_SESSION['adminname']) && isset($_SESSION['adminpassword'])) {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nonapproved_all'])) {
      allnonapprovedproduct();
    }
    if (isset($_POST['nonapproved_sellername'])) {
      allnonapprovedproductsellername();
    }
    if (isset($_POST['nonapproved_category'])) {
      allnonapprovedproductcategory();
    }
    if (isset($_POST['allsellersdetails'])) {
      allsellersdetails();
    }
    if (isset($_POST['allusersdetails'])) {
      allusersdetails();
    }
    if (isset($_POST['rejectproduct'])) {
      rejectproduct();
    }
    if (isset($_POST['cleardatabase'])) {
      cleardatabase();
    }
    if (isset($_POST['logout'])) {
      session_name('validadmin');
      session_unset();
      session_destroy();
      header("location: ../index.html");
    }
  }
  mysqli_close($conn);
} else {
  header("location: index.php");
}


?>