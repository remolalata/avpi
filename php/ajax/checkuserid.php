<?php
include'../db_connection.php';
$key = mysqli_real_escape_string($conn, $_POST['id']);
$query = mysqli_query($conn, "select * from users where username='$key'") or die(mysqli_error($conn));
$count = mysqli_num_rows($query);
echo json_encode(array(
    'count' => $count
	));
?>