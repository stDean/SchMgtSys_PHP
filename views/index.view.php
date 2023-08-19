<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<style>
  h1 {
    font-size: 80px;
    color: green;
  }

  a {
    text-decoration: none;
  }

  .card-header {
    font-weight: bold;
  }

  .card {
    min-width: 250px;
  }
</style>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
  <div class="row justify-content-center ">
    <div class="card col-3 shadow rounded m-4 p-0 border">
      <a href="/schools">
        <div class="card-header">SCHOOLS</div>
        <h1 class="text-center">
          <i class="fa fa-graduation-cap"></i>
        </h1>
        <div class="card-footer">View all schools</div>
      </a>
    </div>

    <div class="card col-3 shadow rounded m-4 p-0 border">
      <a href="/users">
        <div class="card-header">STAFF</div>
        <h1 class="text-center">
          <i class="fa fa-chalkboard-teacher"></i>
        </h1>
        <div class="card-footer">View all staff members</div>
      </a>
    </div>

    <div class="card col-3 shadow rounded m-4 p-0 border">
      <a href="/students">
        <div class="card-header">STUDENTS</div>
        <h1 class="text-center">
          <i class="fa fa-user-graduate"></i>
        </h1>
        <div class="card-footer">View all students</div>
      </a>
    </div>

    <div class="card col-3 shadow rounded m-4 p-0 border">
      <a href="/classes">
        <div class="card-header">CLASSES</div>
        <h1 class="text-center">
          <i class="fa fa-university"></i>
        </h1>
        <div class="card-footer">View all classes</div>
      </a>
    </div>

    <div class="card col-3 shadow rounded m-4 p-0 border">
      <a href="/tests">
        <div class="card-header">TESTS</div>
        <h1 class="text-center">
          <i class="fa fa-file-signature"></i>
        </h1>
        <div class="card-footer">View all tests</div>
      </a>
    </div>

    <div class="card col-3 shadow rounded m-4 p-0 border">
      <a href="/statistics">
        <div class="card-header">STATISTICS</div>
        <h1 class="text-center">
          <i class="fa fa-chart-pie"></i>
        </h1>
        <div class="card-footer">View student statistics</div>
      </a>
    </div>

    <div class="card col-3 shadow rounded m-4 p-0 border">
      <a href="/settings">
        <div class="card-header">SETTINGS</div>
        <h1 class="text-center">
          <i class="fa fa-cogs"></i>
        </h1>
        <div class="card-footer">View app settings</div>
      </a>
    </div>

    <div class="card col-3 shadow rounded m-4 p-0 border">
      <a href="/profile">
        <div class="card-header">PROFILE</div>
        <h1 class="text-center">
          <i class="fa fa-id-card"></i>
        </h1>
        <div class="card-footer">View your profile</div>
      </a>
    </div>

    <div class="card col-3 shadow rounded m-4 p-0 border">
      <a href="/logout">
        <div class="card-header">LOGOUT</div>
        <h1 class="text-center">
          <i class="fa fa-sign-out-alt"></i>
        </h1>
        <div class="card-footer">Logout from the system</div>
      </a>
    </div>

  </div>
</div>

<?php

require base_path("/views/partials/footer.php");

?>