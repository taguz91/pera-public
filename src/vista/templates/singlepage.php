<?php
require_once 'src/vista/templates/header.php';
?>


<div class="h-100 bg-blue">
  <div class="d-flex justify-content-center h-100">

    <?php
      include $dir;
     ?>

  </div>
</div>

<?php
require_once 'src/vista/templates/footer.php';
?>

<script type="text/javascript">
  var d = document.getElementById('main');
  var b = document.getElementById('ctn');
  d.style.height = '100%';
  b.style.height = '100%';
</script>
