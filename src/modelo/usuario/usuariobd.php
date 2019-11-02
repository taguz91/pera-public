<?php

require_once 'src/modelo/usuario/usuario.php';

class UsuarioBD {

  static function login($user, $pass){
    $sql = '
    SELECT
    id_persona,
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

  static function admin($usuario, $pass) {
    $sql = '
    SELECT
    u.usu_username
    FROM
    public."Usuarios" u
    WHERE
    usu_username = :user AND
    usu_password = set_byte( MD5(:pass) :: bytea, 4, 64 ) AND
    usu_estado = TRUE;
    ';

    return getOneFromSQL($sql, [
      'user' => $usuario,
      'pass' => $pass
    ]);
  }

  static function getForAdmin($usuario, $pass) {
    $sql = '
    SELECT
    u.usu_username,
    u.id_usuario,
    u.id_persona,
    p.persona_primer_nombre || \' \' ||
    p.persona_primer_apellido  AS nombre_persona
    FROM
    public."Usuarios" u,
    public."Personas" p
    WHERE
    usu_username = :user AND
    usu_password = set_byte( MD5(:pass) :: bytea, 4, 64 ) AND
    usu_estado = TRUE AND
    p.id_persona = u.id_persona;';

    return getOneFromSQL($sql, [
      'user' => $usuario,
      'pass' => $pass
    ]);
  }

}

 ?>
