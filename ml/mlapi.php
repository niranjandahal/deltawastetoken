<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wastecommerce";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Details of wasteproduct_price, supply, demand from wasteproducts table
$sql = "SELECT wasteproduct_price, supply, demand FROM wasteproducts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        //json encode the data
        echo json_encode($row);
    }
} else {
    echo "0 results";
}

$conn->close();
