<?php
session_start();
include("check_roster.php");
include("check_teacher.php");
include("connection.php");
include("functions.php");
include("insert-payslip.php");
include("check_attendance.php");
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
    <a class="btn"href="past-expenses.php" class="col-lg-12" style="width:100%;">See Past Expenses</a>
        <br><br><br><br>
        <form action=""method="get"onsubmit="this.form.submit()">
    <input class="form-control" style="width:100%;height:50px;"type="text"placeholder="Search For Reference Number Or Teacher Name"name="search"value="<?php if (isset($_GET['search'])) {
                                                    echo $_GET['search'];
                                                } ?>">
                        </form>
        <br><br><br>
        <div class="row">

     
        <?php
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $query = "select * from expenses where status = 'false'  and reference LIKE '%" . $search . "%' OR name LIKE '%".$search."%'";
            $result = mysqli_query($con, $query);
        }
        if (!isset($_GET['search'])) {
            $query = "select * from expenses  where status='false' ";
            $result = mysqli_query($con, $query);
        }
        if (mysqli_num_rows($result) > 0) { ?>
            <?php foreach ($result as $r) : ?>
                <?php $id = $r['id']; ?>
                <div class="col-lg-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <h3>Name Of Staff: <?php echo$r['name']?></h3>
                        </div>
                        <div class="card-body">
                            <img src=expenses/<?php echo$r['image']?>>
                            <br>   <br>
                            <h3 class="card-text">Price: <?php echo$r['price']?></h3>
                            <h3 class="card-text">Purpose: <?php echo$r['purpose']?></h3>
                            <h5 class="card-text">Reference Number: <?php echo$r['reference']?></h5>
                            <a href="#" class="btn " onclick='
            if(confirm("Are you sure?") == false) {
                return false;
            } else {
              
                        
                href="update-expenses.php?id=<?php echo$id?>"
                    
            }'style="font-size:15px;">Pay</a>
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