<?php
include'../db_connection.php';

$key = $_GET['q'];
$query = mysqli_query($conn, "select * from subjects where subject_id='$key'");
$row = mysqli_fetch_assoc($query);

?>
<input type="hidden" name="editSubjectHidden" value="<?php echo $row['subject_id']; ?>">
<div class="row">
<div class="col-md-6">
<div class="form-group" id="subject_code_error">
  <label>Subject Code</label>
  <input type="text" name="subject_code" id="subject_code" class="form-control" placeholder="Subject Code" value="<?php echo $row['subject_code']; ?>" required >
</div>
</div>
<div class="col-md-6">
  <label>Subject Unit</label>
  <select name="unit" id="unit" class="form-control" required >
    <option value="">Select</option>
    <option value="2" <?php if($row['unit'] == "2"){ echo "selected"; } ?> >2</option>
    <option value="3" <?php if($row['unit'] == "3"){ echo "selected"; } ?> >3</option>
  </select>
</div>
</div>

<div class="row">
<div class="col-md-12">
  <div class="form-group">
    <label>Subject Description</label>
    <input type="text" name="subject_description" id="subject_description" class="form-control" placeholder="Subject Description" value="<?php echo $row['subject_description']; ?>" required >
  </div>
</div>
</div>

<div class="row">
<div class="col-md-6">
  <div class="form-group">
    <label>Section</label>
    <select name="section[]" id="section" class="form-control select2" multiple="multiple" data-placeholder="Select Section" required >
      <?php
        $query2 = mysqli_query($conn, "select * from sections");
        while($row2=mysqli_fetch_assoc($query2)){
          $query5 = mysqli_query($conn, "select * from subject_sections where subject_id='$key' and section_id='".$row2['section_id']."'");
          ?>
            <option value="<?php echo $row2['section_id']; ?>" <?php if(!empty(mysqli_num_rows($query5))){echo "selected";} ?> ><?php echo $row2['section_description']; ?></option>
          <?php
        }
      ?>
    </select>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Course</label>
    <select name="course[]" class="form-control select2" multiple="multiple" data-placeholder="Select Course" required >
      <?php
        $query3 = mysqli_query($conn, "select * from course");
        while($row3 = mysqli_fetch_assoc($query3)){
          ?>
            <option value="<?php echo $row3['course_id']; ?>"
              <?php
                if($row['course'] == "ALL"){
                  echo "selected";
                }else{
                  if($row['course'] == $row3['course_id']){
                    echo "selected";
                  }
                }
              ?>
            ><?php echo $row3['course_description']; ?></option>
          <?php
        }
      ?>
    </select>
  </div>
</div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Start Time</label>
      <select name="start_time" id="start_time" class="form-control select2" style="width: 100%" >
        <?php
          $start_t = array("8:00 AM", "8:30 AM", "9:00 AM", "9:30 AM", "10:00 AM", "10:30 AM", "11:00 AM", "12:00 PM", "12:30 PM", "1:00 PM", "1:30 PM", "2:00 PM", "2:30 PM", "3:00 PM", "3:30 PM", "4:00 PM", "4:30 PM", "5:00 PM", "5:30 PM", "6:00 PM");
          for ($i=0; $i < count($start_t); $i++) { ?>

            <option <?php if($row['start_time'] == date("H:i", strtotime($start_t[$i]))){ echo "selected"; } ?> ><?php echo $start_t[$i]; ?></option>

        <?php } ?>
      </select>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>End Time</label>
      <select name="end_time" id="end_time" class="form-control select2" style="width: 100%" >
        <?php
          $start_t = array("9:00 AM", "9:30 AM", "10:00 AM", "10:30 AM", "11:00 AM", "12:00 PM", "12:30 PM", "1:00 PM", "1:30 PM", "2:00 PM", "2:30 PM", "3:00 PM", "3:30 PM", "4:00 PM", "4:30 PM", "5:00 PM", "5:30 PM", "6:00 PM");
          for ($i=0; $i < count($start_t); $i++) { ?>

            <option <?php if($row['end_time'] == date("H:i", strtotime($start_t[$i]))){ echo "selected"; } ?> ><?php echo $start_t[$i]; ?></option>;

        <?php } ?>
      </select>
    </div>
  </div>
</div>

<div class="row">
<div class="col-md-6">
  <div class="form-group">
    <label>Year</label>
    <select name="year[]" class="form-control select2" multiple="multiple" data-placeholder="Select Year" required >
      <?php
        $query4 = mysqli_query($conn, "select * from year");
        while($row4 = mysqli_fetch_assoc($query4)){
          $query6 = mysqli_query($conn, "select * from subject_years where subject_id='$key' and year_id='".$row4['yearID']."'");
          ?>
            <option value="<?php echo $row4['yearID']; ?>" <?php if(!empty(mysqli_num_rows($query6))){echo "selected";} ?> ><?php echo $row4['year_description']; ?></option>
          <?php
        }
      ?>
    </select>
  </div>
</div>
<div class="col-md-6">
  <label>School Year</label>
  <select name="sy" class="form-control" required >
    <option value="">Select</option>
    <?php for ($i=11; $i <= 18 ; $i++) { ?>
      
      <option value="<?php echo $i; ?>" <?php if($row['sy'] == $i){ echo "selected"; } ?> >20<?php echo $i; ?></option>

    <?php } ?>
  </select>
</div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Day</label>
      <select name="day" class="form-control" >
        <option value="">Select</option>
        <option value="MON-TH" <?php if($row['day'] == "MON-TH"){echo "selected";} ?> >MON-TH</option>
        <option value="TUE-FRI" <?php if($row['day'] == "TUE-FRI"){echo "selected";} ?> >TUE-FRI</option>
      </select>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" id="room_error">
      <label>Room</label>
      <input type="text" name="room" class="form-control" placeholder="Room" value="<?php echo $row['room']; ?>">
    </div>
  </div>
</div>

<script>
  $(".select2").select2({
    tags: true
  });
</script>

