<?php 

include("connection.php");


$user_id=$_SESSION['user_id'];

$teacher = mysqli_query($con, "SELECT * FROM user where user_id=$user_id");

$teachers = mysqli_fetch_assoc($teacher);
$id=$teachers['id'];
if($teachers['role']=='teacher'){
    
    $roster = mysqli_query($con, "SELECT * FROM submit_leave_teacher where teacherid='$id'order by id desc");
    $teacher_leave = mysqli_fetch_assoc($roster);
    $date=date('Y-m-d');
    $rows=mysqli_num_rows($roster);
    if($rows > 0){
        if($teacher_leave['date_start']<=$date && $teacher_leave['date_end'] >= $date){
            $sql = "UPDATE `user` SET `status`='sick' WHERE id=$id";
            mysqli_query($con, $sql);
        }
        else{
            $sql = "UPDATE `user` SET `status`='present' WHERE id=$id";
            mysqli_query($con, $sql);
        }
    }
   
}   




    ?>