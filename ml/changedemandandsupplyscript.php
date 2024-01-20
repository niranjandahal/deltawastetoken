<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wastecommerce";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//details of wasteproduct_price,supply,demand from wasteproducts table
$sql = "SELECT * FROM wasteproducts";
//put some random value between 50 to 200 in supply and demand and update the table
$sql1 = "UPDATE wasteproducts SET supply = FLOOR(RAND()*(200-50+1)+50), demand = FLOOR(RAND()*(200-50+1)+50)";
$result = $conn->query($sql);
$result1 = $conn->query($sql1);

if ($result->num_rows > 0) {
    //output data of each row
    while ($row = $result->fetch_assoc()) {
        //json encode the data
        echo json_encode($row);
    }
} else {
    echo "0 results";
}
