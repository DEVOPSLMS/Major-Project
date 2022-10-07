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
<label style="margin-left:50px; font-size: 20px;" >Date:        
    <input style="margin-left:50px; font-size: 20px;"type="date" name="" value="">
</label>


</body>
</html>