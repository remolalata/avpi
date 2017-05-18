<?php if(empty(workflow())){ ?>
<div class="alert alert-danger alert-dismissible" style="margin-bottom: 60px">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
  No students enrolled on this school year.
</div>
<?php } ?>

<?php if(!empty(workflow())) { ?>
<table id="subjectListTbl" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Section/Year</th>
      <th>Subject Code</th>
      <th>Description</th>
      <th>Instructor</th>
      <th>Encoder</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      // $query = mysqli_query($conn, "select * from subjects where sy='$school_year_start'");
      $query = mysqli_query($conn, "select a.*, c.year_id from subjects a, subject_years b, year c where a.subject_id=b.subject_id and b.year_id=c.year_id");
      while($row = mysqli_fetch_assoc($query)){
        ?>
          <tr>
            <td><?php echo getSections($row['subject_id']); ?> - <?php echo $row['year_id']; ?></td>
            <td><?php echo $row['subject_code']; ?></td>
            <td><?php echo $row['subject_description']; ?></td>
            <td><?php echo getUser($row['instructor']); ?></td>
            <td><?php echo getUser($row['encoder']); ?></td>
            <td align="center">
              <?php if(empty(workflow())){ ?>
              <a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" title="View Subject"><i class="fa fa-eye"></i></a>
              <?php }else{ ?>
              <a href="grade.php?id=<?php echo $row['subject_id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="View Subject"><i class="fa fa-eye"></i></a>
              <?php } ?>
            </td>
          </tr>
        <?php
      }
    ?>
  </tbody>
</table>
<?php } ?>
