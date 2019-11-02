<?php

abstract class CTR {
  //Para el tipo de usuario que utilizara el sistema
  protected $para;

  function __construct($para = ''){

  }

}

interface DCTR {
  public function inicio();
}

 ?>
