<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("check_attendance.php");
include("insert-payslip.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
$a = @unserialize(file_get_contents('http://ip-api.com/php/'));
date_default_timezone_set('Singapore');
$recorded = $a['zip'];
$user_data = check_login($con);
$id = $user_data['id'];
$username = $user_data['username'];
$role = $user_data['role'];
$latitude = $_COOKIE['lat'];
$longitude = $_COOKIE['lng'];
$geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $latitude . ',' . $longitude . '&sensor=false&key=AIzaSyC1sUOKVl7HdX71DpzLoXzgBv-rJaJAWpE');
$output = json_decode($geocode);
$formattedAddress = @$output->results[0]->formatted_address;
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

            $query = "insert into checkin(location,image,feedback,date,userid,username,role) values ('$formattedAddress','$newImageName','$feedback','$date','$id','$username','$role')";

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
$query = "select * from checkin where userid = '$id' ORDER BY date desc";
$checkin = mysqli_query($con, $query);
?>


<!DOCTYPE html>
<html>

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<header class="header">

    <?php include("header.php") ?>

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

    @media (max-width: 950px) {

        html {
            font-size: 80%;
        }
    }
</style>
<br><br><br><br><br><br><br><br><br><br><br><br>

<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {

        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        var lat_details = "lat=" + lat;
        var lng_details = "lng=" + lng;
        document.cookie = lat_details;
        document.cookie = lng_details;
    }
</script>

<body onLoad="getLocation();">
    <div class="container">
        <div class="card">
            <div class="card-header">
                Check-In
            </div>
            <div class="card-body">
                <form id="form" method="POST" enctype="multipart/form-data" class="needs-validation " style="margin:auto;" autocomplete="off">
                    <div class="mb-3">
                        <label> Location: </label>

                        <input type="text" class="form-control " disabled id="exampleFormControlInput1" name="location" value="<?php echo ($formattedAddress) ?>" required>

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
                        <textarea type="text" class="form-control" id="exampleFormControlInput1" name="feedback"></textarea>
                    </div>





                    <div class="col-lg-12">
                        <button class="btn text-center" type="submit" name="submit" style="font-size:15px;">Check-in</button>
                        <a href="check-in-past.php" class="btn text-center" type="submit" name="submit" style="font-size:15px;float:right;">See Pasts Check-in</a>
                    </div>


                </form>
            </div>
        </div>
    </div>




</body>






</html>