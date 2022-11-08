<?php 
include('connection.php');

if(isset($_POST['submit'])){
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $new_password=$_POST['password'];
    $confirm=$_POST['confirm'];
    $token=$_POST['token'];
   
    if(!empty($token)){
        if(!empty($email) &&!empty($new_password)&&!empty($confirm)){
            $check_token=  "SELECT verify_token from user where verify_token='$token'LIMIT 1";
            $check_token_run=mysqli_query($con,$check_token);
            if(mysqli_num_rows($check_token_run)> 0){
               
                if($new_password ==$confirm){
                  
                    $password = password_hash($new_password, PASSWORD_DEFAULT);
                    $update="UPDATE user set password ='$password'WHERE verify_token='$token' LIMIT 1";
                    $update_password=mysqli_query($con,$update);
                    if($update_password)
                    {
                        echo ( "<script>
                        alert('Successfully Updated!');
                        document.location.href = 'login.php';
                    </script>");
                        
                        exit(0);
                    }
                    else{
                        echo ("<script>alert('Something went wrong!')</script>");
                    }
                }
                else{
                    echo '<div class="alert alert-primary" role="alert"style="text-align:center;">
                    <strong>Passwords Do Not Match!</strong> 
                    
                  </div>';
                }
            }
            else{
                echo '<div class="alert alert-primary" role="alert"style="text-align:center;">
                <strong>Invalid Token!</strong> 
                
              </div>';
            }
        }
        else{
            echo '<div class="alert alert-primary" role="alert"style="text-align:center;">
                <strong>Please Fill in all Forms</strong> 
                
              </div>';
        }
    }
    else{
        echo '<div class="alert alert-primary" role="alert"style="text-align:center;">
        <strong>No Token Avaliable!</strong> 
        
      </div>';
    }
    

}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Password Reset</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
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

    form {
        height: 600px;
        width: 400px;
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
            width: 110%
        }
    }
</style>
<br><br><br><br><br><br><br><br>

<body>
    <div class="container">
        
            <div class="background">
                <div class="shape"></div>
                <div class="shape"></div>
            </div>
            <form method="post">
                <h3>Password Reset</h3>

                <label for="username">Email</label>
                <input  type="hidden"  name="token" value="<?php if(isset($_GET['token'])){echo($_GET['token']);}?>">
                <input class="help" type="email" value="<?php if(isset($_GET['email'])){echo($_GET['email']);}?>" name="email" id="username">
                <label for="username">New Password</label>
                <input class="help" type="password" placeholder="Enter Password" name="password" id="username">
                <label for="username">Confirm Password</label>
                <input class="help" type="password" placeholder="Confirm Password" name="confirm" id="username">
               

                <button type="submit"name="submit" value="Login">Reset Password</button>

                <br><br>
                

              
            </form>


    </div>

</body>

</html>
