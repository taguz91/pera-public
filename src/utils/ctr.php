<?php

abstract class CTR {
  //Para el tipo de usuario que utilizara el sistema
  protected $para;

  function __construct($para){
    global $U;
    if($U != null) {
      $this->para = $para;
      if(strcasecmp($U->tipo, $para) != 0 AND strcasecmp("todos", $para) != 0){
        echo "No tiene acceso a esta pagina!";
      } else {
        //echo "Si tiene acceso a esta pagina!";
      }
    }
  }

}

interface DCTR {
  public function inicio();
}

 ?>
