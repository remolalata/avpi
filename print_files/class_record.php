<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AVPI System</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    .container{
      width:100%;
    }

    th{
      text-align: center
    }

    .changeBg{
      background: #000;
      color: #fff
    }

    table, th, td{
      border: solid 2px #000 !important
    }
  </style>
</head>
<body onload="window.print()">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <table class="table table-bordered table-stripped">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th colspan="20">OFFICIAL CLASS RECORD</th>
            </tr>
            <tr>
              <th></th>
              <th rowspan="2">Name of Students</th>
              <th colspan="5" class="changeBg">ATTENDANCE</th>
              <th colspan="4" class="changeBg">QUIZZES</th>
              <th colspan="3" class="changeBg">RECITATION</th>
              <th colspan="3" class="changeBg">PROJ/ASSIGN</th>
              <th colspan="3" class="changeBg">EXAMINATION</th>
              <th colspan="2" class="changeBg">GRADE</th>
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
              include'../php/db_connection.php';
              $id = $_GET['id'];
              $class_records_increment = 1;
              $query = mysqli_query($conn, "select a.* from `students` a, student_subject b where a.student_number=b.student_number and b.subject_id='$id'");
              while($row = mysqli_fetch_assoc($query)){ ?>

                <tr>
                  <td align="center"><?php echo $class_records_increment; ?></td>
                  <td><?php echo $row['last_name'].", ".$row['first_name']." ".$row['middle_name']; ?></td>
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
      </div>
    </div>
  </div>
</body>
</html>
