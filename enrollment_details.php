<?php
session_start();

include("connection.php");
include("functions.php");

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

</head>
<header>
    <header class="header">

        <?php include("header.php") ?>

       
    </header>
</header>
<br><br><br><br><br><br><br><br><br><br><br>
<style>
    body{
        font-size:130%;
    }
</style>
<body>
<a class="btn btn-primary" style=" left: 20px;" href="enrollment_review.php">Back</a>
<br><br>
        <h2 class="text-center" style="border-bottom: 1px grey solid; padding-bottom: 20px;"><b>Enrollment Review</b></h2>
    <a href="" class="btn btn-primary" style="position: absolute; right: 20px;">
        <h3>Medical Declaration Form</h3>
    </a>

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
        width: 250px;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>



</html>