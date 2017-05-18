<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<?php

if(isset($_POST['addRTDSubjectHidden'])){
  $subject_id = $_POST['addRTDSubjectHidden'];
  $time = $_POST['start_time']."-".$_POST['end_time'];
  $start_time = date("H:i", strtotime($_POST['start_time']));
  $day = $_POST['day'];

  $total      = strtotime($_POST['end_time']) - strtotime($_POST['start_time']);
  $hours      = floor($total / 60 / 60);
  $minutes    = round(($total - ($hours * 60 * 60)) / 60);

  $no_of_hours = $hours.':'.$minutes;

  $room = mysqli_real_escape_string($conn, $_POST['room']);
  mysqli_query($conn, "update subjects set room='$room', start_time='$start_time', time='$time', day='$day', no_of_hours='$no_of_hours' where subject_id='$subject_id'");
  echo "
  <script>
    open('schedule.php', '_self');
  </script>
  ";
}

?>

<section class="content-header">
  <h1>
    Schedule <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addRTDSubject"><i class="fa fa-plus" data-toggle="tooltip" title="Assign Subject"> </i> Schedule Subject</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Scheduling</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-body">
      <table id="churchTable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Subject Code</th>
            <th>Subject Title</th>
            <th>Instructor</th>
            <th>Room</th>
            <th>Time</th>
            <th>Day</th>
            <th>Sy</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = mysqli_query($conn, "select * from subjects where room<>''") or die(mysqli_error($conn));
            while($row = mysqli_fetch_assoc($query)){
              $instructor = mysqli_fetch_assoc(mysqli_query($conn, "select * from users where user_id='".$row['instructor']."'"));
              ?>
                <tr>
                  <td><?php echo $row['subject_code']; ?></td>
                  <td><?php echo $row['subject_description']; ?></td>
                  <?php if(empty($row['instructor'])){ ?>
                  <td>NONE</td>
                  <?php }else{ ?>
                  <td><?php echo $instructor['last_name'].", ".$instructor['first_name']; ?></td>
                  <?php } ?>
                  <td><?php echo $row['room']; ?></td>
                  <td><?php echo preg_replace("/[^0-9-:\/]+/", "", $row['time']); ?></td>
                  <td><?php echo $row['day']; ?></td>
                  <td><?php echo $row['sy']; ?>
                </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<div class="modal" tabindex="-1" role="dialog" id="addRTDSubject">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Assign Subject</h4>
      </div>
      <div class="modal-body">
        <form method="post" >
        <input type="hidden" name="addRTDSubjectHidden" id="addRTDSubjectHidden" value="">
        <div class="row">
          <div class="form-group">
            <div class="col-md-6">
              <label>Subject Code</label>
              <select name="subject_code" class="form-control" onchange="checkSubjectRTD(this.value)" required >
                <option value="">Select</option>
                <?php
                  $query2 = mysqli_query($conn, "select * from subjects where room=''");
                  while($row2 = mysqli_fetch_assoc($query2)){
                    ?>
                      <option value="<?php echo $row2['subject_id']; ?>"><?php echo $row2['subject_code']; ?></option>
                    <?php
                  }
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Subject Unit</label>
                <input type="text" id="unit" class="form-control" readonly placeholder="Subject Unit" required >
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Section</label>
              <input type="text" id="section" class="form-control" readonly placeholder="Section" required >
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Course</label>
              <input type="text" id="course" class="form-control" readonly placeholder="Course" required >
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Start Time</label>
              <select name="start_time" id="" class="form-control select2" style="width: 100%" required >
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
            <div class="form-group">
              <label>End Time</label>
              <select name="end_time" id="" class="form-control select2" style="width: 100%" required >
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
            <div class="form-group">
              <label>Day</label>
              <select name="day" id="day" class="form-control" required >
                <option value="">Select</option>
                <option value="MON-TH">MON-TH</option>
                <option value="TUE-FRI">TUE-FRI</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Room</label>
              <input type="text" name="room" class="form-control" placeholder="Room" required >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
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
  $('#churchTable').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    "scrollY": "350px"
  });

  function checkSubjectRTD(val){
    $.ajax({
    type: "POST",
    url: "php/ajax/checksubjectrtd.php",
    data: 'id='+val,
    dataType: 'json',
    success: function(msg){
      document.getElementById("unit").value = msg.unit;
      document.getElementById("section").value = msg.section;
      document.getElementById("course").value = msg.course;
      document.getElementById("addRTDSubjectHidden").value = msg.subject_id;
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown); 
    }
   });
  }
</script>
<?php include'php/footer.php'; ?>