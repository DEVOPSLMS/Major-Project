<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
if (isset($_POST["submit"])) {
    $student_name = $_POST["student_name"];
    $student_nric = $_POST["student_nric"];
    $student_gender = $_POST["gender"];
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
    $parentid=$user_data['id'];

    $query = "insert into student(student_name,student_nric,student_gender,student_dob,student_race,student_citizenship,student_nationality,student_school,student_level,student_normal_foundation,student_residential,student_bank,student_account,father_name,father_nric,father_dob,father_race,father_citizenship,father_nationality,father_residential,father_number,father_employer,father_company,father_occupation,father_salary,father_other,mother_name,mother_nric,mother_dob,mother_race,mother_citizenship,mother_nationality,mother_residential,mother_number,mother_employer,mother_company,mother_occupation,mother_salary,mother_other,guardian_name,guardian_nric,guardian_dob,guardian_race,guardian_citizenship,guardian_nationality,guardian_residential,guardian_number,guardian_employer,guardian_company,guardian_occupation,guardian_salary,guardian_other,emergency_name,emergency_relationship,emergency_contact,family_name,family_relationship,family_contact,medical_date,medical_conditions,add_here,daily_medication,explain_condition,medical_name,medical_nric,translator_name,translator_nric,status,late_counter,centre_name,parentid) 
    VALUES('$student_name', '$student_nric','$student_gender','$student_dob','$student_race','$student_citizenship','$student_nationality','$student_school','$student_level','$student_normal','$student_residential','$student_bank','$student_account','$father_name','$father_nric','$father_dob','$father_race','$father_citizenship','$father_nationality','$father_residential','$father_number','$father_employer','$father_company','$father_occupation','$father_salary','$father_other','$mother_name','$mother_nric','$mother_dob','$mother_race','$mother_citizenship','$mother_nationality','$mother_residential','$mother_number','$mother_employer','$mother_company','$mother_occupation','$mother_salary','$mother_other','$guardian_name','$guardian_nric','$guardian_dob','$guardian_race','$guardian_citizenship','$guardian_nationality','$guardian_residential','$guardian_number','$guardian_employer','$guardian_company','$guardian_occupation','$guardian_salary','$guardian_other','$emergency_name','$emergency_relationship','$emergency_contact','$family_name','$family_relationship','$family_contact','$medical_date','$medical_conditions','$add_here','$daily_medication','$explain_condition','$medical_name','$medical_nric','$translator_name','$translator_nric','Pending Interview','0','$centre_name','$parentid')";
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

    <body>

        <div class="form-group ">
            <h2>Particulars Of Student</h2>
            <form id="form" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="student_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">NRIC:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="student_nric">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Gender:</label>
                    <select class="col-sm-10 form-select" style="width:41.2%;margin-left:11px;" id="reason" name="gender" required>
                        <option selected></option>
                        <option value="Male" name="room">Male</option>
                        <option value="Female" name="room">Female</option>


                    </select>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Date Of Birth:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" style="width: 50%;" id="staticEmail" name="student_dob">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Race:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="student_race">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Citizenship:</label>
                    <select class="col-sm-10 form-select" style="width:41.2%;margin-left:11px;" id="reason" name="student_citizenship" required>
                        <option selected></option>
                        <option value="Permanant Resident">Permanant Resident</option>
                        <option value="Singaporean">Singaporean</option>
                        <option value="Foreigner">Foreigner</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">If permanent resident, which nationality?:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="student_nationality">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">School child is currently attending*:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="student_school">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Primary Level:</label>
                    <select class="col-sm-10 form-select" style="width:41.2%;margin-left:11px;" id="reason" name="student_level" required>
                        <option selected></option>
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
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Normal/Foundation:</label>
                    <select class="col-sm-10 form-select" style="width:41.2%;margin-left:11px;" id="reason" name="student_normal" required>
                        <option selected></option>
                        <option value="Normal">Normal</option>
                        <option value="Foundation">Foundation</option>


                    </select>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Residential Address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="student_residential">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Name of student's bank:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="student_bank">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Student's account number:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" style="width: 50%;" id="staticEmail" name="student_account">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Which Centre Do You Want To Go To</label>
                    
                    <select class="col-sm-10 form-select" style="width:41.2%;margin-left:11px;" id="reason" name="centre_name" required>
                        <option selected></option>
                        <option value="Hougang Centre">Hougang Centre</option>
                        <option value="Sengkang Centre">Sengkang Centre</option>
                        <option value="Punggol Centre">Punggol Centre</option>
                        <option value="Fernvale Centre">Fernvale Centre</option>
                        <option value="Teck Ghee Centre">Teck Ghee Centre</option>
                        <option value="Kolam Ayer Centre">Kolam Ayer Centre</option>

                    </select>
                  
                </div>
                <h2>Particulars Of Father</h2>

                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="father_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">NRIC:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="father_nric">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Date Of Birth:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" style="width: 50%;" id="staticEmail" name="father_dob">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Race:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="father_race">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Citizenship:</label>
                    <select class="col-sm-10 form-select" style="width:41.2%;margin-left:11px;" id="reason" name="father_citizenship" required>
                        <option selected></option>
                        <option value="Permanant Resident">Permanant Resident</option>
                        <option value="Singaporean">Singaporean</option>
                        <option value="Foreigner">Foreigner</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">If permanent resident, which nationality?:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="father_nationality">
                    </div>
                </div>



                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Residential Address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="father_residential">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Contact Number:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="father_number">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Name of employer:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="father_employer">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Company address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="father_company">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Occupation*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="father_occupation">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Gross salary*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="father_salary">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Other salary*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="father_other">
                    </div>
                </div>
                <h2>Particulars Of Mother</h2>

                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="mother_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">NRIC:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="mother_nric">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Date Of Birth:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" style="width: 50%;" id="staticEmail" name="mother_dob">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Race:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="mother_race">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Citizenship:</label>
                    <select class="col-sm-10 form-select" style="width:41.2%;margin-left:11px;" id="reason" name="mother_citizenship" required>
                        <option selected></option>
                        <option value="Permanant Resident">Permanant Resident</option>
                        <option value="Singaporean">Singaporean</option>
                        <option value="Foreigner">Foreigner</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">If permanent resident, which nationality?:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="mother_nationality">
                    </div>
                </div>



                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Residential Address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="mother_residential">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Contact Number:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="mother_number">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Name of employer:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="mother_employer">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Company address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="mother_company">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Occupation*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="mother_occupation">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Gross salary*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="mother_salary">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Other salary*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="mother_other">
                    </div>
                </div>
                <h2>Particulars of guardian (applicable only in the event of both parents passing)</h2>

                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="guardian_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">NRIC:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="guardian_nric">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Date Of Birth:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" style="width: 50%;" id="staticEmail" name="guardian_dob">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Race:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="guardian_race">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Citizenship:</label>
                    <select class="col-sm-10 form-select" style="width:41.2%;margin-left:11px;" id="reason" name="guardian_citizenship" required>
                        <option selected></option>
                        <option value="Permanant Resident">Permanant Resident</option>
                        <option value="Singaporean">Singaporean</option>
                        <option value="Foreigner">Foreigner</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">If permanent resident, which nationality?:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="guardian_nationality">
                    </div>
                </div>



                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Residential Address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="guardian_residential">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Contact Number:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="guardian_number">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Name of employer:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="guardian_employer">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Company address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="guardian_company">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Occupation*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="guardian_occupation">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Gross salary*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="guardian_salary">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Other Salary*</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" style="width: 50%;" id="staticEmail" name="guardian_other">
                    </div>
                </div>
                <h2>Emergency contacts</h2>

                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Name*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="emergency_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Relationship to student*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="emergency_relationship">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Contact No*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="emergency_contact">
                    </div>
                </div>
                <h3>Other family members</h3>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Name*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="family_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Relationship to student*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="family_relationship">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Contact No*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="family_contact">
                    </div>
                </div>
                <h2>Declaration</h2>
                <p>I hereby authorize YYD Education Centre Ltd, to collect, use, store and disclose information (including personal information), including, but not limited to, information provided
                    in this application form and obtained during our house visits, in accordance to the Personal Data Protection Act 2012 (PDPA) in Singapore for the processing of this application
                    and the administration of membership under YYD Education Centre Ltd.

                    I acknowledge that the personal data and information mentioned above may be retained by YYD Education Centre for a reasonable length of time and I authorize such retention
                    for future recruitment purposes.

                    I understand that the provision of information which is untrue, or failure to provide certain information may affect the outcome of my application. I herby declare that the
                    information provided by me in this application form are true, complete and accurate. I hereby undertake to inform YYD Education Centre of any changes or error in my
                    information as soon as possible.</p>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Full name of parent/legal guardian*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Signature of parent/legal guardian*</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" style="width: 50%;" id="staticEmail">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" style="width: 50%;" id="staticEmail">
                    </div>
                </div>
                <h2>Medical Declaration Form</h2>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" style="width: 50%;" id="staticEmail" name="medical_date">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Child's name*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Level*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Any medical conditions?*</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" style="width: 50%;" id="staticEmail" name="medical_conditions"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">If yes, please add here:</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" style="width: 50%;" id="staticEmail" name="add_here"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Is your child on daily medication to treat/prevent relapse?:</label>
                    <select class="col-sm-10 form-select" style="width:41.2%;margin-left:11px;" id="reason" name="daily_medication" required>
                        <option selected></option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                    </select>
                </div>
               
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Does the condition affect his/her learning progress?</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" style="width: 50%;" id="staticEmail"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">If yes, please explain in the text box.</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" style="width: 50%;" id="staticEmail"name="explain_condition" ></textarea>
                    </div>
                </div>
                <div class="form-group row">
                   
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                I am fully aware that YYD Education tutors are not medically trained to handle my child's medical condition. I will not hold YYD Education Centre or their tutors
                                responsible for any incident which may happen to my child due to his/her medical condition, as a result from my decision to enrol him/her in the tuition.
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                I hereby certify that the above information is true and accurate and failure to provide certain information may affect the outcome of my application. I hereby undertake
                                to inform YYD Education Centre of any changes or error in my information as soon as practicable.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Parent / Guardian Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="medical_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">NRIC*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="medical_nric">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Translator Name (if any):</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="translator_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" style="margin-left:100px;" class="col-sm-1 col-form-label">Translator NRIC:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" style="width: 50%;" id="staticEmail" name="translator_nric">
                        <button class="btn btn-primary text-center" type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;margin-top:30px;">Submit</button>
                    </div>
                   
                </div>
                

            </form>
        </div>


    </body>

</html>