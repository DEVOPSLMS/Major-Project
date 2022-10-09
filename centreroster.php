<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$username = $user_data['username'];

date_default_timezone_set('Singapore');
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $subject = $_POST["subject"];
    $centre = $_POST["centre"];
    $timing = $_POST["timing"];
    $date = $_POST["date"];
    $room = $_POST["room"];
    $query = "insert into roster(centre_name,subject,level,timing,teacher_name,need_relief,room,date,day,students) VALUES('$centre', '$subject','$level','$timing','$name','no','$room','$date','$day','$students')";
    mysqli_query($con, $query);

    echo
    "
        <script>
          alert('Successfully Added');
          document.location.href = 'centreroster.php';
        </script>
        ";
}






$earlier = new DateTime(date("Y-m-d"));
$later = new DateTime("2022-10-09");

$abs_diff = $later->diff($earlier)->format("%a"); //3
$query = "select * from user where role = 'teacher' ";
$teacher = mysqli_query($con, $query);


?>
<!DOCTYPE html>
<html>

<head>

    <title>Centre Roster</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/centreroster.css">
</head>
<header>
    <header class="header">

        <?php include("header.php") ?>

    </header>


    <body>
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-8">
                    <button class="btn btn-primary" style="float:right;margin-right:250px;" type="button" data-toggle="modal" data-target="#studentaddmodal">Add Lesson</button>
<form method="POST" class="form">
  
