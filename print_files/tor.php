<?php

include'../php/db_connection.php';
$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "select * from students where student_number='$id'");
$row = mysqli_fetch_assoc($query);

$course = mysqli_fetch_assoc(mysqli_query($conn, "select * from course where course_id='".$row['course']."'"));

$school_year = "20".$row['sy']."-20".($row['sy']+4);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AVPI System</title>

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <style>
    h3{
      margin-top: 10px;
      letter-spacing: 1px;
    }
    @media print{
      h3{
        margin-top: 10px;
        letter-spacing: 1px;
      }

      img{
        width: 125px;
        height: 125px;
      }
    }
  </style>
</head >
<body onload="window.print()">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-3 text-right">
        <img src="../<?php echo $row['image_path']; ?>">
      </div>
      <div class="col-md-9 col-sm-9 col-xs-9">
        <h4>STUDENT GRADES REPORT</h4>
        <h4>AV 1611 PRIMER INSTITUTE</h4>
        <h4>Adullam Baptist Encampment, Mt Banahaw Street Ext,</h4>
        <h4>Barangay Sto. Nino 4217 Lipat City, Batangas</h4>
      </div>
    </div>

    <hr>
    <br>

    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-4">
        <strong>Name: </strong>
        <?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']; ?>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-4">
        <strong>Course: </strong>
        <?php echo $course['course_description']; ?>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-4">
        <strong>School Year: </strong>
        <?php echo $school_year ?>
      </div>
    </div>

    <br>
    <hr>
    <h3>1st Year</h3>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Subject Code</th>
        <th>Subject Description</th>
        <th>Grade</th>
        <th>Unit</th>
        <th>Instrutor</th>
      </tr>
      <?php
        $query2 = mysqli_query($conn, "select a.*,b.*,c.*,d.* from student_subject a, subjects b, grade c, users d where a.subject_code=b.subject_code and b.subject_id=c.subject_id and b.instructor=d.user_id and c.student_number='$id' and a.student_number='$id' and a.year=1");
        while($row2 = mysqli_fetch_assoc($query2)){
          ?>
          <tr>
            <td><?php echo $row2['subject_code']; ?></td>
            <td><?php echo $row2['subject_description']; ?></td>
            <td><?php echo $row2['equivalent']; ?></td>
            <td><?php echo $row2['unit']; ?></td>
            <td><?php echo $row2['first_name']." ".$row2['last_name']; ?></td>
          </tr>
          <?php
        }
      ?>
    </table>

    <h3>2nd Year</h3>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Subject Code</th>
        <th>Subject Description</th>
        <th>Grade</th>
        <th>Unit</th>
        <th>Instrutor</th>
      </tr>
      <?php
        $query3 = mysqli_query($conn, "select a.*,b.*,c.*,d.* from student_subject a, subjects b, grade c, users d where a.subject_code=b.subject_code and b.subject_id=c.subject_id and b.instructor=d.user_id and c.student_number='$id' and a.student_number='$id' and a.year=2");
        while($row3 = mysqli_fetch_assoc($query3)){
          ?>
          <tr>
            <td><?php echo $row3['subject_code']; ?></td>
            <td><?php echo $row3['subject_description']; ?></td>
            <td><?php echo $row3['equivalent']; ?></td>
            <td><?php echo $row3['unit']; ?></td>
            <td><?php echo $row3['first_name']." ".$row3['last_name']; ?></td>
          </tr>
          <?php
        }
      ?>
    </table>

    <h3>3rd Year</h3>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Subject Code</th>
        <th>Subject Description</th>
        <th>Grade</th>
        <th>Unit</th>
        <th>Instrutor</th>
      </tr>
      <?php
        $query4 = mysqli_query($conn, "select a.*,b.*,c.*,d.* from student_subject a, subjects b, grade c, users d where a.subject_code=b.subject_code and b.subject_id=c.subject_id and b.instructor=d.user_id and c.student_number='$id' and a.student_number='$id' and a.year=3");
        while($row4 = mysqli_fetch_assoc($query4)){
          ?>
          <tr>
            <td><?php echo $row4['subject_code']; ?></td>
            <td><?php echo $row4['subject_description']; ?></td>
            <td><?php echo $row4['equivalent']; ?></td>
            <td><?php echo $row4['unit']; ?></td>
            <td><?php echo $row4['first_name']." ".$row4['last_name']; ?></td>
          </tr>
          <?php
        }
      ?>
    </table>

    <h3>4th Year</h3>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Subject Code</th>
        <th>Subject Description</th>
        <th>Grade</th>
        <th>Unit</th>
        <th>Instrutor</th>
      </tr>
      <?php
        $query5 = mysqli_query($conn, "select a.*,b.*,c.*,d.* from student_subject a, subjects b, grade c, users d where a.subject_code=b.subject_code and b.subject_id=c.subject_id and b.instructor=d.user_id and c.student_number='$id' and a.student_number='$id' and a.year=4");
        while($row5 = mysqli_fetch_assoc($query5)){
          ?>
          <tr>
            <td><?php echo $row5['subject_code']; ?></td>
            <td><?php echo $row5['subject_description']; ?></td>
            <td><?php echo $row5['equivalent']; ?></td>
            <td><?php echo $row5['unit']; ?></td>
            <td><?php echo $row5['first_name']." ".$row5['last_name']; ?></td>
          </tr>
          <?php
        }
      ?>
    </table>
  </div>
</body>
</html>
