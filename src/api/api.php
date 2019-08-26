<?php

require 'src/utils/json.php';


class Api {

  function obtenerUrl(){
    $url = isset($_GET['url']) ? $_GET['url']: NULL;

    if($url != null){
      $url = rtrim($url, '/');
      $url = explode('/', $url);
      if(isset($url[1])){
        if(isset($url[2])){
          $this->cargarClase($url);
        }else{
          JSON::error('Debe indicar una ruta para la API.');
        }
      }else{
        JSON::error('Debe indicar una version de la API.');
      }
    }else{
      JSON::error('No indico ninguna ruta!');
    }
  }

  function cargarClase($url){
    //Nombre de la clase que llamaremos
    $version = $url[1];
    $nombre = $url[2];
    $dir = 'src/api/'.$version.'/'.$nombre.'.php';

    if(file_exists($dir)){
      require_once $dir;
      //Iniciamos el nombre de la clase
      $nombre = $nombre . 'API';
      //Creamos el objeto
      $modelo = new $nombre();
      if(isset($url[3])){
        $this->llamarMetodo($url, $modelo);
      }else{
        JSON::confirmacion('Si existe la ruta, pero debe especificar una  peticion.');
      }
    }else{
        JSON::error('No tenemos lo que busca.');
    }
  }

  function llamarMetodo($url, $modelo){
    $metodo = $url[3];

    if(method_exists($modelo, $metodo)){
      if(isset($url[4])){
        $this->llamarMetodoConParametro($url, $modelo);
      }else{
        $modelo->{$metodo}();
      }
    } else {
      JSON::error('No existe lo que esta buscando');
    }

  }

  function llamarMetodoConParametro($url, $modelo){
    $metodo = $url[3];
    $parametro = $url[4];
    if (strpos($parametro, '-') !== false) {
      $parametro = explode('-', $parametro);
      $modelo->{$metodo}($parametro);
    }else{
      $modelo->{$metodo}($parametro);
    }
  }

}

 ?>
