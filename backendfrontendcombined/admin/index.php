<?php
include "../cors.php";
session_name('validadmin');
session_start();
include '../dbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['adminname']) && isset($_SESSION['adminpassword'])) {
    header("location: adminpanel.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminname = mysqli_escape_string($conn, $_POST['name']);
    $adminpassword = mysqli_escape_string($conn, $_POST['password']);

    if ($adminname != "admin" || $adminpassword != "admin") {
        echo "<script>alert('Invalid Credentials')</script>";
        echo "<script>window.location.href='index.php'</script>";
        exit();
    }
    $_SESSION['adminname'] = $adminname;
    $_SESSION['adminpassword'] = $adminpassword;
    header("location: adminpanel.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="../dist/output.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .logo {
            display: block;
            margin: 0 auto;
            width: 100px;
            height: auto;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            border-color: #63b3ed;
        }

        .form-button {
            width: 100%;
            padding: 1rem;
            color: #fff;
            background-color: #3490dc;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-button:hover {
            background-color: #2779bd;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="index.php" method="POST">
            <img class="logo" src="../logo.jpg" alt="Logo">
            <div class="form-header">
                <h1 class="text-2xl font-semibold text-gray-800">Admin Login</h1>
            </div>

            <div class="form-group">
                <input type="text" class="form-input" placeholder="Email address" name="name" id="name" required>
            </div>

            <div class="form-group">
                <input type="password" class="form-input" placeholder="Password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <button class="form-button" type="submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>