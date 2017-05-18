<?php
include'../db_connection.php';

$id = $_GET['id'];

?>
<span class="subject_title">Class Timothy - First Year</span>
<table class="table table-bordered">
	<tr>
		<th>SUBJ. CODE</th>
		<th>SUBJECT TITLE</th>
		<th>UNITS</th>
		<th>DAYS</th>
		<th>TIME</th>
		<th>ROOM</th>
	</tr>

	<?php
		$query16 = mysqli_query($conn, "select a.*, b.section_id, c.year_id, d.year_id from subjects a, subject_sections b, subject_years c, year d where a.subject_id=b.subject_id and a.subject_id=c.subject_id and c.year_id=d.yearID and d.year_id='1' and b.section_id='Timothy' and a.sy='$id'");
		$count16 = mysqli_num_rows($query16);
		if(empty($count16)){ ?>
			<tr>
				<td colspan="6">No data to display in the table</td>
			</tr>
		<?php }else{
			while($row16 = mysqli_fetch_assoc($query16)){ ?>
				<tr>
					<td><?php echo $row16['subject_code']; ?></td>
					<td><?php echo $row16['subject_description']; ?></td>
					<td><?php echo $row16['unit']; ?></td>
					<td><?php echo $row16['day']; ?></td>
					<td><?php echo $row16['time']; ?></td>
					<td><?php echo $row16['room']; ?></td>
				</tr>
			<?php }
		}
	?>
</table>

<span class="subject_title">Class Timothy - Second Year</span>
<table class="table table-bordered">
	<tr>
		<th>SUBJ. CODE</th>
		<th>SUBJECT TITLE</th>
		<th>UNITS</th>
		<th>DAYS</th>
		<th>TIME</th>
		<th>ROOM</th>
	</tr>

	<?php
		$query17 = mysqli_query($conn, "select a.*, b.section_id, c.year_id, d.year_id from subjects a, subject_sections b, subject_years c, year d where a.subject_id=b.subject_id and a.subject_id=c.subject_id and c.year_id=d.yearID and d.year_id='2' and b.section_id='Timothy' and a.sy='$id'");
		$count17 = mysqli_num_rows($query17);
		if(empty($count17)){ ?>
			<tr>
				<td colspan="6">No data to display in the table</td>
			</tr>
		<?php }else{
			while($row17 = mysqli_fetch_assoc($query17)){ ?>
				<tr>
					<td><?php echo $row17['subject_code']; ?></td>
					<td><?php echo $row17['subject_description']; ?></td>
					<td><?php echo $row17['unit']; ?></td>
					<td><?php echo $row17['day']; ?></td>
					<td><?php echo $row17['time']; ?></td>
					<td><?php echo $row17['room']; ?></td>
				</tr>
			<?php }
		}
	?>
</table>

<span class="subject_title">Class Timothy - Third Year</span>
<table class="table table-bordered">
	<tr>
		<th>SUBJ. CODE</th>
		<th>SUBJECT TITLE</th>
		<th>UNITS</th>
		<th>DAYS</th>
		<th>TIME</th>
		<th>ROOM</th>
	</tr>

	<?php
		$query18 = mysqli_query($conn, "select a.*, b.section_id, c.year_id, d.year_id from subjects a, subject_sections b, subject_years c, year d where a.subject_id=b.subject_id and a.subject_id=c.subject_id and c.year_id=d.yearID and d.year_id='3' and b.section_id='Timothy' and a.sy='$id'");
		$count18 = mysqli_num_rows($query18);
		if(empty($count18)){ ?>
			<tr>
				<td colspan="6">No data to display in the table</td>
			</tr>
		<?php }else{
			while($row18 = mysqli_fetch_assoc($query18)){ ?>
				<tr>
					<td><?php echo $row18['subject_code']; ?></td>
					<td><?php echo $row18['subject_description']; ?></td>
					<td><?php echo $row18['unit']; ?></td>
					<td><?php echo $row18['day']; ?></td>
					<td><?php echo $row18['time']; ?></td>
					<td><?php echo $row18['room']; ?></td>
				</tr>
			<?php }
		}
	?>
</table>

