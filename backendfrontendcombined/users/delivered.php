<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <button id="connect" style="visibility: hidden;">Connect</button>
    <button id="mint" style="visibility: hidden;">mint</button>
    <button id="burn" style="visibility: hidden;">burn</button>
    <script>
        window.onload = function() {
            document.getElementById('mint').click();
        }
    </script>
    <script src="../../web3/index.js" type="module"></script>

</body>

</html>

<?php
include '../cors.php';
include '../dbconnection.php';
session_name('validuser');
session_start();
if (isset($_SESSION['userloggedin']) && $_SESSION['userloggedin'] === 'true') {
    $user_id = $_SESSION['user_id'];
    if ($user_id != null) {
        if (isset($_POST['delivered'])) {
            $productid = $_POST['product_id'];

            $sql = "SELECT * FROM organizations WHERE id = $user_id";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $approvedItems = explode(',', $row['approveditem']);
                $approvedItemsLength = count($approvedItems);
                $newApprovedItems = '';
                for ($i = 0; $i < $approvedItemsLength; $i++) {
                    if ($approvedItems[$i] != $productid) {
                        $newApprovedItems .= $approvedItems[$i] . ',';
                    }
                }
                $newApprovedItems = rtrim($newApprovedItems, ',');
                $sql = "UPDATE organizations SET approveditem = '$newApprovedItems' WHERE id = $user_id";
                if ($conn->query($sql) === TRUE) {
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
            $sql1 = "SELECT * FROM wasteproducts WHERE id = $productid";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                $row1 = $result1->fetch_assoc();
                $todeliver = explode(',', $row1['todeliver']);
                $todeliverlength = count($todeliver);
                $newtodeliver = '';
                for ($i = 0; $i < $todeliverlength; $i++) {
                    if ($todeliver[$i] != $user_id) {
                        $newtodeliver .= $todeliver[$i] . ',';
                    }
                }
                $newtodeliver = rtrim($newtodeliver, ',');
                $sql1 = "UPDATE wasteproducts SET todeliver = '$newtodeliver' WHERE id = $productid";
                if ($conn->query($sql1) === TRUE) {
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }

            $sql2 = "SELECT * FROM wasteproducts WHERE id = $productid";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                $row2 = $result2->fetch_assoc();
                $sellerid = $row2['seller_id'];
                $wasteproductcreditscore = $row2['wasteproduct_price'];
                $sql3 = "SELECT * FROM sellers WHERE id = $sellerid";
                $result3 = $conn->query($sql3);
                if ($result3->num_rows > 0) {
                    $row3 = $result3->fetch_assoc();
                    $creditscore = $row3['creditscore'];
                    $creditscore = $wasteproductcreditscore + $creditscore;
                    $sql4 = "UPDATE sellers SET creditscore = $creditscore WHERE id = $sellerid";
                    if ($conn->query($sql4) === TRUE) {
                        echo "<script>alert('Token mint started')</script>";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            }
        }
    }
} else {
    echo "<script>alert('You are not logged in. Please log in to buy products.')</script>";
    echo "<script>window.location.href='../index.html'</script>";
}
?>