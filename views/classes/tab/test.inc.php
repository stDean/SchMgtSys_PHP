<nav class="navbar navbar-light bg-light">
  <?php

  require base_path("/views/partials/searchForm.php");

  ?>

  <a href='/single_class?id=<?= $class['class_id'] ?>&tab=test-add' class="btn btn-sm btn-primary ">
    <i class="fa fa-plus"></i>Add New Test
  </a>
</nav>