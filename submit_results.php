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
    <title>Submit results for child</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<header>
    <?php
    include("header.php")
    ?>
</header>
<br><br><br><br><br><br><br><br><br><br><br><br>

<body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <div class="container-fluid">

        <div class="row">
            <?php
            $id = $user_data['id'];
            $name = $user_data['username'];
            $query = "select * from student where parentid = $id and status ='Enrolled'";
            $result = mysqli_query($con, $query);

            ?>
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php foreach ($result as $parent) : ?>
                    <div class="col-lg-12">
                        <div class="card text-center">
                            <h5 class="card-header">Submit results for: <?php echo $parent['student_name'] ?></h5>
                            <div class="card-body">
                                <h5 class="card-title">Student Level: <?php echo $parent['student_level'] ?></h5>
                                <p class="card-text">Centre Name: <?php echo $parent['centre_name'] ?></p>
                                <button class="btn btn-primary submitbtn" style="font-size:15px">Enter child's result</button>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php } ?>
        </div>


    </div>
</body>

<div class="modal fade" id="submitmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-weight: bold; font-size: 14px; color: black; float: left; padding: 8px 16px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-weight: bold; font-size: 16px"> Child's results </h5>
            </div>

            <form action="postresults.php" method="POST">

                <div class="modal-body" style="text-align: right">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="form-group">

                        <label> Name </label>
                        <select class="col-sm-10 form-select" id="student_name" name="student_name" required>
                        <?php
                            $id = $user_data['id'];
                            $q = "select * from student where parentid = $id";
                            $all_children = mysqli_query($con, $q);
                            foreach ($all_children as $a) : ?>
                            <option value="<?php echo $a['student_name'] ?>"><?php echo $a['student_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <br>
                        <label> Centre </label>
                        <select class="col-sm-10 form-select" id="centre_name" name="centre_name" required>
                            <?php
                            $q = "select * from centre";
                            $all_centre = mysqli_query($con, $q);
                            foreach ($all_centre as $a) : ?>
                                <option value="<?php echo $a['centre_name'] ?>"><?php echo $a['centre_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <br>
                        <label> Level </label>
                        <select class="col-sm-10 form-select" id="level" name="level" required>
                            <option>P1</option>
                            <option>P2</option>
                            <option>P3</option>
                            <option>P4</option>
                            <option>P5(N)</option>
                            <option>P5(F)</option>
                            <option>P6(N)</option>
                            <option>P6(F)</option>
                        </select>
                        <br>        
                        <label> Subject </label>
                        <select class="col-sm-10 form-select" id="subject" name="subject" required>
                            <option>Math</option>
                            <option>Science</option>
                            <option>English</option>
                        </select>
                        <br>
                        <label> AL </label>
                        <select class="col-sm-10 form-select" id="al" name="al" required>
                            <option>AL1 (≥ 90)</option>
                            <option>AL2 (85 - 89)</option>
                            <option>AL3 (80 - 84)</option>
                            <option>AL4 (75 - 79)</option>
                            <option>AL5 (65 - 74)</option>
                            <option>AL6 (45 - 64)</option>
                            <option>AL7 (20 - 44)</option>
                            <option>AL8 (< 20)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class='btn btn-success' type="submit" name="submitresults" name='submit' style='font-size: 16px; background-color:#5EBEC4;color:black;border-color:#5EBEC4;'>Submit results</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {

        $('.submitbtn').on('click', function() {

            $('#submitmodal').modal('show');

            
        });
    });
</script>

</html>