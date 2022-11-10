<?php
session_start();
include("check_teacher.php");
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_attendance.php");
include("insert-payslip.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
date_default_timezone_set('Singapore');
$user_data = check_login($con);
$username = $user_data['username'];
$id = intval($_GET['id']);

$username = $user_data['username'];
$query = "select * from roster where id = '$id'";
$result = mysqli_query($con, $query);
$lesson_details = mysqli_fetch_assoc($result);
$date = date('Y-m-d');
$classid = $lesson_details['id'];




?>
<!DOCTYPE html>
<html>

<head>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Lesson Details Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<header>
    <?php include("header.php") ?>


</header>

<br><br><br><br><br><br><br><br><br><br>

<body>
    <div class="container-fluid">
        <a href="schedule.php" class="btn btn-primary" name="hod">Back</a>
        <h1>Lesson Details</h1>
        <h1>Level/Subject: <?php echo ($lesson_details['level']) ?>/<?php echo ($lesson_details['subject']) ?></h1>
        <h1>Teacher: <?php echo ($lesson_details['teacher_name']) ?></h1>
        <h1>Timing: <?php echo ($lesson_details['timing']) ?></h1>
        <h1>Status: <?php if ($lesson_details['need_relief'] == 'no') {
                        echo ('<i class="fa fa-circle" style="font-size:25px;margin-left:15px;color:#00FF6F;"></i>');
                    } else {
                        echo ('<i class="fa fa-circle" style="font-size:25px;margin-left:15px;color:red;"></i>');
                        
                    } ?></h1>
        <?php 
        $query2 = "select * from attendance where classid='$classid'";
        $result2 = mysqli_query($con, $query2);
        $num = mysqli_num_rows($result2);

        if ($lesson_details['date'] == $date && $lesson_details['need_relief'] == 'no' && $num == 0) {
            echo ('<a href="attendance.php?id=' . $lesson_details['id'] . '"class="btn "  name="hod" >Mark Attendance</a>  ');
        
        }
        
        if ($num > 0) {
            echo ('<h3 style="font-weight:bold;">Attendance Taken!</h3>');
        }

        ?>
    </div>


</body>

</html>