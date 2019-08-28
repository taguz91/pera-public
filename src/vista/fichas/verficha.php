<?php
require 'src/vista/templates/nav.php';
 ?>
<div class="container my-4">
  <?php include cargarVista('fichas/formato.php'); ?>
</div>
<?php
require 'src/vista/templates/copy.php';
?>

<script type="text/javascript">
  const ALLRADIOS = document.querySelectorAll('.custom-control-input');

  ALLRADIOS.forEach(i => {
    i.disabled = true;
  });
</script>
