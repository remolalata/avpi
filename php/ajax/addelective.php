<?php

include'../db_connection.php';
$key = $_GET['q'];
$query = mysqli_query($conn, "select * from students where student_number='".$key."'");
$row = mysqli_fetch_assoc($query);

//for testing purposes
$school_year_start = '17';
// $school_year_start = date('y');
?>

<style>
	.notELective{display: none}
</style>

<div class="row">
	<div class="col-md-6 text-left">
	</div>
	<div class="col-md-3 col-md-offset-3 text-right">
		<select name="" id="" class="form-control" onchange="ifElective(value)">
			<option value="1">Elective Subjects</option>
			<option value="2">All Subjects</option>
		</select>
	</div>
</div><br>

<table class="table table-bordered table-striped">
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
		// $query2 = mysqli_query($conn, "select a.*, b.*, c.* from subjects a, subject_sections b, subject_years c where a.course='".$row['course']."' and b.section_id='".$row['section']."' and c.year_id='".$row['year']."' and a.subject_id=b.subject_id and a.subject_id=c.subject_id");
		$query2 = mysqli_query($conn, "select * from subjects where unit='2' and sy='$school_year_start'");
		$count2 = mysqli_num_rows($query2);

		if(empty($count2)){
			?>
				<tr id="no_subjects_to_display">
					<td colspan="7">No subjects to display in table</td>
				</tr>
			<?php
		}else{
			while($row2 = mysqli_fetch_assoc($query2)){
				?>
					<tr>
						<td><?php echo $row2['subject_code']; ?></td>
						<td><?php echo $row2['subject_description']; ?></td>
						<td><?php echo $row2['unit']; ?></td>
						<td><?php echo $row2['day']; ?></td>
						<td><?php echo $row2['time']; ?></td>
						<td><?php echo $row2['room']; ?></td>
						<td align="center">
							<input type="checkbox" name="subject[]" id="electiveCheckbox" value="<?php echo $row2['subject_id']; ?>">
						</td>
					</tr>
				<?php
			}
		}
	?>
	<?php
		$query3 = mysqli_query($conn, "select * from subjects where sy='$school_year_start'");
		while($row3 = mysqli_fetch_assoc($query3)){
			?>
				<tr class="notELective">
					<td><?php echo $row3['subject_code']; ?></td>
					<td><?php echo $row3['subject_description']; ?></td>
					<td><?php echo $row3['unit']; ?></td>
					<td><?php echo $row3['day']; ?></td>
					<td><?php echo $row3['time']; ?></td>
					<td><?php echo $row3['room']; ?></td>
					<td align="center">
						<input type="checkbox" name="subject[]" id="electiveCheckbox" value="<?php echo $row3['subject_id']; ?>">
					</td>
				</tr>
			<?php
		}
	?>
</table>

<script>
	function ifElective(val){
		var elements = document.getElementsByClassName("notELective");
		if(val == 2){
			for(var i = 0, length = elements.length; i < length; i++) {
		        elements[i].style.display = 'table-row';
		    }
		    document.getElementById("no_subjects_to_display").style.display = 'none';
		}else{
			for(var i = 0, length = elements.length; i < length; i++) {
		        elements[i].style.display = 'none';
		    }
		    document.getElementById("no_subjects_to_display").style.display = 'table-row';
		}
	}
</script>