<?php
include("connection.php");
$date = date("Y-m-d");
$query = "select * from withdrawl where last_day >'$date'";
$result = mysqli_query($con, $query);
foreach ($result as $a) {
    $string=$a['student_name'];
    if ($a['last_day'] == $date) {
        $id = $a['id'];
        $sql = ("UPDATE  student SET `status`='Withdrawn' WHERE id = '$id' ");
        mysqli_query($con, $sql);
    }

    $last = $a['last_day'];
    $query2 = "select * from roster where date >'$last'";
    $result2 = mysqli_query($con, $query2);
    foreach ($result2 as $b) {
        $id2=$b['id'];
        $students = explode(",", $b['students']);
        $new_arr = array();
        
        foreach ($students as $value) {
            if ($value == "$string") {
                continue;
            } else {
                $new_arr[] = $value;
            }
        }
        $new_students=implode(",",$new_arr);
        $sql = ("UPDATE  roster SET `students`='$new_students' WHERE id = '$id2' ");
            mysqli_query($con, $sql);
    }
 
}
