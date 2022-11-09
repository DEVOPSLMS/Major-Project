<?php 
include("connection.php");
date_default_timezone_set('Singapore');

$roster = mysqli_query($con, "SELECT * FROM roster ");
$now=date('Y-m-d H:i:s');

foreach($roster as $rosters){
    $id=$rosters['id'];
    $date = $rosters['date'] . ' ' . $rosters['time'] .'';
    $student=$rosters['student'];
   
    if($now > $date && $rosters['need_relief']=='yes' ){
        $sql = "UPDATE `roster` SET `cancelled`='yes'WHERE id=$id";
        mysqli_query($con, $sql);
    }
    if($student == ''){
        $sql = "UPDATE `roster` SET `cancelled`='yes'WHERE id=$id";
        mysqli_query($con, $sql);
    }
}
    ?>