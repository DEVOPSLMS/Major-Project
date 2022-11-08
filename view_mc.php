<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("insert-payslip.php");
include("check_attendance.php");
$user_data = check_login($con);
$id = intval($_GET['id']);
$query = "select * from student_leave where id = '$id'";
$result = mysqli_query($con, $query);
$mc_details = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Submit Leave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<header>


    <?php include("header.php") ?>

</header>
<style>
    body {
        font-size: 130%;
    }

    .img:hover {
        color: #424242;
        -webkit-transition: all .3s ease-in;
        -moz-transition: all .3s ease-in;
        -ms-transition: all .3s ease-in;
        -o-transition: all .3s ease-in;
        transition: all .3s ease-in;
        opacity: 1;
        transform: scale(3);
        -ms-transform: scale(3);
        /* IE 9 */
        -webkit-transform: scale(3);
        /* Safari and Chrome */

    }
</style>
<br><br><br><br><br><br><br><br><br><br>

<body>
    <div class="container-fluid">

        <div class="row">


            <div class="col-lg-12">
                <div class="card text-center">
                    <h5 class="card-header">Student Name : <?php echo $mc_details['student_name'] ?></h5>
                    <div class="card-body">
                        <img src="submit/<?php echo $mc_details['image'] ?>"class="img" style="height:150px;width;150px;" alt="">
                        <br>
                        <span style="font-weight:bold;">Hover to Enlarge!</span>
                        <br> <br>
                        <h5 class="card-title">MC Start Date: <?php echo $mc_details['date_start'] ?></h5>
                        <p class="card-text">MC End Date: <?php echo $mc_details['date_end'] ?></p>
                        <p class="card-text">Reason: <?php echo $mc_details['reason'] ?></p>
                        <p class="card-text">Comments: <?php echo $mc_details['comments'] ?></p>
                    </div>
                </div>
            </div>

        </div>


    </div>



    </div>


</body>


</html>