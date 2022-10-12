<?php
session_start();

include("connection.php");
include("functions.php");
date_default_timezone_set('Singapore');
error_reporting(E_ERROR | E_PARSE);
$user_data = check_login($con);
$date = (date("Y-m-d"));
$name = $user_data['username'];
$day = date('l', strtotime($date));


?>

<!DOCTYPE html>
<html>

<head>
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
</head>
<header>
    <header class="header">

        <?php include("header.php") ?>

    </header>
</header>
<br><br><br><br><br><br><br><br><br><br>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">

                <form method="POST" class="form">

                    <h3>Filter By Date: <input type="date" name="date" required id="date">
                        <h3>Filter By Centre: <select class="form-select" style="height:50px;font-size:20px;width:20%;" required name="centre">
                                <option selected>Choose Centre</option>
                                <option value="Hougang Centre">Hougang Centre</option>
                                <option value="Sengkang Centre">Sengkang Centre</option>
                                <option value="Punggol Centre">Punggol Centre</option>
                                <option value="Fernvale Centre">Fernvale Centre</option>
                                <option value="Teck Ghee Centre">Teck Ghee Centre</option>
                                <option value="Kolam Ayer Centre">Kolam Ayer Centre</option>

                            </select>
                            <button class="btn btn-primary" type="submit" name="hi">Filter</button>
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
    </div>
   

    <?php if (!isset($_POST["hi"])) { ?>
        <?php if ($day == 'Monday' || $day == 'Tuesday' || $day == 'Wednesday' || $day == 'Thursday' || $day == 'Friday') { $roster = mysqli_query($con, "SELECT * FROM roster where date= '$date'and teacher_name='$name' ");?>
            <div class="row">
                <div class="col-lg-2 p-5">
                    <h2>Level</h2>
                </div>
                <div class="col-lg-2 p-5">
                    <h2>7pm</h2>
                </div>
                <div class="col-lg-2 p-5">
                    <h2>8pm</h2>
                </div>
                <div class="col-lg-2 p-5">
                    <h2>9pm</h2>


                </div>
                <div class="col-lg-2 p-5">
                    <h2>10pm</h2>

                </div>
                <hr>

            </div>






            <div class="col-lg-12 p-5">

                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P1</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);
                        
                        if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                            </div>
                            <div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>

                </div>


            </div>

            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P2</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-2 p-3">
                            </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-2 p-3">
                            </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>
                </div>

            </div>
            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P3</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-2 p-3">
                            </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-4 p-3">
                            </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>
                </div>

            </div>
            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P4</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3width:100%;">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('
                            
                            div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>
                </div>

            </div>
            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P5(N)</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo (
                                
                                '<div class="col-lg-4 p-3">
                                </div>
                                <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-2 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>
                </div>

            </div>
            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P5(F)</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                            </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                            </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>
                </div>

            </div>
            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P6(N)</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>

                </div>

            </div>
            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P6(F)</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                            <p class="card-text">Centre Name: ' . $rosters['centre_name'] . '</p>
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>
                </div>

            </div>
        <?php } ?>
        <?php if ($day == 'Saturday' || $day == 'Sunday') { $roster = mysqli_query($con, "SELECT * FROM roster where date= '$date'and teacher_name='$name' ");?>
        
        <div class="row">
            <div class="col-lg-1 p-5">
                <h2>Level</h2>
            </div>
            <div class="col-lg-1 p-5">
                <h2>1pm</h2>
            </div>
            <div class="col-lg-1 p-5">
                <h2>2pm</h2>
            </div>
            <div class="col-lg-1 p-5">
                <h2>3pm</h2>
            </div>
            <div class="col-lg-1 p-5">
                <h2>4pm</h2>

            </div>
            <div class="col-lg-1 p-5">
                <h2>5pm</h2>

            </div>
            <div class="col-lg-1 p-5">
                <h2>6pm</h2>

            </div>
            <div class="col-lg-1 p-5">
                <h2>7pm</h2>

            </div>
            <div class="col-lg-1 p-5">
                <h2>8pm</h2>

            </div>
            <div class="col-lg-1 p-5">
                <h2>9pm</h2>

            </div>
            <div class="col-lg-1 p-5">
                <h2>10pm</h2>

            </div>
            <hr>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P1</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P1' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P1' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P1' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P2</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P1' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P2' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P2' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P3</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P1' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P3' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P3' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P4</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P4' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P4' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P4' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P5(N)</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P5(F)</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P6(N)</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P6(F)</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
    <?php } ?>
    <?php } ?>
    <?php 
    
    if (isset($_POST["hi"])) {  $date = $_POST['date'];
        $centre = $_POST['centre'];
        $day = date('l', strtotime($date));?>
        
       
        

        <?php if ($day == 'Monday' || $day == 'Tuesday' || $day == 'Wednesday' || $day == 'Thursday' || $day == 'Friday') { $roster = mysqli_query($con, "SELECT * FROM roster where date= '$date'and teacher_name='$name'and centre_name='$centre' ");?>
            <div class="row">
                <div class="col-lg-2 p-5">
                    <h2>Level</h2>
                </div>
                <div class="col-lg-2 p-5">
                    <h2>7pm</h2>
                </div>
                <div class="col-lg-2 p-5">
                    <h2>8pm</h2>
                </div>
                <div class="col-lg-2 p-5">
                    <h2>9pm</h2>


                </div>
                <div class="col-lg-2 p-5">
                    <h2>10pm</h2>

                </div>
                <hr>

            </div>






            <div class="col-lg-12 p-5">

                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P1</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                            </div>
                            <div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>

                </div>


            </div>

            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P2</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-2 p-3">
                            </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-2 p-3">
                            </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>
                </div>

            </div>
            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P3</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-2 p-3">
                            </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-4 p-3">
                            </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>
                </div>

            </div>
            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P4</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3width:100%;">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('
                            
                            div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>
                </div>

            </div>
            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P5(N)</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo (
                                
                                '<div class="col-lg-4 p-3">
                                </div>
                                <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-2 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>
                </div>

            </div>
            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P5(F)</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                            </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                            </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>
                </div>

            </div>
            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P6(N)</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>

                </div>

            </div>
            <div class="col-lg-12 p-5">
                <div class="row">
                    <div class="col-lg-2 p-4">
                        <h2>P6(F)</h2>
                    </div>
                    <?php foreach ($roster as $rosters) {
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
                        $time_now = (date("H:i:s"));

                        $to_time = strtotime($rosters['time']);

                        $from_time = strtotime($time_now);
                        $time = round($to_time - $from_time) / 60;

                        $total_time = round(abs($to_time - $time_now) / 60);

                        $id = $rosters['id'];
                        array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                        if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('<div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-2 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-2 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                        if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                            echo ('<div class="col-lg-4 p-3">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                            echo ('
                            <div class="col-lg-4 p-3">
                    </div>
                            <div class="col-lg-3 p-3">

                    <div class="card" style="width: 100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                        }
                    }


                    ?>
                </div>

            </div>
        <?php } ?>
        <?php if ($day == 'Saturday' || $day == 'Sunday') { $roster = mysqli_query($con, "SELECT * FROM roster where date= '$date'and teacher_name='$name'and centre_name='$centre' ");?>
        
        <div class="row">
            <div class="col-lg-1 p-5">
                <h2>Level</h2>
            </div>
            <div class="col-lg-1 p-5">
                <h2>1pm</h2>
            </div>
            <div class="col-lg-1 p-5">
                <h2>2pm</h2>
            </div>
            <div class="col-lg-1 p-5">
                <h2>3pm</h2>
            </div>
            <div class="col-lg-1 p-5">
                <h2>4pm</h2>

            </div>
            <div class="col-lg-1 p-5">
                <h2>5pm</h2>

            </div>
            <div class="col-lg-1 p-5">
                <h2>6pm</h2>

            </div>
            <div class="col-lg-1 p-5">
                <h2>7pm</h2>

            </div>
            <div class="col-lg-1 p-5">
                <h2>8pm</h2>

            </div>
            <div class="col-lg-1 p-5">
                <h2>9pm</h2>

            </div>
            <div class="col-lg-1 p-5">
                <h2>10pm</h2>

            </div>
            <hr>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P1</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P1' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P1' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P1' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P1' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P2</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P1' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P2' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P2' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P2' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P3</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P3' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P3' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P3' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P3' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P4</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P4' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P4' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P4' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P4' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P5(N)</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P5(F)</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P5(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P6(N)</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(N)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
        <div class="col-lg-12 p-5">
            <div class="row">
                <div class="col-lg-1 p-4" style="margin-top:25px;">
                    <h2>P6(F)</h2>
                </div>
               

                <?php foreach ($roster as $rosters) {
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
                    $time_now = (date("H:i:s"));

                    $to_time = strtotime($rosters['time']);

                    $from_time = strtotime($time_now);
                    $time = round($to_time - $from_time) / 60;

                    $total_time = round(abs($to_time - $time_now) / 60);

                    $id = $rosters['id'];
                    array_push($abs_diff, $later->diff($earlier)->format("%a"), $rosters['centre_name']);

                    if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '13:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('<div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-1 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-1 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '14:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-1 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-3 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-3 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '16:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-3 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;width:100%;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }

                    if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-6 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-6 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '19:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-6 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-3 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-7 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-7 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '20:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-7 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'no') {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-3 p-5" >

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:white;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 2) {
                        echo ('<div class="col-lg-8 p-5">
                        </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:orange;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] <= 1) {
                        echo ('<div class="col-lg-8 p-5">
                    </div>
                    <div class="col-lg-8 p-3">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:red;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    } else if ($rosters['level'] == 'P6(F)' && $rosters['time'] == '21:00:00' && $rosters['need_relief'] == 'yes' && $abs_diff[0] > 2) {
                        echo ('
                        <div class="col-lg-8 p-5">
                    </div>
                        <div class="col-lg-3 p-5">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center" style="background-color:yellow;">
                            <h3 class="card-title">' . $rosters['subject'] . '</h3>
                            <p class="card-text">Room: ' . $rosters['room'] . '</p>
                            <p class="card-text">Timing: ' . $rosters['timing'] . '</p>
                           
                        </div>
                    </div>
        
                </div>');
                    }
                    
                }


                ?>

            </div>

        </div>
    <?php } ?>




        


    <?php } ?>

</body>





</html>