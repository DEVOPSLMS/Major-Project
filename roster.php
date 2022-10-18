<?php
session_start();
include("check_teacher.php");
include("check_roster.php");
include("connection.php");
include("functions.php");
include 'Calendar.php';
date_default_timezone_set('Singapore');
$user_data = check_login($con);
$string = strval($_GET['name']);
$centre = str_replace("-", " ", $string);

$date = date($_GET['dt']);
$calendar = new Calendar($date);
$roster = mysqli_query($con, "SELECT * FROM roster WHERE centre_name='$centre Centre' ");


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
    $accurate=round($time,0,PHP_ROUND_HALF_UP);

    $id = $rosters['id'];

    $diff = round(abs($later - $earlier)) / 86400;
    $later =  strtotime(date($roster_time));
    $description = $rosters['level'] . ' ' . $rosters['subject'] . ' ' . 'Timing' . ' ' . $rosters['timing'];
    if ($diff > 2 && $rosters['need_relief']=='yes'&&$rosters['cancelled']=='no') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'green', 'Teacher Name:' . $rosters['teacher_name'] . '', 'Cancelled: ' . $rosters['cancelled'] . '', 'Relief Needed: ' . $rosters['need_relief'] . '<br><br><a style="color:black;font-size:15px;"class=""href="change_teacher.php?id='.$rosters['id'].'">Change Teacher</a>');
    }
    if ($diff <= 2 && $diff > 1 && $rosters['need_relief']=='yes'&&$rosters['cancelled']=='no') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'orange', 'Teacher Name:' . $rosters['teacher_name'] . '', 'Cancelled: ' . $rosters['cancelled'] . '', 'Relief Needed: ' . $rosters['need_relief'] . '<br><br><a style="color:black;font-size:15px;"class=""href="change_teacher.php?id='.$rosters['id'].'">Change Teacher</a>');
    }
    if ($diff <= 1 && $diff > 0 && $rosters['need_relief']=='yes'&&$rosters['cancelled']=='no') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'red', 'Teacher Name:' . $rosters['teacher_name'] . '', 'Cancelled: ' . $rosters['cancelled'] . '', 'Relief Needed: ' . $rosters['need_relief'] . '<br><br>'.$accurate.' Minutes Till Lesson Starts<br><br><a style="color:black;font-size:15px;"class=""href="change_teacher.php?id='.$rosters['id'].'">Change Teacher</a>');
    }
    if ($rosters['need_relief']=='no') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'purple', 'Teacher Name:' . $rosters['teacher_name'] . '', 'Cancelled: ' . $rosters['cancelled'] . '', 'Relief Needed: ' . $rosters['need_relief'] . '');
    }
    if ($rosters['cancelled']=='yes') {
        $calendar->add_event($description, $rosters['centre_name'], $rosters['date'], 1, 'yellow', 'Teacher Name:' . $rosters['teacher_name'] . '', 'Cancelled: ' . $rosters['cancelled'] . '', 'Relief Needed: ' . $rosters['need_relief'] . '');
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

foreach ($students as $s) {

    $student[] = $s['student_name'];
}
if (!empty($student)) {
    $student_name = implode(',', ($student));
}


if (isset($_POST["submit"])) {

    $name = $_POST["teacher_name"];

    $subject = $_POST["subject"];
    $level = $_POST["level"];
    $timing = $_POST["timing"];
    $date = $_POST["date"];
    $room = $_POST["room"];
    $students = $_POST["students"];
    $day = $_POST["day"];
    if ($timing == '1pm - 3pm') {
        $time = '13:00:00';
    }
    if ($timing == '2pm - 4pm') {
        $time = '14:00:00';
    }
    if ($timing == '4pm - 6pm') {
        $time = '19:00:00';
    }
    if ($timing == '7pm - 8pm') {
        $time = '19:00:00';
    }
    if ($timing == '8pm - 9pm') {
        $time = '20:00:00';
    }
    if ($timing == '9pm - 10pm') {
        $time = '21:00:00';
    }
    $query = "insert into roster(centre_name,subject,level,timing,teacher_name,need_relief,room,date,day,students,time,cancelled) VALUES('$centre Centre', '$subject','$level','$timing','$name','no','$room','$date','$day','$students','$time','no')";
    mysqli_query($con, $query);

    echo
    "
        <script>
          alert('Successfully Added');
          document.location.href = 'roster.php?name=" . $centre . "';
        </script>
        ";
}

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
            width: 500px;
            margin: 0 auto;
        }

        .content h2 {
            margin: 0;
            padding: 25px 0;
            font-size: 30px;
            border-bottom: 1px solid #ebebeb;
            color: #666666;
        }
    }
