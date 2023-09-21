<div class="table-responsive">
  <table class="table table-striped table-hover">
    <tr>
      <th>Student Name</th>
      <th>Score</th>
    </tr>

    <?php if ($scores) : ?>
      <?php foreach ($scores as $score) : ?>
        <tr>
          <td>
            <?= htmlspecialchars($score['user']['first_name']) ?>
            <?= htmlspecialchars($score['user']['last_name']) ?>
          </td>
          <td><?= $score['score'] ?>%</td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </table>
</div>