<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

// dd($user);

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <?php if ($user) : ?>
    <div class="row">
      <div class="col-sm-4 col-md-3">
        <img src="<?= getImage($user) ?>" alt="profile picture" class="border border-primary d-block mx-auto rounded-circle" style="width: 150px;">
        <h3 class="text-center"><?= htmlspecialchars($user['first_name']) ?> <?= htmlspecialchars($user['last_name']) ?></h3>
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
        <li class="nav-item">
          <a class="nav-link <?= $page_tab === 'classes' ? 'active' : '' ?>" href="/profile?user=<?= strtolower($user['user_id']) ?>&tab=classes">Classes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $page_tab === 'test' ? 'active' : '' ?>" href="/profile?user=<?= strtolower($user['user_id']) ?>&tab=test">Tests</a>
        </li>
      </ul>

      <?php

      switch ($page_tab) {
        case "info":
          require("tab/info.inc.php");
          break;
        case "classes":
          require("tab/classes.inc.php");
          break;
        case "test":
          require("tab/test.inc.php");
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