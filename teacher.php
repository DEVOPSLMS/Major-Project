<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");

$user_data = check_login($con);
$query = "select * from user where role = 'teacher' ";
$teacher = mysqli_query($con, $query);

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
</head>
<header>
    <header class="header">

        <?php include("header.php") ?>

    </header>
</header>
<br><br><br><br><br><br><br><br><br>
<body>

    <a href="index.php">
        <button class="btn btn-primary text-center" type="submit" name="submit" >Back</button>
    </a>
    <br><br><br><br>
    <div class="container-fluid">

        <br>
        <div class="row">
            <div class="col-lg-2 p-5">
                <h2>Name Of Teacher</h2>
                <br> <br>
                <?php foreach ($teacher as $teachers) : ?>
                    <h4><?php echo $teachers['username']; ?></h4>
                    <br><br>
                <?php endforeach; ?>

            </div>
            <div class="col-lg-3 p-5">
                <h2>Contact number</h2>
                <br> <br>
                <?php foreach ($teacher as $teachers) : ?>
                    <h4><?php echo $teachers['number']; ?></h4>
                    <br><br>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-2 p-5">
                <h3>Email</h3>
                <br> <br>
                <?php foreach ($teacher as $teachers) : ?>
                    <h4><?php echo $teachers['email']; ?></h4>
                    <br><br>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-2 p-5 ">
                <h3>Status</h3>
                <br> <br>
                <?php foreach ($teacher as $teachers)  
                     if($teachers['status']=='present'){
                        echo('<div><i class="fa fa-circle" style="font-size:25px;margin-left:15px;color:#00FF6F;"></div></i><br><br><br>');
                       
                     }else{
                        echo('<i class="fa fa-circle" style="font-size:25px;margin-left:15px;color:red;"></i><br><br>');
                     }
               ?>
            </div>
            <div class="col-lg-2 p-5">
                <h3>Preferred Centres</h3>
                <br> <br>
                <?php foreach ($teacher as $teachers) : ?>
                    <h4><?php echo $teachers['preferred']; ?></h4>
                    <br><br>
                <?php endforeach; ?>
            </div>
    </div>


</body>




</html>