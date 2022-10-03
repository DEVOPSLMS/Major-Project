<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="website";
if(!$con= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect");
}
?>