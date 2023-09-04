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