<span class="subject_title">Class Timothy - Fourth Year</span>
<table class="table table-bordered">
	<tr>
		<th>SUBJ. CODE</th>
		<th>SUBJECT TITLE</th>
		<th>UNITS</th>
		<th>DAYS</th>
		<th>TIME</th>
		<th>ROOM</th>
	</tr>

	<?php
		$query19 = mysqli_query($conn, "select a.*, b.section_id, c.year_id, d.year_id from subjects a, subject_sections b, subject_years c, year d where a.subject_id=b.subject_id and a.subject_id=c.subject_id and c.year_id=d.yearID and d.year_id='4' and b.section_id='Timothy' and a.sy='$id'");
		$count19 = mysqli_num_rows($query19);
		if(empty($count19)){ ?>
			<tr>
				<td colspan="6">No data to display in the table</td>
			</tr>
		<?php }else{
			while($row19 = mysqli_fetch_assoc($query19)){ ?>
				<tr>
					<td><?php echo $row19['subject_code']; ?></td>
					<td><?php echo $row19['subject_description']; ?></td>
					<td><?php echo $row19['unit']; ?></td>
					<td><?php echo $row19['day']; ?></td>
					<td><?php echo $row19['time']; ?></td>
					<td><?php echo $row19['room']; ?></td>
				</tr>
			<?php }
		}
	?>
</table>

<span class="subject_title">Class Titus</span>
<table class="table table-bordered">
	<tr>
		<th>SUBJ. CODE</th>
		<th>SUBJECT TITLE</th>
		<th>UNITS</th>
		<th>DAYS</th>
		<th>TIME</th>
		<th>ROOM</th>
	</tr>

	<?php
		$query20 = mysqli_query($conn, "select a.*, b.section_id from subjects a, subject_sections b where a.subject_id=b.subject_id and b.section_id='Titus' and a.sy='$id'");
		$count20 = mysqli_num_rows($query20);
		if(empty($count20)){ ?>
			<tr>
				<td colspan="6">No data to display in the table</td>
			</tr>
		<?php }else{
			while($row20 = mysqli_fetch_assoc($query20)){ ?>
				<tr>
					<td><?php echo $row20['subject_code']; ?></td>
					<td><?php echo $row20['subject_description']; ?></td>
					<td><?php echo $row20['unit']; ?></td>
					<td><?php echo $row20['day']; ?></td>
					<td><?php echo $row20['time']; ?></td>
					<td><?php echo $row20['room']; ?></td>
				</tr>
			<?php }
		}
	?>
</table>

<span class="subject_title">Class Paul</span>
<table class="table table-bordered">
	<tr>
		<th>SUBJ. CODE</th>
		<th>SUBJECT TITLE</th>
		<th>UNITS</th>
		<th>DAYS</th>
		<th>TIME</th>
		<th>ROOM</th>
	</tr>

	<?php
		$query21 = mysqli_query($conn, "select a.*, b.section_id from subjects a, subject_sections b where a.subject_id=b.subject_id and b.section_id='Paul' and a.sy='$id'");
		$count21 = mysqli_num_rows($query21);
		if(empty($count21)){ ?>
			<tr>
				<td colspan="6">No data to display in the table</td>
			</tr>
		<?php }else{
			while($row21 = mysqli_fetch_assoc($query21)){ ?>
				<tr>
					<td><?php echo $row21['subject_code']; ?></td>
					<td><?php echo $row21['subject_description']; ?></td>
					<td><?php echo $row21['unit']; ?></td>
					<td><?php echo $row21['day']; ?></td>
					<td><?php echo $row21['time']; ?></td>
					<td><?php echo $row21['room']; ?></td>
				</tr>
			<?php }
		}
	?>
</table>

<span class="subject_title">Electives</span>
<table class="table table-bordered">
	<tr>
		<th>SUBJ. CODE</th>
		<th>SUBJECT TITLE</th>
		<th>UNITS</th>
		<th>DAYS</th>
		<th>TIME</th>
		<th>ROOM</th>
	</tr>

	<?php
		$query21 = mysqli_query($conn, "select a.*, b.section_id from subjects a, subject_sections b where a.subject_id=b.subject_id and b.section_id='EL' and a.sy='$id'");
		$count21 = mysqli_num_rows($query21);
		if(empty($count21)){ ?>
			<tr>
				<td colspan="6">No data to display in the table</td>
			</tr>
		<?php }else{
			while($row21 = mysqli_fetch_assoc($query21)){ ?>
				<tr>
					<td><?php echo $row21['subject_code']; ?></td>
					<td><?php echo $row21['subject_description']; ?></td>
					<td><?php echo $row21['unit']; ?></td>
					<td><?php echo $row21['day']; ?></td>
					<td><?php echo $row21['time']; ?></td>
					<td><?php echo $row21['room']; ?></td>
				</tr>
			<?php }
		}
	?>
</table>
