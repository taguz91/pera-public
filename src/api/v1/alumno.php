<?php
require_once 'src/modelo/alumno/alumnobd.php';

class AlumnoAPI {

  function actualizar($idAlumno = 0){

    $valor = isset($_POST['valor']) ? $_POST['valor'] : '';
    $columna = isset($_POST['columna']) ? $_POST['columna'] : '';
    if($idAlumno != 0 && $valor != '' && $columna != ''){

      $res = AlumnoBD::actualizarDato($idAlumno, $valor, $columna);

      if($res == '1'){
        JSON::confirmacion('Editamos correctamente el campo.');
      }else{
        JSON::error('No editamos el campo, posiblemente exista un error en la sintaxis. ' . $idAlumno . ' | '
        .$columna . ' | ' . $valor . ' Error: ' . $res);
      }
    }else{
      JSON::error('No existen todos los valores requeridos.');
    }

  }

}
 ?>
