<?php
include("connection.php");
date_default_timezone_set('Singapore');

$sunday = date("Y-m-d H:i:s", strtotime("Sunday 10:00pm"));
$sunday_ = new DateTime($sunday);
$sunday_ = date_format($sunday_, 'Y-m-d H:i:s');
$now = new DateTime(date("Y-m-d H:i:s"));
$now = date_format($now, 'Y-m-d H:i:s');


$query = "SELECT * FROM `recurring`";
$result = mysqli_query($con, $query);
$rows = mysqli_num_rows($result);

if ($now == $sunday) {

    if ($rows !== 0) {

        foreach ($result as $a) {
            $id = $a['id'];
            $centre = $a['centre_name'];
            $subject = $a['subject'];
            $level = $a['level'];
            $room = $a['room'];
            $students = $a['students'];
            $time = $a['time'];
            $timing = $a['timing'];
            $teacher = $a['teacher_name'];
            $day = $a['day'];
            $end = $a['end'];
            $date = new DateTime($now);
            $date->modify('next ' . $day . '');
            $newdate = $date->format('Y-m-d');

            // if recurring lesson == lesson , Add On, Check if on that date if teacher has class of same timing.
            $selectquery = "SELECT * FROM roster WHERE timing = '$timing' and teacher_name='$teacher' and date = '$newdate'";
            $result_roster = mysqli_query($con, $selectquery);
            $rows_roster = mysqli_num_rows($result_roster);

            if ($rows_roster == 0) {


                //adds next week
                $nextWeek = "INSERT INTO roster(centre_name,subject,level,timing,teacher_name,need_relief,room,date,day,students,time,end,cancelled,attendance_taken) VALUES('$centre', '$subject','$level','$timing','$teacher','no','$room','$newdate','$day','$students','$time','$end','no','no')";
                mysqli_query($con, $nextWeek);
            }
        }
    }
}
