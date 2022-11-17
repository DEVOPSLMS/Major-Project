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
$id = $user_data['id'];


?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<header>
    <?php include("header.php") ?>
</header>
<br><br><br><br><br><br><br><br><br><br><br><br>
<style>
    #card{
        background-color: grey;
    }
    @media (max-width: 950px) {
      
      html{
        font-size:80%;
      }
    }
   
</style>
<script type="text/javascript">
    $(function() {
        $('#date').on('change', function() {
            $('#form').submit();
        });
    });

</script>
<body>
    <div class="container">
        <div class="col-lg-12">
        <form method="GET"id="form">
                <input type="date"name="date"id="date"class="form-control"style="height:50px;"value="<?php if (isset($_GET['date'])) {
                                                    echo $_GET['date'];
                                                } ?>"onchange="this.form.submit()">
        </form>
        </div>
    
        <br>
    <div class="card"id="card">



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      
        
        <?php
        $query = "select * from checkin where userid = '$id' ORDER BY date desc";
        $checkin = mysqli_query($con, $query);
        if(!isset($_GET['date'])){
            if (mysqli_num_rows($checkin) > 0) { ?>
             <div class="card-group">
            <?php foreach($checkin as $c) :?>
                <div class="col-lg-4 p-3">
                    <div class="card ">
                        <img class="card-img-top" src="checkin/<?php echo$c['image']?>" alt="Card image cap">
                        <div class="card-body">
                            <h3 class="card-title"><i class="fa fa-map-marker"aria-hidden="true"></i><?php echo$c['location']?></h3>
                            <?php
                            if($c['feedback']==''){
                                echo(' <p class="card-text">There is no feedback.</p>');
                            }
                            else{
                                echo(' <p class="card-text">Feedback: '.$c['feedback'].'.</p>');
                            }
                            ?>
                           
                        </div>
                        <div class="card-footer">
                            <?php
                            $time= strtotime(($c['time']));
                            $date= date('l, F jS, Y', $time);
                            echo(' <small class="text-muted">'.$date.'</small>')
                            ?>
                           
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
                
            </div>
        
        
   
           
        <?php }}
        ?>
        <?php
        if(isset($_GET['date'])){
            $date=$_GET['date'];
        $query = "select * from checkin where teacherid = '$id' and date='$date'";
        $checkin = mysqli_query($con, $query);
        
            if (mysqli_num_rows($checkin) > 0) { ?>
             <div class="card-group">
            <?php foreach($checkin as $c) :?>
                <div class="col-lg-4 p-3">
                    <div class="card ">
                        <img class="card-img-top" src="checkin/<?php echo$c['image']?>" alt="Card image cap">
                        <div class="card-body">
                            <h3 class="card-title"><i class="fa fa-map-marker"aria-hidden="true"></i><?php echo$c['location']?></h3>
                            <?php
                            if($c['feedback']==''){
                                echo(' <p class="card-text">There is no feedback.</p>');
                            }
                            else{
                                echo(' <p class="card-text">Feedback: '.$c['feedback'].'.</p>');
                            }
                            ?>
                           
                        </div>
                        <div class="card-footer">
                            <?php
                            $time= strtotime(($c['time']));
                            $date= date('l, F jS, Y', $time);
                            echo(' <small class="text-muted">'.$date.'</small>')
                            ?>
                           
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
                
            </div>
        
        
   
           
        <?php }
        else{
            echo("<h1 class='text-center'>No Record Found</h1>");
        }
        }
        ?>
    </div>
    </div>
</body>

</html>