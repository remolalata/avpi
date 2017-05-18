<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<?php

if(isset($_POST['addCourseHidden'])){
	$course_id = mysqli_real_escape_string($conn, $_POST['course_id']);
	$course_description = mysqli_real_escape_string($conn, $_POST['course_description']);
	mysqli_query($conn, "insert into course values('$course_id', '$course_description')") or die(mysqli_error());
	echo "
    <script>  
      alert('New Course Registered.').
      open('course-section.php', '_self');
    </script>
  ";
}

if(isset($_POST['addSectionHidden'])){
	$section_id = mysqli_real_escape_string($conn, $_POST['section_id']);
	$section_description = mysqli_real_escape_string($conn, strtoupper($_POST['section_description']));
	mysqli_query($conn, "insert into sections values('$section_id', '$section_description')") or die(mysqli_error());
	echo "
    <script>  
      alert('New Section Registered.').
      open('course-section.php', '_self');
    </script>
  ";
}

if(isset($_POST['addYearHidden'])){
	$year_id = mysqli_real_escape_string($conn, $_POST['year_id']);
	$year_description = mysqli_real_escape_string($conn, $_POST['year_description']);
	mysqli_query($conn, "insert into year(year_id, year_description) values('$year_id', '$year_description')") or die(mysqli_error());
	echo "
    <script>  
      alert('New Year Registered.').
      open('course-section.php', '_self');
    </script>
  ";
}

if(isset($_POST['editCourseHidden'])){
  $course_id_hidden = $_POST['editCourseHidden'];
  $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);
  $course_description = mysqli_real_escape_string($conn, $_POST['course_description']);
  mysqli_query($conn, "update course set course_id='$course_id', course_description='$course_description' where course_id='$course_id_hidden'") or die(mysql_error());
  echo "
    <script>  
      alert('Course Record Updated.').
      open('course-section.php', '_self');
    </script>
  ";
}

if(isset($_POST['editSectionHidden'])){
  $section_id_hidden = $_POST['editSectionHidden'];
  $section_id = mysqli_real_escape_string($conn, $_POST['section_id']);
  $section_description = mysqli_real_escape_string($conn, $_POST['section_description']);
  mysqli_query($conn, "update sections set section_id='$section_id', section_description='$section_description' where section_id='$section_id_hidden'") or die(mysqli_error());
  echo "
    <script>  
      alert('Section Record Updated.').
      open('course-section.php', '_self');
    </script>
  ";
}

if(isset($_POST['editYearHidden'])){
  $year_id_hidden = $_POST['editYearHidden'];
  $year_id = mysqli_real_escape_string($conn, $_POST['year_id']);
  $year_description = mysqli_real_escape_string($conn, $_POST['year_description']);
  mysqli_query($conn, "update year set year_id='$year_id', year_description='$year_description' where yearID='$year_id_hidden'") or die(mysql_error());
  echo "
    <script>  
      alert('Year Record Updated.').
      open('course-section.php', '_self');
    </script>
  ";
}

if(isset($_POST['deleteCourseHidden'])){
  $course_id = $_POST['deleteCourseHidden'];
  mysqli_query($conn, "delete from course where course_id='$course_id'");
  echo "
    <script>  
      alert('Course Record Deleted').
      open('course-section.php', '_self');
    </script>
  ";
}

if(isset($_POST['deleteSectionHidden'])){
  $section_id = $_POST['deleteSectionHidden'];
  mysqli_query($conn, "delete from sections where section_id='$section_id'");
  echo "
    <script>  
      alert('Section Record Deleted').
      open('course-section.php', '_self');
    </script>
  ";
}

if(isset($_POST['deleteYearHidden'])){
  $year_id = $_POST['deleteYearHidden'];
  $query = "delete from year where yearID='$year_id'";
  if(mysqli_query($conn, $query) == true){
    echo "
      <script>  
        alert('Year Record Deleted').
        open('course-section.php', '_self');
      </script>
    ";
  }else{
    die(mysqli_error($conn));
  }
}

?>

<style>
	thead th:nth-child(2):after{display: none}
</style>
    
<section class="content-header">
  <h1>
    Course & Section
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Course & Section</li>
  </ol>
</section>

