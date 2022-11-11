<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("insert-payslip.php");
include("check_attendance.php");
include("check_recurring_roster.php");
$user_data = check_login($con);


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
    <?php
    include("header.php")
    ?>
</header>
<br><br><br><br><br><br><br><br><br><br><br><br>
<script type="text/javascript">
    $(function() {
        $('#centre').on('change', function() {
            $('#filter-posts-form').submit();
        });
    });
   
</script>
<body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <div class="container-fluid">


        <form action="" method="get"id="filter-posts-form" onchange="this.form.submit()">
            <select class="form-control" id="centre" style="width:100%;height:50px;" required name="centre">
                <option selected>Location</option>
                <?php
                            $q = "select * from centre";
                            $all_centre = mysqli_query($con, $q);
                            foreach ($all_centre as $a) : ?>
                                <option value="<?php echo $a['centre_name']?>"><?php echo $a['centre_name']?></option>
                            <?php endforeach ?>
            </select>
        </form>
        <br><br><br>
        <div class="row">


            <?php
            if (isset($_GET['centre'])) {
                $centre = $_GET['centre'];
                $query = "select * from withdrawl WHERE centre_name='$centre'";
                $result = mysqli_query($con, $query);
            }
            if (!isset($_GET['centre'])) {
                $query = "select * from withdrawl";
                $result = mysqli_query($con, $query);
            }
            if (mysqli_num_rows($result) > 0) { ?>
                <?php foreach ($result as $r) : ?>
                    <?php $id = $r['id']; ?>
                    <div class="col-lg-4">
                        <div class="card text-center">
                            <div class="card-header">
                                <h3>Name Of Student: <?php echo $r['student_name'] ?></h3>
                            </div>
                            <div class="card-body">
                                
                                <h3 class="card-text">Centre Name: <?php echo $r['centre_name'] ?></h3>
                                <h3 class="card-text">Primary Level: <?php echo $r['level'] ?></h3>
                                <h5 class="card-text">Last Day: <?php echo $r['last_day'] ?></h5>
                               
                            </div>

                        </div>
                    </div>
                <?php endforeach ?>
            <?php } else {
                echo ("<div class='col-lg-12'><h1 class='text-center'>There is no record </h1></div>");
            } ?>



        </div>
    </div>
</body>

</html>