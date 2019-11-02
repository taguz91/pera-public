<?php
$secciones = $reportes['secciones_ficha'];

$ths = '';
$thi = '';

foreach ($secciones as $s) {
  $preguntas = $s['respuestas_ficha'];
  $ths .= '<th scope="col" colspan="' . count($preguntas) . '">'
  . $s['seccion_ficha_nombre'] . '</th>';
  foreach ($preguntas as $p) {
    $thi .= '<th scope="col"  class="pre preg--' . $p['id_pregunta_ficha']
     . '">' . $p['pregunta_ficha'] . '</th>';
  }
}
 ?>
