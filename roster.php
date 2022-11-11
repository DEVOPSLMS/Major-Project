<?php
session_start();
include("check_teacher.php");
include("check_roster.php");
include("connection.php");
include("functions.php");
include('Calendar.php');
include("check_attendance.php");
include("check_recurring_roster.php");

date_default_timezone_set('Singapore');
$user_data = check_login($con);
$string = strval($_GET['name']);
$centre = str_replace("%20", " ", $string);

$date = date($_GET['dt']);
$calendar = new Calendar($date);

$q= "SELECT * FROM roster WHERE centre_name= '$centre'";

$roster = mysqli_query($con, $q);


foreach ($roster as $rosters) {
    $earlier =   strtotime(date("Y-m-d H:i:s"));
    $roster_time = $rosters['date'] . ' ' . $rosters['time'];
    $abs_diff = array();
    $difference = array();
    $all_timings = array();
    $calculated_timings = array();
    $datediff = array();
    $earlier =   strtotime(date("Y-m-d H:i:s"));
    $roster_time = $rosters['date'] . ' ' . $rosters['time'];

    $later =  strtotime(date($roster_time));
    $datenow = new DateTime(date("H:i"));
    $timings = implode('', [$rosters['timing']]);
    $all_timings = substr($timings, 0, 2);
    // $calculated_timings =$all_timings *60;
    // $datediff = $datenow - $calculated_timings;
    $now = time(); // or your date as well
    $your_date = strtotime("2022-010-04");
    $datediff = $now - $your_date;
    $time_now = (date("H:i:s"));

    $to_time = strtotime($rosters['time']);

    $from_time = strtotime($time_now);
    $time = (round($to_time - $from_time) / 60);
    $accurate = round($time, 0, PHP_ROUND_HALF_UP);
    $hours = floor($accurate / 60);
    $min = $accurate - ($hours * 60);

    $id = $rosters['id'];

    $diff = round(abs($later - $earlier)) / 86400;
    $later =  strtotime(date($roster_time));
    $description = $rosters['level'] . ' ' . $rosters['subject'] . ' ' . 'Timing' . ' ' . $rosters['timing'];
    if ($diff > 2 && $rosters['need_relief'] == 'yes' && $rosters['cancelled'] == 'no') {
        $calendar->add_event($description, 'Teacher Name:' . $rosters['teacher_name'] . '',  $rosters['date'], 1, 'green', 'Cancelled: ' . $rosters['cancelled'] . '', 'Relief Needed: ' . $rosters['need_relief'] . '<br><br><a style="color:black;font-size:15px;"class="change"href="change_teacher.php?id=' . $rosters['id'] . '">Change Teacher</a>');
    }
    if ($diff <= 2 && $diff > 1 && $rosters['need_relief'] == 'yes' && $rosters['cancelled'] == 'no') {
        $calendar->add_event($description, 'Teacher Name:' . $rosters['teacher_name'] . '', $rosters['date'], 1, 'orange',  'Cancelled: ' . $rosters['cancelled'] . '', 'Relief Needed: ' . $rosters['need_relief'] . '<br><br><a style="color:black;font-size:15px;"class="change"href="change_teacher.php?id=' . $rosters['id'] . '">Change Teacher</a>');
    }
    if ($diff <= 1 && $diff > 0 && $rosters['need_relief'] == 'yes' && $rosters['cancelled'] == 'no') {
        $calendar->add_event($description, 'Teacher Name:' . $rosters['teacher_name'] . '',  $rosters['date'], 1, 'red',  'Cancelled: ' . $rosters['cancelled'] . '', 'Relief Needed: ' . $rosters['need_relief'] . '<br><br><a style="color:black;font-size:15px;"class="change"href="change_teacher.php?id=' . $rosters['id'] . '">Change Teacher</a>');
    }
    if ($rosters['need_relief'] == 'no') {
        $calendar->add_event($description, 'Teacher Name:' . $rosters['teacher_name'] . '',  $rosters['date'], 1, 'purple', 'Cancelled: ' . $rosters['cancelled'] . '', 'Relief Needed: ' . $rosters['need_relief'] . '');
    }
    if ($rosters['cancelled'] == 'yes') {
        $calendar->add_event($description, 'Teacher Name:' . $rosters['teacher_name'] . '', $rosters['date'], 1, 'yellow',  'Cancelled: ' . $rosters['cancelled'] . '', 'Relief Needed: ' . $rosters['need_relief'] . '');
    }
}

$dt = strtotime(date($_GET['dt']));

$plus = date("Y-m-d", strtotime("+1 month", $dt)) . "\n";
$minus = date("Y-m-d", strtotime("-1 month", $dt)) . "\n";
?>
<?php
$query = "select * from user where role = 'teacher' ";
$teacher = mysqli_query($con, $query);
$query = "select * from student where centre_name = '$centre Centre' ";
$students = mysqli_query($con, $query);



?>
<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title></title>
</head>

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

        .event {


            font-size: 9px;


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
</style>
<header>
    <header class="header">

        <?php include("header.php") ?>

    </header>
    <br><br><br><br><br><br><br><br><br>

    <body>



        <div class="container-fuid">

            <div class="content home">

            <a class="btn btn-primary  " id="add" style="width:100%;" type="button" href="recurring_roster.php">Add Recurring</a>

                <a class="btn btn-primary  " id="add" style="width:100%;" type="button" href="add_roster.php?name=<?php echo $centre ?>">Add Lesson</a>
                <br>
                <?php echo "<a class='btn'href='roster.php?name=" . $centre . "&dt=" . $minus . "'>PREV MONTH</a>";
                ?>
                <?php echo "<a class='btn'style='float:right;'' href='roster.php?name=" . $centre . "&dt=" . $plus . "'>NEXT MONTH</a>";
                ?>

                <?= $calendar ?>

                <br>



            </div>
        </div>
      

    </body>

</html>