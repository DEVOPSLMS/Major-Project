<?php
session_start();
include('functions.php');
include('connection.php');
include("insert-payslip.php");

$user_data = check_login($con);
$id=intval($_GET['id']);
if(isset($_POST['submit'])){
    $password = $_POST['new_password'];

    $confirm = $_POST['check_password'];
    if($password != $confirm){
        echo("<script>alert('Passwords Does Not Match')</script>");
    }
    else{

        $password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
        $sql = "UPDATE `user` SET `password`='$password' WHERE id=$id";
        mysqli_query($con, $sql);
        echo
      "
    <script>
      alert('Successfully Updated');
      document.location.href = 'profile.php';
    </script>
    ";
    }
   
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Password Change</title>
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
<h1 class="text-center">Change Password</h1>
<form method="POST">
    
    <div class="form-group">
    <label>New Password</label>
    <input type="password" placeholder="Enter Password"style="height:50px;" name="new_password"class="form-control">
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" placeholder="Confirm Password"style="height:50px;" name="check_password"class="form-control">
        </div>
        <button type="submit"class="btn"name="submit"style="font-size:15px;float:right;">Submit</button>
        </form>
</div>
</body>

</html>