<?php

class LoginCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct("todos");
  }

  public function inicio() {
    Page::cargarLogin();
  }

  function ingresar() {
    $user = new UsuarioMD();
    $user->id = 1;
    $user->username = 'Taguz';
    $user->tipo = 'Alumno';
    $user->idPersona = 548;
    $user->primerNombre = 'Johnny';
    $user->segundoNombre = 'Gustavo';
    $user->primerApellido = 'Garcia';
    $user->segundoApellido = 'Inga';
    $user->correo = 'johnnygar98@hotmail.com';
    $user->celular = '0968796010';

    $_SESSION['U'] = $user;
    header("Location: ".constant('URL'));
  }

  function salir() {
    if(isset($_SESSION['U'])){
      unset($_SESSION['U']);
      Page::login();
    }
  }

}

 ?>
