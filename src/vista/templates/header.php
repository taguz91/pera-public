<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

<div class="bg-blue">

  <div class="container">
    <nav class="navbar navbar-expand-md navbar-dark">
      <a href="<?php echo constant('URL'); ?>"
      class="navbar-brand p-2" >
      <!--
        <img src="<?php echo constant('URL'); ?>public/img/icons/pera.png" width="40" height="40" class="d-inline-block" alt="...">
      -->
        <span class="text-white" style="font-size: 1.6em;">Pera Public</span>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto " style="font-size: 1.5em;">

              <li class="nav-item">
                  <a href="<?php echo constant('URL'); ?>home" class="nav-link text-light">Home</a>
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
