<?php

include'../db_connection.php';

$key = $_GET['q'];
$query = mysqli_query($conn, "select * from students where student_number='".$key."'");
$row = mysqli_fetch_assoc($query);

if($row['image_path'] != "image/default_student.png"){
$img_src = $row['image_path'];
}else{
$img_src = "image/default_student.png";
}

?>

<style>
  .nav-tabs-custom>.nav-tabs>li.active{border-top-color: rgba(58, 39, 22, 0.8);;}
</style>

<input type="hidden" name="viewStudentHidden" value="<?php echo $row['student_number']; ?>">
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom" style="box-shadow: none;">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Info</a></li>
              <li><a href="#tab_2" data-toggle="tab">Subject</a></li>
              <li><a href="#tab_3" data-toggle="tab">Student Archives</a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              <input type="hidden" name="student_number_hidden" value="<?php echo $row['student_number']; ?>">
              <input type="hidden" name="image_path_hidden" value="<?php echo $row['image_path']; ?>">
              <div class="row" style="margin-top: 5%;position: relative;">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Student Number</label>
                    <input type="text" name="student_number" id="student_number" class="form-control" placeholder="Student Number" value="<?php echo $row['student_number']; ?>" disabled >
                  </div>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4" style="position: absolute;right: 0;top: -45px;text-align: center;">
                  <img src="<?php echo $img_src; ?>" id="image_upload_preview2" width="100" height="100" alt="User Image" style="border-radius: 100px">
                </div>
              </div>

              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?php echo $row['last_name']; ?>" disabled >
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?php echo $row['first_name']; ?>" disabled >
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $row['middle_name']; ?>" disabled >
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Suffix Name</label>
                    <input type="text" name="suffix_name" class="form-control" placeholder="Suffix Name" value="<?php echo $row['suffix_name']; ?>" disabled >
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Gender</label><br>
                    <label class="radio-inline">
                      <input type="radio" name="gender" value="Male" <?php if($row['gender'] == "Male"){ echo "checked"; } ?> > Male
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="gender" value="Female" <?php if($row['gender'] == "Female"){ echo "checked"; } ?> > Female
                    </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Birthdate</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="birthdate" class="form-control pull-right" id="datepicker2" value="<?php echo $row['birthdate']; ?>" disabled >
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Age</label>
                    <input type="text" name="age" id="age" class="form-control" placeholder="Age" value="<?php echo $row['age']; ?>" disabled >
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Contact Number" value="<?php echo $row['contact_number']; ?>" disabled >
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" value="<?php echo $row['email_address']; ?>" disabled >
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control" disabled >
                      <option value="">Status</option>
                      <option value="Single" <?php if($row['status'] == "Single"){ echo "selected"; } ?> >Single</option>
                      <option value="Married" <?php if($row['status'] == "Married"){ echo "selected"; } ?> >Married</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Course</label>
                    <select name="course" id="course" class='form-control' disabled >
                      <option value="">Select</option>
                      <?php
                      $query2 = mysqli_query($conn, "select * from course");
                      while($row2 = mysqli_fetch_assoc($query2)){
                        ?>
                          <option value="<?php echo $row2['course_id']; ?>" <?php if($row2['course_id'] == $row['course']){ echo "selected"; } ?> ><?php echo $row2['course_description']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Section</label>
                    <select name="section" id="section" class='form-control' disabled >
                      <option value="">Select</option>
                      <?php
                      $query3 = mysqli_query($conn, "select * from sections");
                      while($row3 = mysqli_fetch_assoc($query3)){
                        ?>
                          <option value="<?php echo $row3['section_id']; ?>" <?php if($row3['section_id'] == $row['section']){ echo "selected"; } ?> ><?php echo $row3['section_description']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Year</label>
                    <select name="year" id="year" class='form-control' disabled >
                      <option value="">Select</option>
                      <?php
                      $query4 = mysqli_query($conn, "select * from year");
                      while($row4 = mysqli_fetch_assoc($query4)){
                        ?>
                          <option value="<?php echo $row4['yearID']; ?>" <?php if($row4['yearID'] == $row['yearID']){ echo "selected"; } ?> ><?php echo $row4['year_description']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8">
                  <label>Church</label>
                  <select name="church" id="church" class="form-control" disabled >
                    <option value="">Select</option>
                    <?php
                      $query5 = mysqli_query($conn, "select * from church") or die(mysqli_error($conn));
                      while($row5 = mysqli_fetch_assoc($query5)){
                        ?>
                          <option value="<?php echo $row5['church_id']; ?>" <?php if($row5['church_id'] == $row['church']){ echo "selected"; } ?> ><?php echo $row5['church_name']; ?></option>
                        <?php
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label>S.Y.</label>
                  <input type="text" name="sy" id="sy" class="form-control" placeholder="SY" value="20<?php echo $row['sy']; ?>" disabled >
                </div>
              </div>

              </div>

              <div class="tab-pane" id="tab_2">

                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-bordered">
                      <tr>
                        <th>Subject Code</th>
                        <th>Subject Title</th>
                        <th>Units</th>
                        <th>Days</th>
                        <th>Time</th>
                        <th>Room</th>
                      </tr>
                      <?php
                        if($row['student_status'] == "Pre-Registered"){
                          ?>
                            <tr>
                              <td colspan="6">Student not yet enrolled</td>
                            </tr>
                          <?php
                        }else{
                          $query2 = mysqli_query($conn, "select a.*, b.*, c.* from student_subject a, students b, subjects c where a.student_number = b.student_number and a.year=b.year and a.subject_id = c.subject_id and a.student_number = '".$row['student_number']."' order by start_time") or die(mysqli_error($conn));
                          while($row2 = mysqli_fetch_assoc($query2)){
                            ?>
                              <tr>
                                <td><?php echo $row2['subject_code']; ?></td>
                                <td><?php echo $row2['subject_description']; ?></td>
                                <td><?php echo $row2['unit']; ?></td>
                                <td><?php echo $row2['day']; ?></td>
                                <td><?php echo preg_replace("/[^0-9-:\/]+/", "", $row2['time']); ?></td>
                                <td><?php echo $row2['room']; ?></td>
                              </tr>
                            <?php
                          }
                        }
                      ?>
                    </table>
                    <div class="text-right">
                      <?php if($row['student_status'] != "Pre-Registered"){ ?>
                      <button type="submit" class="btn btn-danger" form="viewStudentForm">Unenroll</button>
                      <?php } ?>
                    </div>
                  </div>
                </div>

              </div>

              <div class="tab-pane" id="tab_3">
                <table class="table table-bordered" id="defaultTbl">
                  <thead>
                    <tr>
                      <th>Subject Code</th>
                      <th>Subject Description</th>
                      <th>Unit</th>
                      <th>Sy</th>
                      <th>Time</th>
                      <th>Day</th>
                      <th>Room</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      for ($i=14; $i <= date('y'); $i++) { 
                        if($i != date('y')){
                          $query6 = mysqli_query($conn, "select * from student_subject where sy='$i' and student_number='$key'");
                          while($row6 = mysqli_fetch_assoc($query6)){ ?>
                            <tr>
                              <td>Subject Code</td>
                              <td>Subject Description</td>
                              <td>Unit</td>
                              <td>Sy</td>
                              <td>Time</td>
                              <td>Day</td>
                              <td>Room</td>
                            </tr>
                          <?php }
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div>

            </div>

        </div>
  </div>
</div>