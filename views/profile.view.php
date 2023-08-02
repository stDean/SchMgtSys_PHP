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
          <a class="nav-link active" aria-current="page" href="#">Basic Info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Classes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Tests</a>
        </li>
      </ul>

      <nav class="navbar navbar-light bg-light">
        <form class="container-fluid">
          <div class="input-group">
            <span class="input-group-text" id="basic-addon1">
              <i class="fa fa-search"></i>
            </span>
            <input type="text" class="form-control" name="search" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
          </div>
        </form>
      </nav>
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