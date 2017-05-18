<?php
include'../db_connection.php';
$key = mysqli_real_escape_string($conn, strtoupper($_POST['id']));
$sy = $_POST['sy'];
$query = mysqli_query($conn, "select * from subjects where subject_code='$key' and sy='$sy'");
$count = mysqli_num_rows($query);
echo json_encode(array(
    'count' => $count
	));
?>