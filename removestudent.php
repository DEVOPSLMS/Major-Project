<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'website');

    $id = $_POST['delete_id'];

    $query = "DELETE FROM student WHERE student_name='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:studentlist.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }


?>