<?php include'php/header.php'; ?>

<style>
  dataTables_scrollHeadInner{width: 1069px !important}
  dataTables_scrollHeadInner table{width: 1069px !important}
</style>

<?php
  if($the_user['user_type'] != "admin" && $the_user['user_type'] != "principal"){ header("Location: 404.php"); }

  function checkIfElective($subjects){
    include'php/db_connection.php';
    $ifHaveElective = 0;
    foreach ($subjects as $key => $value) {
      $query = mysqli_query($conn, "select * from subjects where subject_id='$value'");
      $row = mysqli_fetch_assoc($query);
      if($row['course'] != "ALL"){
        $ifHaveElective = 1;
      }
    }
    return 1;
    //return $ifHaveElective;
  }

  if(isset($_POST['evaluateHidden'])){
    $student_number = $_POST['student_number'];
    $year = $_POST['student_year'];
    $date = date("M d, Y");

    if(isset($_POST['subject_to_be_taken'])){
      if(!empty(checkIfElective($_POST['subject_to_be_taken']))){
        if(isset($_POST['subject_to_be_taken'])){
          foreach (array_unique($_POST['subject_to_be_taken']) as $key => $value) {
            mysqli_query($conn, "insert into student_subject(subject_id, sy, student_number, year) values('$value', '$school_year_start','$student_number', '$year')") or die(mysqli_error($conn));
          }
        }

        mysqli_query($conn, "update students set student_status='Enrolled', date_enrolled='$date' where student_number='$student_number'") or die(mysqli_query($conn));
        mysqli_query($conn, "insert into logs(name, user_type, action, date, time, ip_address) values('".$the_user['first_name']." ".$the_user['last_name']."', '".$the_user['user_type']."', 'Enroll a student', '".date("M-d-Y")."', '".date("h:i A")."', '".$_SERVER['REMOTE_ADDR']."')") or die(mysqli_error($conn));
        if($year == '1'){
          echo "
            <script>
              alert('Student Enrolled.');
              open('enrollment.php', '_self');
            </script>
          ";
        }else{
          echo "
            <script>
              alert('Student Enrolled.');
              open('enrollment.php', '_self');
            </script>
          ";
        }
      }else{
        echo "
          <script>
            alert('Student must have atleast 1 Elective.');
            open('enrollment.php', '_self');
          </script>
        ";
      }
    }else{
      echo "
        <script>
          alert('Cant enroll student.');
          open('enrollment.php', '_self');
        </script>
      ";
    }

  }

?>

<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<style>
  .nav-tabs-custom>.nav-tabs>li.active {
    border-top-color: rgba(58, 39, 22, 0.7) !important;
  }
</style>
<section class="content-header">
  <h1>
    Enrollment
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Enrollment</li>
  </ol>
</section>

