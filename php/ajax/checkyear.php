<?php
include'../db_connection.php';
$key = mysqli_real_escape_string($conn, $_POST['id']);
$query = mysqli_query($conn, "select * from year where year_id='$key'");
$count = mysqli_num_rows($query);
echo json_encode(array(
    'count' => $count
	));
?>