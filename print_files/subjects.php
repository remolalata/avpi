<?php
include'../php/db_connection.php';
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AVPI System</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">

  <style>
    table th{
      background: #000;
      color: #fff;
    }

    .subject_list_div span{
      font-size: 20px;
      display: block;
      font-weight: 700;
      margin-bottom: 10px
    }

    @media print{
      table th{
        background: #000;
        color: #fff;
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
            <h3 style="font-size: 20px;font-weight: 700;letter-spacing: 0.03px;text-decoration: underline">Subjects and Schedule</h3>
            <h5>Summer School Year 20<?php echo $id; ?></h5>
          </div>
        </div>
      </div>
    </div>

    <div class="row" style="margin-top: 40px">
      <div class="col-md-12 subject_list_div">
        <span style="font-size: 20px;
        display: block;
        font-weight: 700;
        margin-bottom: 10px">Class Timothy - First Year</span>
        <table class="table table-bordered">
          <tr>
            <th>SUBJ. CODE</th>
            <th>SUBJECT TITLE</th>
            <th>INSTRUCTOR</th>
            <th>UNITS</th>
            <th>DAYS</th>
            <th>TIME</th>
            <th>ROOM</th>
          </tr>

          <?php
            $query16 = mysqli_query($conn, "select a.*, b.section_id, c.year_id, d.year_id, e.last_name, e.first_name from subjects a, subject_sections b, subject_years c, users e, year d where a.subject_id=b.subject_id and a.subject_id=c.subject_id and c.year_id=d.yearID and d.year_id='1' and b.section_id='Timothy' and a.sy='17' and a.instructor=e.user_id");
            $count16 = mysqli_num_rows($query16);

            if(empty($count16)){ ?>
              <tr>
                <td colspan="6">No data to display in the table</td>
              </tr>
            <?php }else{
              while($row16 = mysqli_fetch_assoc($query16)){ ?>

                <tr>
                  <td><?php echo $row16['subject_code']; ?></td>
                  <td><?php echo $row16['subject_description']; ?></td>
                  <td><?php echo $row16['last_name'].", ".$row16['first_name']; ?></td>
                  <td><?php echo $row16['unit']; ?></td>
                  <td><?php echo $row16['day']; ?></td>
                  <td><?php echo $row16['time']; ?></td>
                  <td><?php echo $row16['room']; ?></td>
                </tr>
              <?php }
            }
          ?>
        </table>
        <p><strong>Recommendation: </strong>basically for everyone, but pre-requisite for freshmen (First time in a bible institute).</p>
      </div>
    </diV>

    <div class="row" style="margin-top: 40px">
      <div class="col-md-12 subject_list_div">
        <span style="font-size: 20px;
        display: block;
        font-weight: 700;
        margin-bottom: 10px">Class Timothy - Second Year</span>
        <table class="table table-bordered">
          <tr>
            <th>SUBJ. CODE</th>
            <th>SUBJECT TITLE</th>
            <th>INSTRUCTOR</th>
            <th>UNITS</th>
            <th>DAYS</th>
            <th>TIME</th>
            <th>ROOM</th>
          </tr>

          <?php
            $query17 = mysqli_query($conn, "select a.*, b.section_id, c.year_id, d.year_id, e.last_name, e.first_name from subjects a, subject_sections b, subject_years c, users e, year d where a.subject_id=b.subject_id and a.subject_id=c.subject_id and c.year_id=d.yearID and d.year_id='2' and b.section_id='Timothy' and a.sy='17' and a.instructor=e.user_id");
            $count17 = mysqli_num_rows($query17);
            if(empty($count17)){ ?>
              <tr>
                <td colspan="6">No data to display in the table</td>
              </tr>
            <?php }else{
              while($row17 = mysqli_fetch_assoc($query17)){ ?>
                <tr>
                  <td><?php echo $row17['subject_code']; ?></td>
                  <td><?php echo $row17['subject_description']; ?></td>
                  <td><?php echo $row17['last_name'].", ".$row17['first_name']; ?></td>
                  <td><?php echo $row17['unit']; ?></td>
                  <td><?php echo $row17['day']; ?></td>
                  <td><?php echo $row17['time']; ?></td>
                  <td><?php echo $row17['room']; ?></td>
                </tr>
              <?php }
            }
          ?>
        </table>
      </div>
    </diV>

    <div class="row" style="margin-top: 40px">
      <div class="col-md-12 subject_list_div">
        <span style="font-size: 20px;
        display: block;
        font-weight: 700;
        margin-bottom: 10px">Class Timothy - Third Year</span>
        <table class="table table-bordered">
          <tr>
            <th>SUBJ. CODE</th>
            <th>SUBJECT TITLE</th>
            <th>INSTRUCTOR</th>
            <th>UNITS</th>
            <th>DAYS</th>
            <th>TIME</th>
            <th>ROOM</th>
          </tr>

          <?php
            $query18 = mysqli_query($conn, "select a.*, b.section_id, c.year_id, d.year_id, e.last_name, e.first_name from subjects a, subject_sections b, subject_years c, users e, year d where a.subject_id=b.subject_id and a.subject_id=c.subject_id and c.year_id=d.yearID and d.year_id='3' and b.section_id='Timothy' and a.sy='17' and a.instructor=e.user_id");
            $count18 = mysqli_num_rows($query18);
            if(empty($count18)){ ?>
              <tr>
                <td colspan="6">No data to display in the table</td>
              </tr>
            <?php }else{
              while($row18 = mysqli_fetch_assoc($query18)){ ?>
                <tr>
                  <td><?php echo $row18['subject_code']; ?></td>
                  <td><?php echo $row18['subject_description']; ?></td>
                  <td><?php echo $row18['last_name'].", ".$row18['first_name']; ?></td>
                  <td><?php echo $row18['unit']; ?></td>
                  <td><?php echo $row18['day']; ?></td>
                  <td><?php echo $row18['time']; ?></td>
                  <td><?php echo $row18['room']; ?></td>
                </tr>
              <?php }
            }
          ?>
        </table>
      </div>
    </diV>

    <div class="row" style="margin-top: 40px">
      <div class="col-md-12 subject_list_div">
        <span style="font-size: 20px;
        display: block;
        font-weight: 700;
        margin-bottom: 10px">Class Timothy - Fourth Year</span>
        <table class="table table-bordered">
          <tr>
            <th>SUBJ. CODE</th>
            <th>SUBJECT TITLE</th>
            <th>INSTRUCTOR</th>
            <th>UNITS</th>
            <th>DAYS</th>
            <th>TIME</th>
            <th>ROOM</th>
          </tr>

          <?php
            $query19 = mysqli_query($conn, "select a.*, b.section_id, c.year_id, d.year_id, e.last_name, e.first_name from subjects a, subject_sections b, subject_years c, users e, year d where a.subject_id=b.subject_id and a.subject_id=c.subject_id and c.year_id=d.yearID and d.year_id='4' and b.section_id='Timothy' and a.sy='17' and a.instructor=e.user_id");
            $count19 = mysqli_num_rows($query19);
            if(empty($count19)){ ?>
              <tr>
                <td colspan="6">No data to display in the table</td>
              </tr>
            <?php }else{
              while($row19 = mysqli_fetch_assoc($query19)){ ?>
                <tr>
                  <td><?php echo $row19['subject_code']; ?></td>
                  <td><?php echo $row19['subject_description']; ?></td>
                  <td><?php echo $row19['last_name'].", ".$row19['first_name']; ?></td>
                  <td><?php echo $row19['unit']; ?></td>
                  <td><?php echo $row19['day']; ?></td>
                  <td><?php echo $row19['time']; ?></td>
                  <td><?php echo $row19['room']; ?></td>
                </tr>
              <?php }
            }
          ?>
        </table>
      </div>
    </diV>

    <div class="row" style="margin-top: 40px">
      <div class="col-md-12 subject_list_div">
        <span style="font-size: 20px;
        display: block;
        font-weight: 700;
        margin-bottom: 10px">Class Titus</span>
        <table class="table table-bordered">
          <tr>
            <th>SUBJ. CODE</th>
            <th>SUBJECT TITLE</th>
            <th>INSTRUCTOR</th>
            <th>UNITS</th>
            <th>DAYS</th>
            <th>TIME</th>
            <th>ROOM</th>
          </tr>

          <?php
            $query20 = mysqli_query($conn, "select a.*, b.section_id, c.first_name, c.last_name from subjects a, subject_sections b, users c where a.subject_id=b.subject_id and b.section_id='Titus' and a.sy='17' and a.instructor=c.user_id");
            $count20 = mysqli_num_rows($query20);
            if(empty($count20)){ ?>
              <tr>
                <td colspan="6">No data to display in the table</td>
              </tr>
            <?php }else{
              while($row20 = mysqli_fetch_assoc($query20)){ ?>
                <tr>
                  <td><?php echo $row20['subject_code']; ?></td>
                  <td><?php echo $row20['subject_description']; ?></td>
                  <td><?php echo $row20['last_name'].", ".$row20['first_name']; ?></td>
                  <td><?php echo $row20['unit']; ?></td>
                  <td><?php echo $row20['day']; ?></td>
                  <td><?php echo $row20['time']; ?></td>
                  <td><?php echo $row20['room']; ?></td>
                </tr>
              <?php }
            }
          ?>
        </table>
        <p><strong>Recommendation: </strong> for everyone, and best recommendation for preachers, pastor, bible teachers, alumni, Sunday-school teacher, and etc.</p>
      </div>
    </diV>

    <div class="row" style="margin-top: 40px">
      <div class="col-md-12 subject_list_div">
        <span style="font-size: 20px;
        display: block;
        font-weight: 700;
        margin-bottom: 10px">Class Paul</span>
        <table class="table table-bordered">
          <tr>
            <th>SUBJ. CODE</th>
            <th>SUBJECT TITLE</th>
            <th>INSTRUCTOR</th>
            <th>UNITS</th>
            <th>DAYS</th>
            <th>TIME</th>
            <th>ROOM</th>
          </tr>

          <?php
            $query21 = mysqli_query($conn, "select a.*, b.section_id, c.first_name, c.last_name from subjects a, subject_sections b, users c where a.subject_id=b.subject_id and b.section_id='Paul' and a.sy='17' and a.instructor=c.user_id");
            $count21 = mysqli_num_rows($query21);
            if(empty($count21)){ ?>
              <tr>
                <td colspan="6">No data to display in the table</td>
              </tr>
            <?php }else{
              while($row21 = mysqli_fetch_assoc($query21)){ ?>
                <tr>
                  <td><?php echo $row21['subject_code']; ?></td>
                  <td><?php echo $row21['subject_description']; ?></td>
                  <td><?php echo $row21['last_name'].", ".$row21['first_name']; ?></td>
                  <td><?php echo $row21['unit']; ?></td>
                  <td><?php echo $row21['day']; ?></td>
                  <td><?php echo $row21['time']; ?></td>
                  <td><?php echo $row21['room']; ?></td>
                </tr>
              <?php }
            }
          ?>
        </table>
        <p><strong>Recommendation: </strong> for AVPI graduates only</p>
      </div>
    </diV>

    <div class="row" style="margin-top: 40px">
      <div class="col-md-12 subject_list_div">
        <span style="font-size: 20px;
        display: block;
        font-weight: 700;
        margin-bottom: 10px">ELectives</span>
        <table class="table table-bordered">
          <tr>
            <th>SUBJ. CODE</th>
            <th>SUBJECT TITLE</th>
            <th>INSTRUCTOR</th>
            <th>UNITS</th>
            <th>DAYS</th>
            <th>TIME</th>
            <th>ROOM</th>
          </tr>

          <?php
            $query21 = mysqli_query($conn, "select a.*, b.section_id, c.first_name, c.last_name from subjects a, subject_sections b, users c where a.subject_id=b.subject_id and b.section_id='EL' and a.sy='17' and a.instructor=c.user_id");
            $count21 = mysqli_num_rows($query21);
            if(empty($count21)){ ?>
              <tr>
                <td colspan="6">No data to display in the table</td>
              </tr>
            <?php }else{
              while($row21 = mysqli_fetch_assoc($query21)){ ?>
                <tr>
                  <td><?php echo $row21['subject_code']; ?></td>
                  <td><?php echo $row21['subject_description']; ?></td>
                  <td><?php echo $row21['last_name'].", ".$row21['first_name']; ?></td>
                  <td><?php echo $row21['unit']; ?></td>
                  <td><?php echo $row21['day']; ?></td>
                  <td><?php echo $row21['time']; ?></td>
                  <td><?php echo $row21['room']; ?></td>
                </tr>
              <?php }
            }
          ?>
        </table>
        <p><strong>Recommendation: </strong> for everyone</p>
      </div>
    </diV>

    <div class="row" style="margin-top: 40px">
      <div class="col-md-12 subject_list_div">
        <p><strong>Legend: </strong></p>
        <p>Gold - Tabernacle</p>
        <p>Silver - Mosomos` House</p>
        <p>Ruby - Aplaon's House</p>
        <p>Topaz - Archog's House</p>
        <p>Emerald - Guci's House</p>
        <p>Diamond - Domingo's House</p>
      </div>
    </diV>

  </div>
</body>
</html>
