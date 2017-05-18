<?php
  include'../db_connection.php';
  $key = mysqli_real_escape_string($conn, $_GET['q']);
  $query = mysqli_query($conn, "select * from users where user_id=".$key);
  $row = mysqli_fetch_assoc($query);
?>
<input type="hidden" name="user_type" value="<?php echo $row['user_type']; ?>">
<input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
<input type="hidden" name="image_path_hidden" value="<?php echo $row['image_path']; ?>">
<div class="row" style="margin-top: 5%;position: relative;">
  <div class="col-md-4">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo $row['username']; ?>">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Image</label>
      <input type="file" name="file" id="inputFile2" >
      <span class="maximum-file-size">* Maximum upload files size: 5mb</span>
    </div>
  </div>
  <div class="col-md-4" style="position: absolute;right: 0;top: -50px;text-align: center;">
    <img src="<?php echo $row['image_path']; ?>" id="image_upload_preview2" width="120" height="120" alt="User Image" style="border-radius: 120px">
  </div>
</div>

<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>Last Name</label>
      <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?php echo $row['last_name']; ?>">
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>First Name</label>
      <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?php echo $row['first_name']; ?>">
    </div>
  </div>
  <div class="col-md-3">
    <div class="frm-group">
      <label>Middle Name</label>
      <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $row['middle_name']; ?>">
    </div>
  </div>
  <div class="col-md-3">
    <div class="frm-group">
      <label>Suffix Name</label>
      <input type="text" name="suffix_name" id="suffix_name" class="form-control" placeholder="Suffix Name" value="<?php echo $row['suffix_name']; ?>">
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Gender</label><br>
      <label class="radio-inline">
        <input type="radio" name="gender" value="Male" <?php if($row['gender'] == "Male"){ echo "checked"; } ?> > Male
      </label>
      <label class="radio-inline">
        <input type="radio" name="gender" value="Female" <?php if($row['gender'] == "Female"){ echo "checked"; } ?> > Female
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
        <input type="text" name="birthdate" class="form-control pull-right" id="datepicker2" value="<?php echo $row['birthdate']; ?>">
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Age</label>
      <input type="text" name="age" id="age" class="form-control" placeholder="Age"  value="<?php echo $row['age']; ?>">
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Contact Number</label>
      <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Contact Number" value="<?php echo $row['contact_number']; ?>">
    </div>
  </div>
  <div class="col-md-8">
    <div class="form-group">
      <label>Email Address</label>
      <input type="text" name="email_address" id="email_address" class="form-control" placeholder="Email Address" value="<?php echo $row['email_address']; ?>">
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>User Type</label>
      <select name="user_type" id="user_type" class="form-control">
        <option value="">Select</option>
        <option value="admin" <?php if($row['user_type'] == "admin"){ echo "selected"; } ?> >Admin</option>
        <option value="instructor" <?php if($row['user_type'] == "instructor"){ echo "selected"; } ?> >Instructor</option>
        <option value="encoder" <?php if($row['user_type'] == "encoder"){ echo "selected"; } ?> >Encoder</option>
        <option value="printer" <?php if($row['user_type'] == "printer"){ echo "selected"; } ?> >Printer</option>
      </select>
    </div>
  </div>

  <?php if(empty($row['sy'])){ ?>
  <div class="col-md-8">
  <?php }else{ ?>
  <div class="col-md-4">
  <?php } ?>
    <div class="form-group">
      <label>Church</label>
      <select name="church" id="church" class="form-control">
        <option value="">Select</option>
        <?php
          $query2 = mysqli_query($conn, "select * from church");
          while($row2 = mysqli_fetch_assoc($query2)){
            ?>
              <option value="<?php echo $row2['church_id']; ?>" <?php if($row['church'] == $row2['church_id']){echo "selected";} ?> ><?php echo $row2['church_name']; ?></option>
            <?php
          }
        ?>
      </select>
    </div>
  </div>
  <?php if(!empty($row['sy'])){ ?>
  <div class="col-md-4">
    <div class="form-group">
      <label>S.Y.</label>
      <select name="sy" id="sy" class="form-control">
        <option value="10" <?php if($row['sy'] == "10"){ echo "selected"; } ?> >2010</option>
        <option value="11" <?php if($row['sy'] == "11"){ echo "selected"; } ?> >2011</option>
        <option value="12" <?php if($row['sy'] == "12"){ echo "selected"; } ?> >2012</option>
        <option value="13" <?php if($row['sy'] == "13"){ echo "selected"; } ?> >2013</option>
        <option value="14" <?php if($row['sy'] == "14"){ echo "selected"; } ?> >2014</option>
        <option value="15" <?php if($row['sy'] == "15"){ echo "selected"; } ?> >2015</option>
        <option value="16" <?php if($row['sy'] == "16"){ echo "selected"; } ?> >2016</option>
      </select>
    </div>
  </div>
  <?php } ?>
</div>

<script>
$(function() {
  $("#datepicker2").datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange : 'c-65:c+10'
  });
});

function readURL2(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#image_upload_preview2').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#inputFile2").change(function () {
  readURL2(this);
});
</script>