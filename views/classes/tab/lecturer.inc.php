<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <div class="input-group">
      <span class="input-group-text" id="basic-addon1">
        <i class="fa fa-search"></i>
      </span>
      <input type="text" class="form-control" name="search" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
    </div>
  </form>

  <div>
    <a href='/single_class?id=<?= $class['class_id'] ?>&tab=lecturer-remove' class="btn btn-sm btn-primary ">
      <i class="fa fa-plus"></i>Add New
    </a>

    <a href='/single_class?id=<?= $class['class_id'] ?>&tab=lecturer-add' class="btn btn-sm btn-danger ">
      <i class="fa fa-minus"></i>Remove
    </a>
  </div>

</nav>


<div class="card-group justify-content-center">
  <?php
  if ($lecturers) {
    foreach ($lecturers as $lecturer) {
      $row = $lecturer['user'];
      require base_path('/views/partials/single_user.php');
    }
  }
  ?>
</div>