<?php
include("connection.php");
$sql = "SELECT * FROM student WHERE status='Enrolled'";
$student = mysqli_query($con, $sql);
$date=date("Y-12-1 2200:00:00");
$now=date("Y-m-d H:i:s");


if($date == $now){
    foreach ($student as $a) {
 
        if ($a['student_level'] == 'P4') {
            $id=$a['id'];
            
            $query = "UPDATE student SET `student_level`='P5(N)' WHERE id = '$id' ";
            
            $result = mysqli_query($con, $query);
        }
        else if ($a['student_level'] == 'P5(N)') {
            $id=$a['id'];
            $query = "UPDATE student SET `student_level`='P6(N)' WHERE id = '$id' ";
            $result = mysqli_query($con, $query);
        }
        else if ($a['student_level'] == 'P5(F)') {
            $id=$a['id'];
            $query = "UPDATE student SET `student_level`='P6(F)' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
        else if($a['student_level'] == 'P1')
        {
            $id=$a['id'];
            $new=++$a['student_level'];
            
            $query = "UPDATE student SET `student_level`='$new' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
        else if($a['student_level'] == 'P2')
        {
            $id=$a['id'];
            $new=++$a['student_level'];
            
            $query = "UPDATE student SET `student_level`='$new' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
        else if($a['student_level'] == 'P3')
        {
            $id=$a['id'];
            $new=++$a['student_level'];
            
            $query = "UPDATE student SET `student_level`='$new' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
        else if($a['student_level'] == 'P6(F)')
        {
            $id=$a['id'];
            
            $query = "UPDATE student SET `student_level`='S1(NA)' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
        else if($a['student_level'] == 'S1(NA)')
        {
            $id=$a['id'];
            
            $query = "UPDATE student SET `student_level`='S2(NA)' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
        else if($a['student_level'] == 'S2(NA)')
        {
            $id=$a['id'];
            
            $query = "UPDATE student SET `student_level`='S3(NA)' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
        else if($a['student_level'] == 'S3(NA)')
        {
            $id=$a['id'];
            
            $query = "UPDATE student SET `student_level`='S4(NA)' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
        else if($a['student_level'] == 'S4(NA)')
        {
            $id=$a['id'];
            
            $query = "UPDATE student SET `student_level`='S5(NA)' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
        else if($a['student_level'] == 'P6(N)')
        {
            $id=$a['id'];
            
            $query = "UPDATE student SET `student_level`='S1(E)' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
        else if($a['student_level'] == 'S1(E)')
        {
            $id=$a['id'];
            
            $query = "UPDATE student SET `student_level`='S2(E)' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
        else if($a['student_level'] == 'S2(E)')
        {
            $id=$a['id'];
            
            $query = "UPDATE student SET `student_level`='S3(E)' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
        else if($a['student_level'] == 'S3(E)')
        {
            $id=$a['id'];
            
            $query = "UPDATE student SET `student_level`='S4(E)' WHERE id = '$id'";
            $result = mysqli_query($con, $query);
        }
    
    }
}


?>