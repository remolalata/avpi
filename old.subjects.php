<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<style>
  th, td{white-space: nowrap;}
  #churchTable_filter.dataTables_filter{display: none}
</style>

<?php

function checkcoursesectionyear(){
  include'php/db_connection.php';
  $query = mysqli_query($conn, "select * from course");
  $query2 = mysqli_query($conn, "select * from sections");
  $query3 = mysqli_query($conn, "select * from year");
  $query4 = mysqli_query($conn, "select * from church");
  if(empty(mysqli_num_rows($query)) or empty(mysqli_num_rows($query2)) or empty(mysqli_num_rows($query3)) or empty(mysqli_num_rows($query4))){
    return 1;
  }else{
    return 0;
  }
}

function checkinstructorencoder(){
  include'php/db_connection.php';
  $query = mysqli_query($conn, "select * from users where user_type='instructor'");
  $query2 = mysqli_query($conn, "select * from users where user_type='encoder'");
  if(empty(mysqli_num_rows($query)) or empty(mysqli_num_rows($query2))){
    return 0;
  }else{
    return 1;
  }
}

if(isset($_POST['addSubjectHidden'])){
  if(!empty(checkcoursesectionyear())){
    echo "
      <script>
        alert('Add church, course, section and year to continue.');
        open('subjects.php', '_self');
      </script>
    ";
  }elseif(empty(checkinstructorencoder())){
    echo "
      <script>
        alert('Add instructors and encoders to continue.');
        open('users.php', '_self');
      </script>
    ";
  }else{

    $subject_code = mysqli_real_escape_string($conn, strtoupper($_POST['subject_code']));
    $unit = $_POST['unit'];
    $subject_description = mysqli_real_escape_string($conn, $_POST['subject_description']);
    $course = $_POST['course'][0];
    $sy = $_POST['sy'];

    $time = $_POST['start_time']."-".$_POST['end_time'];
    $start_time = date("H:i", strtotime($_POST['start_time']));
    $end_time = date("H:i", strtotime($_POST['end_time']));
    $day = $_POST['day'];

    $total      = strtotime($_POST['end_time']) - strtotime($_POST['start_time']);
    $hours      = floor($total / 60 / 60);
    $minutes    = round(($total - ($hours * 60 * 60)) / 60);

    $no_of_hours = $hours.':'.$minutes;

    $room = mysqli_real_escape_string($conn, $_POST['room']);

    if(count($_POST['course']) == 2){
      $course = "ALL";
      mysqli_query($conn, "insert into subjects(subject_code, subject_description, unit, course, sy, room, start_time, end_time, time, day, no_of_hours) values('$subject_code', '$subject_description', '$unit', '$course', '$sy', '$room', '$start_time', '$end_time', '$time', '$day', '$no_of_hours')") or die(mysqli_error($conn));
    }else{
      mysqli_query($conn, "insert into subjects(subject_code, subject_description, unit, course, sy, room, start_time, end_time, time, day, no_of_hours) values('$subject_code', '$subject_description', '$unit', '$course', '$sy', '$room', '$start_time', '$end_time', '$time', '$day', '$no_of_hours')") or die(mysqli_error($conn));
    }

    $last_subject_id = mysqli_insert_id($conn) or die(mysqli_error($conn));

    foreach ($_POST['section'] as $key => $value) {
      mysqli_query($conn, "insert into subject_sections(subject_id, section_id) values('$last_subject_id', '$value')") or die(mysqli_error($conn));
    }

    foreach ($_POST['year'] as $key => $value) {
      mysqli_query($conn, "insert into subject_years(subject_id, year_id) values('$last_subject_id', '$value')") or die(mysqli_error($conn));
    }
    
    echo "
      <script>
        alert('New Subject Registered.');
        open('subjects.php', '_self');
      </script>
    ";

  }
}

