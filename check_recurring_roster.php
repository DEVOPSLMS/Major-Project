<?php
include("connection.php");
date_default_timezone_set('Singapore');

$sunday = date("Y-m-d H:i:s", strtotime("Sunday 10:00pm"));
$sunday_ = new DateTime($sunday);
$sunday_ = date_format($sunday_, 'Y-m-d H:i:s');

$now = new DateTime(date("Y-m-d"));
$now = date_format($now, 'Y-m-d');

$query = "SELECT * FROM `recurring`";
$result = mysqli_query($con, $query);
$rows = mysqli_num_rows($result);
// check if sunday 10pm
if ($rows !== 0) {

    foreach ($result as $a) :
        $id = $a['id'];
        $centre = $a['centre_name'];
        $subject = $a['subject'];
        $level = $a['level'];
        $room = $a['room'];
        $students = $a['students'];
        $time = $x['time'];
        $timing = $a['timing'];
        $teacher = $a['teacher_name'];
        $day = $a['day'];

        // if recurring lesson == lesson 
        $selectquery = "SELECT * FROM roster WHERE timing = '$timing' and teacher_name='$teacher' and day = '$day'";
        $result_roster = mysqli_query($con, $selectquery);
        $rows_roster = mysqli_num_rows($result_roster);

        if($rows_roster !== 0){

            // if sunday 10 pm, check lesson, and add next lesson, week
            // if($now < $sunday_)
            
            $datelate = new DateTime($day);
            $datelate = date_format($datelate, 'Y-m-d');
            if($datelate < $now)
            // if($sunday_ < $now)
            // if($sunday_ > $now)
            {
                echo '<br><br><br><br><br><br><br><br>', $now, '<br>', $datelate;
                print 'test';
    
                //adds next week
                $nextWeek = "INSERT INTO roster(centre_name,subject,level,timing,teacher_name,need_relief,room,date,day,students,time,cancelled) VALUES('$centre', '$subject','$level','$timing','$teacher','no','$room','$datelate','$day','$students','$time','no')";
                mysqli_query($con, $nextWeek);


            }else{
                echo '<br><br><br><br><br><br><br><br>', $now, '<br>', $datelate;
                print 'notest';
            }

        }

    endforeach;
}
?>