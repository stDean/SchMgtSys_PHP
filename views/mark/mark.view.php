<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

$db = Core\App::resolve(Core\Database::class);
$lectName = $db->query("SELECT first_name, last_name FROM users WHERE user_id=:user_id", [
  'user_id' => $test['user_id']
])->find();

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <?php if ($test && !$test['disabled'] && $answeredTest) : ?>
    <div class="row">
      <h3 align='center' style="margin-bottom: 15px;"><?= htmlspecialchars($test['test_name']) ?></h3>
      <table class="table table-striped">
        <tr>
          <th>Student Name:
          <th>
          <td>
            <a href="/profile?user=<?= $student['user_id'] ?>&tab=test">
              <?= htmlspecialchars($student['first_name']) ?> <?= htmlspecialchars($student['last_name']) ?>
            </a>
          </td>
          </th>
          </th>

          <th>Created By:
          <th>
          <td>
            <?php if (access('reception')) : ?>
              <a href="/profile?user=<?= $test['user_id'] ?>">
              <?php endif; ?>
              <?= htmlspecialchars($lectName['first_name']) ?> <?= htmlspecialchars($lectName['last_name']) ?>
              <?php if (access('reception')) : ?>
              </a>
            <?php endif; ?>
          </td>
          </th>
          </th>

          <th>Submitted Date:
          <th>
          <td><?= formatDate($answeredTest['submitted_date']) ?></td>
          </th>
          </th>

          <th>Class:</th>
          <th>
          <td>
            <a href="/single_class?id=<?= $test['class']['class_id'] ?>">
              <?= $test['class']['class_name'] ?>
            </a>
          </td>
          </th>
        </tr>
      </table>
    </div>

    <div class="container-fluid text-center">
      <?php
      $markedPercent = getMarkedPercentage($test['test_id'], $student['user_id']);
      ?>

      <div class="text-danger"><b><?= $markedPercent ?>% Marked</b></div>
      <div class="bg-success" style="height: 5px; width: <?= $markedPercent ?>%;"></div>

      <p class="text-success">This test is marked.</p>
      <div>
      </div>
    </div>

    <?php if ($answeredTest['marked']) : ?>
      <?php $scorePercent = getScorePercentage($test['test_id'], $student['user_id']); ?>
      <p align='center' style="font-size: 25px; font-weight: bold; margin: 0;">
        <small>Test Score:</small> <span style="font-size: 60px; color: purple;"><?= $scorePercent ?>%</span>
      </p>
    <?php endif; ?>


    <?php if (onlyLecturer()) : ?>
      <a href='<?= $_SERVER['HTTP_REFERER'] ?>'>
        <button class="btn btn-sm btn-secondary float-end">Back</button>
      </a>
    <?php endif; ?>
    <div class="clearfix"></div>

    <hr>

    <?php if ($questions) : ?>

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
              <div><b>Answer:</b> <?= getAnswer($answers, $question['id']) ?></div>
              <hr>
              <div>
                <p class="m-0">Teacher Mark:</p>
                <div style="font-size: 45px;">
                  <?= getMarkedAnswer($answers, $question['id']) === 1 ? "<i class='fa fa-check float-end'  style='color: green;'></i>" : "<i class='fa fa-times float-end'  style='color: red;'></i>" ?>
                </div>
              </div>
            <?php endif ?>

            <?php if ($question['question_type'] === 'german') :  ?>
              <div><b>Answer:</b> <?= getAnswer($answers, $question['id']) ?></div>
              <hr>
              <div>
                <p class="m-0">Teacher Mark:</p>

                <div style="font-size: 45px;">
                  <?= getMarkedAnswer($answers, $question['id']) === 1 ? "<i class='fa fa-check float-end'  style='color: green;'></i>" : "<i class='fa fa-times float-end'  style='color: red;'></i>" ?>
                </div>
              </div>
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

                        <?php if (getAnswer($answers, $question['id']) === $key) : ?>
                          <i class="fa fa-check float-end mt-1"></i>
                        <?php endif; ?>
                      </li>
                    </label>
                  <?php endforeach; ?>
                </ul>
              </div>

              <hr>
              <div>
                <p class="m-0">Teacher Mark:</p>

                <div style="font-size: 45px;">
                  <?= getMarkedAnswer($answers, $question['id']) === 1 ? "<i class='fa fa-check float-end' style='color: green;'></i>" : "<i class='fa fa-times float-end'  style='color: red;'></i>" ?>
                </div>
              </div>
            <?php endif; ?>

          </div>
        </div>
      <?php endforeach; ?>

      <?php $pager->display(); ?>

    <?php endif; ?>
  <?php endif; ?>
</div>

<?php

require base_path("/views/partials/footer.php");

?>