<?php

include'../db_connection.php';

$key = $_GET['q'];

$query = mysqli_query($conn, "select * from students where student_number='$key'");
$row = mysqli_fetch_assoc($query);

$church = mysqli_fetch_assoc(mysqli_query($conn, "select * from church where church_id='".$row['church']."'"));

//for testing purposes
$school_year_start = '17';
// $school_year_start = date('y');
?>
<input type="hidden" name="student_number" value="<?php echo $row['student_number']; ?>">
<input type="hidden" name="student_year" value="<?php echo $row['year']; ?>">
<div class="row">
	<div class="col-md-12">
		<div class="nav-tabs-custom" style="box-shadow: none;">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs_1" data-toggle="tab">Info</a></li>
				<li><a href="#tabs_2" data-toggle="tab">Subject</a></li>
			</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="tabs_1">

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-3 control-label">Student Number: </label>
							<div class="col-md-9">
								<input type="text" name="student_number" class="form-control" value="<?php echo $row['student_number']; ?>" readonly >
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-3 control-label">Lastname: </label>
							<div class="col-md-9">
								<input type="text" class="form-control" value="<?php echo $row['last_name']; ?>" readonly >
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-3 control-label">Firstname: </label>
							<div class="col-md-9">
								<input type="text" class="form-control" value="<?php echo $row['first_name']; ?>" readonly >
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-3 control-label">Middlename: </label>
							<div class="col-md-9">
								<input type="text" class="form-control" value="<?php echo $row['middle_name']; ?>" readonly >
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-3 control-label">Course: </label>
							<div class="col-md-9">
								<input type="text" class="form-control" value="<?php echo $row['course']; ?>" readonly >
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-3 control-label">Year & Section: </label>
							<div class="col-md-9">
								<input type="text" class="form-control" value="<?php echo $row['year']." - ".$row['section']; ?>" readonly >
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-3 control-label">Church: </label>
							<div class="col-md-9">
								<input type="text" class="form-control" value="<?php echo $church['church_name']; ?>" readonly >
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-3 control-label">School Year: </label>
							<div class="col-md-9">
								<input type="text" class="form-control" value="<?php echo $row['sy']; ?>" readonly >
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="tab-pane" id="tabs_2">
				<div id="addElectiveHiddenDiv"></div>
				<table class="table table-bordered table-striped" id="preRegisteredSubjectTbl">
					<tr>
						<th>Subject Code</th>
						<th>Subject Title</th>
						<th>Units</th>
						<th>Days</th>
						<th>Time</th>
						<th>Room</th>
						<th></th>
					</tr>
					<?php
						$query2 = mysqli_query($conn, "select a.*, b.*, c.* from subjects a, subject_sections b, subject_years c where a.unit='3' and a.course='ALL' and b.section_id='".$row['section']."' and c.year_id='".$row['yearID']."' and a.subject_id=b.subject_id and a.subject_id=c.subject_id and a.sy='".$school_year_start."'");
						
						$count2 = mysqli_num_rows($query2);
						if(empty($count2)){ ?>
							<tr id="no_subjects_to_display">
								<td colspan="7">No subject to display in table</td>
							</tr>
						<?php }else{
							while($row2 = mysqli_fetch_assoc($query2)){
								?>
									<tr>
										<td>
											<input type="hidden" name="subject_to_be_taken[]" value="<?php echo $row2['subject_id']; ?>">
											<?php echo $row2['subject_code']; ?>
										</td>
										<td><?php echo $row2['subject_description']; ?></td>
										<td><?php echo $row2['unit']; ?></td>
										<td><?php echo $row2['day']; ?></td>
										<td><?php echo $row2['time']; ?></td>
										<td><?php echo $row2['room']; ?></td>
										<td>
											<button type="button" class="btn btn-danger btn-xs" id="preRegisteredTblDeleteSubject"><i class="fa fa-times" data-toggle="tooltip" title="Remove Subject"></i></button>
										</td>
									</tr>
								<?php
							}
						}
						
					?>
				</table>
				<table class="table table-bordered table-striped">
					<tr>
						<td align="center"><a href="#" data-toggle="modal" data-target="#addElectiveModal" data-studno="<?php echo $row['student_number']; ?>"><i class="fa fa-plus"> </i> Add Subjects</a></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$("#preRegisteredSubjectTbl").on('click', '#preRegisteredTblDeleteSubject', function(e){
		$(this).closest('tr').remove();
	});
</script>