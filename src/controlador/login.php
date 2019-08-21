<?php

class LoginCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct("todos");
  }

  public function inicio() {
    $dir = 'src/vista/static/login.php';
    require_once cargarVista('templates/singlepage.php');
  }

  public function ingresar() {
    echo "Nice Jobs";
  }

}

 ?>
