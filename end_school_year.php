<?php include'php/header.php'; ?>
    
<section class="content-header">
  <h1>
    End School Year
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">End School Year</li>
  </ol>
</section>

<section class="content">

  <?php
    if(isset($_POST['end_school_year'])){ ?>

      <?php
        $query = mysqli_query($conn, "select * from grade where status='0'");
        $count = mysqli_num_rows($query);

        if(empty($count)){
          $query4 = mysqli_query($conn, "select * from grade");
          $students = [];
          $failed_students = [];
          $passed_students = [];
          $if_passed = "yes";
          while($row4 = mysqli_fetch_assoc($query4)){
            $students[] = $row4;
      
            if($row4['remark'] == "Passed"){
              $passed_students[] = $row4;
            }

            if($row4['remark'] == "Failed"){
              $if_passed = "no";
              $failed_students[] = $row4;
            }
          }

          $passed_student_number = [];
          foreach ($passed_students as $key => $value) {
            $passed_student_number[] = $value['student_number'];
          }

          foreach (array_unique($passed_student_number) as $key => $value) {
            $query5 = mysqli_query($conn, "select * from students where student_number='$value'") or die(mysqli_error($conn));
            $row5 = mysqli_fetch_assoc($query5);

            $yearID = "";
            $year = "";
            if($row5['yearID'] == '2'){
              $yearID = '3';
              $year = '2';
            }else if($row5['yearID'] == '3'){
              $yearID = '4';
              $year = '3';
            }else if($row5['yearID'] == '4'){
              $yearID = '5';
              $year = '4';
            }else if($row5['yearID'] == '5'){
              $yearID = '10';
              $year = '1';
            }else if($row5['yearID'] == '6'){
              $yearID = '7';
              $year = '2';
            }else if($row5['yearID'] == '7'){
              $yearID ='8';
              $year = '3';
            }else if($row5['yearID'] == '8'){
              $yearID = '9';
              $year = '4';
            }else if($row5['yearID'] == '9'){
              $yearID = '10';
              $year = '1';
            }else if($row5['yearID'] == '10'){
              $yearID = '11';
              $year = '2';
            }

            mysqli_query($conn, "update students set year='$year', yearID='$yearID', student_status='Pre-Registered' where student_number='$value'") or die(mysqli_error($conn));
          }

          $failed_student_number = [];
          foreach ($failed_students as $key => $value) {
            $failed_student_number[] = $value['student_number'];
          }

          foreach (array_unique($failed_student_number) as $key => $value) {
            mysqli_query($conn, "update students set year=year-1, yearID=yearID-1, student_status='Pre-Registered' where student_number='$value'") or die(mysqli_error($conn));
          }


        }else{ ?>   

          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Finalized subjects first</h4>
            <ul>
              <?php
                $query2 = mysqli_query($conn, "select distinct(subject_id) from grade where status='0'");
                while($row2 = mysqli_fetch_assoc($query2)){
                  $query3 = mysqli_query($conn, "select * from subjects where subject_id='".$row2['subject_id']."'");
                  $row3 = mysqli_fetch_assoc($query3);

                  ?>
                    <li><a href="grade.php?id=<?php echo $row2['subject_id']; ?>"><?php echo $row3['subject_description']; ?></a></li>
                  <?php

                }
              ?>
              
            </ul>
          </div>

        <?php } ?>

    <?php }
  ?>

  

  <div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <button type="submit" name="end_school_year" class="btn btn-primary btn-lg" style="padding: 20px 40px">End School Year</button>
      </form>
    </div>
  </div>
  

</section>
    
<?php include'php/footer.php'; ?>