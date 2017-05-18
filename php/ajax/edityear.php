<?php
include'../db_connection.php';
$year_id = mysqli_real_escape_string($conn, $_GET['q']);
$query = mysqli_query($conn, "select * from year where yearID='$year_id'");
$row = mysqli_fetch_assoc($query);
?>
<input type="hidden" name="editYearHidden" value="<?php echo $year_id; ?>">
<div class="form-group">
	<label>Year ID</label>
	<input type="text" name="year_id" id="year_id" class="form-control" placeholder="Year ID" onkeypress="return numbersonly(event)" value="<?php echo $row['year_id']; ?>">
</div>
<div class="form-group">
	<label>Year Description</label>
	<input type="text" name="year_description" id="year_description" class="form-control" placeholder="Year Description" value="<?php echo $row['year_description']; ?>">
</div>