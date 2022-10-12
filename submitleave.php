<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
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
    
<br><br><br><br><br><br><br><br><br><br>
    <body>
        <div class="container-fluid">

            <form method="POST"enctype="multipart/form-data"autocomplete="off">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" name="name" id="staticEmail" value=<?php echo ($user_data['username']); ?>>
                    </div>
                </div>
                <div class="form-group row">


                    <label for="reason" class="col-sm-2 col-form-label">Reason Of Absence</label>
                    <select class="col-sm-10 form-select " style="width:50%;" id="reason" name="reason" required>
                        <option selected></option>
                        <option value="1" name="room"> 1</option>
                        <option value="2" name="room"> 2</option>
                        <option value="3" name="room"> 3</option>

                    </select>
                </div>
                <div class="form-group row">


                    <label for="reason" class="col-sm-2 col-form-label">Leave Date*</label>
                    <input type="date" class="col-sm-2" name="date_start" id="staticEmail"> <input type="text" readonly class="col-sm-1 form-control-plaintext text-center" style="width:10%;" value="To" id="staticEmail"><br><input type="date" class="col-sm-2" name="date_end" id="staticEmail">
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlFile1" class="col-sm-2 col-form-label">Attach picture of MC (if applicable)</label>
                    <input type="file" class="col-sm-2 form-control-file" name="image" id="image" accept=".jpg, .jpeg, .png" id="exampleFormControlFile1" value="">
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlFile1" class="col-sm-2 col-form-label">Comments (if any)*</label>
                    <textarea class="col-sm-2 form-control" name="comments" id="exampleFormControlTextarea1" style="width:50%;" rows="3"></textarea>
                </div>
                <div class="col-sm-9">
                    <button class="btn btn-primary " style="float:right;margin-right:160px; " type="submit" name="submit">Submit Leave</button>
                </div>
            </form>
        </div>



        </div>


    </body>


</html>