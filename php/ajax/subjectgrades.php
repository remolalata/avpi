<?php

include'../db_connection.php';
$id = mysqli_real_escape_string($conn, $_GET['q']);

$query = mysqli_query($conn, "select a.*, b.*, c.* from student_subject a, students b, subjects c where a.student_number = b.student_number and a.subject_id = c.subject_id and a.year = b.year and c.subject_id='$id'");

?>

<table id="gradeTbl2" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Student Number</th>
			<th>Name</th>
			<th>Grade</th>
		</tr>
	</thead>
	<tbody>
		<?php
			while($row = mysqli_fetch_assoc($query)){
				$query2 = mysqli_query($conn, "select * from grade where subject_id='".$row['subject_id']."' and student_number='".$row['student_number']."'");
				$row2 = mysqli_fetch_assoc($query2);
				?>
					<tr>
						<td><?php echo $row['student_number']; ?></td>
						<td><?php echo $row['last_name'].", ".$row['first_name']; ?></td>
						<td><?php echo $row2['equivalent']; ?></td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>

<script>
	$('#gradeTbl2').DataTable({
	    "paging": false,
	    "lengthChange": false,
	    "searching": false,
	    "ordering": true,
	    "info": false,
	    "autoWidth": false,
	  });
</script>