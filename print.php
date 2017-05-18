<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<style>
  .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover{color: #333; background-color: #fff}
  .nav-stacked>li.active>a, .nav-stacked>li.active>a:hover{border-left-color: rgba(58, 39, 22, 0.8); }
  #masterFileTbl_filter{display: none;}
  dt{text-align: left !important}
  dd{margin-bottom: 10px !important}
  #masterFileTbl th, td{white-space: nowrap;}
  #classRecordTbl th, td{white-space: nowrap;}
  #classRecordTbl th{text-align: center}
  #divSubjectByYear span{display: block; font-size: 20px; font-weight: 700; margin-bottom: 10px;}
</style>

<section class="content-header">
  <h1>
    Print Files
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Print</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-3">
      <div class="box">
        <div class="box-body">
          <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a href="#tab_1" data-toggle="tab">Assessment Form</a></li>
            <li role="presentation"><a href="#tab_2" data-toggle="tab">Certificate</a></li>
            <li role="presentation"><a href="#tab_8" data-toggle="tab">Class Record</a></li>
            <li role="presentation"><a href="#tab_3" data-toggle="tab">Grades</a></li>
            <li role="presentation"><a href="#tab_9" data-toggle="tab">Grade Sheet</a></li>
            <li role="presentation"><a href="#tab_4" data-toggle="tab">Instructors</a></li>
            <li role="presentation"><a href="#tab_5" data-toggle="tab">Subjects</a></li>
            <li role="presentation"><a href="#tab_6" data-toggle="tab">TOR</a></li>
            <li role="presentation"><a href="#tab_7" data-toggle="tab">Master File</a></li>
          </ul>
        </div>
    </div>
  </div>

  <div class="col-md-9">
    <div class="box">
        <div class="box-body">
          <div class="tab-content">

            <div class="tab-pane active" id="tab_1">
              <div class="">
                <a href="print_files/assessment_form_all.php" class="btn btn-default btn-xs" target="_blank" data-toggle='tooltip' title="Print All"><i class="fa fa-print"></i></a>
              </div>
              <table id="assessmentForm" class="table table-bordered table-hover">
                <thead>
                  <th>Name of Student</th>
                  <th>Section & Year</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php
                    $query = mysqli_query($conn, "select * from students where student_status='Enrolled'");
                    while($row = mysqli_fetch_assoc($query)){
                      ?>
                        <tr>
                          <td><?php echo $row['last_name'].", ".$row['first_name']; ?></td>
                          <td><?php echo $row['section']."-".$row['year']; ?></td>
                          <td align="center">
                            <a href="print_files/assessment_form.php?q=<?php echo $row['student_number']; ?>" target="_blank" class="btn btn-default btn-xs" data-toggle="tooltip" title="Print Assessment Form"><i class="fa fa-print"></i></a>
                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>

            <div class="tab-pane" id="tab_2">
              <h1>tab 2</h1>
            </div>

            <div class="tab-pane" id="tab_3">
              <table id="gradeTbl" class="table table-bordered table-hover">
                <thead>
                  <th>Subject Code</th>
                  <th>Subject Title</th>
                  <th>Instructor</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php
                    $query10 = mysqli_query($conn, "select a.*, b.* from subjects a, users b where a.instructor=b.user_id");
                    while($row10 = mysqli_fetch_assoc($query10)){
                      ?>
                        <tr>
                          <td><?php echo $row10['subject_code']; ?></td>
                          <td><?php echo $row10['subject_description']; ?></td>
                          <td><?php echo $row10['first_name']." ".$row10['last_name']; ?></td>
                          <td align="center">
                            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#gradeModal" data-grades="<?php echo $row10['subject_id']; ?>"><i class="fa fa-eye" data-toggle="tooltip" title="View Subject"></i></button>
                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>

            <div class="tab-pane" id="tab_4">
              <div class="row">
                <div class="col-md-12 text-right">
                  <a href="print_files/instructor.php" class="btn btn-default" data-toggle="tooltip" title="Print Instructors" onclick="window.open(this.href,'targetWindow', 'width=1000, height=600'); return false;"><i class="fa fa-print"></i></a>
                </div>
              </div>
              <table id="instructorTbl" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Church</th>
                    <th>Student Enrolled</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query6 = mysqli_query($conn, "select * from users where user_type='instructor'");
                    while($row6 = mysqli_fetch_assoc($query6)){
                      $query12 = mysqli_query($conn, "select * from church where church_id='".$row6['church']."'");
                      $row12 = mysqli_fetch_assoc($query12);
                      $query13 = mysqli_query($conn, "select * from students where church='".$row12['church_id']."'");
                      $count13 = mysqli_num_rows($query13);
                      ?>
                        <tr>
                          <td><?php echo $row6['last_name'].", ".$row6['first_name']; ?></td>
                          <td><?php echo $row12['church_name']; ?></td>
                          <td><?php echo $count13; ?></td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>

            <div class="tab-pane" id="tab_5">
              <h3 class="text-right">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" style="width: 100px; height: 25px; font-size: 12px; padding: 3px;" onchange="selectSubjectByYear(value)">
                      <?php for ($i=14; $i <= date('y') ; $i++) { ?>

                        <option value="<?php echo $i; ?>" <?php if(date('y') == $i){ echo "selected"; } ?>>20<?php echo $i; ?></option>

                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <a href="print_files/subjects.php?id=17" class="btn btn-default btn-xs" id="print_subject_link" target="_blank" data-toggle="tooltip" title="Print Subjects" ><i class="fa fa-print"></i></a>
                  </div>
                </div>

              </h3>
              <div id="divSubjectByYear">
                <span class="subject_title">Class Timothy - First Year</span>
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

                <span class="subject_title">Class Timothy - Second Year</span>
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

                <span class="subject_title">Class Timothy - Third Year</span>
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

                <span class="subject_title">Class Timothy - Fourth Year</span>
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

                <span class="subject_title">Class Titus</span>
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

                <span class="subject_title">Class Paul</span>
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

                <span class="subject_title">Electives</span>
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

              </div>

            </div>

            <div class="tab-pane" id="tab_6">
              <table id="torTbl" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Year Graduated</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query7 = mysqli_query($conn, "select * from students where year='graduate'");
                    while($row7 = mysqli_fetch_assoc($query7)){
                      ?>
                        <tr>
                          <td><?php echo $row7['last_name'].", ".$row7['first_name']; ?></td>
                          <td><?php echo "20".$row7['sy']+4; ?></td>
                          <td align="center">
                            <a href="print_files/tor.php?id=<?php echo $row7['student_number']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Print TOR" onclick="window.open(this.href,'targetWindow', 'width=1000, height=600'); return false;"><i class="fa fa-print"></i></a>
                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>

            <div class="tab-pane" id="tab_7">
              <div class="row">
                <div class="col-md-4">
                  <div class="input-group">
                    <input type="text" class="form-control" id="myInput" placeholder="Search">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#advancedSearchModal"><i class="fa fa-gear" data-toggle="tooltip" title="Advanced Search"></i></button>
                    </div>
                  </div>
                </div>
                <div class="col-md-8 text-right">
                  <a href="print_files/masterfile.php?student_number&name&section&course&church&sy&subject_1&subject_2&subject_3&subject_4&subject_5&subject_6" id="printMasterFileLink" class="btn btn-default" onclick="window.open(this.href,'targetWindow', 'width=1000, height=600'); return false;"><i class="fa fa-print" data-toggle="tooltip" title="Print List"></i></a>
                </div>
              </div>
              <div class="table-responsive">
              <table id="masterFileTbl" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Section</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Church</th>
                    <th>Enroll Year</th>
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
                    $query2 = mysqli_query($conn, "select * from students");
                    while($row2 = mysqli_fetch_assoc($query2)){
                      $church = mysqli_fetch_assoc(mysqli_query($conn, "select * from church where church_id='".$row2['church']."'"));
                      $query8 = mysqli_query($conn, "select * from student_subject where student_number='".$row2['student_number']."' and year='".$row2['year']."'") or die(mysqli_error($conn));
                      $count8 = mysqli_num_rows($query8);
                      ?>
                        <tr>
                          <td><?php echo $row2['student_number']; ?></td>
                          <td><?php echo $row2['last_name']." ".$row2['first_name']; ?></td>
                          <td><?php echo $row2['section']; ?></td>
                          <td><?php echo $row2['course'] ?></td>
                          <td><?php echo $row2['year']; ?></td>
                          <td><?php echo $church['church_name']; ?></td>
                          <td><?php echo "20".$row2['sy']; ?></td>
                          <td><?php echo $row2['count']; ?></td>
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
            </div>

            <div class="tab-pane" id="tab_8">
              <div class="row">
                <div class="col-md-3">
                  <select class="form-control" id="classRecordSubjects" onchange="getClassRecordSubjectId()">
                    <?php
                      $query22 = mysqli_query($conn, "select * from subjects");
                      while($row22 = mysqli_fetch_assoc($query22)){ ?>
                        <option value="<?php echo $row22['subject_id']; ?>"><?php echo $row22['subject_code']; ?></option>
                      <?php }
                    ?>
                  </select>

                </div>
                <div class="col-md-6 col-md-offset-3 text-right">
                  <a href="print_files/class_record.php?id=196" class="btn btn-default btn-xs" target="_blank" id="classRecordPrintBtn"><i class="fa fa-print"></i></a>
                </div>
              </div>
              <div style="overflow-x: scroll; height: 500px" id="classRecordDiv">
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
                      $query15 = mysqli_query($conn, "select a.* from `students` a, student_subject b where a.student_number=b.student_number and b.subject_id='196'");
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
              </div>

            </div>

            <div class="tab-pane" id="tab_9">
              <table class="table table-bordered table-stripped" id="gradeSheetTbl">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Class/Section</th>
                    <th>Sy</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query14 = mysqli_query($conn, "select * from students");
                    while($row14 = mysqli_fetch_assoc($query14)){ ?>
                      <tr>
                        <td><?php echo $row14['last_name'].", ".$row14['first_name']." ".$row14['middle_name']; ?></td>
                        <td><?php echo $row14['course']; ?></td>
                        <td><?php echo $row14['section']." ".$row14['year']; ?></td>
                        <td><?php echo "20".$row14['sy']; ?></td>
                        <td align="center">
                          <a href="print_files/grade_sheet.php?id=<?php echo $row14['student_number']; ?>" class='btn btn-default  btn-xs' data-toggle="tooltip" title="Print Grade Sheet" target="_blank"><i class="fa fa-print"></i></a>
                        </td>
                      </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
    </div>
  </div>

</section>

<div class="modal" tabindex="-1" role="dialog" id="advancedSearchModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Advanced Search</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="advancedSearchForm">
          <dl class="dl-horizontal">
            <dt>Section</dt>
            <dd>
              <select id="section" class="form-control">
                <option value="">All</option>
                <?php
                  $query3 = mysqli_query($conn, "select * from sections");
                  while($row3 = mysqli_fetch_assoc($query3)){
                    echo '<option value="'.$row3['section_id'].'">'.$row3['section_id'].'</option>';
                  }
                ?>
              </select>
            </dd>
            <dt>Church</dt>
            <dd>
              <select id="church" class="form-control">
                <option value="">All</option>
                <?php
                  $query4 = mysqli_query($conn, "select * from church");
                  while($row4 = mysqli_fetch_assoc($query4)){
                    echo '<option value="'.$row4['church_name'].'">'.$row4['church_name'].'</option>';
                  }
                ?>
              </select>
            </dd>
            <dt>Course</dt>
            <dd>
              <select id="course" class="form-control">
                <option value="">All</option>
                <?php
                  $query5 = mysqli_query($conn, "select * from course");
                  while($row5 = mysqli_fetch_assoc($query5)){
                    echo '<option value="'.$row5['course_id'].'">'.$row5['course_id'].'</option>';
                  }
                ?>
              </select>
            </dd>
            <dt>Enrollment SY</dt>
            <dd><input type="text" class="form-control" id="sy" placeholder="Enrollment SY"></dd>
            <dt>Name</dt>
            <dd><input type="text" class="form-control" placeholder="Name" id="name"></dd>
            <dt>Student Number</dt>
            <dd><input type="text" class="form-control" placeholder="Student Number" id="student_number"></dd>
            <dt>Year</dt>
            <dd>
              <select id="year" class="form-control">
                <option value="">ALL</option>
                <?php
                  $query11 = mysqli_query($conn, "select * from year");
                  while($row11 = mysqli_fetch_assoc($query11)){
                    ?>
                      <option value="<?php echo $row11['year_id']; ?>"><?php echo $row11['year_id']; ?></option>
                    <?php
                  }
                ?>
              </select>
            </dd>
            <?php
              for ($i=1; $i <= 6 ; $i++) {
                echo "<dt>Subject ".$i."</dt>";
                $query9 = mysqli_query($conn, "select * from subjects");
                echo "<dd><select class='form-control' id='subject_$i'>";
                echo "<option value=''>All</option>";
                while($row9 = mysqli_fetch_assoc($query9)){
                  ?>
                    <option value="<?php echo $row9['subject_code']; ?>"><?php echo $row9['subject_code']; ?></option>
                  <?php
                }
                echo "</select></dd>";
              }
            ?>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="reset" class="btn btn-default" form="advancedSearchForm">Reset</button>
        <button type="button" id="addSubjectBtn" class="btn btn-primary" form="advancedSearchForm" onclick="searchMasterFile()">Search</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="gradeModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div id="gradeDiv">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="" class="btn btn-primary" id="gradeModalBtn" onclick="window.open(this.href,'targetWindow', 'width=1000, height=600'); return false;">Print</a>
      </div>
    </div>
  </div>
</div>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $('#assessmentForm').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": false,
  });

  $('#torTbl').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": false,
  });

  $('#instructorTbl').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": false,
    "autoWidth": false,
  });

  $('#gradeTbl').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": false,
    "autoWidth": false,
  });

  var table = $('#masterFileTbl').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "info": false,
    "autoWidth": false,
    'iDisplayLength': 10,
  });

  $('#gradeSheetTbl').DataTable();

  $('#classRecordTbl').DataTable({
    "bSort": false,
    "paging": false,
    "searching": false,
  })

  $('#myInput').keyup(function(){
    table.search($(this).val()).draw() ;
  })

  function searchMasterFile(){
    var print_link = "print_files/masterfile.php";
    table.column(0).search($('#student_number').val()).draw();
    table.column(1).search($('#name').val()).draw();
    table.column(2).search($('#section').val()).draw();
    table.column(3).search($('#course').val()).draw();
    table.column(4).search($('#year').val()).draw();
    table.column(5).search($('#church').val()).draw();
    table.column(6).search($('#sy').val()).draw();
    table.column(8).search($('#subject_1').val()).draw();
    table.column(9).search($('#subject_2').val()).draw();
    table.column(10).search($('#subject_3').val()).draw();
    table.column(11).search($('#subject_4').val()).draw();
    table.column(12).search($('#subject_5').val()).draw();
    table.column(13).search($('#subject_6').val()).draw();
    if(document.getElementById("student_number").value != ""){
      print_link = print_link + "?student_number=" + document.getElementById("student_number").value;
    }else{
      print_link = print_link + "?student_number";
    }
    if(document.getElementById("name").value != ""){
      print_link = print_link + "&name=" + document.getElementById("name").value;
    }else{
      print_link = print_link + "&name";
    }
    if(document.getElementById("section").value != ""){
      print_link = print_link + "&section=" + document.getElementById("section").value;
    }else{
      print_link = print_link + "&section";
    }
    if(document.getElementById("course").value != ""){
      print_link = print_link + "&course=" + document.getElementById("course").value;
    }else{
      print_link = print_link + "&course";
    }
    if(document.getElementById("year").value != ""){
      print_link = print_link + "&year=" + document.getElementById("year").value;
    }else{
      print_link = print_link + "&year";
    }
    if(document.getElementById("church").value != ""){
      print_link = print_link + "&church=" + document.getElementById("church").value;
    }else{
      print_link = print_link + "&church";
    }
    if(document.getElementById("sy").value != ""){
      print_link = print_link + "&sy=" + document.getElementById("sy").value;
    }else{
      print_link = print_link + "&sy";
    }
    if(document.getElementById("subject_1").value != ""){
      print_link = print_link + "&subject_1=" + document.getElementById("subject_1").value;
    }else{
      print_link = print_link + "&subject_1";
    }
    if(document.getElementById("subject_2").value != ""){
      print_link = print_link + "&subject_2=" + document.getElementById("subject_2").value;
    }else{
      print_link = print_link + "&subject_2";
    }
    if(document.getElementById("subject_3").value != ""){
      print_link = print_link + "&subject_3=" + document.getElementById("subject_3").value;
    }else{
      print_link = print_link + "&subject_3";
    }
    if(document.getElementById("subject_4").value != ""){
      print_link = print_link + "&subject_4=" + document.getElementById("subject_4").value;
    }else{
      print_link = print_link + "&subject_4";
    }
    if(document.getElementById("subject_5").value != ""){
      print_link = print_link + "&subject_5=" + document.getElementById("subject_5").value;
    }else{
      print_link = print_link + "&subject_5";
    }
    if(document.getElementById("subject_6").value != ""){
      print_link = print_link + "&subject_6=" + document.getElementById("subject_6").value;
    }else{
      print_link = print_link + "&subject_6";
    }

    $("#printMasterFileLink").attr("href", print_link);
    $("#advancedSearchModal").modal('hide');
  }

  $('#gradeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var grades = button.data('grades');
    $("#gradeModalBtn").attr("href", "print_files/grades.php?id=" + grades);
    $("#gradeDiv").load("php/ajax/subjectgrades.php?q=" + grades);
  });

  function selectSubjectByYear(val){
    $("#print_subject_link").attr("href", "print_files/subjects.php?id=" + val);
    $("#divSubjectByYear").load("php/ajax/showPrintSubjectByYear.php?id=" + val);
  }

  function getClassRecordSubjectId(){
    var subject_id = document.getElementById('classRecordSubjects').value;
    $('#classRecordPrintBtn').attr('href', 'print_files/class_record.php?id='+subject_id);
    $("#classRecordDiv").load('php/ajax/classrecordbysubject.php?id='+subject_id);
  }
</script>
<?php include'php/footer.php'; ?>
