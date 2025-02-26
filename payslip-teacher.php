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
$username=$user_data['username'];
if ($user_data['role'] != 'teacher') {
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
        
        <form action=""method="get"onsubmit="this.form.submit()">
    <input class="form-control" style="width:100%;height:50px;"type="text"placeholder="Search For Reference Number "name="search"value="<?php if (isset($_GET['search'])) {
                                                    echo $_GET['search'];
                                                } ?>">
                        </form>
        <br><br><br>
        <div class="row">
            <?php
            if(isset($_GET['search'])){
                $search=$_GET['search'];
                $query = "select * from payslip where status = 'true' and teacher_name='$username' and reference LIKE '%" . $search . "%' ";
            $result = mysqli_query($con, $query);
            }
            if(!isset($_GET['search'])){
                $query = "select * from payslip where teacher_name='$username'and status='true' ";
                $result = mysqli_query($con, $query);
            }
            if (mysqli_num_rows($result) > 0) { ?>
                <?php foreach ($result as $r) : ?>
                    <?php $id=$r['id'];?>
                    <div class="col-lg-4">

                        <div class="card">
                            <h5 class="card-header">For: <?php echo ($r['month']) ?>, <?php echo ($r['year'])?></h5>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo ($r['centre']) ?></h5>
                                <p class="card-text">Total Amount Of Sessions Worked: <?php echo ($r['total_sessions']) ?></p>
                                <p class="card-text">Total Amount: $<?php echo ($r['total_amount']) ?></p>
                                <p class="card-text">Reference Number: <?php echo ($r['reference']) ?></p>
                                
                            </div>
                        </div>


                    </div>
                <?php endforeach ?>
            <?php }else{
                echo("<div class='col-lg-12'><h1 class='text-center'>There is no record </h1></div>");
            } ?>
        </div>
    </div>
</body>

</html>