<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

?>
<!DOCTYPE html>
<html>

<head>


    <title>Home Page</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<header>
    <?php include("header.php") ?>


</header>
<style>
    @media(max-width:500px) {
            .btn {
 
                /* It hides the button text
                when screen size <=768px */
                display: none;
            }
        }
</style>

<body>
<?php if($user_data['role'] == 'teacher')
        {
            echo('<div class="container-fluid">
        
            <div class="row">
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Schedule</h1>
                        <p style="font-size:20px;">View timeslots of the classes that you have.</p>
                        <a href="schedule.php"><button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;float:right;margin-top:140px;margin-right:20px;width:100px ;">View</button></a>
                    </div>
                </div>
                <div class="col-md-6 " style="height:500px;">
    
                    <div class="row" style="height:50%;">
                        <div class="col-md-12 border border-dark">
                            <div class="details" style="margin-left:50px;margin-top:50px;">
                                <h1>Submit leave</h1>
                                <p style="font-size:20px;">Submit your reasons of absence here.</p>
    
                                <a href="submitleave.php"><button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;float:right;">Submit</button></a>
    
    
                            </div>
                        </div>
                    </div>
                    <div class="row" style="height:50%;">
                        <div class="col-lg-12 border border-dark">
                            <div class="details" style="margin-left:50px;margin-top:50px;">
                                <h1>Attendance</h1>
                                <p style="font-size:20px;">Click to mark attendance for your classes.</p>
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;float:right;">View</button>
    
    
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
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;margin-top:40px;float:right;">Check-in</button>
    
    
                            </div>
                </div>
                <div class="col-lg-5 border border-dark" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Payslip</h1>
                                <p style="font-size:20px;">Check your payslips.</p>
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;float:right;margin-top:40px;">View</button>
    
    
                            </div>
                </div>
            </div>
        </div>');
        }?>
    
    <?php if($user_data['role'] == 'parent')
        {
            echo('<div class="container-fluid">
        
            <div class="row">
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Enrolment</h1>
                        <p style="font-size:20px;">Submit the form to enrol your child here!</p>
                        <a href="enrollment.php"><button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;float:right;margin-top:140px;margin-right:20px;width:100px ;">Start Now</button></a>
                    </div>
                </div>
                <div class="col-md-6 " style="height:500px;">
    
                    <div class="row" style="height:50%;">
                        <div class="col-md-12 border border-dark">
                            <div class="details" style="margin-left:50px;margin-top:50px;">
                                <h1>Submit reason of absence</h1>
                                <p style="font-size:20px;">Submit your reason of absence for your child here.</p>
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;float:right;">Submit</button>
    
    
                            </div>
                        </div>
                    </div>
                    <div class="row" style="height:50%;">
                        <div class="col-lg-12 border border-dark">
                            <div class="details" style="margin-left:50px;margin-top:50px;">
                                <h1>Schedule</h1>
                                <p style="font-size:20px;">See your childs schedule here.</p>
                                <a href ="schedule.php">
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;float:right;">View</button>
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
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;margin-top:40px;float:right;">View</button>
                                </a>
    
                            </div>
                </div>
                <div class="col-lg-5 border border-dark" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Results</h1>
                                <p style="font-size:20px;">Send us your child results so we will know
                                more about their progress</p>
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;float:right;margin-top:10px;">Submit</button>
    
    
                            </div>
                </div>
            </div>
        </div>');
        }?>
      <?php if($user_data['role'] == 'finance')
        {
            echo('<div class="container-fluid">
        
            <div class="row">
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>View payslips</h1>
                        <p style="font-size:20px;">Record down payment sent and store in database.</p>
                        <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;float:right;margin-top:140px;margin-right:20px;width:100px ;">View</button>
                    </div>
                </div>
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Expenses</h1>
                        <p style="font-size:20px;">Click to see expenses log.</p>
                        <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;float:right;margin-top:140px;margin-right:20px;width:100px ;">View</button>
                    </div>
                </div>
                <div class="col-lg-12 border border-dark text-center" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Feedback</h1>
                                <p style="font-size:20px;">Send feedback to whichever department</p>
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;margin-top:40px;float:right;">Send</button>
    
    
                            </div>
                </div>
            </div>
           
                
              
           
        </div>');
        }?>  
        <?php if($user_data['role'] == 'l')
        {
            echo(' <div class="container-fluid">
        
            <div class="row">
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Lessons</h1>
                        <p style="font-size:20px;">View or create lessons plans and assign it to the
    appropriate teachers</p>
                        <a href="centreroster.php"><button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;float:right;margin-top:140px;margin-right:20px;width:100px ;">View</button></a>
                    </div>
                </div>
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Teachers</h1>
                        <p style="font-size:20px;">View the teachers profile and information.</p>
                        <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;float:right;margin-top:140px;margin-right:20px;width:100px ;">View</button>
                    </div>
                </div>
                <div class="col-lg-7 border border-dark text-center" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Broadcast</h1>
                                <p style="font-size:20px;">Broadcast messages to teacher/parents on important information.</p>
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;margin-top:40px;float:right;">Broadcast</button>
    
    
                            </div>
                </div>
                <div class="col-lg-5 border border-dark text-center" style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Feedback</h1>
                                <p style="font-size:20px;">View or send feedback to other departments.</p>
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;margin-top:40px;float:right;">View</button>
    
    
                            </div>
                </div>
            </div>
           
                
              
           
        </div>');
        }?>  
         <?php if($user_data['role'] == 'manager')
        {
            echo('  <div class="container-fluid">
        
            <div class="row">
                <div class="col-md-6 border border-dark" style="height:700px;">
                    <div class="details" style="margin-left:50px;margin-top:300px;">
                        <h1>Attendance</h1>
                        <p style="font-size:20px;">See the attendance for all of the students for all of the
    centres.</p>
                        <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;float:right;margin-top:200px;margin-right:20px;width:100px ;">View</button>
                    </div>
                </div>
                <div class="col-md-6 " style="height:700px;">
    
                    <div class="row" style="height:50%;">
                        <div class="col-md-12 border border-dark">
                            <div class="details" style="margin-left:50px;margin-top:150px;">
                                <h1>Results</h1>
                                <p style="font-size:20px;">See the results for all of the students for all of the
    centres.</p>
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;float:right;">View</button>
    
    
                            </div>
                        </div>
                    </div>
                    <div class="row" style="height:50%;">
                        <div class="col-lg-12 border border-dark">
                            <div class="details" style="margin-left:50px;margin-top:150px;">
                                <h1>Feedback</h1>
                                <p style="font-size:20px;">Send feedback to other departments.</p>
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;float:right;">View</button>
    
    
                            </div>
                        </div>
    
                    </div>
                </div>
    
            </div>
          
        </div>');
        }?>  
      
      <?php if($user_data['role'] == 'admin')
        {
            echo(' <div class="container-fluid">
        
            <div class="row">
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Enrollment</h1>
                        <p style="font-size:20px;">View all new student enrolment information and send for
                        approval. </p>
                        <a href="enrollment.php"><button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;float:right;margin-top:140px;margin-right:20px;width:100px ;">View</button></a>
                    </div>
                </div>
                <div class="col-md-6 border border-dark" style="height:500px;">
                    <div class="details" style="margin-left:50px;margin-top:200px;">
                        <h1>Students</h1>
                        <p style="font-size:20px;">View and edit students details and information.</p>
                        <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;float:right;margin-top:140px;margin-right:20px;width:100px ;">View</button>
                    </div>
                </div>
                <div class="col-lg-7 border border-dark " style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Storage</h1>
                                <p style="font-size:20px;">View and store all forms.</p>
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;margin-top:40px;float:right;">View</button>
    
    
                            </div>
                </div>
                <div class="col-lg-5 border border-dark " style="height:300px;">
                <div class="details" style="margin-left:50px;margin-top:100px;">
                                <h1>Feedback</h1>
                                <p style="font-size:20px;">Send feedback to other departments.</p>
    
                                <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;margin-top:40px;float:right;">View</button>
    
    
                            </div>
                </div>
            </div>
           
                
              
           
        </div>');
        }?>  
</body>

</html>