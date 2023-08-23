<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <h3 align='center'>All Students</h3>
  <nav class="navbar navbar-light bg-light">
    <?php require base_path("/views/partials/searchForm.php") ?>

    <a href="/register?mode=student" class="btn btn-sm btn-primary ">
      <i class="fa fa-plus"></i>Add New Student
    </a>
  </nav>

  <div class="card-group justify-content-center">
    <?php if (!empty($students)) : ?>

      <?php foreach ($students as $row) : ?>
        <?php require base_path('/views/partials/single_user.php'); ?>
      <?php endforeach; ?>

    <?php else : ?>
      <h4>No students at this moment.</h4>
    <?php endif; ?>
  </div>

  <?php $pager->display(); ?>
</div>

<?php

require base_path("/views/partials/footer.php");

?>