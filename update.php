<?php
include('connection.php');
if(isset($_POST["id"]))
{
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $id = $_POST['id'];
    $sql = "UPDATE events SET title='$title', start_event='$start', end_event='$end' WHERE id = $id"; 
    $con->query($sql); 
}
?>