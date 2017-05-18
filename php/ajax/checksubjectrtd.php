<?php
include'../db_connection.php';
$key = $_POST['id'];
$query = mysqli_query($conn, "select * from subjects where subject_id='$key'");
$row = mysqli_fetch_assoc($query);
echo json_encode(array(
    'subject_id' => $row['subject_id'],
    'unit' => $row['unit'],
    'section' => $row['section'],
    'course' => $row['course'],
	));
?>