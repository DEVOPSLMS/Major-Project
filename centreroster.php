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
error_reporting(E_ERROR | E_PARSE);
$user_data = check_login($con);
$username = $user_data['username'];
if ($user_data['role'] != 'l') {
    header('HTTP/1.0 403 Forbidden');
    exit;
}
date_default_timezone_set('Singapore');
if (isset($_POST['submit'])) {
    $centre = $_POST['centre'];
    $description = $_POST['description'];
    $query = "insert into centre (centre_name,description,name)values('$centre Centre','$description','$centre')";
    $result = mysqli_query($con, $query);
    echo ("<script>
    alert('Successfully Added');
    document.location.href = 'centreroster.php';
  </script>");
}




$date = date('Y-m-d');

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
            <div class="col-lg-12">
                <button type="button" class="btn " data-toggle="modal" data-target=".bd-example-modal-lg" style="width:100%;">Add Centre</button>

                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <form action="" method="POST">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Centre</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">

                                    <label style="font-size:20px;">Centre Name(No Need To Include Centre Just The Name Etc: Pasir Ris)</label>
                                    <input type="text" name="centre" class="form-control" required style="height:40px;font-size:20px;">
                                    <label style="font-size:20px;">Description</label>
                                    <textarea type="text" name="description" class="form-control"required style="height:40px;font-size:20px;"></textarea>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" style="font-size:20px;" data-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn " style="font-size:20px;">Add Centre</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>




                <div class="row">
                    <?php
                    $query = "select * from centre";
                    $result = mysqli_query($con, $query);
                    foreach ($result as $a) : ?>
                            <?php $id=$a['id'];?>
                        <div class="col-lg-4 p-5">
                            <div class="card">
                                <div class="card-header">
                                    <?php echo $a['centre_name'] ?>
                                    <a onclick='
            if(confirm("Are you sure?") == false) {
                return false;
            } else {
              
         
                href="delete_centre.php?id=<?php echo$id?>"
                    
            }'><button type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button></a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Special title treatment</h5>
                                    <p class="card-text"><?php echo $a['description'] ?></p>
                                    <?php
                                    $date = date("Y-m-d");


                                    $url = ("roster.php?name=" . $a['centre_name'] . "&dt=" . $date . "");

                                    echo ("<a href='" . ($url) . "' class='btn 'style='font-size:15px;'>See All " . $a['name'] . " Lessons</a>")

                                    ?>


                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>







    </body>


</html>