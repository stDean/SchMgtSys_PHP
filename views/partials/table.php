<div class="card-group justify-content-center">
  <div class="table-responsive p-0 container-fluid">
    <table class="table table-hover">
      <tr>
        <?php

        use Core\Session;

        if ((isset($page_tab) && $page_tab === 'classes') || $_SERVER['REQUEST_URI'] == '/classes' || access('reception')) : ?>
          <th></th>
        <?php endif; ?>
        <th><?= $title ?> Name</th>
        <th>Created By</th>

        <?php if ($_SERVER['REQUEST_URI'] == '/tests' && access('lecturer')) : ?>
          <th>Active</th>
        <?php elseif ($_SERVER['REQUEST_URI'] !== '/classes' && (isset($page_tab) ? ($page_tab === 'test' || $page_tab === 'tests') : 'true')) : ?>
          <th>Answered</th>
        <?php endif; ?>

        <?php if (isset($page_tab) && $page_tab === 'test') : ?>
          <th>Taken</th>
        <?php endif; ?>

        <th>Date</th>
        <?php if ((isset($page_tab) && $page_tab === 'test') || access('admin') || $_SERVER['REQUEST_URI'] === '/tests' && getUserRank() !== 'RECEPTION') : ?>
          <th>
            Actions
          </th>
        <?php endif; ?>
      </tr>

      <?php if (isset($classes) && $classes) : ?>

        <?php foreach ($classes as $class) : ?>

          <tr>
            <?php if ((isset($page_tab) && $page_tab === 'classes') || $_SERVER['REQUEST_URI'] == '/classes' || access('reception')) : ?>
              <td>
                <a href="/single_<?= strtolower($title) ?>?id=<?= $class[strtolower($title) . "_id"] ?>" class="btn btn-sm btn-primary">
                  <i class="fa fa-chevron-right"></i>
                </a>
              </td>
            <?php endif; ?>

            <td><?= $class[strtolower($title) . '_name'] ?></td>
            <td>
              <?= $class['user']['last_name'] ?> <?= $class['user']['first_name'] ?>
            </td>

            <?php if ($_SERVER['REQUEST_URI'] == '/tests' && access('lecturer')) : ?>
              <td><?= $class['disabled'] ? 'No' : 'Yes' ?></td>
            <?php elseif ($_SERVER['REQUEST_URI'] !== '/classes' && isset($class['test_id'])) : ?>
              <?php
              $arr = explode('?', $_SERVER['REQUEST_URI'])[0];
              $id = $arr === '/profile' ? $_GET['user'] : Session::getUser_Id();
              ?>
              <td><?= getAnsweredPercentage($class['test_id'], $id) ?>%</td>
            <?php endif; ?>

            <?php if (isset($page_tab) && $page_tab === 'test') : ?>
              <td><?= hasTakenTest($class['test_id']) ?></td>
            <?php endif; ?>
            <td><?= formatDate($class['createdAt']) ?></td>

            <?php if (access('lecturer')) : ?>
              <td>
                <?php
                if ((isset($page_tab) && ($page_tab === "test" || $page_tab === "tests") || $_SERVER['REQUEST_URI'] === '/tests')) {
                  $test = strtolower($class['test_name']);
                }
                ?>
                <a href='/<?= (isset($page_tab) && ($page_tab === "test" || $page_tab === "tests") || $_SERVER['REQUEST_URI'] === '/tests') ? "single_class/test?id=" . $class['class_id'] . "&tab=test-edit&test={$test}" : "class/edit?id={$class['id']}" ?>' class="btn btn-sm btn-info text-white">
                  <i class="fa fa-edit"></i>
                </a>
                <a href='/<?= (isset($page_tab) && ($page_tab === "test" || $page_tab === "tests") || $_SERVER['REQUEST_URI'] === '/tests') ? "single_class/test?id=" . $class['class_id'] . "&tab=test-delete&test={$test}" : "class/delete?id={$class['id']}" ?>' type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
              </td>
            <?php elseif (canTakeTest($class[strtolower($title) . '_id']) && (isset($page_tab) && $page_tab === 'test') || $_SERVER['REQUEST_URI'] === '/tests' && getUserRank() !== 'RECEPTION') : ?>
              <td>
                <a href="/take<?= strtolower($title) ?>?id=<?= $class[strtolower($title) . "_id"] ?>">
                  <button class="btn btn-sm btn-success">Take Test</button>
                </a>
              </td>
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
</div>