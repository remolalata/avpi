<?php
include'../db_connection.php';

$key = $_GET['q'];
$query = mysqli_query($conn, "select * from students where student_number='$key'");
$row = mysqli_fetch_assoc($query);
$school_year_start = date('y');

?>
<input type="hidden" name="editStudentHidden" value="<?php echo $row['student_number']; ?>">
<div class="row" style="margin-top: 5%;position: relative;">
  <div class="col-md-8">
    <div class="form-group">
      <label>Image</label>
      <input type="file" name="file" id="inputFile2" >
      <span class="maximum-file-size">* Maximum upload files size: 5mb</span>
    </div>
  </div>
  <div class="col-md-4" style="position: absolute;right: 0;top: -50px;text-align: center;">
    <img src="<?php echo $row['image_path']; ?>" id="image_upload_preview2" width="100" height="100" alt="User Image" style="border-radius: 100px">
  </div>
</div>

<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>* Last Name</label>
      <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?php echo $row['last_name']; ?>" required >
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>* First Name</label>
      <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?php echo $row['first_name']; ?>" required >
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>* Middle Name</label>
      <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $row['middle_name']; ?>" required >
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Suffix Name</label>
      <input type="text" name="suffix_name" class="form-control" placeholder="Suffix Name" value="<?php echo $row['suffix_name']; ?>" >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>* Gender</label><br>
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
      <label>* Birthdate</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" name="birthdate" class="form-control pull-right" id="datepicker2" value="<?php echo $row['birthdate']; ?>" required >
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Age</label>
      <input type="text" name="age" id="age2" class="form-control" maxlength="3" value="<?php echo $row['age']; ?>" required readonly >
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Contact Number</label>
      <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Contact Number" value="<?php echo $row['contact_number']; ?>" onkeypress="return numbersonly(event)" >
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Email Address</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="<?php echo $row['email_address']; ?>" >
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>* Status</label>
      <select name="status" id="status" class="form-control" onchange="setCount(value);" required >
        <option value="">Select Status</option>
        <option value="Single" <?php if($row['status'] == "Single"){ echo "selected"; } ?> >Single</option>
        <option value="Married" <?php if($row['status'] == "Married"){ echo "selected"; } ?> >Married</option>
      </select>
      <div id="countMarriage2" <?php if($row['status'] == "Single"){ echo "style='display: none'"; } ?> >
        <label>* Count</label>
        <select name="count" id="" class="form-control" onchange="countMarriage2(value);">
          <option value="" <?php if($row['count'] == "0"){ echo "selected"; } ?> >Select</option>
          <option value="1" <?php if($row['count'] == "1"){ echo "selected"; } ?> >1</option>
          <option value="2" <?php if($row['count'] == "2"){ echo "selected"; } ?> >2</option>
        </select>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>* Course</label>
      <select name="course" id="course" class='form-control' required >
        <option value="">Select Course</option>
        <?php
        $query2 = mysqli_query($conn, "select * from course");
        while($row2 = mysqli_fetch_assoc($query2)){
          ?>
            <option value="<?php echo $row2['course_id']; ?>" <?php if($row['course'] == $row2['course_id']){ echo "selected"; } ?> ><?php echo $row2['course_description']; ?></option>
          <?php
        }
        ?>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>* Section</label>
      <select name="section" id="section" class='form-control' required >
        <option value="">Select Section</option>
        <?php
        $query4 = mysqli_query($conn, "select * from sections");
        while($row4 = mysqli_fetch_assoc($query4)){
          ?>
            <option value="<?php echo $row4['section_id']; ?>" <?php if($row4['section_id'] == $row['section']){echo "selected";} ?> ><?php echo $row4['section_description']; ?></option>
          <?php
        }
        ?>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>* Year</label>
      <select name="year" id="year" class='form-control' required >
        <option value="">Select Year</option>
        <?php
        $query3 = mysqli_query($conn, "select * from year");
        while($row3 = mysqli_fetch_assoc($query3)){
          ?>
            <option value="<?php echo $row3['yearID']; ?>" <?php if($row['yearID'] == $row3['yearID']){echo "selected";} ?> ><?php echo $row3['year_description']; ?></option>
          <?php
        }
        ?>
      </select>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <label>* Church</label>
    <select name="church" id="church" class="form-control" required >
      <option value="">Select Church</option>
      <?php
        $query5 = mysqli_query($conn, "select * from church order by church_acronym asc");
        while($row5 = mysqli_fetch_assoc($query5)){
          ?>
            <option value="<?php echo $row5['church_id']; ?>" <?php if($row['church'] == $row5['church_id']){echo "selected";} ?> ><?php echo $row5['church_name']; ?></option>
          <?php
        }
      ?>
    </select>
  </div>
  <div class="col-md-4">
    <label>* S.Y.</label>
    <select name="sy" id="sy" class="form-control" required >
      <?php for ($i=10; $i <= $school_year_start ; $i++) { ?>
      
      <option value="<?php echo $i; ?>" <?php if($i == $row['sy']){ echo "selected"; } ?> ><?php echo "20".$i; ?></option>

      <?php } ?>
    </select>
  </div>
</div>

<script>
  function countMarriage(val){
    document.getElementById("marriageCount2").value = val;
  }

  function setCount(val){
    if(val == "Married"){
      document.getElementById("countMarriage2").style.display = "block";
    }else{
      document.getElementById("countMarriage2").style.display = "none";
    }
  }

  $(function() {
    $('#datepicker2').datepicker({
      onSelect: function(value, ui) {
          var today = new Date(), 
              dob = new Date(value), 
              age = new Date(today - dob).getFullYear() - 1970;
          
          //$('#age').text(age);
          document.getElementById("age2").value = age;
      },
      maxDate: '+0d',
      yearRange: '1940:2010',
      changeMonth: true,
      changeYear: true,
      defaultDate: new Date('January 1 1940')
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