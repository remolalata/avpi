<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<section class="content-header">
  <h1>
    Logs  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Logs</li>
  </ol>
</section>

<section class="content">

  <div class="box">
    <div class="box-body">
      <table id="logsTable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>User Type</th>
            <th>Action</th>
            <th>Date</th>
            <th>Time</th>
            <th>IP Address</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = mysqli_query($conn, "select * from logs order by log_id desc");
          while($row = mysqli_fetch_assoc($query)){
            ?>
              <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['user_type']; ?></td>
                <td><?php echo $row['action']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['time']; ?></td>
                <td><?php echo $row['ip_address']; ?></td>
              </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#logsTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      'iDisplayLength': 20,
    });
  });
</script>
<?php include'php/footer.php'; ?>