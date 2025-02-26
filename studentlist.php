<?php
session_start();
include("check_roster.php");
include("connection.php");
include("functions.php");
include("check_teacher.php");
include("insert-payslip.php");
include("add_level.php");
include("check_withdrawl.php");
include("check_recurring_roster.php");
$user_data = check_login($con);
if ($user_data['role'] != 'admin') {
    header('HTTP/1.0 403 Forbidden');
    exit;
}
if (!isset($_GET['centre']) && !isset($_GET['primary']) && !isset($_GET['search'])) {
    $student = mysqli_query($con, "SELECT * FROM student WHERE status='Enrolled' ");
    $num = mysqli_num_rows($student);
}
?>
<style>
    .pagination {
        display: inline-block;


    }

    .pagination a {
        font-weight: bold;
        font-size: 18px;
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        border: 1px solid black;
    }

    .pagination a.active {
        background-color: pink;
    }

    .pagination a:hover:not(.active) {
        background-color: skyblue;
    }
</style>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List of students</title>

    <header>
        <?php include("header.php") ?>
    </header>

    <style>
        @media(max-width:950px) {

            #search {
                width: 100% !important;
                height: 40px !important;
            }

            #centre {
                width: 100% !important;
            }

            #primary {
                width: 110% !important;
            }
        }

        h1 {
            text-align: center;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<script type="text/javascript">
    $(function() {
        $('#centre').on('change', function() {
            $('#filter-posts-form').submit();
        });
    });
    $(function() {
        $('#primary').on('change', function() {
            $('#filter-posts').submit();
        });
    });
</script>
<br><br><br><br><br><br><br><br><br><br>

<body>

    <h1>List of Students</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Student name</th>
                <th>
                    <form method="get" id="filter-posts-form" onchange="this.form.submit()">

                        <select class="form-select" id="centre" style="width:150px;height:40px;" required name="centre">
                            <option value="">Location</option>
                            <?php
                            $q = "select * from centre";
                            $all_centre = mysqli_query($con, $q);
                            foreach ($all_centre as $a) : ?>
                                <option value="<?php echo $a['centre_name'] ?>"><?php echo $a['centre_name'] ?></option>
                            <?php endforeach ?>


                        </select>

                    </form>
                </th>
                <th>
                    <form method="get" id="filter-posts" onchange="this.form.submit()">

                        <select class="form-select" id="primary" style="width:150px;height:40px;" required name="primary">
                            <option selected>Primary</option>
                            <option value="P1">P1</option>
                            <option value="P2">P2</option>
                            <option value="P3">P3</option>
                            <option value="P4">P4</option>
                            <option value="P5(N)">P5(N)</option>
                            <option value="P5(F)">P5(F)</option>
                            <option value="P6(N)">P6(N)</option>
                            <option value="P6(F)">P6(F)</option>
                            <option value="S1">Sec 1</option>
                            <option value="S2">Sec 2</option>
                            <option value="S3">Sec 3</option>
                            <option value="S4">Sec 4</option>
                            <option value="S5">Sec 5</option>

                        </select>

                    </form>
                </th>
                <th>
                    <form action="" method="get" onsubmit="this.form.submit()">
                        <input type="text" name="search" id="search" placeholder="Search Student Name" class="form-control" style="width:50%;" value="<?php if (isset($_GET['search'])) {
                                                                                                                                                            echo $_GET['search'];
                                                                                                                                                        } ?>">
                    </form>

                </th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (!isset($_GET['centre']) && !isset($_GET['primary']) && !isset($_GET['search'])) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "website";

                $connection = new mysqli($servername, $username, $password, $database);

                $sql = "SELECT * FROM student WHERE status='Enrolled'";
                $result = $connection->query($sql);
                $per_page_record = 10;  // Number of entries to show in a page.   
                // Look for a GET variable page if not found default is 1.        
                if (isset($_GET["page"])) {
                    $page  = $_GET["page"];
                } else {
                    $page = 1;
                }

                $start_from = ($page - 1) * $per_page_record;

                $query = "SELECT * FROM student Where status ='Enrolled'LIMIT $start_from, $per_page_record";
                $rs_result = mysqli_query($con, $query);
                $rowcount = mysqli_num_rows($rs_result);
                $total_records = $num;
                while ($row = $rs_result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row["student_name"] . "</td>
                    <td>" . $row["centre_name"] . "</td> 
                    <td><p style='margin-left:30px;'>" . $row["student_level"] . "</p></td>
                    <td>
                        <button class='btn btn-success editbtn' type='submit' name='submit'  >Transfer</button>
                        <button class='btn btn-success deletebtn' type='submit' name='submit'  >Remove</button>
                    </td>
                </tr>";
                }
            }
            if (isset($_GET['centre'])) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "website";

                $connection = new mysqli($servername, $username, $password, $database);
                $centre = $_GET['centre'];
                $sql = "SELECT * FROM student WHERE centre_name='$centre'and status='Enrolled'";
                $result = $connection->query($sql);
                $rows = mysqli_num_rows($result);
                $result = $connection->query($sql);
                $per_page_record = 10;  // Number of entries to show in a page.   
                // Look for a GET variable page if not found default is 1.        
                if (isset($_GET["page"])) {
                    $page  = $_GET["page"];
                } else {
                    $page = 1;
                }

                $start_from = ($page - 1) * $per_page_record;

                $query = "SELECT * FROM student WHERE centre_name='$centre'and status='Enrolled' LIMIT $start_from, $per_page_record";
                $rs_result = mysqli_query($con, $query);
                $rowcount = mysqli_num_rows($rs_result);
                $total_records = $rows;
                if ($rows > 0) {
                    while ($row = $rs_result->fetch_assoc()) {

                        echo "<tr>
                        <td>" . $row["student_name"] . "</td>
                        <td>" . $row["centre_name"] . "</td> 
                        <td><p style='margin-left:30px;'>" . $row["student_level"] . "</p></td>
                        <td>
                            <button class='btn btn-success editbtn' type='submit' name='submit'  >Transfer</button>
                            <button class='btn btn-success deletebtn' type='submit' name='submit'  >Remove</button>
                        </td>
                    </tr>";
                    }
                } else {
                    echo "<tr>
                    <td colspan='4'class='text-center 'style='font-weight:bold;'><h3>No Record Found</h3>

                    </td>
                </tr>";
                }
            }
            if (isset($_GET['primary'])) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "website";

                $connection = new mysqli($servername, $username, $password, $database);
                $primary = $_GET['primary'];
                $sql = "SELECT * FROM student WHERE student_level='$primary'and status='Enrolled'";
                $result = $connection->query($sql);
                $rows = mysqli_num_rows($result);
                $result = $connection->query($sql);
                $per_page_record = 10;  // Number of entries to show in a page.   
                // Look for a GET variable page if not found default is 1.        
                if (isset($_GET["page"])) {
                    $page  = $_GET["page"];
                } else {
                    $page = 1;
                }

                $start_from = ($page - 1) * $per_page_record;

                $query = "SELECT * FROM student WHERE student_level='$primary'and status='Enrolled' LIMIT $start_from, $per_page_record";
                $rs_result = mysqli_query($con, $query);
                $rowcount = mysqli_num_rows($rs_result);
                $total_records = $rows;
                if ($rows > 0) {
                    while ($row = $rs_result->fetch_assoc()) {

                        echo "<tr>
                        <td>" . $row["student_name"] . "</td>
                        <td>" . $row["centre_name"] . "</td> 
                        <td><p style='margin-left:30px;'>" . $row["student_level"] . "</p></td>
                        <td>
                            <button class='btn btn-success editbtn' type='submit' name='submit'  >Transfer</button>
                            <button class='btn btn-success deletebtn' type='submit' name='submit'  >Remove</button>
                        </td>
                    </tr>";
                    }
                } else {
                    echo "<tr>
                    <td colspan='4'class='text-center 'style='font-weight:bold;'><h3>No Record Found</h3>

                    </td>
                </tr>";
                }
            }
            if (isset($_GET['search'])) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "website";

                $connection = new mysqli($servername, $username, $password, $database);
                $search = $_GET['search'];
                $sql = "SELECT * FROM student WHERE  status='Enrolled' and student_name  LIKE '%" . $search . "%' ";
                $result = $connection->query($sql);
                $rows = mysqli_num_rows($result);
                $result = $connection->query($sql);
                $per_page_record = 10;  // Number of entries to show in a page.   
                // Look for a GET variable page if not found default is 1.        
                if (isset($_GET["page"])) {
                    $page  = $_GET["page"];
                } else {
                    $page = 1;
                }

                $start_from = ($page - 1) * $per_page_record;

                $query = "SELECT * FROM student WHERE  status='Enrolled' and student_name  LIKE '%" . $search . "%'  LIMIT $start_from, $per_page_record";
                $rs_result = mysqli_query($con, $query);
                $rowcount = mysqli_num_rows($rs_result);
                $total_records = $rows;
                if ($rows > 0) {
                    while ($row = $rs_result->fetch_assoc()) {

                        echo "<tr>
                        <td>" . $row["student_name"] . "</td>
                        <td>" . $row["centre_name"] . "</td> 
                        <td><p style='margin-left:30px;'>" . $row["student_level"] . "</p></td>
                        <td>
                            <button class='btn btn-success editbtn' type='submit' name='submit'  >Transfer</button>
                            <button class='btn btn-success deletebtn' type='submit' name='submit' >Remove</button>
                        </td>
                    </tr>";
                    }
                } else {
                    echo "<tr>
                    <td colspan='4'class='text-center 'style='font-weight:bold;'><h3>No Record Found</h3>

                    </td>
                </tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <?php if (!isset($_GET['centre']) && !isset($_GET['primary']) && !isset($_GET['search'])) { ?>
        <div class="pagination" style="float:right;">
            <?php


            echo "</br>";
            // Number of pages required.   
            $total_pages = ceil($total_records / $per_page_record);
            $pagLink = "";

            if ($page >= 2) {
                echo "<a href='studentlist.php?page=" . ($page - 1) . "'>  Prev </a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<a class = 'active' href='studentlist.php?page="
                        . $i . "'>" . $i . " </a>";
                } else {
                    $pagLink .= "<a href='studentlist.php?page=" . $i . "'>   
                                                " . $i . " </a>";
                }
            };
            echo $pagLink;

            if ($page < $total_pages) {
                echo "<a href='studentlist.php?page=" . ($page + 1) . "'>  Next </a>";
            }

            ?>
        </div>
    <?php } ?>
    <?php if (isset($_GET['centre'])) { ?>

        <div class="pagination" style="float:right;">
            <?php


            echo "</br>";
            // Number of pages required.   
            $total_pages = ceil($total_records / $per_page_record);
            $pagLink = "";

            if ($page >= 2) {
                echo "<a href='studentlist.php?centre=$centre&page=" . ($page - 1) . "'>  Prev </a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<a class = 'active' href='studentlist.php?centre=$centre&page="
                        . $i . "'>" . $i . " </a>";
                } else {
                    $pagLink .= "<a href='studentlist.php?centre=$centre&page=" . $i . "'>   
                        " . $i . " </a>";
                }
            };
            echo $pagLink;

            if ($page < $total_pages) {
                echo "<a href='studentlist.php?centre=$centre&page=" . ($page + 1) . "'>  Next </a>";
            }

            ?>
        </div>
    <?php } ?>
    <?php if (isset($_GET['primary'])) { ?>

        <div class="pagination" style="float:right;">
            <?php


            echo "</br>";
            // Number of pages required.   
            $total_pages = ceil($total_records / $per_page_record);
            $pagLink = "";

            if ($page >= 2) {
                echo "<a href='studentlist.php?primary=$primary&page=" . ($page - 1) . "'>  Prev </a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<a class = 'active' href='studentlist.php?primary=$primary&page="
                        . $i . "'>" . $i . " </a>";
                } else {
                    $pagLink .= "<a href='studentlist.php?primary=$primary&page=" . $i . "'>   
                        " . $i . " </a>";
                }
            };
            echo $pagLink;

            if ($page < $total_pages) {
                echo "<a href='studentlist.php?primary=$primary&page=" . ($page + 1) . "'>  Next </a>";
            }

            ?>
        </div>
    <?php } ?>
    <?php if (isset($_GET['search'])) { ?>

        <div class="pagination" style="float:right;">
            <?php


            echo "</br>";
            // Number of pages required.   
            $total_pages = ceil($total_records / $per_page_record);
            $pagLink = "";

            if ($page >= 2) {
                echo "<a href='studentlist.php?search=$search&page=" . ($page - 1) . "'>  Prev </a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<a class = 'active' href='studentlist.php?search=$search&page="
                        . $i . "'>" . $i . " </a>";
                } else {
                    $pagLink .= "<a href='studentlist.php?search=$search&page=" . $i . "'>   
                        " . $i . " </a>";
                }
            };
            echo $pagLink;

            if ($page < $total_pages) {
                echo "<a href='studentlist.php?search=$search&page=" . ($page + 1) . "'>  Next </a>";
            }

            ?>
        </div>
    <?php } ?>
