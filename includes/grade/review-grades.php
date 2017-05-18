<?php
	$r = mysqli_real_escape_string($conn, $_GET['r']);
?>
<div class="row">
	<form class="form-horizontal">
	<div class="col-md-6">
		<div class="form-group">
			<label class="col-sm-2 control-label">Section</label>

			<div class="col-sm-10">
			  <input type="text" class="form-control" value="<?php echo getSections($r); ?>" readonly >
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">Instructor</label>

			<div class="col-sm-10">
			  <input type="text" class="form-control" value="<?php echo getUser(subjectInfo($r)['instructor']); ?>" readonly >
			</div>
		</div>
	</div>
	<div class="col-md-6">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Subject & Schedule</label>

	    <div class="col-sm-10">
	      <input type="text" class="form-control" value="<?php echo subjectInfo($r)['subject_code']." (".preg_replace("/[^0-9-:\/]+/", "", subjectInfo($r)['time']).")"; ?>" readonly >
	    </div>
	  </div>
	</div>
	</form>
</div>

<div class="row">
	<div class="col-md-12 large-table-container-2">
		<form method="post" id="finalizeGradeForm">
		<input type="hidden" name="finalizeGradeHidden" value="">
		<table id="gradeTbl" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th colspan="2"></th>
					<th colspan="6">Attendance</th>
					<th colspan="4">Quizzes</th>
					<th colspan="6">Recitation</th>
					<th colspan="3">Project/Assignment</th>
					<th colspan="3">Final Exam</th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th>Student Number</th>
					<th>Name</th>
					<th>D1</th>
					<th>D2</th>
					<th>D3</th>
					<th>D4</th>
					<th>Total Attendance</th>
					<th>%</th>
					<th>Q1</th>
					<th>Q2</th>
					<th>Total Quiz</th>
					<th>%</th>
					<th>D1</th>
					<th>D2</th>
					<th>D3</th>
					<th>D4</th>
					<th>Total Recitation</th>
					<th>%</th>
					<th>Proj/Assign</th>
					<th>Total Proj/Assign</th>
					<th>%</th>
					<th>Exam</th>
					<th>Exam Total</th>
					<th>%</th>
					<th>Equivalent</th>
					<th>Remark</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td></td>
					<td style="color: red">Highest Possible Score (HPS)</td>
					<td><input type="text" name="attendance1_hps" value="<?php echo hps($r)['attendance1_hps']; ?>"></td>
					<td><input type="text" name="attendance2_hps"  value="<?php echo hps($r)['attendance2_hps']; ?>"></td>
					<td><input type="text" name="attendance3_hps" value="<?php echo hps($r)['attendance3_hps']; ?>"></td>
					<td><input type="text" name="attendance4_hps" value="<?php echo hps($r)['attendance4_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($r)['t_attendance_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($r)['p_attendance_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="quiz1_hps" value="<?php echo hps($r)['quiz1_hps']; ?>"></td>
					<td><input type="text" name="quiz2_hps" value="<?php echo hps($r)['quiz2_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($r)['t_quiz_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($r)['p_quiz_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="recitation1_hps" value="<?php echo hps($r)['recitation1_hps']; ?>"></td>
					<td><input type="text" name="recitation2_hps" value="<?php echo hps($r)['recitation2_hps']; ?>"></td>
					<td><input type="text" name="recitation3_hps" value="<?php echo hps($r)['recitation3_hps']; ?>"></td>
					<td><input type="text" name="recitation4_hps" value="<?php echo hps($r)['recitation4_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($r)['t_recitation_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($r)['p_recitation_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="proj_assign_hps" value="<?php echo hps($r)['proj_assign_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($r)['t_proj_assign_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($r)['p_proj_assign_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="exam_hps" value="<?php echo hps($r)['exam_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($r)['t_exam_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($r)['p_exam_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($r)['equivalent_hps'].'%'; ?>" readonly ></td>
					<td></td>
				</tr>
				<?php
					$query4 = mysqli_query($conn, "select a.*, b.* from student_subject a, students b where a.sy='$school_year_start' and a.student_number=b.student_number and a.subject_id='$r' order by b.last_name asc");
					while($row4 = mysqli_fetch_assoc($query4)){
						$c = $row4['student_number'];
						$d = grade($_GET['r'], $c, $row4['year']);
						?>
							<tr>
								<td>
									<?php echo $row4['student_number']; ?>
								</td>
								<td>
									<?php echo $row4['last_name'].", ".$row4['first_name']." ".$row4['suffix_name']; ?>
								</td>
								<td>
									<input type="hidden" name="student[]" value="<?php echo $row4['student_number']; ?>">
									<input type="hidden" name="<?php echo $c; ?>_year" value="<?php echo $row4['year']; ?>">
									<input type="hidden" name="<?php echo $c; ?>_equivalent_status" value="<?php echo $d['equivalent_status']; ?>">
									<input type="hidden" name="<?php echo $c; ?>_equivalent_value" value="<?php echo $d['equivalent']; ?>">
									<input type="text" name="<?php echo $c; ?>_attendance1" value="<?php echo $d['attendance1']; ?>" <?php echo h($r); ?> >
								</td>
								<td><input type="text" name="<?php echo $c; ?>_attendance2" value="<?php echo $d['attendance2']; ?>" <?php echo h($r); ?> ></td>
								<td><input type="text" name="<?php echo $c; ?>_attendance3" value="<?php echo $d['attendance3']; ?>" <?php echo h($r); ?> ></td>
								<td><input type="text" name="<?php echo $c; ?>_attendance4" value="<?php echo $d['attendance4']; ?>" <?php echo h($r); ?> ></td>
								<td><input type="text" value="<?php echo $d['t_attendance']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $d['p_attendance'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $c; ?>_quiz1" value="<?php echo $d['quiz1']; ?>" <?php echo h($r); ?> ></td>
								<td><input type="text" name="<?php echo $c; ?>_quiz2" value="<?php echo $d['quiz2']; ?>" <?php echo h($r); ?> ></td>
								<td><input type="text" value="<?php echo $d['t_quiz']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $d['p_quiz'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $c; ?>_recitation1" value="<?php echo $d['recitation1']; ?>" <?php echo h($r); ?> ></td>
								<td><input type="text" name="<?php echo $c; ?>_recitation2" value="<?php echo $d['recitation2']; ?>" <?php echo h($r); ?> ></td>
								<td><input type="text" name="<?php echo $c; ?>_recitation3" value="<?php echo $d['recitation3']; ?>" <?php echo h($r); ?> ></td>
								<td><input type="text" name="<?php echo $c; ?>_recitation4" value="<?php echo $d['recitation4']; ?>" <?php echo h($r); ?> ></td>
								<td><input type="text" value="<?php echo $d['t_attendance']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $d['p_attendance'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $c; ?>_proj_assign" value="<?php echo $d['proj_assign']; ?>" <?php echo h($r); ?> ></td>
								<td><input type="text" value="<?php echo $d['t_proj_assign']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $d['p_proj_assign'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $c; ?>_exam" value="<?php echo $d['exam']; ?>" <?php echo h($r); ?> ></td>
								<td><input type="text" value="<?php echo $d['t_exam']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $d['p_exam'].'%'; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $d['equivalent'].'%'; ?>" readonly >&emsp;<?php if(empty($d['status'])){ ?>
										<a href="#" data-toggle="modal" data-target="#editFinalGradeModal" data-gradeid="<?php echo $d['grade_id']; ?>">
											<span class="fa fa-pencil" data-toggle="tooltip" title="Edit Final Grade"></span>
										</a>
									<?php } ?>
								</td>
								<td>
									<input type="hidden" name="<?php echo $c; ?>_remark" value="<?php echo $d['remark']; ?>">
									<?php
										if($d['remark'] == "Passed"){
											echo "<span class='text-green'>Passed</span>";
										}else{
											echo "<span class='text-red'>Failed</span>";
										}
									?>
								</td>
							</tr>
						<?php
					}
				?>
			</tbody>
		</table>
		</form>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-md-12 text-center">
		<a href="grade.php?id=<?php echo $_GET['r']; ?>" class="btn btn-default">Cancel</a>
		<button type="button" class="btn btn-danger" id="finalizeGradeBtn" onclick="finalizeGradeSubmit()">Finalize</button>
	</div>
</div>