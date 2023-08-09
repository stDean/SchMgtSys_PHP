<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <div class="input-group">
      <span class="input-group-text" id="basic-addon1">
        <i class="fa fa-search"></i>
      </span>
      <input type="text" class="form-control" name="search" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
    </div>
  </form>

  <a href='/single_class?id=<?= $class['class_id'] ?>&tab=test-add' class="btn btn-sm btn-primary ">
    <i class="fa fa-plus"></i>Add New Test
  </a>
</nav>