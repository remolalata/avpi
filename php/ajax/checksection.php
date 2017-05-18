<?php
include'../db_connection.php';
$key = mysqli_real_escape_string($conn, strtoupper($_POST['id']));
$query = mysqli_query($conn, "select * from sections where section_id='$key'");
$count = mysqli_num_rows($query);
echo json_encode(array(
    'count' => $count
	));
?>