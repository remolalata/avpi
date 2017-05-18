<?php

include'../php/db_connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AVPI System</title>

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <style>
    #masterFileTbl_filter{display: none;}
    @media print{
      .table th { 
          background-color: #333 !important; 
          color: #fff !important;
          white-space: nowrap;
      } 
      .table td {
        white-space: nowrap;
      }
      #masterFileTbl_filter{display: none;}
    }
  </style>
</head>
<body onload="window.print()">
  <div class="container">
    <table id="masterFileTbl" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Student Number</th>
          <th>Name</th>
          <th>Section</th>
          <th>Course</th>
          <th>Year</th>
          <th>Church</th>
          <th>Enroll Yr</th>
          <th>Count</th>
          <th>Subject 1</th>
          <th>Subject 2</th>
          <th>Subject 3</th>
          <th>Subject 4</th>
          <th>Subject 5</th>
          <th>Subject 6</th>
        </tr>
      </thead>
      <tbody>
        <?php

          $query = mysqli_query($conn, "select * from students");
          while($row = mysqli_fetch_assoc($query)){
            $church = mysqli_fetch_assoc(mysqli_query($conn, "select * from church where church_id='".$row['church']."'"));
            $query8 = mysqli_query($conn, "select a.*, b.* from student_subject a, subjects b where a.subject_id=b.subject_id and a.student_number='".$row['student_number']."' and a.year='".$row['year']."'") or die(mysqli_error($conn));
            $count8 = mysqli_num_rows($query8);
            ?>
              <tr>
                <td><?php echo $row['student_number']; ?></td>
                <td><?php echo $row['last_name']." ".$row['first_name']; ?></td>
                <td><?php echo $row['section']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['year']; ?></td>
                <td><?php echo $church['church_name']; ?></td>
                <td><?php echo "20".$row['sy']; ?></td>
                <td><?php echo $row['count']; ?></td>
                <?php if(empty($count8)){ ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php }else{ ?>
                  <?php
                    $count_subject = 6-$count8;
                    while($row8 = mysqli_fetch_assoc($query8)){
                      ?>
                      <td><?php echo $row8['subject_code']; ?></td>
                      <?php
                    }
                    if(!empty($count_subject)){
                      for ($i=1; $i <= $count_subject ; $i++) { 
                        echo "<td></td>";
                      }
                    }
                  ?>
                <?php } ?>
              </tr>
            <?php
          }

        ?>
      </tbody>
    </table>
  </div>
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

var student_number = getParameterByName('student_number');
var name = getParameterByName('name');
var section = getParameterByName('section');
var course = getParameterByName('course');
var year = getParameterByName('year');
var church = getParameterByName('church');
var sy = getParameterByName('sy');
var subject_1 = getParameterByName('subject_1');
var subject_2 = getParameterByName('subject_2');
var subject_3 = getParameterByName('subject_3');
var subject_4 = getParameterByName('subject_4');
var subject_5 = getParameterByName('subject_5');
var subject_6 = getParameterByName('subject_6');

var table = $('#masterFileTbl').DataTable({
  "paging": false,
  "lengthChange": false,
  "searching": true,
  "ordering": false,
  "info": false,
  "autoWidth": false,
});

console.log(course)

table.column(0).search(student_number).draw();
table.column(1).search(name).draw();
table.column(2).search(section).draw();
table.column(3).search(course).draw();
table.column(4).search(year).draw();
table.column(5).search(church).draw();
table.column(6).search(sy).draw();
table.column(8).search(subject_1).draw();
table.column(9).search(subject_2).draw();
table.column(10).search(subject_3).draw();
table.column(11).search(subject_4).draw();
table.column(12).search(subject_5).draw();
table.column(13).search(subject_6).draw();

</script>
</body>
</html>
