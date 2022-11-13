<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
$user_data = check_login($con);
include("insert-payslip.php");
include("check_attendance.php");
include("check_recurring_roster.php");
// remove  OR status = 'Enrolled' OR status = 'Disapproved' when done 
include("add_level.php");
include("check_withdrawl.php");

if ($user_data['role'] != 'admin') {
    header('HTTP/1.0 403 Forbidden');
    exit;
}



?>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Enrollment Review</title>

</head>
<header>


    <?php include("header.php") ?>

  

</header>

<body>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
   
    <h2 class="text-center"><b>Enrollment Review</b></h2>
    <br><br>

    <div>
        <div>
            <!-- insert if no reviews scenario -->

            <h3 id="text-message" class="text-center" style="color: red;">There are currently no enrollments</h3>

            <table id="enrollment-table">
                <tr style="border-bottom: 1px grey solid">
                    <td class="col-sm-2"></td>
                    <td class="col-sm-4">
                        <h3>Status</h3>
                    </td>
                </tr>
                <?php $query = "SELECT * FROM student WHERE status = 'Pending Interview' OR status = 'Pending Approval'";
                $result = mysqli_query($con, $query);
                $rowcount = mysqli_num_rows($result); 
                if ($rowcount == 0) {
                    echo
                    "<style>
                            #enrollment-table{
                                display: none;
                            }
                            #text-message{
                                display: block;
                            }
                        </style>";
                } else {
                    echo
                    "<style>
                            #text-message{
                                display: none;
                            }
                          
                        </style>";
                }
                ?>
                <?php foreach ($result as $x) : ?>

                    <?php
                    $xId = $x["id"];
                    $xStudentName = $x["student_name"];
                    ?>

                    <tr style='border-bottom: 1px grey solid; padding-top:10px; padding-bottom:20px;'>
                        <td class="col-sm-2">
                            <h4 style='margin-left: 30px;'><b><?php echo $xStudentName ?></b></h4>
                        </td>


                        <td class="col-sm-5">

                            <h4><?php echo $x["status"] ?></h4>
                        </td>


                        <td class="col-sm-5">
                            <form method="POST">
                                <a type='button' href='enrollment_details.php?studentid=<?php echo $xId ?>' class='btn btn-primary' style='margin: 5px;'>View Details</a>
                                <?php
                                if (isset($_POST["approve$xId"])) {

                                    $editQuery = "UPDATE `student` SET `status` = 'Enrolled' WHERE id = $xId";

                                    mysqli_query($con, $editQuery);
                                    $parentid = $x['parentid'];
                                    $student_name = $x['student_name'];
                                    $sql = "insert into notification(parentid,student_name,notification,status,seen) values ('$parentid','$student_name','approved','approve','0')";
                                    mysqli_query($con, $sql);
                                    echo
                                    "<script>
                                        alert('Enrolled $xStudentName!');
                                        document.location.href = 'enrollment_review.php';
                                    </script>";
                                }
                                if (isset($_POST["disapprove$xId"])) {

                                    $editQuery = "UPDATE `student` SET `status` = 'Disapproved' WHERE id = $xId";

                                    mysqli_query($con, $editQuery);
                                    $parentid = $x['parentid'];
                                    $student_name = $x['student_name'];
                                    $sql = "insert into notification(parentid,student_name,notification,status,seen) values ('$parentid','$student_name','disapproved','disapprove','0')";
                                    mysqli_query($con, $sql);
                                    echo
                                    "<script>
                                        alert('Disapproved $xStudentName!');
                                        document.location.href = 'enrollment_review.php';
                                    </script>";
                                }

                                ?>
                                <button type='submit' name="approve<?php echo $xId ?>" class='btn btn-primary' style='margin: 5px;'>Approve</button>
                                <button type='submit' name="disapprove<?php echo $xId ?>" class='btn btn-primary' style='margin: 5px;'>Disapprove</button>
                            </form>

                        </td>


                    </tr>
                <?php endforeach; ?>


            </table>

        </div>


    </div>



</body>


<style>
    table {
        width: 100%;
    }
</style>

</html>