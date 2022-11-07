<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("insert-payslip.php");
$user_data = check_login($con);
$student_id = $_GET['studentid'];


$query = "select * from student where id = '$student_id'";
$result = mysqli_query($con, $query);
$student_details = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Enrollment Review</title>

    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<header>
    <header class="header">

        <?php include("header.php") ?>


    </header>
</header>
<br><br><br><br><br><br><br><br><br><br>
<style>
    body {
        font-size: 130%;
    }
</style>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <a class="btn btn-primary" style=" left: 20px;" href="enrollment_review.php">Back</a>
    <br><br>
    <h2 class="text-center" style="border-bottom: 1px grey solid; padding-bottom: 20px;"><b>Enrollment Review</b></h2>
    <button type="button" class="btn btn-primary" style="position: absolute; right: 20px;" data-bs-toggle="modal" data-bs-target="#Modal">
        Medical Declaration Form
    </button>
    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Medical Declaration Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    echo '<table>
                        <tr><td>Date:</td><td>',                                            $student_details["medical_date"], '</td></tr>
                        <tr><td>Any Medical Conditions:</td><td>',                          $student_details["medical_conditions"], '</td></tr>
                        <tr><td>If yes, please explain:</td><td>',                          $student_details["add_here"], '</td></tr>
                        <tr><td>On daily medication to treat/prevent relapse:</td><td>',    $student_details["daily_medication"], '</td></tr>
                        <tr><td>If yes, please explain:</td><td>',                          $student_details["explain_condition"], '</td></tr>
                        <tr><td>Parent/Guardian Name:</td><td>',                            $student_details["medical_name"], '</td></tr>
                        <tr><td>Parent/Guardian NRIC:</td><td>',                            $student_details["medical_nric"], '</td></tr>
                        <tr><td>Translator Name (if any):</td><td>',                        $student_details["translator_name"], '</td></tr>
                        <tr><td>Translator NRIC:</td><td>',                                 $student_details["translator_nric"], '</td></tr>
                        
                        </table>';
                    ?>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>


    <div style="margin: 20px;"><i>
            <h2><b><?php echo $student_details['student_name'] ?></b></h2>
        </i></div>

    <table style="margin-left: 30px;">

        <tr>
            <td>NRIC:</td>
            <td><?php echo $student_details['student_nric'] ?></td>
        </tr>
        <tr>
            <td>Gender:</td>
            <td><?php echo $student_details['student_gender'] ?></td>
        </tr>
        <tr>
            <td>Date of birth:</td>
            <td><?php echo $student_details['student_dob'] ?></td>
        </tr>
        <tr>
            <td>Race:</td>
            <td><?php echo $student_details['student_race'] ?></td>
        </tr>
        <tr>
            <td>Citizenship:</td>
            <td><?php echo $student_details['student_citizenship'] ?></td>
        </tr>
        <tr>
            <td>Nationality (For PR only):</td>
            <td><?php echo $student_details['student_nationality'] ?></td>
        </tr>
        <tr>
            <td>School attending:</td>
            <td><?php echo $student_details['student_school'] ?></td>
        </tr>
        <tr>
            <td>Primary Level:</td>
            <td><?php echo $student_details['student_level'] ?></td>
        </tr>
        <tr>
            <td>Normal/Foundation:</td>
            <td><?php echo $student_details['student_normal_foundation'] ?></td>
        </tr>
        <tr>
            <td>Residential Address:</td>
            <td><?php echo $student_details['student_residential'] ?></td>
        </tr>
        <tr>
            <td>Name of student's bank:</td>
            <td><?php echo $student_details['student_bank'] ?></td>
        </tr>
        <tr>
            <td>Student's account number:</td>
            <td><?php echo $student_details['student_account'] ?></td>
        </tr>

    </table>


    <div style="margin: 20px;"><i>
            <h2><b><?php echo $student_details['father_name'] ?> (Father)</b></h2>
        </i></div>

    <table style="margin-left: 30px;">

        <tr>
            <td>NRIC:</td>
            <td><?php echo $student_details['father_nric'] ?></td>
        </tr>
        <tr>
            <td>Date of birth:</td>
            <td><?php echo $student_details['father_dob'] ?></td>
        </tr>
        <tr>
            <td>Race:</td>
            <td><?php echo $student_details['father_race'] ?></td>
        </tr>
        <tr>
            <td>Citizenship:</td>
            <td><?php echo $student_details['father_citizenship'] ?></td>
        </tr>
        <tr>
            <td>Nationality (For PR only):</td>
            <td><?php echo $student_details['father_nationality'] ?></td>
        </tr>
        <tr>
            <td>Residential Address:</td>
            <td><?php echo $student_details['father_residential'] ?></td>
        </tr>
        <tr>
            <td>Contact No.:</td>
            <td><?php echo $student_details['father_number'] ?></td>
        </tr>
        <tr>
            <td>Name of Employer:</td>
            <td><?php echo $student_details['father_employer'] ?></td>
        </tr>
        <tr>
            <td>Company Address:</td>
            <td><?php echo $student_details['father_company'] ?></td>
        </tr>
        <tr>
            <td>Occupation:</td>
            <td><?php echo $student_details['father_occupation'] ?></td>
        </tr>
        <tr>
            <td>Gross Salary:</td>
            <td><?php echo $student_details['father_salary'] ?></td>
        </tr>
        <tr>
            <td>Other Salary:</td>
            <td><?php echo $student_details['father_other'] ?></td>
        </tr>

    </table>

    <div style="margin: 20px;"><i>
            <h2><b><?php echo $student_details['mother_name'] ?> (Mother)</b></h2>
        </i></div>

    <table style="margin-left: 30px;">

        <tr>
            <td>NRIC:</td>
            <td><?php echo $student_details['mother_nric'] ?></td>
        </tr>
        <tr>
            <td>Date of birth:</td>
            <td><?php echo $student_details['mother_dob'] ?></td>
        </tr>
        <tr>
            <td>Race:</td>
            <td><?php echo $student_details['mother_race'] ?></td>
        </tr>
        <tr>
            <td>Citizenship:</td>
            <td><?php echo $student_details['mother_citizenship'] ?></td>
        </tr>
        <tr>
            <td>Nationality (For PR only):</td>
            <td><?php echo $student_details['mother_nationality'] ?></td>
        </tr>
        <tr>
            <td>Residential Address:</td>
            <td><?php echo $student_details['mother_residential'] ?></td>
        </tr>
        <tr>
            <td>Contact No.:</td>
            <td><?php echo $student_details['mother_number'] ?></td>
        </tr>
        <tr>
            <td>Name of Employer:</td>
            <td><?php echo $student_details['mother_employer'] ?></td>
        </tr>
        <tr>
            <td>Company Address:</td>
            <td><?php echo $student_details['mother_company'] ?></td>
        </tr>
        <tr>
            <td>Occupation:</td>
            <td><?php echo $student_details['mother_occupation'] ?></td>
        </tr>
        <tr>
            <td>Gross Salary:</td>
            <td><?php echo $student_details['mother_salary'] ?></td>
        </tr>
        <tr>
            <td>Other Salary:</td>
            <td><?php echo $student_details['mother_other'] ?></td>
        </tr>

    </table>


    <div style="margin: 20px;"><i>
            <h2><b><?php echo $student_details['guardian_name'] ?> (Guardian if applicable)</b></h2>
        </i></div>

    <table style="margin-left: 30px;">

        <tr>
            <td>NRIC:</td>
            <td><?php echo $student_details['guardian_nric'] ?></td>
        </tr>
        <tr>
            <td>Date of birth:</td>
            <td><?php echo $student_details['guardian_dob'] ?></td>
        </tr>
        <tr>
            <td>Race:</td>
            <td><?php echo $student_details['guardian_race'] ?></td>
        </tr>
        <tr>
            <td>Citizenship:</td>
            <td><?php echo $student_details['guardian_citizenship'] ?></td>
        </tr>
        <tr>
            <td>Nationality (For PR only):</td>
            <td><?php echo $student_details['guardian_nationality'] ?></td>
        </tr>
        <tr>
            <td>Residential Address:</td>
            <td><?php echo $student_details['guardian_residential'] ?></td>
        </tr>
        <tr>
            <td>Contact No.:</td>
            <td><?php echo $student_details['guardian_number'] ?></td>
        </tr>
        <tr>
            <td>Name of Employer:</td>
            <td><?php echo $student_details['guardian_employer'] ?></td>
        </tr>
        <tr>
            <td>Company Address:</td>
            <td><?php echo $student_details['guardian_company'] ?></td>
        </tr>
        <tr>
            <td>Occupation:</td>
            <td><?php echo $student_details['guardian_occupation'] ?></td>
        </tr>
        <tr>
            <td>Gross Salary:</td>
            <td><?php echo $student_details['guardian_salary'] ?></td>
        </tr>
        <tr>
            <td>Other Salary:</td>
            <td><?php echo $student_details['guardian_other'] ?></td>
        </tr>

    </table>


    <div style="margin: 20px;"><i>
            <h2><b>Emergency Contact</b></h2>
        </i></div>

    <table style="margin-left: 30px;">

        <tr>
            <td>Name:</td>
            <td><?php echo $student_details['emergency_name'] ?></td>
        </tr>
        <tr>
            <td>Relationship to student:</td>
            <td><?php echo $student_details['emergency_relationship'] ?></td>
        </tr>
        <tr>
            <td>Contact No.:</td>
            <td><?php echo $student_details['emergency_contact'] ?></td>
        </tr>


    </table>


    <div style="margin: 20px;"><i>
            <h2><b>Other Family Members</b></h2>
        </i></div>

    <table style="margin-left: 30px; margin-bottom: 200px;">

        <tr>
            <td>Name:</td>
            <td><?php echo $student_details['family_name'] ?></td>
        </tr>
        <tr>
            <td>Relationship to student:</td>
            <td><?php echo $student_details['family_relationship'] ?></td>
        </tr>
        <tr>
            <td>Contact No.:</td>
            <td><?php echo $student_details['family_contact'] ?></td>
        </tr>

    </table>
</body>

<style>
    td:nth-child(odd) {
        /* text-align: right; */
        width: 400px;
        font-weight: bolder;
    }
</style>



</html>