<?php

require base_path("/views/partials/head.php");
require base_path("/views/partials/nav.php");

?>

<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <?php if ($test && !$test['disabled'] && $answeredTest) : ?>
    <div class="row">
      <h3 align='center' style="margin-bottom: 15px;"><?= htmlspecialchars($test['test_name']) ?></h3>
      <table class="table table-striped">
        <tr>
          <th>Student Name:
          <th>
          <td><?= htmlspecialchars($student['first_name']) ?> <?= htmlspecialchars($student['last_name']) ?></td>
          </th>
          </th>

          <th>Submitted Date:
          <th>
          <td><?= formatDate($answeredTest['submitted_date']) ?></td>
          </th>
          </th>

          <th>Class:</th>
          <th>
          <td><?= $test['class']['class_name'] ?></td>
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

      <?php if ($answeredTest && $answeredTest['submitted'] && !$answeredTest['marked']) : ?>
        <p class="text-warning">This test has not been marked.</p>
        <a href="/mark?test=<?= $_GET['test'] ?>&user=<?= $_GET['user'] ?>&marked=true">
          <button class="btn btn-sm btn-success float-end mx-1" onclick="setAsMarked(event)">Save Marked</button>
        </a>

        <a href="/mark?test=<?= $_GET['test'] ?>&user=<?= $_GET['user'] ?>&auto=true">
          <button class="btn btn-sm btn-primary float-end mx-1" onclick="autoMark(event)">Auto Mark</button>
        </a>

        <a href="/mark?test=<?= $_GET['test'] ?>&user=<?= $_GET['user'] ?>&unsubmit=true">
          <button class="btn btn-sm btn-danger float-end mx-1" onclick="unSubmitTest(event)">Un-Submit Test</button>
        </a>
        <div class="clearfix"></div>

      <?php else : ?>
        <p class="text-success">This test is marked.</p>
      <?php endif; ?>
      <div>
      </div>
    </div>

    <?php if ($answeredTest['marked']) : ?>
      <?php $scorePercent = getScorePercentage($test['test_id'], $student['user_id']); ?>
      <p align='center' style="font-size: 25px; font-weight: bold; margin: 0;">
        <small>Test Score:</small> <span style="font-size: 60px; color: purple;"><?= $scorePercent ?>%</span>
      </p>
    <?php endif; ?>

    <nav class="navbar">
      <h3>Test Questions</h3>
      <p><b>Total Question:</b> <?= $total_questions ?></p>
    </nav>

    <a href='/mark_test'>
      <button class="btn btn-sm btn-secondary float-end">Back</button>
    </a>


    <div class="clearfix"></div>

    <hr>

    <?php if ($questions) : ?>
      <form method="POST">
        <?php if (!empty($errors)) : ?>
          <div class="alert alert-warning alert-dismissible fade show pr-0" role="alert">
            <strong>Errors</strong><br>
            <?php foreach ($errors as $key => $val) : ?>
              <small><?= $val ?></small> <br>
            <?php endforeach; ?>
            <small type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></small>
          </div>
        <?php endif; ?>

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
                <p>Teacher Mark:</p>
                <?php if (!$answeredTest['marked']) : ?>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?= $question['id'] ?>" value="1" id="correct" <?= getMarkedAnswer($answers, $question['id']) === 1 ? "checked" : "" ?>>
                    <label class="form-check-label" for="correct">
                      Correct
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?= $question['id'] ?>" value="2" id="incorrect" <?= getMarkedAnswer($answers, $question['id']) === 2 ? "checked" : "" ?>>
                    <label class="form-check-label" for="incorrect">
                      Incorrect
                    </label>
                  </div>
                <?php else : ?>
                  <div style="font-size: 45px;">
                    <?= getMarkedAnswer($answers, $question['id']) === 1 ? "<i class='fa fa-check float-end'  style='color: green;'></i>" : "<i class='fa fa-times float-end'  style='color: red;'></i>" ?>
                  </div>
                <?php endif ?>
              <?php endif ?>

              <?php if ($question['question_type'] === 'german') :  ?>
                <div><b>Answer:</b> <?= getAnswer($answers, $question['id']) ?></div>
                <hr>
                <p>Teacher Mark:</p>
                <?php if (!$answeredTest['marked']) : ?>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?= $question['id'] ?>" value="1" id="correct" <?= getMarkedAnswer($answers, $question['id']) === 1 ? "checked" : "" ?> <?= $answeredTest['marked'] ? 'disabled' : '' ?>>
                    <label class="form-check-label" for="correct">
                      Correct
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?= $question['id'] ?>" value="2" id="incorrect" <?= getMarkedAnswer($answers, $question['id']) === 2 ? "checked" : "" ?> <?= $answeredTest['marked'] ? 'disabled' : '' ?>>
                    <label class="form-check-label" for="incorrect">
                      Incorrect
                    </label>
                  </div>
                <?php else : ?>
                  <div style="font-size: 45px;">
                    <?= getMarkedAnswer($answers, $question['id']) === 1 ? "<i class='fa fa-check float-end'  style='color: green;'></i>" : "<i class='fa fa-times float-end'  style='color: red;'></i>" ?>
                  </div>
                <?php endif ?>
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
                  <p>Teacher Mark:</p>
                  <?php if (!$answeredTest['marked']) : ?>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="<?= $question['id'] ?>" value="1" id="correct" <?= getMarkedAnswer($answers, $question['id']) === 1 ? "checked" : "" ?> <?= $answeredTest['marked'] ? 'disabled' : '' ?>>
                      <label class="form-check-label" for="correct">
                        Correct
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="<?= $question['id'] ?>" value="2" id="incorrect" <?= getMarkedAnswer($answers, $question['id']) === 2 ? "checked" : "" ?> <?= $answeredTest['marked'] ? 'disabled' : '' ?>>
                      <label class="form-check-label" for="incorrect">
                        Incorrect
                      </label>
                    </div>
                  <?php else : ?>
                    <div style="font-size: 45px;">
                      <?= getMarkedAnswer($answers, $question['id']) === 1 ? "<i class='fa fa-check float-end' style='color: green;'></i>" : "<i class='fa fa-times float-end'  style='color: red;'></i>" ?>
                    </div>
                  <?php endif ?>
                </div>
              <?php endif; ?>

            </div>
          </div>
        <?php endforeach; ?>

        <?php $pager->display(); ?>

        <?php if ($answeredTest && $answeredTest['marked']) : ?>
        <?php else : ?>
          <center class="mt-3">
            <button class="btn btn-success">Save Marks</button>
            <br>
            <small>save marks and move to the next page</small>
          </center>
        <?php endif; ?>
      </form>

    <?php else : ?>
      <h3 align='center' class="my-4">No Question Yet, Check Back Later.</h3>
    <?php endif; ?>

  <?php else : ?>
    <h4 align='center'>Test Has Not Been Submitted!</h4>
    <a href="/mark_test" class="btn btn-sm btn-primary">
      Go back
    </a>
  <?php endif; ?>
</div>



<?php

require base_path("/views/partials/footer.php");

?>

<script>
  let marked = <?= $markedPercent ?>;

  function unSubmitTest(e) {
    const getRes = confirm('Are you sure you want to un-submit this test?');

    if (!getRes) {
      e.preventDefault();
      return;
    }
  }

  function autoMark(e) {
    const getRes = confirm('Are you sure you want to auto mark this test?');

    if (!getRes) {
      e.preventDefault();
      return;
    }
  }

  function setAsMarked(e) {
    const getRes = confirm('Are you sure you want to save this test as marked?');

    if (!getRes) {
      e.preventDefault();
      return;
    }

    if (marked < 100) {
      e.preventDefault();
      alert("Only " + marked + "% of questions have been marked, action cannot be performed unless all questions are marked.")
      return;
    }

  }
</script>