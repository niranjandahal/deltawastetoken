<?php
include '../cors.php';
session_name('validuser');
session_start();
include '../dbconnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = mysqli_escape_string($conn, $_POST['full_name']);
    $address = mysqli_escape_string($conn, $_POST['address']);
    $phone_number = trim(mysqli_escape_string($conn, $_POST['phone_number']));
    $email = trim(mysqli_escape_string($conn, $_POST['email']));
    $password = trim(mysqli_escape_string($conn, $_POST['password']));

    $userhashedpassword = password_hash($password, PASSWORD_DEFAULT);
    $checkquery = "SELECT * FROM organizations WHERE email = '$email'";
    $resultcheckquery = mysqli_query($conn, $checkquery);
    if (mysqli_num_rows($resultcheckquery) > 0) {
        echo "<script>alert('Email already exists')</script>";
        echo "<script>window.location.href='usersingup.php'</script>";
        exit();
    } else {
        $query = " INSERT INTO organizations(full_name,address,phone_number,email,password) VALUES ('$full_name','$address','$phone_number','$email','$userhashedpassword') ";
        if (mysqli_query($conn, $query)) {
            $_SESSION['user_name'] = $full_name;
            $_SESSION['user_email'] = $email;
            $_SESSION['userloggedin'] = 'true';
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            echo "<script>alert('You are logged in as $full_name')</script>";
            echo "<script>window.location.href='../index.html'</script>";
            exit();
        } else {
            echo "<script>alert('Error in signing up')</script>";
            echo "<script>window.location.href='usersignup.php'</script>";
            exit();
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users SignUp Page</title>
    <link href="../dist/output.css" rel="stylesheet" />
</head>

<body>
    <div class="bg-gray-200 dark:bg-gray-900">
        <div class="container flex items-center px-6 py-4 mx-auto overflow-x-auto whitespace-nowrap">
            <a href="../index.html" class="text-gray-600 dark:text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
            </a>

            <span class="mx-5 text-gray-500 dark:text-gray-300 rtl:-scale-x-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </span>

            <a href="" class="text-gray-600 dark:text-gray-200 hover:underline">
                User
            </a>

            <span class="mx-5 text-gray-500 dark:text-gray-300 rtl:-scale-x-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </span>

            <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">
                Sign up
            </a>
        </div>
    </div>

    <section class="bg-white dark:bg-gray-900">
        <div class="container flex items-center justify-center min-h-screen px-6 mx-auto">
            <form action="usersignup.php" method="post" class="w-full max-w-md">
                <div class="flex justify-center mx-auto">
                    <img class=" h-21" src="../logo.jpg" alt="">
                </div>

                <div class="flex items-center justify-center mt-6">
                    <a href="index.php" class="w-1/3 pb-4 font-medium text-center text-gray-500 capitalize border-b dark:border-gray-400 dark:text-gray-300">
                        sign in
                    </a>

                    <a href="#" class="w-1/3 pb-4 font-medium text-center text-gray-800 capitalize border-b-2 border-blue-500 dark:border-blue-400 dark:text-white">
                        sign up
                    </a>
                </div>

                <div class="relative flex items-center mt-8">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>

                    <input type="text" class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Full Name" id="full_name" name="full_name" required>
                </div>

                <div class="relative flex items-center mt-6">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>

                    <input type="email" class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Email address" name="email" id="email" required>
                </div>
                <div class="relative flex items-center mt-4">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>

                    <input type="password" class="block w-full px-10 py-3 text-gray-700 bg-white border rounded-lg dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Password" name="password" id="password" required>
                </div>
                <div class="relative flex items-center mt-4">
                    <input type="text" placeholder="Address" class="block  mt-2 w-full  rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" name="address" id="address" required />
                </div>
                <div class="relative flex items-center mt-4">
                    <input type="number" placeholder="Phone Number" class="block  mt-2 w-full  rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" name="phone_number" id="phone_number" required />
                </div>

                <div class="mt-6">
                    <button class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        Sign Up
                    </button>

                    <div class="mt-6 text-center ">
                        <a href="index.php" class="text-sm text-blue-500 hover:underline dark:text-blue-400">
                            Already have an account?
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>