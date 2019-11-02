<?php
require_once 'src/admin/utils/error.php';
require_once 'src/utils/json.php';

class Admin {

  function obtenerUrl(){
    $url = isset($_GET['url']) ? $_GET['url']: NULL;

    if($url != null){
      $url = rtrim($url, '/');
      $url = explode('/', $url);

      if(isset($url[1])){
        $this->cargarClase($url);
      } else {
        $this->existeUsuario();
      }
    }else{
      $this->existeUsuario();
    }
  }

  function existeUsuario() {
    global $usuario;
    //Si ya tenemos el usuario lo enviamos al home
    if($usuario != null){
      require 'src/admin/vista/static/home.php';
    }else{
        header("Location: ".constant('URL')."miad/login");
    }
  }

  function cargarClase($url){
    global $usuario;
    //Nombre de la clase que llamaremos
    $nombre = $url[1];
    $dir = 'src/admin/controlador/'.$nombre.'.php';

    if(file_exists($dir)){
      require_once $dir;
      //Iniciamos el nombre de la clase
      $nombre = $nombre . 'CTR';
      //Creamos el objeto
      $modelo = new $nombre();

      if(
        $usuario != null OR
        (
          isset($_POST['txtUsuario']) AND isset($_POST['txtPass'])
        )
      ){
        if(isset($url[2])){
          $this->llamarMetodo($url, $modelo);
        }else{
          $modelo->inicio();
        }
      }else{
        require_once 'src/admin/vista/static/login.php';
      }
    }else{
        Errores::error404();
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
      echo "NO EXISTE NO EXISTE!!!";
    }
  }

  function llamarMetodoConParametro($url, $modelo){
    $metodo = $url[2];
    $parametro = $url[3];
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
