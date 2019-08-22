<?php

class Page {

  static function login($msg = null) {
    $dir = 'src/vista/static/login.php';
    require_once cargarVista('templates/singlepage.php');
  }

}

 ?>
