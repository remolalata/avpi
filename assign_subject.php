<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<?php

if($the_user['user_type'] != "admin"){ header("Location: 404.php"); }

if(isset($_POST['assignInstructorHidden'])){
  $name_instructor = $_POST['name_instructor'];
  $query3 = mysqli_query($conn, "select * from users where user_id='$name_instructor'");
  $row3 = mysqli_fetch_assoc($query3);
  $alert_text = "Subject(s) assign to ".$row3['first_name']." ".$row3['last_name']." - ".ucfirst($row3['user_type']);

  // $instructor_subjects = array();
  // foreach ($_POST['instructor_subject'] as $key => $value) {
  //   $query9 = mysqli_query($conn, "select * from subjects where subject_id='$value'");
  //   $row9 = mysqli_fetch_assoc($query9);
  //   $instructor_subjects[] = array($row9['subject_id'], strtotime($row9['start_time']), strtotime($row9['end_time']), $row9['subject_code'], $row9['start_time']);
  // }

  // $query10 = mysqli_query($conn, "select * from subjects where instructor='$name_instructor'");
  // while($row10 = mysqli_fetch_assoc($query10)){
  //   $instructor_subjects[] = array($row10['subject_id'], strtotime($row10['start_time']), strtotime($row10['end_time']), $row10['subject_code'], $row10['start_time']);
  // }
  // function date_compare($a, $b){
  //     $t1 = strtotime($a[4]);
  //     $t2 = strtotime($b[4]);
  //     return $t1 - $t2;
  // }    
  // usort($instructor_subjects, 'date_compare');

  // $ifConflict = 0;
  // foreach ($instructor_subjects as $thisevent) {
  //   $conflicts = 0;
  //   foreach ($instructor_subjects as $thatevent) {
  //       if ($thisevent[0] === $thatevent[0]) {
  //           continue;
  //       }
  //       $thisevent_from = $thisevent[1];
  //       $thisevent_ends = $thisevent[2];
  //       $thatevent_from = $thatevent[1];
  //       $thatevent_ends = $thatevent[2];
  //       if ($thatevent_ends > $thisevent_from AND $thisevent_ends > $thatevent_from) {
  //           $conflicts++;
  //           $ifConflict = 1;
  //           //echo "Event #" . $thisevent[0] . " overlaps with Event # " . $thatevent[0] . " - ".$conflicts."<br>";
  //       }
  //   }
  //   if ($conflicts === 0) {
  //     //echo "Event #" . $thisevent[0] . " is OK - ".$conflicts."<br>";
  //   }
  // }

  // if(empty($ifConflict)){
  //   foreach ($_POST['instructor_subject'] as $key => $value) {
  //     mysqli_query($conn, "update subjects set instructor='$name_instructor' where subject_id='$value'");
  //   }
  //   mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Assign a subject to Instructor', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')");
  //   echo "
  //     <script>
  //       alert('$alert_text');
  //       open('assign_subject.php', '_self');     
  //     </script>
  //   ";
  // }else{
  //   echo "
  //     <script>
  //       alert('Schedule is not available.');
  //       open('assign_subject.php', '_self');
  //     </script>
  //   ";
  // }

  foreach ($_POST['instructor_subject'] as $key => $value) {
    mysqli_query($conn, "update subjects set instructor='$name_instructor' where subject_id='$value'");
  }
  mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Assign a subject to Instructor', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')");
  echo "
    <script>
      alert('$alert_text');
      open('assign_subject.php', '_self');     
    </script>
  ";
}

if(isset($_POST['assignEncoderHidden'])){
  $name_encoder = $_POST['name_encoder'];
  $query7 = mysqli_query($conn, "select * from users where user_id='$name_encoder'");
  $row7 = mysqli_fetch_assoc($query7);
  $alert_text = "Subject(s) assign to ".$row7['first_name']." ".$row7['last_name']." - ".ucfirst($row7['user_type']);

  foreach ($_POST['encoder_subject'] as $key => $value) {
    mysqli_query($conn, "update subjects set encoder='$name_encoder' where subject_id='".$value."'");
  }

  mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Assign subject to Encoder', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')") or die(mysqli_error($conn));

  echo "
    <script>
      alert('$alert_text');
      open('assign_subject.php', '_self');     
    </script>
  ";
}

