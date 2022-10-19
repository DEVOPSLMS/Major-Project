<?php
session_start();
include("connection.php");
$user_id = $_SESSION['user_id'];

$query = "select * from user where user_id='$user_id'";
$result = mysqli_query($con, $query);
$user_details = mysqli_fetch_assoc($result);
$id = $user_details['id'];
$sql = "UPDATE notification SET seen='1'where parentid='$id'";
$res = mysqli_query($con, $sql);
if ($res) {
  echo "Success";
} else {
  echo "Failed";
}