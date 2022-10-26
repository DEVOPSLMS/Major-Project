<?php
include("connection.php");
include_once("functions.php");

$user_data = check_login($con);

$role = $user_data['role'];
$username = $user_data['username'];
$id = $user_data['id'];
$sql = "SELECT * FROM notification WHERE seen=0 and parentid='$id' ";
$res = mysqli_query($con, $sql);
$query = "SELECT * FROM notification_teacher WHERE seen=0 and teacher_name='$username' ";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- displays site properly based on user's device -->


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <link rel="stylesheet" href="css/header.css" />


</head>

<header class="header">

  <img src="image/logo.svg">

  <nav class="navbar">
    <a href="index.php">home</a>

    <?php  if ($role == 'teacher' || $role == 'parent') {
      echo (' <a href="#">Schedule</a>');
      
    }
    ?>
    <?php if ($role == 'teacher') {
      echo ('<a href="schedule.php">Attendance</a>
            <a href="submitleave.php">Submit Leave</a>
            <a href="check-in.php">Check In</a>
            <a href="payslip-teacher.php">Payslip</a>
            <a href="expenses-teacher.php">Expenses</a>'
      );
    }
    ?>
    <?php if ($role == 'parent' || $role == 'finance' || $role == 'l' || $role == 'manager' || $role == 'admin') {
      echo ('<a href="feedback.php">Feedback</a>');
    }
    ?>
    <?php if ($role == 'finance') {
      echo ('<a href="payslip.php">Payslips</a>');
      echo ('<a href="expenses.php">Expenses</a>');
    }
    ?>
    <?php if ($role == 'l') {
      echo ('
          <a href="centreroster.php">Lessons</a>');
      echo ('<a href="teacher.php">Teachers</a>');
      echo ('<a href="#">Broadcast</a>');
    }
    ?>
    <?php if ($role == 'admin') {
      echo ('<a href="#">Students</a>');
      echo ('<a href="#">Storage</a>');
    }
    ?>
    <?php if ($role == 'parent' || $role == 'admin') {
      echo ('<a href="enrollment.php">Enrollment</a>');
    }
    ?>
    <?php if ($role == 'parent') {
      echo ('<a href="#">Submit Reason Of Absence</a>');
      echo ('<a href="#">Withdrawl of Child</a>');
      echo ('<a href="#">Results</a>');
    }
    ?>
    <?php if ($role == 'manager') {
      echo ('<a href="#">Attendance</a>');
      echo ('<a href="#">Results</a>');

    }
    ?>
  </nav>

  <div class="icons">
    <div class="fas fa-bars" id="menu-btn"></div>
    <?php if ($role == 'parent') {
      echo (' <a id="noti-btn" ><div class="fa fa-bell" ><span class="badge">' . mysqli_num_rows($res) . '</span></div></a>');
    }
    if ($role == 'teacher') {
      echo (' <a id="noti-btn" ><div class="fa fa-bell" ><span class="badge">' . mysqli_num_rows($result) . '</span></div></a>');
    }
    ?>
    <a href="profile.php" title="Profile Page">
      <div class="fas fa-user" id="login-btn"></div>
    </a>
    <a href="logout.php" title="Logout">
      <div class='fa fa-sign-out'></div>
    </a>

  </div>
  <div class="shopping-cart">
    <?php if ($role == 'parent') {
      $query = "select * from notification where parentid = '$id' and status='absent' and seen = 0";
      $result = mysqli_query($con, $query);

    ?>
      <?php foreach ($result as $r) : ?>
        <div class="box">

          <div class="content">
            <h3>Your Child, <?php echo $r['student_name'] ?> Is Absent For Class <?php echo $r['notification'] ?></h3>

          </div>
        </div>

        <hr>





      <?php endforeach ?>


      <?php
      $query = "select * from notification where parentid = '$id' and status='late' and seen = 0";
      $result = mysqli_query($con, $query); ?>

      <?php foreach ($result as $r) : ?>
        <div class="box">

          <div class="content">
            <h3>Your Child, <?php echo $r['student_name'] ?> Is Late For Class <?php echo $r['notification'] ?></h3>

          </div>
        </div>

        <hr>


      <?php endforeach ?>
      <?php
      $query = "select * from notification where parentid = '$id' and status='approve' and seen = 0";
      $result = mysqli_query($con, $query); ?>

      <?php foreach ($result as $r) : ?>
        <div class="box">

          <div class="content">
            <h3>Your Child, <?php echo $r['student_name'] ?> Has Been Enrolled into YYD Education Centre</h3>

          </div>
        </div>

        <hr>


      <?php endforeach ?>
      <?php
      $query = "select * from notification where parentid = '$id' and status='disapprove' and seen = 0";
      $result = mysqli_query($con, $query); ?>

      <?php foreach ($result as $r) : ?>
        <div class="box">

          <div class="content">
            <h3>Your Child, <?php echo $r['student_name'] ?> Has Been Disapproved To Join YYD Education Centre</h3>

          </div>
        </div>

        <hr>


      <?php endforeach ?>
    <?php } ?>
    <?php if ($role == 'teacher') {
      $query = "select * from notification_teacher where teacher_name = '$username' and seen = 0";
      $result = mysqli_query($con, $query);

    ?>
      <?php foreach ($result as $r) : ?>
        <div class="box">

          <div class="content">
            <?php if($r['status']=='payslip'){?>
            <h3>Your Payslip For <?php echo $r['about'] ?> Has Been Paid</h3>
              <?php }?>
              <?php if($r['status']=='expenses'){?>
            <h3>Your Expenses For Date <?php echo $r['date'] ?> Has Been Paid</h3>
              <?php }?>
          </div>
        </div>

        <hr>





      <?php endforeach ?>
<?php }?>

      
  </div>



</header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $("#noti-btn").on("click", function() {
      $.ajax({
        url: "readnoti.php",
        success: function(res) {
          console.log(res);
        }
      });
    });
  });

</script>
<script>
  let shoppingCart = document.querySelector('.shopping-cart');
  document.querySelector('#noti-btn').onclick = () => {
    shoppingCart.classList.toggle('active');

  }

</script>
<style>
  .badge {
    position: absolute;

    padding: 5px 10px;
    border-radius: 50%;
    background: red;
    color: white;
  }
</style>

<body>


</body>
<script src="js/script.js"></script>

</html>