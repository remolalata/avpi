<?php

session_start();
include'../php/db_connection.php';
date_default_timezone_set('Asia/Manila');

$student_number = $_GET['id'];
$query = mysqli_query($conn, "select * from students where student_number='$student_number'");
$row = mysqli_fetch_assoc($query);

$query2 = mysqli_query($conn, "select * from church where church_id='".$row['church']."'");
$row2 = mysqli_fetch_assoc($query2);

$query3 = mysqli_query($conn, "select * from course where course_id='".$row['course']."'");
$row3 = mysqli_fetch_assoc($query3);

$school_year_start = date('y');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AVPI System</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">

  <style type="text/css">
    .student_info span{
      text-decoration: underline;
      display: inline-block;
    }

    .grading-legend{
      margin: 10px -15px
    }

    .grading-legend span{
      font-weight: 700
    }

    th{
      background: #000;
      color: #fff;
      text-align: center;
    }
    @media print{
      .student_info span{
        text-decoration: underline;
        display: inline-block;
      }

      .grading-legend{
        margin: 10px -15px
      }

      .grading-legend span{
        font-weight: 700
      }

      th{
        background: #000;
        color: #fff;
        text-align: center;
      }
    }
  </style>
</head>
<body onload="window.print()">
  <div class="container">
    <div class="row" style="padding-top: 10px">
      <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-4 text-right" style="padding-right: 0">
            <img src="../image/logo.png" width="180" height="90">
          </div>

          <div class="col-md-8 col-sm-8 col-xs-8" style="padding-left: 0">
            <h2 class="media-heading" style="letter-spacing: 3px;font-size: 20px; font-weight: 700">A.V. 1611 PRIMER INSTITUTE</h2>
            <h4 style="font-size: 13px;font-weight: 700;letter-spacing: 0.5px;">An Anual Bible-believing Summber Bible Institue</h4>
            <h3 style="font-size: 15px;font-weight: 700;letter-spacing: 0.03px;text-decoration: underline;padding-left: 20px">Student Grade Report</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row student_info" style="margin-top: 30px">
      <div class="col-md-8 col-sm-8 col-xs-8">
        <h5>Name: <span><?php echo ucfirst(strtolower($row['last_name'])).", ".ucfirst(strtolower($row['first_name']))." ".ucfirst(strtolower($row['middle_name']))." ".$row['suffix_name']; ?></span></h5>
        <h5>Course: <span><?php echo $row3['course_description']; ?></span></h5>
        <h5>Class/Section: <span><?php echo $row['section']; ?></span></h5>
        <h5>Church: <span><?php echo $row2['church_name']; ?></span></h5>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-4">
        <h5>Summer S.Y.: <span><?php echo date('Y'); ?></span></h5>
        <h5>Curriculum Year: <span><?php echo $row['year']; ?></span></h5>
      </div>
    </div>

    <div class="row" style="margin-top: 20px">
      <div class="col-md-12">
        <table class="table table-condensed" style="border: solid 2px #333">
          <tr class="firstTr">
            <th style="text-align: left">SUBJ CODE</th>
            <th>SUBJECT TITLE</th>
            <th>UNITS</th>
            <th>PG</th>
            <th>EQ</th>
            <th>TEACHER</th>
          </tr>

          <?php
            $total_units = 0;
            $total_grade = 0;
            $query4 = mysqli_query($conn, "select a.*, b.*, c.last_name, c.first_name from student_subject a, subjects b, users c where a.student_number='$student_number' and a.subject_id=b.subject_id and b.instructor=c.user_id");
            $count4 = mysqli_num_rows($query4);
            while($row4 = mysqli_fetch_assoc($query4)){ ?>
              <?php
                $query5 = mysqli_query($conn, "select * from grade where subject_id='".$row4['subject_id']."' and sy='$school_year_start' and student_number='".$row4['student_number']."' ");
                $row5 = mysqli_fetch_assoc($query5);
                $eq = "F";
                if($row5['equivalent'] <= 100 && $row5['equivalent'] >= 95){
                  $eq = "A";
                }else if($row5['equivalent'] <= 94 && $row5['equivalent'] >= 90){
                  $eq = "B";
                }else if($row5['equivalent'] <= 89 && $row5['equivalent'] >= 85){
                  $eq = "C";
                }else if($row5['equivalent'] <= 84 && $row5['equivalent'] >= 80){
                  $eq = "D";
                }else if($row5['equivalent'] <= 79){
                  $eq = "F";
                }
              ?>
              <tr>
                <td><?php echo $row4['subject_code']; ?></td>
                <td><?php echo $row4['subject_description']; ?></td>
                <td align="center"><?php echo $row4['unit']; ?></td>
                <td align="center"><?php echo $row5['equivalent']; ?></td>
                <td align="center"><?php echo $eq; ?></td>
                <td align="center"><?php echo substr($row4['first_name'], 0, 1).". ".$row4['last_name']; ?></td>
              </tr>
          <?php
            $total_units += $row4['unit'];
            $total_grade += $row5['equivalent'];
          ?>
          <?php } ?>
          <tr>
            <td><span style="color: #fff">a</span></td>
            <td><span style="color: #fff">a</span></td>
            <td><span style="color: #fff">a</span></td>
            <td><span style="color: #fff">a</span></td>
            <td><span style="color: #fff">a</span></td>
            <td><span style="color: #fff">a</span></td>
          </tr>
          <tr>
            <td></td>
            <td align="center"><strong>Average</strong></td>
            <td align="center"><?php echo $total_units; ?></td>
            <td align="center"><?php echo $total_grade/$count4; ?></td>
            <td align="center">
              <?php
                if($total_grade/$count4 <= 100 && $total_grade/$count4 >= 95){
                  echo "A";
                }else if($total_grade/$count4 <= 94 && $total_grade/$count4 >= 90){
                  echo "B";
                }else if($total_grade/$count4 <= 89 && $total_grade/$count4 >= 85){
                  echo "C";
                }else if($total_grade/$count4 <= 84 && $total_grade/$count4 >= 80){
                  echo "D";
                }else if($total_grade/$count4 <= 79){
                  echo "F";
                }
              ?>
            </td>
            <td align="center"></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row grading-legend">
      <div class="col-xs-9">
        <span>Legend: PG</span> - Percentage Grade; <span>EQ</span> - Percentage Equivalent
      </div>
      <div class="col-xs-3">
        Noted By:
      </div>
    </div>

    <div class="row grading-legend">
      <div class="col-xs-9">
        95% - 100% <span>(A)</span> 90% - 94% <span>(B)</span> 85% - 89% <span>(C)</span> 80% - 84% <span>(D)</span> 79% & below (Failed) - <span>(F)</span>
      </div>
    </div>

    <div class="row grading-legend">
      <div class="col-xs-9">
        Incomplete <span>(I)</span> Passed <span>(P)</span> Audit or Sit In (Not For Credit) - <span>(AU)</span>
      </div>
      <div class="col-xs-3">
        Rodrigo R. Quirante Jr.
      </div>
    </div>

  </div>


</body>
</html>
