<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <div class="input-group">
      <span class="input-group-text" id="basic-addon1">
        <i class="fa fa-search"></i>
      </span>
      <input type="text" class="form-control" name="search" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
    </div>
  </form>

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