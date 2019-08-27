<?php
require 'src/vista/templates/nav.php';
global $U;
 ?>



  <div class="h-100 my-5">
    <div class="container">

      <div class="mx-auto">
          <h1 class="text-center m-3">
            Bienvenido
          </h1>
      </div>

      <div class="mx-auto my-3">
        <h1 class="text-center bg-ista-yellow py-2">
          <?php echo $U->username; ?>
        </h1>
        <h2 class="text-center my-2">
          <?php echo $U->getNombreCorto(); ?>
        </h2>
      </div>

    </div>
  </div>

<?php
require 'src/vista/templates/copy.php';
 ?>
