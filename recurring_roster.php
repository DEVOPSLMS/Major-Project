<?php

session_start();
include("check_roster.php");
include("check_teacher.php");
include("connection.php");
include("functions.php");
include("insert-payslip.php");
include("check_attendance.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
include("check_recurring_roster.php");
$user_data = check_login($con);

if ($user_data['role'] != 'l') {
    header('HTTP/1.0 403 Forbidden');
    exit;
}
?>


<!doctype html>
<html lang="en">


<head>
    <title>Recurring Roster</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<header>
    <?php include('header.php'); ?>

</header>

<body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <br><br><br><br><br><br><br><br><br><br>
    <div class="container">

        <a href="centreroster.php">View Rosters</a>
        <a href="add_recurring.php"><button class="btn" style="font-size: 15px; width: 100%;">Add Recurring Lessons</button></a>
        <br><br>
        <div class="card">
            <div class="col-lg-12">
                <div class="row">


                    <?php
                    $queryroster = "SELECT * FROM roster";
                    $resultsroster = mysqli_query($con, $queryroster);

                    $query = "SELECT * FROM `recurring`";
                    $result = mysqli_query($con, $query);
                    $rows = mysqli_num_rows($result);

                    foreach ($result as $a) :
                        $id = $a['id'];
                        $centre = $a['centre_name'];
                        $subject = $a['subject'];
                        $level = $a['level'];
                        $timing = $a['timing'];
                        $teacher_name = $a['teacher_name'];
                        $room = $a['room'];
                        $day = $a['day'];
                        $students = $a['students'];



                    ?>

                        <div class="col-lg-3">

                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong><?php echo $centre ?> </strong> <br><?php echo $level, ' ', $subject, ' ', $teacher_name, '<br>', $day, ' ', $timing ?>
                                <br><br>
                                <a href="recurringEdit.php?id=<?php echo $id ?>">Edit</a>
                                <a href="recurring_roster_delete.php?id=<?php echo $id ?>"><button type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button></a>
                            </div>
                        </div>

                    <?php
                        
                    endforeach;
                    ?>

                </div>
            </div>

        </div>

    </div>
</body>

</html>