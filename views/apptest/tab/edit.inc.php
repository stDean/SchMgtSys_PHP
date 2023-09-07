<?php if ($question) : ?>

  <h3 align='center'>Edit Question</h3>

  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PATCH">
    <?php if (!empty($errors)) : ?>
      <div class="alert alert-warning alert-dismissible fade show pr-0" role="alert">
        <strong>Errors</strong><br>
        <?php foreach ($errors as $key => $val) : ?>
          <small><?= $val ?></small> <br>
        <?php endforeach; ?>
        <small type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></small>
      </div>
    <?php endif; ?>


    <label class="mb-2" for="question">Question:</label>
    <textarea <?= isset($errors['question']) ? '' : 'autofocus' ?> class="form-control <?= isset($errors['question']) ? 'border border-danger' : '' ?>" name="question" placeholder="Type your question here" id="question"><?= $question['question'] ?></textarea>

    <div class="mt-3 input-group">
      <label class="input-group-text" for="comment">Comment (Optional):</label>
      <input type="text" name="comment" id="comment" value="<?= $question['comment'] ?? '' ?>" class="form-control" />
    </div>

    <div class="input-group my-2">
      <label class="input-group-text" for="image"><i class="fa fa-image"></i>image(optional)</label>
      <input type="file" name="image" class="form-control" id="image" value="<?= $question['image'] ?? '' ?>">
    </div>

    <?php if ($question['image']) : ?>
      <div class="my-2">
        <img src="/<?= $question['image'] ?>" alt="question diagram" class="d-block w-50 mx-auto">
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['type']) && $_GET['type'] === 'german') : ?>
      <div class="input-group my-2">
        <label class="input-group-text" for="correct_answer">Answer:</label>
        <input type="text" name="correct_answer" class="form-control <?= isset($errors['correct_answer']) ? 'border border-danger' : '' ?>" id="correct_answer" placeholder="enter correct correct_answer" value="<?= $question['correct_answer'] ?>">
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['type']) && $_GET['type'] === 'multiple') : ?>
      <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
          <b>Options</b>
          <button class="btn btn-sm float-end btn-primary" onclick="addChoice()" type="button"><i class="fa fa-plus"></i>Add Choice</button>
        </div>


        <?php
        // $cho = json_decode(old('choices'));
        // dump($cho->A) 
        ?>
        <ul class="list-group list-group-flush choice-list">
          <?php if (!empty(old('choices'))) : ?>
            <?php
            //check for multiple choice answers
            $num = 0;
            $letters = ['A', 'B', 'C', 'D', 'F', 'G', 'H', 'I', 'J'];

            foreach ($_SESSION['_flash']['old'] as $key => $val) {
              if (strstr($key, 'choice')) {
                $value = json_decode($val);
                foreach ($value as $key => $val) {
            ?>
                  <li class="list-group-item">
                    <span style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px">
                      <span><?= $letters[$num] ?></span> <input type="text" class="form-control" value="<?= $val ?>" name="choice<?= $num ?>" placeholder="Type your answer here">
                    </span>
                    <label style="cursor: pointer;"><input type="radio" <?= $letters[$num] == old('correct_answer') ? 'checked' : ''; ?> value="<?= $letters[$num] ?>" name="correct_answer"> Correct answer</label>
                  </li>
            <?php
                  $num++;
                }
              }
            }
            ?>
          <?php else : ?>
            <?php
            $choices = json_decode($question['choices']);
            $num = 0;
            ?>
            <?php foreach ($choices as $key => $choice) : ?>
              <li class="list-group-item">
                <span style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px">
                  <span><?= $key ?></span> <input type="text" class="form-control" name="choice<?= $num ?>" value="<?= $choice ?>">
                </span>
                <label style="cursor: pointer;"><input type="radio" value="<?= $key ?>" name="correct_answer" <?= $question['correct_answer'] === $key ? 'checked' : ''; ?>> Correct answer</label>
              </li>
              <?php $num++; ?>
            <?php endforeach; ?>
          <?php endif; ?>

        </ul>
      </div>
    <?php endif; ?>

    <a href="/single_test?id=<?= $test['test_id'] ?>">
      <button type="button" class="btn btn-sm btn-secondary">
        <i class="fa fa-chevron-left"></i>Back
      </button>
    </a>

    <button class="btn btn-sm btn-success float-end">Save Changes</button>
  </form>

<?php else : ?>
  <h4 align='center' class="my-4">Question does not exist</h4>

  <a href="/single_test?id=<?= $test['test_id'] ?>">
    <button type="button" class="btn btn-sm btn-secondary">
      <i class="fa fa-chevron-left"></i>Back
    </button>
  </a>
<?php endif; ?>