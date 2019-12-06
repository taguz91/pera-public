<?php
require_once 'src/modelo/usuario/usuariobd.php';

class UsuarioAPI {

  function login(){
    if(isset($_POST['login'])){
      $user = isset($_POST['user']) ?  $_POST['user'] : '';
      $pass = isset($_POST['pass']) ?  $_POST['pass'] : '';
      if($user != '' && $pass != ''){
        $res = UsuarioBD::login($user, $pass);
        if(!isset($res['error'])){
          JSON::confirmacion('Usuario encontrado, puede loguearse.');
        }else{
          JSON::error('Usuario o contraseña incorrectos. ' . $res['error']);
        }
      }else{
        JSON::error('No indico usuario ni contrasena.');
      }
    }else{
      JSON::error('No indico que nos loguearemos.');
    }
  }

  function admin(){
    $user = isset($_POST['txtUsuario']) ?  $_POST['txtUsuario'] : '';
    $pass = isset($_POST['txtPass']) ?  $_POST['txtPass'] : '';
    if($user != '' && $pass != ''){
      $res = UsuarioBD::admin($user, $pass);
      if(isset($res['usu_username'])){
        JSON::confirmacion('Usuario encontrado, puede loguearse.');
      }else{
        JSON::error('Usuario o contrasena incorrectos.');
      }
    }else{
      JSON::error('No indico usuario ni contrasena.');
    }
  }


}

 ?>
