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
  <title>Student results dashboard</title>

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
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(resultsChart);
      google.charts.setOnLoadCallback(passFailChart);

      function resultsChart() {

        var data = google.visualization.arrayToDataTable([
        ['name','number'],
        <?php
        $con = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($con, 'website');

        $query = "SELECT COUNT(*) as ALTOTAL FROM student_results WHERE achievement_level='AL1 (≥ 90)'";
        $result = mysqli_query($con, $query);


        while($chart = mysqli_fetch_assoc($result))
            {
                echo "['AL1 (≥ 90)',".$chart['ALTOTAL']."], ";
            }
        
        $query = "SELECT COUNT(*) as ALTOTAL FROM student_results WHERE achievement_level='AL2 (85 - 89)'";
        $result = mysqli_query($con, $query);
        
        while($chart = mysqli_fetch_assoc($result))
            {
                echo "['AL2 (85 - 79)',".$chart['ALTOTAL']."], ";
            }
        
        $query = "SELECT COUNT(*) as ALTOTAL FROM student_results WHERE achievement_level='AL3 (80 - 84)'";
        $result = mysqli_query($con, $query);
        
        while($chart = mysqli_fetch_assoc($result))
            {
                echo "['AL3 (80 - 84)',".$chart['ALTOTAL']."], ";
            }

        $query = "SELECT COUNT(*) as ALTOTAL FROM student_results WHERE achievement_level='AL4 (75 - 79)'";
        $result = mysqli_query($con, $query);
        
        while($chart = mysqli_fetch_assoc($result))
            {
                echo "['AL4 (75 - 79)',".$chart['ALTOTAL']."], ";
            }

        $query = "SELECT COUNT(*) as ALTOTAL FROM student_results WHERE achievement_level='AL5 (65 - 74)'";
        $result = mysqli_query($con, $query);
        
        while($chart = mysqli_fetch_assoc($result))
            {
                echo "['AL5 (65 - 74)',".$chart['ALTOTAL']."], ";
            }

        $query = "SELECT COUNT(*) as ALTOTAL FROM student_results WHERE achievement_level='AL6 (45 - 64)'";
        $result = mysqli_query($con, $query);
        
        while($chart = mysqli_fetch_assoc($result))
            {
                echo "['AL6 (45 - 64)',".$chart['ALTOTAL']."], ";
            }

        $query = "SELECT COUNT(*) as ALTOTAL FROM student_results WHERE achievement_level='AL7 (20 - 44)'";
        $result = mysqli_query($con, $query);
        
        while($chart = mysqli_fetch_assoc($result))
            {
                echo "['AL7 (20 - 44)',".$chart['ALTOTAL']."], ";
            }

        $query = "SELECT COUNT(*) as ALTOTAL FROM student_results WHERE achievement_level='AL8 (< 20)'";
        $result = mysqli_query($con, $query);
        
        while($chart = mysqli_fetch_assoc($result))
            {
                echo "['AL8 (< 20)',".$chart['ALTOTAL']."], ";
            }
        ?>
        ]);

        var options = {
          title: 'Student results'
        };

        var chart = new google.visualization.PieChart(document.getElementById('results_piechart'));

        chart.draw(data, options);
      }
      function passFailChart()
    {
        var data = google.visualization.arrayToDataTable([
            ['pass','fail'],
            <?php
            $con = mysqli_connect("localhost","root","");
            $db = mysqli_select_db($con, 'website');

            $query = "SELECT COUNT(*) as ALTOTAL FROM student_results WHERE achievement_level='AL1 (≥ 90)' 
                                                                    or achievement_level='AL2 (85 - 89)'
                                                                    or achievement_level='AL3 (80 - 84)'
                                                                    or achievement_level='AL4 (75 - 79)'
                                                                    or achievement_level='AL5 (65 - 74)'
                                                                    or achievement_level='AL6 (45 - 64)'";
            $result = mysqli_query($con, $query);

        while($chart = mysqli_fetch_assoc($result))
            {
                echo "['Pass',".$chart['ALTOTAL']."], ";
            }

            $query = "SELECT COUNT(*) as ALTOTAL FROM student_results WHERE achievement_level='AL7 (20 - 44)' 
                                                                    or achievement_level='AL8 (< 20)'";
            $result = mysqli_query($con, $query);

        while($chart = mysqli_fetch_assoc($result))
            {
                echo "['Fail',".$chart['ALTOTAL']."], ";
            }
            ?>
            ]);

        var options = {title:'Pass/Fail', colors: ['#6cc028', '#ff6464']};

        var chart = new google.visualization.PieChart(document.getElementById('pass_fail_piechart'));
        chart.draw(data, options);
    }
    </script>
  </head>
  </head>
  <body>
    <table class="columns">
      <tr>
        <td><div id="results_piechart" style="border: 1px solid #ccc;width: 50vw; height: 500px;"></div></td>
        <td><div id="pass_fail_piechart" style="border: 1px solid #ccc;width: 50vw; height: 500px;"></div></td>
      </tr>
    </table>
  </body>
  
</html>