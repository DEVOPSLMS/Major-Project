<?php
session_start();
include("connection.php");
$user_id = $_SESSION['user_id'];

$query = "select * from user where user_id='$user_id'";
$result = mysqli_query($con, $query);
$user_details = mysqli_fetch_assoc($result);
if($user_details['role']=='parent'){
  $id = $user_details['id'];
  $sql = "UPDATE notification SET seen='1'where parentid='$id'";
  $res = mysqli_query($con, $sql);
  if ($res) {
    echo "Success";
  } else {
    echo "Failed";
  }
}
if($user_details['role']=='teacher'){
  $id = $user_details['id'];
  $name=$user_details['username'];
  $sql = "UPDATE notification_teacher SET seen='1'where teacher_name='$name'";
  $res = mysqli_query($con, $sql);
  if ($res) {
    echo "Success";
  } else {
    echo "Failed";
  }
}