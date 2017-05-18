<?php
	include'../db_connection.php';
	$key = mysqli_real_escape_string($conn, $_GET['q']);

	$query = mysqli_query($conn, "select * from students where student_number like '%$key%' or last_name like '%$key%' or first_name like '%$key%' or middle_name like '%$key%' or course like '%$key%' ");
	$count = mysqli_num_rows($query);

	?>
		<div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title">Search Results</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered">
					<tr>
						<th>Student Number</th>
						<th>Name of Student</th>
						<th>Year & Section</th>
						<th>Course</th>
						<th>Church</th>
						<th>Pastor</th>
						<th>Action</th>
					</tr>
	<?php

	if(empty($count)){
		?>
			<tr>
				<td colspan="7" align="center"><h3>No Match Found.</h3></td>
			</tr>
		<?php
	}else{

		while($row = mysqli_fetch_assoc($query)){
			?>
				<tr>
					<td><?php echo $row['student_number']; ?></td>
					<td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
					<td><?php echo $row['section']." - ".$row['year']; ?></td>
					<td><?php echo $row['course']; ?></td>
					<td>
						<?php
							$query2 = mysqli_query($conn, "select * from church where church_id='".$row['church']."'");
							$row2 = mysqli_fetch_assoc($query2);

							echo $row2['church_name'];
						?>
					</td>
					<td><?php echo $row2['pastor']; ?></td>
					<td align="center">	
						<form method="post">
							<input type="hidden" name="deleteStudentHidden" value="<?php echo $row['student_number']; ?>">
							<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#viewStudentModal" data-viewid="<?php echo $row['student_number']; ?>"><i class="fa fa-eye" data-toggle="tooltip" title="View Student"></i></button>
							<button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are sure you want to delete this student?')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete Student"></i></button>
						</form>
					</td>
				</tr>
			<?php
		}

	}

	?>
		</table>
	</div>
	<?php
?>
