<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("insert-payslip.php");
include("check_attendance.php");
$user_data = check_login($con);
$username = $user_data['username'];
error_reporting(E_ERROR | E_PARSE);
?>
<?php
$query = "select * from user where username = '$username' ";
$result = mysqli_query($con, $query);

$user_details = mysqli_fetch_assoc($result);
$id = $user_details['id'];
$centre = $user_details['preferred'];
$centre_names = explode(", ", $centre);
$teach = $user_details['teach'];
$teach_names = explode(", ", $teach);
?>
<?php
if (isset($_POST["submit"])) {

  $image = $_FILES["image"];






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

      $sql = "UPDATE `user` SET `image`='$newImageName' WHERE id=$id";
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
}


if(isset($_POST['profile'])){

  $email=$_POST['email'];
  $number=$_POST['number'];

  $relief=$_POST['relief'];
  foreach ($_POST['teach'] as $teach) {

    $teachList = implode(', ', $_POST['teach']);
  }
  foreach ($_POST['preferred'] as $preferred) {

    $preferredList = implode(', ', $_POST['preferred']);
  }

  $query2 = "select * from user where email = '$email' limit 1";
  $see_email = mysqli_query($con, $query2);
  $details = mysqli_fetch_assoc($see_email);
    if ($see_email && mysqli_num_rows($see_email) > 0 && $details['id'] != $id) {
      echo("<script>
      alert('Email Is Already Been Used!');
      </script>");
    }
    else{
      $sql = "UPDATE `user` SET `email`='$email',`number`='$number',`preferred`='$preferredList',`teach`='$teachList',`relief`='$relief'WHERE id=$id";
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
<br><br><br><br><br><br><br><br><br><br><br>


<style>
  input[type="file"] {
    display: none;
  }

  img {
    cursor: pointer;
  }
</style>
<script type="text/javascript">
  function openSelect(file) {
    $(file).trigger('click');
  }

  function read(val) {
    const reader = new FileReader();

    reader.onload = (event) => {
      document.getElementById("OpenImgUpload").src = event.target.result;
    }

    reader.readAsDataURL(val.files[0]);
  }
</script>

<body>

  <div class="container">
    <div class="main-body">



      <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <form method="POST" enctype="multipart/form-data">

                  <a href="javascript:void(0)" onClick="openSelect('#file1')">
                    <br>
                    <img src="profile/<?php echo ($user_data['image']) ?>" alt="Admin" id="OpenImgUpload" class="img rounded-circle" width="150">

                  </a>
                  <br>
                  <span>Click On Image To Edit Profile Picture!</span>
                  <button type="submit" name="submit" class="btn" style="font-size:15px;">Update Image</button>
                  <input type="file" id="file1" onchange="read(this)" name="image" required accept=".jpg, .jpeg, .png" value="">
                </form>

                <div class="mt-3">
                  <h4><?php echo ($user_data['username']) ?></h4>
                  <p class="text-secondary mb-1">Role: <?php echo ($user_data['role']) ?></p>
                  <p class="text-muted font-size-sm">ID:<?php echo ($user_data['user_id']) ?></p>

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
                  <?php echo ($user_data['username']) ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Userid</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo ($user_data['userid']) ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo ($user_data['email']) ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo ($user_data['number']) ?>

                </div>
              </div>
              <hr>
              <?php
              if ($user_data['role'] == 'teacher') {
                echo (' <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Avaliability</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                   ' . $user_data['teach'] . '
                    </div>
                  </div>
                  <hr>');
              }
              ?>
              <?php
              if ($user_data['role'] == 'teacher') {
                echo (' <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Preferred Centre</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                   ' . $user_data['preferred'] . '
                    </div>
                  </div>
                  <hr>');
              }
              ?>
              <?php
              if ($user_data['role'] == 'teacher') {
                echo (' <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Can Relief</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                   ' . $user_data['relief'] . '
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
                  <?php if ($user_data['status'] == 'present') {
                    echo ('<i class="fa fa-circle" style="color:green;"></i>');
                  } ?>
                  <?php if ($user_data['status'] == 'sick') {
                    echo ('<i class="fa fa-circle" style="color:red;"></i>');
                  } ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <a class="btn " style="font-size:15px;" data-toggle="modal" data-target="#studentaddmodal">Edit</a>
                </div>
                <div class="col-sm-6">
                  <a class="btn  " href="check_password.php?id=<?php echo($id)?>"style="font-size:15px;float:right" >Change Password</a>
                </div>
              </div>
            </div>
          </div>





        </div>
      </div>

    </div>



  </div>
  <div class="modal fade bd-example-modal-lg" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="font-size:20px;">Update Profile </h5>


        </div>

        <form method="POST" enctype="multipart/form-data" autocomplete="off">

          <div class="modal-body" style="font-size:20px;">

           



            <div class="form-group">
              <label> Email </label>

              <input type="email" class="form-control" style="height:50px;font-size:20px; text-transform: capitalize; " id="staticEmail" name="email" value="<?php echo $user_details['email'] ?>">


            </div>

            <div class="form-group">
              <label> Phone Number </label>

              <input type="number" class="form-control" style="height:50px;font-size:20px; text-transform: capitalize; " id="staticEmail" name="number" value="<?php echo $user_details['number'] ?>">


            </div>
<?php  if($user_details['role'] =='teacher') {?>
            <div class="form-group">
              <label> Preferred Centre </label>
              <br>
              <div class="form-check form-check-inline">

                <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Hougang Centre"<?php if(in_array('Hougang Centre',$centre_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox1">Hougang Centre</label>
              </div>

              <div class="form-check form-check-inline">

                <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Sengkang Centre"<?php if(in_array('Sengkang Centre',$centre_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox1">Sengkang Centre</label>
              </div>
              <div class="form-check form-check-inline">

                <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Punggol Centre"<?php if(in_array('Punggol Centre',$centre_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox1">Punggol Centre</label>
              </div>
              <div class="form-check form-check-inline">

                <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Fernvale Centre"<?php if(in_array('Fernvale Centre',$centre_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox1">Fernvale Centre</label>
              </div>
              <div class="form-check form-check-inline">

                <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Teck Ghee Centre"<?php if(in_array('Teck Ghee Centre',$centre_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox1">Teck Ghee Centre</label>
              </div>
              <div class="form-check form-check-inline">

                <input class="form-check-input" name="preferred[]" type="checkbox" id="inlineCheckbox1" value="Kolam Ayer Centre"<?php if(in_array('Kolam Ayer Centre',$centre_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox1">Kolam Ayer Centre</label>
              </div>


            </div>
            <?php }?>
            <?php  if($user_details['role'] =='teacher') {?>
            <div class="form-group">
              <label> Avaliability </label>

              <div class="form-check form-check-inline">

                <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox1" value="Weekdays"<?php if(in_array('Weekdays',$teach_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox1">Weekdays</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Weekend"<?php if(in_array('Weekend',$teach_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox2">Weekend</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Monday"<?php if(in_array('Monday',$teach_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox2">Monday</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Tuesday"<?php if(in_array('Tuesday',$teach_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox2">Tuesday</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Wednesday"<?php if(in_array('Wednesday',$teach_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox2">Wednesday</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Thursday"<?php if(in_array('Thursday',$teach_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox2">Thursday</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Friday"<?php if(in_array('Friday',$teach_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox2">Friday</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Saturday"<?php if(in_array('Saturday',$teach_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox2">Saturday</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" name="teach[]" type="checkbox" id="inlineCheckbox2" value="Sunday"<?php if(in_array('Sunday',$teach_names)){echo("checked");}?>>
                <label class="form-check-label" for="inlineCheckbox2">Sunday</label>
              </div>


            </div>
            <?php }?>
            <?php  if($user_details['role'] =='teacher') {?>
              <div class="form-group">
              <label for="inputEmail4" style="font-size:20px;">Can Relief</label>
                        <select class="form-control" style="height:50px;font-size:20px;" required name="relief">
                            <?php if($user_details['relief']=='yes'){
                              echo(" <option value='yes'>Yes</option>");
                              echo(" <option value='no'>No</option>");
                            }
                            ?>
                       <?php if($user_details['relief']=='no'){
                             
                              echo(" <option value='no'>No</option>");
                              echo(" <option value='yes'>Yes</option>");
                            }
                            ?>

                            

                        </select>
              </div>
              <?php }?>




          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="profile" class="btn btn-primary">Update Profile</button>
          </div>

        </form>

      </div>
    </div>
  </div>


</body>






</html>