</body>

<!-- Transfer student modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Transfer student </h5>
            </div>

            <form action="transferstudent.php" method="POST">

                <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="form-group">

                        <label> Location </label>
                        <select class="col-sm-10 form-select" id="centre_name" name="centre_name" required>

                            <?php
                            $q = "select * from centre";
                            $all_centre = mysqli_query($con, $q);
                            foreach ($all_centre as $a) : ?>
                                <option value="<?php echo $a['centre_name'] ?>"><?php echo $a['centre_name'] ?></option>
                            <?php endforeach ?>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class='btn btn-success' type="submit" name="updatedata" name='submit' style='background-color:#5EBEC4;color:black;border-color:#5EBEC4;'>Update centre</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- DELETE POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Remove student data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="removestudent.php" method="POST">

                <div class="modal-body">

                    <input type="hidden" name="delete_id" id="delete_id">

                    <h4>Are you sure you want to remove student data?</h4>
                </div>
                <div class="modal-footer">
                    <button class='btn btn-success' type="submit" name="updatedata" name='submit' style='background-color:#5EBEC4;color:black;border-color:#5EBEC4;'>Remove</button>
                </div>
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

        $('.editbtn').on('click', function() {

            $('#editmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id').val(data[0]);
            $('#centre_name').val(data[1]);
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('.deletebtn').on('click', function() {

            $('#deletemodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id').val(data[0]);

        });
    });
</script>

</html>