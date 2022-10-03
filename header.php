<?php
	include("connection.php");
    $role= $user_data['role'];
    $username= $user_data['username'];
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <link rel="stylesheet" href="css/header.css">

</head>
<header>
  <div class="logo">
  <img src="image/logo.svg" alt="">
  </div>
  <hr class="solid">

  <nav role='navigation'>
  <div id="menuToggle">
   
    <input type="checkbox" />
    
    
    <span></span>
    <span></span>
    <span></span>
    
   
    <ul id="menu">
      <a href="#"><li>Home</li></a>
      <a href="#"><li>Schedule</li></a>
      <a href="#"><li>Attendance</li></a>
      <a href="#"><li>Submit Leave</li></a>
      <a href="#"><li>Check-In</li></a>
   
      <?php if($role == 'parent')
      {
        echo('<a href="#"><li>Feedback</li></a>');
      }
      ?>
      <a href="profile.php"><li>Profile</li></a>
      <?php if($role == 'finance')
      {
        echo('<a href="#"><li>Payslips & Expenses Log</li></a>');
      }
      ?>
      <br><br><br><br><br><br><br>
      <div class="bottom-menu">
      <i class="fa fa-bell" style="font-size:36px;color:black;margin-left:80px;"></i>

      <p style="color:black;margin-left:75px;font-size:20px;"><?php echo $username?></p>
 
      <a href="logout.php"><button class="btn btn-primary text-center" type="submit" name="submit" style="background-color:#F92C85;color:white;border-color:#F92C85;margin-left:65px;">Logout</button></a>
      </div>
      
    </ul>
    
  </div>
 
</nav>
</header>


</html>