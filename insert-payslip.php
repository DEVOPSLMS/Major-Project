<?php
include("connection.php");

date_default_timezone_set('Singapore');

error_reporting(E_ERROR | E_PARSE);
$first_day_this_month = date('Y-m-01');
$now = date('Y-m-d H:i:s');
$d = date('Y-m-t 2200:00:00');
$c = date('Y-m-t 2359:59:59');
$last_day = date('Y-m-t');
$month = date("M");
$year = date("Y");
$sql = "SELECT * FROM `payslip` WHERE month='$month'and year='$year'";
$payslip = mysqli_query($con, $sql);
if (mysqli_num_rows($payslip) == 0) {
    if ($d < $now && $now < $c) {
        $query = "SELECT * FROM `roster` WHERE cancelled='no'and attendance_taken='yes'and date between '$first_day_this_month' and '$last_day'";
        $a = mysqli_query($con, $query);



        $byName = [];
        foreach ($a as $record) {
            $name = $record['teacher_name'];
            $total = 1;
            if ($record['centre_name'] == 'Hougang Centre' || $record['centre_name'] == 'Sengkang Centre' || $record['centre_name'] == 'Punggol Centre' || $record['centre_name'] == 'Fernvale  Centre' || $record['centre_name'] == 'Kolam Ayer Centre') {
                $sum = 50;
            }
            if ($record['centre_name'] == 'Teck Ghee Centre' || $record['centre_name'] == 'Tampines Centre') {
                $sum = 40;
            }
            $total = $sum * $total;
            $time_diff = ['Diff' => $total, 'Teacher_Name' => $name, 'Centre' => $record['centre_name'], 'Session' => 1];
            if (!isset($byName[$name])) {
                $byName[$name] = [];
            }

            array_push($byName[$name], $time_diff);
        }




        $key = 'Diff';
        $new = [];
        $key2 = 'Teacher_Name';
        $key3 = 'Centre';
        foreach ($byName as $a) {
            $sum = array_sum(array_column($a, $key));
            $session = array_sum(array_column($a, 'Session'));
            $name = (array_unique(array_column($a, $key2)));
            $centre = (array_unique(array_column($a, $key3)));
            $string = implode("", $name);
            $string2 = implode(", ", $centre);
            $time_diff = ['sum' => $sum, 'teacher_name' => $string, 'centre' => $string2, 'session' => $session];
            array_push($new, $time_diff);
        }

        foreach ($new as $a) {
            $sum = $a['sum'];
            $name = $a['teacher_name'];
            $centre = $a['centre'];
            $total = $sum;
            $status = 'false';
            $session = $a['session'];


            $reference = rand(1000, 1000000000);

            $year = date("Y");

            $query = "insert into payslip(teacher_name,total_sessions,centre,month,year,total_amount,status,reference) VALUES('$name','$session','$centre','$month',$year,'$total','$status','$reference')";
            mysqli_query($con, $query);
        }
    }
}
