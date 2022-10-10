<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'website');


        $id = $_POST['update_id'];
        
        $centre_name = $_POST['centre_name'];

        $query = "UPDATE student SET centre_name='$centre_name' WHERE student_name='$id'  ";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:studentlist.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
?>