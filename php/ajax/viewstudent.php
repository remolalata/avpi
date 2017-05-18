<?php
include'../db_connection.php';
$key = $_GET['q'];

$query = mysqli_query($conn, "select * from students where student_number='".$key."'");
$row = mysqli_fetch_assoc($query);

$query3 = mysqli_query($conn, "select * from church where church_id='".$row['church']."'");
$row3 = mysqli_fetch_assoc($query3);
?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="col-md-3 control-label" style="text-align: left">Student #</label>
			<div class="col-md-9">
				<input type="text" class="form-control" value="<?php echo $row['student_number']; ?>" readonly >
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label class="col-md-3 control-label" style="text-align: left">Date of Enrollment</label>
			<div class="col-md-9">
				<input type="text" class="form-control" value="<?php echo $row['date_enrolled']; ?>" readonly >
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="col-md-3 control-label" style="text-align: left">Name</label>
			<div class="col-md-9">
				<input type="text" class="form-control" value="<?php echo $row['last_name'].", ".$row['first_name']; ?>" readonly >
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label class="col-md-3 control-label" style="text-align: left">SY</label>
			<div class="col-md-9">
				<input type="text" class="form-control" value="<?php echo "20".$row['sy']; ?>" readonly >
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="col-md-3 control-label" style="text-align: left">Course</label>
			<div class="col-md-9">
				<input type="text" class="form-control" value="<?php echo $row['course']; ?>" readonly >
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label class="col-md-3 control-label" style="text-align: left">Year</label>
			<div class="col-md-9">
				<input type="text" class="form-control" value="<?php echo $row['year']; ?>" readonly >
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="col-md-3 control-label" style="text-align: left">Section</label>
			<div class="col-md-9">
				<input type="text" class="form-control" value="<?php echo $row['section']; ?>" readonly >
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label class="col-md-3 control-label" style="text-align: left">Church</label>
			<div class="col-md-9">
				<input type="text" class="form-control" value="<?php echo $row3['church_name']; ?>" readonly >
			</div>
		</div>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered" id="showSubjectTbl">
			<tr>
				<th>Subject Code</th>
				<th>Subject Title</th>
				<th>Units</th>
				<th>Days</th>
				<th>Time</th>
				<th>Room</th>
			</tr>
			<?php
				if($row['student_status'] == "Pre-Registered"){
					?>
						<tr>
							<td colspan="6">Student not yet enrolled</td>
						</tr>
					<?php
				}else{
					$query2 = mysqli_query($conn, "select a.*, b.*, c.* from student_subject a, students b, subjects c where a.student_number = b.student_number and a.year=b.year and a.subject_id = c.subject_id and a.student_number = '".$row['student_number']."' order by start_time") or die(mysqli_error($conn));
					while($row2 = mysqli_fetch_assoc($query2)){
						?>
							<tr>
								<td><?php echo $row2['subject_code']; ?></td>
								<td><?php echo $row2['subject_description']; ?></td>
								<td><?php echo $row2['unit']; ?></td>
								<td><?php echo $row2['day']; ?></td>
								<td><?php echo preg_replace("/[^0-9-:\/]+/", "", $row2['time']); ?></td>
								<td><?php echo $row2['room']; ?></td>
							</tr>
						<?php
					}
				}
			?>
		</table>
	</div>
</div>


