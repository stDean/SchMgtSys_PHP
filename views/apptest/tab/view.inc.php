<?php if ($test['disabled']) : ?>

  <nav class="navbar">
    <div>
      <h3>Test Questions</h3>
      <p style="margin: 5px;">
        <b>Total Question:</b>
        <?= $total_questions ?>
      </p>
    </div>

    <?php if (onlyLecturer()) : ?>
      <div class="btn-group">
        <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          Add
        </button>
        <ul class="dropdown-menu  dropdown-menu-end">
          <li><a class="dropdown-item" href="/single_test/addquestion?id=<?= $test['test_id'] ?>&type=multiple&tab=add">
              Add Multiple choice Question</a>
          </li>
          <li><a class="dropdown-item" href="/single_test/addquestion?id=<?= $test['test_id'] ?>&type=german&tab=add">
              Add German Question</a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="/single_test/addquestion?id=<?= $test['test_id'] ?>&tab=add">
              Add Theory Question</a>
          </li>
        </ul>
      </div>
    <?php endif; ?>

  </nav>

  <hr>
<?php endif; ?>


<?php if ($questions) : ?>
  <?php $num = ($total_questions + 1); ?>
  <?php foreach ($questions as $question) : $num-- ?>
    <div class="card my-2 shadow">
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

        <?php if ($question['question_type'] === 'multiple') :  ?>
          <div class="card my-2" style="width: 25rem;">
            <div class="card-header">
              Options
            </div>
            <ul class="list-group list-group-flush">
              <?php $choices = json_decode($question['choices']); ?>

              <?php foreach ($choices as $key => $choice) : ?>
                <li class="list-group-item">
                  <?= $key ?>. <?= $choice ?>
                  <?php if ($question['correct_answer'] === $key) : ?>
                    <i class="fa fa-check float-end"></i>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <?php if ($question['question_type'] === 'german' || $question['question_type'] === 'multiple') : ?>
          <p class="card-text m-0"><b>Answer: </b><?= $question['correct_answer'] ?></p>
        <?php endif; ?>

        <?php if (access('lecturer')) : ?>
          <?php if ($test['editable']) : ?>
            <p class="float-end m-0">
              <a href="/single_test/editquestion?id=<?= $question['test_id'] ?>&tab=edit&type=<?= $question['question_type'] ?>&quesId=<?= $question['id'] ?>">
                <button class="btn btn-sm btn-success">
                  <i class="fa fa-edit"></i>
                </button>
              </a>
              <a href="/single_test/deletequestion?id=<?= $question['test_id'] ?>&tab=delete&type=<?= $question['question_type'] ?>&quesId=<?= $question['id'] ?>">
                <button class="btn btn-sm btn-danger">
                  <i class="fa fa-trash"></i>
                </button>
              </a>
            </p>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
<?php else : ?>
  <h3 align='center' class="my-4">No Question Yet, Check Back Later.</h3>
<?php endif; ?>