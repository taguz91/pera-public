<?php

require 'src/utils/json.php';


class Api {

  function obtenerUrl(){
    $url = isset($_GET['url']) ? $_GET['url']: NULL;

    if($url != null){
      $url = rtrim($url, '/');
      $url = explode('/', $url);

      if(isset($url[0])){
        $this->cargarClase($url);
      }
    }else{
      JSON::error('No indico ninguna ruta!');
    }
  }

  function cargarClase($url){
    //Nombre de la clase que llamaremos
    global $U;
    $nombre = $url[1];
    $dir = 'src/api/'.$nombre.'.php';

    if(file_exists($dir)){
      require_once $dir;
      //Iniciamos el nombre de la clase
      $nombre = $nombre . 'API';
      //Creamos el objeto
      $modelo = new $nombre();
      if(isset($url[2])){
        $this->llamarMetodo($url, $modelo);
      }else{
        JSON::confirmacion('Si existe la ruta, pero debe especificar una direccion.');
      }
    }else{
        JSON::error('No tenemos lo que busca');
    }
  }

  function llamarMetodo($url, $modelo){
    $metodo = $url[2];

    if(method_exists($modelo, $metodo)){
      if(isset($url[3])){
        $this->llamarMetodoConParametro($url, $modelo);
      }else{
        $modelo->{$metodo}();
      }
    } else {
      JSON::error('No existe lo que esta buscando');
    }

  }

  function llamarMetodoConParametro($url, $modelo){
    $metodo = $url[2];
    $parametro = $url[3];
    if (strpos($parametro, '-') !== false) {
      $parametro = explode('-', $parametro);
      $modelo->{$metodo}($parametro);
    }else{
      $modelo->{$metodo}($parametro);
    }
  }

}

 ?>
