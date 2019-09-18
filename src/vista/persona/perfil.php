<?php
require 'src/vista/templates/nav.php';
 ?>

<div class="bg-blue border-top">
  <div class="container">
    <div class="row py-4">

      <div class="col-lg-4 mx-center">
        <img src="<?php echo constant('URL'); ?>perfil/foto" alt="" width="250px" height="200px" class="d-block rounded mx-auto">

        <div class="my-2">
            <a href="<?php echo constant('URL'); ?>perfil/editar/"
            class="btn btn-blue btn-block text-white d-block w-75 mx-auto">Editar datos personales</a>
        </div>

      </div>

      <div class="col-lg-8">

        <div class="text-white">
          <h1>
            <span class="badge badge-blue">Nombres: </span>
            <span class="badge">
              <?php echo $U->getNombre(); ?>
            </span>
          </h1>
          <h1>
            <span class="badge badge-blue">Apellidos: </span>
            <span class="badge">
              <?php echo $U->getApellido(); ?>
            </span>
          </h1>
          <h1>
            <span class="badge badge-blue">Correo: </span>
            <span class="badge">
              <?php echo $U->correo; ?>
            </span>
          </h1>
          <h1>
            <span class="badge badge-blue">Celular: </span>
            <span class="badge">
              <?php echo $U->celular; ?>
            </span>
          </h1>

        </div>

      </div>

    </div>

  </div>
</div>

<div class="container mt-4">
  <div class="row">
    <div class="col-md-4 mx-auto">

    </div>
</div>


<?php
require 'src/vista/templates/copy.php';
 ?>
