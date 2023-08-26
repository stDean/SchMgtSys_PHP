<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-2" style="max-width: 1000px">
  <h3 align='center'>Edit Profile</h3>

  <?php if ($user) : ?>

    <form action="/profile/edit?user=<?= strtolower($user['user_id']) ?>" method="POST" enctype="multipart/form-data">
      <input type="hidden" value="PATCH" name="_method">
      <div class="row">
        <div class="col-sm-4 col-md-3">
          <img src="<?= getImage($user) ?>" alt="profile picture" class="border border-primary d-block mx-auto rounded-circle" style="width: 150px;">
          <h3 class="text-center mt-2"><?= htmlspecialchars($user['first_name']) ?> <?= htmlspecialchars($user['last_name']) ?></h3>

          <?php if (canModifyContent($user) || (getUserRank() === 'RECEPTION' && $user['role'] === 'student')) : ?>
            <div class="text-center mt-3">
              <label for="image" class="btn btn-sm btn-secondary">
                <input type="file" name="image" id="image" class="d-none" onchange="handleImageChange(this.files[0].name)">
                Browse Image
              </label>

              <br>
              <small class="file_info text-muted"></small>
            </div>
          <?php endif; ?>
        </div>

        <div class="col-sm-8 col-md-9 bg-light p-2">
          <form action="/profile/edit?user=<?= strtolower($user['user_id']) ?>" method="POST">
            <div class="container-fluid">
              <div class="mx-auto shadow rounded p-4">
                <?php if (!empty($errors)) : ?>
                  <div class="alert alert-warning alert-dismissible fade show pr-0" role="alert">
                    <strong>Errors</strong><br>
                    <?php foreach ($errors as $key => $val) : ?>
                      <small><?= $val ?></small> <br>
                    <?php endforeach; ?>
                    <small type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></small>
                  </div>
                <?php endif; ?>

                <input type="text" name="first_name" placeholder="First Name" class="form-control my-2 <?= isset($errors['first_name']) ? 'border border-danger' : '' ?>" value="<?= htmlspecialchars($user['first_name']) ?>">
                <input type="text" name="last_name" placeholder="Last Name" class="form-control my-2 <?= isset($errors['last_name']) ? 'border border-danger' : '' ?>" value="<?= htmlspecialchars($user['last_name']) ?>">
                <input type="email" name="email" placeholder="Email" class="form-control my-2 <?= isset($errors['email']) ? 'border border-danger' : '' ?>" value="<?= htmlspecialchars($user['email']) ?>">

                <select name="gender" id="" class="form-control my-2 <?= isset($errors['gender']) ? 'border border-danger' : '' ?>" disabled>
                  <option <?= $user['gender'] === '' ? "selected" : '' ?> value="">--Select a Gender--</option>
                  <option <?= $user['gender'] === 'male' ? "selected" : '' ?> value="male">Male</option>
                  <option <?= $user['gender'] === 'female' ? "selected" : '' ?> value="female">Female</option>
                </select>


                <select name="role" id="" class="form-control my-2 <?= isset($errors['role']) ? 'border border-danger' : '' ?>" <?= !access('admin') ? "disabled" : '' ?>>
                  <option <?= $user['role'] === '' ? "selected" : '' ?> value="">--Select a Rank--</option>
                  <option <?= $user['role'] === 'student' ? "selected" : '' ?> value="student">Student</option>
                  <option <?= $user['role'] === 'reception' ? "selected" : '' ?> value="reception">Reception</option>
                  <option <?= $user['role'] === 'lecturer' ? "selected" : '' ?> value="lecturer">Lecturer</option>
                  <option <?= $user['role'] === 'admin' ? "selected" : '' ?> value="admin">Admin</option>

                  <?php if (getUserRank() === 'SUPER_ADMIN') : ?>
                    <option <?= $user['role'] === 'super_admin' ? "selected" : '' ?> value="super_admin">Super Admin</option>
                  <?php endif; ?>

                </select>
                <input type="text" name="password" placeholder="Password" class="form-control my-2 <?= isset($errors['password']) ? 'border border-danger' : '' ?>">
                <input type="text" name="cfPassword" placeholder="Retype Password" class="form-control my-2">

                <a href="/profile?user=<?= strtolower($user['user_id']) ?>">
                  <p class="btn btn-sm btn-primary mt-2">Back</p>
                </a>

                <button class="btn btn-sm btn-success float-end mt-2">Save Changes</button>
              </div>
            </div>
        </div>
      </div>
    </form>

    <br>

  <?php else : ?>
    <h4 align='center'>Profile does not exist!</h4>
    <a href="/users" class="btn btn-primary">
      Go back
    </a>
  <?php endif; ?>
</div>

<script>
  function handleImageChange(fileName) {
    const fileInfo = document.querySelector('.file_info');
    fileInfo.innerHTML = fileName;
  }
</script>

<?php

require base_path("/views/partials/footer.php");

?>