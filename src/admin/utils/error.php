<?php
abstract class Errores{

  static function error404(){
    require_once 'src/admin/vista/static/errores/404.php';
  }

  static function errorVariableNoEncontrada(){
    echo "<h1>No encontramos la variable</h1>";
  }

  static function errorEditar($nombre){
    echo "<h1>No podemos editar $nombre</h1>";
  }

  static function errorEliminar($nombre){
    echo "<h1>No podemos eliminar $nombre</h1>";
  }

  static function errorConectarBD($mensaje){
    echo '<div class="container">
      <div class="alert alert-danger my-3">
        '.$mensaje.'
        </div>
      </div>';
  }

  static function errorBuscar($mensaje){
    echo '<div class="container">
      <div class="alert alert-info my-2 text-center">
        '.$mensaje.'
        </div>
      </div>';
  }

}

 ?>
