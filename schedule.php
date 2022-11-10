<?php
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
$username = $user_data['username'];
date_default_timezone_set('Singapore');
?>
<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Home Page</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<header>
    <?php include("header.php") ?>


</header>
<br><br><br><br><br><br><br><br><br><br><br><br><br>


<body>
    <div class="container">
        <h1 class="text-center">Classes You Have For Today</h1>
        <br>
        <div class="card">

            <?php
            $date = date("Y-m-d");
            $query = "select * from roster where teacher_name = '$username' and date='$date'";
            $roster = mysqli_query($con, $query);
            if (mysqli_num_rows($roster) > 0) {
                foreach ($roster as $r) : ?>
                    <div class="col-lg-12">
                        <div class="card text-center">
                            <div class="card-header">
                                <?php echo $r['centre_name'] ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $r['room'] ?></h5>
                                <p class="card-text"><?php echo $r['level'] ?>, <?php echo $r['subject'] ?>, <?php echo $r['timing'] ?></p>
                                <a href="lesson_details.php?id=<?php echo $r['id'] ?>" class="btn " style="font-size:15px;">See Class Details</a>
                            </div>
                            <div class="card-footer text-muted">
                                Time: <?php $date = $r['time'];
                                        $date = strtotime($date);
                                        echo date('ga', $date); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php } else {
                echo ("<h2 class='text-center'>You Have No Classes For Today</h2");
            }
            ?>
        </div>


    </div>


</body>

</html>