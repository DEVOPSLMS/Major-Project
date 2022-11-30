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

if ($user_data['role'] != 'manager') {
    header('HTTP/1.0 403 Forbidden');
    exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
  <title>Student attendance dashboard</title>

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
<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Student Level', 'Present', 'Late', 'Absent'],
          <?php
            $con = mysqli_connect("localhost","root","");
            $db = mysqli_select_db($con, 'website');

            $query = "SELECT COUNT(*) as TOTAL FROM attendance WHERE level='P1' and status='present'";
            $result = mysqli_query($con, $query);

            $query2 = "SELECT COUNT(*) as TOTAL2 FROM attendance WHERE level='P1' and status='late'";
            $result2 = mysqli_query($con, $query2);

            $query3 = "SELECT COUNT(*) as TOTAL3 FROM attendance WHERE level='P1' and status='absent'";
            $result3 = mysqli_query($con, $query3);

            while($chart = mysqli_fetch_assoc($result)) while ($chart2 = mysqli_fetch_assoc($result2)) while ($chart3 = mysqli_fetch_assoc($result3))
            {
                echo "['P1',".$chart['TOTAL'].",".$chart2['TOTAL2'].",".$chart3['TOTAL3']."], ";
            }

            $query = "SELECT COUNT(*) as TOTAL FROM attendance WHERE level='P2' and status='present'";
            $result = mysqli_query($con, $query);

            $query2 = "SELECT COUNT(*) as TOTAL2 FROM attendance WHERE level='P2' and status='late'";
            $result2 = mysqli_query($con, $query2);

            $query3 = "SELECT COUNT(*) as TOTAL3 FROM attendance WHERE level='P2' and status='absent'";
            $result3 = mysqli_query($con, $query3);

            while($chart = mysqli_fetch_assoc($result)) while ($chart2 = mysqli_fetch_assoc($result2)) while ($chart3 = mysqli_fetch_assoc($result3))
            {
                echo "['P2',".$chart['TOTAL'].",".$chart2['TOTAL2'].",".$chart3['TOTAL3']."], ";
            }

            $query = "SELECT COUNT(*) as TOTAL FROM attendance WHERE level='P3' and status='present'";
            $result = mysqli_query($con, $query);

            $query2 = "SELECT COUNT(*) as TOTAL2 FROM attendance WHERE level='P3' and status='late'";
            $result2 = mysqli_query($con, $query2);

            $query3 = "SELECT COUNT(*) as TOTAL3 FROM attendance WHERE level='P3' and status='absent'";
            $result3 = mysqli_query($con, $query3);

            while($chart = mysqli_fetch_assoc($result)) while ($chart2 = mysqli_fetch_assoc($result2)) while ($chart3 = mysqli_fetch_assoc($result3))
            {
                echo "['P3',".$chart['TOTAL'].",".$chart2['TOTAL2'].",".$chart3['TOTAL3']."], ";
            }

            $query = "SELECT COUNT(*) as TOTAL FROM attendance WHERE level='P4' and status='present'";
            $result = mysqli_query($con, $query);

            $query2 = "SELECT COUNT(*) as TOTAL2 FROM attendance WHERE level='P4' and status='late'";
            $result2 = mysqli_query($con, $query2);

            $query3 = "SELECT COUNT(*) as TOTAL3 FROM attendance WHERE level='P4' and status='absent'";
            $result3 = mysqli_query($con, $query3);

            while($chart = mysqli_fetch_assoc($result)) while ($chart2 = mysqli_fetch_assoc($result2)) while ($chart3 = mysqli_fetch_assoc($result3))
            {
                echo "['P4',".$chart['TOTAL'].",".$chart2['TOTAL2'].",".$chart3['TOTAL3']."], ";
            }

            $query = "SELECT COUNT(*) as TOTAL FROM attendance WHERE level='P5(N)' and status='present'";
            $result = mysqli_query($con, $query);

            $query2 = "SELECT COUNT(*) as TOTAL2 FROM attendance WHERE level='P5(N)' and status='late'";
            $result2 = mysqli_query($con, $query2);

            $query3 = "SELECT COUNT(*) as TOTAL3 FROM attendance WHERE level='P5(N)' and status='absent'";
            $result3 = mysqli_query($con, $query3);

            while($chart = mysqli_fetch_assoc($result)) while ($chart2 = mysqli_fetch_assoc($result2)) while ($chart3 = mysqli_fetch_assoc($result3))
            {
                echo "['P5(N)',".$chart['TOTAL'].",".$chart2['TOTAL2'].",".$chart3['TOTAL3']."], ";
            }

            $query = "SELECT COUNT(*) as TOTAL FROM attendance WHERE level='P5(F)' and status='present'";
            $result = mysqli_query($con, $query);

            $query2 = "SELECT COUNT(*) as TOTAL2 FROM attendance WHERE level='P5(F)' and status='late'";
            $result2 = mysqli_query($con, $query2);

            $query3 = "SELECT COUNT(*) as TOTAL3 FROM attendance WHERE level='P5(F)' and status='absent'";
            $result3 = mysqli_query($con, $query3);

            while($chart = mysqli_fetch_assoc($result)) while ($chart2 = mysqli_fetch_assoc($result2)) while ($chart3 = mysqli_fetch_assoc($result3))
            {
                echo "['P5(F)',".$chart['TOTAL'].",".$chart2['TOTAL2'].",".$chart3['TOTAL3']."], ";
            }

            $query = "SELECT COUNT(*) as TOTAL FROM attendance WHERE level='P6(N)' and status='present'";
            $result = mysqli_query($con, $query);

            $query2 = "SELECT COUNT(*) as TOTAL2 FROM attendance WHERE level='P6(N)' and status='late'";
            $result2 = mysqli_query($con, $query2);

            $query3 = "SELECT COUNT(*) as TOTAL3 FROM attendance WHERE level='P6(N)' and status='absent'";
            $result3 = mysqli_query($con, $query3);

            while($chart = mysqli_fetch_assoc($result)) while ($chart2 = mysqli_fetch_assoc($result2)) while ($chart3 = mysqli_fetch_assoc($result3))
            {
                echo "['P6(N)',".$chart['TOTAL'].",".$chart2['TOTAL2'].",".$chart3['TOTAL3']."], ";
            }

            $query = "SELECT COUNT(*) as TOTAL FROM attendance WHERE level='P6(F)' and status='present'";
            $result = mysqli_query($con, $query);

            $query2 = "SELECT COUNT(*) as TOTAL2 FROM attendance WHERE level='P6(F)' and status='late'";
            $result2 = mysqli_query($con, $query2);

            $query3 = "SELECT COUNT(*) as TOTAL3 FROM attendance WHERE level='P6(F)' and status='absent'";
            $result3 = mysqli_query($con, $query3);

            while($chart = mysqli_fetch_assoc($result)) while ($chart2 = mysqli_fetch_assoc($result2)) while ($chart3 = mysqli_fetch_assoc($result3))
            {
                echo "['P6(F)',".$chart['TOTAL'].",".$chart2['TOTAL2'].",".$chart3['TOTAL3']."], ";
            }
            ?>
        ]);

        var options = {title:'Student attendance', colors: ['#6cc028', '#f09637', '#ff6464'], vAxis: {viewWindow:{max:10,min:0}}};

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options),);
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 75vw; height: 500px; margin: 0 auto"></div>
  </body>
</html>
