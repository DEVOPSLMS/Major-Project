<?php
session_start();
include('functions.php');
include('connection.php');
include("insert-payslip.php");
include("check_attendance.php");
$user_data = check_login($con);
$id=intval($_GET['id']);
$query = "select * from user where id = '$id' ";
$result = mysqli_query($con, $query);

$user_details = mysqli_fetch_assoc($result);
if(isset($_POST['submit'])){
    $password = $_POST['password'];
    if (password_verify($password, $user_details['password'])) {
         
       
        header("Location: password_change.php?id=$id");
        die;
  
     
        
      }
      else{
        echo("<script>alert('Password is incorrect')</script>");
      }
}
?>
<!DOCTYPE html>
<html>

<head>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/profile.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<header>
    <?php include('header.php') ?>
</header>
<br><br><br><br><br><br><br><br><br><br><br><br>

<body>
    <div class="container">
        <h1 class="text-center">Check Password</h1>
        <h2 class="text-center">This is needed so that we know you are the owner of this account!</h2>
        <form method="POST">
        <input type="password" placeholder="Enter Password"style="height:50px;" name="password"class="form-control">
        <button type="submit"class="btn"name="submit"style="font-size:15px;float:left;">Submit</button>
        </form>
       
    </div>

</body>

</html>