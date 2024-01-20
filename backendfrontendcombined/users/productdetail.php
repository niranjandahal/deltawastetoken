<?php
include '../cors.php';
include '../dbconnection.php';

$productdetails = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productid = $_POST['product_id'];
    $sql = "SELECT * FROM wasteproducts WHERE id = $productid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql = "SELECT wasteproducts.*, sellers.full_name AS seller_name,sellers.address AS seller_address,sellers.phone_number AS seller_no,sellers.email AS seller_email FROM wasteproducts INNER JOIN sellers ON wasteproducts.seller_id = sellers.id WHERE wasteproducts.id = $productid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productdetails[] = $row;
            }
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Description</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #fff;
        }

        h1,
        p {
            margin: 0;
            color: #333;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 20px;
            background-color: #28a745;
            color: #fff;
            font-size: 18px;
            border-radius: 8px;
            display: none;
            z-index: 999;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .notification.show {
            display: block;
            opacity: 1;
        }

        .success {
            background-color: #28a745;
            color: #fff;
        }

        .error {
            background-color: #dc3545;
            color: #fff;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .btn-modal {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-modal:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        if (!empty($productdetails)) {
            echo '<img src="' . $productdetails[0]['wasteproduct_image'] . '" alt="' . $productdetails[0]['wasteproduct_name'] . '">
        <h1>' . $productdetails[0]['wasteproduct_name'] . '</h1>
        <p>' . $productdetails[0]['wasteproduct_description'] . '</p><br><br>
        <p>Credit Token: DT ' . $productdetails[0]['wasteproduct_price'] . '</p><br><br>
        <p>  Name: ' . $productdetails[0]['seller_name'] . '</p><br><br>
        <p> Target Address: ' . $productdetails[0]['seller_address'] . '</p><br><br>

        <button class="btn" onclick="buyNow(' . $productid . ')">Buy Now</button>';
        } else {
            echo '<p>No product found</p>';
        }
        ?>
        <!-- notification implementaion -->
        <div class="notification" id="cartNotification"></div>
        <!-- Buy Now modal -->
        <div class="modal" id="buyNowModal">
            <?php
            include '../cors.php';
            include '../dbconnection.php';
            session_name('validuser');
            session_start();

            if (isset($_SESSION['userloggedin']) && $_SESSION['userloggedin'] === 'true') {
                echo ' <div class="modal-content">';
                echo '<p style="color: green;">Order booked! You may receive a final confirmation through the seller; be patient.</p><br><br>';
                echo '<p style="color:black;">Seller Name: ' . $productdetails[0]['seller_name'] . '</p><br>';
                echo '<button class="btn-modal" onclick="buyproducts(' . $productid . ')">OK</button>';
                echo ' </div>';
            } else {
                echo ' <div class="modal-content">';
                echo '<p style="color: green;">You need to login first</p><br><br>';
                echo '<button class="btn-modal" onclick="window.location.href=\'../index.html\'">OK</button>';
                echo ' </div>';
            }
            ?>
        </div>
    </div>

    <script>
        function buyproducts(key) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = './buyproduct.php';

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'product_id';
            input.value = key;

            form.appendChild(input);
            document.body.appendChild(form);

            form.submit();
            return false;
        }

        function displayModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = 'flex';
        }

        function closeModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = 'none';
        }

        function displayNotification(elementId, message, className) {
            var notification = document.getElementById(elementId);
            notification.className = 'notification ' + className;
            notification.innerHTML = message;
            notification.classList.add('show');

            setTimeout(function() {
                notification.classList.remove('show');
            }, 3000);
        }

        function buyNow(productId) {
            displayModal('buyNowModal');
        }
    </script>
</body>

</html>