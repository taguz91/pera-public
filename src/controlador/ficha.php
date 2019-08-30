<?php
require_once 'src/controlador/socioenomica.php';
require_once 'src/controlador/ocupacional.php';
require_once 'src/modelo/fichas/fichabd.php';
require_once 'src/modelo/fichas/seccionbd.php';

class FichaCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct("todos");
  }

  function inicio() {
    global $U;
    $fichas = FichaBD::getPorPersona($U->idPersona);

    require_once cargarVista('fichas/ficha.php');
  }

  function ingresar($idPersonaFicha) {
    $res = SeccionBD::getPorIDPersonaFicha($idPersonaFicha);
    $_SESSION['id_persona_ficha'] = $idPersonaFicha;
    $secciones = json_decode($res['secciones'], true);
    require_once cargarVista('fichas/formulario.php');
  }

  function verficha($idPersonaFicha){
    $res = SeccionBD::getPorIDPersonaFicha($idPersonaFicha);
    $secciones = json_decode($res['secciones'], true);
    require_once cargarVista('fichas/verficha.php');
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
