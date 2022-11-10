<?php



include("connection.php");


if($_GET['id']){
    $id = $_GET['id'];
    $query = "DELETE FROM recurring WHERE id= '$id'";
    echo 
    '<script> 
    if(confirm("Are you sure you want to delete this lesson?")){',

        mysqli_query($con, $query),
        'alert("Successfully deleted lesson!")',

        // sleep(3),
        header("Location: recurring_roster.php"),
            
    
    '} else{
        alert("error");
    }
    </script>';    
}
?>