</style>
<header>
    <header class="header">

        <?php include("header.php") ?>

    </header>
    <br><br><br><br><br><br><br><br><br><br><br><br>

    <body>


        <div class="modal fade bd-example-modal-lg" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog mw-100 w-50" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size:20px;">Add Centre Roster </h5>


                    </div>

                    <form method="POST" enctype="multipart/form-data" autocomplete="off">

                        <div class="modal-body" style="font-size:20px;">
                            <div class="form-group">
                                <label>Name Of Teacher </label>
                                <select class="form-control" style="height:50px;font-size:20px;" required name="teacher_name">
                                    <option selected>Choose Teacher</option>
                                    <?php foreach ($teacher as $teachers) : ?>
                                        <option value="<?php echo $teachers["username"] ?>"><?php echo $teachers["username"] ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Centre Name </label>
                                <input type="text" class="form-control" disabled style="height:50px;font-size:20px; text-transform: capitalize; " id="staticEmail" name="centre" value="<?php echo $centre ?> Centre">
                            </div>
                            <div class="form-group">
                                <label>Level* </label>
                                <select class="form-control" style="height:50px;font-size:20px;" required name="level">
                                    <option selected>Choose Level</option>

                                    <option value="P1">P1</option>
                                    <option value="P2">P2</option>
                                    <option value="P3">P3</option>
                                    <option value="P4">P4</option>
                                    <option value="P5(N)">P5(N)</option>
                                    <option value="P5(F)">P5(F)</option>
                                    <option value="P6(N)">P6(N)</option>
                                    <option value="P6(F)">P6(F)</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label> Class Subject </label>
                                <select class="form-control" style="height:50px;font-size:20px;" required name="subject">
                                    <option selected>Subject</option>

                                    <option value="Math" name="subject">Math</option>
                                    <option value="Science" name="subject">Science</option>
                                    <option value="English" name="subject">English</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label> Day Of The Week </label>

                                <select class="form-control" style="height:50px;font-size:20px;" name="day" required>
                                    <option selected>Choose Day</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label> Date </label>

                                <input type="date" class="form-control" style="height:50px;font-size:20px;  " id="staticEmail" name="date">


                            </div>

                            <div class="form-group">
                                <label> Timing Of The Class </label>

                                <select class="form-control" style="height:50px;font-size:20px;" name="timing" required>
                                    <option selected>Timing</option>
                                    <option value="1pm - 3pm" name="timing">1-3pm </option>
                                    <option value="2pm - 4pm" name="timing">2-4pm</option>
                                    <option value="4pm - 6pm" name="timing">4-6pm</option>
                                    <option value="7pm - 8pm" name="timing">7-8pm</option>
                                    <option value="8pm - 9pm" name="timing">8-9pm</option>
                                    <option value="9pm - 10pm" name="timing">9-10pm</option>

                                </select>
                            </div>





                            <div class="form-group">
                                <label> Room </label>
                                <select class="form-control" style="height:50px;font-size:20px;" name="room" required>
                                    <option selected>Class Number</option>
                                    <option value="Class 1" name="room">Class 1</option>
                                    <option value="Class 2" name="room">Class 2</option>
                                    <option value="Class 3" name="room">Class 3</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label> Students </label>


                                <textarea type="text" class="form-control" id="staticEmail" style="font-size:100%;" name="students"><?php echo ($student_name) ?></textarea>

                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Add Roster</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <div class="container-fuid">

            <div class="content home">
                <?php echo "<a class='btn'href='roster.php?name=" . $centre . "&dt=" . $minus . "'>PREV MONTH</a>";
                ?>
                <?php echo "<a class='btn'style='float:right;'' href='roster.php?name=" . $centre . "&dt=" . $plus . "'>NEXT MONTH</a>";
                ?>
                <a class="btn btn-primary " style="margin-left:400px;" type="button" href="add_roster.php?name=<?php echo $centre ?>">Add Lesson</a>
                <?= $calendar ?>
                <br>




            </div>
        </div>
    </body>

</html>