<?php

include'../db_connection.php';
$key = $_GET['q'];

$query = mysqli_query($conn, "select * from users where user_id='".$key."'");
$row = mysqli_fetch_assoc($query);

$key_password="password";
//$encrypted_string=openssl_encrypt($string_to_encrypt,"AES-128-ECB",$key_password);
$decrypted_string=openssl_decrypt($row['password'],"AES-128-ECB",$key_password);
?>

<div class="row" style="margin-top: 5%;position: relative;">
  <div class="col-md-4">
    <div class="form-group">
      <label>Username</label>
      <input type="text" class="form-control" placeholder="Username" value="<?php echo $row['username']; ?>" disabled >
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Password</label>
      <input type="text" class="form-control" value="<?php echo $decrypted_string; ?>" disabled >
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
      <input type="text" class="form-control" placeholder="Last Name" value="<?php echo $row['last_name']; ?>" disabled >
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>First Name</label>
      <input type="text" class="form-control" placeholder="First Name" value="<?php echo $row['first_name']; ?>" disabled >
    </div>
  </div>
  <div class="col-md-3">
    <div class="frm-group">
      <label>Middle Name</label>
      <input type="text" class="form-control" placeholder="Middle Name" value="<?php echo $row['middle_name']; ?>" disabled >
    </div>
  </div>
  <div class="col-md-3">
    <div class="frm-group">
      <label>Suffix Name</label>
      <input type="text" class="form-control" placeholder="Suffix Name" value="<?php echo $row['suffix_name']; ?>" disabled >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Gender</label><br>
      	<?php echo $row['gender']; ?>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Birthdate</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right" value="<?php echo $row['birthdate']; ?>" disabled >
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Age</label>
      <input type="text" class="form-control" placeholder="Age"  value="<?php echo $row['age']; ?>" disabled >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Contact Number</label>
      <input type="text" class="form-control" placeholder="Contact Number" value="<?php echo $row['contact_number']; ?>" disabled >
    </div>
  </div>
  <div class="col-md-8">
    <div class="form-group">
      <label>Email Address</label>
      <input type="text" class="form-control" placeholder="Email Address" value="<?php echo $row['email_address']; ?>" disabled >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>User Type</label>
      <select class="form-control" disabled >
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
      <select class="form-control" disabled >
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
      <select class="form-control" disabled >
        <option value="2010" <?php if($row['sy'] == "2010"){ echo "selected"; } ?> >2010</option>
        <option value="2011" <?php if($row['sy'] == "2011"){ echo "selected"; } ?> >2011</option>
        <option value="2012" <?php if($row['sy'] == "2012"){ echo "selected"; } ?> >2012</option>
        <option value="2013" <?php if($row['sy'] == "2013"){ echo "selected"; } ?> >2013</option>
        <option value="2014" <?php if($row['sy'] == "2014"){ echo "selected"; } ?> >2014</option>
        <option value="2015" <?php if($row['sy'] == "2015"){ echo "selected"; } ?> >2015</option>
        <option value="2016" <?php if($row['sy'] == "2016"){ echo "selected"; } ?> >2016</option>
      </select>
    </div>
  </div>
  <?php } ?>
</div>