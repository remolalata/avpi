<?php
	$id = mysqli_real_escape_string($conn, $_GET['id']);
?>
<div class="row">
	<form class="form-horizontal">
	<div class="col-md-6">
		<div class="form-group">
			<label class="col-sm-2 control-label">Section</label>

			<div class="col-sm-10">
			  <input type="text" class="form-control" value="<?php echo getSections($id); ?>" readonly >
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">Instructor</label>

			<div class="col-sm-10">
			  <input type="text" class="form-control" value="<?php echo getUser(subjectInfo($id)['instructor']); ?>" readonly >
			</div>
		</div>
	</div>
	<div class="col-md-6">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Subject & Schedule</label>

	    <div class="col-sm-10">
	      <input type="text" class="form-control" value="<?php echo subjectInfo($id)['subject_code']." (".preg_replace("/[^0-9-:\/]+/", "", subjectInfo($id)['time']).")"; ?>" readonly >
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
					<td><input type="text" name="attendance1_hps" value="<?php echo hps($id)['attendance1_hps']; ?>"></td>
					<td><input type="text" name="attendance2_hps"  value="<?php echo hps($id)['attendance2_hps']; ?>"></td>
					<td><input type="text" name="attendance3_hps" value="<?php echo hps($id)['attendance3_hps']; ?>"></td>
					<td><input type="text" name="attendance4_hps" value="<?php echo hps($id)['attendance4_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($id)['t_attendance_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($id)['p_attendance_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="quiz1_hps" value="<?php echo hps($id)['quiz1_hps']; ?>"></td>
					<td><input type="text" name="quiz2_hps" value="<?php echo hps($id)['quiz2_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($id)['t_quiz_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($id)['p_quiz_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="recitation1_hps" value="<?php echo hps($id)['recitation1_hps']; ?>"></td>
					<td><input type="text" name="recitation2_hps" value="<?php echo hps($id)['recitation2_hps']; ?>"></td>
					<td><input type="text" name="recitation3_hps" value="<?php echo hps($id)['recitation3_hps']; ?>"></td>
					<td><input type="text" name="recitation4_hps" value="<?php echo hps($id)['recitation4_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($id)['t_recitation_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($id)['p_recitation_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="proj_assign_hps" value="<?php echo hps($id)['proj_assign_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($id)['t_proj_assign_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($id)['p_proj_assign_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" name="exam_hps" value="<?php echo hps($id)['exam_hps']; ?>"></td>
					<td><input type="text" value="<?php echo hps($id)['t_exam_hps']; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($id)['p_exam_hps'].'%'; ?>" readonly ></td>
					<td><input type="text" value="<?php echo hps($id)['equivalent_hps'].'%'; ?>" readonly ></td>
					<td></td>
				</tr>
				<?php
					$query2 = mysqli_query($conn, "select a.*, b.* from student_subject a, students b where a.sy='$school_year_start' and a.student_number=b.student_number and a.subject_id='$id' order by b.last_name asc");
					while($row2 = mysqli_fetch_assoc($query2)){
						$a = $row2['student_number'];
						$b = grade($_GET['id'], $a, $row2['year']);
						?>
							<tr>
								<td>
									<?php echo $row2['student_number']; ?>
								</td>
								<td>
									<?php echo $row2['last_name'].", ".$row2['first_name']." ".$row2['suffix_name']; ?>
								</td>
								<td>
									<input type="hidden" name="student[]" value="<?php echo $row2['student_number']; ?>">
									<input type="hidden" name="<?php echo $a; ?>_year" value="<?php echo $row2['year']; ?>">
									<input type="hidden" name="<?php echo $a; ?>_equivalent_status" value="<?php echo $b['equivalent_status']; ?>">
									<input type="hidden" name="<?php echo $a; ?>_equivalent_value" value="<?php echo $b['equivalent']; ?>">
									<input type="text" name="<?php echo $a; ?>_attendance1" value="<?php echo $b['attendance1']; ?>" <?php echo h($id); ?> >
								</td>
								<td><input type="text" name="<?php echo $a; ?>_attendance2" value="<?php echo $b['attendance2']; ?>" <?php echo h($id); ?> ></td>
								<td><input type="text" name="<?php echo $a; ?>_attendance3" value="<?php echo $b['attendance3']; ?>" <?php echo h($id); ?> ></td>
								<td><input type="text" name="<?php echo $a; ?>_attendance4" value="<?php echo $b['attendance4']; ?>" <?php echo h($id); ?> ></td>
								<td><input type="text" value="<?php echo $b['t_attendance']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $b['p_attendance'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $a; ?>_quiz1" value="<?php echo $b['quiz1']; ?>" <?php echo h($id); ?> ></td>
								<td><input type="text" name="<?php echo $a; ?>_quiz2" value="<?php echo $b['quiz2']; ?>" <?php echo h($id); ?> ></td>
								<td><input type="text" value="<?php echo $b['t_quiz']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $b['p_quiz'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $a; ?>_recitation1" value="<?php echo $b['recitation1']; ?>" <?php echo h($id); ?> ></td>
								<td><input type="text" name="<?php echo $a; ?>_recitation2" value="<?php echo $b['recitation2']; ?>" <?php echo h($id); ?> ></td>
								<td><input type="text" name="<?php echo $a; ?>_recitation3" value="<?php echo $b['recitation3']; ?>" <?php echo h($id); ?> ></td>
								<td><input type="text" name="<?php echo $a; ?>_recitation4" value="<?php echo $b['recitation4']; ?>" <?php echo h($id); ?> ></td>
								<td><input type="text" value="<?php echo $b['t_attendance']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $b['p_attendance'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $a; ?>_proj_assign" value="<?php echo $b['proj_assign']; ?>" <?php echo h($id); ?> ></td>
								<td><input type="text" value="<?php echo $b['t_proj_assign']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $b['p_proj_assign'].'%'; ?>" readonly ></td>
								<td><input type="text" name="<?php echo $a; ?>_exam" value="<?php echo $b['exam']; ?>" <?php echo h($id); ?> ></td>
								<td><input type="text" value="<?php echo $b['t_exam']; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $b['p_exam'].'%'; ?>" readonly ></td>
								<td><input type="text" value="<?php echo $b['equivalent'].'%'; ?>" readonly >&emsp;
									<?php if(empty($b['status'])){ ?>
										<a href="#" data-toggle="modal" data-target="#editFinalGradeModal" data-gradeid="<?php echo $b['grade_id']; ?>" data-studentnumber="<?php echo $row2['student_number']; ?>" data-year="<?php echo $row2['year']; ?>">
											<span class="fa fa-pencil" data-toggle="tooltip" title="Edit Final Grade"></span>
										</a>
									<?php } ?>
								</td>
								<td>
									<?php
										if($b['remark'] == "Passed"){
											echo "<span class='text-green'>Passed</span>";
										}else{
											echo "<span class='text-red'>".$b['remark']."</span>";
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