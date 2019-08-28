<?php
require_once 'src/modelo/respuesta/respuestafs.php';

class FichaAPI {

  function guardar(){
    if(isset($_GET['socioeconomica'])){
      $this->socioeconomica();
    }
  }

  private function socioeconomica(){
    if(isset($_POST['id_respuesta']) && isset($_POST['id_actualizar'])){
      $idRes = $_POST['id_respuesta'];
      $idAct = $_POST['id_actualizar'];

      $res = RespuestaFSBD::actualizarRespuestaUnica(
        $idAct, $idRes
      );
      if($res != null){
        JSON::confirmacion('Actualizamos correctamente la respuesta.');
      }else{
        JSON::error('No logramos actualizar la respuesta.');
      }
    }
  }


}


 ?>
