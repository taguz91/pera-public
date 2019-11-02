<?php
require 'src/admin/vista/templates/header.php';
 ?>

<div class="h-100 my-5">
  <div class="container">

    <div class="card m-auto">
        <h1 class="text-center m-3">Ya inicio session</h1>
    </div>

    <div class="card m-auto">
      <h2 class="text-center">
        <?php
        var_dump($usuario);
        ?></h2>
    </div>

  </div>
</div>

<?php
require 'src/admin/vista/templates/footer.php';
 ?>
