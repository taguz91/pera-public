<?php global $usuario; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pera Admin | <?php echo isset($pagina) ? $pagina: ""; ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo constant('URL'); ?>public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo constant('URL'); ?>public/vendor/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo constant('URL'); ?>public/css/main.css?v=5" rel="stylesheet">
  <!-- Estilo para las tablas -->
  <link href="<?php echo constant('URL');?>public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Mensajes para JavaScript -->
  <script  type="text/javascript" src="<?php echo constant('URL');?>public/js/msg.js"></script>

  <!-- URL DE LA API -->
  <script  type="text/javascript" src="<?php echo constant('URL');?>public/js/main.js"></script>

</head>
<body id="page-top">

<div id="wrapper">

  <ul class="navbar-nav bg-gradient-blue sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo constant('URL'); ?>miad">
      <div class="sidebar-brand-icon rotate-15">
        <img class="rounded-circle"
        src="<?php echo constant('URL'); ?>public/img/icons/pera.png">
      </div>
      <div class="sidebar-brand-text mx-3">Pera Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="<?php echo constant('URL'); ?>miad">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading Nav -->
    <div class="sidebar-heading">
      Ficha
    </div>


    <!-- Tipo Fichas -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTI" aria-expanded="true" aria-controls="collapseTI">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Tipo Fichas</span>
      </a>
      <div id="collapseTI" class="collapse"  data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/tipo/">Lista</a>
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/tipo/nuevo/">Ingresar</a>
        </div>
      </div>
    </li>

    <!-- Permiso Ingreso Fichas -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePI" aria-expanded="true" aria-controls="collapsePI">
        <i class="fas fa-fw fa-calendar "></i>
        <span>Permiso Ingreso</span>
      </a>
      <div id="collapsePI" class="collapse"  data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/permiso/">Lista</a>
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/permiso/nuevo">Ingresar</a>
        </div>
      </div>
    </li>

    <!-- Cuestionario Fichas -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCF" aria-expanded="true" aria-controls="collapseCF">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Cuestionario Fichas</span>
      </a>
      <div id="collapseCF" class="collapse"  data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/seccion/">Secciones</a>
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/pregunta/">Preguntas</a>
        </div>
      </div>
    </li>




    <!-- Grupo Socioeconomico -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGS" aria-expanded="true" aria-controls="collapseGS">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Grupo Socioeconomico</span>
      </a>
      <div id="collapseGS" class="collapse"  data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/gruposocioeconomico/">Lista</a>
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/gruposocioeconomico/nuevo">Ingresar</a>
        </div>
      </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading Nav -->
    <div class="sidebar-heading">
      Persona
    </div>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePF" aria-expanded="true" aria-controls="collapsePF">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Envío Fichas</span>
      </a>
      <div id="collapsePF" class="collapse"  data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/persona/">Todas</a>
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/persona/alumno/">Alumnos</a>
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/persona/docente/">Docentes</a>
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/correo/">Lista enviados</a>
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/correo/nuevo/">Ingresar</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
      Respuesta
    </div>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseREF" aria-expanded="true" aria-controls="collapseREF">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Respuestas Fichas</span>
      </a>
      <div id="collapseREF" class="collapse"  data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?php echo constant('URL'); ?>miad/respuesta">Ver respuestas</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>

        <a href="#" class="h3 nav-link text-gray-800">
          <?php if (isset($pagina)): ?>
            <?php echo $pagina; ?>
          <?php endif; ?>
        </a>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                <?php
                echo $usuario['nombre_persona'];
                ?>
              </span>
              <img class="img-profile rounded-circle"
              src="<?php echo constant('URL'); ?>public/img/icons/pera.png">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="<?php echo constant('URL'); ?>miad/login/salir">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Salir
              </a>
            </div>
          </li>

        </ul>

      </nav>
      <!-- End of Topbar -->

      <!-- Begin Page Content -->
      <div class="container-fluid">
