<?php
ob_start();
session_start();
include'db_connection.php';
date_default_timezone_set('Asia/Manila');

$query = mysqli_query($conn, "select * from users where user_id=".$_SESSION['user_id']);
$row = mysqli_fetch_assoc($query);
$name = ucfirst($row['first_name'])." ".ucfirst($row['last_name']);
$user_type = ucfirst($row['user_type']);
$date = date("M-d-Y");
$time = date("h:i A");
$ip_address = $_SERVER['REMOTE_ADDR'];
mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('$name', '$user_type', 'Logged Out', '$date', '$time', '$ip_address') ") or die(mysqli_error());

session_destroy();
header("location: ../login.php");
?>