<section class="content">
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Records for Course <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#addCourseModal"><span data-toggle="tooltip" title="Add Course">Add Course</span></button></h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
	      </div>
	    </div>
	    <div class="box-body">
			<table id="courseTable" class="table table-bordered table-hover">
                <thead>
					<th>Course ID</th>
					<th>Course Description</th>
					<th></th>
                </thead>
                <tbody>
                	<?php
                		$query3 = mysqli_query($conn, "select * from course");
                		while($row3 = mysqli_fetch_assoc($query3)){
                			?>
                				<tr>
                					<td><?php echo $row3['course_id']; ?></td>
                					<td><?php echo $row3['course_description']; ?></td>
                					<td align="center">
                            <form method="post">
                              <input type="hidden" name="deleteCourseHidden" value="<?php echo $row3['course_id']; ?>">
                              <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#editCourseModal" data-courseid="<?php echo $row3['course_id']; ?>"><i class="fa fa-pencil" data-toggle="tooltip" title="Edit Course"></i></button>
                              <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are sure you want to delete this course?')" title="Delete Course"><i class="fa fa-trash" data-toggle="tooltip" title="Delete Course"></i></button>
                            </form>
                          </td>
                				</tr>
                			<?php
                		}
                	?>
                </tbody>
            </table>
	    </div>
  </div>

  <div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Records for Section <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#addSectionModal"><span data-toggle="tooltip" title="Add Section">Add Section</span></button></h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
	      </div>
	    </div>
	    <div class="box-body">
		    <table id="sectionTable" class="table table-bordered table-hover">
                <thead>
					<th>Section ID</th>
					<th>Section Description</th>
					<th></th>
                </thead>
                <tbody>
                	<?php
                		$query2 = mysqli_query($conn, "select * from sections");
                		while($row2 = mysqli_fetch_assoc($query2)){
                			?>
        								<tr>
        									<td><?php echo $row2['section_id']; ?></td>
        									<td><?php echo $row2['section_description']; ?></td>
        									<td align="center">
                            <form method="post">
                              <input type="hidden" name="deleteSectionHidden" value="<?php echo $row2['section_id']; ?>">
                              <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#editSectionModal" data-sectionid="<?php echo $row2['section_id']; ?>" title="Edit Section"><i class="fa fa-pencil" data-toggle="tooltip" title="Edit Section"></i></button>
                              <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are sure you want to delete this section?')" title="Delete Section"><i class="fa fa-trash" data-toggle="tooltip" title="Delete Section"></i></button>
                            </form>
        									</td>
        								</tr>	
                			<?php
                		}
                	?>
                </tbody>
            </table>
	    </div>
  </div>

  <div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Records for Year <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#addYearModal"><span data-toggle="tooltip" title="Add Year">Add Year</button></span></h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
	      </div>
	    </div>
	    <div class="box-body">
		    <table id="yearTable" class="table table-bordered table-hover">
                <thead>
                	<tr>
                		<th>Year ID</th>
        						<th>Year Description</th>
        						<th></th>	
                	</tr>
                </thead>
                <tbody>
	            	<?php
	            		$query = mysqli_query($conn, "select * from year");
	            		while($row = mysqli_fetch_assoc($query)){
	            			?>
								<tr>
									<td><?php echo $row['year_id']; ?></td>
									<td><?php echo $row['year_description']; ?></td>
									<td align="center">
                    <form method="post">
                      <input type="hidden" name="deleteYearHidden" value="<?php echo $row['yearID']; ?>">
                      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#editYearModal" data-yearid="<?php echo $row['yearID']; ?>"><i class="fa fa-pencil" data-toggle="tooltip" title="Edti Year"></i></button>
                      <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are sure you want to delete this year?')"><i class="fa fa-trash" data-toggle="Delete Year"></i></button>
                    </form>
									</td>
								</tr>
	            			<?php
	            		}
	            	?>
	            </tbody>
            </table>
	    </div>
  </div>
</section>

