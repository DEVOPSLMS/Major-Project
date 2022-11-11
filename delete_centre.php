<?php 
include("connection.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql = ("DELETE FROM centre  WHERE id = $id ");
    $result=mysqli_query($con,$sql);
    if($result){
        echo'<script>alert("Deleted notification.")</script>';
        header("Location: centreroster.php");
    }else{
        die(mysqli_error($con));
    }
}
?>