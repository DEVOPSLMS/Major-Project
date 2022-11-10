<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("insert-payslip.php");
include("check_attendance.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
$user_data = check_login($con);

$id = $user_data['id'];
$sql = "select * from submit_leave_teacher where teacherid = '$id' ORDER BY id desc ";
$teacher_leave = mysqli_query($con, $sql);
$results = mysqli_fetch_assoc($teacher_leave);

if (isset($_POST["submit"])) {
    $name = $user_data['username'];
    $reason = $_GET["reason"];
    $date_start = $_POST["date_start"];
    $date_end = $_POST["date_end"];
    $comments = $_POST["comments"];
    $id = $user_data['id'];
    $image = $_FILES["image"];
    $new_date_start = str_replace('/"', '-', $date_start);
    $newDate = date("Y-m-d", strtotime($new_date_start));
    $new_date_end = str_replace('/"', '-', $date_end);
    $newDate_end = date("Y-m-d", strtotime($new_date_end));
    if ($_FILES["image"]["error"] == 4) {
        echo
        "<script> alert('Image Does Not Exist'); </script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo
            "
        <script>
          alert('Invalid Image Extension');
        </script>
        ";
        } else if ($fileSize > 1000000) {
            echo
            "
        <script>
          alert('Image Size Is Too Large');
        </script>
        ";
        } else {

            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, 'submit/' . $newImageName);

            $query = "insert into submit_leave_teacher(name,teacherid,date_start,date_end,image,comments,reason) values ('$name','$id','$newDate','$newDate_end','$newImageName','$comments','$reason')";

            mysqli_query($con, $query);
            $sql = "select * from user where role='l' ";
            $ld = mysqli_query($con, $sql);


            foreach ($ld as $a) {
   
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
                $mail->Subject = 'Here is the subject';
                $email_template = "
                <h2>Hello! This Is YYD Education Centre</h2>
                <img src='https://www.yyd.org.sg/images/logo.jpg'style='width:150px;height100px;'>
                <h3>You have received this email to notify you that $name has submitted an MC as he/she is on $reason leave that will commence on $newDate and end on $newDate_end.Therefore he/she would not be avaliable during that time period!</h3>
               
                ";
                $mail->Body = $email_template;
                $mail->send();
            }
            echo
            "
        <script>
          alert('Successfully Added');
          document.location.href = 'submitleave.php';
        </script>
        ";
        }
    }
}

?>
<?php


if (empty($_POST['username'])) {
    $username_error = "Please enter a username";
}
if (empty($_POST['password'])) {
    $password_error = "Please enter a password";
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Submit Leave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<header>
    <?php include("header.php") ?>
    <style>
        body {
            font-size: 130%;
        }
    </style>
    <br><br><br><br><br><br><br><br><br><br>


    <body>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

        <div class="container-fluid">
            <?php if ($results['date_end'] >= $date) {
                echo ('<h1 class="text-center">You Already Submitted an MC that will finish on ' . $results['date_end'] . '.Please wait until after ' . $results['date_end'] . ' to submit a new MC</h1>');
            }
            if ($results['date_end'] < $date) { ?>
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            Submit Leave
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label> Name: </label>

                                <input type="text" class="form-control " disabled id="exampleFormControlInput1" name="name" value="<?php echo ($user_data['username']) ?>" required>


                            </div>

                            <script type="text/javascript">
                                $(function() {
                                    $('#reason').on('change', function() {
                                        $('#filter-posts-form').submit();

                                    });
                                });
                            </script>
                            <form method="get" id="filter-posts-form" onchange="this.form.submit()">
                                <div class="form-group ">


                                    <label for="reason">Reason Of Absence</label>
                                    <select class=" form-control " id="reason" name="reason" required>
                                        <?php if (!isset($_GET['reason'])) { ?>
                                            <option value="">Choose..</option>
                                            <option value="sick" name="room">Sick</option>
                                            <option value="vacation" name="room">Vacation</option>
                                            <option value="other" name="room">Others</option>



                                        <?php } elseif (($_GET['reason']) == 'sick') { ?>



                                            <option value="sick" name="room">Sick</option>
                                            <option value="vacation" name="room">Vacation</option>
                                            <option value="other" name="room">Others</option>

                                        <?php } elseif (($_GET['reason']) == 'vacation') { ?>

                                            <option value="vacation" name="room">Vacation</option>
                                            <option value="sick" name="room">Sick</option>

                                            <option value="other" name="room">Others</option>
                                        <?php } elseif (($_GET['reason']) == 'other') { ?>

                                            <option value="other" name="room">Others</option>
                                            <option value="sick" name="room">Sick</option>
                                            <option value="vacation" name="room">Vacation</option>



                                        <?php } ?>

                                    </select>
                                </div>
                            </form>
                            <form id="form" method="POST" enctype="multipart/form-data" class="needs-validation " style="margin:auto;" autocomplete="off">
                                <?php if (isset($_GET['reason'])) { ?>

                                    <label>Leave Date*</label>
                                    <?php if ($_GET['reason'] == 'vacation') { ?>
                                        <script>
                                            $(function() {
                                                $("#datepicker").datepicker({
                                                    minDate: 7,
                                                    maxDate: "+1M"
                                                });
                                            });
                                            $(function() {
                                                $("#datepicker2").datepicker({
                                                    minDate: 7,
                                                    maxDate: "+1M"
                                                });
                                            });
                                        </script>
                                    <?php } elseif ($_GET['reason'] == 'sick' || $_GET['reason'] == 'other') { ?>
                                        <script>
                                            $(function() {
                                                $("#datepicker").datepicker({
                                                    minDate: 0,
                                                    maxDate: "+4M"
                                                });
                                            });
                                            $(function() {
                                                $("#datepicker2").datepicker({
                                                    minDate: 0,
                                                    maxDate: "+4M"
                                                });
                                            });
                                        </script>
                                    <?php } ?>

                                    <div class="form-group row" style="margin-left:2px;">


                                        <input type="text" class="col-sm-5 form-control" name="date_start" id="datepicker" required>

                                        <input type="text" readonly class="col-sm-1 form-control-plaintext text-center" style="width:10%;" value="To" id="staticEmail">
                                        <input type="text" class="col-sm-5 form-control" name="date_end" required id="datepicker2">

                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleFormControlFile1">Attach picture of MC (if applicable)</label>
                                        <input type="file" class="form-control-file" name="image" id="image" accept=".jpg, .jpeg, .png" id="exampleFormControlFile1" requiredvalue="">
                                    </div>



                                    <div class="form-group ">
                                        <label for="exampleFormControlFile1">Comments (if any)*</label>
                                        <textarea class="form-control" name="comments" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>



                                    <div class="col-lg-12">
                                        <button class="btn text-center" type="submit" name="submit" style="font-size:15px;float:right;">Submit Leave</button>

                                    </div>
                                <?php } ?>

                            </form>
                        </div>
                    </div>
                </div>
            <?php  }

            ?>

        </div>






    </body>


</html>