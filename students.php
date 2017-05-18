<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/jquery-ui-1.12.0.custom/jquery-ui.min.css">
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<?php
function workflow(){
  include'php/db_connection.php';
  $query = mysqli_query($conn, "select * from subjects where instructor='' or encoder=''");
  $count = mysqli_num_rows($query);
  return 0;
}

function selected($a, $b){
  if($a == $b){
    return "selected";
  }
}

function church(){
  global $conn;
  $result = array();
  $query = mysqli_query($conn, "select * from church");
  while($row = mysqli_fetch_assoc($query)){
    $result[] = $row;
  }
  return $result;
}

function sections(){
  global $conn;
  $result = array();
  $query = mysqli_query($conn, "select * from sections");
  while($row = mysqli_fetch_assoc($query)){
    $result[] = $row;
  }
  return $result;
}

function years(){
  global $conn;
  $result = array();
  $query = mysqli_query($conn, "select * from year");
  while($row = mysqli_fetch_assoc($query)){
    $result[] = $row;
  }
  return $result;
}

function courses(){
  global $conn;
  $result = array();
  $query = mysqli_query($conn, "select * from course");
  while($row = mysqli_fetch_assoc($query)){
    $result[] = $row;
  }
  return $result;
}

if(isset($_POST['addStudentHidden'])){
  if(empty(workflow())){
    if ($_FILES["file"]["size"] > 5000000) {
      echo "
        <script>
          alert('Image exceeds the maximum upload size.');
          open('students.php','_self');
        </script>
      ";
    }else{
      $query4 = mysqli_query($conn, "select * from settings_student_number order by student_number_id desc") or die(mysqli_error($conn));
      $count4 = mysqli_num_rows($query4);

      if(empty($count4)){
        $student_number = $_POST['sy']."-0001";
        mysqli_query($conn, "insert into settings_student_number(student_number_count) value(1)") or die(mysqli_error($conn));
      }else{
        $row4 = mysqli_fetch_assoc($query4);
        $student_number_count = $row4['student_number_count']+1;
        if(strlen($student_number_count) == 1){
          $student_number = $_POST['sy']."-"."000".$student_number_count;
        }else if(strlen($student_number_count) == 2){
          $student_number = $_POST['sy']."-"."00".$student_number_count;
        }else if(strlen($student_number_count) == 3){
          $student_number = $_POST['sy']."-"."0".$student_number_count;
        }else if(strlen($student_number_count) == 4){
          $student_number = $_POST['sy']."-".$student_number_count;
        }
        mysqli_query($conn, "insert into settings_student_number(student_number_count) value($student_number_count)") or die(mysqli_error($conn));
      }

      $query9 = mysqli_query($conn, "select * from year where yearID='".$_POST['year']."'");
      $row9 = mysqli_fetch_assoc($query9);

      $last_name = mysqli_real_escape_string($conn, ucfirst($_POST['last_name']));
      $first_name = mysqli_real_escape_string($conn, ucfirst($_POST['first_name']));
      $middle_name = mysqli_real_escape_string($conn, ucfirst($_POST['middle_name']));
      $suffix_name = mysqli_real_escape_string($conn, ucfirst($_POST['suffix_name']));
      $gender = mysqli_real_escape_string($conn, $_POST['gender']);
      $birthdate = $_POST['birthdate'];
      $age = mysqli_real_escape_string($conn, $_POST['age']);
      $contact_number = $_POST['contact_number'];
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $status = mysqli_real_escape_string($conn, $_POST['status']);
      $count_marriage = $_POST['marriageCount'];
      $course = mysqli_real_escape_string($conn, $_POST['course']);
      $section = mysqli_real_escape_string($conn, $_POST['section']);
      $yearID = mysqli_real_escape_string($conn, $_POST['year']);
      $year = $row9['year_id'];
      $church = mysqli_real_escape_string($conn, $_POST['church']);
      $sy = mysqli_real_escape_string($conn, $_POST['sy']);
      $storedFile="image/students_image/".basename($_FILES["file"]["name"]);
      move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);
      if($storedFile == "image/students_image/"){
        $storedFile = "image/default_student.png";
      }

      mysqli_query($conn, "insert into students(student_number, last_name, first_name, middle_name, suffix_name, sy, gender, birthdate, age,  contact_number, email_address, church, course, year, yearID, section, status, count, image_path) values('$student_number', '$last_name', '$first_name', '$middle_name', '$suffix_name', '$sy', '$gender', '$birthdate', '$age',  '$contact_number', '$email', '$church', '$course', '$year', '$yearID', '$section', '$status', '$count_marriage', '$storedFile') ") or die(mysqli_error($conn));
      mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Add a student', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')") or die(mysqli_error($conn));
      echo "
        <script>
          alert('New Student Registered.');
          open('students.php', '_self');
        </script>
      ";
    }
  }else{
    echo "
      <script>
        alert('Assign subjects to Instructors and Encoders first.');
        open('assign_subjects.php', '_self');
      </script>
    ";
  }
}

