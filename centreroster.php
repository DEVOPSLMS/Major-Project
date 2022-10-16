<?php
session_start();
include("check_roster.php");
include("check_teacher.php");
include("connection.php");
include("functions.php");

error_reporting(E_ERROR | E_PARSE);
$user_data = check_login($con);
$username = $user_data['username'];

date_default_timezone_set('Singapore');
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $subject = $_POST["subject"];
    $centre = $_POST["centre"];
    $timing = $_POST["timing"];
    $date = $_POST["date"];
    $room = $_POST["room"];
    $query = "insert into roster(centre_name,subject,level,timing,teacher_name,need_relief,room,date,day,students) VALUES('$centre', '$subject','$level','$timing','$name','no','$room','$date','$day','$students')";
    mysqli_query($con, $query);

    echo
    "
        <script>
          alert('Successfully Added');
          document.location.href = 'centreroster.php';
        </script>
        ";
}




$date=date('Y-m-d');

$earlier = new DateTime(date("Y-m-d"));
$later = new DateTime("2022-10-09");

$abs_diff = $later->diff($earlier)->format("%a"); //3
$query = "select * from user where role = 'teacher' ";
$teacher = mysqli_query($con, $query);


?>
<!DOCTYPE html>
<html>

<head>

    <title>Centre Roster</title>
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
    <link rel="stylesheet" href="css/centreroster.css">
</head>
<header>
    <header class="header">

        <?php include("header.php") ?>

    </header>
    <br><br><br><br><br><br><br><br><br><br><br>

    <body>
        <div class="container-fluid">
            <h1 class="text-center">All Centres</h1>
            <div class="row">
                <div class="col-lg-4 p-5">
                    <div class="card">
                        <div class="card-header">
                            Hougang Centre
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="roster.php?name=Hougang&dt=<?php echo$date?>" class="btn "style="font-size:15px;">See All Hougang Lessons</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-5">
                    <div class="card">
                        <div class="card-header">
                            Sengkang Centre
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="roster.php?name=Sengkang&dt=<?php echo$date?>" class="btn "style="font-size:15px;">See All Sengkang Lessons</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-5">
                    <div class="card">
                        <div class="card-header">
                            Punggol Centre
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="roster.php?name=Punggol&dt=<?php echo$date?>" class="btn "style="font-size:15px;">See All Punggol Lessons</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-5">
                    <div class="card">
                        <div class="card-header">
                        Fernvale  Centre
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="roster.php?name=Fernvale&dt=<?php echo$date?>" class="btn "style="font-size:15px;">See All Fernvale Lessons</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-5">
                    <div class="card">
                        <div class="card-header">
                        Teck Ghee  Centre
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="roster.php?name=Teck-Ghee&dt=<?php echo$date?>" class="btn "style="font-size:15px;">See All Teck Ghee Lessons</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-5">
                    <div class="card">
                        <div class="card-header">
                        Kolam Ayer Centre
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="roster.php?name=Kolam-Ayer&dt=<?php echo$date?>" class="btn "style="font-size:15px;">See All Kolam Ayer Lessons</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>







    </body>


</html>