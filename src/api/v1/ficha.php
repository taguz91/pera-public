<?php
require_once 'src/modelo/respuesta/respuestafs.php';

class FichaAPI {

  function guardar(){
    if(isset($_GET['socioeconomica'])){
      $this->socioeconomica();
    }

    if(isset($_GET['guardarlibre'])){
      $this->guardarRespuestaLibre();
    }

    if(isset($_GET['actualizarlibre'])){
      $this->actualizarRespuestaLibre();
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

    $idPersonaFicha = isset($_SESSION['id_persona_ficha']) ? $_SESSION['id_persona_ficha'] : '';
    $idPreguntaFicha = isset($_POST['id_pregunta_ficha']) ? $_POST['id_pregunta_ficha'] : '';
    $respuesta = isset($_POST['respuesta']) ? $_POST['respuesta'] : '';

    if($idPersonaFicha != '' && $idPreguntaFicha != '' && $respuesta != ''){
      $res = RespuestaFSBD::ingresarRespuestaLibre(
        $idPersonaFicha,
        $idPreguntaFicha,
        $respuesta
      );
      if(is_bool($res)){
        JSON::confirmacion('Guardamos correctamente la respuesta libre '
        . $idPersonaFicha . ' ID respuesta guardada: ' . $idPreguntaFicha);
      }else{
        JSON::error('No pudimos guardar la respuesta libre: ' . $res);
      }
    }else{
      JSON::error('No tenemos todos los campos.');
    }

  }

  private function actualizarRespuestaLibre() {
    $idPersonaFicha = isset($_SESSION['id_persona_ficha']) ? $_SESSION['id_persona_ficha'] : '';
    $idAlmnResLibre = isset($_POST['id_almn_respuesta_fs']) ? $_POST['id_almn_respuesta_fs'] : '';
    $respuesta = isset($_POST['respuesta']) ? $_POST['respuesta'] : '';

    if($idAlmnResLibre != '' && $respuesta != ''){
      $idAlmnResLibre = rtrim($idAlmnResLibre, '-');
      $idAlmnResLibre = explode('-', $idAlmnResLibre);
      $idAlmnResLibre = $idAlmnResLibre[1];
      $res = RespuestaFSBD::actualizarRespuestaLibre(
        $idAlmnResLibre,
        $respuesta
      );
      if(is_bool($res)){
        JSON::confirmacion('Editamos correctamente la respuesta libre. ' . $idAlmnResLibre . ' Valor: '. $respuesta);
      }else{
        JSON::error('No pudimos editar la respuesta libre: ' . $res);
      }
    }else{
      JSON::error('No tenemos todos los campos.');
    }

  }


}


 ?>
