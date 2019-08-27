<?php
include_once 'src/modelo/alumno/alumnobd.php';

class AlumnoAPI extends Api {

  function todos() {
    $res = AlumnoBD::cargarTodos();
    JSON::muestraJSON($res);
  }

  function curso($id_curso){
    $res = AlumnoBD::buscarPorCurso($id_curso);
    JSON::muestraJSON($res);
  }

  function buscar($aguja){
    $res = null;
    if(ctype_digit($aguja) && substr($aguja, 0, 1) != 0){
      $res = AlumnoBD::buscar($aguja);
    }else{
      $res = AlumnoBD::buscarAlumno($aguja);
    }
    JSON::muestraJSON($res);
  }

}

?>
