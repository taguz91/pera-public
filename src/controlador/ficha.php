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

  function inicio($msg = '') {
    global $U;
    if(isset($_SESSION['id_persona_ficha'])){
      unset($_SESSION['id_persona_ficha']);
    }
    $fichas = FichaBD::getPorPersona($U->idPersona);
    require_once cargarVista('fichas/ficha.php');
  }

  function ingresar() {
    global $U;
    switch ($U->tipo) {
      case 'A':
        //Cargamos la ficha socioeconomica
        $this->ingresarFS();
        break;
      case 'D':
        echo "NO TENEMOS EL FORMULARIO OCUPACIONAL, ESTA EN DESARROLLO";
        break;
      default:
        $this->inicio(getErrorMsg('Debe indicar la consena para llenar la ficha.'));
        break;
    }
  }

  function verficha($idPersonaFicha){
    global $U;
    switch ($U->tipo) {
      case 'A':
        $this->verfichaFS($idPersonaFicha);
        break;
      case 'D':
        echo "NO TENEMOS EL FORMULARIO OCUPACIONAL, ESTA EN DESARROLLO";
        break;
      default:
        $this->inicio(getErrorMsg('No tiene permitido ver esta ficha.'));
        break;
    }
  }

  function finalizar(){
    $idPersonaFicha = isset($_SESSION['id_persona_ficha']) ? $_SESSION['id_persona_ficha'] : 0;
    if($idPersonaFicha != 0){
      $res = PersonaFichaBD::finalizar($idPersonaFicha);
      if($res != null){
        $this->inicio(getInfoMsg('Finalizamos correctamente su ficha.
        <a href="http://35.192.7.211/home" target="_blank">Ingresar Ficha Salud</a>'));
      } else {
        $this->inicio(getErrorMsg('En este momento no pudimos finalizar su ficha, por favor vuelva a intentarlo mas tarde.'));
      }
    } else {
      $this->inicio(getErrorMsg('No pudimos finalizar su ficha, porque no indico que ficha finalizara.'));
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
      PersonaFichaBD::actualizarFecha($idPersonaFicha);
      $_SESSION['id_persona_ficha'] = $idPersonaFicha;
      $secciones = $this->getFS($idPersonaFicha);
      require_once cargarVista('fichas/socioeconomica/ingresar.php');
    } else {
      $this->inicio(getErrorMsg('Debe ingresar su contrasena nuevamente.'));
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
    //var_dump($res);
    $res  = json_decode($res['alumnos'], true);
    //var_dump($res);
    $alumno = $res[0];
    //var_dump($alumno);
    echo "<hr>";
    $this->impr($alumno['id_persona']);
    $this->impr($alumno['pais_nacimiento']);
    echo "<hr>";
    $this->impr('Ficha');
    $ficha = $alumno['ficha'];
    $ficha = $ficha[0];
    //var_dump($ficha);
    $this->impr($ficha['tipo_ficha']);
    $this->impr($ficha['tipo_ficha_descripcion']);
    echo "<hr>";
    $secciones = $alumno['secciones'];
    foreach ($secciones as $value) {
      $s = $value;
      //var_dump($s);
      $this->impr($s['seccion_ficha_nombre']);
      $preguntas = $s['preguntas'];
      foreach ($preguntas as $pre) {
          $this->impr($pre['pregunta_ficha']);
          //var_dump($pre);
          $r = $pre['respuesta'];
          $rl = $pre['respuesta_libre'];
          if($r != null){
            foreach ($r as $res) {
              $this->ru($res['respuesta_ficha']);
            }
          }

          if($rl != null){
            foreach ($rl as $resl) {
              $this->rl($resl['alumno_fs_libre']);
            }
          }
      }
      echo "<hr>";
    }

  }

  function impr($val){
    echo "<h1>$val</h1>";
  }

  function rl($val){
    echo "<h5>$val</h5>";
  }

  function ru($val){
    echo "<h3>$val</h3>";
  }

}
 ?>
