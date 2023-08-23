<h3 class="mt-2">Classes</h3>

<nav class="navbar navbar-light bg-light">
  <?php require base_path("/views/partials/searchForm.php"); ?>

  <?php if (access('lecturer')) : ?>
    <a href="/classes/create" class="btn btn-sm btn-primary "><i class="fa fa-plus"></i>Add New Class</a>
  <?php endif; ?>
</nav>

<hr>

<?php

$classes = isset($user['classes']) ? $user['classes'] : null;
// dd($classes);

require base_path("/views/partials/table.php");

?>