<?php
session_start();
include("check_teacher.php");
include("connection.php");
include("functions.php");
include("check_roster.php");
include("insert-payslip.php");
include("check_attendance.php");
$user_data = check_login($con);
if (isset($_POST["submit"])) {
    $student_name = $_POST["student_name"];
    $student_nric = $_POST["student_nric"];
    $student_gender = $_POST["student_gender"];
    $student_dob = $_POST["student_dob"];
    $student_race = $_POST["student_race"];
    $student_citizenship = $_POST["student_citizenship"];
    $student_nationality = $_POST["student_nationality"];
    $student_school = $_POST["student_school"];
    $student_level = $_POST["student_level"];
    $student_normal = $_POST["student_normal"];
    $student_residential = $_POST["student_residential"];
    $student_bank = $_POST["student_bank"];
    $student_account = $_POST["student_account"];
    $centre_name = $_POST["centre_name"];
    $father_name = $_POST["father_name"];
    $father_nric = $_POST["father_nric"];
    $father_dob = $_POST["father_dob"];
    $father_race = $_POST["father_race"];
    $father_citizenship = $_POST["father_citizenship"];
    $father_nationality = $_POST["father_nationality"];
    $father_residential = $_POST["father_residential"];
    $father_number = $_POST["father_number"];
    $father_employer = $_POST["father_employer"];
    $father_company = $_POST["father_company"];
    $father_occupation = $_POST["father_occupation"];
    $father_salary = $_POST["father_salary"];
    $father_other = $_POST["father_other"];
    $mother_name = $_POST["mother_name"];
    $mother_nric = $_POST["mother_nric"];
    $mother_dob = $_POST["mother_dob"];
    $mother_race = $_POST["mother_race"];
    $mother_citizenship = $_POST["mother_citizenship"];
    $mother_nationality = $_POST["mother_nationality"];
    $mother_residential = $_POST["mother_residential"];
    $mother_number = $_POST["mother_number"];
    $mother_employer = $_POST["mother_employer"];
    $mother_company = $_POST["mother_company"];
    $mother_occupation = $_POST["mother_occupation"];
    $mother_salary = $_POST["mother_salary"];
    $mother_other = $_POST["mother_other"];

    $guardian_name = $_POST["guardian_name"];
    $guardian_nric = $_POST["guardian_nric"];
    $guardian_dob = $_POST["guardian_dob"];
    $guardian_race = $_POST["guardian_race"];
    $guardian_citizenship = $_POST["guardian_citizenship"];
    $guardian_nationality = $_POST["guardian_nationality"];
    $guardian_residential = $_POST["guardian_residential"];
    $guardian_number = $_POST["guardian_number"];
    $guardian_employer = $_POST["guardian_employer"];
    $guardian_company = $_POST["guardian_company"];
    $guardian_occupation = $_POST["guardian_occupation"];
    $guardian_salary = $_POST["guardian_salary"];
    $guardian_other = $_POST["guardian_other"];

    $emergency_name = $_POST["emergency_name"];
    $emergency_relationship = $_POST["emergency_relationship"];
    $emergency_contact = $_POST["emergency_contact"];
    $family_name = $_POST["family_name"];
    $family_relationship = $_POST["family_relationship"];
    $family_contact = $_POST["family_contact"];

    $medical_date = $_POST["medical_date"];
    $medical_conditions = $_POST["medical_conditions"];
    $add_here = $_POST["add_here"];
    $daily_medication = $_POST["daily_medication"];
    $explain_condition = $_POST["explain_condition"];
    $medical_name = $_POST["medical_name"];
    $medical_nric = $_POST["medical_nric"];
    $translator_name = $_POST["translator_name"];
    $translator_nric = $_POST["translator_nric"];
    $parentid = $user_data['id'];

    $query = "insert into student(student_name,student_nric,student_gender,student_dob,student_race,student_citizenship,student_nationality,student_school,student_level,student_normal_foundation,student_residential,student_bank,student_account,father_name,father_nric,father_dob,father_race,father_citizenship,father_nationality,father_residential,father_number,father_employer,father_company,father_occupation,father_salary,father_other,mother_name,mother_nric,mother_dob,mother_race,mother_citizenship,mother_nationality,mother_residential,mother_number,mother_employer,mother_company,mother_occupation,mother_salary,mother_other,guardian_name,guardian_nric,guardian_dob,guardian_race,guardian_citizenship,guardian_nationality,guardian_residential,guardian_number,guardian_employer,guardian_company,guardian_occupation,guardian_salary,guardian_other,emergency_name,emergency_relationship,emergency_contact,family_name,family_relationship,family_contact,medical_date,medical_conditions,add_here,daily_medication,explain_condition,medical_name,medical_nric,translator_name,translator_nric,status,late_counter,centre_name,parentid,sick) 
    VALUES('$student_name', '$student_nric','$student_gender','$student_dob','$student_race','$student_citizenship','$student_nationality','$student_school','$student_level','$student_normal','$student_residential','$student_bank','$student_account','$father_name','$father_nric','$father_dob','$father_race','$father_citizenship','$father_nationality','$father_residential','$father_number','$father_employer','$father_company','$father_occupation','$father_salary','$father_other','$mother_name','$mother_nric','$mother_dob','$mother_race','$mother_citizenship','$mother_nationality','$mother_residential','$mother_number','$mother_employer','$mother_company','$mother_occupation','$mother_salary','$mother_other','$guardian_name','$guardian_nric','$guardian_dob','$guardian_race','$guardian_citizenship','$guardian_nationality','$guardian_residential','$guardian_number','$guardian_employer','$guardian_company','$guardian_occupation','$guardian_salary','$guardian_other','$emergency_name','$emergency_relationship','$emergency_contact','$family_name','$family_relationship','$family_contact','$medical_date','$medical_conditions','$add_here','$daily_medication','$explain_condition','$medical_name','$medical_nric','$translator_name','$translator_nric','Pending Interview','0','$centre_name','$parentid','no')";
    mysqli_query($con, $query);

    echo
    "
        <script>
          alert('Successfully Added');
          document.location.href = 'enrollment.php';
        </script>
        ";
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
    <title>Enrollment</title>
</head>
<header>
    <header class="header">

        <?php include("header.php") ?>

    </header>
    <script>
        const sectionContent = ["r1", "r2", "r3", "r4", "r5", "r6", "r7", "r8"];
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
        const displayR4 = () => displayContent("r4", sectionContent);
        const displayR5 = () => displayContent("r5", sectionContent);
        const displayR6 = () => displayContent("r6", sectionContent);
        const displayR7 = () => displayContent("r7", sectionContent);
        const displayR8 = () => displayContent("r8", sectionContent);
        const displayNext = () => displayContent(sectionContent[sectionContent.indexOf(currentSection) + 1], sectionContent);
        const displayPrevious = () => displayContent(sectionContent[sectionContent.indexOf(currentSection) - 1], sectionContent);
    </script>
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


        .nav button {
            background: #ccc;
            padding: 10px 15px;
            margin-left: 6px;
            border-radius: 50%;
            cursor: pointer;
            opacity: .5;
            border: none;
            height: 80px;
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

        body {
            font-size: 120%;
        }
    </style>
    <br><br><br><br><br><br><br><br><br><br>

    <body>

        <div class="container-fluid">
            <div class="col-lg-12 ">
                <nav class="nav " style="margin-left:15%;">
                    <button class="button-active" id="r1-button" onclick="displayR1()">Student's Particular</button>
                    <button id="r2-button" onclick="displayR2()">Father's Particular</button>
                    <button id="r3-button" onclick="displayR3()">Mother's Particular</button>
                    <button id="r4-button" onclick="displayR4()">Guardian's Particular</button>
                    <button id="r5-button" onclick="displayR5()">Emergency Contacts</button>
                    <button id="r6-button" onclick="displayR6()">Other Family Members</button>
                    <button id="r7-button" onclick="displayR7()">Declaration</button>
                    <button id="r8-button" onclick="displayR8()">Medical Declaration Form</button>
                </nav>
            </div>

            <div class="form-group">


                <form method="POST">
                    <section id="r1" class="section active">

                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Name</label>
                                <input type="text" class="form-control" name="student_name" id="inputCity">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">NRIC</label>
                                <input type="text" class="form-control" name="student_nric" id="inputCity">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputZip">Gender</label>
                                <select id="inputState" class="form-control" name="student_gender">
                                    <option selected>Choose Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Date Of Birth</label>
                                <input type="date" class="form-control" name="student_dob" id="inputCity">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Race</label>
                                <select id="inputState" class="form-control" name="student_race">
                                    <option selected>Choose Race</option>
                                    <option value="chinese">Chinese</option>
                                    <option value="malay">Malay</option>
                                    <option value="indian">Indian</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Citizenship</label>
                                <select id="inputState" class="form-control" name="student_citizenship">
                                    <option selected>Choose Citizenship</option>
                                    <option value="Permanant Resident">Permanant Resident</option>
                                    <option value="Singaporean">Singaporean</option>
                                    <option value="Foreigner">Foreigner</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">If Permanent Resident, Which Nationality?</label>
                                <input type="text" class="form-control" name="student_nationality" id="student_school">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">School Child Is Currently Attending</label>
                                <input type="text" class="form-control" name="student_school" id="student_school">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="inputCity">Primary Level</label>
                                <select id="inputState" class="form-control" name="student_level">
                                    <option selected>Choose Level</option>
                                    <option value="P1">P1</option>
                                    <option value="P2">P2</option>
                                    <option value="P3">P3</option>
                                    <option value="P4">P4</option>
                                    <option value="P5(N)">P5(N)</option>
                                    <option value="P5(F)">P5(F)</option>
                                    <option value="P6(N)">P6(N)</option>
                                    <option value="P6(F)">P6(F)</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Normal/Foundation</label>
                                <select id="inputState" class="form-control" name="student_normal">
                                    <option selected>Choose</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Foundation">Foundation</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Residential Address</label>
                                <input type="text" class="form-control" name="student_residential" id="student_school">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="inputCity">Name Of Student's Bank</label>
                                <input type="text" class="form-control" name="student_bank" id="student_school">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Student's Account Number</label>
                                <input type="text" class="form-control" name="student_account" id="student_school">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Which Centre Do You Want To Go To</label>
                                <select class="form-control" id="reason" name="centre_name" required>
                                    <option selected>Choose Centre</option>
                                    <option value="Hougang Centre">Hougang Centre</option>
                                    <option value="Sengkang Centre">Sengkang Centre</option>
                                    <option value="Punggol Centre">Punggol Centre</option>
                                    <option value="Fernvale Centre">Fernvale Centre</option>
                                    <option value="Teck Ghee Centre">Teck Ghee Centre</option>
                                    <option value="Kolam Ayer Centre">Kolam Ayer Centre</option>

                                </select>
                            </div>
                        </div>





                    </section>
                    <section id="r2" class="section">
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Name</label>
                                <input type="text" class="form-control" name="father_name" id="inputCity">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">NRIC</label>
                                <input type="text" class="form-control" name="father_nric" id="inputCity">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputZip">Date Of Birth</label>
                                <input type="date" class="form-control" name="father_dob" id="inputCity">
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-lg-4">
                                <label for="inputCity">Race</label>
                                <select id="inputState" class="form-control" name="father_race">
                                    <option selected>Choose Race</option>
                                    <option value="chinese">Chinese</option>
                                    <option value="malay">Malay</option>
                                    <option value="indian">Indian</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Citizenship</label>
                                <select id="inputState" class="form-control" name="father_citizenship">
                                    <option selected>Choose Citizenship</option>
                                    <option value="Permanant Resident">Permanant Resident</option>
                                    <option value="Singaporean">Singaporean</option>
                                    <option value="Foreigner">Foreigner</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">If Permanent Resident, Which Nationality?</label>
                                <input type="text" class="form-control" name="father_nationality" id="student_school">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Residential Address</label>
                                <input type="text" class="form-control" name="father_residential" id="student_school">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Contact Number</label>
                                <input type="number" class="form-control" name="father_number" id="student_school">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Name Of Employer</label>
                                <input type="text" class="form-control" name="father_employer" id="student_school">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Company Address</label>
                                <input type="text" class="form-control" name="father_company" id="student_school">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="inputCity">Occupation*</label>
                                <input type="text" class="form-control" name="father_occupation" id="student_school">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Gross Salary*</label>
                                <input type="text" class="form-control" name="father_salary" value="$" id="student_school">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Other Salary*</label>
                                <input type="text" class="form-control" name="father_other" value="$" id="student_school">
                            </div>
                        </div>
                    </section>
                    <section id="r3" class="section">
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Name</label>
                                <input type="text" class="form-control" name="mother_name" id="inputCity">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">NRIC</label>
                                <input type="text" class="form-control" name="mother_nric" id="inputCity">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputZip">Date Of Birth</label>
                                <input type="date" class="form-control" name="mother_dob" id="inputCity">
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-lg-4">
                                <label for="inputCity">Race</label>
                                <select id="inputState" class="form-control" name="mother_race">
                                    <option selected>Choose Race</option>
                                    <option value="chinese">Chinese</option>
                                    <option value="malay">Malay</option>
                                    <option value="indian">Indian</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Citizenship</label>
                                <select id="inputState" class="form-control" name="mother_citizenship">
                                    <option selected>Choose Citizenship</option>
                                    <option value="Permanant Resident">Permanant Resident</option>
                                    <option value="Singaporean">Singaporean</option>
                                    <option value="Foreigner">Foreigner</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">If Permanent Resident, Which Nationality?</label>
                                <input type="text" class="form-control" name="mother_nationality" id="student_school">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Residential Address</label>
                                <input type="text" class="form-control" name="mother_residential" id="student_school">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Contact Number</label>
                                <input type="number" class="form-control" name="mother_number" id="student_school">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Name Of Employer</label>
                                <input type="text" class="form-control" name="mother_employer" id="student_school">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Company Address</label>
                                <input type="text" class="form-control" name="mother_company" id="student_school">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="inputCity">Occupation*</label>
                                <input type="text" class="form-control" name="mother_occupation" id="student_school">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Gross Salary*</label>
                                <input type="text" class="form-control" name="mother_salary" value="$" id="student_school">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Other Salary*</label>
                                <input type="text" class="form-control" name="mother_other" value="$" id="student_school">
                            </div>
                        </div>
                    </section>
                    <section id="r4" class="section">
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Name</label>
                                <input type="text" class="form-control" name="guardian_name" id="inputCity">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">NRIC</label>
                                <input type="text" class="form-control" name="guardian_nric" id="inputCity">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputZip">Date Of Birth</label>
                                <input type="date" class="form-control" name="guardian_dob" id="inputCity">
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-lg-4">
                                <label for="inputCity">Race</label>
                                <select id="inputState" class="form-control" name="guardian_race">
                                    <option selected>Choose Race</option>
                                    <option value="chinese">Chinese</option>
                                    <option value="malay">Malay</option>
                                    <option value="indian">Indian</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Citizenship</label>
                                <select id="inputState" class="form-control" name="guardian_citizenship">
                                    <option selected>Choose Citizenship</option>
                                    <option value="Permanant Resident">Permanant Resident</option>
                                    <option value="Singaporean">Singaporean</option>
                                    <option value="Foreigner">Foreigner</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">If Permanent Resident, Which Nationality?</label>
                                <input type="text" class="form-control" name="guardian_nationality" id="student_school">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Residential Address</label>
                                <input type="text" class="form-control" name="guardian_residential" id="student_school">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Contact Number</label>
                                <input type="number" class="form-control" name="guardian_number" id="student_school">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Name Of Employer</label>
                                <input type="text" class="form-control" name="guardian_employer" id="student_school">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Company Address</label>
                                <input type="text" class="form-control" name="guardian_company" id="student_school">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="inputCity">Occupation*</label>
                                <input type="text" class="form-control" name="guardian_occupation" id="student_school">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Gross Salary*</label>
                                <input type="text" class="form-control" name="guardian_salary" value="$" id="student_school">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Other Salary*</label>
                                <input type="text" class="form-control" name="guardian_other" value="$" id="student_school">
                            </div>
                        </div>
                    </section>
                    <section id="r5" class="section">
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Name*</label>
                                <input type="text" class="form-control" name="emergency_name" id="inputCity">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Relationship To Student*</label>
                                <input type="text" class="form-control" name="emergency_relationship" id="inputCity">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputZip">Contact</label>
                                <input type="number" class="form-control" name="emergency_contact" id="inputCity">
                            </div>
                        </div>
                    </section>
                    <section id="r6" class="section">
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Name*</label>
                                <input type="text" class="form-control" name="family_name" id="inputCity">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Relationship To Student*</label>
                                <input type="text" class="form-control" name="family_relationship" id="inputCity">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputZip">Contact</label>
                                <input type="number" class="form-control" name="family_contact" id="inputCity">
                            </div>
                        </div>
                    </section>
                    <section id="r7" class="section">
                        <h4>I Hereby Authorize YYD Education Centre Ltd, To Collect, Use, Store And Disclose Information (Including Personal Information), Including, But Not Limited To, Information Provided In This Application Form And Obtained During Our House Visits, In Accordance To The Personal Data Protection Act 2012 (PDPA) In Singapore For The Processing Of This Application And The Administration Of Membership Under YYD Education Centre Ltd. I Acknowledge That The Personal Data And Information Mentioned Above May Be Retained By YYD Education Centre For A Reasonable Length Of Time And I Authorize Such Retention For Future Recruitment Purposes. I Understand That The Provision Of Information Which Is Untrue, Or Failure To Provide Certain Information May Affect The Outcome Of My Application. I Herby Declare That The Information Provided By Me In This Application Form Are True, Complete And Accurate. I Hereby Undertake To Inform YYD Education Centre Of Any Changes Or Error In My Information As Soon As Possible.</h4>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Full Name Of Parent/Legal Guardian*</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Signature Of Parent/Legal Guardian*</label>
                                <input type="file" class="form-control"accept=".jpg, .jpeg, .png" style="height:40px;"required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputZip">Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>
                    </section>
                    <section id="r8" class="section">
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Date*</label>
                                <input type="date" class="form-control" name="medical_date" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputCity">Child's Name*</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputZip">Level</label>
                                <select id="inputState" class="form-control">
                                    <option selected>Choose Level</option>
                                    <option value="P1">P1</option>
                                    <option value="P2">P2</option>
                                    <option value="P3">P3</option>
                                    <option value="P4">P4</option>
                                    <option value="P5(N)">P5(N)</option>
                                    <option value="P5(F)">P5(F)</option>
                                    <option value="P6(N)">P6(N)</option>
                                    <option value="P6(F)">P6(F)</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Any Medical Conditions?*</label>
                                <select id="inputState" class="form-control" name="medical_conditions">
                                    <option selected>Choose</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>

                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">If Yes, Please Add Here*</label>
                                <textarea required name="add_here" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Is Your Child On Daily Medication To Treat/Prevent Relapse?</label>
                                <select id="inputState" class="form-control" name="daily_medication">
                                    <option selected>Choose</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>

                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Does The Condition Affect His/Her Learning Progress?</label>
                                <select id="inputState" class="form-control" name="daily_medication">
                                    <option selected>Choose</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>

                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="inputCity">If Yes, Please Explain In The Text Box.</label>
                                <textarea required name="explain_condition" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputCity">Parent / Guardian Name*</label>
                                <input type="text" class="form-control" name="medical_name" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputCity">NRIC*</label>
                                <input type="text" class="form-control" name="medical_nric" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputCity">Translator Name (If Any)*</label>
                                <input type="text" class="form-control" name="translator_name" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="inputCity">Translator NRIC*</label>
                                <input type="text" class="form-control" name="translator_nric" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" style="margin-top:25px;" for="inlineCheckbox1">I Am Fully Aware That YYD Education Tutors Are Not Medically Trained To Handle My Child's Medical Condition. I Will Not Hold YYD Education Centre Or Their Tutors Responsible For Any Incident Which May Happen To My Child Due To His/Her Medical Condition, As A Result From My Decision To Enrol Him/Her In The Tuition.</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" style="margin-top:25px;" for="inlineCheckbox1">I Hereby Certify That The Above Information Is True And Accurate And Failure To Provide Certain Information May Affect The Outcome Of My Application. I Hereby Undertake To Inform YYD Education Centre Of Any Changes Or Error In My Information As Soon As Practicable.</label>
                            </div>
                        </div>
                        <button class="btn btn-primary text-center" type="submit" name="submit" style="margin-top:30px;">Submit</button>
                    </section>

                </form>
            </div>
            <nav style="margin-left:48%;">
                <button class="previous" id="previous" onclick="displayPrevious()">Previous</button>
                <button class="next button-active" id="next" onclick="displayNext()">Next</button>
            </nav>
        </div>


    </body>

</html>