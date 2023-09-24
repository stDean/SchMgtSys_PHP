<div style="display: flex; justify-content: space-between;">
  <h3 class="mt-2">Classes</h3>

  <?php if (access('lecturer')) : ?>
    <a href="/classes/create" class="btn btn-sm btn-primary" style="margin-top: 10px; height: max-content; align-items: center;">
      <i class="fa fa-plus"></i>Add New Class</a>
  <?php endif; ?>
</div>

<hr>

<?php

$classes = isset($user['classes']) ? $user['classes'] : null;

require base_path("/views/partials/table.php");

?>