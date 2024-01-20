<?php
// make a beautiful and colorful ui for seller dashboard with many features
include '../cors.php';
include '../dbconnection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .profile-name {
            margin-right: auto;
            font-weight: bold;
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
            background-color: #2980b9;
        }

        .content {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            color: #333;
            overflow-x: auto;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            white-space: nowrap;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        .product-images {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .product-images img {
            max-width: 100%;
            height: auto;
        }

        input[type="button"] {
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #3498db;
            color: #fff;
            font-size: 16px;
        }

        input[type="button"]:hover {
            background-color: #2980b9;
        }

        .confirmedordertext {
            text-align: center;
            color: #3498db;
            font-size: 20px;
            margin: 20px 0;
        }

        .secondtext {
            text-align: center;
            font-size: 20px;
            margin: 40px 0;
        }

        @media only screen and (max-width: 600px) {
            table {
                font-size: 14px;
            }

            .logo img {
                width: 30px;
                height: 30px;
                margin-right: 8px;
            }

            nav {
                flex-direction: column;
                align-items: flex-start;
            }

            nav a {
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>
    <div class="content">
        <nav>
            <div class="logo">
                <!-- <img src="your-logo.png" alt="Logo"> -->
                <span class="profile-name">
                    <?php
                    session_name('validseller');
                    session_start();

                    if (isset($_SESSION['ref_seller_id']) && isset($_SESSION['seller_name']) && isset($_SESSION['seller_email'])) {
                        echo " <a href='./sellerprofile.php'>";
                        echo  "<i class='fas fa-user'></i>";
                        echo "    ";
                        echo $_SESSION['seller_name'];
                        echo " </a>";
                    }
                    ?>
                </span>
            </div>

            <a href='./addproduct.php'>
                <i class="fas fa-plus"></i>
                <span>Add Product</span>
            </a>

            <a href='./ordertodeliver.php'>
                <i class="fas fa-truck"></i>
                <span>prepate it </span>
            </a>

            <a href='./approveorder.php'>
                <!-- <i class="fas fa-shopping-bag"></i>  notify-->
                <i class="fas fa-bell"></i>
                <span>Sell request</span>
            </a>

            <a href='./sellerssignout.php'>
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </nav>

        <table>
            <thead>
                <tr>
                    <th>Seller Name</th>
                    <th>Seller Address</th>
                    <th>Waste Products</th>
                </tr>
            </thead>
            <tbody>
                <p class="confirmedordertext"> Be patience it might take 24hrs to be approved</p>
                <h2 class="secondtext"> Overall Public Listing </h2>
                <?php
                $sql = "SELECT sellers.full_name, sellers.address, 
                        GROUP_CONCAT( wasteproducts.wasteproduct_image SEPARATOR ',') as products
                FROM sellers
                INNER JOIN wasteproducts ON sellers.id = wasteproducts.seller_id
                GROUP BY sellers.id";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["full_name"] . "</td>
                                <td>" . $row["address"] . "</td>
                                <td class='product-images'>";

                        $images = explode(',', $row["products"]);

                        foreach ($images as $image) {
                            $image = trim($image);
                            echo "<img src='$image' alt='Product Image' style='max-width: 100px; max-height: 100px; margin-right: 8px;'>";
                        }

                        echo "</td></tr>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>