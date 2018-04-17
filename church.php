<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<style>
  .pac-container {
    z-index: 1051 !important;
  }

  th, td{white-space: nowrap;}
</style>

<?php

if($the_user['user_type'] != "admin" && $the_user['user_type'] != "principal"){ header("Location: 404.php"); }

if(isset($_POST['addChurchHidden'])){
  if ($_FILES["file"]["size"] > 5000000) {
    echo "
      <script>
        alert('Image exceeds the maximum upload size.');
        open('church.php','_self');
      </script>
    ";
  }else{
    $church_acronym = strtoupper($_POST['church_acronym']);
    $church_name = $_POST['church_name'];
    $pastor = $_POST['pastor'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $address = $_POST['address'];
    $street_address = $_POST['street_address'];
    $street_number = $_POST['street_number'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip_code'];
    $year_active = date("y");
    $storedFile="image/church_image/".basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);
    if($storedFile == "image/church_image/"){
      $storedFile = "image/default_church.png";
    }

    mysqli_query($conn, "insert into church(church_acronym, church_name, pastor, address, street_number, street_address, city, state, zip_code, contact_number, email_address, year_active, image_path) values('$church_acronym', '$church_name', '$pastor', '$address', '$street_number', '$street_address', '$city', '$state', '$zip_code', '$contact_number', '$email_address', '$year_active', '$storedFile')") or die(mysqli_error($conn));
    mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Add a church', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')");
    echo "
    <script>
      alert('New Church Registered.');
      open('church.php', '_self');
    </script>
    ";
  }
}

if(isset($_POST['deleteChurchHidden'])){
  $church_id = $_POST['deleteChurchHidden'];
  mysqli_query($conn, "delete from church where church_id='$church_id'") or die(mysqli_error($conn));
  mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Delete a church', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')");
  echo "
  <script>
    alert('Church Records Deleted.');
    open('church.php', '_self');
  </script>
  ";
}

if(isset($_POST['editChurchHidden'])){
  if ($_FILES["file"]["size"] > 5000000) {
    echo "
      <script>
        alert('Image exceeds the maximum upload size.');
        open('church.php','_self');
      </script>
    ";
  }else{
    $church_id = $_POST['editChurchHidden'];
    $church_acronym = $_POST['church_acronym'];
    $church_name = $_POST['church_name'];
    $pastor = $_POST['church_pastor'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $street_number = $_POST['street_number'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip_code'];
    $storedFile="image/church_image/".basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);
    if($storedFile == "image/church_image/"){
      $query2 = mysqli_query($conn, "select * from church where church_id='$church_id'");
      $row2 = mysqli_fetch_assoc($query2);
      $storedFile = $row2['image_path'];
    }

    mysqli_query($conn, "update church set church_acronym='$church_acronym', church_name='$church_name', pastor='$pastor', address='$location', street_number='$street_number', street_address='$street_address', city='$city', state='$state', zip_code='$zip_code', contact_number='$contact_number', email_address='$email', image_path='$storedFile' where church_id='$church_id'") or die(mysqli_error($conn));
    mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Edit a church', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')");
    echo "
    <script>
      alert('Church Records Updated.');
      open('church.php', '_self');
    </script>
    ";
  }
}

?>

<section class="content-header">
  <h1>
    Church <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addChurchModal" title="Add Church"><i class="fa fa-plus"> </i> <span data-toggle="tooltip" title="Add Church">Add Church</span></a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Church</li>
  </ol>
</section>

