<?php
include_once 'src/modelo/curso/cursobd.php';

class CursoAPI {

  function todos() {
    $res = CursoBD::cargarCursos();
    JSON::muestraJSON($res);
  }

  function periodo($id_periodo) {
    $res = null;
    if(ctype_digit($id_periodo)){
      $res = CursoBD::cargarCursosPorPeriodo($id_periodo);
    }else{
      $res = CursoBD::cargarCursosPorNombrePeriodo($id_periodo[0], $id_periodo[1]);
    }

    JSON::muestraJSON($res);
  }

  function docente($aguja) {
    $res = CursoBD::cargarPorDoncente($aguja);
    JSON::muestraJSON($res);
  }

  function alumno($aguja) {
    $res = CursoBD::buscarPorAlumno($aguja);
    JSON::muestraJSON($res);
  }

  function nombre($id_periodo){
    $res = CursoBD::cargarCursosNombrePorPeriodo($id_periodo);
    JSON::muestraJSON($res);
  }

  function materia($param){
    $res = CursoBD::cargarCursosMateriaPorNombrePeriodo($param[0], $param[1]);

    JSON::muestraJSON($res);
  }

  function buscar($aguja){
    $res = null;
    if(ctype_digit($aguja)){
      $res = CursoBD::buscar($aguja);
    }else{
      $res = CursoBD::buscarCursos($aguja);
    }

    JSON::muestraJSON($res);
  }

}
?>
