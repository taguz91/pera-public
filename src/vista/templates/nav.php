<?php
require_once 'src/vista/templates/header.php';
?>

<div class="bg-blue shadow">

  <div class="container">
    <nav class="navbar navbar-expand-md navbar-dark">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>

      <a href="<?php echo constant('URL'); ?>"
      class="navbar-brand p-2 mx-auto" >
        <span class="text-white" style="font-size: 1.6em;">Pera Public</span>
      </a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto " style="font-size: 1.5em;">

              <li class="nav-item">
                  <a href="<?php echo constant('URL'); ?>home" class="nav-link text-light">Inicio</a>
              </li>

              <li class="nav-item">
                  <a href="<?php echo constant('URL'); ?>perfil" class="nav-link text-light">Perfil</a>
              </li>

              <li class="nav-item">
                  <a href="<?php echo constant('URL'); ?>ficha" class="nav-link text-light">Ficha</a>
              </li>
          </ul>
      </div>

      <form class="form-inline ml-lg-2"
      action="<?php echo constant('URL'); ?>login/salir"
      method="post">
        <button type="submit" name="salir"
        class="no-btn text-white">
          Salir
        </button>
      </form>

    </nav>
  </div>

</div>