<h3>Filter By Date: <input type="date" name="date"value=""id="date">
<button class="btn btn-primary"  type="submit" name="hi">Filter</button>
</form>
                    


                        <h4>Time: <?php echo date('H:i'); ?></h4>
                        <h4>Today's Date: <?php echo date('Y-m-d'); ?></h4>
                </div>


                <div class="col-lg-4">
                    <p style="font-weight:bold;font-size:30px;">Legend:</p>
                    <div class="legend" style="display:flex;flex-wrap:wrap;">
                        <i class="fa fa-circle" style="font-weight:bold;font-size:30px;color:yellow;"></i>
                        <h4>Looking For Relief</h4><br>

                    </div>
                    <div class="legend" style="display:flex;flex-wrap:wrap;">
                        <i class="fa fa-circle" style="font-weight:bold;font-size:30px;color:orange;"></i>
                        <h4>Still looking for relief (2 days before lesson)</h4><br>

                    </div>
                    <div class="legend" style="display:flex;flex-wrap:wrap;">
                        <i class="fa fa-circle" style="font-weight:bold;font-size:30px;color:red;"></i>
                        <h4>Still looking for relief (1 day before or day of lesson)</h4><br>

                    </div>

                </div>
            </div>
            <br><br><br><br><br>
            <div class="row">
                <div class="col-lg-2 text-center">
                    <a href="roster.php?name=hougang" title="Click To See Roster">
                        <h3>Hougang</h3>
                    </a>
                    <?php 
                    if(!isset($_POST["hi"])){
                        $date = date("Y-m-d");
                        $roster = mysqli_query($con, "SELECT * FROM roster where date= '$date' ");
                        
                        foreach ($roster as $rosters) {
                            $abs_diff = array();
                            $difference = array();
                            $all_timings = array();
                            $calculated_timings = array();
                            $datediff = array();
                            $earlier = new DateTime(date("Y-m-d"));
                            $later = new DateTime($rosters['date']);
                            $datenow = new DateTime(date("H:i"));
                            $timings = implode('', [$rosters['timing']]);
                            $all_timings = substr($timings, 0, 2);
                            // $calculated_timings =$all_timings *60;
                            // $datediff = $datenow - $calculated_timings;
                            $now = time(); // or your date as well
                            $your_date = strtotime("2022-010-04");
                            $datediff = $now - $your_date;
    
    
                            array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);
    
    
    
    
    
                            if ($abs_diff[1] == 'Hougang Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                                echo ('
                            <div class="card" style="width: 18rem;">');
    
                                echo ('<div class="card-body"style="background-color:yellow;">
                                <h3 class="card-title">' . $rosters['subject'] . '</h3>
                                <p class="card-text">Room: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                            </div>
                        </div>
                        <br>');
                            } else if ($abs_diff[1] == 'Hougang Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
    
    
    
                                echo (' 
                            <div class="card" style="width: 18rem;">');
    
                                echo ('<div class="card-body"style="background-color:red;">
                       
                                <h3 class="card-title">' . $rosters['subject'] . '</h3>
                                <p class="card-text">Room: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                            </div>
                        </div>
                        <br>');
                            } else if ($abs_diff[1] == 'Hougang Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
    
    
    
                                echo ('
                            <div class="card" style="width: 18rem;">');
    
                                echo ('<div class="card-body"style="background-color:orange;">
                                <h3 class="card-title">' . $rosters['subject'] . '</h3>
                                <p class="card-text">Room: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                            </div>
                        </div>
                        <br>');
                            } else if ($abs_diff[1] == 'Hougang Centre' && $rosters['need_relief'] == 'no') {
    
    
    
                                echo ('
                            <div class="card" style="width: 18rem;">');
    
                                echo ('<div class="card-body"style="background-color:white;">
                                <h3 class="card-title">' . $rosters['subject'] . '</h3>
                                <p class="card-text">Room: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                                <p class="card-text"style="font-weight:bold;">Taken! </p>
                            </div>
                        </div>
                        <br>');
                            }
                        }

                    }
                    if(isset($_POST["hi"])){
                        $date =  $_POST["date"];;
                        $roster = mysqli_query($con, "SELECT * FROM roster where date= '$date' ");
                        
                        foreach ($roster as $rosters) {
                            $abs_diff = array();
                            $difference = array();
                            $all_timings = array();
                            $calculated_timings = array();
                            $datediff = array();
                            $earlier = new DateTime(date("Y-m-d"));
                            $later = new DateTime($rosters['date']);
                            $datenow = new DateTime(date("H:i"));
                            $timings = implode('', [$rosters['timing']]);
                            $all_timings = substr($timings, 0, 2);
                            // $calculated_timings =$all_timings *60;
                            // $datediff = $datenow - $calculated_timings;
                            $now = time(); // or your date as well
                            $your_date = strtotime("2022-010-04");
                            $datediff = $now - $your_date;
    
    
                            array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);
    
    
    
    
    
                            if ($abs_diff[1] == 'Hougang Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                                echo ('
                            <div class="card" style="width: 18rem;">');
    
                                echo ('<div class="card-body"style="background-color:yellow;">
                                <h3 class="card-title">' . $rosters['subject'] . '</h3>
                                <p class="card-text">Room: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                            </div>
                        </div>
                        <br>');
                            } else if ($abs_diff[1] == 'Hougang Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
    
    
    
                                echo (' 
                            <div class="card" style="width: 18rem;">');
    
                                echo ('<div class="card-body"style="background-color:red;">
                       
                                <h3 class="card-title">' . $rosters['subject'] . '</h3>
                                <p class="card-text">Room: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                            </div>
                        </div>
                        <br>');
                            } else if ($abs_diff[1] == 'Hougang Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
    
    
    
                                echo ('
                            <div class="card" style="width: 18rem;">');
    
                                echo ('<div class="card-body"style="background-color:orange;">
                                <h3 class="card-title">' . $rosters['subject'] . '</h3>
                                <p class="card-text">Room: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                            </div>
                        </div>
                        <br>');
                            } else if ($abs_diff[1] == 'Hougang Centre' && $rosters['need_relief'] == 'no') {
    
    
    
                                echo ('
                            <div class="card" style="width: 18rem;">');
    
                                echo ('<div class="card-body"style="background-color:white;">
                                <h3 class="card-title">' . $rosters['subject'] . '</h3>
                                <p class="card-text">Room: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                                <p class="card-text"style="font-weight:bold;">Taken! </p>
                            </div>
                        </div>
                        <br>');
                            }
                        }
                    }
                   




                    ?>




                </div>
                <div class="col-lg-2 text-center">
                    <a href="roster.php?name=sengkang" title="Click To See Roster">
                        <h3>Sengkang</h3>
                    </a>
                    <?php foreach ($roster as $rosters) {
                        $abs_diff = array();
                        $difference = array();
                        $earlier = new DateTime(date("Y-m-d"));
                        $later = new DateTime($rosters['date']);
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);


                        if ($abs_diff[1] == 'Sengkang Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {




                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Sengkang Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Sengkang Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Sengkang Centre' && $rosters['need_relief'] == 'no') {
                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                            <p class="card-text"style="font-weight:bold;">Taken! </p>
                        </div>
                    </div>
                    <br>');
                        }
                    }




                    ?>

                </div>
                <div class="col-lg-2 text-center">
                    <a href="roster.php?name=punggol" title="Click To See Roster">
                        <h3>Punggol</h3>
                    </a>
                    <?php foreach ($roster as $rosters) {
                        $abs_diff = array();
                        $difference = array();
                        $earlier = new DateTime(date("Y-m-d"));
                        $later = new DateTime($rosters['date']);
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($abs_diff[1] == 'Punggol Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Punggol Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Punggol Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Punggol Centre' && $rosters['need_relief'] == 'no') {
                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                            <p class="card-text"style="font-weight:bold;">Taken! </p>
                        </div>
                    </div>
                    <br>');
                        }
                    }




                    ?>
                </div>
                <div class="col-lg-2 text-center">
                    <a href="roster.php?name=fernvale" title="Click To See Roster">
                        <h3>Fernvale</h3>
                    </a>
                    <?php foreach ($roster as $rosters) {
                        $abs_diff = array();
                        $difference = array();
                        $earlier = new DateTime(date("Y-m-d"));
                        $later = new DateTime($rosters['date']);
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($abs_diff[1] == 'Fernvale Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Fernvale Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Fernvale Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {


                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Fernvale Centre' && $rosters['need_relief'] == 'no') {
                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                            <p class="card-text"style="font-weight:bold;">Taken! </p>
                        </div>
                    </div>
                    <br>');
                        }
                    }




                    ?>
                </div>
                <div class="col-lg-2 text-center">
                    <a href="roster.php?name=teck-ghee" title="Click To See Roster">
                        <h3>Teck Ghee</h3>
                    </a>
                    <?php foreach ($roster as $rosters) {
                        $abs_diff = array();
                        $difference = array();
                        $earlier = new DateTime(date("Y-m-d"));
                        $later = new DateTime($rosters['date']);
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($abs_diff[1] == 'Teck Ghee Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Teck Ghee Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Teck Ghee Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Teck Ghee Centre' && $rosters['need_relief'] == 'no') {
                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                            <p class="card-text"style="font-weight:bold;">Taken! </p>
                        </div>
                    </div>
                    <br>');
                        }
                    }




                    ?>
                </div>
                <div class="col-lg-2 text-center">
                    <a href="roster.php?name=Kolam-Ayer" title="Click To See Roster">
                        <h3>Kolam Ayer</h3>
                    </a>
                    <?php foreach ($roster as $rosters) {
                        $abs_diff = array();
                        $difference = array();
                        $earlier = new DateTime(date("Y-m-d"));
                        $later = new DateTime($rosters['date']);
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($abs_diff[1] == 'Kolam Ayer Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Kolam Ayer Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Kolam Ayer Centre' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {



                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                        </div>
                    </div>
                    <br>');
                        } else if ($abs_diff[1] == 'Kolam Ayer Centre' && $rosters['need_relief'] == 'no') {
                            echo ('
                        <div class="card" style="width: 18rem;">');

                            echo ('<div class="card-body"style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Date: ' . $rosters['date'] . '</p>
                            <p class="card-text"style="font-weight:bold;">Taken! </p>
                        </div>
                    </div>
                    <br>');
                        }
                    }




                    ?>
                </div>
            </div>




            <div class="modal fade bd-example-modal-lg" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog mw-100 w-50" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="font-size:20px;">Add Centre Roster </h5>


                        </div>

                        <form method="POST" enctype="multipart/form-data" autocomplete="off">

                            <div class="modal-body" style="font-size:20px;">
                                <div class="form-group">
                                    <label>Name Of Teacher </label>
                                    <select class="form-select" style="height:50px;font-size:20px;" required name="teacher_name">
                                        <option selected>Choose Teacher</option>
                                        <?php foreach ($teacher as $teachers) : ?>
                                            <option value="<?php echo $teachers["username"] ?>"><?php echo $teachers["username"] ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label>Centre </label>
                                    <select class="form-select" style="height:50px;font-size:20px;" required name="centre">
                                    <option selected>Choose Centre</option>

                                    <option value="Hougang Centre">Hougang Centre</option>
                                    <option value="Sengkang Centre">Sengkang Centre</option>
                                    <option value="Punggol Centre">Punggol Centre</option>
                                    <option value="Fernvale Centre">Fernvale Centre</option>
                                    <option value="Teck Ghee Centre">Teck Ghee Centre</option>
                                    <option value="Kolam Ayer Centre">Kolam Ayer Centre</option>

                                </select>
                                </div>
                                <div class="form-group">
                                <label>Level* </label>
                                <select class="form-select" style="height:50px;font-size:20px;" required name="level">
                                    <option selected>Choose Level</option>

                                    <option value="P1">P1</option>
                                    <option value="P2">P2</option>
                                    <option value="P3">P3</option>
                                    <option value="P4">P4</option>
                                    <option value="P5(N)">P5(N)</option>
                                    <option value="P5(F)">P5(F)</option>
                                    <option value="P6(N)">P6(N)</option>
                                    <option value="P6(F)">P6(F)</option>

                                </select>
                            </div>
                                <div class="form-group">
                                    <label> Class Subject </label>
                                    <select class="form-select" style="height:50px;font-size:20px;" required name="subject">
                                        <option selected>Subject</option>

                                        <option value="Math" name="subject">Math</option>
                                        <option value="Science" name="subject">Science</option>
                                        <option value="English" name="subject">English</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label> Day Of The Week </label>

                                    <select class="form-select" style="height:50px;font-size:20px;" name="day" required>
                                        <option selected>Choose Day</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label> Date </label>

                                    <input type="date" class="form-control" style="height:50px;font-size:20px;  " id="staticEmail" name="date">


                                </div>

                                <div class="form-group">
                                    <label> Timing Of The Class </label>

                                    <select class="form-select" style="height:50px;font-size:20px;" name="timing" required>
                                        <option selected>Timing</option>
                                        <option value="1pm - 3pm" name="timing">1-3pm</option>
                                        <option value="2pm - 4pm" name="timing">2-4pm</option>
                                        <option value="4pm - 6pm" name="timing">4-6pm</option>
                                        <option value="7pm - 8pm" name="timing">7-8pm</option>
                                        <option value="8pm - 9pm" name="timing">8-9pm</option>
                                        <option value="9pm - 10pm" name="timing">9-10pm</option>

                                    </select>
                                </div>





                                <div class="form-group">
                                    <label> Room </label>
                                    <select class="form-select" style="height:50px;font-size:20px;" name="room" required>
                                        <option selected>Class Number</option>
                                        <option value="Class 1" name="room">Class 1</option>
                                        <option value="Class 2" name="room">Class 2</option>
                                        <option value="Class 3" name="room">Class 3</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label> Students </label>


                                    <textarea type="text" class="form-control" id="staticEmail" name="students"></textarea>

                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="submit" class="btn btn-primary">Add Roster</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>


        </div>







    </body>


</html>