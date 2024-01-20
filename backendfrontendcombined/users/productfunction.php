<?php
include '../cors.php';
session_name('validuser');
session_start();
include '../dbconnection.php';
if (!$conn) {
    echo json_encode([
        'error' => true,
        'errormessage' => mysqli_connect_error(),
    ]);
    exit();
}

function displayallproducts()
{
    global $conn;
    $query = "SELECT wasteproducts.*, sellers.full_name AS seller_name FROM wasteproducts INNER JOIN sellers ON wasteproducts.seller_id = sellers.id WHERE wasteproducts.approved = 1 ORDER BY seller_name";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $resultarray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $temparray = array(
                'product_name' => $row['wasteproduct_name'],
                'product_description' => $row['wasteproduct_description'],
                'product_price' => $row['wasteproduct_price'],
                'product_category' => $row['wasteproduct_category'],
                'product_image' => $row['wasteproduct_image'],
                'id' => $row['id'],
                'seller_id' => $row['seller_id'],
                'seller_name' => $row['seller_name'],
            );
            $resultarray[] = $temparray;
        }
        header("Content-Type: application/json");
        echo json_encode($resultarray);
        exit();
    } else {
        header("Content-Type: application/json");
        echo json_encode([
            'error' => true,
            'errormessage' => 'No approved Product',
        ]);
        exit();
    }
    mysqli_close($conn);
}

function displaycategoryproducts()
{
    global $conn;
    $query = "SELECT wasteproducts.*, sellers.full_name AS seller_name FROM wasteproducts INNER JOIN sellers ON wasteproducts.seller_id = sellers.id WHERE wasteproducts.approved = 1 ORDER BY wasteproducts.wasteproduct_category";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $resultarray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $productcategory = $row['wasteproduct_category'];
            if (!isset($resultarray[$productcategory])) {
                $resultarray[$productcategory] = array();
            }

            $temparray = array(
                'product_name' => $row['wasteproduct_name'],
                'product_description' => $row['wasteproduct_description'],
                'product_price' => $row['wasteproduct_price'],
                'product_category' => $row['wasteproduct_category'],
                'product_image' => $row['wasteproduct_image'],
                'id' => $row['id'],
                'seller_id' => $row['seller_id'],
                'seller_name' => $row['seller_name'],
            );
            $resultarray[$productcategory][] = $temparray;
        }
        header("Content-Type: application/json");
        echo json_encode($resultarray);
        exit();
    } else {
        header("Content-Type: application/json");
        echo json_encode([
            'error' => true,
            'errormessage' => 'No approved Product',
        ]);
        exit();
    }
}

function displaysellernameproducts()
{
    global $conn;
    $query = "SELECT wasteproducts.*, sellers.full_name AS seller_name FROM wasteproducts INNER JOIN sellers ON wasteproducts.seller_id = sellers.id WHERE wasteproducts.approved = 1 ORDER BY seller_name";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $resultarray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $sellername = $row['seller_name'];
            if (!isset($resultarray[$sellername])) {
                $resultarray[$sellername] = array();
            }
            $temparray = array(
                'product_name' => $row['wasteproduct_name'],
                'product_description' => $row['wasteproduct_description'],
                'product_price' => $row['wasteproduct_price'],
                'product_category' => $row['wasteproduct_category'],
                'product_image' => $row['wasteproduct_image'],
                'id' => $row['id'],
                'seller_id' => $row['seller_id'],
                'seller_name' => $row['seller_name'],
            );
            $resultarray[$sellername][] = $temparray;
        }
        header("Content-Type: application/json");
        echo json_encode($resultarray);
        exit();
    } else {
        header("Content-Type: application/json");
        echo json_encode([
            'error' => true,
            'errormessage' => 'No approved Product',
        ]);
        exit();
    }
}
