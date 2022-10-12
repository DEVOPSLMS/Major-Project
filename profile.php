<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$username = $user_data['username'];
?>
<?php
$query = "select * from user where username = '$username' ";
$result = mysqli_query($con, $query);

$user_details = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>


<head>
    <header class="header">

        <?php include("header.php") ?>

    </header>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/profile.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<br><br><br><br><br><br><br><br><br><br><br>

<body>

    <!------ Include the above in your HEAD tag ---------->
    <div class="container-style" style="font-size:15px;margin-left:60px;">
        <img src="profile/<?php echo $user_details["image"]; ?>" alt="Admin" class="img-thumbnail" width="150">
        <br><br><br>
        <div class="class" >
            <h3><?php echo $user_details["username"]; ?>
            <?php if($user_details["status"]=='present')
            { 
                echo('<i class="fa fa-circle" style="font-size:25px;margin-left:15px;color:#00FF6F;"></i>');
               
            }
             
           ?><?php if($user_details["status"]=='sick')
           { 
               echo('<i class="fa fa-circle" style="font-size:25px;margin-left:15px;color:red;"></i>');
              
           }
            
          ?></h3>
     
          <h3 style="text-transform: capitalize;">Department: <?php echo $user_details["role"]; ?></h3>
       
          <h3 style="text-transform: capitalize;">Contact Number: <?php echo $user_details["number"]; ?></h3>
          <h3 style="text-transform: capitalize;">Email: <?php echo $user_details["email"]; ?></h3>
          <h3 style="text-transform: capitalize;">Avaliable For Relief: <?php echo $user_details["relief"]; ?></h3>
          <h3 style="text-transform: capitalize;">Preferred Centres: <?php echo $user_details["preferred"]; ?></h3>
          <h3 style="text-transform: capitalize;">Able To Teach: <?php echo $user_details["teach"]; ?></h3>
        </div>




    </div>





</body>






</html>