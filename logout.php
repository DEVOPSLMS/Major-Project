<?php

session_start();

if(isset($_SESSION['user_id']))
{
	unset($_SESSION['user_id']);
	unset($_COOKIE['key']); 
	setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp

}

header("Location: login.php");
die;