<?php
include'../db_connection.php';
$key = $_GET['q'];
?>

<input type="hidden" name="instructorId" value="<?php echo $key; ?>">
<table class="table table-bordered" id="instructorSubjectTbl">
	<tr>
		<th>Subject Code</th>
		<th>Subject Name</th>
		<th>Sy</th>
		<th>Unit</th>
		<th>Time</th>
		<th>Day</th>
		<th>Room</th>
		<th></th>
	</tr>

	<?php
	$query = mysqli_query($conn, "select * from subjects where instructor='$key'");
	while($row = mysqli_fetch_assoc($query)){ ?>

	<tr>
		<td>
			<input type="hidden" name="instructorSubjectHidden" value="<?php echo $row['subject_id']; ?>">
			<input type="hidden" name="instructorSubjectArr[]" value="<?php echo $row['subject_id']; ?>">
			<?php echo $row['subject_code']; ?>
		</td>
		<td><?php echo $row['subject_description']; ?></td>
		<td><?php echo $row['sy']; ?></td>
		<td><?php echo $row['unit']; ?></td>
		<td><?php echo $row['time']; ?></td>
		<td><?php echo $row['day']; ?></td>
		<td><?php echo $row['room']; ?></td>
		<td align="center"><button type="button" class="btn btn-danger btn-xs" id="instructorSubjectRemove"><i class="fa fa-times" data-toggle="tooltip" title="Remove Subject"></i></button></td>
	</tr>

	<?php } ?>
</table>

<script>
	$("#instructorSubjectTbl").on('click', '#instructorSubjectRemove', function(e){
		$(this).closest('tr').remove();
	});
</script>