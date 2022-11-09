<?php
session_start();

include("connection.php");
include("functions.php");
include("check_roster.php");
include("insert-payslip.php");
include("check_teacher.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_attendance.php");
?>

<!-- broadcast for L&D -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Broadcast</title>
    <link href="style.css" rel="stylesheet" type="text/css">

    <link href="feedback.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>


<header>

    <?php include("header.php");

    if (isset($_POST["submit"])) {
        $address = $_POST["address"];
        $centre = $_POST["centre"];
        $message_title = $_POST["message_title"];
        $message = $_POST["message"];
        date_default_timezone_set("Singapore");
        $date = date("d F Y");

        $query = "INSERT INTO broadcast(sender, recipient, centre, message_title, message, date) VALUES ('$username','$address','$centre','$message_title','$message', '$date')";
        mysqli_query($con, $query);

        echo
        "<script>
            alert('Message sent!');
            document.location.href = 'broadcast.php';
        </script>";
    }
    ?>



    <div class="sidenav">
        <h2 style="font-weight:700;">Broadcast</h2>
        <a>New message</a>
        <a href="broadcastView.php">Past messages</a>

    </div>
</header>

<body>
    <div class="container" style="margin-top: 200px;" id="messageBroadcast">
        <h2><b>Broadcast to:</b></h2>
        <form method="POST">
            <table id="table-form">
                <tr>
                    <td>Address to:</td>
                    <td><select name="address" id="Address" style="border: 1px solid lightgrey;" class="col-lg-12">
                            <option selected>Select</option>
                            <option value="teacher">Teacher</option>
                            <option value="relief teacher">Relief Teacher</option>
                            <option value="parents">Parents</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Centre: </td>
                    <td><select class="col-lg-12" name="centre" id="Centre" style="border: 1px solid lightgrey;">
                            <option selected>Select a centre</option>
                            <option value="hougang">Hougang Centre</option>
                            <option value="sengkang">Sengkang Centre</option>
                            <option value="punggol">Punggol Centre</option>
                            <option value="fernvale">Fernvale Centre</option>
                            <option value="teckghee">Teck Ghee Centre</option>
                            <option value="kolamayer">Kolam Ayer Centre</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Message title:</td>
                    <td><input type="text" name="message_title" style="border: 1px solid lightgrey;" class="col-lg-12"></td>
                </tr>
                <tr>
                    <td>Message: </td>
                    <td><textarea name="message" id="" cols="60" rows="10" style="border: 1px solid lightgrey;"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: right;">
                        <button class="btn btn-primary" type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;margin:auto;">Broadcast Message</button>
                    </td>
                </tr>
            </table>
        </form>


    </div>

</body>


<style>
    .sidenav a:nth-child(2) {
                background-color: #5ebec4;
            }
    .sidenav {
        height: 70%;
        /* width: 19%; */
        width: 300px;
        position: fixed;
        z-index: 1;
        top: 200px;
        /* left: 0; */
        overflow-x: hidden;
        padding-top: 20px;
        border: 1px black solid;
    }

    .sidenav h2 {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        color: black;
        display: block;
    }

    .sidenav td {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        color: black;
        /* display: block; */
    }

    .sidenav a {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        color: black;
        display: block;
        cursor: pointer;
    }

    .sidenav a:hover {
        background-color: #96d5d9;
        /* background-color: #5ebec4; */
        /* color: black; */
    }
</style>

<style>
    .container {

        padding-left: 100px;
        padding-right: 100px;
    }

    #table-form {
        font-size: 18px;
    }

    #table-form td {
        padding: 8px;
    }

    #table-form tr td:nth-child(odd) {
        text-align: right;
        vertical-align: top;
    }
</style>

</html>