<nav class="navbar navbar-light bg-light">
  <?php

  require base_path("/views/partials/searchForm.php");

  ?>

  <?php if (onlyLecturer()) : ?>
    <a href='/single_class/test?id=<?= $class['class_id'] ?>&tab=test-add' class="btn btn-sm btn-primary ">
      <i class="fa fa-plus"></i>Add New Test
    </a>
  <?php endif; ?>
</nav>

<?php
$classes = $data;

require base_path("/views/partials/table.php");

?>

<div>
  <?php $pager->display(); ?>
</div>