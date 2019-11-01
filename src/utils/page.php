<?php

class Page {

  static function login($msg = null) {
    $dir = 'src/vista/static/login.php';
    require_once cargarVista('templates/singlepage.php');
  }

  static function admin($msg = null) {
    $dir = 'src/vista/static/login.php';
    require_once cargarVista('templates/singlepage.php');
  }

}

 ?>
