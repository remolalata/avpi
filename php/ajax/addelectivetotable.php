<?php
include'../db_connection.php';
$key = $_POST['q'];
$query = mysqli_query($conn, "select * from subjects where subject_id='".$key."'");
$row = mysqli_fetch_assoc($query);
$count = mysqli_num_rows($query);

echo json_encode(array(
    'count' => $count,
    'subject_id' => $row['subject_id'],
    'subject_code' => $row['subject_code'],
    'subject_title' => $row['subject_description'],
    'unit' => $row['unit'],
    'day' => $row['day'],
    'time' => $row['time'],
    'room' => $row['room'],
));
?>