<?php

require_once 'src/modelo/usuario/usuario.php';

class UsuarioBD {

  static function login($user, $pass){
    $sql = '
    SELECT
    id_user_web, id_persona,
    user_name
    FROM public."UsersWeb"
    WHERE user_name = :user AND '
    . "user_clave = md5(md5('web') || :pass ||'web');";
    $ct = getCon();
    if($ct != null){
      $sen = $ct->prepare($sql);
      $sen->execute([
        'user' => $user,
        'pass' => $pass
      ]);
      $u = null;
      while($r = $sen->fetch(PDO::FETCH_ASSOC)){
        $u = true;
      }
      return $u;
    }
  }

  static function getPorUserAndPass($user, $pass){
    $sql = '
    SELECT
    uw.id_user_web,
    uw.user_name,
    p.id_persona,
    p.persona_primer_nombre,
    p.persona_segundo_nombre,
    p.persona_primer_apellido,
    p.persona_segundo_apellido,
    p.persona_correo,
    p.persona_celular,
    tipo_persona(p.id_persona) AS tipo
    FROM public."UsersWeb" uw
    JOIN public."Personas" p ON uw.id_persona = p.id_persona
    WHERE uw.user_name = :user AND
    uw.user_clave = '. "md5(md5('web') || :pass || 'web')" .';';
    $ct = getCon();
    if($ct != null){
      $sen = $ct->prepare($sql);
      $sen->execute([
        'user' => $user,
        'pass' => $pass
      ]);
      $u = null;
      while($r = $sen->fetch(PDO::FETCH_ASSOC)){
        $u = UsuarioMD::getFromRow($r);
      }
      return $u;
    }
  }

}

 ?>
