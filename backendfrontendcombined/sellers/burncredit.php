<?php
include '../cors.php';
include '../dbconnection.php'; // Make sure to include your database connection script
session_name('validseller');
session_start();

// Redirect if not logged in
if (!isset($_SESSION['ref_seller_id']) || !isset($_SESSION['seller_name']) || !isset($_SESSION['seller_email'])) {
    http_response_code(401);
    echo "<script>alert('You are not logged in')</script>";
    echo "<script>window.location.href='sellerslogin.php'</script>";
    exit();
}

$receivedSellerId = $_SESSION['ref_seller_id'];

// Fetch seller profile data
$query = "SELECT * FROM sellers WHERE id = $receivedSellerId";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $seller = mysqli_fetch_assoc($result);
} else {
    $seller = false;
}

// Handle credit usage
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['use_credit'])) {
    $selectedScore = $_POST['selected_score'];

    // Update credit score in the database
    $newCreditScore = $seller['creditscore'] - $selectedScore;
    $updateQuery = "UPDATE sellers SET creditscore = $newCreditScore WHERE id = $receivedSellerId";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo "<script>alert('Credit used successfully!');</script>";
        echo "<script>window.location.href='creditmiddleware.php'</script>";

        // Optionally, you can redirect or perform additional actions after successful credit usage
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
    <title>Seller Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #495057;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }

        .container {
            max-width: 400px;
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-sizing: border-box;
            margin-top: 20px;
        }

        .profile-card {
            text-align: center;
        }

        h2 {
            color: #007bff;
        }

        p {
            margin: 10px 0;
            color: #343a40;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #007bff;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>



    <div class="container">

        <div class="profile-card">
            <h2><?= isset($seller) ? $seller['full_name'] : 'Manage Products to Earn Credits' ?></h2>

            <?php if ($seller) : ?>
                <p><strong>Email:</strong> <?= $seller['email'] ?></p>
                <p><strong>Phone:</strong> <?= $seller['phone_number'] ?></p>
                <p><strong>Address:</strong> <?= $seller['address'] ?></p>
                <p><strong>Credit Score:</strong> <?= $seller['creditscore'] ?></p>
                <form method="post" action="">
                    <label for="selected_score">Select Score to Use:</label>
                    <input type="number" name="selected_score" min="1" max="<?= $seller['creditscore'] ?>" required>
                    <button type="submit" name="use_credit">Use Credit</button>
                </form>
            <?php endif; ?>
        </div>

    </div>

    <script src="../../web3/index.js" type="module"></script>

</body>

</html>