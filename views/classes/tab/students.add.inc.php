<form method="POST" class="form mx-auto" style="width: 100%; max-width: 400px; margin-top: 20px;">
  <h4>Add student</h4>

  <?php if (!empty($errors)) : ?>
    <div class="alert alert-warning alert-dismissible fade show pr-0" role="alert">
      <strong>Errors</strong><br>
      <?php foreach ($errors as $error) : ?>
        <small><?= $error ?></small> <br>
      <?php endforeach; ?>
      <small type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></small>
    </div>
  <?php endif; ?>
  
  <input class="form-control" name="name" type="text" placeholder="student name" value="<?= old('name') ?>" autofocus><br>
  <button class="btn btn-success float-end" name="search">Search</button>
  <a href="/single_class?id=<?= $class['class_id'] ?>&tab=students" class="btn btn-secondary float-start">Cancel</a>
  <div class="clearfix"> </div>
</form>

<br>
<div class="container-fluid">
  <form method="POST">
    <?php if (isset($result) && $result) : ?>
      <table class="table table-striped">
        <tr>
          <th></th>
          <th>Name</th>
          <th>Action</th>
        </tr>
        <?php foreach ($result as $row) : ?>
          <tr>
            <td>
              <img src="<?= getImage($row) ?>" alt="profile photo" class="d-block mx-auto card-img-top" style="width: 40px; height: 40px; border-radius:50%;">
            </td>
            <td style="padding-top: 15px;">
              <b>
                <?= htmlspecialchars($row['first_name']); ?> <?= htmlspecialchars($row['last_name']); ?>
              </b>
            </td>
            <td style="padding-top: 12px;">
              <a href="/profile?user=<?= htmlspecialchars(strtolower($row['user_id'])) ?>" class="btn btn-sm btn-primary">
                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                Profile
              </a>
              <button class="btn btn-sm btn-success" name="selected" value="<?= htmlspecialchars($row['user_id']); ?>">Select</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php else : ?>
      <?php if (count($_POST) > 0) : ?>
        <hr>
        <h4 align='center'>No results were found.</h4>
      <?php endif; ?>
    <?php endif; ?>
  </form>
</div>