<?php

require base_path("./views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <div class="card-group justify-content-center">
    <form action="/classes" method="POST">
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="id" value="<?= $class['id'] ?>">

      <h3 class=" mb-2">Are you sure you want to delete?</h3>

      <input type="text" name="class_name" class="form-control  <?= isset($errors['class_name']) ? 'border border-danger' : '' ?>" placeholder="Class Name" value="<?= $class['class_name'] ?>" /><br>
      <input type="submit" value="Delete" class="btn btn-danger float-end" />
      <a href="/classes">
        <input type="button" value="Cancel" class="btn btn-success float-start" />
      </a>
    </form>
  </div>

</div>

<?php

require base_path("/views/partials/footer.php");

?>