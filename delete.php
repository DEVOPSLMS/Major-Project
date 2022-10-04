<?php
include('connection.php');
if(isset($_POST["id"]))
{
    $id = $_POST['id'];
    $sql = "DELETE FROM events WHERE id = $id"; 
    $con->query($sql);
}   
?>