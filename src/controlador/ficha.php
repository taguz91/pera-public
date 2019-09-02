<?php
require_once 'src/controlador/socioenomica.php';
require_once 'src/controlador/ocupacional.php';
require_once 'src/modelo/fichas/fichabd.php';
require_once 'src/modelo/fichas/seccionbd.php';
require_once 'src/modelo/persona/personafichabd.php';

class FichaCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct("todos");
  }

  function inicio() {
    global $U;
    $fichas = FichaBD::getPorPersona($U->idPersona);
    require_once cargarVista('fichas/ficha.php');
  }

  function ingresar() {
    global $U;
    if($U->tipo == 'A'){
      //Cargamos la ficha socioeconomica
      $this->ingresarFS();
    } else {
      echo "NO ES ALUMNOOOO!!!";
    }

  }

  function verficha($idPersonaFicha){
    global $U;
    if($U->tipo == 'A'){
      //Cargamos la ficha socioeconomica
      $this->verfichaFS($idPersonaFicha);
    } else {
      echo "NO ES PERSONA FICHA!!!";
    }
  }

  private function ingresarFS(){
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $idPer = isset($_POST['idper']) ? $_POST['idper'] : 0;
    if($pass != '' && $idPer != 0){
      $idPersonaFicha = PersonaFichaBD::getPorLogin(
        $idPer,
        $pass
      );
      $secciones = $this->getFS($idPersonaFicha);
      require_once cargarVista('fichas/socioeconomica/ingresar.php');
    }
  }

  private function verfichaFS($idPersonaFicha){
    $secciones = $this->getFS($idPersonaFicha);
    require_once cargarVista('fichas/socioeconomica/ver.php');
  }

  private function getFS($idPersonaFicha){
    $res = SeccionBD::getFSPorIDPersonaFicha($idPersonaFicha);
    return json_decode($res['secciones'], true);
  }

  function json(){
    $res = SeccionBD::getJSON();
    var_dump($res);
    /*
    $secciones = json_decode($res['secciones'], true);
    foreach ($secciones as $s) {
      echo "<h1>".$s['seccion_ficha_nombre']."</h1>";
      foreach ($s['preguntas'] as $p) {
        echo "<h4>".$p['pregunta_ficha']."</h4>";
        if (isset($p['respuestas'])) {
          foreach ($p['respuestas'] as $r) {
            echo "<p>".$r['respuesta_ficha']."</p>";
          }
        }

        echo "<hr>";
      }
    }
    */
  }

}
 ?>
