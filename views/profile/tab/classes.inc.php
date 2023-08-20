<h3 class="mt-2">Classes</h3>

<nav class="navbar navbar-light bg-light">
  <?php

  require base_path("/views/partials/searchForm.php");

  ?>
</nav>

<hr>

<?php

$classes = $user['classes'];
// dd($classes);

require base_path("/views/partials/table.php");

?>