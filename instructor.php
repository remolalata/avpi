<?php include'php/header.php'; ?>

<?php

function instructors(){
  include'php/db_connection.php';
  $result = array();
  $query = mysqli_query($conn, "select * from users where user_type='instructor'");
  while($row = mysqli_fetch_assoc($query)){
    $result[] = $row;
  }

  return $result;
}

?>
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <section class="content-header">
      <h1>
        Instructor
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Instructor Load</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">

        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Instructor</label>
                <select id="instructor" class="form-control select2">
                  <option value="">Select Instructor</option>
                  <?php
                    foreach (instructors() as $value) {
                      ?>
                        <option value="<?php echo $value['user_id']; ?>" <?php if($value['username'] == "rquirante"){ echo "selected"; } ?> ><?php echo $value['last_name'].", ".$value['first_name']; ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>School Year</label>
                <select id="sy" class="form-control">
                  <option value="">All</option>
                  <?php
                    for ($i=10; $i <= $school_year_start; $i++) {
                      ?>
                        <option value="<?php echo $i; ?>"><?php echo "20".$i; ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-3 text-center" style="padding-top: 25px">
              <div class="form-group">
                <button type="button" class="btn btn-danger" style="width: 70%" onclick="displayInstructor()">Submit</button>
              </div>
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-md-12" id="instructor-load">
              <ul>
                <?php
                $query2 = mysqli_query($conn, "select * from users where user_type='instructor'");
                $row2 = mysqli_fetch_assoc($query2);
                $query3 = mysqli_query($conn, "select * from subjects where instructor='".$row2['user_id']."'");
                while($row3 = mysqli_fetch_assoc($query3)){ ?>

                <li>
                  <h4>
                    <a href="grade.php?id=<?php echo $row3['subject_id']; ?>"><?php echo $row3['subject_code']." - ".$row3['subject_description']." (".$row3['time'].", ".$row3['day'].", ".$row3['room'].")"; ?>
                    </a>
                  </h4>
                </li>

                <?php } ?>
              </ul>
            </div>
          </div>

        </div>
      </div>

    </section>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script>
  $(".select2").select2();

  function displayInstructor(){
    var instructor = document.getElementById("instructor").value;
    var sy = document.getElementById("sy").value;
    $("#instructor-load").load("php/ajax/instructor-subjects.php?instructor="+instructor+"&sy="+sy);
  }
</script>

<?php include'php/footer.php'; ?>
