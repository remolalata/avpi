<?php
  session_start();
  include'../php/db_connection.php';
  date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AVPI System</title>

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

  <style>
    span{
      font-weight: 700;
      text-decoration: underline;
    }

    h5{
      margin-bottom: 5px;
      margin-top: 5px;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{border-top: solid 2px #333;}

    @media print{
      .table th { 
          white-space: nowrap;
          background-color: #333 !important; 
          color: #fff !important;
      }
      .table td {
        white-space: nowrap;
        text-align: center;
      }

      #printContainer{
        height: 100vh
      }
    }

    #printContainer{
        height: 100vh
      }
  </style>
</head>
<body onload="window.print()">
  <?php

  function addtime($time1,$time2){
        $x = new DateTime($time1);
        $y = new DateTime($time2);

        $interval1 = $x->diff(new DateTime('00:00')) ;
        $interval2 = $y->diff(new DateTime('00:00')) ;

        $e = new DateTime('00:00');
        $f = clone $e;
        $e->add($interval1);
        $e->add($interval2);
        $total = $f->diff($e)->format("%H:%I");
        return $total;
      }
    $query = mysqli_query($conn, "select * from students where student_status='Enrolled'");
    while($row = mysqli_fetch_assoc($query)){
      $query2 = mysqli_query($conn, "select * from church where church_id='".$row['church']."'");
      $row2 = mysqli_fetch_assoc($query2);

      $query3 = mysqli_query($conn, "select * from year where year_id='".$row['year']."'");
      $row3 = mysqli_fetch_assoc($query3);

  ?>
  <div class="container" id="#printContainer">
    <div class="row" style="padding-top: 20px">
      <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-4 text-right">
            <img src="../image/logo.png" width="200" height="90">
          </div>

          <div class="col-md-8 col-sm-8 col-xs-8" style="padding-left: 0">
            <h2 class="media-heading" style="letter-spacing: 3px;font-size: 20px; font-weight: 700">A.V. 1611 PRIMER INSTITUTE</h2>
            <h4 style="font-size: 13px;font-weight: 700;letter-spacing: 0.5px;">An Anual Bible-believing Summber Bible Institue</h4>
            <h3 style="font-size: 15px;font-weight: 700;letter-spacing: 0.03px;text-decoration: underline;padding-left: 20px">Registration and Assessment Form</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row" style="margin-top: 30px">
      <div class="col-md-8 col-sm-8 col-xs-8">
        <h5>Name: <span><?php echo $row['last_name'].", ".$row['first_name']; ?></span></h5>
        <h5>Course: <span><?php echo $row['course']; ?></span></h5>
        <h5>Class/Section: <span><?php echo $row['section']."-".$row['year']; ?></span></h5>
        <h5>Church/Address: <span><?php echo $row2['church_name']."-".$row2['address']; ?></span></h5>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-4">
        <h5>Date of Enrollment: <span><?php echo $row['date_enrolled']; ?></span></h5>
        <h5>Summer S.Y.: <span><?php echo "20".$row['sy']; ?></span></h5>
        <h5>Curriculum Year: <span><?php echo $row3['year_description']; ?></span></h5>
      </div>
    </div>

    <div class="row" style="margin-top: 20px">
      <div class="col-md-12">
        <table class="table table-condensed" style="border: solid 2px #333">
          <tr class="firstTr">
            <th>SUBJ. CODE</th>
            <th align="center" style="text-align: center">SUBJECT TITLE</th>
            <th align="center" style="text-align: center">UNITS</th>
            <th align="center" style="text-align: center">DAYS</th>
            <th align="center" style="text-align: center">TIME</th>
            <th align="center" style="text-align: center">ROOM</th>
          </tr>

          <?php
            $units = 0;
            $no_of_hours = "00:00";
            $query4 = mysqli_query($conn, "select a.*,b.*,c.* FROM student_subject a, subjects b, users c where a.subject_id=b.subject_id and c.user_id=b.instructor and a.year='".$row['year']."' order by b.start_time");

            while($row4 = mysqli_fetch_assoc($query4)){
              $units = $row4['unit']+$units;
              $no_of_hours = addtime($no_of_hours, $row4['no_of_hours']);
              $instructor = substr($row4['first_name'], 0, 1).". ".$row4['last_name'];
              ?>
              <tr>
                <td><?php echo $row4['subject_code']; ?></td>
                <td><?php echo $row4['subject_description']." - ".$instructor; ?></td>
                <td align="center"><?php echo $row4['unit']; ?></td>
                <td align="center"><?php echo $row4['day']; ?></td>
                <td align="center"><?php echo $row4['time']; ?></td>
                <td align="center"><?php echo $row4['room']; ?></td>
              </tr>
              <?php
            }

          ?>

          <tr>
            <td></td>
            <td align="center"><strong>TOTAL</strong></td>
            <td align="center"><strong><?php echo $units; ?></strong></td>
            <td></td>
            <td align="center">
              <strong>
                <?php
                  echo (int)stristr($no_of_hours, ":", true).stristr($no_of_hours, ':')." HOURS";
                ?>
              </strong>
            </td>
            <td></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row" style="margin-top: 20px">
      <div class="col-md-12">
        <ul>
          <li style="font-weight: 700;">Students cannot claim credits for unofficially registered subjects.</li>
          <li style="font-weight: 700;">Students will only have maximum credits of 16 units and 32 hours.</li>
        </ul>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 col-md-offset-9 col-xm-3 col-xm-offset-9 col-xs-3 col-xs-offset-9">
        <h5>Assessed By: </h4>
        <h4><?php echo "Rodgie Quirante"; //$the_user['first_name']." ".$the_user['last_name']; ?></h4>
      </div>
    </div>
  </div>

<?php } ?>

</body>
</html>
