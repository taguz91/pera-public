<?php
require_once 'src/modelo/usuario/usuariobd.php';

class LoginCTR extends CTR implements DCTR {

  //Pasamos la carpeta donde estan las vistas
  function __construct(){
    parent::__construct('admin');
  }

  function inicio() {
    global $usuario;
    if ($usuario == null) {
      require cargarVistaAdmin('static/login.php');
    } else {
      require cargarVistaAdmin('static/sesion.php');
    }
  }

  function ingresar() {
    //Guardamos el usuario en la cookie
    $usuario = isset($_POST['txtUsuario']) ? $_POST['txtUsuario'] : null;
    $pass = isset($_POST['txtPass']) ? $_POST['txtPass'] : null;

    if ($usuario != null && $pass != null) {
      $user = UsuarioBD::getForAdmin($usuario, $pass);
      var_dump($user);
      if (isset($user['usu_username'])) {
        setcookie('userperadmin', serialize($user), time()+360000, '/');
        header('Location: ' . constant('URL') . 'miad');
      } else {
        echo "NO ENCONTRAMOS SU USUARIO ";
      }
    } else  {
      echo "NO TENEMOS LOS DATOS PARA LOGUEANOS";
    }

  }

  function salir() {
    //Borramos la cookie
    if(isset($_COOKIE['userperadmin'])){
      setcookie('userperadmin', null , time() - 360, '/');
    }
    header('Location: ' . constant('URL') . 'miad');
  }

}

 ?>
