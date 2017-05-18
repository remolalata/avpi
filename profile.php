<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/jQueryUI/jquery-ui.min.css">
<style>
  #ui-datepicker-div{z-index:9999 !important;}
  .ui-datepicker-month, .ui-datepicker-year{color: #333;}
</style>

<?php

if(isset($_POST['editUserHidden'])){
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = $_POST['password'];
  $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
  $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
  $middle_name = mysqli_real_escape_string($conn, $_POST['middle_name']);
  $gender = $_POST['gender'];
  $birthdate = $_POST['birthdate'];
  $age = mysqli_real_escape_string($conn, $_POST['age']);
  $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
  $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
  $church = $_POST['church'];
  $storedFile="image/user_image/".basename($_FILES["file"]["name"]);
  move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);
  if($storedFile == "image/user_image/"){
    $storedFile = $the_user['image_path'];
  }
  $key_password="password";
  $encrypted_string=openssl_encrypt($password,"AES-128-ECB",$key_password);
  $decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$key_password);

  mysqli_query($conn, "update users set username='$username', password='$encrypted_string', last_name='$last_name', first_name='$first_name', middle_name='$middle_name', gender='$gender', birthdate='$birthdate', age='$age', contact_number='$contact_number', email_address='$email_address', church='$church', image_path='$storedFile' where user_id=".$_SESSION['user_id']) or die(mysqli_error());
  echo "
    <script>
      alert('Profile Updated.');
      open('profile.php','_self');
    </script>
  ";
}

$key_password="password";
//$encrypted_string=openssl_encrypt($string_to_encrypt,"AES-128-ECB",$key_password);
$decrypted_string=openssl_decrypt($the_user['password'],"AES-128-ECB",$key_password);

?>

<section class="content-header">
  <h1>
    Profile
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Profile</li>
  </ol>
</section>

<section class="content">

  <div class="box">
    <div class="box-body">
      <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="editUserHidden" value="check">
      <input type="hidden" name="image_path_hidden" value="<?php echo $the_user['image_path']; ?>">
      <div class="row" style="margin-top: 5%;position: relative;">
        <div class="col-md-4">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo $the_user['username']; ?>">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="password" class="form-control" value="<?php echo $decrypted_string; ?>">
          </div>
        </div>
        <div class="col-md-4" style="position: absolute;right: 0;top: -40px;text-align: center;">
          <img src="<?php echo $the_image_path; ?>" id="image_upload_preview" width="100" height="100" alt="User Image" style="border-radius: 100px">
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?php echo $the_user['last_name']; ?>">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?php echo $the_user['first_name']; ?>">
          </div>
        </div>
        <div class="col-md-4">
          <div class="frm-group">
            <label>Middle Name</label>
            <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $the_user['middle_name']; ?>">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Gender</label><br>
            <label class="radio-inline">
              <input type="radio" name="gender" value="Male" checked > Male
            </label>
            <label class="radio-inline">
              <input type="radio" name="gender" value="Female" > Female
            </label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Birthdate</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" name="birthdate" class="form-control pull-right" id="datepicker" value="<?php echo $the_user['birthdate']; ?>">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Age</label>
            <input type="text" name="age" id="age" class="form-control" placeholder="Age" value="<?php echo $the_user['age']; ?>">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Contact Number" value="<?php echo $the_user['contact_number']; ?>">
          </div>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <label>Email Address</label>
            <input type="text" name="email_address" id="email_address" class="form-control" placeholder="Email Address" value="<?php echo $the_user['email_address']; ?>">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label>Church</label>
            <select name="church" id="church" class="form-control">
              <option value="">Select</option>
              <?php
                $query2 = mysqli_query($conn, "select * from church");
                while($row2 = mysqli_fetch_assoc($query2)){
                  ?>
                    <option value="<?php echo $row2['church_id']; ?>" <?php if($row2['church_id'] == $the_user['church']){ echo "selected"; } ?> ><?php echo $row2['church_name']; ?></option>
                  <?php
                }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <label>Image</label>
          <input type="file" name="file" id="inputFile" >
        </div>
      </div>
    </div>
    
    <div class="box-footer text-right">
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
    
  </div>

</section>

<script src="plugins/jQueryUI/jquery-ui.min.js"></script>
<script>
  $(function() {
    $("#datepicker").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange : 'c-65:c+10'
    });
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
</script>
<?php include'php/footer.php'; ?>