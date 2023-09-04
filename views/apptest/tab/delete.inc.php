<?php if ($question) : ?>

  <h3 align='center'>Delete Question</h3>

  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="DELETE">


    <label class="mb-2" for="question">Question:</label>
    <textarea readonly class="form-control" name="question" id="question"><?= $question['question'] ?></textarea>

    <div class="my-3 input-group">
      <label class="input-group-text" for="comment">Comment (Optional):</label>
      <input type="text" readonly name="comment" id="comment" value="<?= $question['comment'] ?? '' ?>" class="form-control" />
    </div>

    <?php if ($question['image']) : ?>
      <div class="my-2">
        <img src="/<?= $question['image'] ?>" alt="question diagram" class="d-block w-50 mx-auto">
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['type']) && $_GET['type'] === 'german') : ?>
      <div class="input-group my-2">
        <label class="input-group-text" for="correct_answer">Answer:</label>
        <input readonly type="text" name="correct_answer" class="form-control" id="correct_answer" value="<?= $question['correct_answer'] ?>">
      </div>
    <?php endif; ?>

    <a href="/single_test?id=<?= $test['test_id'] ?>">
      <button type="button" class="btn btn-sm btn-secondary">
        <i class="fa fa-chevron-left"></i>Back
      </button>
    </a>

    <button class="btn btn-sm btn-danger float-end">Confirm Delete</button>
  </form>

<?php else : ?>
  <h4 align='center' class="my-4">Question does not exist</h4>

  <a href="/single_test?id=<?= $test['test_id'] ?>">
    <button type="button" class="btn btn-sm btn-secondary">
      <i class="fa fa-chevron-left"></i>Back
    </button>
  </a>
<?php endif; ?>