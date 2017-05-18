<?php
include'../db_connection.php';
$key = $_GET['q'];

$query = mysqli_query($conn, "select * from church where church_id='$key'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($query);
?>
<input type="hidden" name="editChurchHidden" value="<?php echo $row['church_id']; ?>">
<div class="row" style="margin-top: 5%;position: relative;">
  <div class="col-md-4">
    <div class="form-group">
      <label>Church Acronym</label>
      <input type="text" class="form-control" name="church_acronym" placeholder="Church Acronym" value="<?php echo $row['church_acronym']; ?>"   >
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Image</label>
      <input type="file" name="file" id="inputFile2" >
      <span class="maximum-file-size">* Maximum upload files size: 5mb</span>
    </div>
  </div>
  <div class="col-md-4" style="position: absolute;right: 0;top: -45px;text-align: center;">
    <img src="<?php echo $row['image_path']; ?>" id="image_upload_preview2" width="100" height="100" alt="User Image" style="border-radius: 100px">
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Church Name</label>
      <input type="text" class="form-control" name="church_name" placeholder="Church Name" value="<?php echo $row['church_name']; ?>"  >
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Pastor</label>
      <input type="text" class="form-control" name="church_pastor" placeholder="Pastor" value="<?php echo $row['pastor']; ?>"  >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Contact Number</label>
      <input type="text" class="form-control" name="contact_number" placeholder="Contact Number" value="<?php echo $row['contact_number']; ?>"   >
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Email Address</label>
      <input type="email" class="form-control" name="email" placeholder="Email Address" value="<?php echo $row['email_address']; ?>"   >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label>Location</label>
      <input type="text" class="form-control" name="location" id="autocomplete2" placeholder="Location" onFocus="geolocate()" value="<?php echo $row['address']; ?>"  >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label>Street Address</label>
      <div class="row">
        <div class="col-md-4">
          <input type="text" class="form-control" name="street_number" id="street_number" placeholder="Street Number" value="<?php echo $row['street_number']; ?>"  >
        </div>
        <div class="col-md-8">
          <input type="text" class="form-control" name="street_address" id="route" placeholder="Street Address" value="<?php echo $row['street_address']; ?>"  >
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label>City/Municipality</label>
      <input type="text" class="form-control" name="city" id="locality" placeholder="City/Municipality" value="<?php echo $row['city']; ?>"  >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>State/Province</label>
      <input type="text" class="form-control" name="state" id="administrative_area_level_1" placeholder="State/Province" value="<?php echo $row['state']; ?>"  >
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Zip Code</label>
      <input type="text" class="form-control" name="zip_code" id="postal_code" placeholder="Zip Code" value="<?php echo $row['zip_code']; ?>"  >
    </div>
  </div>
</div>

<script>
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