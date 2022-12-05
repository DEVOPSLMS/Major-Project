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
if ($user_data['role'] != 'manager') {
    header('HTTP/1.0 403 Forbidden');
    exit;
}
if (!isset($_GET['centre']) && !isset($_GET['primary']) && !isset($_GET['search'])) {
    $student = mysqli_query($con, "SELECT * FROM student WHERE status='Enrolled' AND student_level = 'P5(N)' OR student_level = 'P5(F)'");
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
    <title>List of P5 students</title>

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

        body {
            font-size: 130%;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<br><br><br><br><br><br><br><br><br><br>

<body>

    <h1>List of P5 Students</h1>
    <br>
    <?php
    $preferred = $user_data['preferred'];
    $all_preferred = explode(", ", $preferred);

    if (count($all_preferred) == 1) {
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Student name</th>
                    <th>Centre Name</th>

                    <th>
                        <form action="" method="get" onsubmit="this.form.submit()">
                            <input type="text" id="search" name="search" placeholder="Search Student Name" class="form-control" style="width:100%;" value="<?php if (isset($_GET['search'])) {
                                                                                                                                                                echo $_GET['search'];
                                                                                                                                                            } ?>">
                        </form>

                    </th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php
                if (!isset($_GET['search'])) {
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "website";

                    $connection = new mysqli($servername, $username, $password, $database);
                    $preferred = $user_data['preferred'];
                    $all_preferred = explode(", ", $preferred);

                    $sql = "SELECT * FROM student WHERE status='Enrolled' AND student_level = 'P5(N)'and centre_name='$preferred' OR student_level = 'P5(F)'and status='Enrolled'and centre_name='$preferred'";
                    $result = $connection->query($sql);
                    $per_page_record = 10;  // Number of entries to show in a page.   
                    // Look for a GET variable page if not found default is 1.        
                    if (isset($_GET["page"])) {
                        $page  = $_GET["page"];
                    } else {
                        $page = 1;
                    }

                    $start_from = ($page - 1) * $per_page_record;

                    $query = "SELECT * FROM student WHERE status='Enrolled' AND student_level = 'P5(N)'and centre_name='$preferred' OR student_level = 'P5(F)'and status='Enrolled' and centre_name='$preferred'LIMIT $start_from, $per_page_record";
                    $rs_result = mysqli_query($con, $query);
                    $rowcount = mysqli_num_rows($rs_result);
                    $total_records = $num;
                    while ($row = $rs_result->fetch_assoc()) {
                        echo "<tr>
                    <td>" . $row["student_name"] . "</td>
                    <td>" . $row["centre_name"] . "</td> 
                    <td><p style='margin-left:30px;'>" . $row["student_level"] . "</p></td>
                    <td>
                        <a href='check_studentp5.php?id=" . $row["id"] . "'><button class='btn btn-success' type='submit' name='submit'  >Foundation</button></a>
                    </td>
                </tr>";
                    }
                }


                if (isset($_GET['search'])) {
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "website";
                    $preferred = $user_data['preferred'];
                    $connection = new mysqli($servername, $username, $password, $database);
                    $search = $_GET['search'];
                    $sql = "SELECT * FROM student WHERE student_name  LIKE '%" . $search . "%' and status='Enrolled' AND student_level = 'P5(N)' AND centre_name='$preferred'OR student_level = 'P5(F)'AND student_name  LIKE '%" . $search . "%' and status='Enrolled' AND  centre_name='$preferred'";
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

                    $query = "SELECT * FROM student WHERE student_name  LIKE '%" . $search . "%' and status='Enrolled' AND student_level = 'P5(N)' AND centre_name='$preferred'OR student_level = 'P5(F)'AND student_name  LIKE '%" . $search . "%' and status='Enrolled' AND  centre_name='$preferred' AND Centre_name='Punggol Centre'LIMIT $start_from, $per_page_record";
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
                        <a href='check_studentp5.php?id=" . $row["id"] . "'><button class='btn btn-success' type='submit' name='submit'  >Foundation</button></a>
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
        <?php if (!isset($_GET['search'])) { ?>
            <div class="pagination" style="float:right;">
                <?php


                echo "</br>";
                // Number of pages required.   
                $total_pages = ceil($total_records / $per_page_record);
                $pagLink = "";

                if ($page >= 2) {
                    echo "<a href='studentlistp5.php?page=" . ($page - 1) . "'>  Prev </a>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        $pagLink .= "<a class = 'active' href='studentlistp5.php?page="
                            . $i . "'>" . $i . " </a>";
                    } else {
                        $pagLink .= "<a href='studentlistp5.php?page=" . $i . "'>   
                                                " . $i . " </a>";
                    }
                };
                echo $pagLink;

                if ($page < $total_pages) {
                    echo "<a href='studentlistp5.php?page=" . ($page + 1) . "'>  Next </a>";
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
                    echo "<a href='studentlistp5.php?search=$search&page=" . ($page - 1) . "'>  Prev </a>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        $pagLink .= "<a class = 'active' href='studentlistp5.php?search=$search&page="
                            . $i . "'>" . $i . " </a>";
                    } else {
                        $pagLink .= "<a href='studentlistp5.php?search=$search&page=" . $i . "'>   
                        " . $i . " </a>";
                    }
                };
                echo $pagLink;

                if ($page < $total_pages) {
                    echo "<a href='studentlistp5.php?search=$search&page=" . ($page + 1) . "'>  Next </a>";
                }

                ?>
            </div>
        <?php } ?>
    <?php } else {

    ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Student name</th>
                    <th>Centre Name</th>

                    <th>
                        <form action="" method="get" onsubmit="this.form.submit()">
                            <input type="text" id="search" name="search" placeholder="Search Student Name" class="form-control" style="width:100%;" value="<?php if (isset($_GET['search'])) {
                                                                                                                                                                echo $_GET['search'];
                                                                                                                                                            } ?>">
                        </form>

                    </th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php
                if (!isset($_GET['search'])) {
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "website";

                    $connection = new mysqli($servername, $username, $password, $database);
                    $preferred = $user_data['preferred'];
                    $all_preferred = explode(", ", $preferred);

                    $sql = "SELECT * FROM student WHERE status='Enrolled' AND student_level = 'P5(N)' OR student_level = 'P5(F)'and status='Enrolled'";
                    $result = $connection->query($sql);
                    $per_page_record = 10;  // Number of entries to show in a page.   
                    // Look for a GET variable page if not found default is 1.        
                    if (isset($_GET["page"])) {
                        $page  = $_GET["page"];
                    } else {
                        $page = 1;
                    }

                    $start_from = ($page - 1) * $per_page_record;

                    $query = "SELECT * FROM student WHERE status='Enrolled' AND student_level = 'P5(N)' OR student_level = 'P5(F)'and status='Enrolled' LIMIT $start_from, $per_page_record";
                    $rs_result = mysqli_query($con, $query);
                    $rowcount = mysqli_num_rows($rs_result);
                    $total_records = $num;
                    while ($row = $rs_result->fetch_assoc()) {
                        echo "<tr>
                    <td>" . $row["student_name"] . "</td>
                    <td>" . $row["centre_name"] . "</td> 
                    <td><p style='margin-left:30px;'>" . $row["student_level"] . "</p></td>
                    <td>
                        <a href='check_studentp5.php?id=" . $row["id"] . "'><button class='btn btn-success' type='submit' name='submit'  >Foundation</button></a>
                    </td>
                </tr>";
                    }
                }


                if (isset($_GET['search'])) {
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "website";
                    $preferred = $user_data['preferred'];
                    $connection = new mysqli($servername, $username, $password, $database);
                    $search = $_GET['search'];
                    $sql = "SELECT * FROM student WHERE student_name  LIKE '%" . $search . "%' and status='Enrolled' AND student_level = 'P5(N)' OR student_level = 'P5(F)'AND student_name  LIKE '%" . $search . "%' and status='Enrolled' ";
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

                    $query = "SELECT * FROM student WHERE student_name  LIKE '%" . $search . "%' and status='Enrolled' AND student_level = 'P5(N)' OR student_level = 'P5(F)'AND student_name  LIKE '%" . $search . "%' and status='Enrolled' LIMIT $start_from, $per_page_record";
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
                        <a href='check_studentp5.php?id=" . $row["id"] . "'><button class='btn btn-success' type='submit' name='submit'  >Foundation</button></a>
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
        <?php if (!isset($_GET['search'])) { ?>
            <div class="pagination" style="float:right;">
                <?php


                echo "</br>";
                // Number of pages required.   
                $total_pages = ceil($total_records / $per_page_record);
                $pagLink = "";

                if ($page >= 2) {
                    echo "<a href='studentlistp5.php?page=" . ($page - 1) . "'>  Prev </a>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        $pagLink .= "<a class = 'active' href='studentlistp5.php?page="
                            . $i . "'>" . $i . " </a>";
                    } else {
                        $pagLink .= "<a href='studentlistp5.php?page=" . $i . "'>   
                                                " . $i . " </a>";
                    }
                };
                echo $pagLink;

                if ($page < $total_pages) {
                    echo "<a href='studentlistp5.php?page=" . ($page + 1) . "'>  Next </a>";
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
                    echo "<a href='studentlistp5.php?search=$search&page=" . ($page - 1) . "'>  Prev </a>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        $pagLink .= "<a class = 'active' href='studentlistp5.php?search=$search&page="
                            . $i . "'>" . $i . " </a>";
                    } else {
                        $pagLink .= "<a href='studentlistp5.php?search=$search&page=" . $i . "'>   
                        " . $i . " </a>";
                    }
                };
                echo $pagLink;

                if ($page < $total_pages) {
                    echo "<a href='studentlistp5.php?search=$search&page=" . ($page + 1) . "'>  Next </a>";
                }

                ?>
            </div>
        <?php } ?>
    <?php } ?>

</body>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>





</html>