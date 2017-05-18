<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/jQueryUI/jquery-ui.min.css">
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<?php
function generatePassword($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function encrypt ($stringArray, $key = "Your secret salt thingie") {
 $s = strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), serialize($stringArray), MCRYPT_MODE_CBC, md5(md5($key)))), '+/=', '-_,');
 return $s;
}

function decrypt ($stringArray, $key = "Your secret salt thingie") {
 $s = unserialize(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode(strtr($stringArray, '-_,', '+/=')), MCRYPT_MODE_CBC, md5(md5($key))), "\0"));
 return $s;
}

if($the_user['user_type'] != "admin"){ header("Location: 404.php"); }
  
if(isset($_POST['addUserHidden'])){
  if ($_FILES["file"]["size"] > 5000000) {
    echo "
      <script>
        alert('Image exceeds the maximum upload size.');
        open('users.php','_self');
      </script>
    ";
  }else{
    $sy = "";
    $instructor_number = "";
    if($_POST['user_type'] == "instructor"){
      $sy = $_POST['sy'];

      $query5 = mysqli_query($conn, "select * from settings_instructor_number order by instructor_number_id desc") or die(mysqli_error($conn));
      $count5 = mysqli_num_rows($query5);

      if(empty($count5)){
        $instructor_number = $sy."-001";
        mysqli_query($conn, "insert into settings_instructor_number(instructor_number_count) value(1)");
      }else{
        $row5 = mysqli_fetch_assoc($query5);
        $instructor_number_count = $row5['instructor_number_count']+1;
        if(strlen($instructor_number_count) == 1){
          $instructor_number = $sy."-00".$instructor_number_count;
        }elseif(strlen($instructor_number_count) == 2){
          $instructor_number = $sy."-0".$instructor_number_count;
        }elseif(strlen($instructor_number_count) == 3){
          $instructor_number = $sy."-".$instructor_number_count;
        }
      }
    }
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = generatePassword();
    $last_name = mysqli_real_escape_string($conn, strtoupper($_POST['last_name']));
    $first_name = mysqli_real_escape_string($conn, strtoupper($_POST['first_name']));
    $middle_name = mysqli_real_escape_string($conn, strtoupper($_POST['middle_name']));
    $suffix_name = mysqli_real_escape_string($conn, ucfirst($_POST['suffix_name']));
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $user_type = $_POST['user_type'];
    $church = $_POST['church'];
    $storedFile="image/user_image/".basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);
    if($storedFile == "image/user_image/"){
      $storedFile = "image/default_user.png";
    }

    $key_password="password";
    $encrypted_string=openssl_encrypt($password,"AES-128-ECB",$key_password);
    mysqli_query($conn, "insert into users(user_type, instructor_number, username, password, first_name, last_name, middle_name, suffix_name, gender, birthdate, age, contact_number, email_address, church, sy, image_path) values('$user_type', '$instructor_number', '$username', '$encrypted_string', '$first_name', '$last_name', '$middle_name', '$suffix_name', '$gender', '$birthdate', '$age', '$contact_number', '$email_address', '$church', '$sy', '$storedFile')") or die(mysqli_error($conn));
    mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Add a user', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')");
    echo "
      <script>
        alert('New User Registered.');
        open('users.php', '_self');     
      </script>
    ";
  }
}

if(isset($_POST['editUserHidden'])){
  if ($_FILES["file"]["size"] > 5000000) {
    echo "
      <script>
        alert('Image exceeds the maximum upload size.');
        open('users.php','_self');
      </script>
    ";
  }else{
    $sy = "";
    if($_POST['user_type'] == "instructor"){
      $sy = $_POST['sy'];
    }
    $user_id = $_POST['user_id'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $last_name = mysqli_real_escape_string($conn, strtoupper($_POST['last_name']));
    $first_name = mysqli_real_escape_string($conn, strtoupper($_POST['first_name']));
    $middle_name = mysqli_real_escape_string($conn, strtoupper($_POST['middle_name']));
    $suffix_name = mysqli_real_escape_string($conn, $_POST['suffix_name']);
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $user_type = $_POST['user_type'];
    $church = $_POST['church'];
    $storedFile="image/user_image/".basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);
    if($storedFile == "image/user_image/"){
      $query4 = mysqli_query($conn, "select * from users where user_id='".$user_id."'");
      $row4 = mysqli_fetch_assoc($query4);
      $storedFile = $row4['image_path'];
    }
    mysqli_query($conn, "update users set user_type='$user_type', username='$username', first_name='$first_name', last_name='$last_name', middle_name='$middle_name', suffix_name='$suffix_name', gender='$gender', birthdate='$birthdate', age='$age', contact_number='$contact_number', email_address='$email_address', church='$church', sy='$sy', image_path='$storedFile' where user_id='".$user_id."'") or die(mysqli_error());
    mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Edit a user', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')");
    echo "
      <script>  
        alert('User Record Updated').
        open('users.php', '_self');
      </script>
    ";
  }
}

