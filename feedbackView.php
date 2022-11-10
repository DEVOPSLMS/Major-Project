<?php
session_start();

include("connection.php");
include("functions.php");
include("check_roster.php");
include("insert-payslip.php");
include("check_attendance.php");
include("check_teacher.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
$user_data = check_login($con);
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback</title>
    <link href="style.css" rel="stylesheet" type="text/css">

    <!-- <link href="calendar.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>
<header>
    <?php include("header.php");

    if (isset($_POST["submit"])) {
        $centre = $_POST["centre"];
        $feedback = $_POST["feedback"];

        $query = "INSERT INTO feedback(name, role, centre, feedback) VALUES ('$username','$role','$centre','$feedback')";
        mysqli_query($con, $query);

        echo
        "<script>
            alert('Feedback submitted!');
            document.location.href = 'feedback.php';
        </script>";
    }

    ?>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>


    <div class="sidenav">
        <h2 style="font-weight:700;">Feedback</h2>
        <a href="feedback.php">Submit a Feedback</a>

        <a href="feedbackSelfView.php">My Feedbacks</a>

        <?php if ($role !== 'parent') { ?>
            <a>View Feedbacks</a>
        <?php } ?>

    </div>

</header>


<body>
    <div id="feedbackBody">
        <?php
        $getfeedback = "SELECT * FROM feedback";
        $result = mysqli_query($con, $getfeedback);
        ?>
        <div id="viewFeedbacks" style="margin-left: 318px;">
            <div class="sidenav" style="padding-top: 0; width: 80%; border: 1px grey solid">
                <?php foreach ($result as $x) : ?>
                    <table style="margin: 25px 25px;">
                        <tr>
                            <td>
                                <b>Name:</b>
                            </td>
                            <td><?php echo $x["name"] ?> <b> (<?php echo $x["role"] ?>) </b></td>
                        </tr>
                        <tr>
                            <td>
                                <b>Centre:</b>
                            </td>
                            <td>
                                <?php echo $x["centre"] ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <b>Feedback:</b>
                            </td>
                            <td style="word-wrap: break-word;"><?php echo $x["feedback"] ?></td>
                        </tr>
                    </table>
                <?php endforeach; ?>
            </div>
        </div>




    </div>
</body>
<style>
    .sidenav a:nth-child(4) {
        background-color: #5ebec4;
    }

    @media(max-width:500px) {
        .btn {

            /* It hides the button text
                when screen size <=768px */
            display: none;
        }
    }

    .container {
        padding-left: 100px;
        padding-right: 50px;

    }

    .sidenav {
        height: 70%;
        /* width: 19%; */
        width: 300px;
        position: fixed;
        z-index: 1;
        top: 200px;
        /* left: 0; */
        overflow-x: hidden;
        padding-top: 20px;
        border: 1px black solid;
    }

    .sidenav h2 {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        color: black;
        display: block;
    }

    .sidenav td {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        color: black;
        /* display: block; */
    }

    .sidenav a {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        color: black;
        display: block;
        cursor: pointer;
    }

    .sidenav a:hover {
        background-color: #96d5d9;
        /* background-color: #5ebec4; */
        /* color: black; */
    }

    .main {
        margin-left: 160px;
        /* Same as the width of the sidenav */
        font-size: 28px;
        /* Increased text to enable scrolling */
        padding: 0px 10px;
    }

    @media screen and (max-height: 500px) {
        .sidenav {
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 18px;
        }
    }

    #table-form {
        font-size: 18px;
    }

    #table-form td {
        padding: 8px;
    }

    #table-form tr td:nth-child(odd) {
        text-align: right;
        vertical-align: top;
        font-weight: bolder;
    }
</style>

</html>