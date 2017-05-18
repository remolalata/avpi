<?php
include'../db_connection.php';
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$suffix_name = $_POST['suffix_name'];

$query = mysqli_query($conn, "select * from students where last_name='".$last_name."' and first_name='".$first_name."' and middle_name='".$middle_name."' and suffix_name='".$suffix_name."'");
$count = mysqli_num_rows($query);

echo json_encode(array(
	'count' => $count
));
?>