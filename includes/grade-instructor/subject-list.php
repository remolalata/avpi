<table id="subjectListTbl" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Section</th>
      <th>Subject Code</th>
      <th>Description</th>
      <th>Instructor</th>
      <th>Encoder</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      $query5 = mysqli_query($conn, "select * from subjects where instructor='".$the_user['user_id']."'");
      while($row5 = mysqli_fetch_assoc($query5)){

        ?>
          <tr>
            <td><?php echo getSections($row5['subject_id']); ?></td>
            <td><?php echo $row5['subject_code']; ?></td>
            <td><?php echo $row5['subject_description']; ?></td>
            <td><?php echo getUser($row5['instructor']); ?></td>
            <td><?php echo getUser($row5['encoder']); ?></td>
            <td align="center">
              <a href="grade.php?id=<?php echo $row5['subject_id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="View Subject"><i class="fa fa-eye"></i></a>
            </td>
          </tr>
        <?php
      }
    ?>
  </tbody>
</table>