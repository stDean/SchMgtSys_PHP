<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <?php if ($test) : ?>
    <div class="row">
      <h3 align='center' style="margin-bottom: 15px;"><?= htmlspecialchars($test['test_name']) ?></h3>
      <table class="table table-striped">
        <tr>
          <th>Created By:
          <th>
          <td><?= htmlspecialchars($user['first_name']) ?> <?= htmlspecialchars($user['last_name']) ?></td>
          </th>
          </th>

          <th>Date Created:
          <th>
          <td><?= formatDate($test['createdAt']) ?></td>
          </th>
          </th>

          <th>Active:</th>
          <th>
          <td><?= $test['disabled'] === 0 ? 'Yes' : 'No' ?></td>
          </th>
        </tr>
      </table>
    </div>

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
      default:
        require "tab/view.inc.php";
        break;
    }

    ?>

    <hr />
    <div class="float-end">
      <a href='/single_class?id=<?= $test['class_id'] ?>&tab=tests' class="btn btn-sm btn-primary ">
        View Class
      </a>
    </div>
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