<section class="content">

  <div class="box">

    <div class="box-body">
      <table id="churchTable" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th></th>
          <th>Name of Church</th>
          <th>Pastor</th>
          <th>Contact Number</th>
          <th>Email Address</th>
          <th>Address</th>
          <th>Enrolled Students</th>
          <th>Active Year</th>
          <th style="width: 110px"></th>
        </tr>
        </thead>
        <tbody>
          <?php
            $query = mysqli_query($conn, "select * from church");
            while($row = mysqli_fetch_assoc($query)){
              $query3 = mysqli_query($conn, "select * from students where church='".$row['church_id']."'") or die(mysqli_error($conn));
              $count3 = mysqli_num_rows($query3);
              ?>
                <tr>
                  <td><?php echo $row['church_acronym']; ?></td>
                  <td><?php echo $row['church_name']; ?></td>
                  <td><?php echo $row['pastor']; ?></td>
                  <td><?php echo $row['contact_number']; ?></td>
                  <td><?php echo $row['email_address']; ?></td>
                  <td><?php echo $row['address']; ?></td>
                  <td><?php echo $count3; ?></td>
                  <td><?php echo "20".$row['year_active']; ?></td>
                  <td align="center" style="width: 100px">
                    <form method="post">
                      <input type="hidden" name="deleteChurchHidden" value="<?php echo $row['church_id']; ?>">
                      <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#viewChurchModal" data-churchid="<?php echo $row['church_id']; ?>"><i class="fa fa-eye" data-toggle="tooltip" title="View Church"></i></a>
                      <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#editChurchModal" data-churchid="<?php echo $row['church_id']; ?>"><i class="fa fa-pencil" data-toggle="tooltip" title="Edit Church"></i></a>
                      <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete Church" onclick="return confirm('Are you sure you want to delete this church?')"><i class="fa fa-trash"></i></button>
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
</section>

<div class="modal" tabindex="-1" role="dialog" id="addChurchModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Church</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="addChurchForm" enctype="multipart/form-data">
          <input type="hidden" name="addChurchHidden" value="check">
          <div class="row" style="margin-top: 5%;position: relative;">
            <div class="col-md-4">
              <div class="form-group" id="church_acronym_error">
                <label>* Church Acronym</label>
                <input type="text" name="church_acronym" id="church_acronym" class="form-control" placeholder="Church Acronym" >
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
            <img src="image/default_church.png" id="image_upload_preview" width="100" height="100" alt="User Image" style="border-radius: 100px">
          </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="church_name_error">
                <label>* Church Name</label>
                <input type="text" name="church_name" id="church_name" class="form-control" placeholder="Church Name" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="pastor_error">
                <label>* Pastor</label>
                <input type="text" name="pastor" id="pastor" class="form-control" placeholder="Pastor" >
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact Number</label>
                <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Contact Number" onkeypress="return numbersonly(event)" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Email Address" >
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group" id="autocomplete_error">
                <label>* Location</label>
                <input type="text" name="address" id="autocomplete" onFocus="geolocate()" class="form-control" placeholder="Location" >
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Street Address</label>
                <div class="row">
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="street_number" id="street_number" placeholder="Street Number">
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="street_address" id="route" placeholder="Street Address">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>City/Municipality</label>
                <input type="text" class="form-control" name="city" placeholder="City/Municipality" id="locality">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>State/Province</label>
                <input type="text" class="form-control" name="state" id="administrative_area_level_1" placeholder="State/Province">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Zip Code</label>
                <input type="text" class="form-control" id="postal_code" name="zip_code" placeholder="Zip Code">
              </div>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addChurchBtn" onclick="addChurch()">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="viewChurchModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Church</h4>
      </div>
      <div class="modal-body">
        <div id="viewChurchDiv"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="editChurchModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Church</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="editChurchForm" enctype="multipart/form-data">
        <div id="editChurchDiv"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" form="editChurchForm">Update</button>
      </div>
    </div>
  </div>
</div>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $('#churchTable').DataTable({
    "paging": false,
    "autoWidth": false,
    "scrollY": "350px",
    "scrollCollapse": true,
    "scrollX": true
  });

  $('#viewChurchModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var churchid = button.data('churchid');
    $("#viewChurchDiv").load("php/ajax/viewchurch.php?q=" + churchid);
  });

  $('#editChurchModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var churchid = button.data('churchid');
    $("#editChurchDiv").load("php/ajax/editchurch.php?q=" + churchid);

    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete2')),
        {types: ['geocode']});
    autocomplete.addListener('place_changed', fillInAddress);
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

  function addChurch(){
    var error = [];

    var error_id = {
      church_acronym: "* Church Acronym",
      church_name: "* Church Name",
      pastor: "* Pastor",
      autocomplete: "* Location"
    }

    for (var key in error_id) {
      let value = error_id[key];
      if(validate(key, value) == false){
        error.push("error");
      }
    }

    if(error.length == 0){
      document.getElementById("addChurchBtn").disabled = true;
      document.getElementById("addChurchForm").submit();
    }
  }
</script>

<script>
  var placeSearch, autocomplete;
  var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    postal_code: 'short_name'
  };

  function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {types: ['geocode']});
    autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    }

    for (var i = 0; i < place.address_components.length; i++) {
      var addressType = place.address_components[i].types[0];
      if (componentForm[addressType]) {
        var val = place.address_components[i][componentForm[addressType]];
        document.getElementById(addressType).value = val;
      }
    }
  }

  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmeiOJoIToVoOEM7jJFMQn9rSDH_BvRlg&libraries=places&callback=initAutocomplete"
        async defer></script>
<?php include'php/footer.php'; ?>
