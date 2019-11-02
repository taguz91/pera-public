<?php

class DevCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct('admin');
  }

  function inicio(){
    include cargarVistaAdmin('static/devs.php');;
  }

}

 ?>
