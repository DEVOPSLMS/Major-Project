<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
include('connection.php');
date_default_timezone_set('Singapore');

$date = date("Y-m-d");

$roster = mysqli_query($con, "SELECT roster.id ,roster.date,roster.teacher_name,roster.subject,roster.timing,roster.level FROM roster WHERE roster.id NOT IN ( SELECT DISTINCT attendance.classid FROM attendance )and date='$date' and cancelled='no';");





$time = date("2200:00:00");
$now = date("H:i:s");
if ($time == $now) {
    
}
foreach ($roster as $a) {
    $name = $a['teacher_name'];
    $class = $a['timing'] . ' ' . $a['level'] . ' ' . $a['subject'] . ' ' . 'Class' .'';
    $user = mysqli_query($con, "SELECT * from user where username='$name'");
    $user_details=mysqli_fetch_assoc($user);
    $email=$user_details['email'];
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
    $mail->Subject = 'Here is the subject';
    $email_template = "
<h2>Hello! This Is YYD Education Centre</h2>
<img src='https://www.yyd.org.sg/images/logo.jpg'style='width:300px;height200px;'>
<h3>You have receive this email to remind you that you have not done attendance for ".$class."</h3>

";
    $mail->Body = $email_template;
    $mail->send();
}