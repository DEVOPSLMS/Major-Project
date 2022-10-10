<?php 
include("connection.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql = ("DELETE FROM notification  WHERE parentid = $id and status='late'");
    $result=mysqli_query($con,$sql);
    if($result){
        echo'<script>alert("Deleted notification.")</script>';
        header("Location: notification.php");
    }else{
        die(mysqli_error($con));
    }
}
?>