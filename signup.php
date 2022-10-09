<?php
session_start();

include("connection.php");
include("functions.php");

$query = "select * from user where role = 'teacher' ";
$teacher = mysqli_query($con, $query);
if (isset($_POST["submit"])) {
  $name = $_POST["username"];
  $email = $_POST["email"];
  $number = $_POST["number"];


  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $image = $_FILES["image"];
  $userid = $_POST["userid"];
  foreach ($_POST['teach'] as $teach) {

    $teachList = implode(', ', $_POST['teach']);
  }
  foreach ($_POST['preferred'] as $preferred) {

    $preferredList = implode(', ', $_POST['preferred']);
  }
  $query = "select * from user where username = '$name' limit 1";
  $result = mysqli_query($con, $query);
  $query2 = "select * from user where email = '$email' limit 1";
  $see_email = mysqli_query($con, $query2);
  $query3 = "select * from user where userid = '$userid' limit 1";
  $see_userid = mysqli_query($con, $query3);
  if ($result && mysqli_num_rows($result) > 0) {
    echo '<div class="alert alert-primary" role="alert"style="text-align:center;">
          <strong>Username is already been used!</strong> 
          
        </div>';
  } else {
    if ($see_email && mysqli_num_rows($see_email) > 0) {
      echo '<div class="alert alert-primary" role="alert"style="text-align:center;">
            <strong>Email is already been used!</strong> 
            
          </div>';
    } else {
      if ($see_userid && mysqli_num_rows($see_userid) > 0) {
        echo '<div class="alert alert-primary" role="alert"style="text-align:center;">
              <strong>Userid is already been used!</strong> 
              
            </div>';
      }
      else{
        if ($_FILES["image"]["error"] == 4) {
          echo
          "<script> alert('Image Does Not Exist'); </script>";
        } else {
          $fileName = $_FILES["image"]["name"];
          $fileSize = $_FILES["image"]["size"];
          $tmpName = $_FILES["image"]["tmp_name"];
  
          $validImageExtension = ['jpg', 'jpeg', 'png'];
          $imageExtension = explode('.', $fileName);
          $imageExtension = strtolower(end($imageExtension));
          if (!in_array($imageExtension, $validImageExtension)) {
            echo
            "
          <script>
            alert('Invalid Image Extension');
          </script>
          ";
          } else if ($fileSize > 1000000) {
            echo
            "
          <script>
            alert('Image Size Is Too Large');
          </script>
          ";
          } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
  
            move_uploaded_file($tmpName, 'profile/' . $newImageName);
            $user_id = random_num(20);
            $query = "insert into user(email,username,userid,password,role,user_id,image,number,relief,preferred,teach,status) values ('$email','$name','$userid','$password','parent','$user_id','$newImageName','$number','yes','$preferredList','$teachList','present ')";
  
            mysqli_query($con, $query);
  
            echo
            "
          <script>
            alert('Successfully Added');
            document.location.href = 'login.php';
          </script>
          ";
          }
        }
      }
      
    }
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

  <link rel="stylesheet" href="css/signup.css">
  <!-- Feel free to remove these styles or customise in your own stylesheet 👍 -->

</head>
<header>
  <div class="logo">
    <img src="image/logo.svg" alt="">
  </div>
  <hr class="solid">
</header>

<body>
  <div class="container-fluid">
    <h1>Sign Up</h1>
    <div class="form-group">
      <form id="form" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="mb-3">

          <input type="text" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Email">
        </div>
        <div class="mb-3">

          <input type="text" class="form-control" id="exampleFormControlInput1" name="username" placeholder="Username">
        </div>
        <div class="mb-3">

          <input type="text" class="form-control" id="exampleFormControlInput1" name="userid" placeholder="Userid">
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" id="exampleFormControlInput1" name="password" placeholder="Password">
        </div>
        <div class="mb-3">

          <input type="text" class="form-control" id="exampleFormControlInput1" name="number" placeholder="Phone Number">
        </div>

        <label class="form-check-label" for="inlineCheckbox2">Preferred Centre</label>
        <br>

        <div class="form-check form-check-inline">

          <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Pasir Ris Centre">
          <label class="form-check-label" for="inlineCheckbox1">Pasir Ris Centre</label>
        </div>
        <div class="form-check form-check-inline">

          <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Tampines Centre">
          <label class="form-check-label" for="inlineCheckbox1">Tampines Centre</label>
        </div>
        <div class="form-check form-check-inline">

          <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Sengkang Centre">
          <label class="form-check-label" for="inlineCheckbox1">Sengkang Centre</label>
        </div>
        <div class="form-check form-check-inline">

          <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Simei Centre">
          <label class="form-check-label" for="inlineCheckbox1">Simei Centre</label>
        </div>
        <br>
        <label class="form-check-label" for="inlineCheckbox2">Avaliability</label>
        <br>
        <div class="form-check form-check-inline">

          <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox1" value="Weekdays">
          <label class="form-check-label" for="inlineCheckbox1">Weekdays</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Weekend">
          <label class="form-check-label" for="inlineCheckbox2">Weekend</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Monday">
          <label class="form-check-label" for="inlineCheckbox2">Monday</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Tuesday">
          <label class="form-check-label" for="inlineCheckbox2">Tuesday</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Wednesday">
          <label class="form-check-label" for="inlineCheckbox2">Wednesday</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Thursday">
          <label class="form-check-label" for="inlineCheckbox2">Thursday</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Friday">
          <label class="form-check-label" for="inlineCheckbox2">Friday</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Saturday">
          <label class="form-check-label" for="inlineCheckbox2">Saturday</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Sunday">
          <label class="form-check-label" for="inlineCheckbox2">Sunday</label>
        </div>
        <div class="form-group">
          <label for="image">Profile Image : </label>
          <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="">
        </div>



        <button class="btn btn-primary text-center" type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;">Sign Up</button>
        <a href="login.php">Go To Login</a>
      </form>
    </div>
  </div>












</body>

</html>