<form method="POST" class="form mx-auto" style="width: 100%; max-width: 400px; margin-top: 20px;">
  <h4>Add Lecturer</h4>
  <input class="form-control" name="name" type="text" placeholder="lecturer name" autofocus><br>
  <button class="btn btn-success float-end">Search</button>
  <a href="/single_class?id=<?= $class['class_id'] ?>&tab=lecturer" class="btn btn-secondary float-start">Cancel</a>
  <div class="clearfix"> </div>
</form>

<div class="container-fluid">
  <?php if (isset($result) && $result) : ?>
    <?php foreach ($result as $row) : ?>
      <?php require base_path('/views/partials/single_user.php'); ?>
    <?php endforeach; ?>
  <?php else : ?>
    <?php if (count($_POST) > 0) : ?>
      <hr>
      <h4 align='center'>No results were found.</h4>
    <?php endif; ?>
  <?php endif; ?>
</div>