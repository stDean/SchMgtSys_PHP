<?php if (access('admin')) : ?>
  <nav class="navbar navbar-light bg-light">
    <a href='/single_class/student?id=<?= $class['class_id'] ?>&tab=student-add' class="btn btn-sm btn-primary ">
      <i class="fa fa-plus"></i>Add New Student
    </a>
  </nav>
<?php endif; ?>

<div class="card-group justify-content-center">
  <?php
  if ($data) {
    foreach ($data as $student) {
      $row = $student['user'];
      require base_path('/views/partials/single_user.php');
    }
  } else {
    echo "<h4 align='center' style='margin-top: 20px;'>No students found in this class.</h4>";
  }
  ?>
</div>

<div>
  <?php $pager->display(); ?>
</div>