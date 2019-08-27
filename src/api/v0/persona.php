<?php
require_once 'src/modelo/persona/personabd.php';

class PersonaAPI {

  function verFoto($identificacion){
    $foto = PersonaBD::getFotoPorIden($identificacion);
    JSON::muestraIMG($foto);
  }

}

 ?>