if(isset($_POST['editStudentHidden'])){
  if ($_FILES["file"]["size"] > 5000000) {
    echo "
      <script>
        alert('Image exceeds the maximum upload size.');
        open('students.php','_self');
      </script>
    ";
  }else{
    $query10 = mysqli_query($conn, "select * from year where yearID='".$_POST['year']."'");
    $row10 = mysqli_fetch_assoc($query10);
    $student_number = $_POST['editStudentHidden'];
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($conn, $_POST['middle_name']);
    $suffix_name = mysqli_real_escape_string($conn, $_POST['suffix_name']);
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $count = $_POST['count'];
    $course = $_POST['course'];
    $section = $_POST['section'];
    $year = $row10['year_id'];
    $yearID = $_POST['year'];
    $church = $_POST['church'];
    $sy = $_POST['sy'];
    $storedFile="image/students_image/".basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);
    if($storedFile == "image/students_image/"){
      $query8 = mysqli_query($conn, "select * from students where student_number='$student_number'");
      $row8 = mysqli_fetch_assoc($query8);
      $storedFile = $row8['image_path'];
    }

    mysqli_query($conn, "update students set last_name='$last_name', first_name='$first_name', middle_name='$middle_name', suffix_name='$suffix_name', sy='$sy', gender='$gender', birthdate='$birthdate', age='$age', contact_number='$contact_number', email_address='$email', church='$church', course='$course', year='$year', yearID='$yearID', section='$section', status='$status', count='$count', image_path='$storedFile' where student_number='$student_number'") or die(mysqli_error($conn));
    mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Edit a student', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')") or die(mysqli_error($conn));
    echo "
      <script>
        alert('Student Records Updated.');
        open('students.php', '_self');
      </script>
    ";
  }
}

if(isset($_POST['deleteStudentHidden'])){
  $student_number_hidden = $_POST['deleteStudentHidden'];
  mysqli_query($conn, "update students set account_status=0 where student_number='$student_number_hidden'") or die(mysqli_error($conn));
  mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Delete a student', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')") or die(mysqli_error($conn));
  echo "
    <script>
      alert('Student Records Deleted.');
      open('students.php', '_self');
    </script>
  ";
}

if(isset($_POST['viewStudentHidden'])){
  mysqli_query($conn, "update students set student_status='Pre-Registered' where student_number='".$_POST['viewStudentHidden']."'");
  mysqli_query($conn, "delete from student_subject where sy='$school_year_start' and student_number='".$_POST['viewStudentHidden']."'");
  echo "
    <script>
      alert('Student Unenrolled.');
      open('students.php', '_self');
    </script>
  ";
}
?>

