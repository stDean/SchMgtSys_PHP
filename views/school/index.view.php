<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">

  <div class="card-group justify-content-center">
    <table class="table table-stripped table-hover">
      <tr>
        <th>School</th>
        <th>Created By</th>
        <th>Date</th>
        <th>
          <a href="/schools/create" class="btn btn-sm btn-primary "><i class="fa fa-plus"></i>Add New School</a>
        </th>
      </tr>

      <?php if (!empty($schools)) : ?>

        <?php foreach ($schools as $school) : ?>

          <tr>
            <td><?= $school['schoolname'] ?></td>
            <td>
              <?= $school['user']['last_name'] ?> <?= $school['user']['first_name'] ?>
            </td>
            <td><?= formatDate($school['createdAt']) ?></td>
            <td>
              <a href="/schools/edit?id=<?= $school['id'] ?>" class="btn btn-sm btn-info text-white">
                <i class="fa fa-edit"></i>
              </a>
              <a href="/schools/delete?id=<?= $school['id'] ?>" type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>

      <?php else : ?>
        <h4>No Schools present at this moment.</h4>
      <?php endif; ?>
    </table>
  </div>

</div>

<?php

require base_path("/views/partials/footer.php");

?>