if(isset($_POST['deleteUserHidden'])){
  $user_id = $_POST['deleteUserHidden'];
  $query7 = mysqli_query($conn, "select * from users where user_id='$user_id'");
  $row7 = mysqli_fetch_assoc($query7);

  if($row7['user_type'] == "instructor"){
    $query8 = mysqli_query($conn, "select * from subjects where instructor='$user_id'");
    $count8 = mysqli_num_rows($query8);
    if(!empty($count8)){
      mysqli_query($conn, "update subjects set instructor='' where instructor='$user_id'");
    }
  }elseif($row7['user_type'] == "encoder"){
    $query8 = mysqli_query($conn, "select * from subjects where encoder='$user_id'");
    $count8 = mysqli_num_rows($query8);
    if(!empty($count8)){
      mysqli_query($conn, "update subjects set encoder='' where encoder='$user_id'");
    }
  }

  mysqli_query($conn, "delete from users where user_id='$user_id'") or die(mysqli_error($conn));
  mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Delete a user', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')");
  echo "
    <script>  
      alert('User Record Deleted').
      open('users.php', '_self');
    </script>
  ";
}

if(isset($_GET['reset']) && !empty($_GET['reset'])){
  $query6 = mysqli_query($conn, "select * from users where user_id='".$_GET['reset']."'");
  $row6 = mysqli_fetch_assoc($query6);
  $key_password="password";
  $encrypted_string=openssl_encrypt($row6['last_name'],"AES-128-ECB",$key_password);

  mysqli_query($conn, "update users set password='$encrypted_string', new_user='1' where user_id='".$_GET['reset']."'");
  echo "
    <script>  
      alert('User Password Updated');
      open('users.php', '_self');
    </script>
  ";
}
?>
<style>
  #ui-datepicker-div{z-index:9999 !important;}
  .ui-datepicker-month, .ui-datepicker-year{color: #333;}
  .dataTables_filter{display: none}
</style>    
<section class="content-header">
  <h1>
    Users <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addUserModal" title="Add User"><i class="fa fa-user-plus"> </i> Add User</button>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Users</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control input-lg" placeholder="Search Users" id="searchQuery">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary btn-flat btn-lg"><i class="fa fa-search"></i></button>
            </span>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12" id="showUserDiv"></div>    
  </div>

  <div class="row">
    <div class="col-md-12" id="usersList">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Users List</h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered" id="userTbl">
            <thead>
              <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email Address</th>
                <th>Church</th>
                <th>Account Type</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php
              $query2 = mysqli_query($conn, "select * from users where user_id<>'".$the_user['user_id']."'");
              while($row2 = mysqli_fetch_assoc($query2)){
                $query3 = mysqli_query($conn, "select * from church where church_id='".$row2['church']."'");
                $row3 = mysqli_fetch_assoc($query3);
                ?>
                  <tr>
                    <td><?php echo $row2['username']; ?></td>
                    <td><?php echo $row2['first_name']." ".$row2['last_name']." ".$row2['suffix_name']; ?></td>
                    <td><?php echo $row2['contact_number']; ?></td>
                    <td><?php echo $row2['email_address']; ?></td>
                    <td><?php echo $row3['church_name']; ?></td>
                    <td><?php echo $row2['user_type']; ?></td>
                    <td align="center">
                      <form method="post">
                        <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#viewUserModal" data-userid="<?php echo $row2['user_id']; ?>"><i class="fa fa-eye" data-toggle="tooltip" title="Veiw User"></i></a>
                        <input type="hidden" name="deleteUserHidden" value="<?php echo $row2['user_id']; ?>">
                        <?php  if($row2['user_type'] != "admin"){ ?>
                        <a href="users.php?reset=<?php echo $row2['user_id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Reset Password" onclick="return confirm('Are sure you want to reset the password of this user?')"><i class="fa fa-refresh"></i></a>
                        <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#editUserModal" data-userid="<?php echo $row2['user_id']; ?>"><i class="fa fa-pencil" data-toggle="tooltip" title="Edit User Account"></i></a>
                        <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete User" onclick="return confirm('Are sure you want to delete this user?')"><i class="fa fa-trash"></i></button>
                        <?php } ?>
                      </form>
                    </td>
                  </tr>
                <?php
              }
            ?>
            </tbody>
          </table>
        </div>
    </div>
  </div>

</section>

<div class="modal" tabindex="-1" role="dialog" id="addUserModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add User</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="addUserForm" enctype="multipart/form-data">
        <input type="hidden" name="addUserHidden" value="check">
        <div class="row" style="margin-top: 5%;position: relative;">
          <div class="col-md-4">
            <div class="form-group" id="username_error">
              <label>* Username</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Username" >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Image</label>
              <input type="file" name="file" id="inputFile" >
              <span class="maximum-file-size">* Maximum upload files size: 5mb</span>
            </div>
          </div>
          <div class="col-md-4" style="position: absolute;right: 0;top: -45px;text-align: center;">
            <img src="image/default_user.png" id="image_upload_preview" width="100" height="100" alt="User Image" style="border-radius: 100px">
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group" id="last_name_error">
              <label>* Last Name</label>
              <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" >
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group" id="first_name_error">
              <label>* First Name</label>
              <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" >
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group" id="middle_name_error">
              <label>* Middle Name</label>
              <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Middle Name" >
            </div>
          </div>
          <div class="col-md-3">
            <div class="frm-group">
              <label>Suffix Name</label>
              <input type="text" name="suffix_name" id="suffix_name" class="form-control" placeholder="Suffix Name" >
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>* Gender</label><br>
              <label class="radio-inline">
                <input type="radio" name="gender" value="Male" checked > Male
              </label>
              <label class="radio-inline">
                <input type="radio" name="gender" value="Female" > Female
              </label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group" id="datepicker_error">
              <label>* Birthdate</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="birthdate" class="form-control pull-right" id="datepicker" >
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Age</label>
              <input type="text" name="age" id="age" class="form-control" maxlength="3" readonly >
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Contact Number</label>
              <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Contact Number" onkeypress="return numbersonly(event)" >
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Email Address" >
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group" id="user_type_error">
              <label>* User Type</label>
              <select name="user_type" id="user_type" class="form-control" onchange="isUserType(this.value)">
                <option value="">Select</option>
                <option value="admin">Admin</option>
                <option value="instructor">Instructor</option>
                <option value="encoder">Encoder</option>
                <option value="printer">Printer</option>
              </select>
            </div>
            <div class="form-group" id="sy" style="display: none">
              <label>S.Y.</label>
              <select name="sy" class="form-control">
                <option value="10">2010</option>
                <option value="11">2011</option>
                <option value="12">2012</option>
                <option value="13">2013</option>
                <option value="14">2014</option>
                <option value="15">2015</option>
                <option value="16">2016</option>
                <option value="17">2017</option>
                <option value="18">2018</option>
              </select>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group" id="church_error">
              <label>* Church</label>
              <select name="church" id="church" class="form-control" >
                <option value="">Select</option>
                <?php
                  $query = mysqli_query($conn, "select * from church");
                  while($row = mysqli_fetch_assoc($query)){
                    ?>
                      <option value="<?php echo $row['church_id']; ?>"><?php echo $row['church_name']; ?></option>
                    <?php
                  }
                ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="addUserSubmit" onclick="addUserBtn()" class="btn btn-primary" >Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="viewUserModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View User</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="viewUserModal" value="check">
        <div id="viewUserDiv"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="editUserModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit User</h4>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="editUserHidden" value="check">
        <div id="editUserDiv"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="plugins/jquery-ui-1.12.0.custom/jquery-ui.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
<script>
  function isUserType(val){
    if(val == "instructor"){
      document.getElementById("sy").style.display = "block";
    }else{
      document.getElementById("sy").style.display = "none";
    }
  }

  $(function() {
    $('#datepicker').datepicker({
      onSelect: function(value, ui) {
          var today = new Date(), 
              dob = new Date(value), 
              age = new Date(today - dob).getFullYear() - 1970;
          
          //$('#age').text(age);
          document.getElementById("age").value = age;
      },
      maxDate: '+0d',
      yearRange: '1940:2010',
      changeMonth: true,
      changeYear: true,
      defaultDate: new Date('January 1 1940')
    });
  });

  var table = $('#userTbl').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    "scrollY": "300px",
    "scrollX": true
  });

  $('#searchQuery').on( 'keyup', function () {
    table.search( this.value ).draw();
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#image_upload_preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#inputFile").change(function () {
    readURL(this);
  });

  $('#viewUserModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var userid = button.data('userid');
    $("#viewUserDiv").load("php/ajax/viewuser.php?q=" + userid);
  });

  $('#editUserModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var userid = button.data('userid');
    $("#editUserDiv").load("php/ajax/edituser.php?q=" + userid);
  });

  function validate(input, text){
    var val = document.getElementById(input).value;
    if(val == ""){
      $('#'+input+'_error').addClass('has-error');
      $('#'+input+'_error label').html(text+' is empty.');
      return false;
    }else{
      $('#'+input+'_error').removeClass('has-error');
      $('#'+input+'_error label').html(text);
      return true;
    }
  }

  function addUserBtn(){
    var error = [];
    $.ajax({
    type: "POST",
    url: "php/ajax/checkuserid.php",
    data: 'id='+document.getElementById("username").value,
    dataType: 'json',
    success: function(msg){
      var error_id = {
        last_name: "* Last Name",
        first_name: "* First Name",
        middle_name: "* Middle Name",
        datepicker: "* Birthdate",
        user_type: "* User Type",
        church: "* Church"
      }

      for (var key in error_id) {
        let value = error_id[key];
        if(validate(key, value) == false){
          error.push("error");
        }
      }

      if(validate("username", "* Username") == false){
        error.push("error");
      }else if(msg.count >= 1){
        error.push("error");
        $("#username_error").addClass("has-error");
        $("#username_error label").html("Username is not available.");
      }else{
        $("#username_error").removeClass("has-error");
        $("#username_error label").html("Username");
      }

      if(error.length == 0){
        document.getElementById("addUserSubmit").disabled = true;
        document.getElementById("addUserForm").submit();
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown); 
    }
   });
  }
</script>
<?php include'php/footer.php'; ?>