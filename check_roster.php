<?php 
include("connection.php");


$roster = mysqli_query($con, "SELECT * FROM roster ");
$now=date('Y-m-d h:i:s');

foreach($roster as $rosters){
    $id=$rosters['id'];
    $date = $rosters['date'] . ' ' . $rosters['time'] .'';
    if($now > $date && $rosters['need_relief']=='yes' ){
        $sql = "UPDATE `roster` SET `cancelled`='yes'WHERE id=$id";
        mysqli_query($con, $sql);
    }
}
    ?>