<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("insert-payslip.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_attendance.php");
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
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

<header>
    <header class="header">

        <?php include("header.php") ?>



    </header>
</header>
<br><br><br><br><br><br><br><br><br><br>
<style>
    .container {
        display: grid;
        place-items: center;
    }

    .section {
        display: none;
    }

    .section.active {
        display: block;
    }

    .nav {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
    }

    .nav button {
        background: #ccc;
        padding: 10px 15px;
        margin-left: 6px;
        border-radius: 50%;
        cursor: pointer;
        opacity: .5;
        border: none;
    }

    .next,
    .previous {
        padding: 15px 10px;
        border-radius: 6px;
        background: deepskyblue;
        color: white;
        border: 0;
        outline: none;
        cursor: pointer;
        width: 100px;
        visibility: hidden;
    }

    .button-active {
        opacity: 1 !important;
        visibility: visible;
    }
</style>


<script>
    const sectionContent = ["r1", "r2", "r3"];
    let currentSection = sectionContent[0];

    const displayContent = (q, area) => {
        document.getElementById(q).classList.add("active");
        document.getElementById(q + "-button").classList.add("button-active");
        currentSection = sectionContent[area.indexOf(q)];
        const toNone = area.filter(e => e !== q);
        for (i in toNone) {
            document.getElementById(toNone[i]).classList.remove("active");
            document.getElementById(toNone[i] + "-button").classList.remove("button-active");
        }
        if (sectionContent.indexOf(q) == 0) {
            document.getElementById("previous").classList.remove("button-active");
            document.getElementById("next").classList.add("button-active");
        } else if (sectionContent.indexOf(q) == sectionContent.length - 1) {
            document.getElementById("previous").classList.add("button-active");
            document.getElementById("next").classList.remove("button-active");
        } else {
            document.getElementById("previous").classList.add("button-active");
            document.getElementById("next").classList.add("button-active");
        }
    }

    const displayR1 = () => displayContent("r1", sectionContent);
    const displayR2 = () => displayContent("r2", sectionContent);
    const displayR3 = () => displayContent("r3", sectionContent);

    const displayNext = () => displayContent(sectionContent[sectionContent.indexOf(currentSection) + 1], sectionContent);
    const displayPrevious = () => displayContent(sectionContent[sectionContent.indexOf(currentSection) - 1], sectionContent);
