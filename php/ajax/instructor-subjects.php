<?php
include'../db_connection.php';
$instructor = $_GET['instructor'];
$sy = $_GET['sy'];
if(empty($sy) && !empty($instructor)){
	$query = mysqli_query($conn, "select * from subjects where instructor='$instructor'");
}else{
	$query = mysqli_query($conn, "select * from subjects where sy='$sy' and instructor='$instructor'");
}
$count = mysqli_num_rows($query);

if(empty($count)){
	echo "<h4>No Subjects to display.</h4>";
}else{

	echo "<ul>";
	while($row = mysqli_fetch_assoc($query)){
		?>
			<li>
				<h4>
					<a href="grade.php?id=<?php echo $row['subject_id']; ?>"><?php echo $row['subject_code']." - ".$row['subject_description']." (".$row['time'].", ".$row['day'].", ".$row['room'].")"; ?>
					</a>
				</h4>
			</li>
		<?php
	}
	echo "</ul>";

}
?>