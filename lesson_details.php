<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$username=$user_data['username'];
$id = intval($_GET['id']);
$username=$user_data['username'];
$query = "select * from roster where id = '$id'";
$result = mysqli_query($con, $query);
$lesson_details = mysqli_fetch_assoc($result);
$date= date('Y-m-d');
$query = "select * from attendance where teacher_name = '$username'and classid='$id'";
$result = mysqli_query($con, $query);
$num=mysqli_num_rows($result);

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



<body>
<a href="schedule.php"class="btn btn-primary"  name="hod" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:80px;height:40px;">Back</a>
    <h1>Lesson Details</h1>
    <h1>Level/Subject: <?php echo($lesson_details['level'])?>/<?php echo($lesson_details['subject'])?></h1>
    <h1>Teacher: <?php echo($lesson_details['teacher_name'])?></h1>
    <h1>Timing: <?php echo($lesson_details['timing'])?></h1>
    <h1>Status: <?php if($lesson_details['need_relief']=='no'){
        echo('<i class="fa fa-circle" style="font-size:25px;margin-left:15px;color:#00FF6F;"></i>');
        }
        else{
            echo('<i class="fa fa-circle" style="font-size:25px;margin-left:15px;color:red;"></i>');
        }?></h1>
    <?php if($lesson_details['date'] == $date && $lesson_details['need_relief']== 'no' && $num <= 0){
        echo('<a href="attendance.php?id='.$id.'"class="btn btn-primary"  name="hod" style="background-color:#F92C85;color:white;border-color:#F92C85;margin:auto;height:40px;">Mark Attendance</a>  ');
    }else{
        echo('<h3 style="font-weight:bold;">Attendance Taken!</h3>');
    }
    ?>
    
</body>
</html>