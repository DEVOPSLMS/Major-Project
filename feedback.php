<?php
session_start();

include("connection.php");
include("functions.php");
include("check_roster.php");
include("check_teacher.php");
$user_data = check_login($con);
$getfeedback = "SELECT * FROM feedback";
$result = mysqli_query($con, $getfeedback);
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
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <div style="float:left; width: 19%; height: 700px; border: 1px black solid;">

        <ul style="list-style-type: none;">
            <li>
                <h3><b>Feedback</b></h3>
            </li>

            <li>
                <h4>Submit a Feedback</h4>
            </li>

            <?php if ($role == 'staff') { ?>
                <li>
                    <h4>View Feedbacks</h4>
                </li>
            <?php } ?>

        </ul>
    </div>

</header>

<style>
    @media(max-width:500px) {
        .btn {

            /* It hides the button text
                when screen size <=768px */
            display: none;
        }
    }

    #viewFeedbacks {
        /* display: none; */
    }

    #submitFeedback {
        /* margin-top: 100px; */
    }
</style>

<body>
    <div id="submitFeedback">

        <p>
            Hello Sir/Madam,
            <br>YYD Education Centre is still growing and we value any feedback you can provide us.
            <br>We will not disclose the information you provide us to anyone.
            <br>You can submit your feedback in this form below.
            <br>Thank you for taking your time to provide us with insights and areas where we can improve on.
            <br>Your feedback is greatly appreciated.

        </p>


        <form method="POST">
            <label>Name: </label><input type="text" name="name" disabled placeholder='<?php echo $username ?>'>
            <label for="">Centre: </label><input type="text" name="centre" placeholder="">
            <label for="">Feedback: </label><textarea name="feedback" id="" cols="30" rows="10"></textarea>


            <button class="btn btn-primary" type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;margin:auto;">Submit</button>

        </form>

    </div>

    <div id="viewFeedbacks">
        <ul>
            <?php foreach ($result as $x) : ?>
                <li>
                    <?php echo $x['id']; ?>
                </li>

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

        </ul>

    </div>

</body>


</html>