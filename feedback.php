<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

$getfeedback = "SELECT * FROM feedback";
$result = mysqli_query($con, $getfeedback);



?>
<!DOCTYPE html>
<html>

<head>


    <title>Home Page</title>
    <link rel="stylesheet" href="css/index.css">
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

    <div style="float:left; width: 19%; height: 700px; border: 1px black solid;">

        <ul style="list-style-type: none;">
            <li>
                <h3><b>Feedback</b></h3>
            </li>

            <li style="">
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

<style>
    #viewFeedbacks {
        /* display: none; */
    }
</style>

</html>