if(isset($_POST['editSubjectHidden'])){
  $subject_id = $_POST['editSubjectHidden'];
  $subject_code = mysqli_real_escape_string($conn, strtoupper($_POST['subject_code']));
  $subject_description = $_POST['subject_description'];
  $unit = $_POST['unit'];
  $sy = $_POST['sy'];
  $room = $_POST['room'];
  $day = $_POST['day'];

  $time = $_POST['start_time']."-".$_POST['end_time'];
  $start_time = date("H:i", strtotime($_POST['start_time']));
  $end_time = date("H:i", strtotime($_POST['end_time']));

  $total      = strtotime($_POST['end_time']) - strtotime($_POST['start_time']);
  $hours      = floor($total / 60 / 60);
  $minutes    = round(($total - ($hours * 60 * 60)) / 60);

  $no_of_hours = $hours.':'.$minutes;

  if(count($_POST['course']) >= 2){
    $course = "ALL";
  }else{
    $course = $_POST['course'][0];
  }

  mysqli_query($conn, "update subjects set subject_code='$subject_code', subject_description='$subject_description', unit='$unit', course='$course', sy='$sy', room='$room', start_time='$start_time', end_time='$end_time', time='$time', day='$day', no_of_hours='$no_of_hours' where subject_id='$subject_id'");

  mysqli_query($conn, "delete from subject_sections where subject_id='$subject_id'");
  mysqli_query($conn, "delete from subject_years where subject_id='$subject_id'");

  foreach ($_POST['section'] as $key => $value) {
    mysqli_query($conn, "insert into subject_sections(subject_id, section_id) values('$subject_id', '$value')");
  }

  foreach ($_POST['year'] as $key => $value) {
    mysqli_query($conn, "insert into subject_years(subject_id, year_id) values('$subject_id', '$value')");
  }

  echo "
    <script>
      alert('Subject Record Updated.');
      open('subjects.php', '_self');
    </script>
  ";
}

if(isset($_POST['deleteSubjectHidden'])){
  $subject_id = $_POST['deleteSubjectHidden'];
  mysqli_query($conn, "delete from subjects where subject_id='$subject_id'");
  mysqli_query($conn, "delete from subject_sections where subject_id='$subject_id'");
  mysqli_query($conn, "delete from subject_years where subject_id='$subject_id'");
  echo "
    <script>
      alert('Subject Record Deleted.');
      open('subjects.php', '_self');
    </script>
  ";
}

?>

