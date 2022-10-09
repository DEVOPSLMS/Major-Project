<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$id = intval($_GET['id']);
$query = "select * from roster where id = '$id'";
$result = mysqli_query($con, $query);
$lesson_details = mysqli_fetch_assoc($result);
$date = date('jS M');
$students = (explode(',', $lesson_details['students']));
$class = $lesson_details['timing'] . ' ' . $lesson_details['subject'] . ' ' . 'Class' . ' ' . $date;


?>
<?php
if (isset($_POST["submit"])) {
    foreach ($students as $student) {
        print_r($student);
        $name = $lesson_details["teacher_name"];
       
    }
    $status = $_POST['status'];
    print_r($status);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Attendance Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<header>
    <?php include('header.php') ?>
</header>

<body>
    <form method="POST" name="form1">
        <br>
        <a href="lesson_details.php?id=<?php echo ($id) ?>" class="btn btn-primary" name="hod" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;width:80px;height:40px;">Back</a>
        <br><br>
        <div class="row">
            <div class="col-lg-3 ">
                <h3>Date: <input type="date" disabled value="<?php echo (date('Y-m-d')) ?>"></h3>

            </div>
            <div class="col-lg-3 " name="teacher">

                <h3>Teacher: <?php echo ($lesson_details['teacher_name']) ?></h3>
            </div>
            <div class="col-lg-6 ">

                <h3>Level/Subject: <?php echo ($lesson_details['level']) ?>/<?php echo ($lesson_details['subject']) ?></h3>
            </div>

            <div class="col-lg-3">

                <h3>Centre: <input type="text" style="text-transform: capitalize;" disabled value="<?php echo ($lesson_details['centre_name']) ?>"></h3>
            </div>
            <div class="col-lg-8">

                <h3>Timing: <?php echo ($lesson_details['timing']) ?></h3>
            </div>
            <div class="col-lg-1">

                <button class="btn btn-primary" name="submit" type="submit" style="background-color:#F92C85;color:white;border-color:#F92C85;margin:auto;height:40px;">Submit</button>
            </div>

        </div>

        <table class="table table-striped">
            <tr>

                <th class="success">Student Name</th>
                <th class="warning">Attendance <p class="active">
                        <input type="checkbox" class="select-all checkbox" name="select-all" onclick="selectAll(form1)" />(Mark All As Present)
                    </p>
                </th>
                <th class="danger">Remarks</th>

            </tr>
            <?php foreach ($students as $student) : ?>
                <tr>
                    <td class="success" name="student_name"><?php echo ($student) ?></td>

                    <td class="active" required>


                        <input type="checkbox" class="select-item checkbox" name="status" value="present" />Present
                        <input type="checkbox" class="select checkbox" name="status" value="late" />Late
                        <input type="checkbox" class="select checkbox" name="status" value="absent" />Absent
                       


                    </td>
                    <td class="success">
                        <textarea class="form-control" rows="4" cols="50" style="width:100%;"></textarea>
                    </td>



                </tr>
            <?php endforeach; ?>


        </table>

    </form>

</body>
<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    $(function() {

        //button select all or cancel


        //button select invert


        //column checkbox select all or cancel
        $("input.select-all").click(function() {
            var checked = this.checked;
            $("input.select-item").each(function(index, item) {
                item.checked = checked;
            });
        });

        //check selected items
        $("input.select-item").click(function() {
            var checked = this.checked;
            console.log(checked);
            checkSelected();
        });

        //check is all selected
        function checkSelected() {
            var all = $("input.select-all")[0];
            var total = $("input.select-item").length;
            var len = $("input.select-item:checked:checked").length;

            all.checked = len === total;
        }
    });
</script>

</html>