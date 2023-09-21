<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

// dump($marked);
?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">

  <h3 align='center'>Marked Tests</h3>

  <nav class="navbar navbar-light bg-light">
    <?php require base_path("/views/partials/searchForm.php") ?>
  </nav>

  <div class="card-group justify-content-center">
    <div class="table-responsive p-0 container-fluid">
      <table class="table table-hover">
        <tr>
          <th>Test Name</th>
          <th>Student</th>
          <th>Submitted Date</th>
          <th>Marked By</th>
          <th>Marked Date</th>
          <th>Answered</th>
          <th>Score</th>
          <th>Actions</th>
        </tr>

        <?php if ($marked) : ?>
          <?php foreach ($marked as $mark) : ?>
            <tr>
              <td><?= $mark['test']['test_name'] ?></td>

              <td>
                <?= htmlspecialchars($mark['user']['last_name']) ?> <?= htmlspecialchars($mark['user']['first_name']) ?>
              </td>

              <td>
                <?= formatDate($mark['submitted_date']) ?>
              </td>

              <?php
              $db = Core\App::resolve(Core\Database::class);
              $marker = $db->query("SELECT first_name, last_name FROM users WHERE user_id=:user_id", [
                'user_id' => $mark['marked_by']
              ])->find();

              // dd($marker);
              ?>
              <td><?= htmlspecialchars($marker['last_name']) ?> <?= htmlspecialchars($marker['first_name']) ?></td>

              <td><?= formatDate($mark['marked_date']) ?></td>

              <td><?= getAnsweredPercentage($mark['test_id'], $mark['user_id']) ?>%</td>
              <td><?= getScorePercentage($mark['test_id'], $mark['user_id']); ?>%</td>

              <td>
                <a href="/mark_view?test=<?= $mark['test_id'] ?>&user=<?= $mark['user_id'] ?>" class="btn btn-sm btn-primary">
                  <i class="fa fa-chevron-right"></i>
                  View Test
                </a>
              </td>
            </tr>
          <?php endforeach; ?>


        <?php else : ?>
          <tr>
            <td colspan="7">
              <h3 align="center">No Test Marked This Moment.</h3>
            </td>
          </tr>
        <?php endif; ?>
      </table>
    </div>
  </div>

</div>

<?php

require base_path("/views/partials/footer.php");

?>