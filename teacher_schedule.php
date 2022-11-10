<?php
session_start();
include("check_teacher.php");
include 'connection.php';
include 'teacher_schedule_calendar.php';
include("functions.php");
include("insert-payslip.php");
include("check_roster.php");
include("check_attendance.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
$user_data = check_login($con);
$username= $_GET['name'];
$date = date($_GET['dt']);
$calendar = new Calendar($date);
$roster = mysqli_query($con, "SELECT * FROM roster WHERE teacher_name='".$_GET['name']."'");

foreach ($roster as $rosters) {
    $description = $rosters['level'] . ' ' . $rosters['subject'] . ' ' ;
    if ($rosters['level'] == 'P1') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'green','Timing ' .$rosters['timing'].'');
    }
    if ($rosters['level'] == 'P2') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'purple','Timing ' .$rosters['timing'].'');
       
    }
    if ($rosters['level'] == 'P3') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'blue','Timing ' .$rosters['timing'].'');
    }
    if ($rosters['level'] == 'P4') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'red','Timing ' .$rosters['timing'].'');
    }
    if ($rosters['level'] == 'P5(N)') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'gold','Timing ' .$rosters['timing'].'');
    }
    if ($rosters['level'] == 'P5(F)') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'yellow','Timing ' .$rosters['timing'].'');
    }
    if ($rosters['level'] == 'P6(N)') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'grey','Timing ' .$rosters['timing'].'');
    }
    if ($rosters['level'] == 'P6(F)') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'pink','Timing ' .$rosters['timing'].'');
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
        .content {
            width: 100%;
            margin: 0 auto;
        }

        .content h2 {
            margin: 0;
            padding: 25px 0;
            font-size: 30px;
            border-bottom: 1px solid #ebebeb;
            color: #666666;
        }
        .day_num{
            padding:0 !important;
        }

    }
</style>
<br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br>

<body>
    <div class="container-fluid">

        <div class="content home">
            <?php echo "<a class='btn'href='teacher_schedule.php?name=".$_GET['name']."&dt=" . $minus . "'>PREV MONTH</a>";
            ?>
            <?php echo "<a class='btn'style='float:right;'' href='teacher_schedule.php?name=".$_GET['name']."&dt=" . $plus . "'>NEXT MONTH</a>";
            ?>
            <?= $calendar ?>
            <br>




        </div>
    </div>

</body>

</html>