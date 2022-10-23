<?php 
include("connection.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql = ("UPDATE  payslip SET `status`='true' WHERE id = $id ");
    $result=mysqli_query($con,$sql);
    $query = "select * from payslip where id = '$id' ";
    $payslip = mysqli_query($con, $query);
    $details=mysqli_fetch_assoc($payslip);
    if($result){
        $username=$details['teacher_name'];
        $about=$details['month'].' '.$details['year'];
        $query = "insert into notification_teacher(teacher_name,status,seen,about) values ('$username','payslip','0','$about')";

        mysqli_query($con, $query);
        echo'<script>alert("Updated Payslip.")</script>';
        header("Location: payslip.php");
    }else{
        die(mysqli_error($con));
    }
}
?>