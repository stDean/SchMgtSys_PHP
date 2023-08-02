<?php

require base_path("/views/partials/head.php");

?>

<form method="POST" action="/session">
  <div class="container-fluid">
    <div class="mx-auto shadow rounded p-4" style="width: 100%; max-width: 340px; margin-top: 50px;">
      <h2 class="text-center">My School</h2>
      <img src="/assets/imgs/logo.png" alt="School Logo" class="border border-primary rounded-circle d-block mx-auto" style="width: 100px" />
      <h3 style="margin-block: 10px;">Login</h3>


      <?php if (!empty($errors)) : ?>
        <div class="alert alert-warning alert-dismissible fade show pr-0" role="alert">
          <strong>Errors</strong><br>
          <?php foreach ($errors as $key => $val) : ?>
            <small><?= $val ?></small> <br>
          <?php endforeach; ?>
          <small type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></small>
        </div>
      <?php endif; ?>

      <input type="email" name="email" placeholder="Email" class="form-control <?= isset($errors['email']) ? 'border border-danger' : '' ?>"  value="<?= old('email'); ?>" autofocus>
      <br>
      <input type="password" name="password" placeholder="Password" class="form-control <?= isset($errors['email']) ? 'border border-danger' : '' ?>">
      <br>
      <button class="btn btn-primary">Login</button>
    </div>
  </div>
</form>

<?php

require base_path("/views/partials/footer.php");

?>