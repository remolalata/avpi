<?php
include'../db_connection.php';

$course_id = mysqli_real_escape_string($conn, $_GET['q']);
$query = mysqli_query($conn, "select * from course where course_id='$course_id'");
$row = mysqli_fetch_assoc($query);
?>
<input type="hidden" name="editCourseHidden" value="<?php echo $row['course_id']; ?>">
<div class="form-group">
	<label>Course ID</label>
	<input type="text" name="course_id" id="course_id" class="form-control" placeholder="Course ID" value="<?php echo $row['course_id']; ?>">
</div>
<div class="form-group">
	<label>Course Description</label>
	<input type="text" name="course_description" id="course_description" class="form-control" placeholder="Course Description" value="<?php echo $row['course_description']; ?>">
</div>