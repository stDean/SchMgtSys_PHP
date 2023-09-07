<h3 align='center'>Add Question</h3>

<form method="POST" enctype="multipart/form-data">
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
  <textarea <?= isset($errors['question']) ? '' : 'autofocus' ?> class="form-control <?= isset($errors['question']) ? 'border border-danger' : '' ?>" name="question" placeholder="Type your question here" id="question"><?= old('question') ?></textarea>

  <div class="mt-3 input-group">
    <label class="input-group-text" for="comment">Comment (Optional):</label>
    <input type="text" name="comment" id="comment" placeholder="comment (e.g point for question)" class="form-control" />
  </div>

  <div class="input-group my-2 <?= !isset($_GET['type']) ? "mb-4" : '' ?>">
    <label class="input-group-text" for="image"><i class="fa fa-image"></i>image(optional)</label>
    <input type="file" name="image" class="form-control" id="image">
  </div>

  <?php if (isset($_GET['type']) && $_GET['type'] === 'german') : ?>
    <div class="input-group mb-4">
      <label class="input-group-text" for="correct_answer">Answer:</label>
      <input type="text" name="correct_answer" class="form-control <?= isset($errors['correct_answer']) ? 'border border-danger' : '' ?>" id="correct_answer" placeholder="enter correct correct_answer" value="<?= old('correct_answer') ?>">
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
          <li class="list-group-item">
            <span style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px">
              <span>A</span> <input type="text" class="form-control" name="choice0" placeholder="Type your answer here">
            </span>
            <label style="cursor: pointer;"><input type="radio" value="A" name="correct_answer"> Correct answer</label>
          </li>

          <li class="list-group-item">
            <span style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px">
              <span>B</span> <input type="text" class="form-control" name="choice1" placeholder="Type your answer here">
            </span>
            <label style="cursor: pointer;"><input type="radio" value="B" name="correct_answer"> Correct answer</label>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  <?php endif; ?>

  <a href="/single_test?id=<?= $test['test_id'] ?>">
    <button type="button" class="btn btn-sm btn-secondary">
      <i class="fa fa-chevron-left"></i>Back
    </button>
  </a>

  <button class="btn btn-sm btn-success float-end">Save Question</button>
</form>

<script>
  const letters = ['A', 'B', 'C', 'D', 'F', 'G', 'H', 'I', 'J'];

  function addChoice() {
    const choices = document.querySelector('.choice-list')
    if (choices.children.length < letters.length) {
      choices.innerHTML += `
        <li class="list-group-item">
          <span style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px">
          <span>${letters[choices.children.length]}</span> <input type="text" class="form-control" name="choice${choices.children.length}" placeholder="Type your answer here">
          </span>
          <label style="cursor: pointer;"><input type="radio" value="${letters[choices.children.length]}" name="correct_answer"> Correct answer</label>
        </li>
      `
    }
  }
</script>