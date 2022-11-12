<?php
session_start();
include("check_teacher.php");
include 'connection.php';
include 'schedule_student_calendar.php';
include("functions.php");
include("check_roster.php");
include("insert-payslip.php");
include("check_attendance.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
$name=$_GET['name'];

$user_data = check_login($con);
$username = $user_data['username'];
$date = date($_GET['dt']);
$calendar = new Calendar($date);
$roster = mysqli_query($con, "SELECT * FROM roster ");
if ($user_data['role'] != 'parent') {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

foreach ($roster as $rosters) {
    $students=$rosters['students'];
    $student_names=explode(",",$students);
    if(in_array($name,$student_names)){
        $description = $rosters['level'] . ' ' . $rosters['subject'] . '';
    if ($rosters['subject'] == 'Math') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'green','Timing ' .$rosters['timing'].'');
    }
    if ($rosters['subject'] == 'Science') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'purple', 'Timing ' .$rosters['timing'].'');
       
    }
    if ($rosters['subject'] == 'English') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'blue', 'Timing ' .$rosters['timing'].'');
    }
   
    }
}

?>
<?php

$dt = strtotime(date($_GET['dt']));

$plus = date("Y-m-d", strtotime("+1 month", $dt)) . "\n";
$minus = date("Y-m-d", strtotime("-1 month", $dt)) . "\n";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Event Calendar</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="calendar.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<header>
    <?php include('header.php') ?>
</header>
<style>
    * {
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
        font-size: 16px;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    body {
        background-color: #FFFFFF;
        margin: 0;
    }

    .date {
        font-size: 30px;
        font-weight: bold;
    }

    .content {
        width: 1400px;
        margin: 0 auto;
    }

    .content h2 {
        margin: 0;
        padding: 25px 0;
        font-size: 22px;
        border-bottom: 1px solid #ebebeb;
        color: #666666;
    }

    @media (max-width: 900px) {
        @media (max-width: 950px) {
        .content {
            width: 150%;
            margin: 0 auto;
        }

        .event {

            width:100%;
            font-size: 20px;


        }

        .day_num {
            padding: 0 !important;
        }

        .content #add {
            text-align: center !important;
        }

        .content h2 {
            margin: 0;
            padding: 25px 0;
            font-size: 30px;
            border-bottom: 1px solid #ebebeb;
            color: #666666;
        }

        .change {
            font-size: 9px !important;
        }
    }
    }
</style>
<br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br>

<body>
    <div class="container-fluid">

        <div class="content home">
            <?php echo "<a class='btn'href='schedule_student.php?dt=" . $minus . "&name=".$name."'>PREV MONTH</a>";
            ?>
            <?php echo "<a class='btn'style='float:right;'' href='schedule_student.php?dt=" . $plus . "&name=".$name."'>NEXT MONTH</a>";
            ?>
            <?= $calendar ?>
            <br>




        </div>
    </div>

</body>

</html>