<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wastecommerce";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT wasteproduct_price, supply, demand FROM wasteproducts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $resultarray = array();
    while ($row = $result->fetch_assoc()) {
        $temparray = array(
            'wasteproduct_price' => $row['wasteproduct_price'],
            'supply' => $row['supply'],
            'demand' => $row['demand'],
        );
        $resultarray[] = $temparray;
    }
    echo json_encode($resultarray);
} else {
    echo "0 results";
}

$conn->close();
