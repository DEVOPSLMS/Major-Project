<?php
include("connection.php");
$date = date("Y-m-d");
$query = "select * from withdrawl where last_day >='$date'";
$result = mysqli_query($con, $query);
$query3 = "select * from recurring";
$result3 = mysqli_query($con, $query3);
foreach ($result as $a) {
    $string=$a['student_name'];
 
    if ($a['last_day'] == $date) {
        $student_name = $a['student_name'];
        $sql = ("UPDATE  student SET `status`='Withdrawn' WHERE student_name = '$student_name' ");
   
        mysqli_query($con, $sql);
        foreach($result3 as $r){
            $id3=$r['id'];
            $arr = array();
            $student_recurring = explode(",", $r['students']);
            foreach($student_recurring as $c){
                if ($c == "$string") {
                    continue;
                } else {
                    $arr[] = $c;
                }
            }
            $new_recurring_students=implode(",",$arr);
            $sql2 = ("UPDATE  recurring SET `students`='$new_recurring_students' WHERE id = '$id3' ");
                mysqli_query($con, $sql2);
        }
    }

    $last = $a['last_day'];
    $query2 = "select * from roster where date >='$last'";
    $result2 = mysqli_query($con, $query2);
    foreach ($result2 as $b) {
       
        $id2=$b['id'];
        $student = explode(",", $b['students']);
        $new_arr = array();
        
        foreach ($student as $value) {
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
