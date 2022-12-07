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
include("check_attendance.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
$user_data = check_login($con);
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback</title>
    <link href="style.css" rel="stylesheet" type="text/css">

    <!-- <link href="calendar.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>
<header>
    <?php include("header.php");

    if (isset($_POST["submit"])) {
        $centre = $_POST["centre"];
        $feedback = $_POST["feedback"];
        $date = date("Y-m-d");

        $query = "INSERT INTO feedback(name, role, centre, feedback, date) VALUES ('$username','$role','$centre','$feedback','$date')";
        mysqli_query($con, $query);

        $staff = mysqli_query($con, "SELECT * FROM user WHERE role='admin'");

        foreach ($staff as $a) {

            $email = $a['email'];
            $mail = new PHPMailer(true);


            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPAuth   = true;
            $mail->Username   = 'majorprojectxampp@gmail.com';
            $mail->Password   = 'bxyjywhmfqczzgyu';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

            $mail->setFrom('majorprojectxampp@gmail.com');
            $mail->addAddress($email); //receiveing feedbacks

            $mail->isHTML(true);
            $mail->Subject = "Feedback";
            $email_template = "
                <img src='https://www.yyd.org.sg/images/logo.jpg'style='width:150px;height100px;'>
                <h3>You Have Received A Feedback From $username:</h3>
                <br> <p>$feedback</p>
               
                ";
            $mail->Body = $email_template;
            $mail->send();
        }

        echo
        "<script>
            alert('Feedback submitted!');
            document.location.href = 'feedback.php';
        </script>";
    }

    ?>
    <br><br><br><br><br><br><br><br><br><br><br>

</header>

<body>


    <div class="container">
        <h4 class="text-center">
            Hello Sir/Madam,
            <br>YYD Education Centre is still growing and we value any feedback you can provide us.
            <br>We will not disclose the information you provide us to anyone.
            <br>
            <br>You can submit your feedback in this form below.
            <br>Thank you for taking your time to provide us with insights and areas where we can improve on.
            <br>Your feedback is greatly appreciated.
        </h4>
        <br><br>

        <div class="card">
            <div class="card-header">
                Submit a Feedback
            </div>
            <div class="card-body">

                <form id="form" method="POST" enctype="multipart/form-data" class="needs-validation " style="margin:auto;" autocomplete="off">
                    <div class="mb-3">
                        <label> Name </label>

                        <input type="text" class="form-control" name="name" id="Name" disabled value="<?php echo $username ?>">

                    </div>
                    <div class="form-group">
                        <label for="image">Centre </label>
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
                        <label> Feedback </label>
                        <textarea name="feedback" id="" rows="4" class="form-control"></textarea>
                    </div>




                    <div class="col-lg-12">
                        <div class="row">
                            <button class="btn col-lg-12" type="submit" name="submit" style="font-size:15px;background-color:lightblue;">Send Feedback</button>
                            <a href="feedbackSelfView.php" class="btn  col-lg-12" type="submit" style="font-size:15px;background-color:lightgrey;">See Pasts Feedbacks</a>
                            <?php if ($role == 'admin') echo '<a href="feedbackView.php" class="btn  col-lg-12" type="submit" style="font-size:15px;"> All Feedbacks (Admin)</a>"' ?>
                        </div>

                    </div>


                </form>

            </div>

        </div>
    </div>
</body>


<style>
    #feedbackHeader {
        display: none;
    }

    .main {
        margin-left: 160px;
        /* Same as the width of the sidenav */
        font-size: 28px;
        /* Increased text to enable scrolling */
        padding: 0px 10px;
    }
</style>


</html>