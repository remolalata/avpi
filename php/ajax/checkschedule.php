<?php
include'../db_connection.php';
$start_time = date("H:i", strtotime($_POST['start_time']));
$end_time = date("H:i", strtotime($_POST['end_time']));
$sections  = $_POST['sections'];
$thesections = explode(',', $sections);

$count = "0";
$query = mysqli_query($conn, "select * from subjects");
    while($row = mysqli_fetch_assoc($query)){
        if($start_time >= $row['start_time'] && $start_time < $row['end_time']){
          	foreach ($thesections as $key) {
	            $query2 = mysqli_query($conn, "select * from subject_sections where subject_id='".$row['subject_id']."' and section_id='$key' ");
	            $count2 = mysqli_num_rows($query2);
	            if(!empty($count2)){
					$count = "1";
	            }
          	}
        }
    }

echo json_encode(array(
	'count' => $count,
));
?>