<div class="card-group justify-content-center">
  <table class="table table-hover">
    <tr>
      <th></th>
      <th><?= $title ?> Name</th>
      <th>Created By</th>
      <th>Date</th>
      <th>
        Actions
      </th>
    </tr>

    <?php if (isset($classes) && $classes) : ?>

      <?php foreach ($classes as $class) : ?>

        <tr>
          <td>
            <a href="/single_<?= strtolower($title) ?>?id=<?= $class[strtolower($title) . "_id"] ?>" class="btn btn-sm btn-primary">
              <i class="fa fa-chevron-right"></i>
            </a>
          </td>
          <td><?= $class['class_name'] ?></td>
          <td>
            <?= $class['user']['last_name'] ?> <?= $class['user']['first_name'] ?>
          </td>
          <td><?= formatDate($class['createdAt']) ?></td>

          <?php if (access('lecturer')) : ?>
            <td>
              <a href="/<?= strtolower($title) ?>/edit?id=<?= $class['id'] ?>" class="btn btn-sm btn-info text-white">
                <i class="fa fa-edit"></i>
              </a>
              <a href="/<?= strtolower($title) ?>/delete?id=<?= $class['id'] ?>" type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
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