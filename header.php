<?php
include("connection.php");
$role = $user_data['role'];
$username = $user_data['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- displays site properly based on user's device -->

  <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- custom css file link  -->
	<link href='https://css.gg/log-out.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <link rel="stylesheet" href="css/header.css">

</head>
<header>
  <div class="logo">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a href="index.php"><img src="image/logo.svg" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">
          <li>Profile</li></a>
          </li>
          <?php if ($role == 'teacher' || $role == 'parent') {
            echo ('  <li class="nav-item">
        <a class="nav-link" href="#"><li>Schedule</li></a>
        </li>');
          }
          ?>
          <?php if ($role == 'teacher') {
            echo ('<li class="nav-item">
        <a class="nav-link" href="#"><li>Attendance</li></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#"><li>Submit Leave</li></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#"><li>Check-In</li></a>
        </li>');
          }
          ?>
          
          <?php if ($role == 'parent' || $role == 'finance' || $role == 'l' || $role == 'manager' || $role == 'admin') {
          echo ('<li class="nav-item">
          <a class="nav-link" href="#"><li>Feedback</li></a>
          </li>');
        }
        ?>
        <?php if ($role == 'finance') {
          echo ('<li class="nav-item">
          <a class="nav-link" href="#"><li>Payslips & Expenses Log</li></a>
          </li>');
        }
        ?>
         <?php if ($role == 'l') {
          echo ('<li class="nav-item">
          <a class="nav-link" href="centreroster.php"><li>Lessons</li></a>
          </li>');
          echo ('<li class="nav-item">
          <a class="nav-link" href="#"><li>Teachers</li></a>
          </li>');
          echo ('<li class="nav-item">
          <a class="nav-link" href="#"><li>Broadcast</li></a>
          </li>');
        }
        ?>
        <?php if ($role == 'manager') {
          echo ('<li class="nav-item">
          <a class="nav-link" href="#"><li>Attendance</li></a>
          </li>');
          echo ('<li class="nav-item">
          <a class="nav-link" href="#"><li>Results</li></a>
          </li>');
        }

        ?>
         <?php if ($role == 'admin') {
          echo ('<li class="nav-item">
          <a class="nav-link" href="#"><li>Students</li></a>
          </li>');
          echo ('<li class="nav-item">
          <a class="nav-link" href="#"><li>Storage</li></a>
          </li>');
        }
        ?>
          <?php if ($role == 'parent' || $role == 'admin') {
          echo ('<li class="nav-item">
          <a class="nav-link" href="enrollment_review.php"><li>Enrollment</li></a>
          </li>');
        }
?>
 <?php if ($role == 'parent') {
          echo ('<li class="nav-item">
          <a class="nav-link" href="enrollment.php"><li>Submit Reason Of Absence</li></a>
          </li>');
          echo ('<li class="nav-item">
          <a class="nav-link" href="enrollment.php"><li>Withdrawl of Child</li></a>
          </li>');
          echo ('<li class="nav-item">
          <a class="nav-link" href="enrollment.php"><li>Results</li></a>
          </li>');
          echo ('<li class="nav-item">
          <a class="nav-link" href="notification.php"><li>Notification</li></a>
          </li>');
        }
        ?>
         <li class="nav-item">
            <a class="nav-link" href="logout.php">
          <li>Log Out</li></a>
        </ul>
   
      </div>
      
    </nav>
  </div>
  <hr class="solid">

 
</header>


</html>