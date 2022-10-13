<?php
session_start();
include("check_roster.php");
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
 <header class="header">

        <?php include("header.php") ?>

    </header>
<body>

<div class="container">
    <div class="main-body">
    
         
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="profile/<?php echo($user_data['image'])?>" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo($user_data['username'])?></h4>
                      <p class="text-secondary mb-1">Role: <?php echo($user_data['role'])?></p>
                      <p class="text-muted font-size-sm">ID:<?php echo($user_data['user_id'])?></p>
                    
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo($user_data['username'])?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Userid</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo($user_data['userid'])?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo($user_data['email'])?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo($user_data['number'])?>
                    </div>
                  </div>
                  <hr>
                  <?php 
                  if($user_data['role'] =='teacher'){
                    echo(' <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Avaliability</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                   '.$user_data['teach'].'
                    </div>
                  </div>
                  <hr>');
                  }
                  ?>
                  <?php 
                  if($user_data['role'] =='teacher'){
                    echo(' <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Preferred Centre</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                   '.$user_data['preferred'].'
                    </div>
                  </div>
                  <hr>');
                  }
                  ?>
                 
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php if($user_data['status']=='present'){
                        echo('<i class="fa fa-circle" style="color:green;"></i>');
                    }?>
                    <?php if($user_data['status']=='sick'){
                        echo('<i class="fa fa-circle" style="color:red;"></i>');
                    }?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " style="font-size:15px;"target="__blank" >Edit</a>
                    </div>
                  </div>
                </div>
              </div>

              



            </div>
          </div>

        </div>
    </div>






</body>






</html>