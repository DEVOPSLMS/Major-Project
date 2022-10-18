<?php
session_start();
include('connection.php');
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
//Load Composer's autoloader

function send_password_reset($get_email, $token)
{
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


    $mail->addAddress($get_email);     //Add a recipient


    //Attachments
    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $email_template = "
    <h2>Hello! This Is YYD Education Centre</h2>
    <img src='https://www.yyd.org.sg/images/logo.jpg'style='width:300px;height200px;'>
    <h3>You have receive this link to reset your password. Click On The Link To Reset Your Password!</h3>
    <a href='http://localhost:1234/majorproject/password-reset-page.php?token=$token&email=$get_email'>Click Here To Reset Password</a>
    ";
    $mail->Body = $email_template;
    $mail->send();
}
//Create an instance; passing `true` enables exceptions

if (isset($_POST['submit'])) {
    $email = mysqli_escape_string($con, $_POST['email']);
    $token = md5(rand());
    $check_email = "SELECT * from user where email='$email' LIMIT 1";
    $check_emaiL_run = mysqli_query($con, $check_email);
    if (mysqli_num_rows($check_emaiL_run) > 0) {
        $row = mysqli_fetch_array($check_emaiL_run);
        $get_name = $row['username'];
        $get_email = $row['email'];
        $update_token = "UPDATE user set verify_token='$token'WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($con, $update_token);
        if ($update_token_run) {
            send_password_reset($get_email, $token);
            echo ("<script>alert('Email Send To Your Account!')</script>");
        
        } else {
            echo ("<script>alert('something went wrong')</script>");
        }
    } else {
        echo ("<script>alert('no email found')</script>");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Password Reset</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style media="screen">
    *,
    *:before,
    *:after {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #080710;
    }

    .background {
        width: 430px;
        height: 520px;
        position: absolute;
        transform: translate(-50%, -50%);
        left: 50%;
        top: 50%;
    }

    .background .shape {
        height: 200px;
        width: 200px;
        position: absolute;
        border-radius: 50%;
    }

    .shape:first-child {
        background: linear-gradient(#1845ad,
                #23a2f6);
        left: -80px;
        top: -80px;
    }

    .shape:last-child {
        background: linear-gradient(to right,
                #ff512f,
                #f09819);
        right: -30px;
        bottom: -80px;
    }

    form {
        height: 400px;
        width: 400px;
        background-color: rgba(255, 255, 255, 0.13);
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
        padding: 50px 35px;
    }

    form * {
        font-family: 'Poppins', sans-serif;
        color: #ffffff;
        letter-spacing: 0.5px;
        outline: none;
        border: none;
    }

    form h3 {
        font-size: 32px;
        font-weight: 500;
        line-height: 42px;
        text-align: center;
    }

    label {
        display: block;
        margin-top: 30px;
        font-size: 16px;
        font-weight: 500;
    }

    .help {
        display: block;
        height: 50px;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.07);
        border-radius: 3px;
        padding: 0 10px;
        margin-top: 8px;
        font-size: 14px;
        font-weight: 300;
    }

    ::placeholder {
        color: #e5e5e5;
    }

    button {
        margin-top: 50px;
        width: 100%;
        background-color: #ffffff;
        color: #080710;
        padding: 15px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }

    .social {
        margin-top: 30px;
        display: flex;
    }

    .social div {
        background: red;
        width: 150px;
        border-radius: 3px;
        padding: 5px 10px 10px 5px;
        background-color: rgba(255, 255, 255, 0.27);
        color: #eaf0fb;
        text-align: center;
    }

    .social div:hover {
        background-color: rgba(255, 255, 255, 0.47);
    }

    .social .fb {
        margin-left: 25px;
    }

    .social i {
        margin-right: 4px;
    }

    .alert {
        padding: 20px;
        background-color: #f44336;
        color: white;

    }

    .alert.success {
        background-color: #04AA6D;
        text-align: center;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }

    @media (max-width: 950px) {
        form {
            width: 110%
        }
    }
</style>
<br><br><br><br><br><br><br><br>

<body>
    <div class="container">
        
            <div class="background">
                <div class="shape"></div>
                <div class="shape"></div>
            </div>
            <form method="post">
                <h3>Password Reset</h3>

                <label for="username">Email</label>
                <input class="help" type="email" placeholder="Enter email" name="email" id="username">

               

                <button type="submit"name="submit" value="Login">Send</button>

                <br><br>
                

               <div class="text-center">
               <a href="login.php"><span >Go Back To Login</span></a>
               </div> 
            </form>


    </div>

</body>

</html>