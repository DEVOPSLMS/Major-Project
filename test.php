<?php
include('connection.php');
$date = date("Y-m-d");
$roster = mysqli_query($con, "SELECT * FROM roster ");
error_reporting(E_ERROR | E_PARSE);
foreach ($roster as $rosters) {

    $abs_diff = array();
    $difference = array();
    $all_timings = array();
    $calculated_timings = array();
    $datediff = array();
    $earlier =   strtotime(date("Y-m-d H:i:s"));
    $roster_time = $rosters['date'] . ' ' . $rosters['time'];

    $later =  strtotime(date($roster_time));
    $datenow = new DateTime(date("H:i"));
    $timings = implode('', [$rosters['timing']]);
    $all_timings = substr($timings, 0, 2);
    // $calculated_timings =$all_timings *60;
    // $datediff = $datenow - $calculated_timings;
    $now = time(); // or your date as well
    $your_date = strtotime("2022-010-04");
    $datediff = $now - $your_date;
    $time_now = (date("H:i:s"));

    $to_time = strtotime($rosters['time']);

    $from_time = strtotime($time_now);
    $time = round($to_time - $from_time) / 60;

    $total_time = round(abs($to_time - $time_now) / 60);

    $id = $rosters['id'];

    $diff = round($later - $earlier) / 86400;
}
if (!isset($_GET['search'])) {
    $roster = mysqli_query($con, "SELECT * FROM roster ");
    $num = mysqli_num_rows($roster);
    $per_page_record = 6;  // Number of entries to show in a page.   
    // Look for a GET variable page if not found default is 1.        
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * $per_page_record;

    $query = "SELECT * FROM roster LIMIT $start_from, $per_page_record";
    $rs_result = mysqli_query($con, $query);
    $rowcount = mysqli_num_rows($rs_result);
    $total_records = $num;
}


if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $per_page_record = 6;  // Number of entries to show in a page.   
    // Look for a GET variable page if not found default is 1.        
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * $per_page_record;


    $roster = mysqli_query($con, "SELECT * FROM roster WHERE centre_name like '%" . $search . "%' ");
    $num = mysqli_num_rows($roster);

    $total_records = $num;
}
if (isset($_GET['location'])) {
    $location = $_GET['location'];
    $per_page_record = 6;  // Number of entries to show in a page.   
    // Look for a GET variable page if not found default is 1.        
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * $per_page_record;


    $roster = mysqli_query($con, "SELECT * FROM roster WHERE centre_name like '%" . $location . "%' ");
    $num = mysqli_num_rows($roster);

    $total_records = $num;
}

?>
<style>
    .pagination {
        display: inline-block;
        float: right;
        padding-right: 550px;
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <form method="get" onsubmit="this.form.submit()">
        <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
                                                    echo $_GET['search'];
                                                } ?>" class="form-control">


    </form>
    <form method="get" onsubmit="this.form.submit()">
        <input type="text" name="location" value="<?php if (isset($_GET['location'])) {
                                                        echo $_GET['location'];
                                                    } ?>" class="form-control">


    </form>
    <?php if (!isset($_GET['search'])&&!isset($_GET['location'])) { ?>
        <div class="pagination">
            <?php


            echo "</br>";
            // Number of pages required.   
            $total_pages = ceil($total_records / $per_page_record);
            $pagLink = "";

            if ($page >= 2) {
                echo "<a href='test.php?page=" . ($page - 1) . "'>  Prev </a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<a class = 'active' href='test.php?page="
                        . $i . "'>" . $i . " </a>";
                } else {
                    $pagLink .= "<a href='test.php?page=" . $i . "'>   
                                                " . $i . " </a>";
                }
            };
            echo $pagLink;

            if ($page < $total_pages) {
                echo "<a href='test.php?page=" . ($page + 1) . "'>  Next </a>";
            }

            ?>
        </div>
    <?php } ?>

    <?php if (isset($_GET['search'])) { ?>

        <div class="pagination">
            <?php


            echo "</br>";
            // Number of pages required.   
            $total_pages = ceil($total_records / $per_page_record);
            $pagLink = "";

            if ($page >= 2) {
                echo "<a href='test.php?search=$search&page=" . ($page - 1) . "'>  Prev </a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<a class = 'active' href='test.php?search=$search&page="
                        . $i . "'>" . $i . " </a>";
                } else {
                    $pagLink .= "<a href='test.php?search=$search&page=" . $i . "'>   
                                                " . $i . " </a>";
                }
            };
            echo $pagLink;

            if ($page < $total_pages) {
                echo "<a href='test.php?search=$search&page=" . ($page + 1) . "'>  Next </a>";
            }

            ?>
        </div>
    <?php } ?>
    <?php if (isset($_GET['location'])) { ?>

        <div class="pagination">
            <?php


            echo "</br>";
            // Number of pages required.   
            $total_pages = ceil($total_records / $per_page_record);
            $pagLink = "";

            if ($page >= 2) {
                echo "<a href='test.php?location=$location&page=" . ($page - 1) . "'>  Prev </a>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<a class = 'active' href='test.php?location=$location&page="
                        . $i . "'>" . $i . " </a>";
                } else {
                    $pagLink .= "<a href='test.php?location=$location&page=" . $i . "'>   
                                " . $i . " </a>";
                }
            };
            echo $pagLink;

            if ($page < $total_pages) {
                echo "<a href='test.php?location=$location&page=" . ($page + 1) . "'>  Next </a>";
            }

            ?>
        </div>
    <?php } ?>
</body>

</html>