<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <?php if ($class) : ?>
    <div class="row">
      <h3 align='center' style="margin-bottom: 15px;"><?= htmlspecialchars($class['class_name']) ?></h3>
      <table class="table table-striped">
        <tr>
          <th>Created By:
          <th>
          <td><?= htmlspecialchars($user['first_name']) ?> <?= htmlspecialchars($user['last_name']) ?></td>
          </th>
          </th>

          <th>Date Created:
          <th>
          <td><?= formatDate($class['createdAt']) ?></td>
          </th>
          </th>
        </tr>
      </table>
    </div>

    <hr />

    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href='/single_class?id=<?= $class['class_id'] ?>&tab=lecturer' class="nav-link <?= $page_tab === 'lecturer' ? 'active' : '' ?>" aria-current="page">Lectures</a>
      </li>
      <li class="nav-item">
        <a href='/single_class?id=<?= $class['class_id'] ?>&tab=students' class="nav-link <?= $page_tab === 'students' ? 'active' : '' ?>">
          Students
        </a>
      </li>
      <li class="nav-item">
        <a href='/single_class?id=<?= $class['class_id'] ?>&tab=tests' class="nav-link <?= $page_tab === 'tests' ? 'active' : '' ?>">Tests</a>
      </li>
    </ul>

    <?php

    switch ($page_tab) {
      case 'students':
        require "tab/students.inc.php";
        break;
      case 'tests':
        require "tab/test.inc.php";
        break;
      case 'lecturer-add':
        require "tab/lecturer.add.inc.php";
        break;
      case 'test-add':
        require "tab/test.add.inc.php";
        break;
      case 'test-edit':
        require "tab/test.edit.inc.php";
        break;
      case 'test-delete':
        require "tab/test.delete.inc.php";
        break;
      case 'student-add':
        require "tab/students.add.inc.php";
        break;
      default:
        require "tab/lecturer.inc.php";
    }

    ?>

  <?php else : ?>
    <h4 align='center'>Class does not exist!</h4>
    <a href="/classes" class="btn btn-sm btn-primary">
      Go back
    </a>
  <?php endif; ?>
</div>

<?php

require base_path("/views/partials/footer.php");

?>