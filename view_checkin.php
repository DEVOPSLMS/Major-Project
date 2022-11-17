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
if (!isset($_GET['checkin']) && !isset($_GET['role']) && !isset($_GET['search'])) {
    $student = mysqli_query($con, "SELECT * FROM checkin");
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
    <title>List of check-ins</title>

    <header>
        <?php include("header.php") ?>
    </header>

    <style>
        @media(max-width:950px) {

            #search {
                width: 100%!important;
                height: 40px!important;
            }

            #checkin {
                width: 100%!important;
            }
            #role{
                width: 110%!important;
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
        $('#checkin').on('change', function() {
            $('#filter-posts-form').submit();
        });
    });
    $(function() {
        $('#role').on('change', function() {
            $('#filter-posts').submit();
        });
    });
</script>
<br><br><br><br><br><br><br><br><br><br>

<body>

    <h1>List of check-ins</h1>
    <br>
    <table class="table" style="width:100%">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username
                    <form action="" method="get" onsubmit="this.form.submit()">
                        <input type="text" name="search" id="search" placeholder="Search Username" class="form-control" style="width:50%;" value="<?php if (isset($_GET['search'])) {
                                                                                                                                                            echo $_GET['search'];
                                                                                                                                                        } ?>">
                    </form></th>
                <th>Date and Time</th>
                <th>Role
                    <form method="get" id="filter-posts" onchange="this.form.submit()">

                        <select class="form-select" id="role" style="width:150px;height:30px;" required name="role">
                            <option selected>Filter by Role</option>
                            <option value="teacher">Teacher</option>
                            <option value="manager">Manager</option>
                        </select>
                    </form>
                </th>
                <th>Feedback</th>
                <th>Location</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (!isset($_GET['checkin']) && !isset($_GET['role']) && !isset($_GET['search'])) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "website";

                $connection = new mysqli($servername, $username, $password, $database);

                $sql = "SELECT * FROM checkin";
                $result = $connection->query($sql);
                $per_page_record = 10;  // Number of entries to show in a page.   
                // Look for a GET variable page if not found default is 1.        
                if (isset($_GET["page"])) {
                    $page  = $_GET["page"];
                } else {
                    $page = 1;
                }

                $start_from = ($page - 1) * $per_page_record;

                $query = "SELECT * FROM checkin";
                $rs_result = mysqli_query($con, $query);
                $rowcount = mysqli_num_rows($rs_result);
                $total_records = $num;
                while ($row = $rs_result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row["userid"] . "</td>
                    <td>" . $row["username"] . "</td>
                    <td>" . $row["time"] . "</td>
                    <td>" . $row["role"] . "</td> 
                    <td>" . $row["feedback"] . "</td>
                    <td>" . $row["location"] . "</td> 
                </tr>";
                }
            }
            if (isset($_GET['role'])) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "website";

                $connection = new mysqli($servername, $username, $password, $database);
                $role = $_GET['role'];
                $sql = "SELECT * FROM checkin WHERE role='$role'";
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

                $query = "SELECT * FROM checkin WHERE role='$role'";
                $rs_result = mysqli_query($con, $query);
                $rowcount = mysqli_num_rows($rs_result);
                $total_records = $rows;
                if ($rows > 0) {
                    while ($row = $rs_result->fetch_assoc()) {

                        echo "<tr>
                        <td>" . $row["userid"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["time"] . "</td>
                        <td>" . $row["role"] . "</td> 
                        <td>" . $row["feedback"] . "</td> 
                        <td>" . $row["location"] . "</td> 
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
                $sql = "SELECT * FROM checkin WHERE username  LIKE '%" . $search . "%' ";
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

                $query = "SELECT * FROM checkin WHERE username  LIKE '%" . $search . "%'  LIMIT $start_from, $per_page_record";
                $rs_result = mysqli_query($con, $query);
                $rowcount = mysqli_num_rows($rs_result);
                $total_records = $rows;
                if ($rows > 0) {
                    while ($row = $rs_result->fetch_assoc()) {

                        echo "<tr>
                        <td>" . $row["userid"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["time"] . "</td>
                        <td>" . $row["role"] . "</td> 
                        <td>" . $row["feedback"] . "</td> 
                        <td>" . $row["location"] . "</td> 
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
    <?php if (!isset($_GET['checkin']) && !isset($_GET['role']) && !isset($_GET['search'])) { ?>
        <div class="pagination" style="float:right;">
            <?php


            echo "</br>";
            // Number of pages required.   
            $total_pages = ceil($total_records / $per_page_record);
            $pagLink = "";

            if ($page >= 2) {
                echo "<a href='view_checkin.php?page=" . ($page - 1) . "'>  Prev </a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<a class = 'active' href='view_checkin.php?page="
                        . $i . "'>" . $i . " </a>";
                } else {
                    $pagLink .= "<a href='view_checkin.php?page=" . $i . "'>   
                                                " . $i . " </a>";
                }
            };
            echo $pagLink;

            if ($page < $total_pages) {
                echo "<a href='view_checkin.php?page=" . ($page + 1) . "'>  Next </a>";
            }

            ?>
        </div>
    <?php } ?>
    <?php if (isset($_GET['checkin'])) { ?>

        <div class="pagination" style="float:right;">
            <?php


            echo "</br>";
            // Number of pages required.   
            $total_pages = ceil($total_records / $per_page_record);
            $pagLink = "";

            if ($page >= 2) {
                echo "<a href='view_checkin.php?role=$role&page=" . ($page - 1) . "'>  Prev </a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<a class = 'active' href='view_checkin.php?role=$role&page="
                        . $i . "'>" . $i . " </a>";
                } else {
                    $pagLink .= "<a href='view_checkin.php?role=$role&page=" . $i . "'>   
                        " . $i . " </a>";
                }
            };
            echo $pagLink;

            if ($page < $total_pages) {
                echo "<a href='view_checkin.php?role=$role&page=" . ($page + 1) . "'>  Next </a>";
            }

            ?>
        </div>
    <?php } ?>
    <?php if (isset($_GET['role'])) { ?>

        <div class="pagination" style="float:right;">
            <?php


            echo "</br>";
            // Number of pages required.   
            $total_pages = ceil($total_records / $per_page_record);
            $pagLink = "";

            if ($page >= 2) {
                echo "<a href='view_checkin.php?role=$role&page=" . ($page - 1) . "'>  Prev </a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<a class = 'active' href='view_checkin.php?role=$role&page="
                        . $i . "'>" . $i . " </a>";
                } else {
                    $pagLink .= "<a href='studentlist.php?role=$role&page=" . $i . "'>   
                        " . $i . " </a>";
                }
            };
            echo $pagLink;

            if ($page < $total_pages) {
                echo "<a href='view_checkin.php?role=$role&page=" . ($page + 1) . "'>  Next </a>";
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
                echo "<a href='view_checkin.php?search=$search&page=" . ($page - 1) . "'>  Prev </a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<a class = 'active' href='view_checkin.php?search=$search&page="
                        . $i . "'>" . $i . " </a>";
                } else {
                    $pagLink .= "<a href='view_checkin.php?search=$search&page=" . $i . "'>   
                        " . $i . " </a>";
                }
            };
            echo $pagLink;

            if ($page < $total_pages) {
                echo "<a href='view_checkin.php?search=$search&page=" . ($page + 1) . "'>  Next </a>";
            }

            ?>
        </div>
    <?php } ?>
</body>

</html>