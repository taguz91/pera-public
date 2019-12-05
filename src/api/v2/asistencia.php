<?php
require_once 'src/modelo/asistencia/asistenciabd.php';
require_once 'src/services/asistencia/asistencia.php';


class AsistenciaAPI {

  function actualizar($idAsistencia = 0) {
    if ($idAsistencia != 0) {
      $numFalta = isset($_POST['num_falta']) ? $_POST['num_falta'] : 0;
      // Actualizamos la asistencia
      $res = actualizar($idAsistencia, $numFalta);
      if (is_bool($res)) {
        JSON::confirmacion('Actualizamos correctamente.');
      } else {
        JSON::error('Error al actualizar la asistencia. '. $res['error']);
      }
    } else {
      JSON::error('No tenemos el id_curso para guardar asistencia.');
    }
  }

  function lista($idCurso = 0) {
    if ($idCurso != 0) {
      $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : null;
      if ($fecha != null) {
        $res = AsistenciaSV::iniciarAsistencia($idCurso, $fecha);
        JSON::muestraJSON($res);
      } else {
        JSON::error('No tenemos la fecha de la asistencia');
      }
    } else {
      JSON::error('No tenemos el id_curso para consultar la lista.');
    }
  }

  function cursos($identificacion = ''){
    if ($identificacion != '') {
      $res = AsistenciaBD::getUltimosCursosByDocente($identificacion);
      JSON::muestraJSON($res);
    } else {
      JSON::error('No tenemos la indentificación del docente.');
    }
  }

  function alumnos($identificacion = '') {
    if ($identificacion != '') {
      $res = AsistenciaBD::getAlumnosNuevosDocente($identificacion);
      JSON::muestraJSON($res);
    } else {
      JSON::error('No tenemos la indentificación del docente.');
    }
  }

}
