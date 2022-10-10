<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$class_id = intval($_GET['id']);
$query = "select * from roster where id = '$class_id'";
$result = mysqli_query($con, $query);
$lesson_details = mysqli_fetch_assoc($result);
$date = date('jS M');
$students = (explode(',', $lesson_details['students']));
$class = $lesson_details['timing'] . ' ' . $lesson_details['subject'] . ' ' . 'Class' . ' ' . $date;


?>
<?php 
$country=file_get_contents('http://api.hostip.info/get_html.php?ip=');


// Reformat the data returned (Keep only country and country abbr.)
$only_country=explode (" ", $country);


?>
<?php
$query = @unserialize (file_get_contents('http://ip-api.com/php/'));

$recorded=$query['zip'];


?>
<?php

if (isset($_POST["submit"])) {


    foreach (array_combine($students, $_POST['status']) as $student => $status) {
        $teacher_name = $lesson_details['teacher_name'];

        $centre_name = $lesson_details['centre_name'];
        $date = date('Y-m-d');


        $query = "insert into attendance(student_name,status,date,class,teacher_name,centre_name,classid,recorded_at) values ('$student','$status','$date','$class','$teacher_name','$centre_name','$class_id','$recorded')";

        mysqli_query($con, $query);
        if ($status == 'late') {
    
            $query = "select * from student where student_name = '$student' ";
            $result = mysqli_query($con, $query);
            $user_details = mysqli_fetch_assoc($result);
            $id = $user_details['id'];
            $parentid = $user_details['parentid'];
            print_r($id);
            $sql = "UPDATE `student` SET `late_counter`=`late_counter`+1 WHERE id=$id";
            mysqli_query($con, $sql);
            $query2 = "insert into notification(parentid,notification,status) values ('$parentid','$class','late')";
            mysqli_query($con, $query2);
        }
        if ($status == 'absent') {
    
            $query = "select * from student where student_name = '$student' ";
            $result = mysqli_query($con, $query);
            $user_details = mysqli_fetch_assoc($result);
            $id = $user_details['parentid'];
         
            $sql = "insert into notification(parentid,notification,status) values ('$id','$class','absent')";
            mysqli_query($con, $sql);
        }

        echo ("<script>
            alert('Successfully Added');
            document.location.href = 'lesson_details.php?id=$class_id';
          </script>");
    }
}
?>
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

<body>
    <form method="POST">
        <br>
        <a href="lesson_details.php?id=<?php echo ($id) ?>" class="btn btn-primary" name="hod" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:80px;height:40px;">Back</a>
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

                <button class="btn btn-primary" name="submit" type="submit" style="background-color:#F92C85;color:white;border-color:#F92C85;margin:auto;height:40px;">Submit</button>
            </div>

        </div>

        <table class="table table-striped">
            <tr>

                <th class="success">Student Name</th>
                <th class="warning">Attendance <p class="active">
                        <input type="checkbox" class="select-all checkbox" name="select-all" />(Mark All As Present)
                    </p>
                </th>
                <th class="danger">Remarks</th>

            </tr>
            <?php foreach ($students as $student) : ?>
                <tr>
                    <td class="success" name="student_name"><?php echo ($student) ?></td>

                    <td class="active" required>


                        <input type="checkbox" class="select-item checkbox" name="status[]" value="present" />Present
                        <input type="checkbox" class="select checkbox" name="status[]" value="late" />Late
                        <input type="checkbox" class="select checkbox" name="status[]" value="absent" />Absent



                    </td>
                    <td class="success">
                        <div class="form-group ">

                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" style="width: 100%;" id="staticEmail" name="remarks"></textarea>
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