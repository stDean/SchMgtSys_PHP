<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <?php if ($test && !$test['disabled']) : ?>
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

          <th>Class:</th>
          <th>
          <td><?= $test['class']['class_name'] ?></td>
          </th>
        </tr>
      </table>
    </div>

    <nav class="navbar">
      <h3>Test Questions</h3>
      <p><b>Total Question:</b> <?= $total_questions ?></p>
    </nav>

    <a href='/tests'>
      <button class="btn btn-sm btn-secondary float-end">Back</button>
    </a>
    <div class="clearfix"></div>

    <hr>

    <?php if ($questions) : ?>
      <form method="POST">
        <?php $num = 0; ?>
        <?php foreach ($questions as $question) : $num++ ?>
          <div class="card my-2">
            <div class="card-header bg-warning">
              <span style="font-weight: 500;">
                Question #<?= $num ?>
              </span>
              <span class=" float-end"><?= formatDate($question['createdAt']) ?></span>
            </div>
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($question['question']) ?></h5>

              <?php if (isset($question['image'])) : ?>
                <img src="<?= $question['image'] ?>" alt="question illustration" style='width: 40%;'>
              <?php endif; ?>
              <p class="card-text m-0"><?= $question['comment'] ?></p>

              <?php if ($question['question_type'] === 'theory') :  ?>
                <textarea class="form-control mt-2" name="<?= $question['id'] ?>" placeholder="enter answer here"></textarea>
              <?php endif ?>

              <?php if ($question['question_type'] === 'german') :  ?>
                <input class="form-control mt-2" type="text" name="<?= $question['id'] ?>" placeholder="enter answer here">
              <?php endif ?>


              <?php if ($question['question_type'] === 'multiple') :  ?>
                <div class="card my-2" style="width: 25rem;">
                  <div class="card-header">
                    Options
                  </div>
                  <ul class="list-group list-group-flush">
                    <?php $choices = json_decode($question['choices']); ?>

                    <?php foreach ($choices as $key => $choice) : ?>
                      <label for="choice<?= $key ?>">
                        <li class="list-group-item" style="cursor: pointer;">
                          <?= $key ?>. <?= $choice ?>
                          <input type="radio" name="<?= $question['id'] ?>" value="<?= $key ?>" class="float-end" style="transform: scale(1.3); margin-top: 6px;" id="choice<?= $key ?>" />
                        </li>
                      </label>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>

            </div>
          </div>
        <?php endforeach; ?>

        <center class="mt-3">
          <button class="btn btn-success">Submit Answers</button>
        </center>

      </form>

    <?php else : ?>
      <h3 align='center' class="my-4">No Question Yet, Check Back Later.</h3>
    <?php endif; ?>

  <?php else : ?>
    <h4 align='center'>Test does not exist!</h4>
    <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-sm btn-primary">
      Go back
    </a>
  <?php endif; ?>
</div>

<?php

require base_path("/views/partials/footer.php");

?>