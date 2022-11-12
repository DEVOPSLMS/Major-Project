<?php
session_start();
include("check_roster.php");
include("check_teacher.php");
include("connection.php");
include("functions.php");
include("insert-payslip.php");
include("check_withdrawl.php");
include("check_attendance.php");
include("check_recurring_roster.php");
include("add_level.php");
$user_data = check_login($con);
$string = strval($_GET['name']);
$centre = str_replace("-", " ", $string);

if ($user_data['role'] != 'l') {
    header('HTTP/1.0 403 Forbidden');
    exit;
}
if (isset($_POST["add"])) {

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
        $end='15:00:00';
    }
    if ($timing == '2pm - 4pm') {
        $time = '14:00:00';
        $end='16:00:00';
    }
    if ($timing == '4pm - 6pm') {
        $time = '16:00:00';
        $end='18:00:00';
    }
    if ($timing == '7pm - 8pm') {
        $time = '19:00:00';
        $end='20:00:00';
    }
    if ($timing == '8pm - 9pm') {
        $time = '20:00:00';
        $end='21:00:00';
    }
    if ($timing == '9pm - 10pm') {
        $time = '21:00:00';
        $end='22:00:00';
    }
    $checked = "select * from roster where timing='$timing'and date='$date'and teacher_name='$name'";
    $check = mysqli_query($con, $checked);

    if(mysqli_num_rows($check) == 0){
        $query = "insert into roster(centre_name,subject,level,timing,teacher_name,need_relief,room,date,day,students,time,end,cancelled,attendance_taken) VALUES('$centre', '$subject','$level','$timing','$name','no','$room','$date','$day','$students','$time','$end','no','no')";
        mysqli_query($con, $query);
        $date=date("Y-m-d");
        echo
        "
            <script>
              alert('Successfully Added');
              document.location.href = 'roster.php?name=" . $centre . "&dt=".$date."';
            </script>
            ";
    }
    else{
        echo
        "
            <script>
              alert('A Lesson Is Already Present');
              
            </script>
            ";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<br><br><br><br><br><br><br><br><br><br><br>

<header>
    <?php include('header.php') ?>
</header>
<script>
function goBack() {
    var a = document.getElementById("form1");
  var x = document.getElementById("form2");
  
    x.style.display = "none";
  
    a.style.display = "block";
  
}
</script>
<body>





    <div class="container">
        <?php if (!isset($_POST['submit'])|| isset($_POST['back'])) { ?>
            <form method="POST" id="form1">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail4" style="font-size:20px;">Primary Level</label>
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
                    <div class="form-group col-md-12">
                        <label for="inputPassword4" style="font-size:20px;">Date</label>
                        <input type="date" class="form-control" name="date"style="height:50px;font-size:20px;" id="inputPassword4" style="height:50px;">
                    </div>

                </div>

                <button type="submit" name="submit" class="btn btn-primary" id="btn1">Submit</button>
            </form>
        <?php } ?>
        <?php if (isset($_POST['submit'])) { ?>
            <?php 
            $date = $_POST['date'];
            $level = $_POST['level'];
            
                ?>
                
            <form action="" method="POST" id="form2">
                
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Name Of Teacher </label>
                        <input type="hidden"value="<?php echo $level?>"name="level">
                                <input type="hidden"value="<?php echo $date?>"name="date">
                        <select class="form-control" style="height:50px;font-size:20px;" required name="teacher_name">
                            <option value="">Choose Teacher</option>
                            <?php
                            if (isset($_POST['submit'])) {

                                $date = $_POST['date'];
                                $level = $_POST['level'];
                                $day = date('l', strtotime($date));
                               
                                if ($day == 'Monday' || $day == 'Tuesday' || $day == 'Wednesday' || $day == 'Thursday' || $day == 'Friday') {
                                    $add_day = 'Weekdays';
                                }
                                if ($day == 'Saturday' || $day == 'Sunday') {
                                    $add_day = 'Weekend';
                                }
                                $teachers = mysqli_query($con, "SELECT * FROM user WHERE role='teacher' ");
                                foreach ($teachers as $t) {

                                    $teachList = explode(", ", $t['teach']);
                                    $preferredList = explode(", ", $t['preferred']);
                                    
                                    if (in_array("$centre", $preferredList)) {
                                        if (in_array($day, $teachList) || in_array($add_day, $teachList)) {
                                            $name = $t['username'];
                                            echo ('<option value="' . $name . '">' . $name . '</option>');
                                        }
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label> Class Subject </label>
                        <select class="form-control" style="height:50px;font-size:20px;" required name="subject">
                            <option value="">Subject</option>

                            <option value="Math" name="subject">Math</option>
                            <option value="Science" name="subject">Science</option>
                            <option value="English" name="subject">English</option>

                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label> Day Of The Week </label>

                        <select class="form-control" style="height:50px;font-size:20px;" name="day" required>
                            
                            <option value="<?php echo $day?>"><?php echo $day?></option>
                            

                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label> Room </label>
                        <select class="form-control" style="height:50px;font-size:20px;" name="room" required>
                            <option value="">Class Number</option>
                            <option value="Class 1" name="room">Class 1</option>
                            <option value="Class 2" name="room">Class 2</option>
                            <option value="Class 3" name="room">Class 3</option>

                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label> Timing Of The Class </label>

                        <select class="form-control" style="height:50px;font-size:20px;" name="timing" required>
                            <option value="">Timing</option>
                            <?php if($day == 'Monday' || $day == 'Tuesday' || $day == 'Wednesday' || $day == 'Thursday' || $day == 'Friday'){
                           echo('
                           <option value="7pm - 8pm" name="timing">7-8pm</option>
                           <option value="8pm - 9pm" name="timing">8-9pm</option>
                           <option value="9pm - 10pm" name="timing">9-10pm</option>'); 
                            }
                            else{
                                echo('<option value="1pm - 3pm" name="timing">1-3pm </option>
                                <option value="2pm - 4pm" name="timing">2-4pm</option>
                                <option value="4pm - 6pm" name="timing">4-6pm</option>
                                <option value="7pm - 8pm" name="timing">7-8pm</option>
                                <option value="8pm - 9pm" name="timing">8-9pm</option>
                                <option value="9pm - 10pm" name="timing">9-10pm</option>'); 
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">

                        <label> Students </label>


                        <textarea type="text" style="text-transform: lowercase;"class="form-control" id="staticEmail" style="font-size:100%;" name="students"><?php if (isset($_POST['submit'])) { $date = $_POST['date']; $level = $_POST['level']; $day = date('l', strtotime($date));$query = "select * from student where centre_name = '$centre'and student_level='$level'and status='Enrolled' "; $students = mysqli_query($con, $query);foreach ($students as $s) { $st[] = $s['student_name'];}if (!empty($st)) {$student_name = implode(',', ($st));echo$student_name;}else{echo('No Student For This Level And Centre.');}} ?></textarea>
                    </div>
                </div>
                <?php if (isset($_POST['submit'])) { $date = $_POST['date']; $level = $_POST['level']; $day = date('l', strtotime($date));$query = "select * from student where centre_name = '$centre'and student_level='$level'and status='Enrolled' "; $students = mysqli_query($con, $query);foreach ($students as $s) { $st[] = $s['student_name'];}
                if (!empty($st)&&!empty($teachers)) 
                {
                    echo('<button type="submit" name="add" class="btn btn-primary">Submit</button>');
                }
                
                    } ?>
                     
                   
            </form>
            <?php
                if (empty($st)||empty($teachers)) 
                {
                    echo('<form method="POST"><button type="submit" name="back" style="width:100%;font-size:15px;"class="btn">Go Back</button></form>');
                }
                ?>   
        <?php } ?>
    </div>
</body>

</html>