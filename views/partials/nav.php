<?php

use Core\Session;

?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="/assets/imgs/logo.png" alt="School Logo" style="width: 50px" />
      <b><?= key_exists('school_name', Session::get('user')) ? explode(" ", Session::getSchool_Name())[0] : "Unknown" ?></b>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= $_SERVER["REQUEST_URI"] === '/' ? 'active bg-secondary text-white' : '' ?>" aria-current="page" href="/">DASHBOARD</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= urlIs('/schools') ? 'active bg-secondary text-white' : '' ?>" href="/schools">SCHOOLS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= urlIs('/users') ? 'active bg-secondary text-white' : '' ?>" href="/users">STAFFS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= urlIs('/students') ? 'active bg-secondary text-white' : '' ?>" href="/students">STUDENTS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= urlIs('/classes') ? 'active bg-secondary text-white' : '' ?>" href="/classes">CLASSES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= urlIs('/tests') ? 'active bg-secondary text-white' : '' ?>" href="/tests">TESTS</a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= Session::getFirst_Name() ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="/profile">Profile</a></li>
            <li><a class="dropdown-item" href="/">Dashboard</a></li>
            <div class="dropdown-divider"></div>
            <li>
              <form action="/session" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" style="border: none; outline: none; background: transparent; padding-left:20px;">Log Out</button>
              </form>
            </li>
          </ul>
        </li>
      </ul>

    </div>
  </div>
</nav>