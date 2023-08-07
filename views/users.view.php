<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <nav class="navbar navbar-light bg-light">
    <form class="form-inline">
      <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
          <i class="fa fa-search"></i>
        </span>
        <input type="text" class="form-control" name="search" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
      </div>
    </form>

    <a href="/register" class="btn btn-sm btn-primary ">
      <i class="fa fa-plus"></i>Add New User
    </a>
  </nav>

  <div class="card-group justify-content-center">
    <?php if (!empty($rows)) : ?>

      <?php foreach ($rows as $row) : ?>
        <div class="card m-2 shadow-sm" style="max-width: 14rem; min-width:14rem;">
          <img src="<?= getImage($row) ?>" alt="profile photo" class="d-block mx-auto card-img-top">

          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['first_name']) ?></h5>
            <p class="card-text">Rank: <?= htmlspecialchars(ucwords(str_replace("_", " ", $row['role']))) ?></p>
            <a href="/profile?id=<?= $row['user_id'] ?>" class="btn btn-primary">Profile</a>
          </div>
        </div>
      <?php endforeach; ?>

    <?php else : ?>
      <h4>No staffs present at this moment.</h4>
    <?php endif; ?>
  </div>
</div>

<?php

require base_path("/views/partials/footer.php");

?>