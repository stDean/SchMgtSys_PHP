<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">

  <?php if ($test) : ?>
    <div class="card-group justify-content-center">
      <form action="/single_class?id=<?= $_GET['id'] ?>&tab=tests" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $test['id'] ?>">

        <h3 class=" mb-2">Edit Test</h3>

        <?php if (!empty($errors)) : ?>
          <div class="alert alert-warning alert-dismissible fade show pr-0" role="alert">
            <strong>Errors</strong><br>
            <?php foreach ($errors as $key => $val) : ?>
              <small><?= $val ?></small> <br>
            <?php endforeach; ?>
            <small type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></small>
          </div>
        <?php endif; ?>

        <input type="text" name="test_name" class="form-control  <?= isset($errors['test_name']) ? 'border border-danger' : '' ?>" placeholder="Class Name" value="<?= $test['test_name'] ?>" />

        <div style="display: flex; justify-content: space-between;" class="mt-2 mb-3">
          <div class="form-check">
            <input class="form-check-input" type="radio" value="0" name="disabled" <?= $test['disabled'] === 0 ? 'checked' : '' ?>>
            <label class="form-check-label" for="disabled">
              Active
            </label>

          </div>

          <span> | </span>

          <div class="form-check">
            <input class="form-check-input" type="radio" value="1" name="disabled" <?= $test['disabled'] === 1 ? 'checked' : '' ?>>
            <label class="form-check-label" for="disabled">
              Inactive
            </label>
          </div>
        </div>

        <input type="submit" value="Edit" class="btn btn-sm btn-primary float-end" />
        <a href="<?= $_SERVER['HTTP_REFERER'] ?>">
          <input type="button" value="Cancel" class="btn btn-sm btn-danger float-start" />
        </a>
      </form>
    </div>

  <?php else : ?>

    <div>
      <h2 align='center'>No Test was found</h2>

      <a href="/single_class?id=<?= $_GET['id'] ?>&tab=tests">
        <input type="button" value="Back" class="btn btn-danger float-start" />
      </a>

      <div class="clearfix"> </div>
    </div>

  <?php endif; ?>

</div>