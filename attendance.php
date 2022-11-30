<?php
session_start();
include("check_roster.php");
include("check_teacher.php");
include("connection.php");
include("functions.php");
date_default_timezone_set('Singapore');
include("insert-payslip.php");
include("check_attendance.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
error_reporting(E_ERROR | E_PARSE);
$user_data = check_login($con);
$class_id = intval($_GET['id']);
$query = "select * from roster where id = '$class_id'";
$result = mysqli_query($con, $query);
$lesson_details = mysqli_fetch_assoc($result);
$date = date('jS M');
$students = (explode(',', $lesson_details['students']));
$class = $lesson_details['timing'] . ' ' . $lesson_details['subject'] . ' ' . 'Class' . ' ' . $date;
if ($user_data['role'] != 'teacher') {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

?>

<?php
$country = file_get_contents('http://api.hostip.info/get_html.php?ip=');


// Reformat the data returned (Keep only country and country abbr.)
$only_country = explode(" ", $country);


?>
<?php
$query = @unserialize(file_get_contents('http://ip-api.com/php/'));

$recorded = $query['zip'];
$latitude = $_COOKIE['lat'];
$longitude = $_COOKIE['lng'];
$geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $latitude . ',' . $longitude . '&sensor=false&key=AIzaSyC1sUOKVl7HdX71DpzLoXzgBv-rJaJAWpE');
$output = json_decode($geocode);
$formattedAddress = @$output->results[0]->formatted_address;

?>
<?php

if (isset($_POST["submit"])) {


    foreach (array_combine($students, $_POST['status']) as $student => $status) {
        $teacher_name = $lesson_details['teacher_name'];
        $lesson_id=$lesson_details['id'];
        $centre_name = $lesson_details['centre_name'];
        $level = $lesson_details['level'];
        $date = date('Y-m-d');
        $time= date('H:i:s');

        $query = "insert into attendance(student_name,status,date,class,teacher_name,centre_name,classid,recorded_at,time) values ('$student','$status','$date','$class','$teacher_name','$centre_name','$class_id','$formattedAddress','$time')";

        mysqli_query($con, $query);
       
        $update_roster=("UPDATE roster SET `attendance_taken`='yes' WHERE id = $lesson_id ");
  
        mysqli_query($con,$update_roster);
        if ($status == 'late') {

            $query = "select * from student where student_name = '$student' ";
            $result = mysqli_query($con, $query);
            $user_details = mysqli_fetch_assoc($result);
            $id = $user_details['id'];
            $parentid = $user_details['parentid'];
            print_r($id);
            $sql = "UPDATE `student` SET `late_counter`=`late_counter`+1 WHERE id=$id";
            mysqli_query($con, $sql);
            $query2 = "insert into notification(parentid,student_name,notification,status,seen) values ('$parentid','$student','$class','late','0')";
            mysqli_query($con, $query2);
        }
        if ($status == 'absent') {

            $query = "select * from student where student_name = '$student' ";
            $result = mysqli_query($con, $query);
            $user_details = mysqli_fetch_assoc($result);
            $id = $user_details['parentid'];

            $sql = "insert into notification(parentid,student_name,notification,status,seen) values ('$id','$student','$class','absent','0')";
            mysqli_query($con, $sql);
        }

        echo ("<script>
            alert('Successfully Added');
            document.location.href = 'lesson_details.php?id=$class_id';
          </script>");
    }
}
?>
<script>
    function getValue(data) {
        console.log(data.value)
    }
</script>
<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {

        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        var lat_details = "lat=" + lat;
        var lng_details = "lng=" + lng;
        document.cookie = lat_details;
        document.cookie = lng_details;
    }
</script>
<style>
    @media (max-width: 950px) {
          .btn{
            font-size:15px;
          }
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Attendance Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<header>
    <?php include('header.php') ?>
</header>
<br><br><br><br><br><br><br><br><br><br>

<body onload="getLocation()">
    <form method="POST">
        <br>
        <a href="lesson_details.php?id=<?php echo ($class_id) ?>" class="btn btn-primary" name="hod">Back</a>
        <br><br>
        <div class="row">
            <div class="col-lg-3 ">
                <h3>Date: <input type="date" disabled value="<?php echo (date('Y-m-d')) ?>"></h3>

            </div>
            <div class="col-lg-3 " name="teacher">

                <h3>Teacher: <?php echo ($lesson_details['teacher_name']) ?></h3>
            </div>
            <div class="col-lg-6 ">

                <h3>Level/Subject: <?php echo ($lesson_details['level']) ?>/<?php echo ($lesson_details['subject']) ?></h3>
            </div>

            <div class="col-lg-3">

                <h3>Centre: <input type="text" style="text-transform: capitalize;" disabled value="<?php echo ($lesson_details['centre_name']) ?>"></h3>
            </div>
            <div class="col-lg-8">

                <h3>Timing: <?php echo ($lesson_details['timing']) ?></h3>
            </div>
            <div class="col-lg-1">

                <button class="btn btn-primary" name="submit" type="submit" style="background-color:#F92C85;color:white;border-color:#F92C85;">Submit</button>
            </div>

        </div>

        <table class="table table-striped">
            <tr>

                <th class="success">Student Name</th>
                <th class="warning">Attendance <p class="active">

                </th>
                <th class="danger">Remarks</th>

            </tr>
            <?php foreach ($students as $student) : ?>
                <tr>
                    <td class="success" name="student_name"><?php echo ($student) ?></td>

                    <td class="active" required>
                        <?php
                        $date = date('Y-m-d');
                        $query = "select * from student_leave where student_name = '$student' ORDER BY id desc";
                        $result = mysqli_query($con, $query);
                        $student_details = mysqli_fetch_assoc($result);

                        $date = date('Y-m-d');

                        if ($student_details['date_start'] <= $date && $student_details['date_end'] >= $date) {
                            echo (' <select class="form-select" name="status[]" required>
                                        <option value="absent">Absent</option>
                                        <option value="present">Present</option>
                                        <option value="late">Late</option>
                                        
            
                                    </select>');
                        } else if ('null') {
                            echo ('<select class="form-select" name="status[]" required>
                                        
                                        <option value="present">Present</option>
                                        <option value="late">Late</option>
                                        <option value="absent">Absent</option>
            
                                    </select>');
                        }



                        ?>



                    </td>
                    <td class="success">

                        <div class="form-group ">

                            <div class="col-sm-10">
                                <?php
                                $date = date('Y-m-d');
                                $query = "select * from student_leave where student_name = '$student' ORDER BY id desc";
                                $result = mysqli_query($con, $query);
                                $student_details = mysqli_fetch_assoc($result);

                                $date = date('Y-m-d');
                                $id = $student_details['id'];
                                if ($student_details['date_start'] <= $date && $student_details['date_end'] >= $date) {
                                    echo ('<a href="view_mc.php?id=' . $id . '"><textarea type="text" class="form-control" style="width: 100%;" id="staticEmail" name="remarks">Student is sick view MC </textarea></a>');
                                } else if ('null') {
                                    echo ('<textarea type="text" class="form-control" style="width: 100%;" id="staticEmail" name="remarks"></textarea>');
                                }



                                ?>
                            </div>
                        </div>
                    </td>



                </tr>
            <?php endforeach; ?>




        </table>

    </form>

</body>
<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    $(function() {

        //button select all or cancel


        //button select invert


        //column checkbox select all or cancel
        $("input.select-all").click(function() {
            var checked = this.checked;
            $("input.select-item").each(function(index, item) {
                item.checked = checked;
            });
        });

        //check selected items
        $("input.select-item").click(function() {
            var checked = this.checked;
            console.log(checked);
            checkSelected();
        });

        //check is all selected
        function checkSelected() {
            var all = $("input.select-all")[0];
            var total = $("input.select-item").length;
            var len = $("input.select-item:checked:checked").length;

            all.checked = len === total;
        }
    });
</script>

</html>