<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Pre-Registered</a></li>
          <li><a href="#tab_2" data-toggle="tab">2nd Year</a></li>
          <li><a href="#tab_3" data-toggle="tab">3rd Year</a></li>
          <li><a href="#tab_4" data-toggle="tab">4th Year</a></li>
          <li><a href="#tab_5" data-toggle="tab">Paul</a></li>
          <!-- <li><a href="#tab_6" data-toggle="tab">Paul 2</a></li> -->
          <li><a href="#tab_8" data-toggle="tab">Titus</a></li>
          <li><a href="#tab_7" data-toggle="tab">All Student</a></li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <table id="pre-registeredTbl" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Student #</th>
                  <th>Name of Student</th>
                  <th>Course</th>
                  <th>Year & Section</th>
                  <th>Church</th>
                  <th>Pastor</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query = mysqli_query($conn, "select * from students where yearID='2' and student_status='Pre-Registered' and account_status='1'");
                  while($row = mysqli_fetch_assoc($query)){
                    $church = mysqli_fetch_assoc(mysqli_query($conn, "select * from church where church_id='".$row['church']."'"));
                    ?>
                      <tr>
                        <td><?php echo $row['student_number']; ?></td>
                        <td><?php echo $row['last_name']." ".$row['first_name']." ".$row['suffix_name']; ?></td>
                        <td><?php echo $row['course']; ?></td>
                        <td><?php echo $row['year']."-".$row['section']; ?></td>
                        <td><?php echo $church['church_name']; ?></td>
                        <td><?php echo $church['pastor']; ?></td>
                        <td align="center">
                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#evaluateModal" data-studentid="<?php echo $row['student_number']; ?>">Evaluate</button>
                        </td>
                      </tr>
                    <?php
                  }
                ?>
              </tbody>
            </table>
          </div>

          <div class="tab-pane" id="tab_2">
            <table id="year2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Student #</th>
                  <th>Name of Student</th>
                  <th>Course</th>
                  <th>Year & Section</th>
                  <th>Church</th>
                  <th>Pastor</th>
                  <th></th>
                </tr>

              </thead>
              <tbody>
                <?php
                  $query2 = mysqli_query($conn, "select * from students where yearID='3' and student_status='Pre-Registered' and account_status='1'");
                  while($row2 = mysqli_fetch_assoc($query2)){
                    $church2 = mysqli_fetch_assoc(mysqli_query($conn, "select * from church where church_id='".$row2['church']."'"));
                    ?>
                      <tr>
                        <td><?php echo $row2['student_number']; ?></td>
                        <td><?php echo $row2['last_name']." ".$row2['first_name']." ".$row2['suffix_name']; ?></td>
                        <td><?php echo $row2['course']; ?></td>
                        <td><?php echo $row2['year']."-".$row2['section']; ?></td>
                        <td><?php echo $church2['church_name']; ?></td>
                        <td><?php echo $church2['pastor']; ?></td>
                        <td align="center">
                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#evaluateModal" data-studentid="<?php echo $row2['student_number']; ?>">Evaluate</button>
                        </td>
                      </tr>
                    <?php
                  }
                ?>
              </tbody>
            </table>
          </div>

          <div class="tab-pane" id="tab_3">
            <table id="year3" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Student #</th>
                  <th>Name of Student</th>
                  <th>Course</th>
                  <th>Year & Section</th>
                  <th>Church</th>
                  <th>Pastor</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query3 = mysqli_query($conn, "select * from students where yearID='4' and student_status='Pre-Registered' and account_status='1'");
                  while($row3 = mysqli_fetch_assoc($query3)){
                    $church3 = mysqli_fetch_assoc(mysqli_query($conn, "select * from church where church_id='".$row3['church']."'"));
                    ?>
                      <tr>
                        <td><?php echo $row3['student_number']; ?></td>
                        <td><?php echo $row3['last_name']." ".$row3['first_name']." ".$row3['suffix_name']; ?></td>
                        <td><?php echo $row3['course']; ?></td>
                        <td><?php echo $row3['year']."-".$row3['section']; ?></td>
                        <td><?php echo $church3['church_name']; ?></td>
                        <td><?php echo $church3['pastor']; ?></td>
                        <td align="center">
                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#evaluateModal" data-studentid="<?php echo $row3['student_number']; ?>">Evaluate</button>
                        </td>
                      </tr>
                    <?php
                  }
                ?>
              </tbody>
            </table>
          </div>

          <div class="tab-pane" id="tab_4">
            <table id="year4" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Student #</th>
                  <th>Name of Student</th>
                  <th>Course</th>
                  <th>Year & Section</th>
                  <th>Church</th>
                  <th>Pastor</th>
                  <th></th>
                </tr>

              </thead>
              <tbody>
                <?php
                  $query4 = mysqli_query($conn, "select * from students where yearID='5' and student_status='Pre-Registered' and account_status='1'");
                  while($row4 = mysqli_fetch_assoc($query4)){
                    $church4 = mysqli_fetch_assoc(mysqli_query($conn, "select * from church where church_id='".$row4['church']."'"));
                    ?>
                      <tr>
                        <td><?php echo $row4['student_number']; ?></td>
                        <td><?php echo $row4['last_name']." ".$row4['first_name']." ".$row4['suffix_name']; ?></td>
                        <td><?php echo $row4['course']; ?></td>
                        <td><?php echo $row4['year']."-".$row4['section']; ?></td>
                        <td><?php echo $church4['church_name']; ?></td>
                        <td><?php echo $church4['pastor']; ?></td>
                        <td align="center">
                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#evaluateModal" data-studentid="<?php echo $row4['student_number']; ?>">Evaluate</button>
                        </td>
                      </tr>
                    <?php
                  }
                ?>
              </tbody>
            </table>
          </div>

          <div class="tab-pane" id="tab_5">
            <table id="year5" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Student #</th>
                  <th>Name of Student</th>
                  <th>Course</th>
                  <th>Year & Section</th>
                  <th>Church</th>
                  <th>Pastor</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query9 = mysqli_query($conn, "select * from year where year_description like '%paul%'");
                  $row9 = mysqli_fetch_assoc($query9);

                  $query5 = mysqli_query($conn, "select * from students where yearID='".$row9['yearID']."' and student_status='Pre-Registered' and account_status='1'");
                  while($row5 = mysqli_fetch_assoc($query5)){
                    $church5 = mysqli_fetch_assoc(mysqli_query($conn, "select * from church where church_id='".$row5['church']."'"));
                    ?>
                      <tr>
                        <td><?php echo $row5['student_number']; ?></td>
                        <td><?php echo $row5['last_name']." ".$row5['first_name']." ".$row5['suffix_name']; ?></td>
                        <td><?php echo $row5['course']; ?></td>
                        <td><?php echo $row5['year']."-".$row5['section']; ?></td>
                        <td><?php echo $church5['church_name']; ?></td>
                        <td><?php echo $church5['pastor']; ?></td>
                        <td align="center">
                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#evaluateModal" data-studentid="<?php echo $row5['student_number']; ?>">Evaluate</button>
                        </td>
                      </tr>
                    <?php
                  }
                ?>
              </tbody>
            </table>
          </div>

          <div class="tab-pane <?php if(isset($_GET['a']) && $_GET['a']=='8'){ echo 'active'; } ?>" id="tab_8">
            <table id="year8" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Student #</th>
                  <th>Name of Student</th>
                  <th>Course</th>
                  <th>Year & Section</th>
                  <th>Church</th>
                  <th>Pastor</th>
                  <th></th>
                </tr>

              </thead>
              <tbody>
                <?php
                  $query8 = mysqli_query($conn, "select * from year where year_description like '%titus%' ");
                  $all_titus = [];
                  while($row8 = mysqli_fetch_assoc($query8)){
                    $all_titus[] = $row8['yearID'];
                  }

                  $like_titus = "";
                  foreach ($all_titus as $key => $value) {
                    $like_titus.="yearID='".$value."' or ";
                  }
                  $like_titus_2 = rtrim($like_titus, 'or ');

                  $query2 = mysqli_query($conn, "select * from students where ($like_titus_2) and student_status='Pre-Registered' and account_status='1'");
                  while($row2 = mysqli_fetch_assoc($query2)){
                    $church2 = mysqli_fetch_assoc(mysqli_query($conn, "select * from church where church_id='".$row2['church']."'"));
                    ?>
                      <tr>
                        <td><?php echo $row2['student_number']; ?></td>
                        <td><?php echo $row2['last_name']." ".$row2['first_name']." ".$row2['suffix_name']; ?></td>
                        <td><?php echo $row2['course']; ?></td>
                        <td><?php echo $row2['year']."-".$row2['section']; ?></td>
                        <td><?php echo $church2['church_name']; ?></td>
                        <td><?php echo $church2['pastor']; ?></td>
                        <td align="center">
                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#evaluateModal" data-studentid="<?php echo $row2['student_number']; ?>">Evaluate</button>
                        </td>
                      </tr>
                    <?php
                  }
                ?>
              </tbody>
            </table>
          </div>

          <div class="tab-pane" id="tab_7">
            <table id="year7" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Student #</th>
                  <th>Name of Student</th>
                  <th>Course</th>
                  <th>Year & Section</th>
                  <th>Church</th>
                  <th>Pastor</th>
                  <th></th>
                </tr>

              </thead>
              <tbody>
                <?php
                  $query7 = mysqli_query($conn, "select * from students where student_status='Pre-Registered' and account_status='1'");
                  while($row7 = mysqli_fetch_assoc($query7)){
                    $church7 = mysqli_fetch_assoc(mysqli_query($conn, "select * from church where church_id='".$row7['church']."'"));
                    ?>
                      <tr>
                        <td><?php echo $row7['student_number']; ?></td>
                        <td><?php echo $row7['last_name']." ".$row7['first_name']." ".$row7['suffix_name']; ?></td>
                        <td><?php echo $row7['course']; ?></td>
                        <td><?php echo $row7['year']."-".$row7['section']; ?></td>
                        <td><?php echo $church7['church_name']; ?></td>
                        <td><?php echo $church7['pastor']; ?></td>
                        <td align="center">
                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#evaluateModal" data-studentid="<?php echo $row7['student_number']; ?>">Evaluate</button>
                        </td>
                      </tr>
                    <?php
                  }
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>

