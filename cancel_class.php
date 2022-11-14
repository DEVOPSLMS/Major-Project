<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
include("connection.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql = ("UPDATE  roster SET `cancelled`='yes' WHERE id = $id ");
    $result=mysqli_query($con,$sql);
    $roster_class=mysqli_query($con,"SELECT * from roster where id=$id");
    $roster_details=mysqli_fetch_assoc($roster_class);
    $teacher_name=$roster_details['teacher_name'];
    $teacher_details=mysqli_query($con,"SELECT * from user where username='$teacher_name'");
    $teacher_email=mysqli_fetch_assoc($teacher_details);
    $email=$teacher_email['email'];
    echo$email;
    $class = $roster_details['timing'] . ' ' . $roster_details['level'] . ' ' . $roster_details['subject'] . ' '. $roster_details['date'].' ' . 'Class' .'';
    $mail = new PHPMailer(true);
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
<h3>You have receive this email to remind you $class has been cancelled </h3>

";
$mail->Body = $email_template;
$mail->send();
$student=$roster_details['students'];
$all_students= explode(",",$student);
foreach($all_students as $a){
    $student=mysqli_query($con,"SELECT * from student where student_name='$a'");
    $student_details=mysqli_fetch_assoc($student);
    $id=$student_details['parentid'];
    $parent=mysqli_query($con,"SELECT * from user where id=$id");
    $parent_details=mysqli_fetch_assoc($parent);
    $email=$parent_details['email'];
    $mail = new PHPMailer(true);
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
<h3>You have receive this email to remind you $class has been cancelled </h3>

";
$mail->Body = $email_template;
$mail->send();
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
