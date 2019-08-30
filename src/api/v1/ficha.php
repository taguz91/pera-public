<?php
require_once 'src/modelo/respuesta/respuestafs.php';

class FichaAPI {

  function guardar(){
    if(isset($_GET['socioeconomica'])){
      $this->socioeconomica();
    }
    
    if(isset($_GET['guardarlibre'])){
      guardarRespuestaLibre();
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

  private function guardarRespuestaLibre() {

    $idPersonaFicha = isset($_POST['id_persona_ficha']) ? $_POST['id_persona_ficha'] : '';
    $idPreguntaFicha = isset($_POST['id_pregunta_ficha']) ? $_POST['id_pregunta_ficha'] : '';
    $respuesta = isset($_POST['respuesta']) ? $_POST['respuesta'] : '';

    if($idPersonaFicha != '' && $idPreguntaFicha != '' && $respuesta != ''){
      $res = RespuestaFSBD::ingresarRespuestaLibre(
        $idPersonaFicha,
        $idPreguntaFicha,
        $respuesta
      );
      if($res != null){
        JSON::confirmacion('Guardamos correctamente la respuesta libre.');
      }else{
        JSON::error('No pudimos guardar la respuesta libre.');
      }
    }else{
      JSON::error('No tenemos todos los campos.');
    }

  }


}


 ?>
