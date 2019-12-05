<?php

  function getCon() {
    try {
      $dir = "pgsql:dbname="
      .constant('DB')
      .";host="
      .constant('HOST')
      .";port="
      .constant('PORT')
      .";";

      $pdo = new PDO(
        $dir,
        constant('USER'),
        constant('PASS'));

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (\Exception $e) {
      echo "Oh no: ".$e->getMessage();
      return null;
    }
  }

  function getRes($sql){
    $ct = getCon();
    if($ct != null){
      $res = $ct->query($sql);
      return $res;
    }else {
      return null;
    }
  }

  function getResArray($sql){
    $ct = getCon();
    if($ct != null){
      $res = $ct->query($sql);
      $array = [];
      while($r = $res->fetch(PDO::FETCH_ASSOC)){
        array_push($array, $r);
      }
      return $array;
    }else{
      return [];
    }
  }

  function getOneFromSQL($sql, $params){
    $ct = getCon();
    if($ct != null){
      $sen = $ct->prepare($sql);
      $sen->execute($params);
      $res = null;
      while($r = $sen->fetch(PDO::FETCH_ASSOC)){
        $res = $r;
      }
      return $res;
    }
  }

  function getArrayFromSQL($sql, $params){
    $res = [];
    $ct = getCon();
    if($ct != null){
      try {
        $sen = $ct->prepare($sql);
        $sen->execute($params);
        while($r = $sen->fetch(PDO::FETCH_ASSOC)){
          array_push($res, $r);
        }
      } catch (\PDOException $e) {
        return ['error' => $e->getMessage()];
      }
    }
    return $res;
  }

  function executeSQL($sql, $params){
    $ct = getCon();
    if($ct != null){
      try {
        $sen= $ct->prepare($sql);
        return $sen->execute($params);
      } catch (\Exception $e) {
        return ['error' => $e->getMessage()];;
      }
    }else{
      return ['error' => 'No nos conectamos.'];;
    }
  }

  function deleteById($sql, $id = 0){
    if ($id != 0) {
      $res = executeSQL($sql, [
        'id' => $id
      ]);

      if(is_bool($res)){
          JSON::confirmacion('Eliminamos correctamente.');
      } else {
        JSON::error('No pudimos eliminarlo. ' . $res);
      }
    } else {
      JSON::error('No tenemos el id para eliminar.');
    }
  }

  function cargarVista($file){
    $dirVista = 'src/vista/';
    $file = $dirVista.$file;
    if(file_exists($file)){
      return $file;
    } else {
      return 'src/vista/static/errores/404.php';
    }
  }

  function cargarVistaAdmin($file){
    $dirVista = 'src/admin/vista/';
    $file = $dirVista.$file;
    if(file_exists($file)){
      return $file;
    } else {
      return 'src/admin/vista/static/errores/404.php';
    }
  }

  function getRandomPass(){
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
  }

  // Para saber que tipo de campos es
  // Si la respuesta escriba es NA es texto
  function getTipoCampo($tipo, $valor){
    return $valor == 'NA' ? 'text' : $tipo;
  }

  //Para llenar los combos
  function llenarCmb($cmb, $selec = '') {
    $opts = '<option value="">Seleccione</option>';
    foreach ($cmb as $c) {
      if($selec == mb_strtoupper($c) ){
        $opts .= '<option selected value="' . mb_strtoupper($c) . '">' . $c . '</option>';
      }else{
        $opts .= '<option value="' . mb_strtoupper($c) . '">' . $c . '</option>';
      }

    }
    return $opts;
  }

  function getErrorMsg($msg){
    return '
    <div class="alert alert-danger alert-dismissible fade show mx-auto" role="alert">
      <h5 class="alert-heading">Error</h5>
      <p> ' . $msg . ' </p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
  }

  function getInfoMsg($msg){
    return '
    <div class="alert alert-info alert-dismissible fade show mx-auto" role="alert">
      <p> ' . $msg . ' </p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
  }

  function buscarPersona($aguja){
    return "
    TRANSLATE(persona_primer_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_segundo_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_primer_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_segundo_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_identificacion,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_primer_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ||
    TRANSLATE(persona_segundo_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_primer_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ||
    TRANSLATE(persona_segundo_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_primer_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ||
    TRANSLATE(persona_primer_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%'
    ";
  }

 ?>
