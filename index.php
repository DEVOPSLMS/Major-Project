<?php
session_start();
include("check_roster.php");
include("check_teacher.php");
include("connection.php");
include_once("functions.php");
include("insert-payslip.php");
include("check_attendance.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
$user_data = check_login($con);
$date = date("Y-m-d");
?>
<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Home Page</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<header>
    <?php include("header.php") ?>


</header>

<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {

        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        var lat_details = "lat=" + lat;
        var lng_details = "lng=" + lng;
        document.cookie = lat_details;
        document.cookie = lng_details;
    }
</script>
<style>
    @media (max-width: 950px) {
        html {
            font-size: 65% !important;
        }

    }
</style>

<body onload="getLocation()">
    <br><br><br> <br> <br> <br> <br> <br> <br>
    <?php if ($user_data['role'] == 'teacher') {
        echo ('<div class="container-fluid">
        
            <div class="row">
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Schedule</h1>
                        <p style="font-size:20px;">View timeslots of the classes that you have.</p>
                        <a href="schedule_teacher.php?dt=' . $date . '"><button class="btn btn-primary text-center  " type="submit" name="submit" s">View</button></a>
                    </div>
                </div>
                <div class="col-md-6 " style="height:500px;">
    
                    <div class="row" style="height:50%;">
                        <div class="col-md-12 border border-dark">
                            <div class="details" style="margin-left:50px;margin-top:50px;">
                                <h1>Submit leave</h1>
                                <p style="font-size:20px;">Submit your reasons of absence here.</p>
    
                                <a href="submitleave.php"><button class="btn btn-primary text-center  " type="submit" name="submit" >Submit</button></a>
    
    
                            </div>
                        </div>
                    </div>
                    <div class="row" style="height:50%;">
                        <div class="col-lg-12 border border-dark">
                            <div class="details" style="margin-left:50px;margin-top:50px;">
                                <h1>Attendance</h1>
                                <p style="font-size:20px;">Click to mark attendance for your classes.</p>
    
                                <a href="schedule.php"><button class="btn btn-primary text-center  " type="submit" name="submit" >View</button></a>
    
    
                            </div>
                        </div>
    
                    </div>
                </div>
    
            </div>
            <div class="row">
                <div class="col-lg-7 border border-dark" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Check-in</h1>
                                <p style="font-size:20px;">Click to check-in to the centre.</p>
    
                                <a href="check-in.php"><button class="btn btn-primary text-center  " type="submit" name="submit" >Check-in</button></a>
    
    
                            </div>
                </div>
                <div class="col-lg-5 border border-dark" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Payslip</h1>
                                <p style="font-size:20px;">Check your payslips.</p>
    
                                <a href="payslip-teacher.php"><button class="btn btn-primary text-center  " type="submit" name="submit" >View</button></a>
    
    
                            </div>
                </div>
                <div class="col-lg-12 border border-dark" style="height:300px;">
                <div class="details text-center" style="margin-left:50px;margin-top:100px;">
                                <h1>Expenses</h1>
                                <p style="font-size:20px;">Click to submit expenses.</p>
    
                                <a href="expenses-teacher.php"><button class="btn btn-primary text-center  " type="submit" name="submit" >Submit Expenses</button></a>
    
    
                            </div>
                </div>
            </div>
        </div>');
    } ?>

    <?php if ($user_data['role'] == 'parent') {
        echo ('<div class="container-fluid">
        
            <div class="row">
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Enrolment</h1>
                        <p style="font-size:20px;">Submit the form to enrol your child here!</p>
                        <a href="enrollment.php"><button class="btn btn-primary text-center  " type="submit" name="submit" >Start Now</button></a>
                    </div>
                </div>
                <div class="col-md-6 " style="height:500px;">
    
                    <div class="row" style="height:50%;">
                        <div class="col-md-12 border border-dark">
                            <div class="details" style="margin-left:50px;margin-top:50px;">
                                <h1>Submit reason of absence</h1>
                                <p style="font-size:20px;">Submit your reason of absence for your child here.</p>
    
                               <a href="submit_leave_student.php"> <button id="submit_student"class="btn btn-primary text-center  " type="submit" name="submit" >Submit</button></a>
    
    
                            </div>
                        </div>
                    </div>
                    <div class="row" style="height:50%;">
                        <div class="col-lg-12 border border-dark">
                            <div class="details" style="margin-left:50px;margin-top:50px;">
                                <h1>Schedule</h1>
                                <p style="font-size:20px;">See your childs schedule here.</p>
                                <a href ="student.php">
                                <button class="btn btn-primary text-center  " type="submit" name="submit" >View</button>
                                </a>
    
                            </div>
                        </div>
    
                    </div>
                </div>
    
            </div>
            <div class="row">
                <div class="col-lg-7 border border-dark" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Feedback</h1>
                                <p style="font-size:20px;">Send us your feedback so we can improve to make your experience
                                here better.</p>
                                <a href="feedback.php">
                                <button class="btn btn-primary text-center  " type="submit" name="submit" >View</button>
                                </a>
    
                            </div>
                </div>
                <div class="col-lg-5 border border-dark" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Results</h1>
                                <p style="font-size:20px;">Send us your child results so we will know
                                more about their progress</p>
                                <a href="submit_results.php">
                                <button class="btn btn-primary text-center  " type="submit" name="submit">Submit</button>
                                </a>
    
    
                            </div>
                </div>
                <div class="col-lg-12 border border-dark" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Withdrawl Your Child</h1>
                                <p style="font-size:20px;">Withdrawl Your Child From YYD Education Centre</p>
    
                                <a href="withdrawl_child.php"><button class="btn text-center  " type="submit" name="submit">Withdrawl</button></a>
    
    
                            </div>
                </div>
            </div>
        </div>');
    } ?>
    <?php if ($user_data['role'] == 'finance') {
        echo ('<div class="container-fluid">
        
            <div class="row">
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>View payslips</h1>
                        <p style="font-size:20px;">Record down payment sent and store in database.</p>
                        <a href="payslip.php"><button class="btn btn-primary text-center  " type="submit" name="submit" >View</button></a>
                    </div>
                </div>
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Expenses</h1>
                        <p style="font-size:20px;">Click to see expenses log.</p>
                        <a href="expenses.php"><button class="btn btn-primary text-center  " type="submit" name="submit" >View</button></a>
                    </div>
                </div>
                <div class="col-lg-12 border border-dark text-center" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Feedback</h1>
                                <p style="font-size:20px;">Send feedback to whichever department</p>
                                <a href="feedback.php">
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" >Send</button>
                                </a>
    
                            </div>
                </div>
            </div>
           
                
              
           
        </div>');
    } ?>
    <?php if ($user_data['role'] == 'l') {
        echo (' <div class="container-fluid">
        
            <div class="row">
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Lessons</h1>
                        <p style="font-size:20px;">View or create lessons plans and assign it to the
    appropriate teachers</p>
                        <a href="centreroster.php"><button class="btn btn-primary text-center  " type="submit" name="submit" >View</button></a>
                    </div>
                </div>
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Teachers</h1>
                        <p style="font-size:20px;">View the teachers profile and information.</p>
                        <a href="teacher.php"><button class="btn btn-primary text-center  " type="submit" name="submit" >View</button></a>
                    </div>
                </div>
                <div class="col-lg-7 border border-dark text-center" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Broadcast</h1>
                                <p style="font-size:20px;">Broadcast messages to teacher/parents on important information.</p>
    
                                <a href="broadcast.php"><button class="btn btn-primary text-center  " type="submit" name="submit" >Broadcast</button></a>
    
    
                            </div>
                </div>
                <div class="col-lg-5 border border-dark text-center" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Feedback</h1>
                                <p style="font-size:20px;">View or send feedback to other departments.</p>
                                <a href="feedback.php">
                                <button class="btn btn-primary text-center  " type="submit" name="submit" >View</button>
                                </a>
    
                            </div>
                </div>
            </div>
           
                
              
           
        </div>');
    } ?>
    <?php if ($user_data['role'] == 'manager') { 
        echo (' <div class="container-fluid">

            <div class="row">
            <div class="col-md-6 " style="height:700px;">

            <div class="row" style="height:50%;">
                <div class="col-md-12 border border-dark">
                    <div class="details" style="margin-left:50px;margin-top:150px;">
                        <h1>Attendence</h1>
                        <p style="font-size:20px;">See the attendance for all of the students for all of the centres.</p>
                        <a href="attendance_dashboard.php">
                            <button class="btn btn-primary text-center  " type="submit" name="submit">View</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row" style="height:50%;">
                <div class="col-lg-12 border border-dark">
                    <div class="details" style="margin-left:50px;margin-top:150px;">
                        <h1>Check-in</h1>
                        <p style="font-size:20px;">Click to check-in to the centre.</p>
                        <a href="check-in.php">
                            <button class="btn btn-primary text-center  " type="submit" name="submit">Check-in</button>
                        </a>

                    </div>
                </div>
            </div>

        </div>
                <div class="col-md-6 " style="height:700px;">

                    <div class="row" style="height:50%;">
                        <div class="col-md-12 border border-dark">
                            <div class="details" style="margin-left:50px;margin-top:150px;">
                                <h1>Results</h1>
                                <p style="font-size:20px;">See the results for all of the students for all of the
                                    centres.</p>
                                <a href="results_dashboard.php">
                                <button class="btn btn-primary text-center  " type="submit" name="submit">View</button>
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="row" style="height:50%;">
                        <div class="col-lg-12 border border-dark">
                            <div class="details" style="margin-left:50px;margin-top:150px;">
                                <h1>Feedback</h1>
                                <p style="font-size:20px;">Send feedback to other departments.</p>
                                <a href="feedback.php">
                                    <button class="btn btn-primary text-center  " type="submit" name="submit">View</button>
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3 border border-dark ">
                    <div class="details text-center" style="margin-left:50px;margin-top:150px;height:300px;">
                        <h1>View Withdrawls</h1>
                        <p style="font-size:20px;">See all the withdrawls.</p>
                        <a href="all_withdrawl.php"><button class="btn btn-primary text-center  " type="submit" name="submit">View</button></a>
                    </div>
                </div>
                <div class="col-md-3 border border-dark ">
                    <div class="details text-center" style="margin-left:50px;margin-top:150px;height:300px;">
                        <h1>Change P5</h1>
                        <p style="font-size:20px;">See all P5 Students.</p>
                        <a href="studentlistp5.php"><button class="btn btn-primary text-center  " type="submit" name="submit">View</button></a>
                    </div>
                </div>
                <div class="col-md-3 border border-dark ">
                <div class="details text-center" style="margin-left:50px;margin-top:150px;height:300px;">
                    <h1>Broadcast</h1>
                    <p style="font-size:20px;">Broadcast messages to teacher/parents on important information.</p>
                    <a href="broadcast.php"><button class="btn btn-primary text-center  " type="submit" name="submit">View</button></a>
                </div>
                
            </div>
            <div class="col-md-3 border border-dark ">
                <div class="details text-center" style="margin-left:50px;margin-top:150px;height:300px;">
                    <h1>See Centre Lesson Plans</h1>
                    <p style="font-size:20px;">See the centre lesson plan you are in charge of</p>
                    <a href="centreroster.php"><button class="btn btn-primary text-center  " type="submit" name="submit">View</button></a>
                </div>
            </div>


        </div>');
     } ?>

    <?php if ($user_data['role'] == 'admin') {
        echo (' <div class="container-fluid">
        
            <div class="row">
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Enrollment</h1>
                        <p style="font-size:20px;">View all new student enrolment information and send for
                        approval. </p>
                        <a href="enrollment_review.php"><button class="btn btn-primary text-center  " type="submit" name="submit" >View</button></a>
                    </div>
                </div>
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Students</h1>
                        <p style="font-size:20px;">View and edit students details and information.</p>
                        <a href="studentlist.php">
                        <button class="btn btn-primary text-center  " type="submit" name="submit" >View</button>
                        </a>
                    </div>
                </div>
               
                <div class="col-lg-4 border border-dark " style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Feedback</h1>
                                <p style="font-size:20px;">Send feedback to other departments.</p>
                                <a href="feedback.php">
                                <button class="btn btn-primary text-center  " type="submit" name="submit" >View</button>
                                <a>
    
                            </div>
                </div>
                <div class="col-lg-4 border border-dark " style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>View check-ins</h1>
                                <p style="font-size:20px;">View all check-ins from other roles</p>
                                <a href="view_checkin.php">
                                <button class="btn btn-primary text-center  " type="submit" name="submit" >View</button>
                                <a>
    
                            </div>
                </div>
                <div class="col-lg-4 border border-dark " style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>View All Centre Lesson Plan</h1>
                                <p style="font-size:20px;">View all centre lesson plans</p>
                                <a href="centreroster.php">
                                <button class="btn btn-primary text-center  " type="submit" name="submit" >View</button>
                                <a>
    
                            </div>
                </div>
            </div>
            
           
                
              
           
        </div>');
    } ?>
</body>

</html>