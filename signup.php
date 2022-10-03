<?php
session_start();

include("connection.php");
include("functions.php");


if (isset($_POST["submit"])) {
  $name = $_POST["username"];

  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $user_id = random_num(20);
  $check= "select * from user where username = '$name' limit 1";
  $result = mysqli_query($con, $check);
  if($result && mysqli_num_rows($result) == 0)
  {
    $query = "insert into user(username,password,role,user_id) values ('$name','$password','staff','$user_id')";

    mysqli_query($con, $query);
  
    echo
    "
          <script>
            alert('Successfully Added');
            document.location.href = 'login.php';
          </script>
          ";

  }
  else{
    echo '<div class="alert alert-primary" role="alert"style="text-align:center;">
    <strong>Userid Exist!Please Try with a different Userid!</strong> 
    
  </div>';
  }
 
}



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

  <link rel="stylesheet" href="css/testing.css">
  <!-- Feel free to remove these styles or customise in your own stylesheet 👍 -->

</head>

<body>


  <h1>Sign Up</h1>



  <div class="form-group">
    <form id="form" method="POST" enctype="multipart/form-data" autocomplete="off">

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Userid</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="username" placeholder="1234Z0101">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleFormControlInput1" name="password">
      </div>


      <button class="btn btn-primary text-center" type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;">Sign Up</button>

    </form>
  </div>

  </div>




</body>

</html>