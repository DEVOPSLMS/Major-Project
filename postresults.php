<?php
    $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection, 'website');

        $id = $_POST['update_id'];
        
        $student_name = $_POST['student_name'];
        $level = $_POST['level'];
        $centre_name = $_POST['centre_name'];
        $subject = $_POST['subject'];
        $al = $_POST['al'];

        $query = "INSERT INTO student_results SET student_name='$student_name', level='$level', centre='$centre_name', subject='$subject', achievement_level='$al'  ";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:submit_results.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
?>