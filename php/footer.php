  </div>

  <footer class="main-footer text-right">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a style="color: #4d3c2d">Authorized Version 1611 Primer Institute School Management System</a>.</strong> All rights
    reserved.
  </footer>
</div>

<style>
  .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
  background-color: rgba(58, 39, 22, 0.8) !important;
  border-color: rgba(58, 39, 22, 0.4) !important;
}
</style>

<div class="modal" tabindex="-1" role="dialog" id="ifNewUser">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h4>Welcome <?php echo $the_user['first_name']; ?>, change your password first to continue.</h4>
		</div>
		<div class="modal-body">
			<form method="post" id="ifNewUserForm">
				<input type="hidden" name="ifNewUserHidden" id="ifNewUserHidden" value="<?php echo $the_user['user_id']; ?>">
				<div class="form-group" id="old_password_error">
					<label>Old Password</label>
					<input type="password" name="old_password" id="old_password" class="form-control" placeholder="Old Password" >
				</div>
				<div class="form-group" id="new_password_error">
					<label>New Password</label>
					<input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" >
				</div>
				<div class="form-group" id="confirm_new_password_error">
					<label>Confirm New Password</label>
					<input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" placeholder="Confirm New Password" >
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary" onclick="ifNewUserBtn()">Save Password</button>
		</div>
    </div>
  </div>
</div>

<script src="dist/js/app.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="js/script.js"></script>

<?php

if($the_user['new_user'] == 1){
	?>
		<script>
			$('#ifNewUser').modal('show');
		</script>
	<?php
}

?>

<?php

if(isset($_POST['ifNewUserHidden'])){

	$new_password = $_POST['new_password'];
	$confirm_new_password = $_POST['confirm_new_password'];
	$key_password="password";
	$encrypted_string=openssl_encrypt($new_password,"AES-128-ECB",$key_password);
	$decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$key_password);

	if($new_password != $confirm_new_password){
		echo "
		    <script>  
		      alert('Password did not match.');
		    </script>
		";
	}else{
		mysqli_query($conn, "update users set password='$encrypted_string', new_user='0' where user_id='".$the_user['user_id']."'");
		echo "
		    <script>  
		      alert('Password changed.');
		      $('#ifNewUser').modal('hide');
		    </script>
		";
	}
}

?>

<script>
	function ifNewUserBtn(){
	    var errors = [];
	    var user_id = document.getElementById("ifNewUserHidden").value;
	    var old_password = document.getElementById("old_password").value;
	    $.ajax({
	    type: "POST",
	    url: "php/ajax/checkpassword.php",
	    data: 'old_password='+old_password+'&user_id='+user_id,
	    dataType: 'json',
		    success: function(msg){

		      if(document.getElementById("old_password").value == ""){
		      	errors.push("error");
		        $("#old_password_error").addClass("has-error");
		        $("#old_password_error label").html("Old Password is empty");
		      }else if(msg.count == 0){
		      	errors.push("error");
		        $("#old_password_error").addClass("has-error");
		        $("#old_password_error label").html("Your Old Password is incorrect.");
		      }else{
		      	$("#old_password_error").removeClass("has-error");
		        $("#old_password_error label").html("Old Password");
		      }

		      if(document.getElementById("new_password").value == ""){
		      	errors.push("error");
		        $("#new_password_error").addClass("has-error");
		        $("#new_password_error label").html("New Password is empty");
		      }else{
		      	$("#new_password_error").removeClass("has-error");
		        $("#new_password_error label").html("New Password");
		      }

		      if(document.getElementById("confirm_new_password").value == ""){
		      	errors.push("error");
		        $("#confirm_new_password_error").addClass("has-error");
		        $("#confirm_new_password_error label").html("Confirm New Password is empty");
		      }else{
		      	$("#confirm_new_password_error").removeClass("has-error");
		        $("#confirm_new_password_error label").html("Confirm New Password");
		      }

		      if(errors.length == 0){
		      	document.getElementById("ifNewUserForm").submit();
		      }
		    },
		    error: function(XMLHttpRequest, textStatus, errorThrown) {
		      alert(errorThrown); 
		    }
	   	});
	}
</script>

</body>
</html>
