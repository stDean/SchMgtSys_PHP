<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
  <?php require base_path("/views/partials/breadcrumb.php"); ?>
  <div class="row">
    <div class="col-sm-4 col-md-3">
      <img src="/assets/imgs/user_male.jpg" alt="profile picture" class="border border-primary d-block mx-auto rounded-circle" style="width: 150px;">
      <h3 class="text-center">Sheriff Dean</h3>
    </div>

    <div class="col-sm-8 col-md-9 bg-light p-2">
      <table class="table table-striped">
        <tr>
          <th>First Name:
          <th>
          <td>Dean</td>
          </th>
          </th>
        </tr>
        <tr>
          <th>Last Name:
          <th>
          <td>Sheriff</td>
          </th>
          </th>
        </tr>
        <tr>
          <th>Gender:
          <th>
          <td>Male</td>
          </th>
          </th>
        </tr>
        <tr>
          <th>Date Created:
          <th>
          <td>2022/10/10</td>
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
</div>

<?php

require base_path("/views/partials/footer.php");

?>