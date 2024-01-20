<?php
include '../cors.php';
include '../dbconnection.php';
session_name('validuser');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productid = $_POST['product_id'];
    if (isset($_SESSION['userloggedin']) && $_SESSION['userloggedin'] === 'true') {
        $userid = $_SESSION['user_id'];
        $sql = "SELECT ordereditem FROM organizations WHERE id = $userid";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $ordereditem = $row['ordereditem'];
        $ordereditemarray = explode(',', $ordereditem);
        $orderitemlength = count($ordereditemarray);
        $flag = 0;
        $sql1 = "SELECT booked FROM wasteproducts WHERE id = $productid";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $booked = $row1['booked'];
        $bookedarray = explode(',', $booked);
        for ($i = 1; $i < $orderitemlength; $i++) {
            if ($ordereditemarray[$i] == $productid) {
                $flag = 1;
                break;
            }
        }
        $sql3 = "SELECT approveditem FROM organizations WHERE id = $userid";
        $result3 = $conn->query($sql3);
        $row3 = $result3->fetch_assoc();
        $approveditem = $row3['approveditem'];
        $approveditemarray = explode(',', $approveditem);
        $approveditemlength = count($approveditemarray);
        for ($i = 1; $i < $approveditemlength; $i++) {
            if ($approveditemarray[$i] == $productid) {
                $flag = 1;
                break;
            }
        }
        if ($flag == 0) {
            $ordereditem = $ordereditem . ',' . $productid;
            $sql = "UPDATE organizations SET ordereditem = '$ordereditem' WHERE id = $userid";
            $bookeditem = $booked . ',' . $userid;


            $sql1 = "UPDATE wasteproducts SET booked = '$bookeditem' WHERE id = $productid";
            if ($conn->query($sql) === TRUE) {
                if ($conn->query($sql1) === TRUE) {
                    echo "<script>alert('Product added to your ordered list.')</script>";
                    echo "<script>window.location.href='../index.html'</script>";
                }
            } else {
                echo "<script>alert('Error adding product to your ordered list.')</script>";
                echo "<script>window.location.href='../index.html'</script>";
            }
        } else {
            echo "<script>alert('Product already in your ordered list.')</script>";
            echo "<script>window.location.href='../index.html'</script>";
        }

    } else {
        echo "<script>alert('You are not logged in. Please log in to buy products.')</script>";
        echo "<script>window.location.href='../users/index.php'</script>";
    }
}
