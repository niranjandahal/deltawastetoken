<?php
include '../cors.php';
include '../dbconnection.php';
session_name('validuser');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = mysqli_escape_string($conn, $_POST['message']);
    if (isset($_SESSION['userloggedin']) && $_SESSION['userloggedin'] === 'true') {
        $loggedinuseremail = $_SESSION['user_email'];
        $loggedinusername = $_SESSION['user_name'];
        usermessage($loggedinusername, $loggedinuseremail, $message);
    } else {
        echo "You are not logged in. Please <a href='../users/index.php'>click here</a> to log in.";
        exit;
    }
} else {
}

function usermessage($username, $useremail, $usercustommessage)
{
    $url = 'https://api.elasticemail.com/v2/email/send';
    try {
        $post = array(
            'from' => 'haminepali2093@gmail.com',
            'fromName' => 'wastecommerce App Query',
            'apikey' => '422B8B8FAD61023D1A5C5A01831C0652498E1B14628FEC4090308559D74A25D76A1EDD732FBB1EFDC8AD8D7D788FA18F',
            'subject' => 'User Customer Support',
            'to' => "niranjandahal76@gmail.com",
            'bodyHtml' => "<h3> This message is from $username registered with email $useremail . The problem of this user is : </h3> <h2>  $usercustommessage </h2>",
            'bodyText' => 'from the team ecommerce',
            'isTransactional' => false
        );
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false
        ));

        $result = curl_exec($ch);

        curl_close($ch);

        echo "<script>alert('your message was sent sucessfully sent.')</script>";
        echo "<script>window.location.href='../index.html'</script>";
        
        exit();
    } catch (Exception $ex) {

        echo $ex->getMessage();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Care</title>
    <link href="../dist/output.css" rel="stylesheet" />
</head>

<body>
    <section class="bg-white dark:bg-gray-900">
        <div class="container flex items-center justify-center min-h-screen px-6 mx-auto">
            <form action="customersupport.php" method="POST" class="w-full max-w-md">
                <img class="w-auto h-7 sm:h-8" src="../logo.jpg" alt="">

                <h1 class="mt-3 text-2xl font-semibold text-gray-800 capitalize sm:text-3xl dark:text-white">Leave A Message</h1>

                <div class="relative flex items-center mt-8">

                    <textarea class="block  mt-2 w-full  rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" rows="10" name="message" required></textarea>
                </div>

                <div class="mt-6">
                    <button class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>