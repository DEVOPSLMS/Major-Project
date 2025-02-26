<?php

session_start();

include("connection.php");
include("functions.php");
error_reporting(E_ERROR | E_PARSE);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  //something was posted
  $user_name = $_POST['username'];
  $password = $_POST['password'];
  $check = $_POST['check'];

  if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

    //read from database

    $query = "select * from user where userid = '$user_name'  limit 1";
    $result = mysqli_query($con, $query);



    if ($result) {
      if ($result && mysqli_num_rows($result) > 0) {

        $user_data = mysqli_fetch_assoc($result);

        if (password_verify($password, $user_data['password'])) {
          if ($check != '') {
            $_SESSION['user_id'] = $user_data['user_id'];
            $id=$user_data['id'];
            $week = new DateTime('+1 week');
            $token = md5(rand());
            $sql = "UPDATE `user` SET `check_token`='$token'WHERE id=$id";
            mysqli_query($con, $sql);
            setcookie('key', $token, $week->getTimestamp(), '/', null, null, true);
            header("Location: index.php");
            die;
          } else {
            $_SESSION['user_id'] = $user_data['user_id'];
            header("Location: index.php");
            die;
          }
        } else {
          $errs_password='Password is Incorrect!';
        }
      } else {
        $errs='Userid Is Incorrect!';
      }
    }
  } else {
    if(empty($user_name) ){
      $errs='Enter Userid';
    }
    if(empty($password) ){
      $errs_password='Enter Password';
    }
    
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Design by foolishdeveloper.com -->
  <title>Login Page</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--Stylesheet-->
  <link rel="stylesheet" href="css/login.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style media="screen">
    *,
    *:before,
    *:after {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #080710;
    }

    

    form {
      
   
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

    label {
      display: block;
      margin-top: 30px;
      font-size: 16px;
      font-weight: 500;
    }

    .help {
      display: block;
      height: 50px;
      width: 100%;
      background-color: rgba(255, 255, 255, 0.07);
      border-radius: 3px;
      padding: 0 10px;
      margin-top: 8px;
      font-size: 14px;
      font-weight: 300;
    }

    ::placeholder {
      color: #e5e5e5;
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

    .social {
      margin-top: 30px;
      display: flex;
    }

    .social div {
      background: red;
      width: 150px;
      border-radius: 3px;
      padding: 5px 10px 10px 5px;
      background-color: rgba(255, 255, 255, 0.27);
      color: #eaf0fb;
      text-align: center;
    }

    .social div:hover {
      background-color: rgba(255, 255, 255, 0.47);
    }

    .social .fb {
      margin-left: 25px;
    }

    .social i {
      margin-right: 4px;
    }

    .alert {
      padding: 20px;
      background-color: #f44336;
      color: white;

    }

    .alert.success {
      background-color: #04AA6D;
      text-align: center;
    }

    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .closebtn:hover {
      color: black;
    }

    @media (max-width: 950px) {
      form {
        
        padding: 0px !important;
        margin: 0px !important;
        
      }
      html{
        overflow-x: hidden;
      }

    }
  </style>
</head>
<header>


</header>

<body>

  <div class="container-fluid">
    <div class="background">
      <div class="shape"></div>
      <div class="shape"></div>
    </div>
    <form method="post">
      <h3>Login Here</h3>

      <label for="username">Userid</label>
      <input class="help" type="text" placeholder="Userid" name="username" id="username"value="<?php echo $_POST['username']?>">
      <span style="color:red;"><?php echo $errs?></span>
      <label for="password">Password</label>
      <input class="help" type="password" placeholder="Password" name="password" id="password"value="<?php echo $_POST['password']?>">
      <span style="color:red;"><?php echo $errs_password?></span>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="check" name="check" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Remember Me(Expires After 1 Week)
        </label>
        
      </div>
     
      <button type="submit" value="Login">Log In</button>

      <br><br>
      
      <p style="margin-left:20px;">Forgot Password? <a href="password-reset.php"><span>Click Here To Reset.</span></a></p>

    </form>

  </div>









</body>

</html>