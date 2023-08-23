<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <?php if ($user) : ?>
    <h3 align='center'><?= htmlspecialchars($user['first_name']) ?>'s Profile</h3>
    <div class="row">
      <div class="col-sm-4 col-md-3">
        <img src="<?= getImage($user) ?>" alt="profile picture" class="border border-primary d-block mx-auto rounded-circle" style="width: 150px;">
        <h3 class="text-center mt-2"><?= htmlspecialchars($user['first_name']) ?> <?= htmlspecialchars($user['last_name']) ?></h3>

        <br>
        <?php if (canModifyContent($user) || getUserRank() === 'RECEPTION') : ?>
          <div class="text-center">
            <a href="/profile/edit?user=<?= strtolower($user['user_id']) ?>">
              <button class="btn btn-sm btn-secondary">Edit Profile</button>
            </a>
            <a href="/profile/delete?user=<?= strtolower($user['user_id']) ?>">
              <button class="btn btn-sm btn-danger">Delete Profile</button>
            </a>
          </div>
        <?php endif; ?>
      </div>

      <div class="col-sm-8 col-md-9 bg-light p-2">
        <table class="table table-striped">
          <tr>
            <th>First Name:
            <th>
            <td><?= htmlspecialchars($user['first_name']) ?></td>
            </th>
            </th>
          </tr>
          <tr>
            <th>Last Name:
            <th>
            <td><?= htmlspecialchars($user['last_name']) ?></td>
            </th>
            </th>
          </tr>
          <tr>
            <th>Rank:
            <th>
            <td><?= htmlspecialchars(ucwords(str_replace("_", " ", $user['role']))) ?></td>
            </th>
            </th>
          </tr>
          <tr>
            <th>Email:
            <th>
            <td><?= htmlspecialchars($user['email']) ?></td>
            </th>
            </th>
          </tr>
          <tr>
            <th>Gender:
            <th>
            <td><?= htmlspecialchars(ucfirst($user['gender'])) ?></td>
            </th>
            </th>
          </tr>
          <tr>
            <th>Date Created:
            <th>
            <td><?= formatDate($user['created_at']) ?></td>
            </th>
            </th>
          </tr>
        </table>
      </div>
    </div>

    <hr />

    <div class="container-fluid">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link <?= $page_tab === 'info' ? 'active' : '' ?>" href="/profile?user=<?= strtolower($user['user_id']) ?>&tab=info">Info</a>
        </li>
        <?php if (access('lecturer') || canModifyContent($user)) : ?>
          <li class="nav-item">
            <a class="nav-link <?= $page_tab === 'classes' ? 'active' : '' ?>" href="/profile?user=<?= strtolower($user['user_id']) ?>&tab=classes">Classes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $page_tab === 'test' ? 'active' : '' ?>" href="/profile?user=<?= strtolower($user['user_id']) ?>&tab=test">Tests</a>
          </li>
        <?php endif; ?>
      </ul>

      <?php

      switch ($page_tab) {
        case "info":
          require("tab/info.inc.php");
          break;
        case "classes":
          if (access('lecturer') || canModifyContent($user)) {
            require("tab/classes.inc.php");
          } else {
            abortView('denied', 403);
          }
          break;
        case "test":
          if (access('lecturer') || canModifyContent($user)) {
            require("tab/test.inc.php");
          } else {
            abortView('denied', 403);
          }
          break;
      }

      ?>
    </div>

  <?php else : ?>
    <h4 align='center'>Profile does not exist!</h4>
    <a href="/users" class="btn btn-primary">
      Go back
    </a>
  <?php endif; ?>
</div>

<?php

require base_path("/views/partials/footer.php");

?>