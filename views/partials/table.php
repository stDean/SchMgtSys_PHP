<div class="card-group justify-content-center">
  <table class="table table-stripped table-hover">
    <tr>
      <th></th>
      <th>Class Name</th>
      <th>Created By</th>
      <th>Date</th>
      <th>
        <a href="/classes/create" class="btn btn-sm btn-primary "><i class="fa fa-plus"></i>Add New Class</a>
      </th>
    </tr>

    <?php if (isset($classes) && $classes) : ?>

      <?php foreach ($classes as $class) : ?>

        <tr>
          <td>
            <a href="/single_class?id=<?= $class['class_id'] ?>" class="btn btn-sm btn-primary">
              <i class="fa fa-chevron-right"></i>
            </a>
          </td>
          <td><?= $class['class_name'] ?></td>
          <td>
            <?= $class['user']['last_name'] ?> <?= $class['user']['first_name'] ?>
          </td>
          <td><?= formatDate($class['createdAt']) ?></td>
          <td>
            <a href="/classes/edit?id=<?= $class['id'] ?>" class="btn btn-sm btn-info text-white">
              <i class="fa fa-edit"></i>
            </a>
            <a href="/classes/delete?id=<?= $class['id'] ?>" type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>

    <?php else : ?>
      <h2 class="py-4">No Classes present at this moment.</h2>
    <?php endif; ?>
  </table>
</div>