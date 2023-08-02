<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <div class="card-group justify-content-center">
    <?php if (!empty($rows)) : ?>

      <?php foreach ($rows as $row) : ?>
        <div class="card m-2 shadow-sm" style="max-width: 14rem; min-width:14rem;">
          <img src="/assets/imgs/user_female.jpg" alt="profile photo" class="d-block mx-auto card-img-top">

          <div class="card-body">
            <h5 class="card-title"><?= $row['first_name'] ?></h5>
            <p class="card-text">Rank: <?= ucwords(str_replace("_", " ", $row['role'])) ?></p>
            <a href="#" class="btn btn-primary">Profile</a>
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