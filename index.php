<?php
require_once 'config/config.php';
require_once 'src/utils/utils.php';
require_once 'src/utils/ctr.php';
require_once 'src/controlador/app.php';

require_once 'src/modelo/usuario/usuario.php';

$user = new UsuarioMD();
$user->id = 12;
$user->username = 'Taguz';
$user->tipo = 'Alumno';
$user->primerNombre = 'Johnny';
$user->segundoNombre = 'Gustavo';
$user->primerApellido = 'Garcia';
$user->segundoApellido = 'Inga';
$user->correo = 'johnnygar98@hotmail.com';
$user->celular = '0968796010';

$A = new App();
$A->obtenerUrl();

 ?>
