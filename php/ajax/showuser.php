<?php
	session_start();
	include'../db_connection.php';
	$key = mysqli_real_escape_string($conn, $_GET['q']);
	$user_id = $_SESSION['user_id'];
	$query = mysqli_query($conn, "select * from users where username like '%$key%' or  first_name like '%$key%' or last_name like '%$key%' or middle_name like '%$key%' ");
	$count = mysqli_num_rows($query);

	?>
		<div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title">Search Results</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered">
					<tr>
						<th>Username</th>
						<th>Name</th>
						<th>Contact Number</th>
						<th>Email Address</th>
						<th>Church</th>
						<th>Account Type</th>
						<th></th>
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
			if($row['user_id'] != $user_id){
				?>
					<tr>
						<td><?php echo $row['username']; ?></td>
						<td><?php echo ucfirst($row['first_name'])." ".ucfirst($row['last_name']); ?></td>
						<td><?php echo $row['contact_number']; ?></td>
						<td><?php echo $row['email_address']; ?></td>
						<td><?php echo $row['church']; ?></td>
						<td><?php echo ucfirst($row['user_type']); ?></td>
						<td align="center">
							<form method="post">
								<input type="hidden" name="deleteUserHidden" value="<?php echo $row['user_id']; ?>">
								<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#editUserModal" data-userid="<?php echo $row['user_id']; ?>"><i class="fa fa-pencil"></i></button>
								<button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are sure you want to delete this user?')"><i class="fa fa-trash"></i></button>
							</form>
						</td>
					</tr>
				<?php
			}
		}

	}

	?>
		</table>
	</div>
	<?php
?>