<section class="content-header">
  <h1>
    Subject <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addSubjectModal" title="Add Subject"><i class="fa fa-plus" data-toggle="tooltip" title="Add Subject"> </i> Add Subject</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Subject</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-body">
      <div>
        <div class="col-md-2">
          <select name="" id="churchTableCustomSelect" class="form-control">
            <option value="">All</option>
            <?php for ($i=2011; $i <= 2017 ; $i++) { ?>
            <option value="<?php echo $i; ?>" <?php if($i == 2017){ echo "selected"; } ?> ><?php echo $i; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-2 col-md-offset-8">
          <input type="text" class="form-control" id="churchTableCustomSearch" placeholder="Search">
        </div>
      </div>
      <table id="churchTable" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th></th>
          <th>Subject Code</th>
          <th>Subject Description</th>
          <th>Unit</th>
          <th>Course</th>
          <th>Section</th>
          <th>Number of Students</th>
          <th>Year Level</th>
          <th>School Year</th>
          <th>Time</th>
          <th>Day</th>
          <th>Room</th>
        </tr>
        </thead>
        <tbody>
          <?php
            $query = mysqli_query($conn, "select * from subjects");
            while($row = mysqli_fetch_assoc($query)){
              $row5 = mysqli_fetch_assoc(mysqli_query($conn, "select * from year where year_id='".$row['year']."'"));
              ?>
                <tr>
                  <td align="center">
                    <form method="post">
                      <input type="hidden" name="deleteSubjectHidden" value="<?php echo $row['subject_id']; ?>">
                  
                      <?php //if($school_year_start == $row['sy']){ ?>
                      <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#editSubjectModal" data-subjectid="<?php echo $row['subject_id']; ?>"><i class="fa fa-pencil" data-toggle="tooltip" title="Edit Subject"></i></a>
                      <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete Subject" onclick="return confirm('Are sure you want to delete this subject?')" title="Delete Subject"><i class="fa fa-trash"></i></button>
                      <?php //} ?>
                      
                    </form>
                  </td>
                  <td><?php echo $row['subject_code']; ?></td>
                  <td><?php echo $row['subject_description']; ?></td>
                  <td><?php echo $row['unit']; ?></td>
                  <td><?php echo $row['course']; ?></td>
                  <td>
                    <?php
                      $row5_sections = "";
                      $query5 = mysqli_query($conn, "select * from subject_sections where subject_id='".$row['subject_id']."'");
                      while($row5 = mysqli_fetch_assoc($query5)){
                        $row5_sections .= $row5['section_id'].", ";
                      }
                      echo rtrim($row5_sections, ", ");
                    ?>
                  </td>
                  <td>
                    <?php
                    $query7 = mysqli_query($conn, "select * from student_subject where subject_id='".$row['subject_id']."'");
                    echo mysqli_num_rows($query7);
                    ?>
                  </td>
                  <td>
                    <?php
                      $row6_sections = "";
                      $query6 = mysqli_query($conn, "select a.*, b.* from subject_years a, year b where a.year_id=b.yearID and a.subject_id='".$row['subject_id']."'");
                      while($row6 = mysqli_fetch_assoc($query6)){
                        $row6_sections .= $row6['year_description'].", ";
                      }
                      echo rtrim($row6_sections, ", ");
                    ?>
                  </td>
                  <td><?php echo "20".$row['sy']; ?></td>
                  <td><?php echo $row['time']; ?></td>
                  <td><?php echo $row['day']; ?></td>
                  <td><?php echo $row['room']; ?></td>
                </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<div class="modal" tabindex="-1" role="dialog" id="addSubjectModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Subject</h4>
      </div>
      <div class="modal-body">
        <?php if(!empty(checkcoursesectionyear())){ ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          Church, Course, Sections and Year is not set. Add church, course, section and year to continue.
        </div>
        <?php } ?>

        <?php if(empty(checkinstructorencoder())){ ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          Instructors and Encoders are not set. Add instructors and encoders first to continue.
        </div>
        <?php } ?>

        <form method="post" id="addSubjectForm">
          <input type="hidden" name="addSubjectHidden" value="check">
          <div class="row">
            <div class="col-md-6">
            <div class="form-group" id="subject_code_error">
              <label>Subject Code</label>
              <input type="text" name="subject_code" id="subject_code" class="form-control" placeholder="Subject Code" >
            </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="subject_unit_error">
                <label>Subject Unit</label>
                <select name="unit" id="unit" class="form-control" >
                  <option value="">Select</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group" id="subject_description_error">
                <label>Subject Description</label>
                <input type="text" name="subject_description" id="subject_description" class="form-control" placeholder="Subject Description" >
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="section_error">
                <label>Section</label>
                <select name="section[]" id="section" class="form-control select2" multiple="multiple" data-placeholder="Select Section" style="width: 100%">
                  <option value="">Select</option>
                  <?php
                    $query2 = mysqli_query($conn, "select * from sections");
                    $count2 = mysqli_num_rows($query2);
                    while($row2=mysqli_fetch_assoc($query2)){
                      ?>
                        <option value="<?php echo $row2['section_id']; ?>"><?php echo $row2['section_description']; ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="course_error">
                <label>Course</label>
                <select name="course[]" id="course" class="form-control select2" multiple="multiple" data-placeholder="Select Course" style="width: 100%">
                  <?php
                    $query3 = mysqli_query($conn, "select * from course");
                    while($row3 = mysqli_fetch_assoc($query3)){
                      ?>
                        <option value="<?php echo $row3['course_id']; ?>"><?php echo $row3['course_description']; ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="year_error">
                <label>Year</label>
                <select name="year[]" id="year" class="form-control select2" multiple="multiple" data-placeholder="Select Year" style="width: 100%">
                  <option value="">Select</option>
                  <?php
                    $query4 = mysqli_query($conn, "select * from year");
                    while($row4 = mysqli_fetch_assoc($query4)){
                      ?>
                        <option value="<?php echo $row4['yearID']; ?>"><?php echo $row4['year_description']; ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="sy_error">
                <label>School Year</label>
                <select name="sy" id="sy" class="form-control" >
                  <option value="11" selected >2011</option>
                  <option value="12">2012</option>
                  <option value="13">2013</option>
                  <option value="14" >2014</option>
                  <option value="15">2015</option>
                  <option value="16">2016</option>
                  <option value="17">2017</option>
                  <option value="18">2018</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="start_time_error">
                <label>Start Time</label>
                <select name="start_time" id="start_time" class="form-control select2" style="width: 100%" >
                  <?php
                    $start_t = array("8:00 AM", "8:30 AM", "9:00 AM", "9:30 AM", "10:00 AM", "10:30 AM", "11:00 AM", "12:00 PM", "12:30 PM", "1:00 PM", "1:30 PM", "2:00 PM", "2:30 PM", "3:00 PM", "3:30 PM", "4:00 PM", "4:30 PM", "5:00 PM", "5:30 PM", "6:00 PM");
                    for ($i=0; $i < count($start_t); $i++) { 
                      echo "<option>".$start_t[$i]."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="end_time_error">
                <label>End Time</label>
                <select name="end_time" id="end_time" class="form-control select2" style="width: 100%" >
                  <?php
                    $start_t = array("9:00 AM", "9:30 AM", "10:00 AM", "10:30 AM", "11:00 AM", "12:00 PM", "12:30 PM", "1:00 PM", "1:30 PM", "2:00 PM", "2:30 PM", "3:00 PM", "3:30 PM", "4:00 PM", "4:30 PM", "5:00 PM", "5:30 PM", "6:00 PM");
                    for ($i=0; $i < count($start_t); $i++) { 
                      echo "<option>".$start_t[$i]."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="day_error">
                <label>Day</label>
                <select name="day" id="day" class="form-control" >
                  <option value="">Select</option>
                  <option value="MON-TH">MON-TH</option>
                  <option value="TUE-FRI">TUE-FRI</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="room_error">
                <label>Room</label>
                <input type="text" name="room" id="room" class="form-control" placeholder="Room" >
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="addSubjectBtn" onclick="addSubject()" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="editSubjectModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Subject</h4>
      </div>
      <div class="modal-body">
        <form method="post" >
        <div id="editSubjectDiv">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="addSubjectBtn" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(".select2").select2();

  var table = $('#churchTable').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    "scrollY": "350px",
    "scrollX": true,
  });

  $('#churchTableCustomSearch').on( 'keyup', function () {
    table.search( this.value ).draw();
  } );

  $('#churchTableCustomSelect').change(function () {
    table
      .columns( 6 )
      .search( this.value )
      .draw();
  } );

  window.onload = function(){
    val = "2014";
    table
      .columns( 7 )
      .search( val )
      .draw();
  };

  function checkSubject(){
    var sy2 = document.getElementById("sy").value;
    var val = document.getElementById("subject_code").value;
    $.ajax({
    type: "POST",
    url: "php/ajax/checksubject.php",
    data: 'id='+val+'&sy='+sy2,
    dataType: 'json',
    success: function(msg){
      if(msg.count >= 1){
        $("#subject_code_error").addClass("has-error");
        $("#subject_code_error label").html("Subject Code already exist.");
      }else{
        $("#subject_code_error").removeClass("has-error");
        $("#subject_code_error label").html("Subject Code");
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown); 
    }
   });
  }

  $('#editSubjectModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var subjectid = button.data('subjectid');
    $("#editSubjectDiv").load("php/ajax/editsubject.php?q=" + subjectid);
  });

  function addSubject(){
    var error = [];
    var start_time = document.getElementById("start_time").value;
    var end_time = document.getElementById("end_time").value;
    var sections =  $("#section").val();
    $.ajax({
    type: "POST",
    url: "php/ajax/checkschedule.php",
    data: 'start_time='+start_time+'&end_time='+end_time+'&sections='+sections,
    dataType: 'json',
    success: function(msg){
      if(document.getElementById("subject_code").value == ""){
        error.push("error");
        $("#subject_code_error").addClass("has-error");
        $("#subject_code_error label").html("Subject Code is empty");
      }else{
        checkSubject();
        $("#subject_code_error").removeClass("has-error");
        $("#subject_code_error label").html("Subject Code");
      }

      if(document.getElementById("unit").value == ""){
        error.push("error");
        $("#subject_unit_error").addClass("has-error");
        $("#subject_unit_error label").html("Unit is empty");
      }else{
        $("#subject_unit_error").removeClass("has-error");
        $("#subject_unit_error label").html("Subject Unit");
      }

      if(document.getElementById("subject_description").value == ""){
        error.push("error");
        $("#subject_description_error").addClass("has-error");
        $("#subject_description_error label").html("Subject Description is empty");
      }else{
        $("#subject_description_error").removeClass("has-error");
        $("#subject_description_error label").html("Subject Description");
      }

      if(document.getElementById("section").value == ""){
        error.push("error");
        $("#section_error").addClass("has-error");
        $("#section_error label").html("Section is empty");
      }else{
        $("#section_error").removeClass("has-error");
        $("#section_error label").html("Section");
      }

      if(document.getElementById("course").value == ""){
        error.push("error");
        $("#course_error").addClass("has-error");
        $("#course_error label").html("Course is empty");
      }else{
        $("#course_error").removeClass("has-error");
        $("#course_error label").html("Course");
      }

      if(document.getElementById("year").value == ""){
        error.push("error");
        $("#year_error").addClass("has-error");
        $("#year_error label").html("Year is empty");
      }else{
        $("#year_error").removeClass("has-error");
        $("#year_error label").html("Year");
      }

      if(document.getElementById("sy").value == ""){
        error.push("error");
        $("#sy_error").addClass("has-error");
        $("#sy_error label").html("School Year is empty");
      }else{
        $("#sy_error").removeClass("has-error");
        $("#sy_error label").html("School Year");
      }

      if(document.getElementById("day").value == ""){
        error.push("error");
        $("#day_error").addClass("has-error");
        $("#day_error label").html("Day is empty");
      }else{
        $("#day_error").removeClass("has-error");
        $("#day_error label").html("Day");
      }

      if(error.length == 0){
        document.getElementById("addSubjectBtn").disabled = true;
        document.getElementById("addSubjectForm").submit();
      }
      
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown); 
    }
   });
  }
</script>
<?php include'php/footer.php'; ?>