<style>
  #ui-datepicker-div{z-index:9999 !important;}
  .ui-datepicker-month, .ui-datepicker-year{color: #333;}
  .dataTables_filter{display: none}
  th, td{white-space: nowrap;}
</style>
<section class="content-header">
  <h1>
    Students <a href="#" class="btn btn-primary btn-xs notooltip" data-toggle="modal" data-target="#addStudent" title="Add Student"><i class="fa fa-user-plus"> </i> <span data-toggle="tooltip" title="Add Student">Add Student</span></a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Students</li>
  </ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				<div class="input-group">
          <input type="text" class="form-control input-lg" placeholder="Search Student" id="searchQuery" onkeyup="showStudent(this.value)">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary btn-flat btn-lg"><i class="fa fa-search"></i></button>
            </span>
        </div>
			</div>
		</div>
	</div>

  <div class="row">

    <div class="col-md-12" id="showStudentDiv"></div>

  </div>

  <div class="row" id="studentsList">

    <div class="col-md-12">
      
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Students List</h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-hover" id="studentTbl">
            <thead>
              <tr>
                <th>Student Number</th>
                <th>Name of Student</th>
                <th>Year & Section</th>
                <th>Course</th>
                <th>Church</th>
                <th>Pastor</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $query6  = mysqli_query($conn, "select * from students where year<>'graduate' and account_status=1 order by last_name");
              while($row6 = mysqli_fetch_assoc($query6)){
                $query7 = mysqli_query($conn, "select * from church where church_id='".$row6['church']."'");
                $row7 = mysqli_fetch_assoc($query7);
                ?>
                  <tr>
                    <td><?php echo $row6['student_number']; ?></td>
                    <td><?php echo $row6['last_name'].", ".$row6['first_name']." ".$row6['middle_name']." ".$row6['suffix_name']; ?></td>
                    <td><?php echo $row6['section']." - ".$row6['year']; ?></td>
                    <td><?php echo $row6['course']; ?></td>
                    <td><span style="display: none"><?php echo $row7['church_acronym']; ?></span><?php echo $row7['church_name']; ?></td>
                    <td><?php echo $row7['pastor']; ?></td>
                    <td style="width: 90px">
                      <?php if($row6['student_status'] != "Enrolled"){
                        echo "NOT ENROLLED";
                      }else{
                        echo "ENROLLED";
                      }
                      ?>
                    </td>
                    <td align="center" style="width: 100px"> 
                      <form method="post">
                        <input type="hidden" name="deleteStudentHidden" value="<?php echo $row6['student_number']; ?>">
                        <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#viewStudentModal" data-viewid="<?php echo $row6['student_number']; ?>"><i class="fa fa-eye" data-toggle="tooltip" title="View Student"></i></a>
                        <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#editStudentModal" data-viewid="<?php echo $row6['student_number']; ?>"><i class="fa fa-pencil" data-toggle="tooltip" title="Edit Student"></i></a>
                        <input type="submit" class="btn btn-danger btn-xs fa submit-icon" value="&#xf1f8;" onclick="return confirm('Are sure you want to delete this student?')" data-toggle="tooltip" title="Delete Student">
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

  </div>
  
</section>

<div class="modal" tabindex="-1" role="dialog" id="addStudent">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Student</h4>
      </div>
      <div class="modal-body">
          
        <?php if(!empty(workflow())){ ?>
        <div class="alert alert-danger alert-dismissible" style="margin-bottom: 60px">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          Assign subjects to Instructors and Encoders first.
        </div>
        <?php } ?>

        <form method="post" enctype="multipart/form-data" id="addStudentForm">
        <input type="hidden" name="addStudentHidden" value="check">
        <input type="hidden" name="marriageCount" id="marriageCount" value="1">
        <div class="row" style="margin-top: 5%;position: relative;">
          <div class="col-md-8">
            <div class="form-group">
              <label>Image</label>
              <input type="file" name="file" id="inputFile" >
              <span class="maximum-file-size">* Maximum upload files size: 5mb</span>
            </div>
          </div>
          <div class="col-md-4" style="position: absolute;right: 0;top: -50px;text-align: center;">
            <img src="image/default_student.png" id="image_upload_preview" width="100" height="100" alt="User Image" style="border-radius: 100px">
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
            <div class="form-group" id="suffix_name_error">
              <label>Suffix Name</label>
              <input type="text" name="suffix_name" id="suffix_name" class="form-control" placeholder="Suffix Name">
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
          <div class="col-md-4">
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group" id="status_error">
              <label>* Status</label>
              <select name="status" id="status" class="form-control" onchange="setCount(value);" >
                <option value="">Select Status</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
              </select>
              <div id="countMarriage">
              <label>* Count</label>
                <select name="" id="" class="form-control" onchange="countMarriage(value);">
                  <option value="">Select</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group" id="course_error">
              <label>* Course</label>
              <select name="course" id="course" class='form-control' >
                <option value="">Select Course</option>
                <?php foreach (courses() as $key => $value) { ?>

                  <option value="<?php echo $value['course_id']; ?>"><?php echo $value['course_description']; ?></option>
                  
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group" id="section_error">
              <label>* Section</label>
              <select name="section" id="section" class='form-control' >
                <option value="">Select Section</option>
                <?php foreach (sections() as $value) { ?>

                  <option value="<?php echo $value['section_id']; ?>"><?php echo $value['section_description']; ?></option>

                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group" id="year_error">
              <label>* Year</label>
              <select name="year" id="year" class='form-control' >
                <option value="">Select Year</option>
                <?php foreach (years() as $value) { ?>

                  <option value="<?php echo $value['yearID']; ?>"><?php echo $value['year_description']; ?></option>
                  
                <?php } ?>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8">
            <div class="form-group" id="church_error">
              <label>* Church</label>
              <select name="church" id="church" class="form-control" >
                <option value="">Select Church</option>
                <?php foreach (church() as $value) { ?>

                  <option value="<?php echo $value['church_id']; ?>"><?php echo $value['church_name']; ?></option>
                    
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group" id="sy_error">
              <label>* S.Y.</label>
              <select name="sy" id="sy" class="form-control" >
                <?php for ($i=11; $i <= 17; $i++) { ?>

                <option value="<?php echo $i; ?>" <?php echo selected($i, $school_year_start); ?> >20<?php echo $i; ?></option>

                <?php } ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addStudentBtn" onclick="submitForm()">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="viewStudentModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
          <form method="post" id="viewStudentForm">
            <div id="viewStudentDiv"></div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="editStudentModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Student</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="editStudentForm" enctype="multipart/form-data">
          <div id="editStudentDiv"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-danger" value="Update" form="editStudentForm">
      </div>
    </div>
  </div>
</div>

<script src="plugins/jquery-ui-1.12.0.custom/jquery-ui.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>

document.getElementById("countMarriage").style.display = "none";

function countMarriage(val){
  document.getElementById("marriageCount").value = val;
}

function setCount(val){
  if(val == "Married"){
    document.getElementById("countMarriage").style.display = "block";
  }else{
    document.getElementById("countMarriage").style.display = "none";
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

var table = $('#studentTbl').DataTable({
  "paging": false,
  "lengthChange": false,
  "searching": true,
  "ordering": true,
  "info": false,
  "autoWidth": false,
  "scrollY": "300px",
  "scrollX": true,
  "order": [[1, "asc"]]
});

$("defaultTbl").DataTable();

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

$('#viewStudentModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var viewid = button.data('viewid');
  $("#viewStudentDiv").load("php/ajax/viewstudent2.php?q=" + viewid);
});

$('#editStudentModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var viewid = button.data('viewid');
  $("#editStudentDiv").load("php/ajax/editstudent.php?q=" + viewid);
});

//validation
function validate(input, text){
  var val = document.getElementById(input).value;
  if(val == ""){
    $('#'+input+'_error').addClass('has-error');
    $('#'+input+'_error label').html(text+' is empty');
    return false;
  }else{
    $('#'+input+'_error').removeClass('has-error');
    $('#'+input+'_error label').html(text);
    return true;
  }
}

function submitForm(){
  var error = [];
  var last_name = document.getElementById("last_name").value;
  var first_name = document.getElementById("first_name").value;
  var middle_name = document.getElementById("middle_name").value;
  var suffix_name = document.getElementById("suffix_name").value;
  $.ajax({
    type: "POST",
    url: "php/ajax/checkstudentname.php",
    data: 'last_name='+last_name+'&first_name='+first_name+'&middle_name='+middle_name+'&suffix_name='+suffix_name,
    dataType: 'json',
    success: function(msg){
      var error_id = {
        last_name: "* Last Name",
        first_name: "* First Name",
        middle_name: "* Middle Name",
        datepicker: "* Birthdate",
        status: "* Status",
        course: "* Course",
        section: "* Section",
        year: "* Year",
        church: "* Church",
        sy: "* S.Y."
      }

      for (var key in error_id) {
        let value = error_id[key];
        if(validate(key, value) == false){
          error.push("error");
        }
      }

      if(last_name != "" && first_name != "" && middle_name != ""){
        if(msg.count >= 1){
          error.push("error");
          alert("Student is already enrolled!");
          $("#last_name_error, #first_name_error, #middle_name_error").addClass("has-error");
          if(document.getElementById("suffix_name").value != ""){
            $("#suffix_name_error").addClass("has-error");
          }
        }else{
          $("#last_name_error, #first_name_error, #middle_name_error, #suffix_name_error").removeClass("has-error");
        }
      }

      if(error.length == 0){
        document.getElementById("addStudentBtn").disabled = true;
        document.getElementById("addStudentForm").submit();
      }
    },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert(errorThrown); 
      }
  });
}
</script>

<?php include'php/footer.php'; ?>