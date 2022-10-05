<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

?>
<!DOCTYPE html>
<html>

<head>


    <title>Home Page</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<header>
    <?php include("header.php") ?>


</header>

<style>
    @media(max-width:500px) {
            .btn {
 
                /* It hides the button text
                when screen size <=768px */
                display: none;
            }
        }
</style>

<body>
Hello Sir/Madam, 
<br>YYD Education Centre is still growing and we value any feedback you can provide us. We will not disclose the information you provide us to anyone.
<br>You can submit your feedback in this form below. Thank you for taking your time to provide us with insights and areas where we can improve on. Your feedback is greatly appreciated.
</body>