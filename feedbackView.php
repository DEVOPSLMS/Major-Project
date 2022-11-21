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


    <div id="Sidenav_" class="sidenav">
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
        <div id="viewFeedbacks">
            <div id="viewFeedbacksChild">
                <h2 id="feedbackHeader" class="text-center" style="font-weight: 900; margin: 10px;">All Feedbacks</h2>

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



        <a id="icon_" href="javascript:void(0)" onclick="myFunction()" class="arrowicon">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-caret-right-square-fill" viewBox="0 0 16 16">
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4v8z" />
            </svg>
        </a>
    </div>
</body>
<style>
    #feedbackHeader{
        display: none;
    }

    #viewFeedbacks {
        width: 100%;
        top: 200px;
        position: fixed;
    }

    #viewFeedbacksChild {
        margin-left: 300px;
        border: 1px grey solid;
        height: 678px;
        z-index: 1;
        left: 300;
        overflow-x: hidden;
    }

    #viewFeedbacksChild td {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        color: black;
    }

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
        background-color: white;
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

<style>
    @media(max-width:455px) {
        #viewFeedbacksChild td {
            font-size: 18px;
        }
    }

    #icon_ {
        position: fixed;
        left: 0;
        z-index: 10;
        top: 50%;
        display: none;
    }

    @media(max-width:990px) {
        .sidenav {
            display: none;
        }

        #feedbackHeader{
            display: block;
        }

        #viewFeedbacksChild {
            /* padding-top: 100px; */
            margin-left: 0;
        }

        #viewFeedbacks {
            position: relative;
            top: -35px;
        }

        #icon_ {
            display: block;
        }


        .sidenav.responsive {
            display: block;
        }

        .arrowicon.responsive_ {
            margin-left: 300px;
        }
    }
</style>

<script>
    /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
    function myFunction() {
        var x = document.getElementById("Sidenav_");
        var y = document.getElementById("icon_");
        if (x.className === "sidenav") {
            x.className += " responsive";
        } else {
            x.className = "sidenav";
        }
        if (y.className === "arrowicon") {
            y.className += " responsive_";
        } else {
            y.className = "arrowicon";
        }
    }
</script>

</html>