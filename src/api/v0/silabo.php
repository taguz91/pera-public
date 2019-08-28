<?php
include_once 'src/modelo/silabo/silabobd.php';

class SilaboAPI {

  function todos(){
    $res = SilaboBD::cargarSilabos();
    JSON::muestraJSON($res);
  }

  function buscar($aguja){
    $res = null;
    if(ctype_digit($aguja)){
      $res = SilaboBD::buscar($aguja);
    }else{
      $res = SilaboBD::buscarPorPeriodoMateria($aguja);
    }
    JSON::muestraJSON($res);
  }

  function periodo($aguja){
    $res = SilaboBD::buscarSilabosPorPeriodo($aguja);
    JSON::muestraJSON($res);
  }

  function materia($aguja){
    $res = SilaboBD::buscarSilabosPorMateria($aguja);
    JSON::muestraJSON($res);
  }

  function docente($identificacion){
    $res = SilaboBD::buscarPorDoncente($identificacion);
    JSON::muestraJSON($res);
  }

  function curso($id_curso){
    $res = null;
    if(ctype_digit($id_curso)){
      $res = SilaboBD::buscarPorCurso($id_curso);
    }else{
      $res = SilaboBD::buscarPorCursoNombrePeriodo($id_curso[0], $id_curso[1]);
    }

    JSON::muestraJSON($res);
  }

  function pdf($id_silabo){
    $res = SilaboBD::cargarPDF($id_silabo);
    JSON::muestraJSON($res);
  }

  function actividades($id_silabo = 0){
    if($id_silabo != 0){
      $res = SilaboBD::buscarActividadesSilabo($id_silabo);
      JSON::muestraJSON($res);
    }else{
      JSON::error('Debe enviar el id del silabo para obtener sus actividades.');
    }

  }

  /**
   * El 0 indica que es null y no se le pasaron parametros
   */
  function verPdf($id_silabo = 0){
    if($id_silabo != null){
      $res = SilaboBD::cargarPDF($id_silabo);
      JSON::muestraPDF($res);
    }else{
      JSON::error('Debe enviar el id del silabo para poder mostrarle el pdf.');
    }
  }

}

?>
