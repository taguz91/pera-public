<?php
require_once 'config/config.php';
require_once 'src/utils/utils.php';
require_once 'src/utils/ctr.php';
require_once 'src/utils/page.php';
require_once 'src/controlador/app.php';

require_once 'src/modelo/usuario/usuario.php';

session_start();
$U = null;
if(isset($_SESSION['U'])){
  $U = $_SESSION['U'];
}

$A = new App();
$A->obtenerUrl();

 ?>
