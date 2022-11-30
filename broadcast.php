<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

include("connection.php");
include("functions.php");
include("check_roster.php");
include("insert-payslip.php");
include("check_teacher.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_attendance.php");
include("check_recurring_roster.php");
$user_data = check_login($con);
$username = $user_data['username'];
date_default_timezone_set("Singapore");
if ($user_data['role'] != 'manager')  {
    if ($user_data['role'] != 'l')  {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
}

   
if (isset($_POST["submit"])) {
    $address = $_POST["address"];
    $centre = $_POST["centre"];
    $message_title = $_POST["message_title"];
    $message = $_POST["message"];

    $date = date("Y-m-d");

    $query = "INSERT INTO broadcast(sender, recipient, centre, message_title, message, date) VALUES ('$username','$address','$centre','$message_title','$message', '$date')";
    mysqli_query($con, $query);
    if ($address == 'teacher') {
        $all_teacher = mysqli_query($con, "select * from user where role='teacher'");
        foreach ($all_teacher as $a) {

            $email = $a['email'];
            $mail = new PHPMailer(true);



            //Server settings
            //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP server (server name)
            $mail->Port = 465;          //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'majorprojectxampp@gmail.com';                     //SMTP username
            $mail->Password   = 'bxyjywhmfqczzgyu';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('majorprojectxampp@gmail.com');


            $mail->addAddress($email);     //Add a recipient


            //Attachments
            //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $message_title;
            $email_template = "
            <h2>Hello! This Is YYD Education Centre</h2>
            <img src='https://www.yyd.org.sg/images/logo.jpg'style='width:150px;height100px;'>
            <h3>You Have Received This Email From $username to notify you about $message</h3>
           
            ";
            $mail->Body = $email_template;
            $mail->send();
        }
    } elseif ($address == 'relief teacher') {
        $all_parent = mysqli_query($con, "select * from user where role='parent'");
        foreach ($all_parent as $a) {

            $email = $a['email'];
            $mail = new PHPMailer(true);



            //Server settings
            //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP server (server name)
            $mail->Port = 465;          //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'majorprojectxampp@gmail.com';                     //SMTP username
            $mail->Password   = 'bxyjywhmfqczzgyu';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('majorprojectxampp@gmail.com');


            $mail->addAddress($email);     //Add a recipient


            //Attachments
            //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $message_title;
            $email_template = "
            <h2>Hello! This Is YYD Education Centre</h2>
            <img src='https://www.yyd.org.sg/images/logo.jpg'style='width:150px;height100px;'>
            <h3>You Have Received This Email From $username to notify you about $message</h3>
           
            ";
            $mail->Body = $email_template;
            $mail->send();
        }
    } else {
        $all_teacher = mysqli_query($con, "select * from user where role='teacher'and relief='yes'");
        foreach ($all_teacher as $a) {

            $email = $a['email'];
            $mail = new PHPMailer(true);



            //Server settings
            //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP server (server name)
            $mail->Port = 465;          //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'majorprojectxampp@gmail.com';                     //SMTP username
            $mail->Password   = 'bxyjywhmfqczzgyu';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('majorprojectxampp@gmail.com');


            $mail->addAddress($email);     //Add a recipient


            //Attachments
            //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $message_title;
            $email_template = "
            <h2>Hello! This Is YYD Education Centre</h2>
            <img src='https://www.yyd.org.sg/images/logo.jpg'style='width:150px;height100px;'>
            <h3>You Have Received This Email From $username to notify you about $message</h3>
           
            ";
            $mail->Body = $email_template;
            $mail->send();
        }
    }
    echo
    "<script>
        alert('Message sent!');
        document.location.href = 'broadcast.php';
    </script>";
}
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
<style>
    @media (max-width: 950px) {


        .btn {
            font-size: 20%;
            padding-left:5% !important;
        }
    }
</style>

<header>

    <?php include("header.php");


    ?>





    <body style="margin-top:200px;">


        <div class="container">
            <div class="card">
                <div class="card-header">
                    Broadcast A Message
                </div>
                <div class="card-body">
                    <form id="form" method="POST" enctype="multipart/form-data" class="needs-validation " style="margin:auto;" autocomplete="off">
                        <div class="mb-3">
                            <label> To Who </label>

                            <select name="address" id="Address" class="form-control" required>
                                <option value="">Select</option>
                                <option value="teacher">Teacher</option>
                                <option value="relief teacher">Relief Teacher</option>
                                <option value="parents">Parents</option>
                            </select>


                        </div>
                        <div class="form-group">
                            <label for="image">Centre : </label>
                            <select class="form-control" name="centre" id="Centre" required>
                                <option value="">Select a centre</option>
                                <?php
                                $q = "select * from centre";
                                $all_centre = mysqli_query($con, $q);
                                foreach ($all_centre as $a) : ?>
                                    <option value="<?php echo $a['centre_name'] ?>"><?php echo $a['centre_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label> Message Title </label>
                            <input type="text" name="message_title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label> Message </label>
                            <textarea name="message" id="" rows="4" class="form-control"></textarea>
                        </div>




                        <div class="col-lg-12">
                            <div class="row">
                                <button class="btn  col-lg-12" type="submit" name="submit" style="font-size:15px;">Broadcast Message</button>
                                <a href="broadcastView.php" class="btn  col-lg-12" type="submit" style="font-size:15px;float:right;">See Pasts Broadcast</a>
                            </div>

                        </div>


                    </form>
                </div>
            </div>
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