<?php
session_start();

include("connection.php");
include("functions.php");
error_reporting(E_ERROR | E_PARSE);
$query = "select * from user where role = 'teacher' ";
$teacher = mysqli_query($con, $query);
if (isset($_POST["submit"])) {
  $name = $_POST["username"];
  $email = $_POST["email"];
  $number = $_POST["number"];
  $confim = $_POST["confirm"];
  $check = $_POST['password'];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $image = $_FILES["image"];
  $userid = $_POST["userid"];
  $role = $_POST["role"];
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
    $errs_username='Username Already Exists';
  } else {
    if ($see_email && mysqli_num_rows($see_email) > 0) {
      $errs_email='Email Already Exists';
    } else {
      if ($see_userid && mysqli_num_rows($see_userid) > 0) {
        $errs_userid='Userid Already Exists';
      } else {
        if ($check != $password) {
          $errs_password='Passwords Do Not Match';
          $errs_confirm='Passwords Do Not Match';
        } else {
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
              $query = "insert into user(email,username,userid,password,role,user_id,image,number,relief,preferred,teach,status) values ('$email','$name','$userid','$password','$role','$user_id','$newImageName','$number','yes','$preferredList','$teachList','present ')";

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

</header>

<style media="screen">
  ::placeholder {
    color: #e5e5e5;
  }

  form {
    height: 1050px;
    width: 800px;
    background-color: rgba(255, 255, 255, 0.13);
    position: absolute;
    transform: translate(-50%, -50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
    padding: 50px 35px;
  }

  form * {
    font-family: 'Poppins', sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
  }

  form h3 {
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
  }

  *:before,
  *:after {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }

  body {
    background-color: #080710;
  }

  .background {
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%, -50%);
    left: 50%;
    top: 50%;
  }

  .background .shape {
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
  }

  .shape:first-child {
    background: linear-gradient(#1845ad,
        #23a2f6);
    left: -80px;
    top: -80px;
  }

  .shape:last-child {
    background: linear-gradient(to right,
        #ff512f,
        #f09819);
    right: -30px;
    bottom: -80px;
  }

  button {
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
  }
</style>

<body>
  <div class="container-fluid">
    <div class="background">
      <div class="shape"></div>
      <div class="shape"></div>
    </div>

    <div class="form-group">
      <form id="form" method="POST" enctype="multipart/form-data" class="needs-validation" autocomplete="off">
        <h3>Sign Up Here</h3>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Email" required>
          <span style="color:red;"><?php echo $errs_email?></span>
          <div class="invalid-tooltip">
            Please choose a unique and valid username.
          </div>
        </div>
        <div class="mb-3">
          <label>Username</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="username" placeholder="Username" required>
        </div>
        <span style="color:red;"><?php echo $errs_username?></span>
        <div class="mb-3">
          <label>Userid</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="userid" placeholder="Userid" required>
        </div>
        <span style="color:red;"><?php echo $errs_userid?></span>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" class="form-control" id="exampleFormControlInput1" name="password" placeholder="Password" required>
        </div>
        <span style="color:red;"><?php echo $errs_password?></span>
        <div class="mb-3">
          <label>Confirm Password</label>
          <input type="password" class="form-control" id="exampleFormControlInput1" name="confirm" placeholder="Confirm Password" required>
        </div>
        <span style="color:red;"><?php echo $errs_confirm?></span>
        <div class="mb-3">
          <label>Phone Number</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="number" placeholder="Phone Number" required>
        </div>
        <label>Role</label>
        <div class="mb-3">
          <select class="form-select" name="role" required>
            <option selected style="color:black;">Role Select</option>
            <option value="parent" style="color:black;">Parent</option>
            <option value="l" style="color:black;">L&D</option>
            <option value="teacher" style="color:black;">Teacher</option>
            <option value="admin" style="color:black;">Admin</option>
            <option value="finance" style="color:black;">Finance</option>
            <option value="manager" style="color:black;">Centre Manager</option>

          </select>
        </div>

        <label class="form-check-label" for="inlineCheckbox2">Preferred Centre(Only For Teachers)</label>
        <br>

        <div class="form-check form-check-inline">

          <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Hougang Centre">
          <label class="form-check-label" for="inlineCheckbox1">Hougang Centre</label>
        </div>

        <div class="form-check form-check-inline">

          <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Sengkang Centre">
          <label class="form-check-label" for="inlineCheckbox1">Sengkang Centre</label>
        </div>
        <div class="form-check form-check-inline">

          <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Punggol Centre">
          <label class="form-check-label" for="inlineCheckbox1">Punggol Centre</label>
        </div>
        <div class="form-check form-check-inline">

          <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Fernvale Centre">
          <label class="form-check-label" for="inlineCheckbox1">Fernvale Centre</label>
        </div>
        <div class="form-check form-check-inline">

          <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Teck Ghee Centre">
          <label class="form-check-label" for="inlineCheckbox1">Teck Ghee Centre</label>
        </div>
        <div class="form-check form-check-inline">

          <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Kolam Ayer Centre">
          <label class="form-check-label" for="inlineCheckbox1">Kolam Ayer Centre</label>
        </div>
        <br>
        <label class="form-check-label" for="inlineCheckbox2">Avaliability(Only For Teachers)</label>
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
        <br> <br>
        <div class="form-group text-center">
          <label for="image">Profile Image : </label>
          <input type="file" name="image" id="image" required accept=".jpg, .jpeg, .png" value="">
        </div>



        <button type="submit" name="submit">Sign Up</button>
        <br>
        <br>
        <p class="text-center">Already Have An Account? <a href="login.php"><span>Login Here.</span></a></p>
      </form>
    </div>
  </div>












</body>

</html>