<?php
require_once 'src/modelo/usuario/usuariobd.php';

class UsuarioAPI {

  function login(){
    if(isset($_POST['login'])){
      $user = isset($_POST['user']) ?  $_POST['user'] : '';
      $pass = isset($_POST['pass']) ?  $_POST['pass'] : '';
      if($user != '' && $pass != ''){
        $res = UsuarioBD::login($user, $pass);
        if($res){
          JSON::confirmacion('Usuario encontrado, puede loguearse.');
        }else{
          JSON::error('Usuario o contrasena incorrectos.');
        }
      }else{
        JSON::error('No indico usuario ni contrasena.');
      }
    }else{
      JSON::error('No indico que nos loguearemos.');
    }
  }

}


 ?>
