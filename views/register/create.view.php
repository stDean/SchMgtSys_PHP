<?php

use Core\Session;

require base_path("/views/partials/head.php");


?>

<form action="/register" method="POST">
  <div class="container-fluid">
    <div class="mx-auto shadow rounded p-4" style="width: 100%; max-width: 340px; margin-top: 50px;">
      <h2 class="text-center">My School</h2>
      <img src="/assets/imgs/logo.png" alt="School Logo" class="border border-primary rounded-circle d-block mx-auto" style="width: 100px" />
      <h3 style="margin-block: 10px;">Add User</h3>

      <?php if (!empty($errors)) : ?>
        <div class="alert alert-warning alert-dismissible fade show pr-0" role="alert">
          <strong>Errors</strong><br>
          <?php foreach ($errors as $key => $val) : ?>
            <small><?= $val ?></small> <br>
          <?php endforeach; ?>
          <small type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></small>
        </div>
      <?php endif; ?>

      <input type="text" name="first_name" placeholder="First Name" class="form-control my-2 <?= isset($errors['first_name']) ? 'border border-danger' : '' ?>" value="<?= old('first_name'); ?>">
      <input type="text" name="last_name" placeholder="Last Name" class="form-control my-2 <?= isset($errors['last_name']) ? 'border border-danger' : '' ?>" value="<?= old('last_name'); ?>">
      <input type="email" name="email" placeholder="Email" class="form-control my-2 <?= isset($errors['email']) ? 'border border-danger' : '' ?>" value="<?= old('email'); ?>">
      <select name="gender" id="" class="form-control my-2 <?= isset($errors['gender']) ? 'border border-danger' : '' ?>">
        <option <?= old('gender') === '' ? "selected" : '' ?> value="">--Select a Gender--</option>
        <option <?= old('gender') === 'male' ? "selected" : '' ?> value="male">Male</option>
        <option <?= old('gender') === 'female' ? "selected" : '' ?> value="female">Female</option>
      </select>
      <select name="role" id="" class="form-control my-2 <?= isset($errors['role']) ? 'border border-danger' : '' ?>">
        <option <?= old('role') === '' ? "selected" : '' ?> value="">--Select a Rank--</option>
        <option <?= old('role') === 'student' ? "selected" : '' ?> value="student">Student</option>
        <option <?= old('role') === 'reception' ? "selected" : '' ?> value="reception">Reception</option>
        <option <?= old('role') === 'lecturer' ? "selected" : '' ?> value="lecturer">Lecturer</option>
        <option <?= old('role') === 'admin' ? "selected" : '' ?> value="admin">Admin</option>

        <?php if (Session::getRole() === 'SUPER_ADMIN') : ?>
          
          <option <?= old('role') === 'super_admin' ? "selected" : '' ?> value="super_admin">Super Admin</option>
        <?php endif; ?>
      </select>
      <input type="text" name="password" placeholder="Password" class="form-control my-2 <?= isset($errors['password']) ? 'border border-danger' : '' ?>">
      <input type="text" name="cfPassword" placeholder="Retype Password" class="form-control my-2">
      <br>
      <button class="btn btn-primary float-end">Add User</button>
      <a href="/users" class="btn btn-danger text-white">Cancel</a>
    </div>
  </div>
</form>

<?php

require base_path("/views/partials/footer.php");

?>