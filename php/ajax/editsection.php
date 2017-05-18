<?php
include'../db_connection.php';

$section_id = mysqli_real_escape_string($conn, $_GET['q']);
$query = mysqli_query($conn, "select * from sections where section_id='$section_id'") or die(mysqli_error());
$row = mysqli_fetch_assoc($query);
?>
<input type="hidden" name="editSectionHidden" value="<?php echo $section_id; ?>">
<div class="form-group">
	<label>Section ID</label>
	<input type="text" name="section_id" id="section_id" class="form-control" placeholder="Section ID" value="<?php echo $row['section_id']; ?>">
</div>
<div class="form-group">
	<label>Section Description</label>
	<input type="text" name="section_description" id="section_description" class="form-control" placeholder="Section_description" value="<?php echo $row['section_description']; ?>">
</div>