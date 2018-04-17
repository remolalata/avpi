<?php include'php/header.php'; ?>

<?php if($the_user['user_type'] != "admin" && $the_user['user_type'] != "encoder" && $the_user['user_type'] != "instructor" && $the_user['user_type'] != "principal"){ header('location: index.php'); } ?>

<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css">

<style>
  tr, td{white-space: nowrap;}
  #gradeTbl input{width: 50px}
  td{text-align: center}
  td input{text-align: right}
  input[readonly]{background-color: #eee; border: solid 1px #aaa;}
  .table-striped>tbody>tr:nth-of-type(odd) { background-color: #eee; }
  #subjectListTbl th, #subjectListTbl td{text-align: left; !important}
</style>

<?php

function getUser($user_id){
  include'php/db_connection.php';
  $query = mysqli_query($conn, "select * from users where user_id='$user_id'");
  $row = mysqli_fetch_assoc($query);
  return $row['first_name']." ".$row['last_name'];
}

function getStudent($student_number){
  include'php/db_connection.php';
  $query = mysqli_query($conn, "select * from students where student_number='$student_number'");
  $row = mysqli_fetch_assoc($query);
  return $row;
}

function getSections($subject_id){
  include'php/db_connection.php';
  $sections = "";
  $query = mysqli_query($conn, "select * from subject_sections where subject_id='$subject_id'");
  while($row = mysqli_fetch_assoc($query)){
    $sections .= $row['section_id'].", ";
  }
  return rtrim($sections, ", ");
}

function subjectInfo($subject_id){
  include'php/db_connection.php';
  $query = mysqli_query($conn, "select * from subjects where subject_id='$subject_id'");
  $row = mysqli_fetch_assoc($query);
  return $row;
}

function grade($subject_id, $student_number, $year){
  include'php/db_connection.php';
  global $school_year_start;
  $query = mysqli_query($conn, "select * from grade where sy='$school_year_start' and subject_id='$subject_id' and student_number='$student_number' ") or die('haha: '.mysqli_error($conn));
  $row = mysqli_fetch_assoc($query);
  return $row;
}

function hps($subject_id){
  include'php/db_connection.php';
  global $school_year_start;
  $query = mysqli_query($conn, "select * from grade_hps where sy='$school_year_start' and subject_id='$subject_id'");
  $row = mysqli_fetch_assoc($query);
  return $row;
}

function grade2($grade_id){
  include'php/db_connection.php';
  global $school_year_start;
  $query = mysqli_query($conn, "select * from grade where grade_id='$grade_id' and sy='$school_year_start'");
  $row = mysqli_fetch_assoc($query);
  return $row;
}

//checking finalize grades
function h($subject_id){
  include'php/db_connection.php';
  $query = mysqli_query($conn, "select * from grade where subject_id='$subject_id'");
  $row = mysqli_fetch_assoc($query);
  if($row['status'] == "1"){
    return "readonly";
  }else{
    return false;
  }
}

function encoderdcheck($subject_id, $day){
  include'php/db_connection.php';
  $query = mysqli_query($conn, "select * from grade where subject_id='$subject_id' and $day<>0 ") or die(mysqli_error($conn));
  if(empty(mysqli_num_rows($query))){
    return "readonly";
  }else{
    return false;
  }
}

function workflow(){
  include'php/db_connection.php';
  global $school_year_start;
  $query = mysqli_query($conn, "select * from students where sy='$school_year_start' and student_status='Enrolled'");
  return mysqli_num_rows($query);
}

if(isset($_POST['inputGrade'])){
  $subject_id = $_GET['id'];

  $attendance1_hps = $_POST['attendance1_hps'];
  $attendance2_hps = $_POST['attendance2_hps'];
  $attendance3_hps = $_POST['attendance3_hps'];
  $attendance4_hps = $_POST['attendance4_hps'];
  $t_attendance_hps = $attendance1_hps+$attendance2_hps+$attendance3_hps+$attendance4_hps;
  $p_attendance_hps = round(((($t_attendance_hps/$t_attendance_hps*40)+60)*0.05), 2);
  $quiz1_hps = $_POST['quiz1_hps'];
  $quiz2_hps = $_POST['quiz2_hps'];
  $t_quiz_hps = $quiz1_hps+$quiz2_hps;
  $p_quiz_hps = round(((($t_quiz_hps/$t_quiz_hps*40)+60)*0.25), 2);
  $recitation1_hps = $_POST['recitation1_hps'];
  $recitation2_hps = $_POST['recitation2_hps'];
  $recitation3_hps = $_POST['recitation3_hps'];
  $recitation4_hps = $_POST['recitation4_hps'];
  $t_recitation_hps = $recitation1_hps+$recitation2_hps+$recitation3_hps+$recitation4_hps;
  $p_recitation_hps = round(((($t_recitation_hps/$t_recitation_hps*40)+60)*0.15), 2);
  $proj_assign_hps = $_POST['proj_assign_hps'];
  $t_proj_assign_hps = $proj_assign_hps;
  $p_proj_assign_hps = round(((($t_proj_assign_hps/$t_proj_assign_hps*40)+60)*0.15), 2);
  $exam_hps = $_POST['exam_hps'];
  $t_exam_hps = $exam_hps;
  $p_exam_hps = round(((($t_exam_hps/$t_exam_hps*40)+60)*0.40), 2);
  $equivalent_hps = round($p_attendance_hps+$p_quiz_hps+$p_recitation_hps+$p_proj_assign_hps+$p_exam_hps, 2);

  $query7 = mysqli_query($conn, "select * from grade_hps where sy='$school_year_start' and subject_id='$subject_id'");
  $count7 = mysqli_num_rows($query7);

  if(empty($count7)){
    mysqli_query($conn, "insert into grade_hps(sy, subject_id, attendance1_hps, attendance2_hps, attendance3_hps, attendance4_hps, t_attendance_hps, p_attendance_hps, quiz1_hps, quiz2_hps, t_quiz_hps, p_quiz_hps, recitation1_hps, recitation2_hps, recitation3_hps, recitation4_hps, t_recitation_hps, p_recitation_hps, proj_assign_hps, t_proj_assign_hps, p_proj_assign_hps, exam_hps, t_exam_hps, p_exam_hps, equivalent_hps) values('$school_year_start', '$subject_id', '$attendance1_hps', '$attendance2_hps', '$attendance3_hps', '$attendance4_hps', '$t_attendance_hps', '$p_attendance_hps', '$quiz1_hps', '$quiz2_hps', '$t_quiz_hps', '$p_quiz_hps', '$recitation1_hps', '$recitation2_hps', '$recitation3_hps', '$recitation4_hps', '$t_recitation_hps', '$p_recitation_hps', '$proj_assign_hps', '$t_proj_assign_hps', '$p_proj_assign_hps', '$exam_hps', '$t_exam_hps', '$p_exam_hps', '$equivalent_hps')") or die(mysqli_error($conn));
  }else{
    mysqli_query($conn, "update grade_hps set attendance1_hps='$attendance1_hps', attendance2_hps='$attendance2_hps', attendance3_hps='$attendance3_hps', attendance4_hps='$attendance4_hps', t_attendance_hps='$t_attendance_hps', p_attendance_hps='$p_attendance_hps', quiz1_hps='$quiz1_hps', quiz2_hps='$quiz2_hps', t_quiz_hps='$t_quiz_hps', p_quiz_hps='$p_quiz_hps', recitation1_hps='$recitation1_hps', recitation2_hps='$recitation2_hps', recitation3_hps='$recitation3_hps', recitation4_hps='$recitation4_hps', t_recitation_hps='$t_recitation_hps', p_recitation_hps='$p_recitation_hps', proj_assign_hps='$proj_assign_hps', t_proj_assign_hps='$t_proj_assign_hps', p_proj_assign_hps='$p_proj_assign_hps', exam_hps='$exam_hps', t_exam_hps='$t_exam_hps', p_exam_hps='$p_exam_hps', equivalent_hps='$equivalent_hps' where sy='$school_year_start' and subject_id='$subject_id' ") or die(mysqli_error($conn));
  }

  foreach ($_POST['student'] as $key => $value) {
    $year = $_POST[$value.'_year'];
    $attendance1 = $_POST[$value.'_attendance1'];
    $attendance2 = $_POST[$value.'_attendance2'];
    $attendance3 = $_POST[$value.'_attendance3'];
    $attendance4 = $_POST[$value.'_attendance4'];
    $t_attendance = $attendance1+$attendance2+$attendance3+$attendance4;
    $p_attendance = round(((($t_attendance/$t_attendance_hps*40)+60)*0.05), 2);
    $quiz1 = $_POST[$value.'_quiz1'];
    $quiz2 = $_POST[$value.'_quiz2'];
    $t_quiz = $quiz1+$quiz2;
    $p_quiz = round(((($t_quiz/$t_quiz_hps*40)+60)*0.25), 2);
    $recitation1 = $_POST[$value.'_recitation1'];
    $recitation2 = $_POST[$value.'_recitation2'];
    $recitation3 = $_POST[$value.'_recitation3'];
    $recitation4 = $_POST[$value.'_recitation4'];
    $t_recitation = $recitation1+$recitation2+$recitation3+$recitation4;
    $p_recitation = round(((($t_recitation/$t_recitation_hps*40)+60)*0.15), 2);
    $proj_assign = $_POST[$value.'_proj_assign'];
    $t_proj_assign = $_POST[$value.'_proj_assign'];
    $p_proj_assign = round(((($t_proj_assign/$t_proj_assign_hps*40)+60)*0.15), 2);
    $exam = $_POST[$value.'_exam'];
    $t_exam = $_POST[$value.'_exam'];
    $p_exam = round(((($t_exam/$t_exam_hps*40)+60)*0.40), 2);
    $equivalent_status = $_POST[$value.'_equivalent_status'];
    if($equivalent_status == 1){
      $equivalent = $_POST[$value.'_equivalent_value'];
    }else{
      $equivalent = round($p_attendance+$p_quiz+$p_recitation+$p_proj_assign+$p_exam, 2);
    }

    if($equivalent >= 80){
      $remark = "Passed";
    }else{
      $remark = "Failed";
    }

    $query3 = mysqli_query($conn, "select * from grade where sy='$school_year_start' and subject_id='$subject_id' and student_number='$value' and year='$year'");
    $count3 = mysqli_num_rows($query3);
    if(empty($count3)){
      mysqli_query($conn, "insert into grade(sy, subject_id, student_number, year, attendance1, attendance2, attendance3, attendance4, t_attendance, p_attendance, quiz1, quiz2, t_quiz, p_quiz, recitation1, recitation2, recitation3, recitation4, t_recitation, p_recitation, proj_assign, t_proj_assign, p_proj_assign, exam, t_exam, p_exam, equivalent, remark) values('$school_year_start', '$subject_id', '$value', '$year', '$attendance1', '$attendance2', '$attendance3', '$attendance4', '$t_attendance', '$p_attendance', '$quiz1', '$quiz2', '$t_quiz', '$p_quiz', '$recitation1', '$recitation2', '$recitation3', '$recitation4', '$t_recitation', '$p_recitation', '$proj_assign', '$t_proj_assign', '$p_proj_assign', '$exam', '$t_exam', '$p_exam', '$equivalent', '$remark')") or die(mysqli_error($conn));
    }else{
      mysqli_query($conn, "update grade set attendance1='$attendance1', attendance2='$attendance2', attendance3='$attendance3', attendance4='$attendance4', t_attendance='$t_attendance', p_attendance='$p_attendance', quiz1='$quiz1', quiz2='$quiz2', t_quiz='$t_quiz', p_quiz='$p_quiz', recitation1='$recitation1', recitation2='$recitation2', recitation3='$recitation3', recitation4='$recitation4', t_recitation='$t_recitation', p_recitation='$p_recitation', proj_assign='$proj_assign', t_proj_assign='$t_proj_assign', p_proj_assign='$p_proj_assign', exam='$exam', t_exam='$t_exam', p_exam='$p_exam', equivalent='$equivalent', remark='$remark' where sy='$school_year_start' and subject_id='$subject_id' and student_number='$value' and year='$year' ") or die(mysqli_error($conn));
    }

    header("location: grade.php?id=".$subject_id);
  }
}

if(isset($_POST['finalizeGradeHidden'])){
  $subject_id = $_GET['r'];
  mysqli_query($conn, "update grade set status='1' where sy='$school_year_start' and subject_id='$subject_id'") or die(mysqli_error($conn));
  foreach ($_POST['student'] as $key => $value) {
    mysqli_query($conn, "update student_subject set if_subject_finalized='1' where subject_id='$subject_id' and sy='$school_year_start' and student_number='$value'") or die(mysqli_error($conn));
  }

  // foreach ($_POST['student'] as $key => $value) {
  //   $remark = $_POST[$value.'_remark'];
  //   if($remark == "Passed"){
  //     if(getStudent($value)['yearID'] == "11"){
  //       mysqli_query($conn, "update students set year='Graduate', student_status='Pre-Registered', date_enrolled='' where student_number='$value'") or die(mysqli_error($conn));
  //     }else{

  //       $query8 = mysqli_query($conn, "select * from year where yearID='".getStudent($value)['yearID']."'");
  //       $row8 = mysqli_fetch_assoc($query8);
  //       if($row8['yearID'] == '2'){
  //         $yearID = '3';
  //         $year = '2';
  //       }else if($row8['yearID'] == '3'){
  //         $yearID = '4';
  //         $year = '3';
  //       }else if($row8['yearID'] == '4'){
  //         $yearID = '5';
  //         $year = '4';
  //       }else if($row8['yearID'] == '5'){
  //         $yearID = '10';
  //         $year = '1';
  //       }else if($row8['yearID'] == '6'){
  //         $yearID = '7';
  //         $year = '2';
  //       }else if($row8['yearID'] == '7'){
  //         $yearID ='8';
  //         $year = '3';
  //       }else if($row8['yearID'] == '8'){
  //         $yearID = '9';
  //         $year = '4';
  //       }else if($row8['yearID'] == '9'){
  //         $yearID = '10';
  //         $year = '1';
  //       }else if($row8['yearID'] == '10'){
  //         $yearID = '11';
  //         $year = '2';
  //       }

  //       if(!empty($yearID) and !empty($year)){
  //         mysqli_query($conn, "update students set year='$year', yearID='$yearID', student_status='Pre-Registered', date_enrolled='' where student_number='$value'") or die(mysqli_error($conn));
  //       }else{
  //         die();
  //       }
  //     }

  //   }else{
  //     mysqli_query($conn, "update students set student_status='Pre-Registered', date_enrolled='' where student_number='$value'") or die(mysqli_error($conn));
  //   }
  // }
  mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Finalized grade', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')") or die(mysqli_error($conn));
  header("location: grade.php?id=".$subject_id);
}

if(isset($_POST['editFinalGradeHidden'])){
  $editFinalGradeHidden = $_POST['editFinalGradeHidden'];
  $editFinalGradeOption = $_POST['editFinalGradeOption'];
  $year = $_POST['editFinalGradeYearHidden'];
  $subject_id = $_GET['id'];
  $student_number = $_POST['editFinalGradeStudentNumberHidden'];

  if($editFinalGradeOption == 1){
    $editFinalGradeValue = $_POST['editFinalGradeValue'];
    if($editFinalGradeValue >= 80){
      $remark = "Passed";
    }else{
      $remark = "Failed";
    }

    if(empty($editFinalGradeHidden)){
      mysqli_query($conn, "insert into grade(sy, subject_id, student_number, year, equivalent, equivalent_status, remark) values('$school_year_start', '$subject_id', '$student_number', '$year', '$editFinalGradeValue', '1', '$remark')") or die(mysqli_error($conn));
    }else{
      mysqli_query($conn, "update grade set equivalent='$editFinalGradeValue', equivalent_status='1', remark='$remark' where grade_id='$editFinalGradeHidden'");
    }

  }else{
    $g = grade2($editFinalGradeHidden);
    $editFinalGradeValue = round($g['p_attendance']+$g['p_quiz']+$g['p_recitation']+$g['p_proj_assign']+$g['p_exam'], 2);
    if($editFinalGradeValue >= 80){
      $remark = "Passed";
    }else{
      $remark = "Failed";
    }
    mysqli_query($conn, "update grade set equivalent='$editFinalGradeValue', equivalent_status='0', remark='$remark' where grade_id='$editFinalGradeHidden'");
  }

  if(isset($_GET['id']) && !empty($_GET['id'])){
    header("location: grade.php?id=".$_GET['id']);
  }else{
    header("location: grade.php?r=".$_GET['r']);
  }

}
?>
<section class="content-header">
  <h1>
    Grades
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Subject List</li>
  </ol>
</section>

<section class="content">

  <div class="box">

    <?php if(isset($_GET['id']) || isset($_GET['r'])){ ?>
    <div class="box-header with-border">
      <a href="grade.php" class="btn btn-default" data-toggle="tooltip" title="Back to lists of subject"><fa class="fa fa-arrow-left"></fa></a>
    </div>
    <?php } ?>

    <div class="box-body">

      <?php

        if($the_user['user_type'] == "encoder"){

          if(isset($_GET['id']) && !empty($_GET['id'])){

            //6
            include'includes/grade-encoder/student-list.php';

          }elseif(isset($_GET['r']) && !empty($_GET['r'])){

            include'includes/grade-encoder/review-grades.php';

          }else{

            //5
            include'includes/grade-encoder/subject-list.php';

          }

        }elseif($the_user['user_type'] == "instructor"){

          if(isset($_GET['id']) && !empty($_GET['id'])){

            //6
            include'includes/grade-instructor/student-list.php';

          }else{

            //5
            include'includes/grade-instructor/subject-list.php';

          }

        }else{

          if(isset($_GET['id']) && !empty($_GET['id'])){

            //2
            include'includes/grade/student-list.php';

          }elseif(isset($_GET['r']) && !empty($_GET['r'])){

            //4
            include'includes/grade/review-grades.php';

          }else{

            //1
            include'includes/grade/subject-list.php';

          }

        }
      ?>

    </div>

  </div>

</section>

<div class="modal" tabindex="-1" role="dialog" id="editFinalGradeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Final Grade</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="editFinalGradeForm">
          <div id="editFinalGradeDiv"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="editFinalGradeBtn" onclick="editFinalGradeSubmit()">Save</button>
      </div>
    </div>
  </div>
</div>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
<script>
  $('#subjectListTbl').DataTable({
    "paging": false,
    "lengthChange": false,
    "info": false,
    "autoWidth": false,
    "scrollY": "350px",
    "order": [[1, "asc"]]
  });

  $('#gradeTbl').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": false,
    "scrollX": true,
    "scrollY": "300px",
    fixedColumns:   {
      leftColumns: 2
    }
  });

  $("#gradeTbl input").keydown(function (e) {
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        (e.keyCode >= 35 && e.keyCode <= 40)) {
      return;
    }
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
  });

  function saveGradeBtn(){
    document.getElementById("saveGradeBtn").disabled = true;
    document.getElementById("saveGradeForm").submit();
  }

  $('#editFinalGradeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var gradeid = button.data('gradeid');
    var studentnumber = button.data('studentnumber');
    var year = button.data('year');
    $("#editFinalGradeDiv").load("php/ajax/editfinalgrade.php?q=" + gradeid + "&studentnumber=" + studentnumber + "&year=" + year);
  });

  function editFinalGradeDisplayHidden1(){
    document.getElementById("editFinalGradeTextbox").style.display = "none";
  }

  function editFinalGradeDisplayHidden2(){
    document.getElementById("editFinalGradeTextbox").style.display = "block";
  }

  function editFinalGradeSubmit(){
    document.getElementById("editFinalGradeBtn").disabled = true;
    document.getElementById("editFinalGradeForm").submit();
  }

  function finalizeGradeSubmit(){
    document.getElementById("finalizeGradeBtn").disabled = true;
    document.getElementById("finalizeGradeForm").submit();
  }
</script>
<?php include'php/footer.php'; ?>