if(isset($_POST['instructorSubjectHidden'])){
  $instructorId = $_POST['instructorId'];

  mysqli_query($conn, "update subjects set instructor='' where instructor='$instructorId'");
  foreach ($_POST['instructorSubjectArr'] as $key => $value) {
    mysqli_query($conn, "update subjects set instructor='$instructorId' where subject_id='$value'");
  }

  echo "
    <script>
      open('assign_subject.php', '_self');     
    </script>
  ";
}

if(isset($_POST['encoderSubjectHidden'])){
  $encoderId = $_POST['encoderId'];

  mysqli_query($conn, "update subjects set encoder='' where encoder='$encoderId'");
  foreach ($_POST['encoderSubjectArr'] as $key => $value) {
    mysqli_query($conn, "update subjects set encoder='$encoderId' where subject_id='$value'");
  }

  echo "
    <script>
      open('assign_subject.php', '_self');     
    </script>
  ";
}

?>

<section class="content-header">
  <h1>
    Assign Subject
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Assign Subject</li>
  </ol>
</section>

<section class="content">
  <form method="post" class="form-horizontal">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Subject Assignment for Instructors</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <input type="hidden" name="assignInstructorHidden" value="check">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Name of Instructor:</label>
        <div class="col-sm-8">
          <select name="name_instructor" class="form-control select2" id="my-select" required >
            <option value="">Select Instructor</option>
            <?php
              $query = mysqli_query($conn, "select * from users where user_type='instructor'");
              while($row = mysqli_fetch_assoc($query)){
                ?>
                  <option value="<?php echo $row['user_id']; ?>"><?php echo $row['first_name']." ".$row['last_name']; ?></option>
                <?php
              }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Subjects & Schedule:</label>
        <div class="col-sm-8">
          <select name="instructor_subject[]" class="form-control select2" multiple="multiple" data-placeholder="Select Subject & Schedule" style="width: 100%;" required >
            <?php
              $query2 = mysqli_query($conn, "select * from subjects where instructor=''");
              while($row2 = mysqli_fetch_assoc($query2)){
                ?>
                  <option value="<?php echo $row2['subject_id']; ?>"><?php echo $row2['subject_description']; ?> (<?php echo $row2['subject_code']; ?>) - (<?php echo $row2['day'].", ".$row2['time']; ?>) - (SY: <?php echo $row2['sy']; ?>)</option>
                <?php
              }
            ?>
          </select>
        </div>
      </div>
    </div>
    <div class="box-footer text-center">
      <button type="button" id="clear" class="btn btn-default" style="width: 120px">Clear</button>&emsp;&emsp;
      <button type="submit" class="btn btn-primary" style="width: 120px">Save</button>&emsp;&emsp;
    </div>
  </div>
  </form>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">List of Instructors</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table id="instructorTable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Instructor ID</th>
            <th>Name of Instructor</th>
            <th>Subject Handled</th>
            <th>Subject(s)</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query4 = mysqli_query($conn, "select * from users where user_type='instructor'");
            while($row4 = mysqli_fetch_assoc($query4)){
              $subject_handled = mysqli_query($conn, "select * from subjects where instructor='".$row4['user_id']."'");
              ?>
                <tr>
                  <td><?php echo $row4['username']; ?></td>
                  <td><?php echo $row4['first_name']." ".$row4['last_name']; ?></td>
                  <td><?php echo mysqli_num_rows($subject_handled); ?></td>
                  <td>
                    <?php
                      if(empty(mysqli_num_rows($subject_handled))){
                        echo "NONE";
                      }else{
                        $row_subject_handled_list = "";
                        while($row_subject_handled = mysqli_fetch_assoc($subject_handled)){
                          $row_subject_handled_list .= "<span data-toggle='tooltip' title='".$row_subject_handled['subject_description']."'>".$row_subject_handled['subject_code']."</span>, ";
                        }
                        echo rtrim($row_subject_handled_list, ", ");
                      }
                    ?>
                  </td>
                  <td align="center">
                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#instructorHandledSubjects" data-userid="<?php echo $row4['user_id']; ?>"><i class="fa fa-pencil" data-toggle="tooltip" title="Edit Subjects Handled"></i></button>
                  </td>
                </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <form method="post" class="form-horizontal">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Subject Assignment for Encoder</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <input type="hidden" name="assignEncoderHidden" value="check">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Name of Encoder:</label>
        <div class="col-sm-8">
          <select name="name_encoder" class="form-control select2" required >
            <option value="">Select Encoder</option>
            <?php
              $query5 = mysqli_query($conn, "select * from users where user_type='encoder'");
              while($row5 = mysqli_fetch_assoc($query5)){
                ?>
                  <option value="<?php echo $row5['user_id']; ?>"><?php echo $row5['first_name']." ".$row5['last_name']; ?></option>
                <?php
              }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Subjects & Schedule:</label>
        <div class="col-sm-8">
          <select name="encoder_subject[]" class="form-control select2" multiple="multiple" data-placeholder="Select Subject & Schedule" style="width: 100%;" required >
            <?php
              $query8 = mysqli_query($conn, "select * from subjects where encoder=''");
              while($row8 = mysqli_fetch_assoc($query8)){
                ?>
                  <option value="<?php echo $row8['subject_id']; ?>"><?php echo $row8['subject_description']; ?> (<?php echo $row8['subject_code']; ?>) - (<?php echo $row8['day'].", ".$row8['time']; ?>) - (SY: <?php echo $row8['sy']; ?>)</option>
                <?php
              }
            ?>
          </select>
        </div>
      </div>
    </div>
    <div class="box-footer text-center">
      <button type="reset" id="clear" class="btn btn-default" style="width: 120px">Clear</button>&emsp;&emsp;
      <button type="submit" class="btn btn-primary" style="width: 120px">Save</button>&emsp;&emsp;
    </div>
  </div>
  </form>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">List of Encoders</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table id="encoderTable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Encoder ID</th>
            <th>Name of Encoder</th>
            <th>Subject Handled</th>
            <th>Subject(s)</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query6 = mysqli_query($conn, "select * from users where user_type='encoder'");
            while($row6 = mysqli_fetch_assoc($query6)){
              $subject_handled2 = mysqli_query($conn, "select * from subjects where encoder='".$row6['user_id']."'");
              ?>
                <tr>
                  <td><?php echo $row6['username']; ?></td>
                  <td><?php echo $row6['first_name']." ".$row6['last_name']; ?></td>
                  <td><?php echo mysqli_num_rows($subject_handled2); ?></td>
                  <td>
                    <?php
                      if(empty(mysqli_num_rows($subject_handled2))){
                        echo "NONE";
                      }else{
                        $row_subject_handled_list2 = "";
                        while($row_subject_handled2 = mysqli_fetch_assoc($subject_handled2)){
                          $row_subject_handled_list2 .= "<span data-toggle='tooltip' title='".$row_subject_handled2['subject_description']."'>".$row_subject_handled2['subject_code']."</span>, ";
                        }
                        echo rtrim($row_subject_handled_list2, ", ");
                      }
                    ?>
                  </td>
                  <td align="center">
                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#encoderHandledSubjects" data-userid="<?php echo $row6['user_id']; ?>"><i class="fa fa-pencil" data-toggle="tooltip" title="Edit Subjects Handled"></i></button>
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

<div class="modal" tabindex="-1" role="dialog" id="instructorHandledSubjects">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Subjects</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="instructorSubjectForm" enctype="multipart/form-data">
          <div id="instructorSubjectsDiv"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-danger" value="Save" form="instructorSubjectForm">
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="encoderHandledSubjects">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Subjects</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="encoderSubjectForm" enctype="multipart/form-data">
          <div id="encoderSubjectsDiv"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-danger" value="Save" form="encoderSubjectForm">
      </div>
    </div>
  </div>
</div>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(".select2").select2();

  $("#clear").click(function(){
    $(".select2").val(null).trigger("change"); 
  });

  $('#instructorTable').DataTable({
    "order": [[ 1, "asc" ]],
    "paging": false,
    "lengthChange": false,
    "info": false,
    "autoWidth": false,
    "scrollY": "120px"
  });

  $('#encoderTable').DataTable({
    "order": [[ 1, "asc" ]],
    "paging": false,
    "lengthChange": false,
    "info": false,
    "autoWidth": false,
    "scrollY": "120px"
  });

  $('#instructorHandledSubjects').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var userid = button.data('userid');
    $("#instructorSubjectsDiv").load("php/ajax/instructoreditsubjects.php?q=" + userid);
  });

  $('#encoderHandledSubjects').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var userid = button.data('userid');
    $("#encoderSubjectsDiv").load("php/ajax/encodereditsubjects.php?q=" + userid);
  });
</script>
<?php include'php/footer.php'; ?>