<?php
include('connection.php');
    $date = date("Y-m-d");
    $roster = mysqli_query($con, "SELECT * FROM roster ");   
    error_reporting(E_ERROR | E_PARSE);
foreach ($roster as $rosters) {
           
    $abs_diff = array();
    $difference = array();
    $all_timings = array();
    $calculated_timings = array();
    $datediff = array();
    $earlier =   strtotime(date("Y-m-d H:i:s"));
    $roster_time= $rosters['date'] . ' ' . $rosters['time'] ;

    $later =  strtotime(date($roster_time));
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
    $time=round($to_time -$from_time )/60;
 
    $total_time = round(abs($to_time - $time_now) / 60);
    
    $id = $rosters['id'];
   
   $diff=round($later-$earlier)/86400;


   
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>


</head>



<?php
// Given password


?>

<body>

 
</body>

</html>