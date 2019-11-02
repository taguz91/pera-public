<?php
require_once "src/modelo/respuestaFichaM/respuestaFichaBD.php";

if( isset($_POST['ajax']) && isset($_POST['id_A']) ){
   $k= $_POST['id_A'];

   $respuestas = RespuestaFichaBD::seleccionarRespuestaFicha((int) $k );

   if (isset($respuestas)) {

        foreach ($respuestas as $respuesta) {
            echo "<div class='input-group mb-3'>
            <div class='input-group-prepend'>
                <div class='input-group-text'><input onclick='return false' type='checkbox'></div>
            </div>
            <input type='hidden' name='id{$respuesta[0]}' id='idRespuestaA' value='{$respuesta[0]}'>
            <input class='form-control col-lg-10' type='text' id='{$respuesta[0]}' name='{$respuesta[0]}' value='{$respuesta[2]}'>
            <input class='form-control col-lg-2' type='number' id='p{$respuesta[0]}' name='p{$respuesta[0]}' value='{$respuesta[3]}'>
        </div>";
        }
    }
    exit;
   }

if( isset($_POST['ajax']) && isset($_POST['id_E']) ){
   $k= $_POST['id_E'];

   $respuestas = RespuestaFichaBD::seleccionarRespuestaFicha((int) $k );

   if (isset($respuestas)) {

        foreach ($respuestas as $respuesta) {
            echo "<div class='input-group mb-3'>
            <div class='input-group-prepend'>
                <div class='input-group-text'><input onclick='return false' type='checkbox'></div>
            </div>
            <input type='hidden' name='id{$respuesta[0]}' id='idRespuestaA' value='{$respuesta[0]}'>
            <input class='form-control col-lg-10' type='text' id='{$respuesta[0]}' name='{$respuesta[0]}' value='{$respuesta[2]}' readonly>
            <input class='form-control col-lg-2' type='number' id='p{$respuesta[0]}' name='p{$respuesta[0]}' value='{$respuesta[3]}' readonly>
        </div>";
        }
    }
    exit;
   }

?>
