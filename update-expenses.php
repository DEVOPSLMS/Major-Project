<?php 
include("connection.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql = ("UPDATE  expenses SET `status`='true' WHERE id = $id ");
    $result=mysqli_query($con,$sql);
    $query = "select * from expenses where id = '$id' ";
    $payslip = mysqli_query($con, $query);
    $details=mysqli_fetch_assoc($payslip);
    if($result){
        $username=$details['name'];
        $date=$details['date'];
        $query = "insert into notification_teacher(teacher_name,status,seen,date) values ('$username','expenses','0','$date')";

        mysqli_query($con, $query);
        echo'<script>alert("Updated Expenses.")</script>';
        header("Location: expenses.php");
    }else{
        die(mysqli_error($con));
    }
}
?>