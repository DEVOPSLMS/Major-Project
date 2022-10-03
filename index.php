<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

?>
<!DOCTYPE html>
<html>

<head>


    <title>Title of the document</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<header>
    <?php include("header.php") ?>


</header>


<body>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6 border border-dark" style="height:500px;">
                <div class="details" style="margin-left:50px;margin-top:200px;">
                    <h1>Schedule</h1>
                    <p style="font-size:20px;">View timeslots of the classes that you have.</p>
                    <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;float:right;margin-top:140px;margin-right:20px;width:100px ;">View</button>
                </div>
            </div>
            <div class="col-md-6 " style="height:500px;">

                <div class="row" style="height:50%;">
                    <div class="col-md-12 border border-dark">
                        <div class="details" style="margin-left:50px;margin-top:50px;">
                            <h1>Submit leave</h1>
                            <p style="font-size:20px;">Submit your reasons of absence here.</p>

                            <button class="btn btn-primary text-center  " type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:100px ;margin-right:20px;float:right;">Submit</button>


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
    </div>


</body>

</html>