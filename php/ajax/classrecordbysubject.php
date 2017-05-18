<?php
include'../db_connection.php';
$id = $_GET['id'];
?>

<table class="table table-bordered table-stripped" id="classRecordTbl">
  <thead>
    <tr>
      <th></th>
      <th></th>
      <th colspan="20">OFFICIAL CLASS RECORD</th>
    </tr>
    <tr>
      <th></th>
      <th rowspan="2">Name of Students</th>
      <th colspan="5">ATTENDANCE</th>
      <th colspan="4">QUIZZES</th>
      <th colspan="3">RECITATION</th>
      <th colspan="3">PROJ/ASSIGN</th>
      <th colspan="3">EXAMINATION</th>
      <th colspan="2">GRADE</th>
    </tr>

    <tr>
      <th></th>
      <th>T</th>
      <th>W</th>
      <th>TH</th>
      <th>F</th>
      <th>5%</th>
      <th>1</th>
      <th>2</th>
      <th>AVE</th>
      <th>25%</th>
      <th>1</th>
      <th>AVE</th>
      <th>15%</th>
      <th>1</th>
      <th>AVE</th>
      <th>15%</th>
      <th>ES</th>
      <th>ER</th>
      <th>40%</th>
      <th>PG</th>
      <th>EQ</th>
    </tr>
  </thead>

  <tbody>
    <?php
      $class_records_increment = 1;
      $query15 = mysqli_query($conn, "select a.* from `students` a, student_subject b where a.student_number=b.student_number and b.subject_id='$id'");
      while($row15 = mysqli_fetch_assoc($query15)){ ?>

        <tr>
          <td align="center"><?php echo $class_records_increment; ?></td>
          <td><?php echo $row15['last_name'].", ".$row15['first_name']." ".$row15['middle_name']; ?></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>

        <?php $class_records_increment++; ?>
    <?php } ?>

  </tbody>
</table>
