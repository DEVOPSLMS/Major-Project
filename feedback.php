<?php
session_start();

include("connection.php");
include("functions.php");
include("check_roster.php");
include("insert-payslip.php");
include("check_teacher.php");
$user_data = check_login($con);
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">

    <link href="calendar.css" rel="stylesheet" type="text/css">
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
        <a onclick="hideFeedback()">Submit a Feedback</a>

        <?php if ($role == 'teacher') { ?>
            <a onclick="showFeedback()">View Feedbacks</a>
        <?php } ?>

    </div>

</header>

<script>
    //hiding feedback when side buttons clicked
    function hideFeedback() {
        document.getElementById("feedbackBody").innerHTML =
            "<style>" +
            "#submitFeedback{" +
            "    display: block;" +
            "}" +

            "#viewFeedbacks{" +
            "    display: none;" +
            "}" +
            "</style>";
            console.log("hidden");
    }

    function showFeedback() {
        document.getElementById("feedbackBody").innerHTML = "testing"+
            "<style>" +
            "#submitFeedback{" +
            "    display: none;" +
            "}" +

            "#viewFeedbacks{" +
            "    display: inline-block;" +
            "}" +
            "</style>";
        
        console.log("shown");
    }
</script>

<body>
    <div id="feedbackBody" class="container">

        <div id="submitFeedback">

            <h4>
                Hello Sir/Madam,
                <br>YYD Education Centre is still growing and we value any feedback you can provide us.
                <br>We will not disclose the information you provide us to anyone.
                <br>
                <br>You can submit your feedback in this form below.
                <br>Thank you for taking your time to provide us with insights and areas where we can improve on.
                <br>Your feedback is greatly appreciated.

            </h4>
            <br><br>

            <form method="POST">
                <table id="table-form">
                    <tr>
                        <td>
                            <h4>Name: </h4>
                        </td>
                        <td><input type="text" class="col-lg-12" name="name" id="Name" disabled placeholder='<?php echo $username ?>' style="border: 1px solid lightgrey;"></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Centre: </h4>
                        </td>
                        <td>
                            <select type="text" class="col-lg-12" name="centre" id="Centre" width="60px" style="border: 1px solid grey;">
                                <option selected>Select a centre</option>
                                <option value="hougang">Hougang</option>
                                <option value="sengkang">Sengkang</option>
                                <option value="punggol">Punggol</option>
                                <option value="fernvale">Fernvale</option>
                                <option value="teckghee"> Teck Ghee</option>
                                <option value="kolamayer">Kolam Ayer</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Feedback: </h4>
                        </td>
                        <td><textarea name="feedback" id="Feedback" cols="60" rows="10" style="border: 1px solid grey;"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right;">
                            <button class="btn btn-primary" type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;margin:auto;">Submit</button>
                        </td>
                    </tr>
                </table>




            </form>


        </div>

        <div id="viewFeedbacks" style="border: 1px black solid; height:1000px;">
            <?php
            $getfeedback = "SELECT * FROM feedback";
            $result = mysqli_query($con, $getfeedback);
            ?>

            <?php foreach ($result as $x) : ?>
                <table>
                    <tr>
                        <td>
                            Name:
                        </td>
                        <td><?php echo $x['name'] ?></td>
                    </tr>
                    <tr>
                        <td>
                            Centre:
                        </td>
                        <td>
                            <?php echo $x['centre'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Feedback:
                        </td>
                        <td><?php echo $x['feedback'] ?></td>
                    </tr>
                </table>

            <?php endforeach; ?>

        </div>

    </div>
</body>
<style>
    #viewFeedbacks{
        /* display: none; */
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
        margin-top: 200px;
        height: 100%;
        width: 19%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
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

    .sidenav a {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        color: black;
        display: block;
        cursor: pointer;
    }

    .sidenav a:hover {
        background-color: #5ebec4;
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