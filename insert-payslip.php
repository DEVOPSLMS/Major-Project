<?php
include("connection.php");
date_default_timezone_set('Singapore');

error_reporting(E_ERROR | E_PARSE);
$first_day_this_month = date('Y-m-01');
$now = date('Y-m-d H:i:s');
$d = date('Y-m-t 2200:00:00');
$c = date('Y-m-t 2359:59:59');
$last_day = date('Y-m-t');
$month=date("M");
$year=date("Y");
$sql="SELECT * FROM `payslip` WHERE month='$month'and year='$year'";
$payslip= mysqli_query($con, $sql);
if(mysqli_num_rows($payslip) == 0){
    if($d < $now && $now < $c){
        $query = "SELECT * FROM `roster` WHERE cancelled='no'and date between '$first_day_this_month' and '$last_day'";
        $a = mysqli_query($con, $query);
        
        
        
        $byName = [];
        foreach ($a as $record) {
            $name = $record['teacher_name'];
            $diff=$record['end']-$record['time'];
            $total =$diff;
            $time_diff = ['Diff' => $total,'Teacher_Name' => $name,'Centre'=>$record['centre_name']];
            if (!isset($byName[$name])) {
                $byName[$name] = [];
            }
        
            array_push($byName[$name], $time_diff);
            
        }
        
        
        
        
        $key = 'Diff';
        $new=[];
        $key2 = 'Teacher_Name';
        $key3 = 'Centre';
        foreach($byName as $a){
            $sum = array_sum(array_column($a,$key));
            $name = (array_unique(array_column($a,$key2)));
            $centre = (array_unique(array_column($a,$key3)));
            $string=implode("",$name);
            $string2=implode(", ",$centre);
            $time_diff = ['sum' => $sum,'teacher_name'=>$string,'centre'=>$string2];
            array_push($new, $time_diff);
          
        }
        
        foreach($new as $a){
            $sum=$a['sum'];
            $name=$a['teacher_name'];
            $centre=$a['centre'];
            $total=$sum * 10;
            $status='false';
            $reference = random_num(15);
            $year=date("Y");
            $query = "insert into payslip(teacher_name,total_hours,centre,month,year,total_amount,status,reference) VALUES('$name','$sum','$centre','$month',$year,'$total','$status','$reference')";
            mysqli_query($con, $query);
        }
    }
    
}





?>