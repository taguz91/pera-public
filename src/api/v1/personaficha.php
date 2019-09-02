<?php
require_once 'src/modelo/persona/personafichabd.php';

class PersonaFichaAPI {

  function login() {
    $pass = $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $idPer = isset($_POST['idper']) ? $_POST['idper'] : 0;
    if($pass != '' && $idPer != 0){
      $res = PersonaFichaBD::getPorLogin(
        $idPer,
        $pass
      );

      if($res != null){
        JSON::confirmacion('Permiso ingreso ficha concedido.');
      } else {
        JSON::error('No tenemos permiso de ingresar esta ficha');
      }
    }else{
      JSON::error('No debe enviar parametros vacios.');
    }
  }

}

 ?>
