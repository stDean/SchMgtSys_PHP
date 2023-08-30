<div class="container-fluid p-4 shadow mx-auto mt-4" style="max-width: 1000px">
  <div class="card-group justify-content-center">
    <form  method="POST">
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="id" value="<?= $test['id'] ?>">

      <h3 class=" mb-2">Are you sure you want to delete?</h3>

      <input type="text" name="test_name" class="form-control  <?= isset($errors['test_name']) ? 'border border-danger' : '' ?>" placeholder="Class Name" value="<?= $test['test_name'] ?>" /><br>
      <input type="submit" value="Delete" class="btn btn-sm btn-danger float-end" />
      <a href="/single_class?id=<?= $_GET['id'] ?>&tab=tests">
        <input type="button" value="Cancel" class="btn btn-sm btn-success float-start" />
      </a>
    </form>
  </div>

</div>