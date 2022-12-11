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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<header>
    <?php include("header.php") ?>
</header>
<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>

<body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <div class="container-fluid">
        <a class="btn" href="past-payslip.php" class="col-lg-12" style="width:100%;">See Past Payslips</a>
        <br><br><br><br>
        <form action="" method="get" onsubmit="this.form.submit()">
            <input class="form-control" style="width:100%;height:50px;" type="text" placeholder="Search For Reference Number Or Teacher Name" name="search" value="<?php if (isset($_GET['search'])) {
                                                                                                                                                                        echo $_GET['search'];
                                                                                                                                                                    } ?>">
        </form>
        <br>
        <form action="" method="get">
            <div class="col-lg-12">


                <div class="row">
                    <select class="col-lg-6  form-control" id="primary" style="height:50px;width:100%;" required name="month">
                        <option value="">Month</option>
                        <option value="Jan">January</option>
                        <option value="Feb">February</option>
                        <option value="Mar">March</option>
                        <option value="Apr">April</option>
                        <option value="May">May</option>
                        <option value="Jun">June</option>
                        <option value="Jul">July</option>
                        <option value="Aug">August</option>
                        <option value="Sep">September</option>
                        <option value="Oct">October</option>
                        <option value="Nov">November</option>
                        <option value="Dec">December</option>
                    </select>
                    <select class="col-lg-6 form-control" id="primary" style="height:50px;width:100%;" required name="year">
                        <option value="">Year</option>
                        <?php
                        $year_query = "select year from payslip where status = 'false'";
                        $all_years = mysqli_query($con, $year_query);

                        $arr = [];
                        foreach ($all_years as $year) {
                            $years = $year['year'];
                            $string = ['year' => $years];

                            array_push($arr, $string);
                        }

                        $array = array_unique($arr, SORT_REGULAR);

                        foreach ($array as $years) : ?>
                            <option value="<?php echo $years['year'] ?>"><?php echo $years['year'] ?></option>
                        <?php endforeach ?>

                    </select>
                    <button class="btn" type="submit" name="filter" style="font-size:15px;">Filter</button>
                </div>
            </div>
        </form>
        <br><br><br>
        <div class="row">
            <?php
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $query = "select * from payslip where  reference LIKE '%" . $search . "%' OR teacher_name LIKE '%" . $search . "%' and status = 'false'";
                $result = mysqli_query($con, $query);
            }
            if (!isset($_GET['search'])) {
                $query = "select * from payslip where status = 'false' ";
                $result = mysqli_query($con, $query);
            }
            if (isset($_GET['filter'])) {
                $user_month = strval($_GET['month']);
                $user_year = $_GET['year'];

                $query = "select * from payslip  where status='false'and month='$user_month' and year ='$user_year'";
                $result = mysqli_query($con, $query);
            }
            if (mysqli_num_rows($result) > 0) { ?>
                <?php foreach ($result as $r) : ?>
                    <?php $id = $r['id']; ?>
                    <div class="col-lg-4">

                        <div class="card">
                            <h5 class="card-header"><?php echo ($r['teacher_name']) ?>, <?php echo ($r['month']) ?>, <?php echo ($r['year']) ?></h5>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo ($r['centre']) ?></h5>
                                <p class="card-text">Total Amount Of Session Worked: <?php echo ($r['total_hours']) ?></p>
                                <p class="card-text">Total Amount: $<?php echo ($r['total_amount']) ?></p>
                                <p class="card-text">Reference Number: <?php echo ($r['reference']) ?></p>
                                <a style="font-size:15px;" onclick='
            if(confirm("Are you sure?") == false) {
                return false;
            } else {
              
                        
                href="update_payslip.php?id=<?php echo $id ?>"
                    
            }' class="btn">Pay</a>
                                <button class='btn btn-success hoursbtn' style="font-size:15px">Month's class details</button>
                                <button class='btn btn-success' data-toggle="modal" data-target=".bd2-example-modal-lg" style="font-size:15px">Update Per Hour Pay</button>
                                <div class="modal fade bd-example-modal-lg" id="hoursmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Month's class details</h5>
                                            </div>

                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "website");


                                            $month = $r['month'];
                                            $year = $r['year'];



                                            $teacher_name = $r['teacher_name'];

                                            $start_date = '' . $year . '-' . $month . '-01';


                                            $end_date = ('' . $year . '-' . $month . '');


                                            $end_date = date('Y-m-t', strtotime($end_date));

                                            $start_date = date('Y-m-d', strtotime($start_date));
                                            $sql = "SELECT * from roster where teacher_name='$teacher_name'and date between '$start_date' and '$end_date' ";
                                            $result = $connection->query($sql);

                                            ?>



                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Timing</th>
                                                    <th>Class</th>
                                                    <th>Centre</th>
                                                    <th>Attendance Taken</th>
                                                    <th>Cancelled</th>
                                                </tr>

                                                <?php while ($row = $result->fetch_object()) : ?>

                                                    <tr>
                                                        <td>
                                                            <?php echo $row->date; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row->timing; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row->level; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row->centre_name; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row->attendance_taken; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row->cancelled; ?>
                                                        </td>
                                                    <tr>

                                                    <?php endwhile; ?>

                                            </table>




                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade bd2-example-modal-lg" id="paymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Month's class details</h5>
                                            </div>
                                            <?php if (isset($_POST['paysubmit'])) {
                                                session_start();
                                        $pay = $_POST['dollar'];
                                        
                                        $id=$r['id'];
                                        $sql = ("UPDATE  payslip SET `total_amount`='$pay' WHERE id = $id ");
                                        $result = mysqli_query($con, $sql);
                                        $currentpage_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                        echo '<script>window.location.href="'.$currentpage_url.'";</script>';
                                    
                                                                   }
                                    ?>
                                            <form action=""method="POST">
                                            <div class="modal-body">
                                                <label for="">Total Amount Pay</label>
                                                <?php  ?>
                                                <input type="text" class="form-control " value="<?php echo $r['total_amount'] ?>" name="dollar" style="font-size:20px;height:30px;">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" style="font-size:15px;" class="btn" data-dismiss="modal">Close</button>
                                                <button type="submit" name="paysubmit" style="font-size:15px;" class="btn">Update Pay</button>
                                            </div>
                                            </form>
                                           










                                        </div>
                                    </div>
                              
                                </div>
                            </div>
                        </div>

                    </div>

                <?php endforeach ?>
            <?php } else {
                echo ("<div class='col-lg-12'><h1 class='text-center'>There is no record </h1></div>");
            } ?>
        </div>
    </div>




    <script>
        $(document).ready(function() {

            $('.hoursbtn').on('click', function() {

                $('#hoursmodal').modal('show');
            });
        });
    </script>
</body>

</html>