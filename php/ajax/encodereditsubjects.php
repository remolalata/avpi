<?php
include'../db_connection.php';
$key = $_GET['q'];
?>

<input type="hidden" name="encoderId" value="<?php echo $key; ?>">
<table class="table table-bordered" id="encoderSubjectTbl">
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
	$query = mysqli_query($conn, "select * from subjects where encoder='$key'");
	while($row = mysqli_fetch_assoc($query)){ ?>

	<tr>
		<td>
			<input type="hidden" name="encoderSubjectHidden" value="<?php echo $row['subject_id']; ?>">
			<input type="hidden" name="encoderSubjectArr[]" value="<?php echo $row['subject_id']; ?>">
			<?php echo $row['subject_code']; ?>
		</td>
		<td><?php echo $row['subject_description']; ?></td>
		<td><?php echo $row['sy']; ?></td>
		<td><?php echo $row['unit']; ?></td>
		<td><?php echo $row['time']; ?></td>
		<td><?php echo $row['day']; ?></td>
		<td><?php echo $row['room']; ?></td>
		<td align="center"><button type="button" class="btn btn-danger btn-xs" id="encoderSubjectRemove"><i class="fa fa-times" data-toggle="tooltip" title="Remove Subject"></i></button></td>
	</tr>

	<?php } ?>
</table>

<script>
	$("#encoderSubjectTbl").on('click', '#encoderSubjectRemove', function(e){
		$(this).closest('tr').remove();
	});
</script>