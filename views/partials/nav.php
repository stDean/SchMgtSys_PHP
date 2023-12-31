<?php

use Core\Session;

?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
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

        <?php if (access('super_admin')) : ?>
          <li class="nav-item">
            <a class="nav-link <?= urlIs('/schools') ? 'active bg-secondary text-white' : '' ?>" href="/schools">SCHOOLS</a>
          </li>
        <?php endif; ?>

        <?php if (access('admin') || getUserRank() === "RECEPTION") : ?>
          <li class="nav-item">
            <a class="nav-link <?= urlIs('/users') ? 'active bg-secondary text-white' : '' ?>" href="/users">STAFFS</a>
          </li>
        <?php endif; ?>

        <?php if (access('reception')) : ?>
          <li class="nav-item">
            <a class="nav-link <?= urlIs('/students') ? 'active bg-secondary text-white' : '' ?>" href="/students">STUDENTS</a>
          </li>
        <?php endif; ?>

        <li class="nav-item">
          <a class="nav-link <?= urlIs('/classes') || urlIs('/single_class') ? 'active bg-secondary text-white' : '' ?>" href="/classes">CLASSES</a>
        </li>

        <li class="nav-item" style="position: relative;">
          <a class="nav-link <?= urlIs('/tests') || urlIs('/single_test') ? 'active bg-secondary text-white' : '' ?>" href="/tests">TESTS
            <?php if (unSubmittedCount()) : ?>
              <small class="badge bg-danger text-white" style="position: absolute; top: -3px; right: -3px"><?= unSubmittedCount() ?></small>
            <?php endif; ?>
          </a>
        </li>

        <?php if (onlyLecturer()) : ?>
          <li class="nav-item" style="position: relative;">
            <a class="nav-link <?= urlIs('/mark_test') ? 'active bg-secondary text-white' : '' ?>" href="/mark_test">
              MARK TEST
              <?php
              $toMarkCount = markCount();
              ?>
              <?php if ($toMarkCount) : ?>
                <small class="badge bg-danger text-white" style="position: absolute; top: -3px; right: -3px"><?= $toMarkCount ?></small>
              <?php endif; ?>
            </a>
          </li>
        <?php endif; ?>

        <?php if (access('lecturer')) : ?>
          <li class="nav-item">
            <a class="nav-link <?= urlIs('/marked_tests') ? 'active bg-secondary text-white' : '' ?>" href="/marked_tests">MARKED TESTS</a>
          </li>
        <?php endif; ?>
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

      <form class="form-inline">
        <div class="input-group">
          <?php
          $years = getYears();
          ?>
          <?= add_get_vars() ?>
          <select class="form-select" name="school_year" id="year">
            <option><?= getVar('school_year', !empty($_SESSION['school_year']->year) ? $_SESSION['school_year']->year : date("Y", time()), "get") ?></option>
            <?php foreach ($years as $year) : ?>
              <option value="<?= $year ?>"><?= $year ?></option>
            <?php endforeach; ?>
          </select>

          <button class="input-group-text btn-btn-sm" id="basic-addon1">
            &nbsp;
            <i class="fa fa-chevron-right"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
</nav>