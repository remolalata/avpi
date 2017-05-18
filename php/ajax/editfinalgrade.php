<?php
include'../db_connection.php';
$key = $_GET['q'];
$student_number = $_GET['studentnumber'];
$year = $_GET['year'];
$query = mysqli_query($conn, "select * from grade where grade_id='$key'");
$row = mysqli_fetch_assoc($query);
?>

<input type="hidden" name="editFinalGradeHidden" value="<?php echo $key; ?>">
<input type="hidden" name="editFinalGradeStudentNumberHidden" value="<?php echo $student_number; ?>">
<input type="hidden" name="editFinalGradeYearHidden" value="<?php echo $year; ?>">
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<div class="radio">
				<h4>
					<label>
						<input type="radio" name="editFinalGradeOption" value="0" onclick="editFinalGradeDisplayHidden1()" <?php if($row['equivalent_status'] == "0"){ echo "checked"; } ?> >
						Compute Final Grade
					</label>
				</h4>
			</div>
			<div class="radio">
				<h4>
					<label>
						<input type="radio" name="editFinalGradeOption" value="1" onclick="editFinalGradeDisplayHidden2()" <?php if($row['equivalent_status'] == "1"){ echo "checked"; } ?> >
						Input Final Grade
					</label>
				</h4>
			</div>
		</div>
		<div class="form-group"  <?php if($row['equivalent_status'] == "1"){ echo "style='display: block'"; }else{ echo "style='display: none'"; } ?> id="editFinalGradeTextbox">
			<label>Final Grade</label>
			<input type="text" class="form-control" name="editFinalGradeValue" value="<?php echo $row['equivalent']; ?>" placeholder="Final Grade">
		</div>
	</div>
</div>