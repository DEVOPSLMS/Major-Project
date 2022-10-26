<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("insert-payslip.php");
$user_data = check_login($con);



?>

<!DOCTYPE html>
<html>

<head>

    <title>Submit Leave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<header>
    <header class="header">

        <?php include("header.php") ?>

    </header>
    <style>
        body {
            font-size: 130%;
        }
    </style>
    <br><br><br><br><br><br><br><br><br><br>

    <body>
        <div class="container-fluid">

            <div class="row">
                <?php
                $id = $user_data['id'];
                $query = "select * from student where parentid = $id and status='Enrolled'";
                $result = mysqli_query($con, $query);
                ?>
                <?php if(mysqli_num_rows($result)> 0) {?>
                <?php foreach ($result as $parent) : ?>

                    <div class="col-lg-12">
                        <div class="card text-center">
                            <h5 class="card-header">Student Name: <?php echo $parent['student_name'] ?></h5>
                            <div class="card-body">
                                <h5 class="card-title">Student Level: <?php echo $parent['student_level'] ?></h5>
                                <p class="card-text">Centre Name: <?php echo $parent['centre_name'] ?></p>
                                <a href="student_leave.php?id=<?php echo $parent['id'] ?>" class="btn btn-primary" style="font-size:15px;">Submit Reason Of Absence</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php }else{?>
                    <div class="col-lg-12">
                        <div class="card text-center">
                            <h5 class="card-header">Please Enroll Your Kid First</h5>
                            
                        </div>
                    </div>
                    <?php }?>
            </div>


        </div>



       


    </body>


</html>