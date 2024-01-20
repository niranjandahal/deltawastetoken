<?php
include '../cors.php';
include '../dbconnection.php';
session_name('validseller');
session_start();

if (!isset($_SESSION['ref_seller_id']) || !isset($_SESSION['seller_name']) || !isset($_SESSION['seller_email'])) {
    http_response_code(401);
    echo "<script>alert('You are not logged in')</script>";
    echo "<script>window.location.href='sellerslogin.php'</script>";
    exit();
}

$receivedSellerId = $_SESSION['ref_seller_id'];
// echo $receivedSellerId;

$query = "SELECT * FROM sellers WHERE id = $receivedSellerId";
$result = mysqli_query($conn, $query);


if (mysqli_num_rows($result) > 0) {
    $seller = mysqli_fetch_assoc($result);
} else {
    $seller = false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['use_credit'])) {
    $selectedScore = $_POST['selected_score'];

    $newCreditScore = $seller['creditscore'] - $selectedScore;
    $updateQuery = "UPDATE sellers SET creditscore = $newCreditScore WHERE id = $receivedSellerId";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo "<script>alert('Credit used successfully!');</script>";
        echo "<script>window.location.href='creditmiddleware.php'</script>";
    } else {
        echo "<script>alert('Error updating credit score');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perks Redemption</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans h-screen">

    <!-- simple seller details -->

    <div class="container mx-auto h-full flex justify-center items-center">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">your info</h2>
            <p class="text-gray-600 mb-6"> Name: <?php echo $seller['full_name']; ?></p>
            <p class="text-gray-600 mb-6"> Email: <?php echo $seller['email']; ?></p>
            <p class="text-gray-600 mb-6">Credit Score: <?php echo $seller['creditscore']; ?></p>
        </div>

        <div class="container mx-auto h-full flex flex-col justify-center items-center">
            <h1 class="text-3xl font-bold mb-4">Credit Redemption</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">NEA Electricity</h2>
                    <p class="text-gray-600 mb-6">Exchange credits with electricity.</p>
                    <button class="bg-blue-500 text-white py-2 px-4 rounded-full">
                        <a href="burncredit.php">Exchange</a>
                    </button>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">EV car</h2>
                    <p class="text-gray-600 mb-6">Use credits to exchange with electric cars. </p>
                    <button class="bg-blue-500 text-white py-2 px-4 rounded-full">

                        <a href="burncredit.php">Exchange</a>

                    </button>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">Buy Solar Panel</h2>
                    <p class="text-gray-600 mb-6">Use credits in exchange of solar panels</p>
                    <button class="bg-blue-500 text-white py-2 px-4 rounded-full">
                        <a href="burncredit.php">Exchange</a>
                    </button>
                </div>


            </div>
        </div>
</body>

</html>