<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <?php if ($test) : ?>
    <!-- <div class="row"> -->
    <h3 align='center' style="margin-bottom: 15px;"><?= htmlspecialchars($test['test_name']) ?></h3>
    <table class="table">
      <thead>
        <tr>
          <th>Created By</th>
          <th>Date Created:</th>
          <th>Active</th>

          <th>Action</th>

        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?= htmlspecialchars($user['first_name']) ?> <?= htmlspecialchars($user['last_name']) ?></td>
          <td><?= formatDate($test['createdAt']) ?></td>
          <td>
            <?= $test['disabled'] ? 'No' : 'Yes' ?>
          </td>
          <?php
          $btnText = 'Disable';
          $getVar = "disable=true";
          $btnColor = "btn-warning";
          if ($test['disabled']) {
            $btnColor = "btn-success";
            $btnText = 'Publish';
            $getVar = "disable=false";
          }
          ?>
          <?php if (onlyLecturer() && $test['editable']) : ?>
            <td>
              <a href="/single_test?id=<?= $test['test_id'] ?>&<?= $getVar ?>">
                <button class="btn btn-sm <?= $btnColor ?>"><b><?= $btnText ?> Test</b></button>
              </a>
            </td>
          <?php else :  ?>
            <td>
              <a href="/single_test?id=<?= $test['test_id'] ?>&tab=scores">
                <button class="btn btn-sm btn-success">View Scores</b></button>
              </a>
            </td>
          <?php endif; ?>
        </tr>
      </tbody>
    </table>
    <!-- </div> -->

    <?php

    switch ($page_tab) {
      case 'add':
        require "tab/add-theory.inc.php";
        break;
      case 'edit':
        require "tab/edit.inc.php";
        break;
      case 'delete':
        require "tab/delete.inc.php";
        break;
      case 'scores':
        require "tab/scores.inc.php";
        break;
      default:
        require "tab/view.inc.php";
        break;
    }

    ?>

    <hr />
    <?php if ($page_tab !== 'add') : ?>
      <div>
        <a href='<?= $_SERVER['HTTP_REFERER'] ?>' class="btn btn-sm btn-secondary ">
          Back
        </a>

        <div class="float-end">
          <a href='/single_class?id=<?= $test['class_id'] ?>&tab=tests' class="btn btn-sm btn-primary ">
            View Class
          </a>
        </div>
      </div>
    <?php endif; ?>
    <div class="clearfix"></div>
  <?php else : ?>
    <h4 align='center'>Test does not exist!</h4>
    <a href="/tests" class="btn btn-sm btn-primary">
      Go back
    </a>
  <?php endif; ?>
</div>

<?php

require base_path("/views/partials/footer.php");

?>