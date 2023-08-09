<div class="card m-2 shadow-sm" style="max-width: 14rem; min-width:14rem;">
  <img src="<?= getImage($row) ?>" alt="profile photo" class="d-block mx-auto card-img-top">

  <div class="card-body">
    <h5 class="card-title"><?= htmlspecialchars($row['first_name']) ?></h5>
    <p class="card-text">Rank: <?= htmlspecialchars(ucwords(str_replace("_", " ", $row['role']))) ?></p>
    <a href="/profile?user=<?= htmlspecialchars(strtolower($row['user_id'])) ?>" class="btn btn-primary">
      <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
      Profile
    </a>
  </div>
</div>