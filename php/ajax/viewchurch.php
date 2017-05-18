<?php
include'../db_connection.php';
$key = $_GET['q'];

$query = mysqli_query($conn, "select * from church where church_id='$key'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($query);
?>
<div class="row" style="margin-top: 30px">
  <div class="col-md-4">
    <div class="form-group">
      <label>Church Acronym</label>
      <input type="text" class="form-control" placeholder="Church Acronym" value="<?php echo $row['church_acronym']; ?>"  readonly >
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>SY</label>
      <select name="sy" class="form-control" readonly >
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
  <div class="col-md-4 text-center">
    <img src="<?php echo $row['image_path']; ?>" id="image_upload_preview" width="100" height="100" alt="User Image" style="border-radius: 100px; position: absolute; top: -40px; right: 30%">
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Church Name</label>
      <input type="text" class="form-control" placeholder="Church Name" value="<?php echo $row['church_name']; ?>" readonly >
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Pastor</label>
      <input type="text" class="form-control" placeholder="Pastor" value="<?php echo $row['pastor']; ?>" readonly >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Contact Number</label>
      <input type="text" class="form-control" placeholder="Contact Number" value="<?php echo $row['contact_number']; ?>" readonly  >
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Email Address</label>
      <input type="email" class="form-control" placeholder="Email Address" value="<?php echo $row['email_address']; ?>" readonly  >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label>Location</label>
      <input type="text" class="form-control" placeholder="Location" value="<?php echo $row['address']; ?>" readonly >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label>Street Address</label>
      <div class="row">
        <div class="col-md-4">
          <input type="text" class="form-control" placeholder="Street Number" value="<?php echo $row['street_number']; ?>" readonly >
        </div>
        <div class="col-md-8">
          <input type="text" class="form-control" placeholder="Street Address" value="<?php echo $row['street_address']; ?>" readonly >
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label>City/Municipality</label>
      <input type="text" class="form-control" placeholder="City/Municipality" value="<?php echo $row['city']; ?>" readonly >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>State/Province</label>
      <input type="text" class="form-control" placeholder="State/Province" value="<?php echo $row['state']; ?>" readonly >
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Zip Code</label>
      <input type="text" class="form-control" placeholder="Zip Code" value="<?php echo $row['zip_code']; ?>" readonly >
    </div>
  </div>
</div>