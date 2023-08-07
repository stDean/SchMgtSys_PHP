<?php

require base_path("./views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <div class="card-group justify-content-center">
    <form action="/classes/store" method="POST">
      <h3 class=" mb-2">Add Class</h3>

      <?php if (!empty($errors)) : ?>
        <div class="alert alert-warning alert-dismissible fade show pr-0" role="alert">
          <strong>Errors</strong><br>
          <?php foreach ($errors as $key => $val) : ?>
            <small><?= $val ?></small> <br>
          <?php endforeach; ?>
          <small type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></small>
        </div>
      <?php endif; ?>

      <input type="text" name="class_name" class="form-control  <?= isset($errors['class_name']) ? 'border border-danger' : '' ?>" placeholder="Class Name" value="<?= old('class_name') ?>" /><br>
      <input type="submit" value="Create" class="btn btn-primary float-end" />
      <a href="/classes">
        <input type="button" value="Cancel" class="btn btn-danger float-start" />
      </a>
    </form>
  </div>

</div>

<?php

require base_path("/views/partials/footer.php");

?>