<div class="modal" tabindex="-1" role="dialog" id="addCourseModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Course</h4>
      </div>
      <div class="modal-body">
        <div class="form-group" id="course_error">
        	<form method="post">
        	<input type="hidden" name="addCourseHidden" value="check">
        	<label>Course ID</label>
        	<input type="text" name="course_id" id="course_description" class="form-control" placeholder="Course ID" onblur="checkCourse(this.value)" required >
        </div>
        <div class="form-group">
        	<label>Course Description</label>
        	<input type="text" name="course_description" id="course_description" class="form-control" placeholder="Course Description" required >
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="addCourseBtn">Save</button>
    	</form>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="addSectionModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Section</h4>
      </div>
      <div class="modal-body">
      	<form method="post">
      	<input type="hidden" name="addSectionHidden" value="check">
        <div class="form-group" id="section_error">
        	<label>Section ID</label>
        	<input type="text" name="section_id" id="section_id" class="form-control" placeholder="Section ID" onblur="checkSection(this.value)" required >
        </div>
        <div class="form-group">
        	<label>Section Description</label>
        	<input type="text" name="section_description" id="section_description" class="form-control" placeholder="Section Description" required >
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="addSectionBtn" class="btn btn-primary">Save</button>
    	</form>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="addYearModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Year</h4>
      </div>
      <div class="modal-body">
      	<form method="post">
      	<input type="hidden" name="addYearHidden" value="check">
        <div class="form-group" id="year_error">
        	<label>Year ID</label>
        	<input type="text" name="year_id" id="year_id" class="form-control" placeholder="Year ID" onkeypress="return numbersonly(event)" onblur="checkYear(this.value)" required >
        </div>
        <div class="form-group">
        	<label>Year Description</label>
        	<input type="text" name="year_description" id="year_description" class="form-control" placeholder="Year Description" required >
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="addYearBtn">Save</button>
    	</form>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="editCourseModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Course</h4>
      </div>
      <div class="modal-body">
        <form method="post">
        <div id="editCourseDiv"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="editSectionModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Section</h4>
      </div>
      <div class="modal-body">
        <form method="post">
        <div id="editSectionDiv"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="editYearModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Year</h4>
      </div>
      <div class="modal-body">
        <form method="post">
        <div id="editYearDiv"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
      </div>
    </div>
  </div>
</div>

<form method="post" id="deleteCourseForm"><input type="hidden" name="deleteCourseHidden" id="deleteCourseHidden"></form>
<form method="post" id="deleteSectionForm"><input type="hidden" name="deleteSectionHidden" id="deleteSectionHidden"></form>
<form method="post" id="deleteYearForm"><input type="hidden" name="deleteYearHidden" id="deleteYearHidden"></form>    

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#courseTable').DataTable({
      "paging": false,
      "searching": false,
      "info": false,
      "autoWidth": false,
      "scrollY": "180px",
      "scrollCollapse": true,
    });
    $('#sectionTable').DataTable({
      "paging": false,
      "searching": false,
      "info": false,
      "autoWidth": false,
      "scrollY": "180px",
      "scrollCollapse": true,
    });
    $('#yearTable').DataTable({
      "paging": false,
      "searching": false,
      "info": false,
      "autoWidth": false,
      "scrollY": "180px",
      "scrollCollapse": true,
    });
  });

  $('#editCourseModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var courseid = button.data('courseid');
    $("#editCourseDiv").load("php/ajax/editcourse.php?q=" + courseid);
  });

  $('#editSectionModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var sectionid = button.data('sectionid');
    $("#editSectionDiv").load("php/ajax/editsection.php?q=" + sectionid);
  });

  $('#editYearModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var yearid = button.data('yearid');
    $("#editYearDiv").load("php/ajax/edityear.php?q=" + yearid);
  });

  function checkCourse(val){
    $.ajax({
    type: "POST",
    url: "php/ajax/checkcourse.php",
    data: 'id='+val,
    dataType: 'json',
    success: function(msg){
      if(msg.count >= 1){
        $("#course_error").addClass("has-error");
        $("#course_error label").html("Course ID already exist.");
        document.getElementById("addCourseBtn").disabled = true;
      }else{
        $("#course_error").removeClass("has-error");
        $("#course_error label").html("Course ID");
        document.getElementById("addCourseBtn").disabled = false;
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown); 
    }
   });
  }

  function checkSection(val){
    $.ajax({
    type: "POST",
    url: "php/ajax/checksection.php",
    data: 'id='+val,
    dataType: 'json',
    success: function(msg){
      if(msg.count >= 1){
        $("#section_error").addClass("has-error");
        $("#section_error label").html("Section ID already exist.");
        document.getElementById("addSectionBtn").disabled = true;
      }else{
        $("#section_error").removeClass("has-error");
        $("#section_error label").html("Section ID");
        document.getElementById("addSectionBtn").disabled = false;
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown); 
    }
   });
  }

  /*function checkYear(val){
    $.ajax({
    type: "POST",
    url: "php/ajax/checkyear.php",
    data: 'id='+val,
    dataType: 'json',
    success: function(msg){
      if(msg.count >= 1){
        $("#year_error").addClass("has-error");
        $("#year_error label").html("Year ID already exist.");
        document.getElementById("addSectionBtn").disabled = true;
      }else{
        $("#year_error").removeClass("has-error");
        $("#year_error label").html("Year ID");
        document.getElementById("addYearBtn").disabled = false;
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown); 
    }
   });
  }*/
</script>
<?php include'php/footer.php'; ?>