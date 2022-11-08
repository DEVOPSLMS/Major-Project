<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("insert-payslip.php");
include("check_attendance.php");
$user_data = check_login($con);
$id = $user_data['id'];
$sql = "select * from submit_leave_teacher where teacherid = '$id' ORDER BY id desc ";
$teacher_leave = mysqli_query($con, $sql);
$results = mysqli_fetch_assoc($teacher_leave);
if (isset($_POST["submit"])) {
    $name = $user_data['username'];
    $reason = $_POST["reason"];
    $date_start = $_POST["date_start"];
    $date_end = $_POST["date_end"];
    $comments = $_POST["comments"];
    $id = $user_data['id'];
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

            move_uploaded_file($tmpName, 'submit/' . $newImageName);

            $query = "insert into submit_leave_teacher(name,teacherid,date_start,date_end,image,comments,reason) values ('$name','$id','$date_start','$date_end','$newImageName','$comments','$reason')";

            mysqli_query($con, $query);

            mysqli_query($con, $sql);
            echo
            "
        <script>
          alert('Successfully Added');
          document.location.href = 'submitleave.php';
        </script>
        ";
        }
    }
}

?>
<?php


if (empty($_POST['username'])) {
    $username_error = "Please enter a username";
}
if (empty($_POST['password'])) {
    $password_error = "Please enter a password";
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Submit Leave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<header>
    <header class="header">

        <?php include("header.php") ?>

    </header>
    <style>
        body {
            font-size: 130%;
        }
    </style>
    <br><br><br><br><br><br><br><br><br><br>

    <body>
        <div class="container-fluid">
            <?php if ($results['date_end'] >= $date) {
                echo ('<h1 class="text-center">You Already Submitted an MC that will finish on ' . $results['date_end'] . '.Please wait until after ' . $results['date_end'] . ' to submit a new MC</h1>');
            }
            if ($results['date_end'] < $date) {?>
                <div class="container">
            <div class="card">
                <div class="card-header">
                    Submit Leave
                </div>
                <div class="card-body">
                    <form id="form" method="POST" enctype="multipart/form-data" class="needs-validation " style="margin:auto;" autocomplete="off">
                        <div class="mb-3">
                            <label> Name: </label>

                            <input type="text" class="form-control " disabled id="exampleFormControlInput1" name="name" value="<?php echo ($user_data['username']) ?>" required>


                        </div>
                        <div class="form-group ">


                            <label for="reason">Reason Of Absence</label>
                            <select class=" form-control " id="reason" name="reason" required>
                                <option value="">Choose..</option>
                                <option value="sick" name="room">Sick</option>
                                <option value="vacation" name="room">Vacation</option>
                                <option value="other" name="room">Others</option>

                            </select>
                        </div>
                        <label>Leave Date*</label>
                        <div class="form-group row"style="margin-left:2px;">




                            <input type="date" class="col-sm-5  form-control" name="date_start" id="staticEmail"required>
                            <input type="text" readonly class="col-sm-1 form-control-plaintext text-center" style="width:10%;" value="To" id="staticEmail">
                            <input type="date" class="col-sm-5 form-control" name="date_end" id="staticEmail"required>
                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlFile1">Attach picture of MC (if applicable)</label>
                            <input type="file" class="form-control-file" name="image" id="image" accept=".jpg, .jpeg, .png" id="exampleFormControlFile1" requiredvalue="">
                        </div>

                        

                        <div class="form-group ">
                            <label for="exampleFormControlFile1">Comments (if any)*</label>
                            <textarea class="form-control" name="comments" id="exampleFormControlTextarea1"  rows="3"></textarea>
                        </div>



                        <div class="col-lg-12">
                            <button class="btn text-center" type="submit" name="submit" style="font-size:15px;float:right;">Submit Leave</button>

                        </div>


                    </form>
                </div>
            </div>
        </div>
          <?php  }

            ?>

        </div>

        




    </body>


</html>