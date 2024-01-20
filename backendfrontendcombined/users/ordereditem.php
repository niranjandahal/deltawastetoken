<?php
include '../cors.php';
include '../dbconnection.php';
session_name('validuser');
session_start();

$orderitemlength = 0;
$approveditemlength = 0;

if (isset($_SESSION['userloggedin']) && $_SESSION['userloggedin'] === 'true') {
    $user_id = $_SESSION['user_id'];
    if ($user_id != null) {
        $sql = "SELECT ordereditem FROM organizations WHERE id = $user_id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $ordereditem = $row['ordereditem'];
        $ordereditemarray = explode(',', $ordereditem);
        $orderitemlength = count($ordereditemarray);


        $sql1 =  "SELECT approveditem FROM organizations WHERE id = $user_id";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $approveditem = $row1['approveditem'];
        $approveditemarray = explode(',', $approveditem);
        $approveditemlength = count($approveditemarray);
    }
} else {
    echo "<script>alert('You are not logged in. Please log in to buy products.')</script>";
    echo "<script>window.location.href='../index.html'</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            /* Light background color */
            color: black;
            /* Dark text color on light background */
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #f5f5f5;
            /* Lighter header background color */
            color: black;
            padding: 20px;
            text-align: center;
        }

        section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            justify-content: space-around;
            margin: 20px;
        }

        .tittle {
            text-align: center;
            margin: 20px 0;
        }

        .product-card {
            border: 1px solid #ccc;
            /* Lighter border color */
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Lighter box shadow */
            padding: 15px;
            text-align: center;
            background-color: #fff;
            /* Lighter product card background color */
            transition: transform 0.3s ease-in-out;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        h2,
        p {
            margin: 0;
            color: #333;
            /* Darker text color on light background */
        }

        .viewproduct {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        .confirmedordertext {
            text-align: center;
            color: #3498db;
            /* Color for emphasis */
            font-size: 20px;
            margin: 20px 0;
        }

        .connectmetamask {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            margin: 20px 0;
            display: relative;
            justify-content: center;
            align-items: center;
            width: 50%;
            margin-left: 30%;
        }
    </style>

</head>

<body>



    <header>
    </header>
    <?php

    ?>
    <button id="connect" class="connectmetamask">Connect to MetaMask</button>
    <div class="tittle">
        <h2>Pending Ordered</h2>
        <p class="confirmedordertext">Be Patience! it might take up to 12 hours for seller to confirm</p>

    </div>

    <section>
        <?php

        for ($i = 1; $i < $orderitemlength; $i++) {
            $productid = $ordereditemarray[$i];
            $sql1 = "SELECT * FROM wasteproducts WHERE id = $productid";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            $productname = $row1['wasteproduct_name'];
            $productprice = $row1['wasteproduct_price'];
            $productcategory = $row1['wasteproduct_category'];
            $productimage = $row1['wasteproduct_image'];
            $productid = $row1['id'];
            // Display the product card


            echo '<div class="product-card">';
            echo '<img src="' . $productimage . '" alt="' . $productname . '" class="product-image">';
            echo '<h2>' . $productname . '</h2>';
            echo '<p>Category: ' . $productcategory . '</p>';
            echo '<p>Price: $' . $productprice . '</p>';
            // Add more information as needed
            echo '<form method="POST" action="./productdetail.php">';
            echo '<input type="hidden" name="product_id" value=" ' . $productid . ' ">';
            echo '<br>';
            echo '<button type="submit" name="view product" class="viewproduct">View Product</button>';
            echo '</form>';
            //cancel order
            echo '<form method="POST" action="./cancelorder.php">';
            echo '<input type="hidden" name="product_id" value=" ' . $productid . ' ">';
            echo '<br>';
            echo '<button type="submit" name="cancelorder" class="viewproduct">Cancel Order</button>';
            echo '</form>';
            echo '</div>';
        }
        ?>
    </section>

    <div class="tittle">
        <h2>Confirmed order</h2>

    </div>
    <section>
        <?php

        for ($i = 1; $i < $approveditemlength; $i++) {
            $productid = $approveditemarray[$i];
            $sql1 = "SELECT * FROM wasteproducts WHERE id = $productid";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            $productname = $row1['wasteproduct_name'];
            $productprice = $row1['wasteproduct_price'];
            $productcategory = $row1['wasteproduct_category'];
            $productimage = $row1['wasteproduct_image'];
            $productid = $row1['id'];
            echo '<div class="product-card">';
            echo '<img src="' . $productimage . '" alt="' . $productname . '" class="product-image">';
            echo '<h2>' . $productname . '</h2>';
            echo '<p>Category: ' . $productcategory . '</p>';
            echo '<p>Price: $' . $productprice . '</p>';
            echo '<form method="POST" action="./productdetail.php">';
            echo '<input type="hidden" name="product_id" value=" ' . $productid . ' ">';
            echo '<br>';
            echo '<button type="submit" name="view product" class="viewproduct">View Product</button>';
            echo '</form>';
            echo '<form method="POST" action="./delivered.php">';
            echo '<input type="hidden" name="product_id" value=" ' . $productid . ' ">';
            echo '<br>';
            echo '<button  type="submit" name="delivered" class="viewproduct">Got It</button>';
            echo '</form>';
            echo '</div>';
        }
        ?>
    </section>

    <script src="../../web3/index.js" type="module"></script>

</html>