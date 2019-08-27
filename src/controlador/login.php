<?php
require_once 'src/modelo/usuario/usuariobd.php';

class LoginCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct("todos");
  }

  public function inicio() {
    Page::cargarLogin();
  }

  function ingresar() {
    $u = null;
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    if($user != '' AND $pass != ''){
      $u = UsuarioBD::getPorUserAndPass($user, $pass);
      if($u != null){
        $_SESSION['U'] = $u;
        header("Location: ".constant('URL'));
      }
    }

    if($u == null){
      Page::login('Usuario o contrasena incorrectos.');
    }
  }

  function salir() {
    if(isset($_SESSION['U'])){
      unset($_SESSION['U']);
      Page::login();
    }
  }

}

 ?>
