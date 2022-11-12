<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("insert-payslip.php");
include("check_attendance.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
$user_data = check_login($con);
if ($user_data['role'] != 'parent') {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Withdrawl Of Child</title>
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

<body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <div class="container-fluid">

        <div class="row">
            <?php
            $id = $user_data['id'];
            $name = $user_data['username'];
            $query = "select * from student where parentid = $id ";
            $result = mysqli_query($con, $query);

            ?>
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php foreach ($result as $parent) : ?>
                    <?php
                    $sql = "select * from withdrawl where parent_name = '$name' ";
                    $result2 = mysqli_query($con, $sql);
                    $withdrawl = mysqli_fetch_assoc($result2);
                    ?>
                    <div class="col-lg-12">
                        <div class="card text-center">
                            <h5 class="card-header">Student Name: <?php echo $parent['student_name'] ?></h5>
                            <div class="card-body">
                                <h5 class="card-title">Student Level: <?php echo $parent['student_level'] ?></h5>
                                <p class="card-text">Centre Name: <?php echo $parent['centre_name'] ?></p>
                                <?php if ($withdrawl['student_name'] == $parent['student_name']) { ?>
                                    <h3>Child Is Already Withdrawn</h3>
                                <?php } else { ?>
                                    <a href="withdrawl.php?id=<?php echo $parent['id'] ?>" class="btn btn-primary" style="font-size:15px;">Withdrawl Child</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php } else { ?>
                <div class="col-lg-12">
                    <div class="card text-center">
                        <h5 class="card-header">Please Enroll Your Kid First.</h5>

                    </div>
                </div>
            <?php } ?>
        </div>


    </div>
</body>

</html>