</section>

<div class="modal" tabindex="-1" role="dialog" id="evaluateModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <form method="post" class="form-horizontal" id="evaluateStudentForm">
        <input type="hidden" name="evaluateHidden" value="check">
        <div id="evaluateDiv"></div>
      </div>
      <div class="modal-footer">
        <a href="enrollment.php" class="btn btn-default">Close</a>
        <button type="button" class="btn btn-primary" id="evaluateStudentBtn" onclick="submitForm()">Evaluate</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="addElectiveModal">
  <div class="modal-dialog modal-lg" style="margin-top: 5%">
    <div class="modal-content">
      <div class="modal-body">
        <form method="post" id="addElectiveForm">
          <div id="addElectiveDiv"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" form="addElectiveForm" onclick="addElectiveBtn()" class="btn btn-primary">Add Subject</button>
      </div>
    </div>
  </div>
</div>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $('#pre-registeredTbl').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": true,
    "scrollY": "280px"
  });

  $('a[href="#tab_2"]').one('click',function(){
    setTimeout(function(){
        $("#year2").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "scrollY": "280px"
      });
    },0);
  });

  $('a[href="#tab_3"]').one('click',function(){
    setTimeout(function(){
        $("#year3").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "scrollY": "280px"
      });
    },0);
  });

  $('a[href="#tab_4"]').one('click',function(){
    setTimeout(function(){
        $("#year4").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "scrollY": "280px"
      });
    },0);
  });

  $('a[href="#tab_5"]').one('click',function(){
    setTimeout(function(){
        $("#year5").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "scrollY": "280px"
      });
    },0);
  });

  $('a[href="#tab_6"]').one('click',function(){
    setTimeout(function(){
        $("#year6").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "scrollY": "280px"
      });
    },0);
  });

  $('a[href="#tab_7"]').one('click',function(){
    setTimeout(function(){
        $("#year7").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "scrollY": "280px"
      });
    },0);
  });

  $('a[href="#tab_8"]').one('click',function(){
    setTimeout(function(){
        $("#year8").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "scrollY": "280px"
      });
    },0);
  });

  $('#evaluateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var studentid = button.data('studentid');
    console.log(studentid);
    $("#evaluateDiv").load("php/ajax/showpreregistered.php?q=" + studentid);
  });

  $('#addElectiveModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var studno = button.data('studno');
    $("#addElectiveDiv").load("php/ajax/addelective.php?q=" + studno);
  });

  function removeDuplicateRows($table){
    function getVisibleRowText($row){
        return $row.find('td:visible').text().toLowerCase();
    }

    $table.find('tr').each(function(index, row){
        var $row = $(row);
        $row.nextAll('tr').each(function(index, next){
            var $next = $(next);
            if(getVisibleRowText($next) == getVisibleRowText($row))
                $next.remove();
        })
    });
  }

  function addElectiveBtn(){
    var div = document.getElementById('addElectiveHiddenDiv');
    var cboxes = document.getElementsByName('subject[]');
    var len = cboxes.length;
    for (var i=0; i<len; i++) {
      if(cboxes[i].checked == true){

        $.ajax({
          type: "POST",
          url: "php/ajax/addelectivetotable.php",
          data: 'q='+cboxes[i].value,
          dataType: 'json',
          success: function(msg){

            //div.innerHTML = div.innerHTML + '<input type="hidden" value="'+ msg.subject_id +'" name="subject_to_be_taken[]">';

            $('#preRegisteredSubjectTbl tr').last().after('<tr><td><input type="hidden" value="'+ msg.subject_id +'" name="subject_to_be_taken[]">'+ msg.subject_code +'</td><td>'+ msg.subject_title +'</td><td>'+ msg.unit +'</td><td>'+ msg.day +'</td><td>'+ msg.time +'</td><td>'+ msg.room +'</td><td><button type="button" class="btn btn-danger btn-xs" id="preRegisteredTblDeleteSubject"><i class="fa fa-times" data-toggle="tooltip" title="Remove Subject"></i></button></td></tr>');

            $('#no_subjects_to_display').css('display', 'none');

            removeDuplicateRows($('#preRegisteredSubjectTbl'));

          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
          }
        });
      }
    }
    $("#addElectiveModal").hide();
  }

  function submitForm(){
    document.getElementById("evaluateStudentBtn").disabled = true;
    document.getElementById("evaluateStudentForm").submit();
  }
</script>
<?php include'php/footer.php'; ?>
