<?php
require_once 'src/controlador/socioenomica.php';
require_once 'src/controlador/ocupacional.php';
require_once 'src/modelo/fichas/fichabd.php';
require_once 'src/modelo/fichas/seccionbd.php';
require_once 'src/modelo/persona/personafichabd.php';
require_once 'src/modelo/persona/personabd.php';

class FichaCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct("todos");
  }

  function inicio($msg = '') {
    global $U;
    if(isset($_SESSION['id_persona_ficha'])){
      unset($_SESSION['id_persona_ficha']);
    }
    $fichas = null;
    // Consultamos la ultima fecha en la que actualizamos la informacion
    $fechaActualizacion = PersonaBD::getFechaActualizacion($U->idPersona);

    if(isset($fechaActualizacion)){
      $fma = strtotime("-1 week");
      $fms = strtotime($fechaActualizacion['persona_fecha_actualizacion']);
      // Si la fecha en la que actualizamos es superior a una semana actualizamos
      if($fms > $fma){
        $fichas = FichaBD::getPorPersona($U->idPersona);
      }
    }

    require_once cargarVista('fichas/ficha.php');
  }

  function ingresar() {
    global $U;
    switch ($U->tipo) {
      case 'A':
        $this->ingresarFS();
        break;
      case 'D':
        echo "NO TENEMOS EL FORMULARIO OCUPACIONAL, ESTA EN DESARROLLO";
        break;
      default:
        $this->inicio(getErrorMsg('No tenemos ninguna ficha disponible para usted.'));
        break;
    }
  }

  function verficha($idPersonaFicha){
    global $U;
    switch ($U->tipo) {
      case 'A':
        $this->verfichaFS($U->idPersona, $idPersonaFicha);
        break;
      case 'D':
        echo "NO TENEMOS EL FORMULARIO OCUPACIONAL, ESTA EN DESARROLLO";
        break;
      default:
        $this->inicio(getErrorMsg('No tiene permitido ver esta ficha.'));
        break;
    }
  }

  function reporte($idPersonaFicha = 0){
    if($idPersonaFicha != 0){
      global $U;
      require_once 'src/reporte/ficha/ficha.php';
      switch ($U->tipo) {
        case 'A':
            Ficha::FS($U->idPersona, $idPersonaFicha);
          break;
        case 'D':
          echo "NO TENEMOS EL REPORTE DE DOCENTES, ESTA EN DESARROLLO";
          break;
        default:
          $this->inicio(getErrorMsg('No tenemos fichas para usted, debido a que no lo tenemos registrado como alumno ni docente.'));
          break;
      }
    }
  }

  function finalizar(){
    $idPersonaFicha = isset($_SESSION['id_persona_ficha']) ? $_SESSION['id_persona_ficha'] : 0;
    if($idPersonaFicha != 0){
      $res = PersonaFichaBD::finalizar($idPersonaFicha);
      PersonaFichaBD::actualizarFecha($idPersonaFicha);
      if($res != null){
        $this->inicio(getInfoMsg('Guardamos correctamente su ficha.
        <a href="http://35.192.7.211/home" target="_blank">Ingresar Ficha Salud</a>'));
      } else {
        $this->inicio(getErrorMsg('En este momento no pudimos finalizar su ficha, por favor vuelva a intentarlo más tarde.'));
      }
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
      $secciones = $this->getFS($idPer, $idPersonaFicha);
      require_once cargarVista('fichas/socioeconomica/ingresar.php');
    } else {
      $this->inicio(getErrorMsg('Debe ingresar su contraseña nuevamente.'));
    }
  }

  private function verfichaFS($idPersona, $idPersonaFicha){
    $secciones = $this->getFS($idPersona, $idPersonaFicha);
    require_once cargarVista('fichas/socioeconomica/ver.php');
  }

  private function getFS($idPersona, $idPersonaFicha){
    $res = SeccionBD::getFSPorIDPersonaFicha($idPersona, $idPersonaFicha);
    return json_decode($res['secciones'], true);
  }

  function rep(){
    $res = SeccionBD::getRep();
    var_dump($res);
  }

}
 ?>
