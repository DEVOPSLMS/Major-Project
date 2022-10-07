<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

$query = "select * from student";
$result = mysqli_query($con, $query);
$student_details = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>

</head>
<header>
    <header class="header">

        <?php include("header.php") ?>

    </header>
</header>

<body>
    <button style="position: absolute" href="/index.php">Back</button>
    <h2 class="text-center"><b>Enrollment Review</b></h2>


    <div>
        <div>
            <?php print_r($student_details)?>
        </div>


    </div>



</body>




</html>