<?php
session_start();
include("check_teacher.php");
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_attendance.php");

$user_data = check_login($con);
$id = $user_data['id'];
$sql = "UPDATE notification SET seen='1'WHERE parentid='$id' ";
$res = mysqli_query($con, $sql);
?>
<?php
$query2 = "select * from student where parentid = '$id'";
$result2 = mysqli_query($con, $query2);
$user_details = mysqli_fetch_array($result2);

$query = "select * from notification where parentid = '$id'and status='absent'";
$absent = mysqli_query($con, $query);
$row = mysqli_num_rows($absent);
$absent_details = mysqli_fetch_array($absent);


$query3 = "select * from notification where parentid = '$id'and status='late'";
$late = mysqli_query($con, $query3);
$late_details = mysqli_fetch_array($late);
$rows = mysqli_num_rows($late);


?>
<!DOCTYPE html>
<html>

<head>


    <title>Notifications Page</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



</head>
<header>
    <?php include("header.php") ?>


</header>

<br><br><br><br><br><br><br><br><br>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                <a href="index.php" class="btn btn-primary" name="hod">Back</a>

            </div>
            <div class="col-lg-7">
                <H3>Notifications</H3>
            </div>
            <br><br>  <br><br>
            <?php
            foreach ($absent as $a) {
                $classList[] = $a['notification'];
            }
            if (!empty($classList)) {
                $class_name = implode(', ', ($classList));
            }
            if ($row > 0) {
                echo (' 
               
            <div class="col-lg-12 ">
            <div class="alert alert-warning alert-dismissible fade show" role="alert" type="button" class="close"style="width:100%;height:50px;" data-toggle="modal" data-target="#exampleModal">
            <strong>Warning!</strong>Your child has been absent for ' . $row . ' times for class.


        
        </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your Child,' . $user_details['student_name'] . ' has been absent ' . $row . ' times at the following classes:' . $class_name . '.
                </div>
                <div class="form-check">
                
               
                </div>
                
                <div class="modal-footer">
                <label class="form-check-label" for="defaultCheck1"required style="margin-right:330px;">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" >
                I have acknowledge this information. This notification will not show again.
                </label>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   <a href="deletenotification.php?id=' . $id . '"> <button type="button" class="btn btn-primary">Delete Notification</button></a>
                </div>
            </div>
        </div>
      
    </div>');
            }
            ?>
            <?php
            foreach ($late as $a) {
                $classList[] = $a['notification'];
            }
            if (!empty($classList)) {
                $class_name = implode(', ', ($classList));
            }
            if ($rows > 0) {
                echo (' <div class="alert alert-warning alert-dismissible fade show" role="alert" type="button" class="close" data-toggle="modal" data-target="#exampleModal">
                <strong>Warning!</strong>Your child has been late for ' . $rows . ' times for class.


            </div>
            <div class="col-lg-12 p-5">
                
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your Child,' . $user_details['student_name'] . ' has been late ' . $rows . ' times for the following classes:' . $class_name . '.
                </div>
                <div class="form-check">
                
               
                </div>
                
                <div class="modal-footer">
                <label class="form-check-label" for="defaultCheck1"required style="margin-right:330px;">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" >
                I have acknowledge this information. This notification will not show again.
                </label>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   <a href="deletenotificationlate.php?id=' . $id . '"> <button type="button" class="btn btn-primary">Delete Notification</button></a>
                </div>
            </div>
        </div>
      
    </div>');
            }
            ?>


        </div>
    </div>



</body>