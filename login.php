<?php

session_start();

include("connection.php");
include("functions.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  //something was posted
  $user_name = $_POST['username'];
  $password = $_POST['password'];
  $role= $_POST['inlineRadioOptions'];

  if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

    //read from database
    $query = "select * from user where username = '$user_name' and role= '$role' limit 1";
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



<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Design by foolishdeveloper.com -->
  <title>Glassmorphism login Form Tutorial in html css</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--Stylesheet-->

</head>

<body>
  <?php
  if (isset($_SESSION['status'])) {
  ?>
    <div class="alert success">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      <?php echo $_SESSION['status']; ?>
    </div>
  <?php

    unset($_SESSION['status']);
  }
  ?>
  <h1>Login</h1>



  <div class="form-group">
    <form id="form" method="POST" enctype="multipart/form-data" autocomplete="off">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="teacher">
        <label class="form-check-label" for="inlineRadio1">Teacher</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="staff">
        <label class="form-check-label" for="inlineRadio2">Staff</label>
      </div>
      
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Userid</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="username" placeholder="1234Z0101">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleFormControlInput1" name="password">
      </div>


      <button class="btn btn-primary" type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;margin:auto;">Login</button>

    </form>
  </div>

  </div>


  </form>
</body>

</html>