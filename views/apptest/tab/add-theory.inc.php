<h3 align='center'>Add Questions</h3>

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

  <label class="mb-2">Question:</label>
  <textarea <?= isset($errors['question']) ? '' : 'autofocus' ?> class="form-control <?= isset($errors['question']) ? 'border border-danger' : '' ?>" name="question" placeholder="Type your question here"><?= old('question') ?></textarea>

  <div class="input-group my-3 ">
    <label class="input-group-text" for="inputGroupFile01"><i class="fa fa-image"></i>image(optional)</label>
    <input type="file" name="image" class="form-control" id="inputGroupFile01">
  </div>

  <a href="/single_test/<?= $test['test_id'] ?>">
    <button type="button" class="btn btn-sm btn-secondary">
      <i class="fa fa-chevron-left"></i>Back
    </button>
  </a>

  <button class="btn btn-sm btn-success float-end">Save Question</button>
</form>