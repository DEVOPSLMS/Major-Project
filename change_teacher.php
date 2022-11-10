<?php
session_start();
include("check_teacher.php");
include("check_roster.php");
include("connection.php");
include("functions.php");
include("insert-payslip.php");
include("check_attendance.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
$user_data = check_login($con);
$id = $_GET['id'];
$roster = mysqli_query($con, "SELECT * FROM roster WHERE id='$id' ");

$roster_details = mysqli_fetch_assoc($roster);
$teacher = mysqli_query($con, "SELECT * FROM user WHERE role='teacher'and relief='yes' ");
$date = $roster_details['date'];
$centre = $roster_details['centre_name'];
$day = $roster_details['day'];
$teacher_name = $roster_details['teacher_name'];
if ($day == 'Monday' || $day == 'Tuesday' || $day == 'Wednesday' || $day == 'Thursday' || $day == 'Friday') {
    $add_day = 'Weekdays';
}
if ($day == 'Saturday' || $day == 'Sunday') {
    $add_day = 'Weekend';
}
if (isset($_POST['submit'])) {
    $name = $_POST['teacher_name'];
    $sql = "UPDATE `roster` SET `teacher_name`='$name',`need_relief`='no'WHERE id=$id";
    mysqli_query($con, $sql);
    header("location:centreroster.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Change Teacher Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<header>


    <?php include("header.php") ?>

</header>
<br><br><br><br><br><br><br><br><br><br><br><br>

<body>

    <body>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <div class="container">
            <form action="" method="POST">
                <div class="form-group">
                    <label>Name Of Teacher </label>
                    <select class="form-control" style="height:50px;font-size:20px;" required name="teacher_name">
                        <option selected>Choose Teacher</option>
                        <?php foreach ($teacher as $t) {
                            $teachList = explode(", ", $t['teach']);
                            $preferredList = explode(", ", $t['preferred']);

                            if (in_array($centre, $preferredList)) {
                                if (in_array($day, $teachList) || in_array($add_day, $teachList)) {

                                    $name = $t['username'];
                                    if ($name !== $teacher_name) {
                                        echo ('<option value="' . $name . '">' . $name . '</option>');
                                    }
                                }
                            }
                        } ?>
                    </select>
                </div>
                <button type="submit" class="btn" name="submit">Submit</button>
            </form>
        </div>
    </body>

</html>