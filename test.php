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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<script>
$(document).ready(function() {
    ajax();
});
function ajax(){
    $.ajax({
        url : 'test.php',
        type : 'POST',
        data : $('#hidden-form').serialize(),
        success: function() {
            alert('form was submitted');
        }
    });
    return false;
};

</script>
<body>


 
<form method="POST">
  <input name="name" placeholder="Name" />
  <input name="phone" type="tel" placeholder="Phone" />

  <input name="submit" type="submit" />
</form>

</body>

</html>

