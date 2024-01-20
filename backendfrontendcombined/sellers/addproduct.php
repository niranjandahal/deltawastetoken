<?php
include '../cors.php';
session_name('validseller');
session_start();

if (!isset($_SESSION['ref_seller_id']) || !isset($_SESSION['seller_name']) || !isset($_SESSION['seller_email'])) {
  http_response_code(401);
  echo "<script>alert('You are not logged in')</script>";
  echo "<script>window.location.href='sellerslogin.php'</script>";
  exit();
}

$recivedsellerid = $_SESSION['ref_seller_id'];
include '../dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $productName = mysqli_real_escape_string($conn, $_POST['product_name']);
  $productDescription = mysqli_real_escape_string($conn, $_POST['product_description']);
  $productPrice = mysqli_real_escape_string($conn, $_POST['product_price']);
  $productcategory = mysqli_real_escape_string($conn, $_POST['product_category']);

  if (isset($_FILES['product_image'])) {

    $fileCount = count($_FILES['product_image']['name']);
    $uploadSuccess = true;
    $targetDirectory = "../uploads/";

    for ($i = 0; $i < $fileCount; $i++) {
      $fileName = $_FILES['product_image']['name'][$i];
      $fileTmpName = $_FILES['product_image']['tmp_name'][$i];
      $targetFile = $targetDirectory . basename($fileName);
      $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

      $check = getimagesize($fileTmpName);
      if ($check !== false) {
        $allowedFormats = array("jpg", "jpeg", "png");
        if (in_array($fileType, $allowedFormats)) {
          $maxFileSize = 25 * 1024;

          if (move_uploaded_file($fileTmpName, $targetFile)) {
            $query = "INSERT INTO wasteproducts (seller_id, wasteproduct_name, wasteproduct_description, wasteproduct_category, wasteproduct_price, wasteproduct_image) VALUES ('$recivedsellerid', '$productName', '$productDescription', '$productcategory', '$productPrice', '$targetFile')";

            if (mysqli_query($conn, $query)) {
              echo "<script>alert('Product added successfully for review')</script>";
              echo "<script>window.location.href='../index.html'</script>";
              exit();
            } else {
              echo "<script>alert('Failed to add product')</script>";
              echo "<script>window.location.href='addproduct.php'</script>";
            }
          } else {
            echo "<script>alert('Failed to upload product image')</script>";
            echo "<script>window.location.href='addproduct.php'</script>";
            $uploadSuccess = false;
          }
        } else {
          echo "<script>alert('Invalid image format')</script>";
          echo "<script>window.location.href='addproduct.php'</script>";
          $uploadSuccess = false;
        }
      } else {
        echo "<script>alert('File is not an image')</script>";
        echo "<script>window.location.href='addproduct.php'</script>";
        $uploadSuccess = false;
      }
    }

    if (!$uploadSuccess) {
      echo "<script>alert('Failed to upload product image')</script>";
      echo "<script>window.location.href='addproduct.php'</script>";
    }
  }

  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>add product</title>
  <link href="../dist/output.css" rel="stylesheet" />
</head>

<body style="background-color: #e2e8f0; display: flex; align-items: center; justify-content: center; height: 100vh;">
  <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md">
    <h2 class="text-lg font-semibold text-gray-700 capitalize">Manage waste:</h2>

    <form method="POST" action="addproduct.php" enctype="multipart/form-data">

      <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
        <div>
          <label class="text-gray-700" for="product_name">Product Name</label>
          <input type="text" name="product_name" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 outline-none">
        </div>

        <div>
          <label class="text-gray-700" for="Product_category"> Category</label>
          <input type="text" name="product_category" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 outline-none">
        </div>

        <div>
          <label class="text-gray-700" for="product_price">quantity in kg</label>
          <input type="number" name="product_price" step="0.01" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 outline-none">
        </div>

        <div>
          <label for="product_image" class="text-gray-700" for="Product_category">Image<25kb< /label>
              <input type="file" name="product_image[]" accept="image/*" multiple directory class="block w-full px-3 py-2 mt-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-lg focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 outline-none" />
        </div>

        <div>
          <label class="text-gray-700" for="product_description">Description(optional)</label>
          <textarea placeholder="Optional" name="product_description" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 outline-none"> Optional </textarea>
        </div>

      </div>

      <div class="flex justify-end mt-6">
        <button class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
      </div>
    </form>
  </section>
</body>

</html>