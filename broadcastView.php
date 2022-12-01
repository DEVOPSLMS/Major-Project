<?php
session_start();

include("connection.php");
include("functions.php");
include("check_roster.php");
include("insert-payslip.php");
include("check_teacher.php");
include("check_attendance.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
$user_data = check_login($con);
$username = $user_data['username'];
date_default_timezone_set("Singapore");
if ($user_data['role'] != 'manager')  {
    if ($user_data['role'] != 'l')  {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
}
?>

<!-- broadcast for L&D -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Broadcast</title>
    <link href="style.css" rel="stylesheet" type="text/css">

    <link href="feedback.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>


<header>

    <?php include("header.php");


    ?>



</header>

<body>

    <div class="container" style="margin-top: 200px;" id="messageBroadcast">
        <form action="" method="get">
            <div class="col-lg-12">


                <div class="row">
                    <select class="col-lg-6  form-control" id="primary" style="height:50px;width:100%;" required name="month">
                        <option value="">Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <select class="col-lg-6 form-control" id="primary" style="height:50px;width:100%;" required name="year">
                        <option value="">Year</option>
                        <?php
                        $arr = [];
                        $year_query = "select * from broadcast";
                        $all_years = mysqli_query($con, $year_query);

                        $arr = [];
                        foreach ($all_years as $year) {
                            $date = $year['date'];
                            $year = date("Y", strtotime($date));
                            $string = ['year' => $year];

                            array_push($arr, $string);
                        }

                        $array = array_unique($arr, SORT_REGULAR);

                        foreach ($array as $years) : ?>
                            <option value="<?php echo $years['year'] ?>"><?php echo $years['year'] ?></option>
                        <?php endforeach ?>

                    </select>
                    <button class="btn" type="submit" name="filter" style="font-size:15px;width:100%;">Filter</button>
                </div>
            </div>
        </form>
        <br>
        <?php
        if (!isset($_GET['filter'])) {
            $broadcast = mysqli_query($con, "select * from broadcast");
        }
        if (isset($_GET['filter'])) {
            $month = strval($_GET['month']);
            $year = $_GET['year'];
         
            $date_string=''.$year.'-'.$month.'-01';
            $first_day=date($date_string);
         
            $last_day = date(''.$year.'-'.$month.'-t');
            $broadcast = mysqli_query($con, "select * from broadcast where date between '$first_day'and '$last_day'");
          
        }
 if(mysqli_num_rows($broadcast) > 0){
        
        foreach ($broadcast as $b) : ?>
       
            <div class="card">
                <div class="card-header">
                    Message Title:<?php echo $b['message_title'] ?>  By,<?php echo $b['sender'] ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h3><?php echo $b['message'] ?></h3>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <p class="col-lg-6"><i class="fa fa-calendar " aria-hidden="true"></i><?php echo $b['date'] ?></p>
                                <p class="col-lg-6"><i class="fa fa-user" aria-hidden="true"></i><?php echo $b['recipient'] ?></p>
                                <p class="col-lg-6"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $b['centre'] ?></p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <br>
           
        <?php endforeach   ?>
        <?php }else{?>
                <h1 class="text-center">No Record Found</h1>
                <?php }?>
    </div>

</body>


</html>