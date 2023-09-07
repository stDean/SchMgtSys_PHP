<h3 class="mt-2">Tests</h3>

<nav class="navbar navbar-light bg-light">
  <?php

  require base_path("/views/partials/searchForm.php");

  ?>
</nav>

<?php

$title = 'Test';
$classes = $user['tests'];

require base_path("/views/partials/table.php");

?>