<nav class="navbar">
  <center>
    <h5>Test Questions</h5>

  </center>
  <div class="btn-group">
    <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      Add
    </button>
    <ul class="dropdown-menu  dropdown-menu-end">
      <li><a class="dropdown-item" href="/single_test/addquestion?id=<?= $test['test_id'] ?>&type=multiple">
          Add Multiple choice Question</a>
      </li>
      <li><a class="dropdown-item" href="/single_test/addquestion?id=<?= $test['test_id'] ?>&type=german">
          Add German Question</a>
      </li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item" href="/single_test/addquestion?id=<?= $test['test_id'] ?>">
          Add Theory Question</a>
      </li>
    </ul>
  </div>
</nav>