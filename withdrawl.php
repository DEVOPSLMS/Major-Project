<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("insert-payslip.php");
include("check_attendance.php");
$user_data = check_login($con);
if (isset($_POST['submit'])) {
  $id = $_GET['id'];
  $query = "select * from student where id = '$id'";
  $student = mysqli_query($con, $query);
  $details = mysqli_fetch_assoc($student);
  $student_name = $details['student_name'];
  $centre = $details['centre_name'];
  $level = $details['student_level'];
  $day = $_POST['day'];
  $username = $user_data['username'];

  $query = "insert into withdrawl(student_name,centre_name,level,last_day,parent_name) VALUES('$student_name','$centre','$level','$day','$username')";
  mysqli_query($con, $query);
  $sql = ("UPDATE  student SET `status`='Withdrawn' WHERE id = '$id' ");
  mysqli_query($con, $sql);
  echo
  "
        <script>
          alert('Successfully Withdrawn');
          document.location.href = 'withdrawl_child.php';
        </script>
        ";
}

?>
<!doctype html>
<html lang="en">

<head>
  <title>Withdrawl Of Child</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<header>
  <?php
  include("header.php")
  ?>
</header>
<br><br><br><br><br><br><br><br><br><br><br><br>

<body>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <div class="container">
    <h3 class="text-center">You are filling this form to withdraw your child out of YYD Education Centre.
      We will need your child's name, NRIC, and the intended date for your child's last day at our centre.</h3>
    <div class="card">
      <div class="card-header">
        Withdrawl Of Child
      </div>
      <div class="card-body">
        <form id="form" method="POST" enctype="multipart/form-data" class="needs-validation " style="margin:auto;" autocomplete="off">
          <?php
          $id = $_GET['id'];
          $query = "select * from student where id = '$id'";
          $student = mysqli_query($con, $query);
          $details = mysqli_fetch_assoc($student);
          ?>
          <div class="form-group">
            <label> Student Name: </label>
            <input type="text" class="form-control" name="name" disabled value="<?php echo $details['student_name'] ?>">
          </div>
          <div class="form-group">
            <label> Centre Name: </label>
            <input type="text" class="form-control" name="centre" disabled value="<?php echo $details['centre_name'] ?>">
          </div>
          <div class="form-group">
            <label> Primary Level: </label>
            <input type="text" class="form-control" name="level" disabled value="<?php echo $details['student_level'] ?>">
          </div>
          <div class="form-group">
            <label> Last Day At Centre: </label>
            <input type="date" class="form-control" name="day" required>
          </div>
          <div class="form-group">
            <label> Parent Name: </label>
            <input type="text" class="form-control" name="username" disabled value="<?php echo $user_data['username'] ?>">
          </div>






          <div class="col-lg-12">
            <button class="btn text-center" type="submit" style="width:100%;" name="submit" style="font-size:15px;">Withdrawl Your Child</button>

          </div>


        </form>
      </div>
    </div>
  </div>
</body>

</html>