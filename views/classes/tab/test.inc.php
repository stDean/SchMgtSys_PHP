<?php if (onlyLecturer()) : ?>
  <nav class="navbar navbar-light bg-light">
    <a href='/single_class/test?id=<?= $class['class_id'] ?>&tab=test-add' class="btn btn-sm btn-primary ">
      <i class="fa fa-plus"></i>Add New Test
    </a>
  </nav>
<?php endif; ?>

<?php
$classes = $data;

require base_path("/views/partials/table.php");

?>

<div>
  <?php $pager->display(); ?>
</div>