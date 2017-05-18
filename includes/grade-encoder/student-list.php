<?php
	$e_id = mysqli_real_escape_string($conn, $_GET['id']);
?>
<div class="row">
	<form class="form-horizontal">
	<div class="col-md-6">
		<div class="form-group">
			<label class="col-sm-2 control-label">Section</label>

			<div class="col-sm-10">
			  <input type="text" class="form-control" value="<?php echo getSections($e_id); ?>" readonly >
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">Instructor</label>

			<div class="col-sm-10">
			  <input type="text" class="form-control" value="<?php echo getUser(subjectInfo($e_id)['instructor']); ?>" readonly >
			</div>
		</div>
	</div>
	<div class="col-md-6">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Subject & Schedule</label>

	    <div class="col-sm-10">
	      <input type="text" class="form-control" value="<?php echo subjectInfo($e_id)['subject_code']." (".preg_replace("/[^0-9-:\/]+/", "", subjectInfo($e_id)['time']).")"; ?>" readonly >
	    </div>
	  </div>
	</div>
	</form>
</div>

<div class="row">
	<div class="col-md-12 large-table-container-2">
		<form method="post" id="saveGradeForm">
		<input type="hidden" name="inputGrade" value="">
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
					<td><input type="text" name="attendance1_hps" value="<?php echo hps($e_id)['attendance1_hps']; ?>"></td>
					<td><input type="text" name="attendance2_hps"  value="<?php echo hps($e_id)['attendance2_hps']; ?>"></td>
					<td><input type="text" name="attendance3_hps" value="<?php echo hps($e_id)['attendance3_hps']; ?>"></td>
					<td><input type="text" name="attendance4_hps" value="<?php echo hps($e_id)['attendance4_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($e_id)['t_attendance_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($e_id)['p_attendance_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="quiz1_hps" value="<?php echo hps($e_id)['quiz1_hps']; ?>"></td>
					<td><input type="text" name="quiz2_hps" value="<?php echo hps($e_id)['quiz2_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($e_id)['t_quiz_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($e_id)['p_quiz_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="recitation1_hps" value="<?php echo hps($e_id)['recitation1_hps']; ?>"></td>
					<td><input type="text" name="recitation2_hps" value="<?php echo hps($e_id)['recitation2_hps']; ?>"></td>
					<td><input type="text" name="recitation3_hps" value="<?php echo hps($e_id)['recitation3_hps']; ?>"></td>
					<td><input type="text" name="recitation4_hps" value="<?php echo hps($e_id)['recitation4_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($e_id)['t_recitation_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($e_id)['p_recitation_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="proj_assign_hps" value="<?php echo hps($e_id)['proj_assign_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($e_id)['t_proj_assign_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($e_id)['p_proj_assign_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="exam_hps" value="<?php echo hps($e_id)['exam_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($e_id)['t_exam_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($e_id)['p_exam_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($e_id)['equivalent_hps'].'%'; ?>" readonly ></td>
					<td></td>
					<td></td>
				</tr>
				<?php
					$e_query = mysqli_query($conn, "select a.*, b.* from student_subject a, students b where a.sy='$school_year_start' and a.student_number=b.student_number and a.subject_id='$e_id' order by b.last_name asc");
					while($e_row = mysqli_fetch_assoc($e_query)){
						$e_a = $e_row['student_number'];
						$e_b = grade($_GET['id'], $e_a, $e_row['year']);
						?>
							<tr>
								<td>
									<?php echo $e_row['student_number']; ?>
								</td>
								<td>
									<?php echo $e_row['last_name'].", ".$e_row['first_name']." ".$e_row['suffix_name']; ?>
								</td>
								<td>
									<input type="hidden" name="student[]" value="<?php echo $e_row['student_number']; ?>">
									<input type="hidden" name="<?php echo $e_a; ?>_year" value="<?php echo $e_row['year']; ?>">
									<input type="hidden" name="<?php echo $e_a; ?>_equivalent_status" value="<?php echo $e_b['equivalent_status']; ?>">
									<input type="hidden" name="<?php echo $e_a; ?>_equivalent_value" value="<?php echo $e_b['equivalent']; ?>">
									<input type="text" name="<?php echo $e_a; ?>_attendance1" value="<?php echo $e_b['attendance1']; ?>" <?php echo h($e_id); ?> >
								</td>
								<td><input type="text" name="<?php echo $e_a; ?>_attendance2" value="<?php echo $e_b['attendance2']; ?>" <?php echo h($e_id); echo encoderdcheck($e_id, 'attendance1'); ?> ></td>
								<td><input type="text" name="<?php echo $e_a; ?>_attendance3" value="<?php echo $e_b['attendance3']; ?>" <?php echo h($e_id); echo encoderdcheck($e_id, 'attendance2'); ?> ></td>
								<td><input type="text" name="<?php echo $e_a; ?>_attendance4" value="<?php echo $e_b['attendance4']; ?>" <?php echo h($e_id); echo encoderdcheck($e_id, 'attendance3'); ?> ></td>
								<td><input type="text" value="<?php echo $e_b['t_attendance']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $e_b['p_attendance'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $e_a; ?>_quiz1" value="<?php echo $e_b['quiz1']; ?>" <?php echo h($e_id); ?> ></td>
								<td><input type="text" name="<?php echo $e_a; ?>_quiz2" value="<?php echo $e_b['quiz2']; ?>" <?php echo h($e_id); echo encoderdcheck($e_id, 'quiz1'); ?> ></td>
								<td><input type="text" value="<?php echo $e_b['t_quiz']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $e_b['p_quiz'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $e_a; ?>_recitation1" value="<?php echo $e_b['recitation1']; ?>" <?php echo h($e_id); ?> ></td>
								<td><input type="text" name="<?php echo $e_a; ?>_recitation2" value="<?php echo $e_b['recitation2']; ?>" <?php echo h($e_id); echo encoderdcheck($e_id, 'recitation1'); ?> ></td>
								<td><input type="text" name="<?php echo $e_a; ?>_recitation3" value="<?php echo $e_b['recitation3']; ?>" <?php echo h($e_id); echo encoderdcheck($e_id, 'recitation2'); ?> ></td>
								<td><input type="text" name="<?php echo $e_a; ?>_recitation4" value="<?php echo $e_b['recitation4']; ?>" <?php echo h($e_id); echo encoderdcheck($e_id, 'recitation3'); ?> ></td>
								<td><input type="text" value="<?php echo $e_b['t_attendance']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $e_b['p_attendance'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $e_a; ?>_proj_assign" value="<?php echo $e_b['proj_assign']; ?>" <?php echo h($e_id); ?> ></td>
								<td><input type="text" value="<?php echo $e_b['t_proj_assign']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $e_b['p_proj_assign'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $e_a; ?>_exam" value="<?php echo $e_b['exam']; ?>" <?php echo h($e_id); ?> ></td>
								<td><input type="text" value="<?php echo $e_b['t_exam']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $e_b['p_exam'].'%'; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $e_b['equivalent'].'%'; ?>" readonly >&emsp;
									<?php if(empty($e_b['status'])){ ?>
										<a href="#" data-toggle="modal" data-target="#editFinalGradeModal" data-gradeid="<?php echo $e_b['grade_id']; ?>" data-studentnumber="<?php echo $e_row['student_number']; ?>" data-year="<?php echo $e_row['year']; ?>">
											<span class="fa fa-pencil" data-toggle="tooltip" title="Edit Final Grade"></span>
										</a>
									<?php } ?>
								</td>
								<td>
									<?php
										$t_g = $e_b['equivalent']; //the_grade
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
									<?php
										if($e_b['remark'] == "Passed"){
											echo "<span class='text-green'>Passed</span>";
										}else{
											echo "<span class='text-red'>".$e_b['remark']."</span>";
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
		<a href="grade.php?r=<?php echo $_GET['id']; ?>" class="btn btn-default">Review Grade</a>
		<button type="button" onclick="saveGradeBtn()" id="saveGradeBtn" class="btn btn-danger">Save</button>
	</div>
</div>