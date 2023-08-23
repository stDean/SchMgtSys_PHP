<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">

  <h3 align='center'>Classes</h3>

  <nav class="navbar navbar-light bg-light">
    <?php require base_path("/views/partials/searchForm.php") ?>

    <?php if (access('lecturer')) : ?>
      <a href="/classes/create" class="btn btn-sm btn-primary "><i class="fa fa-plus"></i>Add New Class</a>
    <?php endif; ?>
  </nav>

  <?php

  require base_path("/views/partials/table.php");

  ?>

</div>

<?php

require base_path("/views/partials/footer.php");

?>