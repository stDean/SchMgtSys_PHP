<div class="card-group justify-content-center">
  <table class="table table-hover">
    <tr>
      <th></th>
      <th><?= $title ?> Name</th>
      <th>Created By</th>
      <?php if (isset($page_tab) && $page_tab === 'tests') : ?>
        <th>Active</th>
      <?php endif; ?>
      <th>Date</th>
      <?php if ($_SERVER['REQUEST_URI'] !== '/tests') : ?>
        <th>
          Actions
        </th>
      <?php endif; ?>
    </tr>

    <?php if (isset($classes) && $classes) : ?>

      <?php foreach ($classes as $class) : ?>

        <tr>
          <td>
            <a href="/single_<?= strtolower($title) ?>?id=<?= $class[strtolower($title) . "_id"] ?>" class="btn btn-sm btn-primary">
              <i class="fa fa-chevron-right"></i>
            </a>
          </td>
          <td><?= $class[strtolower($title) . '_name'] ?></td>
          <td>
            <?= $class['user']['last_name'] ?> <?= $class['user']['first_name'] ?>
          </td>
          <?php if (isset($page_tab) && $page_tab === 'tests') : ?>
            <td><?= $class['disabled'] === 0 ? 'Yes' : 'No' ?></td>
          <?php endif; ?>
          <td><?= formatDate($class['createdAt']) ?></td>

          <?php if ($_SERVER['REQUEST_URI'] !== '/tests') : ?>
            <?php if (access('lecturer')) : ?>
              <td>
                <?php
                if (isset($page_tab) && $page_tab === 'tests') {
                  $test = strtolower($class['test_name']);
                }
                ?>
                <a href='/<?= isset($page_tab) && $page_tab === "tests"  ? "single_class/test?id={$_GET['id']}&tab=test-edit&test=$test" : "class/edit?id={$class['id']}" ?>' class="btn btn-sm btn-info text-white">
                  <i class="fa fa-edit"></i>
                </a>
                <a href='/<?= isset($page_tab) && $page_tab === "tests"  ? "single_class/test?id={$_GET['id']}&tab=test-delete&test={$class['test_name']}" : "class/delete?id={$class['id']}" ?>' type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
              </td>
            <?php endif; ?>
          <?php endif; ?>
        </tr>

      <?php endforeach; ?>

    <?php else : ?>
      <tr>
        <td colspan="5">
          <h3 align="center">No <?= strtolower($title) ?> present at this moment.</h3>
        </td>
      </tr>
    <?php endif; ?>
  </table>
</div>