<nav class="navbar navbar-light bg-light">
  <?php

  require base_path("/views/partials/searchForm.php");

  ?>

  <a href='/single_class/lecturer?id=<?= $class['class_id'] ?>&tab=lecturer-add' class="btn btn-sm btn-primary ">
    <i class="fa fa-plus"></i>Add New Lecturer
  </a>

</nav>


<div class="card-group justify-content-center">
  <?php
  if ($data) {
    foreach ($data as $lecturer) {
      $row = $lecturer['user'];
      require base_path('/views/partials/single_user.php');
    }
  } else {
    echo "<h4 align='center' style='margin-top: 20px;'>No lecturers found in this class.</h4>";
  }
  ?>
</div>