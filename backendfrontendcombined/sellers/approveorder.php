<?php

include '../cors.php';
include '../dbconnection.php';
session_name('validseller');
session_start();

if (!isset($_SESSION['ref_seller_id'])) {
    if (!isset($_SESSION['seller_name'])) {
        if (!isset($_SESSION['seller_email'])) {
            http_response_code(401);
            echo "<script>alert('You are not logged in')</script>";
            echo "<script>window.location.href='sellerslogin.php'</script>";
            exit();
        }
    }
}
$recivedsellerid = $_SESSION['ref_seller_id'];


if (isset($_POST['approveit'])) {
    echo "<script>alert('Order Approved')</script>";
    $productid = $_POST['productid'];
    $userid = $_POST['userid'];
    $sql = "SELECT * FROM wasteproducts WHERE id = $productid";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $bookedUsers = explode(',', $row['booked']);
        $bookeduserslength = count($bookedUsers);
        $newbooked = '';
        for ($i = 0; $i < $bookeduserslength; $i++) {
            if ($bookedUsers[$i] != $userid) {
                $newbooked .= $bookedUsers[$i] . ',';
            }
        }
        $newbooked = rtrim($newbooked, ',');
        $sql = "UPDATE wasteproducts SET booked = '$newbooked' WHERE id = $productid";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    $sql1 = "SELECT * FROM organizations WHERE id = $userid";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $orderedItems = explode(',', $row1['ordereditem']);
        $orderedItemsLength = count($orderedItems);
        $newOrderedItems = '';
        for ($i = 0; $i < $orderedItemsLength; $i++) {
            if ($orderedItems[$i] != $productid) {
                $newOrderedItems .= $orderedItems[$i] . ',';
            }
        }
        $newOrderedItems = rtrim($newOrderedItems, ',');
        $sql1 = "UPDATE organizations SET ordereditem = '$newOrderedItems' WHERE id = $userid";
        if ($conn->query($sql1) === TRUE) {
            header('Location: middlewarepageforsuccessorreject.php');
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    $sql2 = "SELECT * FROM organizations WHERE id = $userid";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        $row2 = $result2->fetch_assoc();
        $approvedItems = $row2['approveditem'];
        $approvedItems .= ',' . $productid;
        $sql2 = "UPDATE organizations SET approveditem = '$approvedItems' WHERE id = $userid";
        if ($conn->query($sql2) === TRUE) {
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    $sql3 = "SELECT * FROM wasteproducts WHERE id = ?";
    $stmt = $conn->prepare($sql3);
    $stmt->bind_param("i", $productid);
    $stmt->execute();
    $result3 = $stmt->get_result();

    if ($result3->num_rows > 0) {
        $row3 = $result3->fetch_assoc();
        $todeliver = $row3['todeliver'];
        $todeliver .= ',' . $userid;

        $sql_update = "UPDATE wasteproducts SET todeliver = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("si", $todeliver, $productid);

        if ($stmt_update->execute()) {
        } else {
            echo "Error updating record: " . $stmt_update->error;
        }

        $stmt_update->close();
    } else {
        echo "Product not found.";
    }

    $stmt->close();
}
if (isset($_POST['rejectit'])) {
    echo "<script>alert('Order Rejected')</script>";
    $productid = $_POST['productid'];
    $userid = $_POST['userid'];
    $sql = "SELECT * FROM wasteproducts WHERE id = $productid";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $bookedUsers = explode(',', $row['booked']);
        $bookeduserslength = count($bookedUsers);
        $newbooked = '';
        for ($i = 0; $i < $bookeduserslength; $i++) {
            if ($bookedUsers[$i] != $userid) {
                $newbooked .= $bookedUsers[$i] . ',';
            }
        }
        $newbooked = rtrim($newbooked, ',');
        $sql = "UPDATE wasteproducts SET booked = '$newbooked' WHERE id = $productid";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    $sql1 = "SELECT * FROM organizations WHERE id = $userid";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $orderedItems = explode(',', $row1['ordereditem']);
        $orderedItemsLength = count($orderedItems);
        $newOrderedItems = '';
        for ($i = 0; $i < $orderedItemsLength; $i++) {
            if ($orderedItems[$i] != $productid) {
                $newOrderedItems .= $orderedItems[$i] . ',';
            }
        }
        $newOrderedItems = rtrim($newOrderedItems, ',');
        $sql1 = "UPDATE organizations SET ordereditem = '$newOrderedItems' WHERE id = $userid";
        if ($conn->query($sql1) === TRUE) {
            header('Location: middlewarepageforsuccessorreject.php');
            // echo "<script>alert('Order Rejected')</script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <style>
        body {
            background-color: #ffffff;
            color: #333;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        p {
            color: #007bff;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .order-container {
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            margin-top: 10px;
        }

        .approve-btn,
        .reject-btn {
            background-color: #007bff;
            color: #ffffff;
            padding: 5px 10px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    $sql = "SELECT * FROM wasteproducts WHERE booked != '' AND seller_id = $recivedsellerid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loop through each product
        while ($row = $result->fetch_assoc()) {
            $productId = $row['id'];
            $productName = $row['wasteproduct_name'];
            $productImage = $row['wasteproduct_image'];
            $bookedUsers = explode(',', $row['booked']); // Split the booked user IDs
            $bookeduserslength = count($bookedUsers);

            echo "<div class='order-container'>";
            echo "<h2>$productName</h2>";
            echo "<img src='$productImage' alt='$productName'>";

            for ($i = 1; $i < $bookeduserslength; $i++) {
                $userQuery = "SELECT * FROM organizations WHERE id = $bookedUsers[$i]";
                $userResult = $conn->query($userQuery);

                if ($userResult->num_rows > 0) {
                    $userData = $userResult->fetch_assoc();
                    $username = $userData['full_name'];
                    $phoneNumber = $userData['phone_number'];
                    $address = $userData['address'];

                    echo "<p>Username: $username</p>";
                    echo "<p>Phone Number: $phoneNumber</p>";
                    echo "<p>Address: $address</p>";
                    echo "<div class='form-container'>";
                    echo "<form action='approveorder.php' method='post'>";
                    echo "<input type='hidden' name='productid' value='$productId'>";
                    echo "<input type='hidden' name='userid' value='$bookedUsers[$i]'>";
                    echo "<button type='submit' name='approveit' class='approve-btn'>Approve</button>";
                    echo "<button type='submit' name='rejectit' class='reject-btn'>Reject</button>";
                    echo "</form>";
                    echo "</div>";
                }
            }
            echo "</div>";
        }
    } else {
        
        echo "<h1>No orders yet</h1>";
    }
    ?>
</body>

</html>