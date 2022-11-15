<?php
session_start();
include("check_roster.php");
include("check_teacher.php");
include("connection.php");
include("functions.php");
include("insert-payslip.php");
include("check_attendance.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
$user_data = check_login($con);
if ($user_data['role'] != 'finance') {
    header('HTTP/1.0 403 Forbidden');
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <header>
    <?php include("header.php") ?>
</header>
<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <div class="container-fluid">
    <form action=""method="get"onsubmit="this.form.submit()">
    <input class="form-control" style="width:100%;height:50px;"type="text"placeholder="Search For Reference Number Or Teacher Name"name="search"value="<?php if (isset($_GET['search'])) {
                                                    echo $_GET['search'];
                                                } ?>">
                        </form>
                        <br>
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
                        $year_query = "select date from expenses where status = 'false'";
                        $all_years = mysqli_query($con, $year_query);
                        $key = "Date";
                        $arr = [];
                        foreach ($all_years as $year) {
                            $date = date($year['date']);
            
                            $year = date("Y", strtotime($date));
                            $str = explode(",", $year);
                            $string = ['year' => $year];
            
                            array_push($arr, $string);
                            $unique_year = implode(",", array_unique($str));
                            
                        }
                       
                       $array = array_unique($arr, SORT_REGULAR);

                        foreach($array as $years):?>
                         <option value="<?php echo $years['year']?>"><?php echo $years['year']?></option>
                        <?php endforeach?>

                    </select>
                    <button class="btn" type="submit" name="filter" style="font-size:15px;">Filter</button>
                </div>
            </div>
        </form>
        <br><br><br>
        <div class="row">
            <?php
            if(isset($_GET['search'])){
                $search=$_GET['search'];
                $query = "select * from expenses where reference LIKE '%" . $search . "%'OR name LIKE'%".$search."%' and status = 'true'  ";
                
            $result = mysqli_query($con, $query);
            }
            if(!isset($_GET['search']) && !isset($_GET['filter'])){
                $query = "select * from expenses where status = 'true' ";
                $result = mysqli_query($con, $query);
            }
            if (isset($_GET['filter'])) {
                $user_month = strval($_GET['month']);
                $user_year = $_GET['year'];
                $date_string=''.$user_year.'-'.$user_month.'-01';
                $first_day=date($date_string);
               
                $last_day = date(''.$user_year.'-'.$user_month.'-t');
                $query = "select * from expenses  where status='false'and date between '$first_day' and '$last_day' ";
                $result = mysqli_query($con, $query);
                
            }
    
            if (mysqli_num_rows($result) > 0) { ?>
                <?php foreach ($result as $r) : ?>
                    <?php $id=$r['id'];?>
                    <div class="col-lg-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <h3>Name Of Staff: <?php echo$r['name']?></h3>
                        </div>
                        <div class="card-body">
                        <?php
                                $images = explode(",", $r['image']);
                                foreach ($images as $image) : ?>

                                    <img style="height:150px;width:150px;" src=expenses/<?php echo $image ?>>
                                <?php endforeach ?>
                               
                            <br>   <br>
                            <h3 class="card-text">Price: <?php echo$r['price']?></h3>
                            <h3 class="card-text">Purpose: <?php echo$r['purpose']?></h3>
                            <h5 class="card-text">Reference Number: <?php echo$r['reference']?></h5>
                        </div>

                    </div>
                </div>
                <?php endforeach ?>
            <?php }else{
                echo("<div class='col-lg-12'><h1 class='text-center'>There is no record</h1></div>");
            } ?>
        </div>
    </div>
  </body>
</html>