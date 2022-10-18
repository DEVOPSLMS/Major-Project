<?php 

include("connection.php");




$teacher = mysqli_query($con, "SELECT * FROM user where role='teacher'");

foreach($teacher as $t){
    $id=$t['id'];
    $teacher_name=$t['username'];
    $leave = mysqli_query($con, "SELECT * FROM submit_leave_teacher where teacherid='$id'order by id desc");
    $teacher_leave = mysqli_fetch_assoc($leave);
    $date=date('Y-m-d');
    $rows=mysqli_num_rows($leave);
    if($rows > 0){
        if($teacher_leave['date_start']<=$date && $teacher_leave['date_end'] >= $date){
            $sql = "UPDATE `user` SET `status`='sick' WHERE id=$id";
            mysqli_query($con, $sql);
            $roster = mysqli_query($con, "SELECT * FROM roster where teacher_name='$teacher_name'");
            foreach($roster as $r){
                $r_id=$r['id'];
                if($r['date'] >=$teacher_leave['date_start']&&$r['date'] <=$teacher_leave['date_end'] &&$r['cancelled']=='no'){
                    $query = "UPDATE `roster` SET `need_relief`='yes' WHERE id=$r_id";
                    mysqli_query($con, $query);
                }
            }
        }
        else{
            $sql = "UPDATE `user` SET `status`='present' WHERE id=$id";
            mysqli_query($con, $sql);
        }
    }
}






    ?>