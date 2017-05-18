<?php

include'../php/db_connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AVPI System</title>

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <style>
    @media print{
      .table th { 
          background-color: #333 !important; 
          color: #fff !important;
      } 
    }
  </style>
</head>
<body onload="window.print()">
  <div class="container">
    <table class="table table-striped table-bordered">
      <tr>
        <th>Year</th>
        <th>Subject Code</th>
        <th>Subject Title</th>
        <th>Unit</th>
        <th>Days</th>
        <th>Time</th>
        <th>Room</th>
        <th>Teacher</th>
      </tr>
      <?php
        $query = mysqli_query($conn, "select a.first_name, a.last_name, a.middle_name, b.subject_id, b.subject_code, b.subject_description, b.unit, b.day, b.time, b.room, c.section_id from users a, subjects b, subject_sections c where a.user_type='instructor' and a.user_id=b.instructor and b.subject_id=c.subject_id");
        while($row = mysqli_fetch_assoc($query)){
          ?>
            <tr>
              <td>
                <?php
                  $row2 = mysqli_fetch_assoc(mysqli_query($conn, "select * from subject_years where subject_id='".$row['subject_id']."'"));
                  $row3 = mysqli_fetch_assoc(mysqli_query($conn, "select * from year where year_id='".$row2['year_id']."'"));
                  echo $row['section_id']." - ".$row3['year_description'];
                ?>
              </td>
              <td><?php echo $row['subject_code']; ?></td>
              <td><?php echo $row['subject_description']; ?></td>
              <td><?php echo $row['unit']; ?></td>
              <td><?php echo $row['day']; ?></td>
              <td><?php echo $row['time']; ?></td>
              <td><?php echo $row['room']; ?></td>
              <td><?php echo substr($row['first_name'], 0,1).". ".$row['last_name']; ?></td>
            </tr>
          <?php
        }
      ?>
    </table>
  </div>
</body>
</html>
