<?php
include("connection.php");

$id = $_GET["id"];
$primary = $_GET["primary"];

mysqli_query($con, "UPDATE student SET student_level='P5(F)' WHERE id= '$id'");
if($primary == null){
    header("Location: studentlistp5.php");
}else{
    header("Location: studentlistp5.php?primary=$primary");
}
?>