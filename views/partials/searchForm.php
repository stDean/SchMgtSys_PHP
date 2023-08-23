<form class="form-inline">
  <div class="input-group">
    <input type="text" value="<?= isset($_GET['search']) ? $_GET['search'] : "" ?>" class="form-control" name="search" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
    <button type="submit" class="input-group-text" id="basic-addon1">
      <i class="fa fa-search"></i>
    </button>
  </div>
</form>