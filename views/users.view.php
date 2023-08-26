<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <h3 align='center'>All Staffs</h3>
  <nav class="navbar navbar-light bg-light">
    <?php require base_path("/views/partials/searchForm.php") ?>

    <?php if (access('admin')) : ?>
      <a href="/register" class="btn btn-sm btn-primary ">
        <i class="fa fa-plus"></i>Add New User
      </a>
    <?php endif; ?>
  </nav>

  <div class="card-group justify-content-center">
    <?php if (!empty($rows)) : ?>

      <?php foreach ($rows as $row) : ?>
        <?php require base_path('/views/partials/single_user.php'); ?>
      <?php endforeach; ?>

    <?php else : ?>
      <h4>No staffs present at this moment.</h4>
    <?php endif; ?>
  </div>

  <?php $pager->display(); ?>
</div>

<?php

require base_path("/views/partials/footer.php");

?>