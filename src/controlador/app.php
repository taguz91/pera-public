<?php

class App {

  function obtenerUrl(){
    $url = isset($_GET['url']) ? $_GET['url']: NULL;

    if($url != null){
      $url = rtrim($url, '/');
      $url = explode('/', $url);

      if(isset($url[0])){
        if($url[0] == 'api'){
          require 'src/api/api.php';
          $AP = new Api();
          $AP->obtenerUrl();
        }else{
          $this->cargarClase($url);
        }
      }

    }else{
      global $U;
      if($U != null){
        include cargarVista('static/home.php');
      } else {
        Page::login();
      }

    }
  }

  function cargarClase($url){
    global $U;
    //Nombre de la clase que llamaremos
    $nombre = $url[0];
    $dir = 'src/controlador/'.$nombre.'.php';

    if(file_exists($dir)){
      require_once $dir;
      //Iniciamos el nombre de la clase
      $nombre = $nombre . 'CTR';
      //Creamos el objeto
      $modelo = new $nombre();

      if($U != null OR (isset($_POST['user']) AND isset($_POST['pass'])) ){
        if(isset($url[1])){
          $this->llamarMetodo($url, $modelo);
        }else{
          $modelo->inicio();
        }
      }else{
        Page::login('Debe ingresar un usuario y una contrasena.');
      }
    }else{
        echo "No tenemos la pagina";
    }
  }

  function llamarMetodo($url, $modelo){
    $metodo = $url[1];
    if(method_exists($modelo, $metodo)){
      if(isset($url[2])){
        $this->llamarMetodoConParametro($url, $modelo);
      }else{
        $modelo->{$metodo}();
      }
    } else {
      echo "NO EXISTE NO EXISTE!!!";
    }


  }

  function llamarMetodoConParametro($url, $modelo){
    $metodo = $url[1];
    $parametro = $url[2];
    //Preguntamos si existe mas de un parametro
    if (strpos($parametro, '-') !== false) {
      $parametro = explode('-', $parametro);
      //var_dump($parametro);
      $modelo->{$metodo}($parametro);
    }else{
      $modelo->{$metodo}($parametro);
    }
  }
}

 ?>
