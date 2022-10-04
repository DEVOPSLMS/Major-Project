<?php
session_start();
include("connection.php");
include("functions.php");
$role = strval($_GET['role']);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $user_name = $_POST['username'];
    $password = $_POST['password'];
 
    
  
    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
  
      //read from database
      $query = "select * from user where userid = '$user_name' and role= '$role' limit 1";
      $result = mysqli_query($con, $query);
  
      if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
  
          $user_data = mysqli_fetch_assoc($result);
  
          if (password_verify($password, $user_data['password'])) {
  
            $_SESSION['user_id'] = $user_data['user_id'];
            
            header("Location: index.php");
            die;
          } else {
            echo '<div class="alert alert-primary" role="alert"style="text-align:center;">
          <strong>Password Is Incorrect!</strong> 
          
        </div>';
          }
        } else {
          echo '<div class="alert alert-primary" role="alert"style="text-align:center;">
            <strong>Userid Does Not Exist!</strong> 
            
          </div>';
        }
      }
    } else {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"style="text-align:center;">
        <strong>Input Your Username Or Password!</strong> 
        
      </div>';
    }
  }
  
  ?>

<!doctype html>
<html>
<head>
<title>Our Funky HTML Page</title>
<meta name="description" content="Our first page">
<meta name="keywords" content="html tutorial template">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/signup.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<header>
<div class="logo">
  <img src="image/logo.svg" alt="">
  </div>
  <hr class="solid">
</header>
<body>
<div class="container-fluid">
<h1>Quick Login</h1>
<br>
<div class="form-group">
    <form id="form" method="POST" enctype="multipart/form-data" autocomplete="off">
      
     
      <div class="mb-3">
       
        <input type="text" class="form-control" id="exampleFormControlInput1" style="width:300px;"name="username" placeholder="Userid">
       
        
        
      </div>
      <br>
      <div class="mb-3">
       
        <input type="password" class="form-control" id="exampleFormControlInput1"style="width:300px;" name="password"placeholder="Password">
      </div>
      <br>

      <button class="btn btn-primary" type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;margin:auto;">Login</button>

    </form>
    
 
  </div>
</div>

</body>
</html>