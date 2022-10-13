<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
$query = @unserialize(file_get_contents('http://ip-api.com/php/'));
date_default_timezone_set('Singapore');
$recorded = $query['zip'];
$user_data = check_login($con);
$id = $user_data['id'];
$username = $user_data['username'];
if (isset($_POST["submit"])) {
    $location = $_POST["location"];
    $feedback = $_POST["feedback"];
    $date = date('Y-m-d');

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

            move_uploaded_file($tmpName, 'checkin/' . $newImageName);

            $query = "insert into checkin(location,image,feedback,date,teacherid,teacher_name) values ('$recorded','$newImageName','$feedback','$date','$id','$username')";

            mysqli_query($con, $query);

            echo
            "
        <script>
          alert('Successfully Added');
          document.location.href = 'check-in.php';
        </script>
        ";
        }
    }
}


?>
<?php
$query = "select * from checkin where teacherid = '$id' ORDER BY date desc";
$checkin = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html>

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<header>
    <header class="header">

        <?php include("header.php") ?>

    </header>
</header>
<style>
    .img-thumbnail {
        transition: transform 0.25s ease;
    }

    .img-thumbnail:hover {
        -webkit-transform: scale(1.5);
        /* or some other value */
        transform: scale(1.5);
    }
</style>
<br><br><br><br><br><br><br><br><br><br><br><br>
<body>
    <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Check In</button>
            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Check In History</button>

        </div>
        <div class="tab-content col-lg-11" id="v-pills-tabContent">
            <div class="tab-pane fade show active " id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="col-lg-11">
                    <form id="form" method="POST" enctype="multipart/form-data" class="needs-validation " style="margin:auto;" autocomplete="off">
                        <div class="mb-3">
                            <label> Location: </label>
                            <input type="text" class="form-control " disabled id="exampleFormControlInput1" name="location" placeholder="Email" value="<?php echo ($recorded) ?>" required>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                            <div class="invalid-tooltip">
                                Please choose a unique and valid username.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Photo : </label>
                            <input type="file" name="image" id="image" required accept=".jpg, .jpeg, .png" value="">
                        </div>
                        <div class="mb-3">
                            <label> Feedback: </label>
                            <textarea type="text" class="form-control" id="exampleFormControlInput1" name="feedback" style="width:100%;"></textarea>
                        </div>






                        <button class="btn btn-primary text-center" type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;">Check-in</button>

                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-tab">

                <div class="d-flex align-items-start">

                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <?php foreach ($checkin as $check) : ?>
                            <button class="nav-link" id="v-pills-<?php echo $check['id'] ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?php echo $check['id'] ?>" type="button" role="tab" aria-controls="v-pills-<?php echo $check['id'] ?>"><?php echo $check['date'] ?></button>

                        <?php endforeach; ?>
                    </div>
                    <div class="tab-content col-lg-11 " id="v-pills-tabContent">
                        <?php foreach ($checkin as $check) : ?>
                            <?php
                            $date =  date_format(new DateTime($check['time']), 'H:i');

                            ?>
                            <div class="tab-pane fade" id="v-pills-<?php echo $check['id'] ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $check['id'] ?>-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3>Name:<?php echo $check['teacher_name'] ?></h3>
                                        <h3>Location:Zip(<?php echo $check['location'] ?>)</h3>
                                        <img src="checkin/<?php echo $check["image"]; ?>" alt="Admin" class="img-thumbnail" width="150">
                                        <h5>Hover To Enlarge!</h5>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>
                                            <h3>Feedback</h3>
                                        </label>


                                        <textarea type="text" class="form-control" id="staticEmail" name="students"><?php echo $check['feedback'] ?></textarea>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h3>Time Taken:<?php echo ($date); ?></h3>

                                </div>
                                <div class="col-lg-6">
                                    <h3>Date Taken:<?php echo $check['date'] ?></h3>

                                </div>
                            </div>



                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

        </div>

    </div>


</body>






</html>