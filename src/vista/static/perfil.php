<?php
require 'src/vista/templates/header.php';
 ?>

<div class="bg-blue">
  <div class="container">
    <div class="row py-5">

      <div class="col-md-4 mx-center">
        <img src="http://brownmead.academy/wp-content/uploads/2017/01/avatar.jpg" alt="" width="200px" height="200px" class="d-block rounded mx-auto">
      </div>

      <div class="col-md-8">

        <div class="text-white">
          <h1>
            <span class="badge badge-info">Nombres: </span>

            <span class="badge">
              <?php
              global $user;
              echo $user->primerNombre .' '.$user->primerApellido; ?>
            </span>

            </h1>
        </div>

      </div>

    </div>
  </div>
</div>

<div class="container">

</div>


<?php
require 'src/vista/templates/footer.php';
 ?>
