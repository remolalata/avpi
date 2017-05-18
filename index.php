<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<section class="content-header">
  <h1>
    Home
    <small>it all starts here</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active">Home</li>
  </ol>
</section>

<section class="content">

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Students</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table id="studentTable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Student Number</th>
            <th>Name of Student</th>
            <th>Year</th>
            <th>Section</th>
            <th>Course</th>
            <th>Church</th>
            <th>Pastor</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = mysqli_query($conn, "select * from students where year<>'graduate'");
            while($row = mysqli_fetch_assoc($query)){
              $query4 = mysqli_query($conn, "select * from church where church_id='".$row['church']."'");
              $row4 = mysqli_fetch_assoc($query4);
              ?>
                <tr>
                  <td><?php echo $row['student_number']; ?></td>
                  <td><?php echo $row['first_name']." ".$row['last_name']." ".$row['suffix_name']; ?></td>
                  <td><?php echo $row['year']; ?></td>
                  <td><?php echo $row['section']; ?></td>
                  <td><?php echo $row['course']; ?></td>
                  <td><?php echo $row4['church_name']; ?></td>
                  <td><?php echo $row4['pastor']; ?></td>
                  <td align="center">
                    <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#viewStudentModal" data-viewid="<?php echo $row['student_number']; ?>"><i class="fa fa-eye" data-toggle="tooltip" title="View More"></i></a>
                  </td>
                </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Instructors</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table id="instructorTable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Name of Instructor</th>
            <th>Church</th>
            <th>Pastor</th>
            <th>Cotact Number</th>
            <th>Email Address</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query2 = mysqli_query($conn, "select * from users where user_type='instructor'");
            while($row2 = mysqli_fetch_assoc($query2)){
              $query5 = mysqli_query($conn, "select * from church where church_id='".$row2['church']."'");
              $row5 = mysqli_fetch_assoc($query5);
              ?>
                <tr>
                  <td><?php echo $row2['first_name']." ".$row2['last_name']; ?></td>
                  <td><?php echo $row5['church_name']; ?></td>
                  <td><?php echo $row5['pastor']; ?></td>
                  <td><?php echo $row2['contact_number']; ?></td>
                  <td><?php echo $row2['email_address']; ?></td>
                </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Church</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table id="churchTable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Name of Church</th>
            <th>Pastor</th>
            <th>Contact Number</th>
            <th>Email Address</th>
            <th>Address</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query3 = mysqli_query($conn, "select * from church");
            while($row3 = mysqli_fetch_assoc($query3)){
              ?>
                <tr>
                  <td><?php echo $row3['church_name']; ?></td>
                  <td><?php echo $row3['pastor']; ?></td>
                  <td><?php echo $row3['contact_number']; ?></td>
                  <td><?php echo $row3['email_address']; ?></td>
                  <td><?php echo $row3['address']; ?></td>
                </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</section>

<div class="modal" tabindex="-1" role="dialog" id="viewStudentModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Student</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
        <div id="viewStudentDiv"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">View All</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $('#studentTable').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    "scrollY": "120px"
  });

  $('#instructorTable').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    "scrollY": "120px"
  });

  $('#churchTable').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    "scrollY": "120px"
  });

  $('#viewStudentModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var viewid = button.data('viewid');
    $("#viewStudentDiv").load("php/ajax/viewstudent.php?q=" + viewid);
  });

</script>
<?php include'php/footer.php'; ?>
