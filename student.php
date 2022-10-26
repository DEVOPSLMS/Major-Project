<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("insert-payslip.php");
$user_data = check_login($con);

$date=date("Y-m-d");

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <header>
    <header class="header">

        <?php include("header.php") ?>

    </header>
    <br><br><br><br><br><br><br><br><br><br>
  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
                    <a href="schedule_student.php?dt=<?php echo $date ?>&name=<?php echo $parent['student_name']  ?>" class="btn btn-primary" style="font-size:15px;">See <?php echo $parent['student_name'] ?> Schedule</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php }else{?>
        <div class="col-lg-12">
            <div class="card text-center">
                <h5 class="card-header">Please Enrol Your Kid First.</h5>
                
            </div>
        </div>
        <?php }?>
</div>


</div>
</body>
</html>