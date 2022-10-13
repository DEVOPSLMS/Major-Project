<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");

$user_data = check_login($con);
$username = $user_data['username'];
date_default_timezone_set('Singapore');
?>
<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Home Page</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<header>
    <?php include("header.php") ?>


</header>
<br><br><br><br><br><br><br><br><br><br><br><br><br>


<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                
                <form method="POST" class="form">

                    <h3>Filter By Date: <input class="form-control"style="height:50px;font-size:20px;width:20%;" type="date" name="date" required id="date">
                        <h3>Filter By Centre: <select class="form-control" style="height:50px;font-size:20px;width:20%;" required name="centre">
                                <option selected>Choose Centre</option>
                                <option value="Hougang Centre">Hougang Centre</option>
                                <option value="Sengkang Centre">Sengkang Centre</option>
                                <option value="Punggol Centre">Punggol Centre</option>
                                <option value="Fernvale Centre">Fernvale Centre</option>
                                <option value="Teck Ghee Centre">Teck Ghee Centre</option>
                                <option value="Kolam Ayer Centre">Kolam Ayer Centre</option>

                            </select>
                            <button class="btn btn-primary" type="submit"  name="hi">Filter</button>
                            <br>
                </form>
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
        <?php 
                    if(!isset($_POST["hi"])){
                        $date = date("Y-m-d");
                        $roster = mysqli_query($con, "SELECT * FROM roster where date= '$date'and teacher_name='$username' ");
                        
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
    
    
    
    
    
                            if ($rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                                echo ('
                            <div class="card" style="width: 18rem;">');
    
                                echo ('<div class="card-body"style="background-color:yellow;">
                                <a href="lesson_details.php?id='.$rosters['id'].'"><h3 class="card-title"title="See Lesson Details">' .$rosters['level'].' '. $rosters['subject'] . '</h3></a>
                                <p class="card-text">Class: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                                <p class="card-text"style="text-transform: capitalize;">Centre Name: ' . $rosters['centre_name'] . '</p>
                            </div>
                        </div>
                        <br>');
                            } else if ($rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
    
    
    
                                echo (' 
                            <div class="col-lg-12 card text-center" style="width: 18rem;margin:auto;">');
    
                                echo ('<div class="card-body"style="background-color:red;">
                       
                                <a href="lesson_details.php?id='.$rosters['id'].'"><h3 class="card-title"title="See Lesson Details">' .$rosters['level'].' '. $rosters['subject'] . '</h3></a>
                                <p class="card-text">Class: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                                <p class="card-text"style="text-transform: capitalize;">Centre Name: ' . $rosters['centre_name'] . '</p>
                            </div>
                        </div>
                        <br>');
                            } else if ($rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
    
    
    
                                echo ('
                            <div class="col-lg-12 card text-center" style="width: 18rem;margin:auto;">');
    
                                echo ('<div class="card-body"style="background-color:orange;">
                                <a href="lesson_details.php?id='.$rosters['id'].'"><h3 class="card-title"title="See Lesson Details">' .$rosters['level'].' '. $rosters['subject'] . '</h3></a>
                                <p class="card-text">Class: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                                <p class="card-text"style="text-transform: capitalize;">Centre Name: ' . $rosters['centre_name'] . '</p>
                            </div>
                        </div>
                        <br>');
                            } else if ($rosters['need_relief'] == 'no') {
    
    
    
                                echo ('
                            <div class="col-lg-12 card text-center" style="width: 18rem;margin:auto;">');
    
                                echo ('<div class="card-body"style="background-color:white;">
                                <a href="lesson_details.php?id='.$rosters['id'].'"><h3 class="card-title"title="See Lesson Details">' .$rosters['level'].' '. $rosters['subject'] . '</h3></a>
                                <p class="card-text">Class: ' . $rosters['room'] . '</p>
                   
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                
                                
                                <p class="card-text" style="text-transform: capitalize;">Centre Name: ' . $rosters['centre_name'] . '</p>
                            </div>
                        </div>
                        <br>');
                            }
                        }

                    }
                    if(isset($_POST["hi"])){
                        $date =  $_POST["date"];
                        $centre =  $_POST["centre"];
                        $roster = mysqli_query($con, "SELECT * FROM roster where date= '$date'and centre_name ='$centre'and teacher_name='$username' ");
                        
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
    
    
    
    
    
                            if ($rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                                echo ('
                            <div class="col-lg-12 card text-center" style="width: 18rem;margin:auto;">');
    
                                echo ('<div class="card-body"style="background-color:yellow;">
                                <a href="lesson_details.php?id='.$rosters['id'].'"><h3 class="card-title"title="See Lesson Details">' .$rosters['level'].' '. $rosters['subject'] . '</h3></a>
                                <p class="card-text">Class: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                                <p class="card-text"style="text-transform: capitalize;">Centre Name: ' . $rosters['centre_name'] . '</p>
                            </div>
                        </div>
                        <br>');
                            } else if ($rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
    
    
    
                                echo (' 
                            <div class="col-lg-12 card text-center" style="width: 18rem;margin:auto;">');
    
                                echo ('<div class="card-body"style="background-color:red;">
                       
                                <a href="lesson_details.php?id='.$rosters['id'].'"><h3 class="card-title"title="See Lesson Details">' .$rosters['level'].' '. $rosters['subject'] . '</h3></a>
                                <p class="card-text">Class: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                                <p class="card-text"style="text-transform: capitalize;">Centre Name: ' . $rosters['centre_name'] . '</p>
                            </div>
                        </div>
                        <br>');
                            } else if ($rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
    
    
    
                                echo ('
                            <div class="col-lg-12 card text-center" style="width: 18rem;margin:auto;">');
    
                                echo ('<div class="card-body"style="background-color:orange;">
                                <a href="lesson_details.php?id='.$rosters['id'].'"><h3 class="card-title"title="See Lesson Details">' .$rosters['level'].' '. $rosters['subject'] . '</h3></a>
                                <p class="card-text">Class: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text">Date: ' . $rosters['date'] . '</p>
                                <p class="card-text"style="text-transform: capitalize;">Centre Name: ' . $rosters['centre_name'] . '</p>
                            </div>
                        </div>
                        <br>');
                            } else if ($rosters['need_relief'] == 'no') {
    
    
    
                                echo ('
                            <div class="col-lg-12 card text-center" style="width: 18rem;margin:auto;">');
    
                                echo ('<div class="card-body"style="background-color:white;">
                                <a href="lesson_details.php?id='.$rosters['id'].'"><h3 class="card-title"title="See Lesson Details">' .$rosters['level'].' '. $rosters['subject'] . '</h3></a>
                                <p class="card-text">Class: ' . $rosters['room'] . '</p>
                                <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                                <p class="card-text"style="text-transform: capitalize;">Date: ' . $rosters['date'] . '</p>
                             
                                <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                            </div>
                        </div>
                        <br>');
                            }
                        }
                    }
                   




                    ?>

            
            </div>
     

    </div>


</body>

</html>