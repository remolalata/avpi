<?php

include'../php/db_connection.php';
$id = mysqli_real_escape_string($conn, $_GET['id']);

$query = mysqli_query($conn, "select a.*, b.*, c.* from student_subject a, students b, subjects c where a.student_number = b.student_number and a.subject_id = c.subject_id and a.year = b.year and c.subject_id='$id'");

$query2 = mysqli_query($conn, "select a.*, b.* from subjects a, users b where a.instructor=b.user_id");
$row2 = mysqli_fetch_assoc($query2);

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
<body>
  <div class="container">
    <table class="table table-striped table-bordered">
      <h4><strong>Subject Code:</strong> <?php echo $row2['subject_code']; ?></h4>
      <h4><strong>Subject Title:</strong> <?php echo $row2['subject_description']; ?></h4>
      <h4><strong>Instructor:</strong> <?php echo $row2['first_name']." ".$row2['last_name']; ?></h4>
      <thead>
        <tr>
          <th>Student Number</th>
          <th>Name</th>
          <th>Grade</th>
        </tr>
      </thead>
      <tbody>
      <?php
        while($row = mysqli_fetch_assoc($query)){
          $query2 = mysqli_query($conn, "select * from grade where subject_id='".$row['subject_id']."' and student_number='".$row['student_number']."'");
          $row2 = mysqli_fetch_assoc($query2);
          ?>
            <tr>
              <td><?php echo $row['student_number']; ?></td>
              <td><?php echo $row['last_name'].", ".$row['first_name']; ?></td>
              <td><?php echo $row2['equivalent']; ?></td>
            </tr>
          <?php
        }
      ?>
    </tbody>
    </table>
  </div>
</body>
</html>
