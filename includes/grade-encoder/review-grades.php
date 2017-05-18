<?php
	$e_r = mysqli_real_escape_string($conn, $_GET['r']);
?>
<div class="row">
	<form class="form-horizontal">
	<div class="col-md-6">
		<div class="form-group">
			<label class="col-sm-2 control-label">Section</label>

			<div class="col-sm-10">
			  <input type="text" class="form-control" value="<?php echo getSections($e_r); ?>" readonly >
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">Instructor</label>

			<div class="col-sm-10">
			  <input type="text" class="form-control" value="<?php echo getUser(subjectInfo($e_r)['instructor']); ?>" readonly >
			</div>
		</div>
	</div>
	<div class="col-md-6">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Subject & Schedule</label>

	    <div class="col-sm-10">
	      <input type="text" class="form-control" value="<?php echo subjectInfo($e_r)['subject_code']." (".preg_replace("/[^0-9-:\/]+/", "", subjectInfo($e_r)['time']).")"; ?>" readonly >
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
					<th>Point Equivalent</th>
					<th>Remark</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td></td>
					<td style="color: red">Highest Possible Score (HPS)</td>
					<td><input type="text" name="attendance1_hps" value="<?php echo hps($e_r)['attendance1_hps']; ?>"></td>
					<td><input type="text" name="attendance2_hps"  value="<?php echo hps($e_r)['attendance2_hps']; ?>"></td>
					<td><input type="text" name="attendance3_hps" value="<?php echo hps($e_r)['attendance3_hps']; ?>"></td>
					<td><input type="text" name="attendance4_hps" value="<?php echo hps($e_r)['attendance4_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($e_r)['t_attendance_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($e_r)['p_attendance_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="quiz1_hps" value="<?php echo hps($e_r)['quiz1_hps']; ?>"></td>
					<td><input type="text" name="quiz2_hps" value="<?php echo hps($e_r)['quiz2_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($e_r)['t_quiz_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($e_r)['p_quiz_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="recitation1_hps" value="<?php echo hps($e_r)['recitation1_hps']; ?>"></td>
					<td><input type="text" name="recitation2_hps" value="<?php echo hps($e_r)['recitation2_hps']; ?>"></td>
					<td><input type="text" name="recitation3_hps" value="<?php echo hps($e_r)['recitation3_hps']; ?>"></td>
					<td><input type="text" name="recitation4_hps" value="<?php echo hps($e_r)['recitation4_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($e_r)['t_recitation_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($e_r)['p_recitation_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="proj_assign_hps" value="<?php echo hps($e_r)['proj_assign_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($e_r)['t_proj_assign_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($e_r)['p_proj_assign_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="exam_hps" value="<?php echo hps($e_r)['exam_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($e_r)['t_exam_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($e_r)['p_exam_hps'].'%'; ?>" readonly ></td>
					<td></td>
					<td><input type="text" value="<?php echo hps($e_r)['equivalent_hps'].'%'; ?>" readonly ></td>
					<td></td>
				</tr>
				<?php
					$e_query2 = mysqli_query($conn, "select a.*, b.* from student_subject a, students b where a.sy='$school_year_start' and a.student_number=b.student_number and a.subject_id='$e_r' order by b.last_name asc");
					while($e_row2 = mysqli_fetch_assoc($e_query2)){
						$e_c = $e_row2['student_number'];
						$e_d = grade($_GET['r'], $e_c, $e_row2['year']);
						?>
							<tr>
								<td>
									<?php echo $e_row2['student_number']; ?>
								</td>
								<td>
									<?php echo $e_row2['last_name'].", ".$e_row2['first_name']." ".$e_row2['suffix_name']; ?>
								</td>
								<td>
									<input type="hidden" name="student[]" value="<?php echo $e_row2['student_number']; ?>">
									<input type="hidden" name="<?php echo $e_c; ?>_year" value="<?php echo $e_row2['year']; ?>">
									<input type="hidden" name="<?php echo $e_c; ?>_equivalent_status" value="<?php echo $e_d['equivalent_status']; ?>">
									<input type="hidden" name="<?php echo $e_c; ?>_equivalent_value" value="<?php echo $e_d['equivalent']; ?>">
									<input type="text" name="<?php echo $e_c; ?>_attendance1" value="<?php echo $e_d['attendance1']; ?>" <?php echo h($e_r); ?> >
								</td>
								<td><input type="text" name="<?php echo $e_c; ?>_attendance2" value="<?php echo $e_d['attendance2']; ?>" <?php echo h($e_r); echo encoderdcheck($e_r, 'attendance1'); ?> ></td>
								<td><input type="text" name="<?php echo $e_c; ?>_attendance3" value="<?php echo $e_d['attendance3']; ?>" <?php echo h($e_r); echo encoderdcheck($e_r, 'attendance2'); ?> ></td>
								<td><input type="text" name="<?php echo $e_c; ?>_attendance4" value="<?php echo $e_d['attendance4']; ?>" <?php echo h($e_r); echo encoderdcheck($e_r, 'attendance3'); ?> ></td>
								<td><input type="text" value="<?php echo $e_d['t_attendance']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $e_d['p_attendance'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $e_c; ?>_quiz1" value="<?php echo $e_d['quiz1']; ?>" <?php echo h($e_r); ?> ></td>
								<td><input type="text" name="<?php echo $e_c; ?>_quiz2" value="<?php echo $e_d['quiz2']; ?>" <?php echo h($e_r); echo encoderdcheck($e_r, 'quiz1'); ?> ></td>
								<td><input type="text" value="<?php echo $e_d['t_quiz']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $e_d['p_quiz'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $e_c; ?>_recitation1" value="<?php echo $e_d['recitation1']; ?>" <?php echo h($e_r); ?> ></td>
								<td><input type="text" name="<?php echo $e_c; ?>_recitation2" value="<?php echo $e_d['recitation2']; ?>" <?php echo h($e_r); echo encoderdcheck($e_r, 'recitation1'); ?> ></td>
								<td><input type="text" name="<?php echo $e_c; ?>_recitation3" value="<?php echo $e_d['recitation3']; ?>" <?php echo h($e_r); echo encoderdcheck($e_r, 'recitation2'); ?> ></td>
								<td><input type="text" name="<?php echo $e_c; ?>_recitation4" value="<?php echo $e_d['recitation4']; ?>" <?php echo h($e_r); echo encoderdcheck($e_r, 'recitation3'); ?> ></td>
								<td><input type="text" value="<?php echo $e_d['t_attendance']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $e_d['p_attendance'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $e_c; ?>_proj_assign" value="<?php echo $e_d['proj_assign']; ?>" <?php echo h($e_r); ?> ></td>
								<td><input type="text" value="<?php echo $e_d['t_proj_assign']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $e_d['p_proj_assign'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $e_c; ?>_exam" value="<?php echo $e_d['exam']; ?>" <?php echo h($e_r); ?> ></td>
								<td><input type="text" value="<?php echo $e_d['t_exam']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $e_d['p_exam'].'%'; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $e_d['equivalent'].'%'; ?>" readonly >&emsp;<?php if(empty($e_d['status'])){ ?>
										<a href="#" data-toggle="modal" data-target="#editFinalGradeModal" data-gradeid="<?php echo $e_d['grade_id']; ?>">
											<span class="fa fa-pencil" data-toggle="tooltip" title="Edit Final Grade"></span>
										</a>
									<?php } ?>
								</td>
								<td>
									<?php
										$t_g = $e_d['equivalent']; //the_grade
										if($t_g <= 100 && $t_g >= 95){
											echo "<strong>A</strong>";
										}else if($t_g <= 94 && $t_g >= 90){
											echo "<strong>B</strong>";
										}else if($t_g <= 89 && $t_g >= 85){
											echo "<strong>C</strong>";
										}else if($t_g <= 84 && $t_g >= 80){
											echo "<strong>D</strong>";
										}else if($t_g <= 79){
											echo "<strong>F</strong>";
										}
									?>
								</td>
								<td>
									<input type="hidden" name="<?php echo $e_c; ?>_remark" value="<?php echo $e_d['remark']; ?>">
									<?php
										if($e_d['remark'] == "Passed"){
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