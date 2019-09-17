<?php

function reporteFS($alumno, $idPersonaFicha){
  $ficha = $alumno['ficha'];
  $ficha = $ficha[0];
  $secciones = $alumno['secciones'];
  $carrera = $alumno['carrera_actual'];
  $carrera = $carrera[0];


  $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf']);

  $html='<html>
  <style>
  *{
    font-family: sans-serif;
  }

  table, th,td {
    border-collapse: collapse;
  }

  th, td {
    padding: 0.6% 1%;
  }

  th {
    width: 40%;
    text-align: left;
  }
  </style>
  <caption>
  <img src="public/img/1.png" width="450" height="100" >
  </caption>
  ';

  $html.='<caption><h2>'.$ficha['tipo_ficha'].'</h2></caption>';
  $html.='<h4>DATOS DE IDENTIFICACIÓN</h4>
  <table border="1"  width="100%">
  <tr>
    <th>Nombres y Apellidos completos:</th>
    <td>'
    .$alumno['persona_primer_nombre'].' '
    .$alumno['persona_segundo_nombre'].' '
    .$alumno['persona_primer_apellido'].' '
    .$alumno['persona_segundo_apellido']
    .'</td>
  </tr>';
  $html.='
  <tr>
      <th WIDTH="200">Número de cedula / pasaporte:</th>
      <td>'.$alumno['persona_identificacion'].'</td>
  </tr>';
  $html.='
  <tr>
      <th WIDTH="200">Fecha de nacimiento:</th>
      <td>'.$alumno['persona_fecha_nacimiento'].'</td>
  </tr>';
  $html.='
  <tr>
      <th WIDTH="200">País de nacimiento:</th>
      <td>'.$alumno['pais_nacimiento'].'</td>
  </tr>';
  $html.='
  <tr>
      <th WIDTH="200">Provincia de nacimiento:</th>
      <td>'.$alumno['provincia_nacimiento'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Cantón de nacimiento:</th>
      <td>'.$alumno['ciudad_nacimiento'].'</td>
  </tr>';
  $html.='
  <tr>
      <th WIDTH="200">Parroquia de nacimiento:</th>
      <td>'.$alumno['parroquia_nacimiento'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Pais de procedencia:</th>
      <td>'.$alumno['pais_nacimiento'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Provincia de procedencia:</th>
      <td>'.$alumno['provincia_nacimiento'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Cantón de procedencia:</th>
      <td>'.$alumno['ciudad_nacimiento'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Parroquia de procedencia:</th>
      <td>'.$alumno['parroquia_nacimiento'].'</td>
  </tr>';

  $html.='<tr>
      <th WIDTH="200">Sexo:</th>
      <td>'.$alumno['persona_sexo'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Orientacion Sexual:</th>
      <td>'.$alumno['persona_genero'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Estado civil:</th>
      <td>'.$alumno['persona_estado_civil'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Tipo de sangre:</th>
      <td>'.$alumno['persona_tipo_sangre'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Etnia:</th>
      <td>'.$alumno['persona_etnia'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">¿Tiene discapacidad?</th>
      <td>'.$alumno['persona_discapacidad'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Tipo de discapacidad:</th>
      <td>'.$alumno['persona_tipo_discapacidad'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Porcentaje de discapacidad:</th>
      <td>'.$alumno['persona_porcenta_discapacidad'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">N° carnet CONADIS o del MSP:</th>
      <td>'.$alumno['persona_carnet_conadis'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Auto percepción de clase social</th>
      <td>'.$alumno['persona_tipo_residencia'].'</td>
  </tr>';
  $html.='</table>';
  $html.='<h4>NIVEL ACADÉMICO</h4>
  <table border="1"  width="100%">
  <tr>
      <th>Carrera:</th>
      <td> '.$carrera['carrera_nombre'].' </td>
  </tr>';

  $html.='<tr>
      <th WIDTH="200">Nivel que cursa:</th>
      <td>'.$carrera['prd_lectivo_nombre'].'</td>
  </tr>';
  $html.='<tr>
      <th WIDTH="200">Ciclo académico:</th>
      <td>'.$carrera['curso_ciclo'].'</td>
  </tr>';
  $html.='</table>';
  $html.='<h4>CONTACTO:</h4>
  <table border="1"  width="100%">
  <tr>
      <th WIDTH="200">País de residencia:</th>
      <td>'.$alumno['pais_residencia'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Provincia de residencia:</th>
      <td>'.$alumno['provincia_residencia'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Cantón de residencia:</th>
      <td>'.$alumno['ciudad_residencia'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Parroquia de residencia:</th>
      <td>'.$alumno['parroquia_residencia'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Sector de residencia:</th>
      <td>'.$alumno['sector_residencia'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Calle principal:</th>
      <td>'.$alumno['persona_calle_principal'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Calle secundaria:</th>
      <td>'.$alumno['persona_calle_secundaria'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Número de casa:</th>
      <td>'.$alumno['persona_numero_casa'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Teléfono móvil:</th>
      <td>'.$alumno['persona_celular'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Teléfono fijo:</th>
      <td>'.$alumno['persona_telefono'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Correo personal:</th>
      <td>'.$alumno['persona_correo'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Nombre de contacto de emergencia:</th>
      <td>'.$alumno['alumno_nombre_contacto_emergencia'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Parentesco contacto de emergencia:</th>
      <td>'.$alumno['alumno_parentesco_contacto'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">Teléfono:</th>
      <td>'.$alumno['alumno_numero_contacto'].'</td>
  </tr>
  <tr>
      <th WIDTH="200">E-mail:</th>
      <td>'.' '.'</td>
  </tr>
  </table>
  ';

  foreach ($secciones as $key => $value) {
    $s = $value;
    $html.='<h4>'.$s['seccion_ficha_nombre'].'</h4>';
    $preguntas = $s['preguntas'];
    $html.='<table border="1"  width="100%">';

    $b = '<tr>';

    foreach ($preguntas as $pre) {
        $r = $pre['respuesta'];
        $rl = $pre['respuesta_libre'];
        if($r != null){
          foreach ($r as $res) {
            $html.='<tr>';
            $html.='<th WIDTH="200">'.$pre['pregunta_ficha'].'</th>';
            $html.='<td>'.$res['respuesta_ficha'].'</td>
            </tr>';
          }
        }

        if($rl != null){
          $b .= '<th WIDTH="200">'.$pre['pregunta_ficha'].'</th>';
          foreach ($rl as $resl) {
            $b .= '<td>'.$resl['alumno_fs_libre'].'</td>';
          }
          $b .= '</tr> <tr>';
        }

        if($rl == null && $r == null){
          $b .= '<th WIDTH="200">'.$pre['pregunta_ficha'].'</th>';
          $b .= '<td>Sin respuesta</td>';
          $b .= '</tr> <tr>';
        }
    }

    $html.=  $b;
    $html.='</table>';
  }

  $html.='<p>'.'Yo, '
  .$alumno['persona_primer_nombre'].' '
  .$alumno['persona_segundo_nombre'].' '
  .$alumno['persona_primer_apellido'].' '
  .$alumno['persona_segundo_apellido'].' '
  .'  Acepto y declaro que: la información proporcionada en el presente formulario es real y puede ser utilizada para los fines pertinentes, autorizo que el Instituto Superior Tecnológico del Azuay - ISTA a realizar las verificaciones que crean oportunas sobre  la información detallada en el presente documento.'.'</p>';
  $html.='<caption><h2>_________________________________</h2></caption> ';

  $html.='
  <br>
  <hr>
  <table>
    <tr>
      <th WIDTH="200">Nivel Socioeconómico</th>
      <td>'.$alumno['grupo_socioeconomico'][0]['grupo_socioeconomico'].'</td>
    </tr>
  </table>';
  $html.= '</html> ';

  $mpdf->SetHTMLHeader(reportHead($idPersonaFicha));
  $mpdf->setFooter("{PAGENO}");
  $mpdf->WriteHTML($html);
  $mpdf->Output();
}
 ?>