</script>

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

    <div class="container">
        <nav class="nav">
            <button class="button-active" id="r1-button" onclick="displayR1()">Student's Particulars</button>
            <button id="r2-button" onclick="displayR2()">Father's Particulars</button>
            <button id="r3-button" onclick="displayR3()">Mother's Particulars</button>
        </nav>


        <section id="r1" class="section active">
            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label for="inputCity">Name</label>
                    <input type="text" class="form-control" name="student_name" id="inputCity" value="<?php echo $student_details['student_name'] ?>" disabled>
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">NRIC</label>
                    <input value="<?php echo $student_details['student_nric'] ?>" disabled type="text" class="form-control" name="student_nric" id="inputCity">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputZip">Gender</label>
                    <input value="<?php echo $student_details['student_gender'] ?>" disabled id="inputState" class="form-control" name="student_gender">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="inputCity">Date Of Birth</label>
                    <input value="<?php echo $student_details['student_dob'] ?>" disabled type="date" class="form-control" name="student_dob" id="inputCity">
                </div>
                <div class="form-group col-lg-6">
                    <label for="inputCity">Race</label>
                    <input value="<?php echo $student_details['student_race'] ?>" disabled id="inputState" class="form-control" name="student_race">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label for="inputCity">Citizenship</label>
                    <input value="<?php echo $student_details['student_citizenship'] ?>" disabled id="inputState" class="form-control" name="student_citizenship">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">If Permanent Resident, Which Nationality?</label>
                    <input value="<?php echo $student_details['student_nationality'] ?>" disabled type="text" class="form-control" name="student_nationality" id="student_school">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">School Child Is Currently Attending</label>
                    <input value="<?php echo $student_details['student_school'] ?>" disabled type="text" class="form-control" name="student_school" id="student_school">
                </div>

                <div class="form-group col-lg-6">
                    <label for="inputCity">Primary Level</label>
                    <input value="<?php echo $student_details['student_level'] ?>" disabled id="inputState" class="form-control" name="student_level">
                </div>
                <div class="form-group col-lg-6">
                    <label for="inputCity">Normal/Foundation</label>
                    <input value="<?php echo $student_details['student_normal_foundation'] ?>" disabled id="inputState" class="form-control" name="student_normal">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="inputCity">Residential Address</label>
                    <input value="<?php echo $student_details['student_residential'] ?>" disabled type="text" class="form-control" name="student_residential" id="student_school">
                </div>

                <div class="form-group col-lg-6">
                    <label for="inputCity">Name Of Student's Bank</label>
                    <input value="<?php echo $student_details['student_bank'] ?>" disabled type="text" class="form-control" name="student_bank" id="student_school">
                </div>
                <div class="form-group col-lg-6">
                    <label for="inputCity">Student's Account Number</label>
                    <input value="<?php echo $student_details['student_account'] ?>" disabled type="text" class="form-control" name="student_account" id="student_school">
                </div>
                <div class="form-group col-lg-6">
                    <label for="inputCity">Which Centre Do You Want To Go To</label>
                    <input value="<?php echo $student_details['centre_name'] ?>" disabled class="form-control" id="reason" name="centre_name">
                </div>
            </div>
        </section>

        <section id="r2" class="section">
            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label for="inputCity">Name</label>
                    <input value="<?php echo $student_details['father_name'] ?>" disabled type="text" class="form-control" name="father_name" id="inputCity">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">NRIC</label>
                    <input value="<?php echo $student_details['father_nric'] ?>" disabled type="text" class="form-control" name="father_nric" id="inputCity">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputZip">Date Of Birth</label>
                    <input value="<?php echo $student_details['father_dob'] ?>" disabled type="date" class="form-control" name="father_dob" id="inputCity">
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-lg-4">
                    <label for="inputCity">Race</label>
                    <input value="<?php echo $student_details['father_race'] ?>" disabled id="inputState" class="form-control" name="father_race">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">Citizenship</label>
                    <input value="<?php echo $student_details['father_citizenship'] ?>" disabled id="inputState" class="form-control" name="father_citizenship">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">If Permanent Resident, Which Nationality?</label>
                    <input value="<?php echo $student_details['father_nationality'] ?>" disabled type="text" class="form-control" name="father_nationality" id="student_school">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label for="inputCity">Residential Address</label>
                    <input value="<?php echo $student_details['father_residential'] ?>" disabled type="text" class="form-control" name="father_residential" id="student_school">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">Contact Number</label>
                    <input value="<?php echo $student_details['father_number'] ?>" disabled type="number" class="form-control" name="father_number" id="student_school">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">Name Of Employer</label>
                    <input value="<?php echo $student_details['father_employer'] ?>" disabled type="text" class="form-control" name="father_employer" id="student_school">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="inputCity">Company Address</label>
                    <input value="<?php echo $student_details['father_compnay'] ?>" disabled type="text" class="form-control" name="father_company" id="student_school">
                </div>

                <div class="form-group col-lg-6">
                    <label for="inputCity">Occupation*</label>
                    <input value="<?php echo $student_details['father_occupation'] ?>" disabled type="text" class="form-control" name="father_occupation" id="student_school">
                </div>
                <div class="form-group col-lg-6">
                    <label for="inputCity">Gross Salary*</label>
                    <input value="<?php echo $student_details['father_salary'] ?>" disabled type="text" class="form-control" name="father_salary" value="$" id="student_school">
                </div>
                <div class="form-group col-lg-6">
                    <label for="inputCity">Other Salary*</label>
                    <input value="<?php echo $student_details['father_other'] ?>" disabled type="text" class="form-control" name="father_other" value="$" id="student_school">
                </div>
            </div>
        </section>

        <section id="r3" class="section">
            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label for="inputCity">Name</label>
                    <input value="<?php echo $student_details['mother_name'] ?>" disabled type="text" class="form-control" name="mother_name" id="inputCity">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">NRIC</label>
                    <input value="<?php echo $student_details['mother_nric'] ?>" disabled type="text" class="form-control" name="mother_nric" id="inputCity">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputZip">Date Of Birth</label>
                    <input value="<?php echo $student_details['mother_dob'] ?>" disabled type="date" class="form-control" name="mother_dob" id="inputCity">
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-lg-4">
                    <label for="inputCity">Race</label>
                    <input value="<?php echo $student_details['mother_race'] ?>" disabled id="inputState" class="form-control" name="mother_race">

                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">Citizenship</label>
                    <input value="<?php echo $student_details['mother_citizenship'] ?>" disabled id="inputState" class="form-control" name="mother_citizenship">

                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">If Permanent Resident, Which Nationality?</label>
                    <input value="<?php echo $student_details['mother_nationality'] ?>" disabled type="text" class="form-control" name="mother_nationality" id="student_school">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label for="inputCity">Residential Address</label>
                    <input value="<?php echo $student_details['mother_residential'] ?>" disabled type="text" class="form-control" name="mother_residential" id="student_school">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">Contact Number</label>
                    <input value="<?php echo $student_details['mother_number'] ?>" disabled type="number" class="form-control" name="mother_number" id="student_school">
                </div>
                <div class="form-group col-lg-4">
                    <label for="inputCity">Name Of Employer</label>
                    <input value="<?php echo $student_details['mother_employer'] ?>" disabled type="text" class="form-control" name="mother_employer" id="student_school">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="inputCity">Company Address</label>
                    <input value="<?php echo $student_details['mother_company'] ?>" disabled type="text" class="form-control" name="mother_company" id="student_school">
                </div>

                <div class="form-group col-lg-6">
                    <label for="inputCity">Occupation*</label>
                    <input value="<?php echo $student_details['mother_occupation'] ?>" disabled type="text" class="form-control" name="mother_occupation" id="student_school">
                </div>
                <div class="form-group col-lg-6">
                    <label for="inputCity">Gross Salary*</label>
                    <input value="<?php echo $student_details['mother_salary'] ?>" disabled type="text" class="form-control" name="mother_salary" value="$" id="student_school">
                </div>
                <div class="form-group col-lg-6">
                    <label for="inputCity">Other Salary*</label>
                    <input value="<?php echo $student_details['mother_other'] ?>" disabled type="text" class="form-control" name="mother_other" value="$" id="student_school">
                </div>
            </div>
        </section>

        <nav>
            <button class="previous" id="previous" onclick="displayPrevious()">Previous</button>
            <button class="next button-active" id="next" onclick="displayNext()">Next</button>
        </nav>
    </div>




    <div style="margin: 20px;"><i>
            <h2><b><?php echo $student_details['father_name'] ?> (Father)</b></h2>
        </i></div>


    <div style="margin: 20px;"><i>
            <h2><b><?php echo $student_details['mother_name'] ?> (Mother)</b></h2>
        </i></div>



    <div style="margin: 20px;"><i>
            <h2><b><?php echo $student_details['guardian_name'] ?> (Guardian if applicable)</b></h2>
        </i></div>



    <div style="margin: 20px;"><i>
            <h2><b>Emergency Contact</b></h2>
        </i></div>



    <div style="margin: 20px;"><i>
            <h2><b>Other Family Members</b></h2>
        </i></div>

</body>
<style>
    td:nth-child(odd) {
        /* text-align: right; */
        width: 400px;
        font-weight: bolder;
    }
</style>



</html>